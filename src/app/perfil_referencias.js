
$(document).ready(function() {
        console.log('pagina referencias cargada');
        Tabla_rp();
        Mayus_rp('#apellidos_rp');
        Mayus_rp('#nombres_rp');

        $('#btn_cerrar_md_rp').click(function(e){
            e.preventDefault();
            $('#fomr_referencias').smkClear();
        });

        $('#btn_save_rp').click(function(e){
            e.preventDefault();
            if($('#fomr_referencias').smkValidate()) {
                alertify.success('Valido');
            }
        });
    });


function Mayus_rp(campo) {
        $(campo).keyup(function () {
            $(this).val($(campo).val().toUpperCase())
        });
}
function Tabla_rp() {
         var tbl_referencia = $('#tabla_referencias_p').DataTable({
                "destroy":true,
                "scrollCollapse": true,
                "responsive":true,
                "language":{
                     "url": 'public/locales/Spanish.json'
                }

         });
}