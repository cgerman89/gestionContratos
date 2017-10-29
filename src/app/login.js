$(document).ajaxStart(function () {
    swal({title: 'espere...',allowOutsideClick:false,allowEnterKey:false});
    swal.showLoading();
});

$(document).ready(function () {
    console.log('login listo');
    toastr.options = {
        closeButton:true,
        positionClass: "toast-top-right",
        preventDuplicates: true
    };
    $('#btn_session').click(function (e) {
        e.preventDefault();
        if(Valida() === true) {
            Login(function (data) {
                if (data.opcion === '2') {
                    swal.closeModal();
                    swal({title:'Session Usuario',html:data.mensaje,type:'error',allowOutsideClick:false,allowEnterKey:false});
                } else if (data.opcion === '1') {
                    swal.closeModal();
                    window.location.assign(data.url);
                } else if (data.opcion === '3') {
                    swal.closeModal();
                    swal({title:'Session Usuario',html:data.mensaje,type:'error',allowOutsideClick:false,allowEnterKey:false});
                }
            });
        }
    });
});

function Login(callback) {
   $.ajax({
        url:'Login/Entrar',
        type:'POST',
        data:$('#form_session').serialize(),
        dataTypes:'json',
        success:function (response){
            var res=JSON.parse(response);
            callback(res);
        }
    });
}

function Valida(){
    if($('#txt_usuario').val()===''){
        $('#txt_usuario').focus();
        toastr.warning('campo usuario obligatorio','Session');
    }else if($('#txt_clave').val()===''){
        $('#txt_clave').focus();
        toastr.warning('campo contraseña obligatorio','Session');
    }else{
        return true;
    }
}