var Id_Archivo_cp=0;
 $(document).ready(function() {
        console.log('perrfil capacitaciones cargada');
        $('#fecha_inicio_cp').datepicker({format: 'yyyy-mm-dd',language:'es',autoclose: true,endDate:"0d"});
        $('#fecha_final_cp').datepicker({format: 'yyyy-mm-dd',language:'es',autoclose: true,endDate:"0d"});
        $('#pais_cp').select2({theme:"bootstrap",dropdownParent: $('#modal_capacitacion')});
        CargaCombo_padre('#tipo_cp',19);
        CargaCombo_padre('#tipo_cert_cp',14);
        Mayus('#evento_cp');
        Mayus('#auspiciante_cp');
        Mayus('#certificado_cp');
        Tabla_cp();
        toastr.options = {
             closeButton:true,
             positionClass: "toast-top-right",
             preventDuplicates:true
         };

        CargaPais(function (pais) {
            for(var n in pais){
                $('#pais_cp').append('<option value='+pais[n].idpais+'>'+pais[n].nombre+'</option>');
            }
        });
        $('#fecha_final_cp').datepicker().on('changeDate',function (e) {
            console.log($('#fecha_final_cp').datepicker('getEndDate'));
        });

        $('#btn_subir_file_cp').click(function(e){
            e.preventDefault();
            if($('#archivo_cp').val()!==''){
                if(Id_Archivo_cp === 0){
                    SaveArchivo_cp(function (resp) {
                        if(resp.opcion === 1){
                            Id_Archivo_cp=resp.id_fichero;
                            console.log('id '+Id_Archivo_cp);
                            $('#archivo_cp').prop('disabled',true);
                            toastr.info(resp.mensaje);
                        }else if(res.opcion === 2){
                            toastr.error(res.mensaje);
                        }
                    });
                }else{
                    toastr.error('Ya Subio El Archivo');
                }

            }else{
                $('#archivo_cp').focus();
                toastr.error('Seleccione Archivo');
            }
        });
        $('#btn_elimina_file_cp').click(function(e){
            e.preventDefault();
            if(Id_Archivo_cp > 0){
                alertify.confirm('Eliminar',"Confirme para eliminar archivo.",
                    function(){
                        EliminarFile_cp(function (resp) {
                            Id_Archivo_cp=0;
                            $('#archivo_cp').prop('disabled',false);
                            $('#archivo_cp').val('');
                            toastr.info(resp);
                            console.log( 'id es  '+Id_Archivo_cp)
                        });
                    },
                    function(){}
                );
            }else{
                alertify.error('No ha Subido Archivo');
            }
        });

        $('#btn_save_cp').click(function(e) {
            e.preventDefault();
            if($('#form_capacitacion').smkValidate()){
                if(Id_Archivo_cp > 0){
                    SaveCapacitacion(function (resp) {
                        Id_Archivo_cp=0;
                        $('#form_capacitacion').smkClear();
                        $('#archivo_cp').prop('disabled',false);
                        $('#archivo_cp').val('');
                        $('#tabla_capacitacion').DataTable().ajax.reload();
                        toastr.success(resp.perfil_capacitaciones);
                    });
                }else{
                    toastr.error('No ha Subido El Archivo pdf');
                }
            }
        });
        $('#btn_cerrar_md_cp').click(function () {
            $('#form_capacitacion').smkClear();
            $('#archivo_cp').prop('disabled',false);
            $('#archivo_cp').val('');
            $('#pais_cp').val('').trigger("change");
            BorrarIds_cp();
        });


 });

function Tabla_cp() {
	     var tbl_capacitacion = $('#tabla_capacitacion').DataTable({
                 "destroy":true,
                 "autoWidth":true,
                 "orderClasses": true,
                 "scrollCollapse": true,
                 "responsive":true,
                 "language":{
                     "url": 'public/locales/Spanish.json'
                 },
                "ajax":{
                        "method":"POST",
                        "url":"Perfil/RegisCapacitacion"
                },
                "columns":[
                   {"data":"p_pais"},
                   {"data":"p_evento"},
                   {"data":"p_tipo_capacitacion"},
                   {"data":"p_auspiciante"},
                   {"data":"p_numero_horas"},
                   {"data":"p_certificante"},
                   {"data":"p_tipo_certificado"},
                   {"data":"p_fecha_inicio"},
                   {"data":"p_fecha_fin"},
                   {"defaultContent":"<button type='button' class='eliminar_cp btn btn-danger'><i class='fa fa-trash'></i></button>"}

                ]
	     });
 DelRegisTbl_cp("#tabla_capacitacion tbody", tbl_capacitacion);
}

function DelRegisTbl_cp(tbody, table) {
        $(tbody).on("click","button.eliminar_cp",function () {
            var data = table.row( $(this).parents("tr") ).data();
            alertify.confirm('Eliminar Registro',"Confirme para eliminar registro.",
                function(){
                    $.ajax({
                        url:'Perfil/EliminarCapacitacion',
                        type:'Post',
                        dataTypes:'Json',
                        data:{ 'id_capacitacion':data.p_id_capacitacion,'id_archivo':data.p_id_fichero},
                        beforeSend:function () {
                            swal({title:'espere...',allowOutsideClick:false,allowEnterKey:false});
                            swal.showLoading();
                        },
                        success:function(response){
                             var res=JSON.parse(response);
                             $('#tabla_capacitacion').DataTable().ajax.reload();
                             toastr.info(res.respuesta);
                        },
                        complete:function () {
                            swal.closeModal();
                        },
                        error:function() {
                             console.log('error en la peticion ajax eliminar registro tabla')
                        }
                    });
                },
                function(){

                });
        });
        
}

function SaveArchivo_cp(callback) {
    var archivo = $("#archivo_cp").prop('files')[0];
    var data = new FormData();
        data.append('archivo', archivo);
        data.append('carpeta','capacitacion');
        data.append('cedula','1311853558');
        data.append('tipo_documento',5);
    $.ajax({
        url:"Perfil/Archivo",
        type:'POST',
        data: data,
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
        error:function(){
            console.log('Error en peticion ajax subir archivo pdf ');
        },
        complete:function () {
            swal.closeModal();
        }
    });
}


function EliminarFile_cp(callback) {
        $.ajax({
            url:'Perfil/EliminarArchivo',
            type:'Post',
            data:{id_fichero:Id_Archivo_cp},
            dataTypes:'json',
            beforeSend:function () {
                swal({title:'espere...',allowOutsideClick:false,allowEnterKey:false});
                swal.showLoading();
            },
            success:function (response) {
                var res=JSON.parse(response);
                callback(res);
            },
            error:function() {
                console.log('error en peticion eliminar archivo capacitaciones');
            },
            complete:function () {
                swal.closeModal();
            }
        });   
}
function SaveCapacitacion(callback) {
    var form_cp  = $('#form_capacitacion')[0];
    var datos_cp =  new FormData(form_cp);
        datos_cp.append('idfichero',Id_Archivo_cp);
        $.ajax({
            url:'Perfil/Capacitacion',
            type:'POST',
            data:datos_cp,
            contentType: false,
            processData: false,
            beforeSend:function () {
                swal({title:'espere...',allowOutsideClick:false,allowEnterKey:false});
                swal.showLoading();
            },
            success:function(response) {
                var res=JSON.parse(response);
                callback(res);
            },
            error:function(response) {
                console.log('error al ejecutar la peticion guardar capacitaciones '+response);
            },
            complete:function () {
                swal.closeModal();
            }
        });
        
}
function BorrarIds_cp() {
    if(Id_Archivo_cp > 0){
        $('#archivo_cp').prop('disabled',false);
        $.post('Perfil/EliminarArchivo',{id_fichero:Id_Archivo_cp},function (datos, estado, xhr) {
            if (estado === 'success'){
                console.log('id archivo :'+datos);
            }
        },'json');
        Id_Archivo_cp=0;
    }
}