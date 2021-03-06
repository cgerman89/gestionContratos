new Vue({
    el:'#app_login',
    created:function () {
        console.log('login listo');
        toastr.options = {
            closeButton:true,
            positionClass: "toast-top-center",
            preventDuplicates: true
        };
    },
    data:{
        usuario:'',
        password:''
    },
    methods:{
       Valida:function () {
           if(this.usuario === ''){
               $('#txt_usuario').focus();
               toastr.error('campo usuario obligatorio');
           }else if (this.password === ''){
               $('#txt_clave').focus();
               toastr.error('campo contraseña obligatorio');
           }else{
               this.Login(function (data) {
                   if (data.p_opcion === '1') {
                       swal.closeModal();
                       window.location.assign(data.url);
                   }else {
                       swal.closeModal();
                       swal({title:'Session Usuario',html:data.p_mensaje,type:'error',allowOutsideClick:false,allowEnterKey:false});
                   }
               });
           }
       },
       Login:function (callback) {
           $.ajax({
               url:'Login/Entrar',
               type:'POST',
               data:{'txt_usuario':this.usuario,'txt_clave':this.password},
               dataTypes:'json',
               beforeSend:function () {
                   swal({title: 'espere...',allowOutsideClick:false,allowEnterKey:false});
                   swal.showLoading();
               },
               success:function (response){
                   callback(JSON.parse(response));
               }
           });
       }
    }
});
