
var num_asp=0;
var idpersonal=0;
$(document).ready(function () {
   console.log('registro aspirante cargada')
    Mayus('#apellido1_asp');
    Mayus('#apellido2_asp');
    Mayus('#nombres_asp');
    Tabla_PreInscripcion();
    toastr.options = {
        closeButton:true,
        positionClass:"toast-top-right",
        preventDuplicates:true
    };

    $('#btn_cerrar_md_asp').click(function (e) {
        e.preventDefault();
        $('#form_aspirante').smkClear();
        BloqueDesbloqueo(0);
        $('#claves_asp').prop('hidden',true);
    });

    $('#cedula_asp').focusout(function () {
             el=$(this);
         var cedula=$(this).val();
         if(cedula !==''){
             console.log('no esta vacia');
             if(CedVal(cedula) === true){
                 BuscarPersona(cedula,function (data){
                     if(data.num === 1) {
                         for (var n in data.datos) {
                             idpersonal=data.datos[n].idpersonal;
                             $('#apellido1_asp').val(data.datos[n].apellido1);
                             $('#apellido2_asp').val(data.datos[n].apellido2);
                             $('#nombres_asp').val(data.datos[n].nombres);
                             $('#correo_institucion_asp').val(data.datos[n].correo_personal_institucional);
                             BloqueDesbloqueo(1);
                         }
                     }else if(data.num === 0) {
                          idpersonal=0;
                          toastr.info('no existe el registro');
                          BloqueDesbloqueo(0);
                          ClearCampos();
                     }
                 });
             }else{
                 toastr.error('cedula incorrecta');
                 setTimeout(function(){el.focus(); }, 5);
             }
         }else {
             console.log('esta vacia');
         }
    });

    $('#btn_save_pre_insc').click(function (e) {
        e.preventDefault();
        if($('#form_aspirante').smkValidate()){
            if(idpersonal > 0){
                AgregarAspirante(function (data) {
                    toastr.success(data.p_mensaje);
                });
            }else if(idpersonal === 0){
                if($.smkEqualPass('#clave_asp','#clave_verifica_asp')){
                    CrearAspirante(function (data) {
                        console.log(data);
                        toastr.success(data.p_mensaje);
                    });
                }
            }
        }
    });
});
function Mayus(campo) {
    $(campo).keyup(function () {
        $(this).val($(campo).val().toUpperCase())
    });
}
function CrearAspirante(callback) {
        $.ajax({
            url:'Aspirante/CrearAspirante',
            type:'POST',
            dataTypes:'json',
            data:$('#form_aspirante').serialize(),
            beforeSend:function () {
                swal({title: 'espere...', allowOutsideClick: false, allowEnterKey: false});
                swal.showLoading();
            },
            success: function (data){
                var res=JSON.parse(data);
                callback(res);
            },
            complete:function () {
                swal.closeModal();
            },
            error: function (data) {
                console.error('error en la peticion crear aspirante ');
            }
        });
}

function AgregarAspirante(callback) {
    $.ajax({
        url:'Aspirante/AgregarAspirante',
        type:'POST',
        dataTypes:'json',
        data:{idpersonal:idpersonal},
        beforeSend:function () {
            swal({title: 'espere...', allowOutsideClick: false, allowEnterKey: false});
            swal.showLoading();
        },
        success: function (data){
            var res=JSON.parse(data);
            callback(res);
        },
        complete:function () {
            swal.closeModal();
        },
        error: function (data) {
            console.error('error en la peticion agregrar aspirante ');
        }
    });
}

function ClearCampos() {
    $('#apellido1_asp').val('');
    $('#apellido2_asp').val('');
    $('#nombres_asp').val('');
    $('#correo_institucion_asp').val('');
    $('#claves_asp').prop('hidden',false);
}

function BuscarPersona(cedula,callback) {
    $.ajax({
        url:'Aspirante/Buscar',
        type:'POST',
        dataTypes:'json',
        data:{cedula:cedula},
        beforeSend:function () {
            swal({title: 'espere...', allowOutsideClick: false, allowEnterKey: false});
            swal.showLoading();
        },
        success:function (response) {
            var res=JSON.parse(response);
            callback(res);
        },
        complete:function () {
            swal.closeModal();
        },
        error: function () {
            console.log('error en peticion buscar persona');
        }
    });
}
function BloqueDesbloqueo(estado) {
    if(estado === 1){
       //$('#cedula_asp').prop('disabled',true);
       $('#apellido1_asp').prop('disabled',true);
       $('#apellido2_asp').prop('disabled',true);
       $('#nombres_asp').prop('disabled',true);
       $('#correo_institucion_asp').prop('disabled',true);
       $('#claves_asp').prop('hidden',true);
       $('#clave_asp').prop('required',false);
       $('#clave_verifica_asp').prop('required',false);

    }else if(estado === 0){
        //$('#cedula_asp').prop('disabled',false);
        $('#apellido1_asp').prop('disabled',false);
        $('#apellido2_asp').prop('disabled',false);
        $('#nombres_asp').prop('disabled',false);
        $('#correo_institucion_asp').prop('disabled',false);
        $('#claves_asp').prop('hidden',false);
        $('#clave_asp').prop('required',true);
        $('#clave_verifica_asp').prop('required',true);

    }
}

function Tabla_PreInscripcion() {
    var tabla_inscripcion=$('#tabla_inscricion').DataTable({
        "destroy":true,
        "lengthMenu":[[5, 10, 20, 25, 50, -1], [5, 10, 20, 25, 50, "Todos"]],
        "autoWidth":true,
        "orderClasses": true,
        "scrollCollapse": true,
        "responsive":true,
        "language":{
            "url": 'public/locales/Spanish.json'
        },
        "ajax":{
            "method":"POST",
            "url":"Aspirante/ListarPreInscritos",
            beforeSend:function () {
                swal({title: 'espere...', allowOutsideClick: false, allowEnterKey: false});
                swal.showLoading();
            },
            complete:function () {
                swal.closeModal();
            }
        },
        "columns":[
            {"data":"p_cedula"},
            {"data":"p_apellido1"},
            {"data":"p_apellido2"},
            {"data":"p_nombres"},
            {"data":"p_usuario"},
            {"data":"p_departamento"},
            {"defaultContent":"<input type='checkbox' class='seleccion'>",'orderable': false, 'searchable': false},
            {"defaultContent":"<div class='btn-group'><button type='button' class='btn btn-info'>Action</button><button type='button' class='btn btn-default dropdown-toggle' data-toggle='dropdown' aria-expanded='false'><span class='caret'></span><span class='sr-only'>Toggle Dropdown</span></button><ul class='dropdown-menu' role='menu'><li><a href='#'>Action</a></li><li class='divider'></li><li><a href='#'>Separated link</a></li></ul></div>"}

        ]
    });
    DelRegisTbl_inscripcion("#tabla_inscricion tbody", tabla_inscripcion);
}
function DelRegisTbl_inscripcion(tbody, table) {
    $(tbody).on("click","button.eliminar_pre_ins",function () {
        var data = table.row( $(this).parents("tr") ).data();
        alertify.confirm('Eliminar Registro',"Confirme para eliminar registro.",
            function(){
                $.ajax({
                    url:'Aspirante/EliminarRol',
                    type:'Post',
                    dataTypes:'Json',
                    data:{'idpersonal':data.p_idpersona,'idrol':47},
                    beforeSend:function () {
                        swal({title: 'espere...', allowOutsideClick: false, allowEnterKey: false});
                        swal.showLoading();
                    },
                    success:function(response){
                        var res=JSON.parse(response);
                        $('#tabla_inscricion').DataTable().ajax.reload();
                        toastr.info(res);
                    },
                    complete:function () {
                        swal.closeModal();
                    },
                    error:function() {
                        console.log('error en peticion borrar registro pre inscripcion');
                    }
                });
            },
            function(){

            });
    });

}