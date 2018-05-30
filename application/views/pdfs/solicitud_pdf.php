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
    <link rel="stylesheet" href="<?php echo $_SERVER['DOCUMENT_ROOT']; ?>./project/public/css/bootstrap.css">
    <link rel="stylesheet" href="<?php echo $_SERVER['DOCUMENT_ROOT']; ?>./project/public/dist/css/AdminLTE.css">
    <link rel="stylesheet" href="<?php echo $_SERVER['DOCUMENT_ROOT']; ?>./project/public/css/solicitud_pdf.css">
    <title>SOLICITUD || PDF </title>
</head>
<body>
    <div class="footer">
        <div class="row">
            <div class="col-sm-12">
                <hr style=" border: 1px solid #088f06;">
            </div>
        </div>
        <div class="row">
            <div class="col-sm-12">
                <div class="pull-left">
                    <p style="font-size: 9px" class="text-muted">Dir.: Av. Urbina y Che Guevara  E-mail: rrhh@utm.edu.ec   Teléfono: (052)637774 ext. (175)-(119) &nbsp; <b>Generado  por S.T.H  el :</b>  <?= Carbon::now(new DateTimeZone('America/Guayaquil')) ?>, por el  <b> Usuario</b> &nbsp; <?php echo $usuario; ?>  </p>
                </div>
                <div class="pull-right">
                    <span style="font-size:9px" class="badge text-sm"> Pagina: <span style="font-size:9px" class="pagenum text-sm"></span></span>
                </div>
            </div>
        </div>
    </div>
    <div class="container">
        <div class="row">
            <div class="col-sm-12">
                <br>
                <img  src="<?php echo $_SERVER['DOCUMENT_ROOT']; ?>./project/public/img/imagen.jpg"  width="80"  height="80"   class="img-responsive center-block"/>
                <div class="text-right">
                    <h2>UNIVERSIDAD TÉCNICA DE MANABÍ</h2>
                    <h4>Dirección de Administración  de Talento Humano</h4>
                </div>
                <hr style=" border: 1px solid #088f06;">
            </div>
        </div>

        <div class="row">
            <div class="col-md-10 col-md-offset-1">
                <div class="text-center">
                    <h4 class="text-muted text-bold" style="font-size: 14px">SOLICITUD DE CONTRATO</h4>
                </div>
            </div>
        </div>
        <div class="row" style="font-size: 9px">
           <div class="box box-solid box-default">
               <div class="box-header">
                   <h6 class="box-title" style="font-size: 12px">DATOS</h6>
               </div>
               <div class="box-body">
                   <div class="row">
                   <div class="form-group">
                       <div class="col-sm-3">
                           <label class="text-bold">CODIGO SOLICITUD</label>
                           <p><?php echo  utf8_encode($solicitud['codigo']); ?></p>
                       </div>
                   </div>
                   <div class="form-group">
                       <div class="col-sm-3">
                           <label class="text-bold">TIPO SOLICITUD</label>
                           <p><?php echo  utf8_encode($solicitud['tipo_solicitud']); ?></p>
                       </div>
                   </div>
                   <div class="form-group">
                       <div class="col-sm-5">
                           <label class="text-bold">PUESTO / DEDICACION</label>
                           <?php if($solicitud['tipo_solicitud'] === 'DOCENTE') { ?>
                               <p><?php echo  utf8_encode($solicitud['dedicacion']); ?></p>
                           <?php }else{ ?>
                               <p><?php echo  utf8_encode($solicitud['puesto']); ?></p>
                           <?php }?>
                       </div>
                   </div>
                   </div>
                   <div class="row">
                       <div class="form-group">
                           <div class="col-sm-3">
                               <label class="text-bold">OBSERVACION</label>
                               <p><?php echo  utf8_encode($solicitud['observacion']); ?></p>
                           </div>
                       </div>
                       <div class="form-group">
                           <div class="col-sm-3">
                               <label class="text-bold">CEDULA / N° DOCUMENTO</label>
                               <p><?php echo  utf8_encode($solicitud['cedula_aspirante']); ?></p>
                           </div>
                       </div>
                       <div class="form-group">
                           <div class="col-sm-5">
                               <label class="text-bold">ASPIRANTE</label>
                               <p><?php echo  utf8_encode($solicitud['aspirante']); ?></p>
                           </div>
                       </div>
                   </div>
                   <div class="row">
                       <div class="form-group">
                           <div class="col-sm-3">
                               <label class="text-bold">FECHA</label>
                               <p><?php echo  utf8_encode($solicitud['fecha_solicitud']); ?></p>
                           </div>
                       </div>
                       <div class="form-group">
                           <div class="col-sm-3">
                               <label class="text-bold">DEPARTAMENTO</label>
                               <p><?php echo  utf8_encode($solicitud['departamento']); ?></p>
                           </div>
                       </div>
                       <div class="form-group">
                           <div class="col-sm-5">
                               <label class="text-bold">COORDINADOR</label>
                               <p><?php echo  utf8_encode($solicitud['cordinador']); ?></p>
                           </div>
                       </div>
                   </div>
                   <div class="row">
                       <div class="form-group">
                           <div class="col-sm-3">
                               <label class="text-bold">ESTADO</label>
                               <?php if ($solicitud['estado'] === 'P'){?>
                                   <p>PROCESO</p>
                               <?php } else if($solicitud['estado'] === 'A'){?>
                                   <p>ACEPTADA</p>
                               <?php } else if($solicitud['estado'] === 'R'){?>
                                   <p>RECHAZADA</p>
                               <?php } else if($solicitud['estado'] === 'E'){?>
                                   <p>ANULADA</p>
                               <?php }?>
                           </div>
                       </div>
                   </div>
               </div>
           </div>
        </div>
        <div class="row">
            <div class="box box-solid box-default">
                <div class="box-header">
                    <h4 class="box-title" style="font-size: 12px">ESTADO DE PROCESOS</h4>
                </div>
                <div class="box-body">
                    <table class="table sm table-hover table-bordered" style="font-size: 9px">
                        <thead>
                        <tr>
                            <th>
                                PROCESO
                            </th>
                            <th>
                                CÓDIGO
                            </th>
                            <th>
                                USUARIO
                            </th>
                            <th>
                                FECHA
                            </th>
                            <th>
                                HORA
                            </th>
                            <th>
                                OBSERVACIÓN
                            </th>
                            <th>
                                ESTADO
                            </th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php foreach ($proceso as $item): ?>
                            <tr>
                                <td><?php echo $item['proceso'];?></td>
                                <td><?php echo $item['codigo'];?></td>
                                <td><?php echo $item['usuario'];?></td>
                                <td><?php echo $item['fecha'];?></td>
                                <td><?php echo $item['hora'];?></td>
                                <td><?php echo $item['observacion'];?></td>
                                <?php if ($item['estado'] === 'P'){?>
                                   <td><p style="font-size: 9px">PROCESO</p></td>
                                <?php } else if($item['estado'] === 'A'){?>
                                   <td><p style="font-size: 9px">ACEPTADA</p></td>
                                <?php } else if($item['estado'] === 'R'){?>
                                   <td> <p style="font-size: 9px">RECHAZADA</p></td>
                                <?php }?>
                            </tr>
                        <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</body>
</html>