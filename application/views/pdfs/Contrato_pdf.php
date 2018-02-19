<?php
use  Carbon\Carbon;
?>
<!doctype html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <!-- Latest compiled and minified CSS -->
    <link rel="stylesheet" href="<?php echo $_SERVER['DOCUMENT_ROOT']; ?>./project/public/css/bootstrap.css">
    <link rel="stylesheet" href="<?php echo $_SERVER['DOCUMENT_ROOT']; ?>./project/public/dist/css/AdminLTE.min.css">
    <link rel="stylesheet" href="<?php echo $_SERVER['DOCUMENT_ROOT']; ?>./project/public/css/contrato.css">
    <title>CONTRATO || PDF </title>

</head>
<body>
    <div class="footer">
        <div class="row">
        <div class="col-sm-9">
            <hr style=" border: 1px solid #088f06;">
        </div>
    </div>
    <div class="row">
        <div class="col-sm-8">
            <div class="pull-left">
                <p style="font-size: 9px" class="text-muted">Dir.: Av. Urbina y Che Guevara  E-mail: rrhh@utm.edu.ec   Teléfono: (052)637774 ext. (175)-(119) &nbsp; <b>Generado  por S.G.C  el :</b>  <?= Carbon::now(new DateTimeZone('America/Guayaquil')) ?> </p>

            </div>
        </div>
        <div class="col-sm-4">
            <div class="pull-right">
                <span style="font-size:9px" class="badge text-sm"> Pagina: <span style="font-size:9px" class="pagenum text-sm"></span></span>
            </div>
        </div>
    </div>
</div>
  <section>
      <div class="container">
          <div class="row">
              <div class="col-md-3">
                  <br>
                  <img  src="<?php echo $_SERVER['DOCUMENT_ROOT']; ?>./project/public/img/imagen.jpg"  width="80"  height="80"   class="img-responsive center-block"/>
              </div>
              <div class="col-md-9">
                  <div class="text-right">
                      <h2>UNIVERSIDAD TÉCNICA DE MANABÍ</h2>
                      <h4>Dirección de Administración  de Talento Humano</h4>
                      <hr style=" border: 2px solid #088f06;">
                      <?php foreach ($contrato as $dato) {?>
                      <p class="badge text-sm"> <?php echo $dato['codigo']." - ".$dato['p_abrevia'] ;?> </p>
                      <?php }?>
                  </div>
              </div>
          </div>
          <div class="row">
              <div class="col-md-10 col-md-offset-2">
                  <div class="text-center">
                      <h4 class="text-muted text-bold">CONTRATO DE SERVICIOS OCASIONALES</h4>
                  </div>
                  <div class=" text-center text-justify">
                      <?php
                        foreach ($contrato as $dato) {
                           if (!empty($textos) == true) {
                                foreach ($textos as $texto) {
                                    echo str_ireplace(['{aspirante}', '{titulo}','{solicitud_codigo}','{fecha_solicitud}'], [ $dato['aspirante'], $dato['titulo'], $dato['codigo_solicitud'], $dato['fecha_solicitud'] ], $texto['texto']);
                                }
                           }
                        }
                      ?>
                  </div>
              </div>
          </div>
      </div>
  </section>

</body>
</html>
