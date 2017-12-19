$(document).ready(function () {
   //aqui va tu codigo js funcion metodos etc.....
    //llmndo funcion nombre
     nombre();

     //definiendo funcion
    function nombre() {
        ///codigo
    }
    mi_boton.click(function (e) {
        e.preventDefault();
        //llamo a mi funcion que hace la la consulta al controlador
        var id=1;
        TraeDatos(id,function (respuesta) {
            //aqui obtienes la info q viene x ajax
            console.log(respuesta);
            campos.val(respuesta.valor);
            mi_comobo.val(respuesta.id_valor).prop('selected','selected');
            //etc....
            mi_modal.modal('show');
            //ise muestra la info en el modal
        });
    });
    //usas el callback que hace la funcino de return dentro de una peticion ajax
    function TraeDatos(id_registro,callback) {
        $.ajax({
            url:'Aspirante/AgregarAspirante',
            type:'POST',
            dataTypes:'json',
            data:{'id_registro':id_registro},
            success: function (data){
                //aqui retorna la informacion
                callback(JSON.parse(data));
            }
        });
    }
});