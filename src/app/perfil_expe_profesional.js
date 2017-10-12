var Id_Archivo_exp=0;
$(document).ready(function() {
        console.log('pagina expe pro cargada');
        Tabla_exp_pro();
        $('#fecha_inicio_exp_pro').datepicker({format: 'yyyy-mm-dd',language:'es',autoclose: true,endDate:"0d"});
        $('#fecha_fin_exp_pro').datepicker({format: 'yyyy-mm-dd',language:'es',autoclose: true,endDate:"0d"});
        $('#pais_exp_pro').select2({theme:"bootstrap",dropdownParent: $('#modal_experiencia_pro')});
        CargaCombo_padre('#sostenibilidad_exp_pro',17);
        CargaCombo_padre('#area_exp_pro',29);
        CargaCombo_padre('#M_ingreso_exp_pro',6);
        CargaCombo_padre('#M_salida_exp_pro',7);
        Mayus('#instruccion_exp_pro');
        Mayus('#uni_admin_exp_pro');
        Mayus('#cargo_exp_pro');

        CargaPais(function (paises) {
          for(var n in paises){
              $('#pais_exp_pro').append('<option value='+paises[n].idpais+'>'+paises[n].nombre+'</option>');
          }
        });

        $('#area_exp_pro').change(function () {
           CargaCombo_Hijo('#sub_area_exp_pro',$('#area_exp_pro').val());
        });
        $('#sub_area_exp_pro').change(function () {
            CargaCombo_Hijo('#especifica_exp_pro',$('#sub_area_exp_pro').val());
        });

        $('#btn_cerrar_md_exp_pro').click(function () {
            $('#form_experiencia_pro').smkClear();
            $('#chk_docencia').bootstrapToggle('off');
            $('#chk_gestion').bootstrapToggle('off');
            $('#chk_vigente').bootstrapToggle('off');
            $('#archivo_exp_pro').prop('disabled',false);
            $('#archivo_exp_pro').val('');
            $('#pais_exp_pro').val('').trigger("change");
            BorrarIds_pro();

        });

        $('#btn_subir_file_exp').click(function (e) {
            e.preventDefault();
            if($('#archivo_exp_pro').val()!==''){
                if(Id_Archivo_exp ===0){
                   SaveArchivo_pro(function (resp) {
                       if(resp.opcion ===1){
                           Id_Archivo_exp=resp.id_fichero;
                           console.log('id '+Id_Archivo_exp);
                           $('#archivo_exp_pro').prop('disabled',true);
                           toastr.info(resp.mensaje);
                       }else if(resp.opcion === 2){
                           toastr.error(resp.mensaje);
                       }
                   });
                }else{
                    toastr.error('Ya Subio El Archivo');
                }
            }else{
                $('#archivo_exp_pro').focus();
                toastr.error('Seleccione Archivo');
            }
        });
        $('#btn_elimina_file_exp').click(function(e){
            e.preventDefault();
            if(Id_Archivo_exp > 0){
                alertify.confirm('Eliminar',"Confirme para eliminar archivo.",
                    function(){
                        EliminarFile_exp(function (resp) {
                            Id_Archivo_exp=0;
                            $('#archivo_exp_pro').prop('disabled',false);
                            $('#archivo_exp_pro').val('');
                            toastr.info(resp.mensaje);
                            console.log( 'id es  '+Id_Archivo_exp);
                        });
                    },
                    function(){}
                );
            }else{
                toastr.error('No ha Subido Archivo');
            }
        });

        $('#btn_save_exp_pro').click(function(e) {
            e.preventDefault();
            if($('#form_experiencia_pro').smkValidate()) {
                if(Id_Archivo_exp > 0){
                    SaveExpProfesional(function (resp) {
                        Id_Archivo_exp=0;
                        $('#form_experiencia_pro').smkClear();
                        $('#archivo_exp_pro').prop('disabled',false);
                        $('#archivo_exp_pro').val('');
                        $('#tabla_exp_profesional').DataTable().ajax.reload();
                        toastr.success(resp.perfil_exp_profesional);
                    });
                }else{
                    toastr.error('No ha Subido El Archivo pdf');
                }
            }
        });
    });

function EliminarFile_exp(callback) {
        $.ajax({
            url:'Perfil/EliminarArchivo',
            type:'Post',
            data:{id_fichero:Id_Archivo_exp},
            dataTypes:'json',
            beforeSend:function () {
                swal({title:'espere...',allowOutsideClick:false,allowEnterKey:false});
                swal.showLoading();
            },
            success:function (response) {
                var res=JSON.parse(response);
                 callback(res);
            },
            complete:function () {
                swal.closeModal();
            },
            error:function() {
                console.log('error al ejecutar la peticion en eliminar archivo exp_profesional ');
            }
        });   
}
function SaveArchivo_pro(callback) {
    var archivo = $("#archivo_exp_pro").prop('files')[0];
    var data_exp = new FormData();
        data_exp.append('archivo', archivo);
        data_exp.append('carpeta','exp_profesional');
        data_exp.append('cedula','1311853558');
        data_exp.append('tipo_documento',6);
    $.ajax({
        url:"Perfil/Archivo",
        type: 'POST',
        data: data_exp,
        cache: false,
        processData: false,
        contentType: false,
        beforeSend:function () {
            swal({title:'espere...',allowOutsideClick:false,allowEnterKey:false});
            swal.showLoading();
        },
        success:function(response){
            var res=JSON.parse(response);
            callback(res);
        },
        complete:function () {
            swal.closeModal();
        },
        error:function(){
            console.log('Error en peticion save archivo via ajax');
        }
    });
}


function SaveExpProfesional(callback) {
    var formulario = $('#form_experiencia_pro')[0];
    var docencia = Chked('#chk_docencia');
    var gestion = Chked('#chk_gestion');
    console.log(gestion+'-'+docencia);
    var form_expro = new FormData(formulario);
        form_expro.append('docencia',docencia);
        form_expro.append('gestion', gestion);
        form_expro.append('idfichero',Id_Archivo_exp);
    $.ajax({
        url: 'Perfil/ExpProfesional',
        type: 'POST',
        data:form_expro,
        contentType: false,
        processData: false,
        beforeSend:function () {
            swal({title:'espere...',allowOutsideClick:false,allowEnterKey:false});
            swal.showLoading();
        },
        success:function (response) {
            var res=JSON.parse(response);
            callback(res);
        },
        complete:function () {
            swal.closeModal();
        },
        error:function() {
            console.log('error en la peticion Save ExpProfesional via ajax ');
        }   
    });
    
}

function Tabla_exp_pro() {
         var tbl_exp_profesional = $('#tabla_exp_profesional').DataTable({
             "destroy":true,
             "autoWidth":true,
             "scrollX": true,
             "scrollCollapse": true,
             "responsive":true,
                 "language":{
                     "url": 'public/locales/Spanish.json'
                 },
                "ajax":{
                        "method":"POST",
                        "url":"Perfil/RegisExpProfesional"
                },
                "columns":[
                   {"data":"p_pais"},
                   {"data":"p_nombre_institucion"},
                   {"data":"p_nombre_unidad_administrativa"},
                   {"data":"p_nombre_puesto"},
                   {"data":"p_area_conocimiento"},
                   {"data":"p_sub_area_conocimiento"},
                   {"data":"p_sub_area_especifica"},
                   {"data":"p_tipo_sostenibilidad"},
                   {"data":"p_motivo_ingreso"},
                   {"data":"p_fecha_inicio"},
                   {"data":"p_motivo_salida"},
                   {"data":"p_fecha_final"},
                   {"data":"p_actividad_docente"},
                   {"data":"p_actividad_gestion"},
                   {"defaultContent":"<button type='button' class='eliminar_exp_pro btn btn-danger'><i class='fa fa-trash'></i></button>"}
                ],
                "columnDefs": [
                    {
                        "targets": [12],
                        "data": "p_actividad_docente",
                        "render": function(data, type, full) { 
                                 var res='';
                                 if(data === 1){
                                    res='SI';
                                 }else if(data === 0){
                                    res='NO';
                                 }
                          return res;
                        }
                    },
                    {
                        "targets": [13],
                        "data": "p_actividad_gestion",
                        "render": function(data, type, full) { 
                                 var res='';
                                 if(data === 1){
                                    res='SI';
                                 }else if(data === 0){
                                    res='NO';
                                 }
                          return res;
                        }  
                    }
                ]
         });
DelRegisTbl_exp_pro("#tabla_exp_profesional tbody", tbl_exp_profesional);
}

function DelRegisTbl_exp_pro(tbody, table) {
        $(tbody).on("click","button.eliminar_exp_pro",function () {
            var data = table.row( $(this).parents("tr") ).data();
            alertify.confirm('Eliminar Registro',"Confirme para eliminar registro.",
                function(){
                    $.ajax({
                        url:'Perfil/EliminarExpProfesional',
                        type:'Post',
                        dataTypes:'Json',
                        data:{ 'id_exp_profesional':data.p_idtrayectoria_laboral,'id_archivo':data.p_idfichero},
                        beforeSend:function () {
                            swal({title:'espere...',allowOutsideClick:false,allowEnterKey:false});
                            swal.showLoading();
                        },
                        success:function(response){
                             var res=JSON.parse(response);
                             $('#tabla_exp_profesional').DataTable().ajax.reload();
                             toastr.info(res.respuesta);
                        },
                        error:function() {
                             console.log('eeror en la peticion Eliminar registro tabla expe profesional');
                        },
                        complete:function () {
                            swal.closeModal();
                        }
                    });
                },
                function(){});
        });
        
}

function Chked(checked){
  if($(checked).prop('checked')=== true){
    return 1;
  }else if($(checked).prop('checked')===false) {
    return 0;
  }
}
function BorrarIds_pro() {
    if(Id_Archivo_exp > 0){
        $('#archivo_exp_pro').prop('disabled',false);
        $.post('Perfil/EliminarArchivo',{id_fichero:Id_Archivo_exp},function (datos, estado, xhr) {
            if (estado === 'success'){
                console.log('id archivo :'+datos);
            }
        },'json');
        Id_Archivo_exp=0;
    }
}