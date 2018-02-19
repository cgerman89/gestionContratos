var Id_Archivo_pb=0;
var Id_Cientifico_pb=0;
var $form_cabecera=$('#form_cabecera_pb');
$(document).ready(function () {
       console.log('pagina publicaciones cargada');
       $('#fecha_publicacion_LB').datepicker({format: 'yyyy-mm-dd',language:'es',autoclose: true,endDate:"0d"});
       $('#fecha_publicacion_CL').datepicker({format: 'yyyy-mm-dd',language:'es',autoclose: true,endDate:"0d"});
       $('#fecha_publicacion_Art_me').datepicker({format: 'yyyy-mm-dd',language:'es',autoclose: true,endDate:"0d"});
       $('#fecha_publicacion_Art_rev').datepicker({format: 'yyyy-mm-dd',language:'es',autoclose: true,endDate:"0d"});


       $('#arch_subido_Art_Me').prop('disabled',false);
       Mayus('#ciudad_Art_Me');
       Mayus('#ciudad_Art_rev');
       Mayus('#nom_articulo_Art_me');
       Mayus('#nom_articulo_Art_rev');
       Mayus('#num_volumen_Art_rev');
       Mayus('#ciudad_CL');
       Mayus('#ciudad_LB');
       Mayus('#nom_capitulo_CL');
       Mayus('#editor_CL');
       CargaCombo_padre('#tipo_publicacion_pb',33);
       CargaCombo_padre('#area_conocimiento_CB',29);
       CargaCombo_padre('#estado_pub_LB',62);
       CargaCombo_padre('#estado_pub_CL',62);
       CargaCombo_padre('#estado_pub_Art_rev',62);
       CargaCombo_padre('#participacion_LB',34);
       CargaCombo_padre('#participacion_CL',34);
       CargaCombo_padre('#participacion_Art_rev',34);
       CargaCombo_padre('#participacion_Art_me',34);

       $('#instrumento_CB').select2({
           theme:"bootstrap",
           dropdownParent: $('#modal_publicacion'),
           placeholder:"seleccione instrumento",
           ajax: {
               url:'Campos/Instrumento_Pub',
               type:'POST',
               dataType:'json',
               processResults: function (data){
                   return{
                       results: $.map(data, function(obj) {
                           return { id: obj.id_publicacion_instrumento, text: obj.nombre };
                       })
                   }
               }
           }
       });

       $('#area_conocimiento_CB').change(function () {
           CargaCombo_Hijo_pb('#sub_area_CB',$('#area_conocimiento_CB').val());
       });
       $('#sub_area_CB').change(function () {
           CargaCombo_Hijo_pb('#area_espe_CB',$('#sub_area_CB').val());
       });

       $('#btn_nuevo_publicacion').click(function (e) {
           e.preventDefault();
           if($('#tipo_publicacion_pb').val()!==''){
               $('#modal_publicacion').modal('show');
           }else{
             toastr.error('Seleccione Tipo Publicacion');
             $('#tipo_publicacion_pb').focus();
           }
       });

       $('#tipo_publicacion_pb').change(function () {
            var tp=$(this).val();
            Agregar(tp);
       });

       $('#btn_cerrar_md_publicacion').click(function (e) {
               e.preventDefault();
               $('#instrumento_CB').val('').trigger("change");
               $form_cabecera.smkClear();
               $('#form_libro_pb').smkClear();
               $('#form_cap_libro_pb').smkClear();
               $('#form_art_memoria_pb').smkClear();
               $('#form_art_revista_pb').smkClear();
               ClearIdArchivo();
               $('#modal_publicacion').modal('hide');
       });
       
       $('#btn_subir_1_Art_Me').click(function (e) {
           e.preventDefault();
           if($('#arch_subido_Art_Me').val()!==''){
               if(Id_Archivo_pb === 0){
                   SubirArchivo($("#arch_subido_Art_Me").prop('files')[0],'publicacion_subido',function (respuesta) {
                       console.log('id archivo es :'+respuesta);
                       Id_Archivo_pb=respuesta;
                       $('#arch_subido_Art_Me').prop('disabled',true);
                   });
               }else{
                   toastr.error('Ya Subio El Archivo');
               }
           }else{
               toastr.error('Elija un  Archivo');
               $('#arch_subido_Art_Me').focus();
           }
       });
       $('#btn_eliminar_1_Art_Me').click(function (e) {
           e.preventDefault();
           if(Id_Archivo_pb > 0){
               alertify.confirm('Eliminar',"Confirme para eliminar archivo.",
                   function(){
                    EliminarArchivo_PB(Id_Archivo_pb,function (opcion) {
                        console.log(opcion);
                        toastr.info(opcion);
                        Id_Archivo_pb=0;
                        $('#arch_subido_Art_Me').val('');
                        $('#arch_subido_Art_Me').prop('disabled',false);
                    });
                   },
                   function(){}
               );
           }else{
               toastr.error('Suba Archivo');
               $('#arch_subido_Art_Me').focus();
           }
       });

       $('#btn_subir_2_Art_Me').click(function (e) {
           e.preventDefault();
           if($('#arch_progr_cient_pb').val()!==''){
               if(Id_Cientifico_pb === 0){
                   SubirArchivo($('#arch_progr_cient_pb').prop('files')[0],'publicacion_pro_cientifica',function (respuesta) {
                       console.log('nombre sube 2 es '+respuesta);
                       Id_Cientifico_pb=respuesta;
                       $('#arch_progr_cient_pb').prop('disabled',true);

                   });
               }else {
                   toastr.error('Ya Subio El Archivo');
               }
           }else{
               toastr.error('Elija un  Archivo');
               $('#arch_progr_cient_pb').focus();
           }
       });

       $('#btn_eliminar_2_Art_Me').click(function (e) {
           e.preventDefault();
           if(Id_Cientifico_pb > 0){
               alertify.confirm('Eliminar',"Confirme para eliminar archivo.",
                   function(){
                       EliminarArchivo_PB(Id_Cientifico_pb,function (opcion) {
                           console.log(opcion);
                           toastr.info(opcion);
                           Id_Cientifico_pb=0;
                           $('#arch_progr_cient_pb').val('');
                           $('#arch_progr_cient_pb').prop('disabled',false);
                       });
                   },
                   function(){}
               );
           }else{
               toastr.error('Suba Archivo');
               $('#arch_progr_cient_pb').focus();
           }
       });
       /// botones que guardan cada formulario
       $('#btn_save_libro').click(function (e) {
          e.preventDefault();
          if(($form_cabecera.smkValidate())&&($('#form_libro_pb').smkValidate())){
                  var data_frmlibro = new FormData();
                      data_frmlibro.append('area_espe',$('#area_espe_CB').val());
                      data_frmlibro.append('instrumento',$('#instrumento_CB').val());
                      data_frmlibro.append('fecha_publicacion',$('#fecha_publicacion_LB').val());
                      data_frmlibro.append('participacion',$('#participacion_LB').val());
                      data_frmlibro.append('url',$('#url_LB').val());
                      data_frmlibro.append('ciudad',$('#ciudad_LB').val());
                      data_frmlibro.append('estado_pub',$('#estado_pub_LB').val());
                      data_frmlibro.append('tipo_publicacion_pb',$('#tipo_publicacion_pb').val());
                      SavePublicacion(data_frmlibro,'#table_libro','#form_libro_pb');
          }
       });
       $('#btn_save_Capitulo_L').click(function (e) {
           e.preventDefault();
           if(($form_cabecera.smkValidate())&&($('#form_cap_libro_pb').smkValidate())){
                   var data_frmCapLibro = new FormData();
                       data_frmCapLibro.append('area_espe',$('#area_espe_CB').val());
                       data_frmCapLibro.append('instrumento',$('#instrumento_CB').val());
                       data_frmCapLibro.append('nombre',$('#nom_capitulo_CL').val());
                       data_frmCapLibro.append('fecha_publicacion',$('#fecha_publicacion_CL').val());
                       data_frmCapLibro.append('participacion',$('#participacion_CL').val());
                       data_frmCapLibro.append('url',$('#url_CL').val());
                       data_frmCapLibro.append('ciudad',$('#ciudad_CL').val());
                       data_frmCapLibro.append('editor',$('#editor_CL').val());
                       data_frmCapLibro.append('rango_pagina',$('#rango_pagina_CL').val());
                       data_frmCapLibro.append('estado_pub',$('#estado_pub_CL').val());
                       data_frmCapLibro.append('tipo_publicacion_pb',$('#tipo_publicacion_pb').val());
                       SavePublicacion(data_frmCapLibro,'#table_Cap_libro','#form_cap_libro_pb');
           }
       });
       $('#btn_save_Art_rev').click(function (e) {
           e.preventDefault();
           if(($form_cabecera.smkValidate()) && ($('#form_art_revista_pb').smkValidate())){
                   var data_frmArtRevista = new FormData();
                       data_frmArtRevista.append('area_espe',$('#area_espe_CB').val());
                       data_frmArtRevista.append('instrumento',$('#instrumento_CB').val());
                       data_frmArtRevista.append('nombre',$('#nom_articulo_Art_rev').val());
                       data_frmArtRevista.append('fecha_publicacion',$('#fecha_publicacion_Art_rev').val());
                       data_frmArtRevista.append('participacion',$('#participacion_Art_rev').val());
                       data_frmArtRevista.append('url',$('#url_Art_rev').val());
                       data_frmArtRevista.append('ciudad',$('#ciudad_Art_rev').val());
                       data_frmArtRevista.append('estado_pub',$('#estado_pub_Art_rev').val());
                       data_frmArtRevista.append('num_revista',$('#num_revista_Art_rev').val());
                       data_frmArtRevista.append('num_volumen',$('#num_volumen_Art_rev').val());
                       data_frmArtRevista.append('rango_pagina',$('#rango_pagina_Art_rev').val());
                       data_frmArtRevista.append('tipo_publicacion_pb',$('#tipo_publicacion_pb').val());
                       SavePublicacion(data_frmArtRevista,'#table_Art_Revista','#form_art_revista_pb');
           }
       });
       $('#btn_save_art_memoria').click(function (e) {
           e.preventDefault();
           if(($form_cabecera.smkValidate())&&($('#form_art_memoria_pb').smkValidate())){
                   var data_frmArtMemoria = new FormData();
                       data_frmArtMemoria.append('area_espe',$('#area_espe_CB').val());
                       data_frmArtMemoria.append('instrumento',$('#instrumento_CB').val());
                       data_frmArtMemoria.append('nombre',$('#nom_articulo_Art_me').val());
                       data_frmArtMemoria.append('fecha_publicacion',$('#fecha_publicacion_Art_me').val());
                       data_frmArtMemoria.append('participacion',$('#participacion_Art_me').val());
                       data_frmArtMemoria.append('url',$('#url_Art_me').val());
                       data_frmArtMemoria.append('ciudad',$('#ciudad_Art_Me').val());
                       data_frmArtMemoria.append('arch_subido', Id_Archivo_pb);
                       data_frmArtMemoria.append('arch_progr_cient_pb',Id_Cientifico_pb);
                       data_frmArtMemoria.append('estado_pub',-1);
                       data_frmArtMemoria.append('tipo_publicacion_pb',$('#tipo_publicacion_pb').val());
                       SavePublicacion(data_frmArtMemoria,'#table_Art_Memoria','#form_art_memoria_pb');
           }
       });
});

//funciones
function CargaCombo_Hijo_pb(combo,id){
    $(combo+'  option').remove();
    $(combo).append('<option value="">Seleccione</option>');
    $.post('Campos/Tipo_hijo',{'id_hijo':id},function (datos, estado, xhr) {
        if (estado === 'success') $.each(datos, function (index, value) {
            $(combo).append('<option value='+value.idtipo+'>'+value.nombre+'</option>');
        });
    },'json');
}

function Agregar(tipo) {
    switch (tipo){
        case '410':
            $('#form_cap_libro_pb').hide();
            $('#form_art_revista_pb').hide();
            $('#form_art_memoria_pb').hide();
            $('#table_Art_Memoria').hide();
            $('#table_Art_Revista').hide();
            $('#table_Cap_libro').hide();
            HIdenWraper();
            Tabla_Libro(410);
            $('#table_libro').show();
            $('#descripcion_CB').text('Descripcion del Libro');
            $('#form_libro_pb').show();
            break;
        case '411':
            $('#form_libro_pb').hide();
            $('#form_art_revista_pb').hide();
            $('#form_art_memoria_pb').hide();
            $('#table_Art_Memoria').hide();
            $('#table_Art_Revista').hide();
            $('#table_libro').hide();
            HIdenWraper();
            Tabla_CpLibro(411);
            $('#table_Cap_libro').show();
            $('#descripcion_CB').text('Descripcion del Capitulo de Libro');
            $('#form_cap_libro_pb').show();
            break;
        case  '412':
            $('#form_libro_pb').hide();
            $('#form_cap_libro_pb').hide();
            $('#form_art_memoria_pb').hide();
            $('#table_Art_Memoria').hide();
            $('#table_Cap_libro').hide();
            $('#table_libro').hide();
            HIdenWraper();
            Tabla_Art_Revista(412);
            $('#table_Art_Revista').show();
            $('#descripcion_CB').text('Descripcion del Articulo de Revista');
            $('#form_art_revista_pb').show();
            break;
        case '2509':
            $('#form_cap_libro_pb').hide();
            $('#form_libro_pb').hide();
            $('#form_art_revista_pb').hide();
            $('#table_Cap_libro').hide();
            $('#table_libro').hide();
            $('#table_Art_Revista').hide();
            HIdenWraper();
            Tabla_Art_Memoria(2509);
            $('#table_Art_Memoria').show();
            $('#descripcion_CB').text('Descripcion del Articulo En Memoria de Evento');
            $('#form_art_memoria_pb').show();
            break;
        default:
            HIdenWraper();
            $('#table_Cap_libro').hide();
            $('#table_libro').hide();
            $('#table_Art_Revista').hide();
            $('#table_Art_Memoria').hide();
            $('#form_libro_pb').hide();
            $('#form_cap_libro_pb').hide();
            $('#form_art_memoria_pb').hide();
            $('#form_art_revista_pb').hide();
           break;
    }
}

function HIdenWraper() {
    $('#table_libro_wrapper').hide();
    $('#table_Cap_libro_wrapper').hide();
    $('#table_Art_Revista_wrapper').hide();
    $('#table_Art_Memoria_wrapper').hide();
}

function SavePublicacion(formulario,tablaDT,form) {
  var $form_pub=$(form);
    $.ajax({
        url:'Perfil/Publicacion',
        type: 'POST',
        data:formulario,
        contentType: false,
        processData: false,
        beforeSend:function () {
            swal({title:'espere...',allowOutsideClick:false,allowEnterKey:false});
            swal.showLoading();
        },
        success: function (response) {
            var res=JSON.parse(response);
            $(tablaDT).DataTable().ajax.reload();
            $form_cabecera.smkClear();
            $form_pub.smkClear();
            Id_Archivo_pb=0;
            Id_Cientifico_pb=0;
            $('#arch_subido_Art_Me').prop('disabled',false);
            $('#arch_progr_cient_pb').prop('disabled',false);
            toastr.info(res.perfil_publicaciones);
        },
        complete:function () {
            swal.closeModal();
        },
        error:function () {
          console.log('Se produjo un error al ejecutar la peticion ajax SavePublicacion ');
        }
    });
}

function EliminarRegisTabla(tbody, table, idTable) {
    $(tbody).on("click","button.eliminar",function () {
        var data = table.row( $(this).parents("tr") ).data();
        console.log('tabla datos a del '+data.p_id_fichero1 +'-'+data.p_id_fichero2);
        alertify.confirm('Eliminar Registro',"Confirme para eliminar registro.",
            function(){
                $.ajax({
                    url:'Perfil/EliminarPublicacion',
                    type:'Post',
                    dataTypes:'Json',
                    data:{ 'id_publicacion':data.p_id_publicacion,'fichero1':data.p_id_fichero1,'fichero2':data.p_id_fichero2},
                    beforeSend:function () {
                        swal({title:'espere...',allowOutsideClick:false,allowEnterKey:false});
                        swal.showLoading();
                    },
                    success:function(response){
                        var res=JSON.parse(response);
                        $(idTable).DataTable().ajax.reload();
                        toastr.info(res);
                    },
                    complete:function () {
                        swal.closeModal();
                    },
                    error:function() {
                        console.log('error en la peticion ajax  Eliminar registro tabla');
                    }
                });
            },
            function(){}
        );
    });
}

function SubirArchivo(nombre,carpeta,callback) {
   var data_archivo = new FormData();
        data_archivo.append('archivo', nombre);
        data_archivo.append('carpeta', carpeta);
        data_archivo.append('cedula', '1311853558');
        data_archivo.append('tipo_documento', 9);
    $.ajax({
        url:'Perfil/Archivo',
        type:'POST',
        data:data_archivo,
        contentType: false,
        processData: false,
        beforeSend:function () {
            swal({title:'espere...',allowOutsideClick:false,allowEnterKey:false});
            swal.showLoading();
        },
        success: function (response) {
            var res=JSON.parse(response);
            if(res.opcion === 1){
                callback(res.id_fichero);
                toastr.info(res.mensaje);
            }

        },
        complete:function () {
            swal.closeModal();
        },
        error:function () {
            console.log('Se produjo un error al ejecutar la peticion ajax SaveArchivoPublicacion');
        }
    });
}

function EliminarArchivo_PB(id_fichero,callback){
    $.ajax({
        url:'Perfil/EliminarArchivo',
        type:'Post',
        data:{id_fichero:id_fichero},
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
            console.log('error al ejecutar la peticion en eliminar archivo publicacion ');
        }
    });
}

function Tabla_Libro(tipo) {
    var tabla_libro = $('#table_libro').DataTable({
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
            "url":"Perfil/RegisPublicacion",
            "data":{
                tipo_p:tipo
            }
        },
        "columns":[
            {"data":"p_tipo_publicacion"},
            {"data":"p_instrumento"},
            {"data":"p_estado_publicacion"},
            {"data":"p_sub_area_especifica"},
            {"data":"p_link"},
            {"data":"p_cuidad_evento"},
            {"data":"p_participacion"},
            {"data":"p_fecha"},
            {"defaultContent":"<button type='button' class='eliminar btn btn-danger'><i class='far fa-trash-alt'></i></button>"}
        ]
    });
    EliminarRegisTabla('#table_libro tbody', tabla_libro,'#table_libro');
}

function Tabla_CpLibro(tipo) {
    var tabla_cpLibro= $('#table_Cap_libro').DataTable({
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
            "url":"Perfil/RegisPublicacion",
            "data":{tipo_p:tipo }
        },
        "columns":[
            {"data":"p_tipo_publicacion"},
            {"data":"p_instrumento"},
            {"data":"p_estado_publicacion"},
            {"data":"p_sub_area_especifica"},
            {"data":"p_nombre"},
            {"data":"p_link"},
            {"data":"p_cuidad_evento"},
            {"data":"p_editor_compilador"},
            {"data":"p_participacion"},
            {"data":"p_rango_paginas"},
            {"data":"p_fecha"},
            {"defaultContent":"<button type='button' class='eliminar btn btn-danger'><i class='far fa-trash-alt'></i></button>"}
        ]
    });
    EliminarRegisTabla('#table_Cap_libro tbody', tabla_cpLibro,'#table_Cap_libro');
}

function Tabla_Art_Revista(tipo){
    var tabla_art_revista=$('#table_Art_Revista').DataTable({
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
            "url":"Perfil/RegisPublicacion",
            "data":{tipo_p:tipo }
        },
        "columns":[
            {"data":"p_tipo_publicacion"},
            {"data":"p_instrumento"},
            {"data":"p_estado_publicacion"},
            {"data":"p_sub_area_especifica"},
            {"data":"p_nombre"},
            {"data":"p_link"},
            {"data":"p_cuidad_evento"},
            {"data":"p_participacion"},
            {"data":"p_revista_numero"},
            {"data":"p_revista_volumen"},
            {"data":"p_rango_paginas"},
            {"data":"p_fecha"},
            {"defaultContent":"<button type='button' class='eliminar btn btn-danger'><i class='far fa-trash-alt'></i></button>"}
        ]
    });
    EliminarRegisTabla('#table_Art_Revista tbody', tabla_art_revista,'#table_Art_Revista');
}

function Tabla_Art_Memoria(tipo) {
    var tabla_art_memoria = $('#table_Art_Memoria').DataTable({
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
            "url":"Perfil/RegisPublicacion",
            "data":{tipo_p:tipo }
        },
        "columns":[
            {"data":"p_tipo_publicacion"},
            {"data":"p_instrumento"},
            {"data":"p_estado_publicacion"},
            {"data":"p_sub_area_especifica"},
            {"data":"p_nombre"},
            {"data":"p_link"},
            {"data":"p_cuidad_evento"},
            {"data":"p_participacion"},
            {"data":"p_fecha"},
            {"defaultContent":"<button type='button' class='eliminar btn btn-danger'><i class='far fa-trash-alt'></i></button>"}
        ]
    });
    EliminarRegisTabla('#table_Art_Memoria tbody', tabla_art_memoria,'#table_Art_Memoria');
}

function ClearIdArchivo(){
    $('#arch_subido_Art_Me').val('');
    $('#arch_subido_Art_Me').prop('disabled',false);
    $('#arch_progr_cient_pb').val('');
    $('#arch_progr_cient_pb').prop('disabled',false);
    if(Id_Archivo_pb > 0){
        $.post('Perfil/EliminarArchivo',{id_fichero:Id_Archivo_pb},function (datos, estado, xhr) {
            if (estado === 'success'){
               console.log('id archivo :'+datos);
            }
        },'json');
        Id_Archivo_pb=0;
    }
    if(Id_Cientifico_pb > 0){
        $.post('Perfil/EliminarArchivo',{id_fichero:Id_Cientifico_pb},function (datos, estado, xhr) {
            if (estado === 'success'){
                console.log('Id_Cientifico_pb :'+datos);
            }
        },'json');
        Id_Cientifico_pb=0;
    }
}


