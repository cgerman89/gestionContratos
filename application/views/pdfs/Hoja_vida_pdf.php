<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <link rel="stylesheet" href="<?php base_url()?>public/css/bootstrap.css">
    <title></title>

</head>
<body>

	<div align="center">
  	<h2 align="center"><img src="<?php echo base_url(); ?>public/img/hv.JPG" width="263" height="33"></h2>
  	<p align="center"><img src="<?php echo base_url(); ?>public/img/spansJPG.JPG" width="650" height="1"></p>

		<table class="table small table-bordered" width="100%" border="1" cellspacing="0">
        <tr>
        <th colspan="4" align="center"><h4>INFORMACION PERSONAL</h4></th>
        </tr>
        <tr>
        <th width="22.5%" ><h5>CÉDULA:</h5></th>
        <td colspan="2"><?php foreach ($datos_personales as $row){ print $row['cedula']; }?>  </td>
        <td width="20%" rowspan="9" align="center"><img width="135px" height="155px" src="<?php echo base_url(); ?>cRectorado/foto?id=<?php echo $id; ?>"></td>

        </tr>
        <tr>
        <th><h5>NACIONALIDAD:</h5></th>
        <td colspan="2" width="450"><?php foreach ($datos_personales as $row){ print $row['nacionalidad']; }?> </td>
        </tr>
        <tr>
        <th><h5>APELLIDOS:</h5></th>
        <td colspan="2"><?php foreach ($datos_personales as $row){ print utf8_encode($row['apellidos']); }?> </td>
        </tr>
        <tr>
        <th><h5>NOMBRES:</h5></th>
        <td colspan="2"><?php foreach ($datos_personales as $row){ print utf8_encode($row['nombres']); }?> </td>
        </tr>
        <tr>
        <th><h5>GÉNERO:</h5></th>
        <td colspan="2"><?php foreach ($datos_personales as $row){ print $row['genero']; }?> </td>
        </tr>
        <tr>
        <th><h5>EST. CIVIL:</h5></th>
        <td colspan="2"><?php foreach ($datos_personales as $row){ print $row['estado_civil']; }?> </td>
        </tr>
        <tr>
        <th><h5>FECHA NACIMIENTO:</h5></th>
        <td colspan="2"><?php foreach ($datos_personales as $row){ print $row['fecha_nacimiento']; }?> </td>
        </tr>
        <tr>
        <th><h5>PAÍS NACIMIENTO:</h5></th>
        <td colspan="2"><?php foreach ($datos_personales as $row){ print $row['pais_origen']; }?> </td>
        </tr>
        <tr>
        <th><h5>PROVINCIA NACIM.:</h5></th>
        <td colspan="2"><?php foreach ($datos_personales as $row){ print utf8_encode($row['provincia_origen']); }?> </td>
        </tr>
        <tr>
        <th><h5>CANTÓN NACIM.:</h5></th>
        <td><?php foreach ($datos_personales as $row){ print utf8_encode($row['canton_origen']); }?> </td>
        <th width="23.5%"><h5>EDAD:</h5></th>
        <td><?php foreach ($datos_personales as $row){ print $row['edad']; }?></td>
        </tr>
        <tr>
        <th><h5>PARROQUIA NAC:</h5></th>
        <td><?php foreach ($datos_personales as $row){ print utf8_encode($row['parroquia_origen']); }?> </td>
        <th><h5>ETNIA:</h5></th>
        <td><?php foreach ($datos_personales as $row){ print utf8_encode($row['etnia']); }?></td>
        </tr>
        <tr>
        <th><h5>DISCAPACIDAD:</h5></th>
        <td><?php foreach ($datos_personales as $row){ print $row['discapacidad']; }?> </td>
        <th><h5>TIPO SANGRE:</h5></th>
        <td><?php foreach ($datos_personales as $row){ print $row['tipo_sangre']; }?></td>
        </tr>
        
        </table>

        <p align="center"><img src="<?php echo base_url(); ?>public/img/spansJPG.JPG" width="650" height="1"></p>
        
	  <table class="table small table-bordered" width="100%" border="1" cellspacing="0">
		<tr>
            <th colspan="4" align="center"><h4>INFORMACION DOMICILIARIA</h4></th>
        </tr>
        <tr>
            <th width="22.5%"><h5>PAÍS:</h5></th>
            <td width="29%"><?php foreach ($datos_personales as $row){ print $row['pais_residencia']; }?></td>
            <th width="20%"><label>PROVINCIA:</label></th>
            <td><?php foreach ($datos_personales as $row){ print utf8_encode($row['provincia_residencia']); }?></td>
        </tr>
          <tr>
            <th><h5>CANTÓN:</h5></th>
            <td><?php foreach ($datos_personales as $row){ print utf8_encode($row['canton_residencia']); }?></td>
            <th><h5>PARROQUIA:</h5></th>
            <td><?php foreach ($datos_personales as $row){ print utf8_encode($row['parroquia_residencia']); }?></td>
          </tr>
          <tr>
            <th><h5>CALLE PRINCIPAL:</h5></th>
            <td colspan="3"><?php foreach ($datos_personales as $row){ print utf8_encode($row['calle1']); }?></td>
          </tr>
          <tr>
            <th><h5>CALLE SEC. 1:</h5></th>
            <td colspan="3"><?php foreach ($datos_personales as $row){ print utf8_encode($row['calle2']); }?></td>
          </tr>
          <tr>
            <th><h5>CALLE SEC.2:</h5></th>
            <td colspan="3"><?php foreach ($datos_personales as $row){ print utf8_encode($row['calle3']); }?></td>
          </tr>
          <tr>
            <th><h5>REFERENCIA:</h5></th>
            <td colspan="3"><?php foreach ($datos_personales as $row){ print utf8_encode($row['referencia']); }?></td>
          </tr>
          <tr>
            <th><h5>TELEF. DOMICILIO:</h5></th>
            <td><?php foreach ($datos_personales as $row){ print $row['telefono_domicilio']; }?></td>
            <th><h5>TELEF. CELULAR:</h5></th>
            <td><?php foreach ($datos_personales as $row){ print $row['celular']; }?></td>
          </tr>
          <tr>
            <th><h5>TELEF. TRABAJO:</h5></th>
            <td><?php foreach ($datos_personales as $row){ print $row['telefono_trabajo']; }?></td>
            <th><h5>EXTENSIÓN:</h5></th>
            <td><?php foreach ($datos_personales as $row){ print $row['extension_telf']; }?></td>
          </tr>
          <tr>
            <th><h5>CORREO INSTITUC.:</h5></th>
            <td><?php foreach ($datos_personales as $row){ print utf8_encode($row['correo_institucional']); }?></td>
            <th><h5>CORREO ALTERN.:</h5></th>
            <td><?php foreach ($datos_personales as $row){ print utf8_encode($row['correo_alternativo']); }?></td>
          </tr>
      </table>
      
      <p align="center"><img src="<?php echo base_url(); ?>public/img/spansJPG.JPG" width="650" height="1"></p>

        <?php foreach($instruccion_formal as $row) { ?>
        <table class="table table-bordered" width="100%" border="1" cellspacing="0">

          <tr>
            <th colspan="4" align="center"><h4>INSTRUCCIÓN FORMAL</h4></th>
          </tr>
          <tr>
            <th width="22.5%"><h5>NIVEL DE INSTRUCC:</h5></th>
            <td colspan="3"><?php print utf8_encode($row['nivel_instruccion']);  ?></td>
          </tr>
          <tr>
            <th><h5>UNIVERSIDAD:</h5></th>
            <td colspan="3"><?php print utf8_encode($row['universidad']);  ?></td>
          </tr>
          <tr>
            <th><h5>ÁREA DE CONOCIM.:</h5></th>
            <td colspan="3"><?php print utf8_encode($row['area_conocimiento']);  ?></td>
          </tr>
          <tr>
            <th><h5>SUB-ÁREA:</h5></th>
            <td><?php print utf8_encode($row['sub_area']);  ?></td>
            <th width="15%"><h5>ESPECÍFICA:</h5></th>
            <td width="25%"><?php print utf8_encode($row['especifica']);  ?></td>
          </tr>
          <tr>
            <th><h5>TÍTULO OBTENIDO:</h5></th>
            <td><?php print utf8_encode($row['titulo']);  ?></td>
            <th><h5>SENESCYT:</h5></th>
            <td><?php print $row['senescyt'];  ?></td>
          </tr>
          <tr>
            <th><h5>FECHA INICIO:</h5></th>
            <td><?php print $row['fecha_inicio'];  ?></td>
            <th><h5>TITULACIÓN:</h5></th>
            <td><?php print $row['fecha_titulacion'];  ?></td>
          </tr>
        </table>
        <?php } ?>
		
        <p align="center"><img src="<?php echo base_url(); ?>public/img/spansJPG.JPG" width="650" height="1"></p>
        
      <table class="table table-bordered" width="100%" border="1" cellspacing="0">
          <tr>
            <th colspan="6" align="center"><h4>CAPACITACIONES</h4></th>
          </tr>
          <tr align="center">
            <th width="30px"><h5><center>N.</center></h5></th>
            <th width="350px"><h5><center>EVENTO</center></h5></th>
            <th width="100px"><h5><center>TIPO</center></h5></th>
            <th width="100px"><h5><center>
            PAÍS
            </center></h5></th>
            <th width="80px"><h5><center>F. INICIO</center></h5></th>
            <th width="80px"><h5><center>F.FIN</center></h5></th>
          </tr>

          <?php $counter=1; foreach($capacitaciones as $row) { ?>
          <tr>
            <td align="center"><?php echo $counter; ?></td>
            <td align="center"><?php print utf8_encode($row['nombre_evento']);  ?></td>
            <td align="center"><?php print utf8_encode($row['tipo_capacitacion']);  ?></td>
            <td align="center"><?php print utf8_encode($row['pais']);  ?></td>
            <td align="center"><?php print $row['fecha_inicio'];  ?></td>
            <td align="center"><?php print $row['fecha_final'];  ?></td>
          </tr>

          <?php $counter ++; } ?>



        </table>
        
        <p align="center"><img src="<?php echo base_url(); ?>public/img/spansJPG.JPG" width="650" height="1"></p>

        <table class="table table-bordered" width="100%" border="1" cellspacing="0">
          <tr>
            <th colspan="6" align="center"><h4>EXPERIENCIA PROFESIONAL</h4></th>
          </tr>
          <tr align="center">
            <th width="30px"><h5><center>N.</center></h5></th>
            <th width="300px"><h5><center>
            INSTITUCIÓN
            </center></h5></th>
            <th width="150px"><h5><center>CARGO</center></h5></th>
            <th width="100px"><h5><center>
                  ÁREA
            </center></h5></th>
            <th width="80px"><h5><center>F. INICIO</center></h5></th>
            <th width="80px"><h5><center>F.FIN</center></h5></th>
          </tr>

          <?php $counter=1; foreach($experiencia as $row) { ?>
          <tr>
            <td align="center"><?php echo $counter; ?></td>
            <td align="center"><?php print utf8_encode($row['nombre_institucion']);  ?></td>
            <td align="center"><?php print utf8_encode($row['nombre_puesto']);  ?></td>
            <td align="center"><?php print utf8_encode($row['area_conocimiento']);  ?></td>
            <td align="center"><?php print $row['fecha_inicio'];  ?></td>
            <td align="center"><?php print $row['fecha_final'];  ?></td>
          </tr>

          <?php $counter ++; } ?>

      </table>
        
        <p align="center"><img src="<?php echo base_url(); ?>public/img/spansJPG.JPG" width="650" height="1"></p>

        <table class="table table-bordered" width="100%" border="1" cellspacing="0">
          <tr>
            <th colspan="6" align="center"><h4>PUBLICACIONES</h4></th>
          </tr>
          <tr align="center">
            <th width="30px"><h5><center>N.</center></h5></th>
            <th width="150px"><h5><center>TIPO PUBLICACION</center></h5></th>
            <th width="150px"><h5><center>INSTRUMENTO</center></h5></th>
            <th width="200px"><h5><center>NOMBRE PUBL.</center></h5></th>
            <th width="100px"><h5><center>CIUDAD</center></h5></th>
            <th width="100px"><h5><center>FECHA</center></h5></th>
          </tr>

          <?php $counter=1; foreach($publicaciones as $row) { ?>
          <tr>
            <td align="center"><?php echo $counter; ?></td>
            <td align="center"><?php print utf8_encode($row['tipo_publicacion']);  ?></td>
            <td align="center"><?php print utf8_encode($row['instrumento_publicacion']);  ?></td>
            <td align="center"><?php print utf8_encode($row['nombre']);  ?></td>
            <td align="center"><?php print utf8_encode($row['ciudad']);  ?></td>
            <td align="center"><?php print $row['fecha'];  ?></td>
          </tr>

          <?php $counter ++; } ?>

        </table>
        <?php
        $dias = array("Domingo","Lunes","Martes","Miercoles","Jueves","Viernes","Sábado");
        $meses = array("Enero","Febrero","Marzo","Abril","Mayo","Junio","Julio","Agosto","Septiembre","Octubre","Noviembre","Diciembre");
        ?>
        <div>
            <h6 align="right"><?php echo $dias[date('w')]." ".date('d')." de ".$meses[date('n')-1]. " del ".date('Y') ;?></h6>
        </div>

    </div>

</body>
</html>