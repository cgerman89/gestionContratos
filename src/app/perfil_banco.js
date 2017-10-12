$(document).ready(function() {
        console.log('pagina banco cargada');
        Tabla_banco();
        CargaCombo_padre('#inst_financiera_bc',4);
        CargaCombo_padre('#tipo_cuenta_bc',15);

        $('#btn_cerrar_md_banco').click(function () {
            $('#form_banco').smkClear();
        });

        $('#btn_save_banco').click(function(e) {
            e.preventDefault();
            if($('#form_banco').smkValidate()) {
                SaveBanco(function (resp) {
                    $('#form_banco').smkClear();
                    $('#tabla_banco').DataTable().ajax.reload();
                    toastr.success(resp.perfil_banco);
                });
            }
        });
});

function SaveBanco(callback) {
    $.ajax({
        url:'Perfil/Banco',
        type:'POST',
        data:$('#form_banco').serialize(),
        dataType:'Json',
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
        error:function() {
            console.log('error en la peticion SaveBanco via ajax');
        }   
    });
    
}
function Tabla_banco() {
         var tbl_banco = $('#tabla_banco').DataTable({
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
                    "url":"Perfil/RegisBanco"
                },
                "columns":[
                    {"data":"p_institucion_banco"},
                    {"data":"p_tipo_cuenta"},
                    {"data":"p_numero_cuenta"},
                    {"defaultContent":"<button type='button' class='eliminar_exp_pro btn btn-danger'><i class='fa fa-trash'></i></button>"}
                ]
         });
DelRegisTbl_bc("#tabla_banco tbody", tbl_banco);
}
function DelRegisTbl_bc(tbody, table) {
        $(tbody).on("click","button.eliminar_exp_pro",function () {
            var data = table.row( $(this).parents("tr") ).data();
            alertify.confirm('Eliminar Registro',"Confirme para eliminar registro.",
                function(){
                    $.ajax({
                        url:'Perfil/EliminarBanco',
                        type:'Post',
                        dataTypes:'Json',
                        data:{p_id_banco:data.p_id_banco},
                        beforeSend:function () {
                            swal({title:'espere...',allowOutsideClick:false,allowEnterKey:false});
                            swal.showLoading();
                        },
                        success:function(response){
                             var res=JSON.parse(response);
                             $('#tabla_banco').DataTable().ajax.reload();
                            toastr.info(res.respuesta);
                        },
                        complete:function () {
                            swal.closeModal();
                        },
                        error:function() {
                             console.log('Eliminar Registro','error en la peticion Eliminar');
                        }
                    });
                },
                function(){

                });
        });
        
}