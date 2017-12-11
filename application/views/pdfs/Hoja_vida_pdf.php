<!DOCTYPE html>
<html>
<head>
<title>Hoja de Vida</title>

</head>
<body>
	<div align="center">
    <table width="100%" border="0" cellspacing="0">
  <tr>
    <td width="27%" rowspan="5" align="center"><img src="<?php echo base_url(); ?>public/img/imagen.jpg" width="118" height="110" /></td>
    <td height="24" colspan="2">&nbsp;</td>
  </tr>
  <tr>
    <td width="0%" height="30" align="right" valign="bottom"><p align="right">&nbsp;</p></td>
    <td width="73%" height="30" align="right" valign="bottom"><h2><strong>UNIVERSIDAD TÉCNICA DE MANABÍ</strong></h2></td>
  </tr>
  <tr>
    <td height="17" rowspan="3" valign="top"><p align="right">&nbsp;</p></td>
    <td height="8" align="right" valign="top"><span class="h5"><strong>Dirección de Administración de Talento Humano</strong></span></td>
  </tr>
  <tr>
    <td height="9" align="right" valign="top"><strong>Hoja de Vida SGC</strong></td>
  </tr>
  <tr>
    <td height="9" align="right" valign="top"><img src="<?php echo base_url(); ?>public/img/spansJPG.JPG" width="495" height="5" /></td>
  </tr>
</table>
  	<p class="spacer">&nbsp;</p>
  	<table width="100%" cellpadding="3" border="0" cellspacing="2">
      <tr>
        <th colspan="4" align="center" bgcolor="#006600" class="texto"><h4>INFORMACIÓN PERSONAL</h4></th>
        </tr>
        <tr>
        <th width="22.5%" bgcolor="#888888" class="textos" ><h5>CÉDULA:</h5></th>
        <td colspan="2" class="datos" bgcolor="#CCCCCC"><?php foreach ($datos_personales as $row){ print $row['cedula']; }?>  </td>
        <th width="20%" rowspan="9" align="center" bgcolor="#CCCCCC"><img width="135px" height="154px" src="<?php echo base_url(); ?>cRectorado/foto?id=<?php echo $id; ?>"></th>

        </tr>
        <tr>
        <th bgcolor="#888888" class="textos"><h5>NACIONALIDAD:</h5></th>
        <td width="450" class="datos" colspan="2" bgcolor="#CCCCCC"><?php foreach ($datos_personales as $row){ print $row['nacionalidad']; }?> </td>
        </tr>
        <tr>
        <th bgcolor="#888888" class="textos"><h5>APELLIDOS:</h5></th>
        <td colspan="2" class="datos" bgcolor="#CCCCCC"><?php foreach ($datos_personales as $row){ print utf8_encode($row['apellidos']); }?> </td>
        </tr>
        <tr>
        <th bgcolor="#888888" class="textos"><h5>NOMBRES:</h5></th>
        <td colspan="2" class="datos" bgcolor="#CCCCCC"><?php foreach ($datos_personales as $row){ print utf8_encode($row['nombres']); }?> </td>
        </tr>
        <tr>
        <th bgcolor="#888888" class="textos"><h5>GÉNERO:</h5></th>
        <td colspan="2" class="datos" bgcolor="#CCCCCC"><?php foreach ($datos_personales as $row){ print $row['genero']; }?> </td>
        </tr>
        <tr>
        <th bgcolor="#888888" class="textos"><h5>EST. CIVIL:</h5></th>
        <td colspan="2" class="datos" bgcolor="#CCCCCC"><?php foreach ($datos_personales as $row){ print $row['estado_civil']; }?> </td>
        </tr>
        <tr>
        <th bgcolor="#888888" class="textos"><h5>FECHA NACIMIENTO:</h5></th>
        <td colspan="2" class="datos" bgcolor="#CCCCCC"><?php foreach ($datos_personales as $row){ print $row['fecha_nacimiento']; }?> </td>
        </tr>
        <tr>
        <th bgcolor="#888888" class="textos"><h5>PAÍS NACIMIENTO:</h5></th>
        <td colspan="2" class="datos" bgcolor="#CCCCCC"><?php foreach ($datos_personales as $row){ print $row['pais_origen']; }?> </td>
        </tr>
        <tr>
        <th bgcolor="#888888" class="textos"><h5>PROVINCIA NACIM.:</h5></th>
        <td colspan="2" class="datos" bgcolor="#CCCCCC"><?php foreach ($datos_personales as $row){ print utf8_encode($row['provincia_origen']); }?> </td>
        </tr>
        <tr>
        <th bgcolor="#888888" class="textos"><h5>CANTÓN NACIM.:</h5></th>
        <td bgcolor="#CCCCCC" class="datos"><?php foreach ($datos_personales as $row){ print utf8_encode($row['canton_origen']); }?> </td>
        <th width="23.5%" bgcolor="#888888" class="textos"><h5>EDAD:</h5></th>
        <td bgcolor="#CCCCCC" class="datos"><?php foreach ($datos_personales as $row){ print $row['edad']; }?></td>
        </tr>
        <tr>
        <th bgcolor="#888888" class="textos"><h5>PARROQUIA NAC:</h5></th>
        <td bgcolor="#CCCCCC" class="datos"><?php foreach ($datos_personales as $row){ print utf8_encode($row['parroquia_origen']); }?> </td>
        <th bgcolor="#888888" class="textos"><h5>ETNIA:</h5></th>
        <td bgcolor="#CCCCCC" class="datos"><?php foreach ($datos_personales as $row){ print utf8_encode($row['etnia']); }?></td>
        </tr>
        <tr>
        <th bgcolor="#888888" class="textos"><h5>DISCAPACIDAD:</h5></th>
        <td bgcolor="#CCCCCC" class="datos"><?php foreach ($datos_personales as $row){ print $row['discapacidad']; }?> </td>
        <th bgcolor="#888888" class="textos"><h5>TIPO SANGRE:</h5></th>
        <td bgcolor="#CCCCCC" class="datos"><?php foreach ($datos_personales as $row){ print $row['tipo_sangre']; }?></td>
        </tr>
        
        </table>
        
        <p align="center" class="spacer" >&nbsp;</p>


        
	  <table width="100%" cellpadding="3" border="0" cellspacing="2" >
		<tr>
            <th colspan="4" align="center" class="texto" bgcolor="#006600"><h4>INFORMACIÓN DOMICILIARIA</h4></th>
        </tr>
        <tr>
            <th width="22.5%" class="textos" bgcolor="#888888"><h5>PAÍS:</h5></th>
            <td width="29%" bgcolor="#CCCCCC" class="datos"><?php foreach ($datos_personales as $row){ print $row['pais_residencia']; }?></td>
            <th width="20%" class="textos" bgcolor="#888888"><h5>PROVINCIA:</h5></th>
            <td bgcolor="#CCCCCC" class="datos"><?php foreach ($datos_personales as $row){ print utf8_encode($row['provincia_residencia']); }?></td>
        </tr>
          <tr>
            <th bgcolor="#888888" class="textos"><h5>CANTÓN:</h5></th>
            <td bgcolor="#CCCCCC" class="datos"><?php foreach ($datos_personales as $row){ print utf8_encode($row['canton_residencia']); }?></td>
            <th bgcolor="#888888" class="textos"><h5>PARROQUIA:</h5></th>
            <td bgcolor="#CCCCCC" class="datos"><?php foreach ($datos_personales as $row){ print utf8_encode($row['parroquia_residencia']); }?></td>
          </tr>
          <tr>
            <th bgcolor="#888888" class="textos"><h5>CALLE PRINCIPAL:</h5></th>
            <td colspan="3" bgcolor="#CCCCCC" class="datos"><?php foreach ($datos_personales as $row){ print utf8_encode($row['calle1']); }?></td>
          </tr>
          <tr>
            <th bgcolor="#888888" class="textos"><h5>CALLE SEC. 1:</h5></th>
            <td colspan="3" bgcolor="#CCCCCC" class="datos"><?php foreach ($datos_personales as $row){ print utf8_encode($row['calle2']); }?></td>
          </tr>
          <tr>
            <th bgcolor="#888888" class="textos"><h5>CALLE SEC.2:</h5></th>
            <td colspan="3" bgcolor="#CCCCCC" class="datos"><?php foreach ($datos_personales as $row){ print utf8_encode($row['calle3']); }?></td>
          </tr>
          <tr>
            <th bgcolor="#888888" class="textos"><h5>REFERENCIA:</h5></th>
            <td colspan="3" bgcolor="#CCCCCC" class="datos"><?php foreach ($datos_personales as $row){ print utf8_encode($row['referencia']); }?></td>
          </tr>
          <tr>
            <th bgcolor="#888888" class="textos"><h5>TELEF. DOMICILIO:</h5></th>
            <td bgcolor="#CCCCCC" class="datos"><?php foreach ($datos_personales as $row){ print $row['telefono_domicilio']; }?></td>
            <th bgcolor="#888888" class="textos"><h5>TELEF. CELULAR:</h5></th>
            <td bgcolor="#CCCCCC" class="datos"><?php foreach ($datos_personales as $row){ print $row['celular']; }?></td>
          </tr>
          <tr>
            <th bgcolor="#888888" class="textos"><h5>TELEF. TRABAJO:</h5></th>
            <td bgcolor="#CCCCCC" class="datos"><?php foreach ($datos_personales as $row){ print $row['telefono_trabajo']; }?></td>
            <th bgcolor="#888888" class="textos"><h5>EXTENSIÓN:</h5></th>
            <td bgcolor="#CCCCCC" class="datos"><?php foreach ($datos_personales as $row){ print $row['extension_telf']; }?></td>
          </tr>
          <tr>
            <th bgcolor="#888888" class="textos"><h5>CORREO INSTITUC.:</h5></th>
            <td bgcolor="#CCCCCC" class="datos"><?php foreach ($datos_personales as $row){ print utf8_encode($row['correo_institucional']); }?></td>
            <th bgcolor="#888888" class="textos"><h5>CORREO ALTERN.:</h5></th>
            <td bgcolor="#CCCCCC" class="datos"><?php foreach ($datos_personales as $row){ print utf8_encode($row['correo_alternativo']); }?></td>
          </tr>
      </table>
      
      <p align="center" class="spacer">&nbsp;</p>

        <?php foreach($instruccion_formal as $row) { ?>
        <table width="100%" cellpadding="3" border="0" cellspacing="2">

          <tr>
            <th colspan="4" align="center" class="texto" bgcolor="#006600"><h4>INSTRUCCIÓN FORMAL</h4></th>
          </tr>
          <tr>
            <th width="22.5%" bgcolor="#888888" class="textos"><h5>NIVEL DE INSTRUCC:</h5></th>
            <td colspan="3" bgcolor="#CCCCCC" class="datos"><?php print utf8_encode($row['nivel_instruccion']);  ?></td>
          </tr>
          <tr>
            <th bgcolor="#888888" class="textos"><h5>UNIVERSIDAD:</h5></th>
            <td colspan="3" bgcolor="#CCCCCC" class="datos"><?php print utf8_encode($row['universidad']);  ?></td>
          </tr>
          <tr>
            <th bgcolor="#888888" class="textos"><h5>ÁREA DE CONOCIM.:</h5></th>
            <td colspan="3" bgcolor="#CCCCCC" class="datos"><?php print utf8_encode($row['area_conocimiento']);  ?></td>
          </tr>
          <tr>
            <th bgcolor="#888888" class="textos"><h5>SUB-ÁREA:</h5></th>
            <td bgcolor="#CCCCCC" class="datos"><?php print utf8_encode($row['sub_area']);  ?></td>
            <th width="15%" bgcolor="#888888" class="textos"><h5>ESPECÍFICA:</h5></th>
            <td width="25%" bgcolor="#CCCCCC" class="datos"><?php print utf8_encode($row['especifica']);  ?></td>
          </tr>
          <tr>
            <th bgcolor="#888888" class="textos"><h5>TÍTULO OBTENIDO:</h5></th>
            <td bgcolor="#CCCCCC" class="datos"><?php print utf8_encode($row['titulo']);  ?></td>
            <th bgcolor="#888888" class="textos"><h5>SENESCYT:</h5></th>
            <td bgcolor="#CCCCCC" class="datos"><?php print $row['senescyt'];  ?></td>
          </tr>
          <tr>
            <th bgcolor="#888888" class="textos"><h5>FECHA INICIO:</h5></th>
            <td bgcolor="#CCCCCC" class="datos"><?php print $row['fecha_inicio'];  ?></td>
            <th bgcolor="#888888" class="textos"><h5>TITULACIÓN:</h5></th>
            <td bgcolor="#CCCCCC" class="datos"><?php print $row['fecha_titulacion'];  ?></td>
          </tr>
        </table>
        <p align="center" class="spacer">&nbsp;</p>
        <?php } ?>
		
      
        
      <table width="100%" cellpadding="3" border="0" cellspacing="2">
          <tr>
            <th colspan="6" align="center" class="texto" bgcolor="#006600"><h4>CAPACITACIONES</h4></th>
          </tr>
          <tr align="center">
            <th width="30px" bgcolor="#888888" class="textos"><h5><center>N.</center></h5></th>
            <th width="350px" bgcolor="#888888" class="textos"><h5><center>EVENTO</center></h5></th>
            <th width="100px" bgcolor="#888888" class="textos"><h5><center>TIPO</center></h5></th>
            <th width="100px" bgcolor="#888888" class="textos"><h5><center>
            PAÍS
            </center></h5></th>
            <th width="80px" bgcolor="#888888" class="textos"><h5><center>F. INICIO</center></h5></th>
            <th width="80px" bgcolor="#888888" class="textos"><h5><center>F.FIN</center></h5></th>
          </tr>

          <?php $counter=1; foreach($capacitaciones as $row) { ?>
          <tr>
            <td align="center" bgcolor="#CCCCCC" class="datos"><?php echo $counter; ?></td>
            <td align="center" bgcolor="#CCCCCC" class="datos"><?php print utf8_encode($row['nombre_evento']);  ?></td>
            <td align="center" bgcolor="#CCCCCC" class="datos"><?php print utf8_encode($row['tipo_capacitacion']);  ?></td>
            <td align="center" bgcolor="#CCCCCC" class="datos"><?php print utf8_encode($row['pais']);  ?></td>
            <td align="center" bgcolor="#CCCCCC" class="datos"><?php print $row['fecha_inicio'];  ?></td>
            <td align="center" bgcolor="#CCCCCC" class="datos"><?php print $row['fecha_final'];  ?></td>
          </tr>

          <?php $counter ++; } ?>



      </table>
        
        <p align="center" class="spacer">&nbsp;</p>

        <table width="100%" cellpadding="3" border="0" cellspacing="2">
          <tr>
            <th colspan="6" class="texto" align="center" bgcolor="#006600"><h4>EXPERIENCIA PROFESIONAL</h4></th>
          </tr>
          <tr align="center">
            <th width="30px" bgcolor="#888888" class="textos"><h5><center>N.</center></h5></th>
            <th width="300px" bgcolor="#888888" class="textos"><h5><center>
            INSTITUCIÓN
            </center></h5></th>
            <th width="150px" bgcolor="#888888" class="textos"><h5><center>CARGO</center></h5></th>
            <th width="100px" bgcolor="#888888" class="textos"><h5><center>
                  ÁREA
            </center></h5></th>
            <th width="80px" bgcolor="#888888" class="textos"><h5><center>F. INICIO</center></h5></th>
            <th width="80px" bgcolor="#888888" class="textos"><h5><center>F.FIN</center></h5></th>
          </tr>

          <?php $counter=1; foreach($experiencia as $row) { ?>
          <tr>
            <td align="center" bgcolor="#CCCCCC" class="datos"><?php echo $counter; ?></td>
            <td align="center" bgcolor="#CCCCCC" class="datos"><?php print utf8_encode($row['nombre_institucion']);  ?></td>
            <td align="center" bgcolor="#CCCCCC" class="datos"><?php print utf8_encode($row['nombre_puesto']);  ?></td>
            <td align="center" bgcolor="#CCCCCC" class="datos"><?php print utf8_encode($row['area_conocimiento']);  ?></td>
            <td align="center" bgcolor="#CCCCCC" class="datos"><?php print $row['fecha_inicio'];  ?></td>
            <td align="center" bgcolor="#CCCCCC" class="datos"><?php print $row['fecha_final'];  ?></td>
          </tr>

          <?php $counter ++; } ?>

      </table>
        
        <p align="center" class="spacer">&nbsp;</p>

        <table width="100%" cellpadding="3" border="0" cellspacing="2">
          <tr>
            <th colspan="6" class="texto" align="center" bgcolor="#006600"><h4>PUBLICACIONES</h4></th>
          </tr>
          <tr align="center">
            <th width="30px" bgcolor="#888888" class="textos"><h5><center>N.</center></h5></th>
            <th width="150px" bgcolor="#888888" class="textos"><h5><center>TIPO PUBLICACION</center></h5></th>
            <th width="150px" bgcolor="#888888" class="textos"><h5><center>INSTRUMENTO</center></h5></th>
            <th width="200px" bgcolor="#888888" class="textos"><h5><center>NOMBRE PUBL.</center></h5></th>
            <th width="100px" bgcolor="#888888" class="textos"><h5><center>CIUDAD</center></h5></th>
            <th width="100px" bgcolor="#888888" class="textos"><h5><center>FECHA</center></h5></th>
          </tr>

          <?php $counter=1; foreach($publicaciones as $row) { ?>
          <tr>
            <td align="center" bgcolor="#CCCCCC" class="datos"><?php echo $counter; ?></td>
            <td align="center" bgcolor="#CCCCCC" class="datos"><?php print utf8_encode($row['tipo_publicacion']);  ?></td>
            <td align="center" bgcolor="#CCCCCC" class="datos"><?php print utf8_encode($row['instrumento_publicacion']);  ?></td>
            <td align="center" bgcolor="#CCCCCC" class="datos"><?php print utf8_encode($row['nombre']);  ?></td>
            <td align="center" bgcolor="#CCCCCC" class="datos"><?php print utf8_encode($row['ciudad']);  ?></td>
            <td align="center" bgcolor="#CCCCCC" class="datos"><?php print $row['fecha'];  ?></td>
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