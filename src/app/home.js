$(document).ready(function (){
    toastr.options = {
        closeButton:true,
        positionClass:"toast-top-right",
        preventDuplicates:true
    }
    console.log('main cargado');
    $('#btn_cerrar_session').click(function (e) {
       e.preventDefault();
        swal({
            allowOutsideClick:false,
            allowEnterKey:false,
            title: 'Cerrar Session?',
            type: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Si'
        }).then(function () {
            CerrarSession(function (data) {
               if(data.opcion === 1){
                   swal.closeModal();
                   window.location.assign(data.url);
               }
            });
        },function (dismiss) { }
        );
    });
});

function CerrarSession(callback) {
    $.ajax({
       url:'Login/Logout',
        type:'POST',
        dataTypes:'json',
        beforeSend:function () {
            swal({title:'espere...',allowOutsideClick:false,allowEnterKey:false});
            swal.showLoading();
        },
        success:function(response) {
           var res=JSON.parse(response);
           callback(res);
        },
        complete:function () {
            swal.closeModal();
        }
    });
}