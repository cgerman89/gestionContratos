var Id_Archivo_f=0;
$(document).ready(function () {
        console.log('pagina instruccion fomral cargada');
        var dp_inicio_fp=$('#fecha_inicio_fp').datepicker({format: 'yyyy-mm-dd',language:'es',autoclose: true,endDate:"0d"});
        var dp_obtuvo_fp=$('#fecha_obtuvo_fp').datepicker({format: 'yyyy-mm-dd',language:'es',autoclose: true,endDate:"0d"});
        var dp_graduacion_fp=$('#fecha_graduacion_fp').datepicker({format: 'yyyy-mm-dd',language:'es',autoclose: true,endDate:"0d"});
        CargaCombo_padre('#Ninstruccion_fp',10);
        CargaCombo_padre('#Aconocimiento_fp',29);
        CargaCombo_padre('#beca_fp',44);
        CargaCombo_padre('#Tperiodo_fp',20);
        Mayus('#titulo_obt_fp');
        Mayus('#N_regitro_fp');
        Tabla_ins_formal();
        toastr.options = {
            closeButton:true,
            positionClass:"toast-top-right",
            preventDuplicates:true
        };

        $('#universidad_fp').select2({theme:"bootstrap",dropdownParent: $('#myModal')});

         CargaUniversidad(function (universidad) {
            for(var n in universidad){
                $('#universidad_fp').append('<option value='+universidad[n].iduniversidad+'>'+universidad[n].nombre+'</option>');
            }
         });

         $('#Aconocimiento_fp').change(function () {
             CargaCombo_Hijo('#sbArea_fp',$('#Aconocimiento_fp').val());
         });
         $('#sbArea_fp').change(function () {
             CargaCombo_Hijo('#sbAreaES_fp',$('#sbArea_fp').val());
         });

        $('#btn_cerrar_modal').click(function () {
            $('#form_formacion').smkClear();
            $('#archivo_fp').prop('disabled',false);
            $('#archivo_fp').val('');
            $('#universidad_fp').val('').trigger("change");
            BorrarIds();
        });

        $('#btn_subir_file').click(function (e) {
            e.preventDefault();
            if($('#archivo_fp').val()!=='') {
                if(Id_Archivo_f===0){
                    SaveArchivo_Formal(function (resp) {
                        var res=JSON.parse(resp);
                        if(res.opcion === 1){
                            Id_Archivo_f=res.id_fichero;
                            console.log('id '+Id_Archivo_f);
                            $('#archivo_fp').prop('disabled',true);
                            toastr.success(res.mensaje);
                        }else if(res.opcion === 2){
                            toastr.error(res.mensaje);
                        }
                    });
                }else {
                    toastr.error('Ya Subio El Archivo');
                }

            }else{
                $('#archivo_fp').focus();
                toastr.error('Seleccione Archivo');
            }
        });
        $('#btn_elimina_file').click(function (e) {
            e.preventDefault();
            if(Id_Archivo_f > 0){
                alertify.confirm('Eliminar',"Confirme para eliminar archivo.",
                    function(){
                        EliminarFile_fp(function (resp) {
                            var res=JSON.parse(resp)
                            Id_Archivo_f=0;
                            $('#archivo_fp').val('');
                            $('#archivo_fp').prop('disabled',false);
                            toastr.success(res);
                            console.log( 'id es  '+Id_Archivo_f)
                        });
                    },
                    function(){

                    });
            }else{
                toastr.error('No ha Subido El Archivo pdf');
            }

        });
        $('#btn_save_formal').click(function (e) {
            e.preventDefault();
            if($('#form_formacion').smkValidate()){
                if(Id_Archivo_f > 0){
                    SaveFormal(function (resp) {
                         var res=JSON.parse(resp);
                        $('#tabla_formal').DataTable().ajax.reload();
                         Id_Archivo_f=0;
                         $('#form_formacion').smkClear();
                         $('#archivo_fp').val('');
                         $('#archivo_fp').prop('disabled',false);
                         $('#universidad_fp').val('').trigger("change");
                         toastr.success(res.inst_formal);
                    });
                }else{
                    $('#archivo_fp').focus();
                    toastr.error('No ha Subido El Archivo pdf');
                }
            }
        });

    });

function CargaCombo_padre(combo,id) {
    $.post('Campos/Tipo',{'id':id},function (datos, estado, xhr) {
        if (estado === 'success') $.each(datos, function (index, value) {
            $(combo).append('<option value='+value.idtipo+'>'+value.nombre+'</option>');
        });
    },'json');
}

function CargaCombo_Hijo(combo,id){
    $(combo+'  option').remove();
    $(combo).append('<option value="">Seleccione</option>');
    $.post('Campos/Tipo_hijo',{'id_hijo':id},function (datos, estado, xhr) {
        if (estado === 'success') $.each(datos, function (index, value) {
            $(combo).append('<option value='+value.idtipo+'>'+value.nombre+'</option>');
        });
    },'json');
}

function CargaUniversidad(callback) {
    $.post('Campos/Universidad',function (datos, estado, xhr) {
        if (estado === 'success'){
             callback(datos);
        }
    },'json');
}

function SaveArchivo_Formal(callback) {
    var archivo = $("#archivo_fp").prop('files')[0];
    var data = new FormData();
        data.append('archivo', archivo);
        data.append('carpeta','formacion');
        data.append('cedula', '1311853558');
        data.append('tipo_documento', 4);
    $.ajax({
        url:"Perfil/Archivo",
        type: 'POST',
        data: data,
        cache: false,
        processData: false,
        contentType: false,
        beforeSend:function () {
            swal({title:'espere...',allowOutsideClick:false,allowEnterKey:false});
            swal.showLoading();
        },
        success: function (response) {
          callback(response);
        },
        error: function (response) {
           console.log('Error en peticion ');
        },
        complete:function () {
            swal.closeModal();
        }
    });
}

function SaveFormal(callback) {
        var form = $('#form_formacion')[0];
        var datos =  new FormData(form);
            datos.append('idfichero',Id_Archivo_f);
        $.ajax({
           url:'Perfil/InstFormal',
           type:'Post',
           data:datos,
           contentType:false,
           processData:false,
           beforeSend:function () {
                swal({title:'espere...',allowOutsideClick:false,allowEnterKey:false});
                swal.showLoading();
           },
           success:function (response) {
              callback(response);
           },
            complete:function () {
                swal.closeModal();
           },
            error:function(response){
               console.log(response);
               console.log('error en peticion ajax guardar inst. formal');
            }
        });
}
function EliminarFile_fp(callback) {
        $.ajax({
            url:'Perfil/EliminarArchivo',
            type:'Post',
            data:{id_fichero:Id_Archivo_f},
            dataTypes:'json',
            beforeSend:function () {
                swal({title:'espere...',allowOutsideClick:false,allowEnterKey:false});
                swal.showLoading();
            },
            success:function (response) {
             callback(response);
            },
            complete:function () {
                swal.closeModal();
            }
        });
}
function Tabla_ins_formal(){
        var tbl_inst_formal=$('#tabla_formal').DataTable({
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
                "url":"Perfil/RegisInstFormal"
            },
            "columns":[
                {"data":"p_nivel_inst"},
                {"data":"p_universidad"},                
                {"data":"p_area_cono"},
                {"data":"p_sub_area"},
                {"data":"p_sub_area_espe"},
                {"data":"p_titulo"},
                {"data":"p_num_registro"},
                {"data":"p_fecha_inicio"},
                {"data":"p_fecha_obtuvo_titulo"},
                {"data":"p_fecha_graduacion"},
                {"data":"p_numero_periodos"},
                {"data":"p_tipo_periodos"},
                {"data":"p_tipo_beca"},
                {"defaultContent":"<button type='button' class='eliminar btn btn-danger'><i class='fa fa-trash'></i></button>"}
            ]
                    
        }); 
        
     DelRegisTbl("#tabla_formal tbody", tbl_inst_formal);
    }
function DelRegisTbl(tbody, table) {
        $(tbody).on("click","button.eliminar",function () {
            var data = table.row( $(this).parents("tr") ).data();
            alertify.confirm('Eliminar Registro',"Confirme para eliminar registro.",
                function(){
                    $.ajax({
                        url:'Perfil/EliminarRegisFormacion',
                        type:'Post',
                        dataTypes:'Json',
                        data:{ 'id_personal':data.p_id_formacion,'id_archivo':data.p_id_fichero},
                        beforeSend:function () {
                            swal({title:'espere...',allowOutsideClick:false,allowEnterKey:false});
                            swal.showLoading();
                        },
                        success:function(response){                            
                            var res=JSON.parse(response);
                            $('#tabla_formal').DataTable().ajax.reload();
                            toastr.success(res.respuesta);
                        },
                        complete:function () {
                            swal.closeModal();
                        },
                        error:function(response) {
                            console.log('error en peticion eliminar registro inst. formal');
                        }
                    });
                },
                function(){

                });
        });
        
}
function BorrarIds() {
    if(Id_Archivo_f > 0){
        $('#archivo_fp').prop('disabled',false);
        $.post('Perfil/EliminarArchivo',{id_fichero:Id_Archivo_f},function (datos, estado, xhr) {
            if (estado === 'success'){
                console.log('id archivo :'+datos);
            }
        },'json');
        Id_Archivo_f=0;
    }
}

