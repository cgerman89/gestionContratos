<div class="row">
    <div class="col-xs-12">
        <div class="nav-tabs-justified">
            <ul class="nav nav-tabs bg-gray-light">
                <li role="presentation" class="active" >
                    <a href="#info_personal" data-toggle="tab" class="fa fa-user fa-2x" title="Informacion Personal"></a>
                </li>
                <li role="presentation">
                    <a href="#info_domicilio" data-toggle="tab" class="fa fa-map-marker fa-2x" title="Domicilio"></a>
                </li>
                <li role="presentation">
                    <a href="#inst_formal" data-toggle="tab" class="fa  fa-mortar-board fa-2x" title="Instruccion Formal"></a>
                </li>
                <li role="presentation">
                    <a href="#Capacitacion" data-toggle="tab" class="fa fa-book fa-2x" title="Capacitaciones"></a>
                </li>
                <li role="presentation">
                    <a href="#exp_profesional" data-toggle="tab" class="fa fa-briefcase fa-2x" title="experiencia profesional"></a>
                </li>
                <li role="presentation">
                    <a href="#publicacion" data-toggle="tab" class="fa fa-file-text fa-2x" title="publicaciones"></a>
                </li>
                <li role="presentation">
                    <a href="#banco" data-toggle="tab" class="fa fa-bank fa-2x" title="cuenta bancaria"></a>
                </li>
                <li role="presentation">
                    <a href="#discapacidad" data-toggle="tab" class="fa fa-wheelchair fa-2x" title="Discapacidad"></a>
                </li>

            </ul>
            <div class="tab-content">
                <div id="info_personal" role="tabpanel" class="tab-pane fade in active">
                    <div class="box box-primary">
                        <div class="box box-header">
                             <div class="col-sm-4">
                                 <button type="submit" name="btn_save_per" id="btn_save_per" class="btn btn-primary"><i class="fa fa-floppy-o"></i> Guardar</button>
                             </div>
                        </div>
                        <div class="box-body">
                            <form id="form_info_per" class="small" data-smk-icon="glyphicon glyphicon-remove">
                                <div class="col-sm-4">
                                    <label for="n_documento_per" class="control-label">N° Documento</label>
                                    <div class="form-group">
                                        <input type="text" name="n_documento_per" id="n_documento_per" data-smk-type="number" minlength="10" class="form-control" placeholder="N° Documento" required>
                                    </div>
                                </div>
                                <div class="col-sm-4">
                                    <label for="nacionalidad_per" class="control-label">Nacionalidad</label>
                                    <div class="form-group">
                                        <select name="nacionalidad_per" id="nacionalidad_per" class="form-control" required>
                                            <option value="">seleccione</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-sm-4">
                                    <label for="apellido1" class="control-label">Apellido1</label>
                                    <div class="form-group">
                                        <input type="text" name="apellido1" id="apellido1" class="form-control" placeholder="Apellido 1"  required>
                                    </div>
                                </div>
                                <div class="col-sm-4">
                                    <label for="apellido2" class="control-label">Apellido 2</label>
                                    <div class="form-group">
                                        <input type="text" name="apellido2" id="apellido2" class="form-control" placeholder="Apellido 2"  required>
                                    </div>
                                </div>
                                <div class="col-sm-4">
                                    <label for="nombres" class="control-label">Nombres</label>
                                    <div class="form-group">
                                        <input type="text" name="nombres" id="nombres" class="form-control" placeholder="Nombres"  required>
                                    </div>
                                </div>
                                <div class="col-sm-4">
                                    <label for="">F.Nacimiento</label>
                                    <div class="form-group">
                                        <input type="text" id="fnacimiento" name="fnacimiento" class="form-control" placeholder="yyy-mm-dd" required>
                                    </div>
                                </div>
                                <div class="col-sm-4">
                                    <label for="sexo_per" class="control-label">Sexo</label>
                                    <div class="form-group">
                                        <select name="sexo_per" id="sexo_per" class="form-control" required>
                                            <option value="">seleccione</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-sm-4">
                                    <label for="e_civil_per" class="control-label">Estado Civil</label>
                                    <div class="form-group">
                                        <select name="e_civil_per" id="e_civil_per" class="form-control" required>
                                            <option value="">seleccione</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-sm-4">
                                    <label for="t_sangre_per" class="control-label">Tipo de Sangre</label>
                                    <div class="form-group">
                                        <select name="t_sangre_per" id="t_sangre_per" class="form-control" required>
                                            <option value="">seleccione</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-sm-4">
                                    <label for="etnia_per" class="control-label">Étnia</label>
                                    <div class="form-group">
                                        <select name="etnia_per" id="etnia_per" class="form-control" required>
                                            <option value="">seleccione</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-sm-4">
                                    <label for="pais_per" class="control-label">Pais Origen</label>
                                    <div class="form-group">
                                        <select name="pais_per" id="pais_per" class="form-control" required>
                                            <option value="">seleccione</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-sm-4">
                                    <label for="provincia_per" class="control-label">Provincia Origen</label>
                                    <div class="form-group">
                                        <select name="provincia_per" id="provincia_per" class="form-control" required>
                                            <option value="">seleccione</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-sm-4">
                                    <label for="canton_per" class="control-label">Cantón Origen</label>
                                    <div class="form-group">
                                        <select name="canton_per" id="canton_per" class="form-control" required>
                                            <option value="">seleccione</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-sm-4">
                                    <label for="parroquia_per" class="control-label">Parroquia Origen</label>
                                    <div class="form-group">
                                        <select name="parroquia_per" id="parroquia_per" class="form-control" required>
                                            <option value="">seleccione</option>
                                        </select>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
                <div id="info_domicilio" role="tabpanel" class="tab-pane fade">
                    <div class="box box-primary">
                        <div class="box box-header">
                            <div class="col-sm-4">
                                <button type="submit" name="btn_save_domi" id="btn_save_domi" class="btn btn-primary"><i class="fa fa-floppy-o"></i> Guardar</button>
                            </div>
                        </div>
                        <div class="box-body">
                            <form id="form_domicilio" class="small" role="form" data-smk-icon="glyphicon glyphicon-remove">
                                <div class="col-sm-4">
                                    <label for="pais_domi" class="control-label">Pais Residencia</label>
                                    <div class="form-group">
                                        <select name="pais_domi" id="pais_domi" class="form-control" required>
                                            <option value="">seleccione</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-sm-4">
                                    <label for="provincia_domi" class="control-label">Provincia Residencia</label>
                                    <div class="form-group">
                                        <select name="provincia_domi" id="provincia_domi" class="form-control" required>
                                            <option value="">seleccione</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-sm-4">
                                    <label for="canton_domi" class="control-label">Cantón Residencia</label>
                                    <div class="form-group">
                                        <select name="canton_domi" id="canton_domi" class="form-control" required>
                                            <option value="">seleccione</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-sm-4">
                                    <label for="parroquia_domi" class="control-label">Parroquia Residencia</label>
                                    <div class="form-group">
                                        <select name="parroquia_domi" id="parroquia_domi" class="form-control" required>
                                            <option value="">seleccione</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-sm-8">
                                    <label for="calle_prin" class="control-label">Calle Principal</label>
                                    <div class="form-group">
                                        <input type="text" id="calle_prin" name="calle_prin" class="form-control" placeholder="calle principal" required>
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <label for="calle1_domi" class="control-label">Calle Sec 1</label>
                                    <div class="form-group">
                                        <input type="text" id="calle1_domi" name="calle1_domi" class="form-control" placeholder="calle sec 1" required>
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <label for="calle2_domi" class="control-label">Calle Sec 2</label>
                                    <div class="form-group">
                                        <input type="text" id="calle2_domi" name="calle2_domi" class="form-control" placeholder="calle sec 2" required>
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <label for="">Referencia</label>
                                    <div class="form-group">
                                        <input type="text" id="refrencia_domi" name="refrencia_domi" class="form-control" placeholder="referencia">
                                    </div>
                                </div>
                                <div class="col-sm-4">
                                    <label for="">Numero Casa</label>
                                    <div class="form-group">
                                        <input type="text" id="num_casa" name="num_casa" class="form-control" data-smk-type="number" placeholder=" # numero">
                                    </div>
                                </div>
                                <div class="col-sm-4">
                                    <label for="telenofo_domi" class="control-label">Telefono Domicilio</label>
                                    <div class="form-group">
                                        <input type="text" id="telefono_domi" name="telefono_domi" class="form-control" data-smk-type="number" placeholder="00 0000-000" minlength="7" required>
                                    </div>
                                </div>
                                <div class="col-sm-4">
                                    <label for="celular_domi" class="control-label">Celular Personal</label>
                                    <div class="form-group">
                                        <input type="text" id="celular_domi" name="celular_domi" class="form-control" placeholder="00 00000000" data-smk-type="number" minlength="10" required>
                                    </div>
                                </div>
                                <div class="col-sm-4">
                                    <label for="celular2_domi" class="control-label">Celular</label>
                                    <div class="form-group">
                                        <input type="text" id="celular2_domi" name="celular2_domi" class="form-control" placeholder="00 00000000" data-smk-type="number" minlength="10" required>
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <label for="correo1_domi">Correo Institucional</label>
                                    <div class="form-group">
                                        <input type="email" id="correo1_domi" name="correo1_domi" class="form-control" placeholder="correo personal" required>
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <label for="correo2_domi" class="control-label ">Correo Alternativo</label>
                                    <div class="form-group">
                                        <input type="email" id="correo2_domi" name="correo2_domi" class="form-control" placeholder="correo personal" required>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
                <div id="inst_formal" role="tabpanel" class="tab-pane fade">
                    <div class="box box-primary">
                        <div class="box-header">
                            <div class="col-sm-4">
                                <button type="button" id="btn_modal_abrir" name="btn_modal_abrir" class="btn btn-primary" data-toggle="modal" data-target="#myModal"><i class="glyphicon glyphicon-plus"></i> Nuevo</button>
                            </div>
                        </div>
                        <div class="box-body">
                            <div class="col-sm-12">
                                <div class="panel-body">
                                    <table id="tabla_formal" class="table small table-hover table-bordered">
                                        <thead class="bg-light-blue">
                                        <tr>
                                            <th>Nivel De Instrucción</th>
                                            <th>Universidad</th>
                                            <th>Área De Conocimiento</th>
                                            <th>Sub-Área Conocimiento</th>
                                            <th>Sub-Área Especifica</th>
                                            <th>Titulo</th>
                                            <th>N° Registro Senescyt</th>
                                            <th>Fecha Inicio Estudios</th>
                                            <th>Fecha Obtuvo Titulo</th>
                                            <th>Fecha Graduación</th>
                                            <th>N° Periodos</th>
                                            <th>Periodos</th>
                                            <th>Beca</th>
                                            <th>Acción</th>
                                        </tr>
                                        </thead>
                                    </table>
                                </div>
                            </div>
                            <!-- Modal instruccion formal -->
                            <div id="myModal" class="modal fade" role="dialog" data-backdrop="static" data-keyboard=”false” >
                                <div class="modal-dialog modal-lg center-block">
                                    <!-- Modal content-->
                                    <div class="modal-content">
                                        <div class="modal-header" style="background-color: #3c8dbc ; color: white;">
                                            <button type="button"  id="btn_cerrar_modal" name="btn_cerrar_modal" class="close" data-dismiss="modal">&times;</button>
                                            <h4 class="modal-title">Instruccion Formal</h4>
                                        </div>
                                        <div class="modal-body">
                                            <div class="panel">
                                                <div class="panel-body">
                                                     <form id="form_formacion" role="form" class="small" data-smk-icon="glyphicon glyphicon-remove" enctype="multipart/form-data">
                                                        <div class="col-sm-8">
                                                            <label for="Ninstruccion_fp" class="control-label">Nivel Instruccion</label>
                                                            <div class="form-group">
                                                                <select name="Ninstruccion_fp" id="Ninstruccion_fp" class="form-control" required>
                                                                    <option value="">Seleccione</option>
                                                                </select>
                                                            </div>
                                                        </div>
                                                        <div class="col-sm-12">
                                                            <label for="universidad_fp" class="control-label">Universidad</label>
                                                            <div class="form-group">
                                                                <select name="universidad_fp" id="universidad_fp" class="form-control" style="width:100%" required>
                                                                    <option value="">Seleccione</option>
                                                                </select>
                                                            </div>
                                                        </div>
                                                        <div class="col-sm-4">
                                                            <label for="Aconocimiento_fp" class="control-label">Area Conocimiento</label>
                                                            <div class="form-group">
                                                                <select name="Aconocimiento_fp" id="Aconocimiento_fp" class="form-control" required>
                                                                    <option value="">Seleccione</option>
                                                                </select>
                                                            </div>
                                                        </div>
                                                        <div class="col-sm-4">
                                                            <label for="" class="control-label">Sub-Area</label>
                                                            <div class="form-group">
                                                                <select name="sbArea_fp" id="sbArea_fp" class="form-control" required>
                                                                    <option value="">Seleccione</option>
                                                                </select>
                                                            </div>
                                                        </div>
                                                        <div class="col-sm-4">
                                                            <label for="sbAreaES_fp" class="control-label">Especifica</label>
                                                            <div class="form-group">
                                                                <select name="sbAreaES_fp" id="sbAreaES_fp" class="form-control" required>
                                                                    <option value="">Seleccione</option>
                                                                </select>
                                                            </div>
                                                        </div>
                                                        <div class="col-sm-4">
                                                            <label for="" class="control-label">Beca</label>
                                                            <div class="form-group">
                                                                <select name="beca_fp" id="beca_fp" class="form-control" required>
                                                                    <option value="">Seleccione</option>
                                                                </select>
                                                            </div>
                                                        </div>
                                                        <div class="col-sm-8">
                                                            <label for="titulo_obt_fp" class="control-label">Titulo Obtenido</label>
                                                            <div class="form-group">
                                                                <input type="text" id="titulo_obt_fp" name="titulo_obt_fp" class="form-control" placeholder="titulo obtenido" required>
                                                            </div>
                                                        </div>
                                                        <div class="col-sm-4">
                                                            <label for="" class="control-label">N° Registro Senescyt</label>
                                                            <div class="form-group">
                                                                <input type="text" id="N_regitro_fp" name="N_regitro_fp" class="form-control" placeholder="n° registro" required>
                                                            </div>
                                                        </div>
                                                        <div class="col-sm-4">
                                                            <label for="fecha_inicio_fp" class="control-label">Fecha Inicio</label>
                                                            <div class="form-group">
                                                                <input type="text" id="fecha_inicio_fp" name="fecha_inicio_fp" class="form-control" placeholder="yyyy-mm-dd" required>
                                                            </div>
                                                        </div>
                                                        <div class="col-sm-4">
                                                            <label for="fecha_obtuvo_fp" class="control-label">Fecha Obtencion Titulo</label>
                                                            <div class="form-group">
                                                                <input type="text" id="fecha_obtuvo_fp" name="fecha_obtuvo_fp" class="form-control" placeholder="yyyy-mm-dd" required>
                                                            </div>
                                                        </div>
                                                        <div class="col-sm-4">
                                                            <label for="fecha_graduacion_fp" class="control-label">Fecha Graduacion</label>
                                                            <div class="form-group">
                                                                <input type="text" id="fecha_graduacion_fp" name="fecha_graduacion_fp" class="form-control" placeholder="yyyy-mm-dd" required>
                                                            </div>
                                                        </div>
                                                        <div class="col-sm-4">
                                                            <label for="n_periodos_fp" class="control-label">N° Periodos</label>
                                                            <div class="form-group">
                                                                <input type="text" id="n_periodos_fp" name="n_periodos_fp" class="form-control" data-smk-type="number" placeholder="n° peridos" required>
                                                            </div>
                                                        </div>
                                                        <div class="col-sm-4">
                                                            <label for="Tperiodo_fp" class="control-label">Tipo Periodo</label>
                                                            <div class="form-group">
                                                                <select name="Tperiodo_fp" id="Tperiodo_fp" class="form-control" required>
                                                                    <option value="">Seleccione</option>
                                                                </select>
                                                            </div>
                                                        </div>
                                                        <div class="col-sm-6">
                                                            <label for="archivo_fp" class="control-label">Archivo</label>
                                                            <div class="form-group">
                                                                <input type="file" id="archivo_fp" name="archivo_fp" class="form-control" required>
                                                            </div>
                                                        </div>
                                                        <div class="col-sm-2">
                                                            <label for="btn_subir_file" class="control-label"></label>
                                                            <div class="form-group">
                                                                <button type="button" id="btn_subir_file" name="btn_subir_file" title="subir archivo" class="btn btn-success"><i class="fa fa-upload" aria-hidden="true"></i></button>
                                                                <button type="button" id="btn_elimina_file" name="btn_elimina_file" title="quitar archivo" class="btn btn-danger"><i class="fa fa-trash" aria-hidden="true"></i></button>
                                                            </div>
                                                        </div>
                                                    </form>
                                                 </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-sm-12">
                                                    <div class="pull-right">
                                                        <button type="button" id="btn_save_formal" name="btn_save_formal" class="btn btn-primary"><i class="fa fa-save"></i> Guardar</button>
                                                    </div>
                                                </div>                                            
                                            </div>                                            
                                        </div>                                       
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div id="Capacitacion" role="tabpanel" class="tab-pane fade">
                    <div class="box box-primary">
                         <div class="box-header">
                             <div class="col-sm-4">
                                <button type="button" id="btn_nuevo_capaci" name="btn_nuevo_capaci" class="btn btn-primary" data-toggle="modal" data-target="#modal_capacitacion"><i class="glyphicon glyphicon-plus"></i> Nuevo</button>
                             </div>
                         </div>
                        <div class="box-body">
                            <div class="col-sm-12">
                                <div class="panel-body">
                                    <table id="tabla_capacitacion" class="table small table-hover table-bordered">
                                        <thead class="bg-light-blue">
                                        <tr>
                                            <th>País</th>
                                            <th>Evento</th>
                                            <th>Tipo Evento</th>
                                            <th>Auspiciante</th>
                                            <th>Duración Horas</th>
                                            <th>Certificado Por</th>
                                            <th>Tipo Certificado</th>
                                            <th>Fecha Inicio</th>
                                            <th>Fecha Fin</th>
                                            <th>Acción</th>
                                        </tr>
                                        </thead>
                                    </table>
                                </div>
                            </div>
                             <!-- Modal capacitaciones -->
                            <div id="modal_capacitacion" class="modal fade" role="dialog" data-backdrop="static" data-keyboard=”false” >
                                <div class="modal-dialog modal-lg center-block">
                                    <!-- Modal content-->
                                    <div class="modal-content">
                                        <div class="modal-header" style="background-color: #3c8dbc ; color: white;">
                                            <button type="button"  id="btn_cerrar_md_cp" name="btn_cerrar_md_cp" class="close" data-dismiss="modal">&times;</button>
                                            <h4 class="modal-title">Capacitaciones</h4>
                                        </div>
                                        <div class="modal-body">
                                            <div class="panel">
                                                <div class="panel-body">
                                                    <form id="form_capacitacion" role="form" class="small" data-smk-icon="glyphicon glyphicon-remove" enctype="multipart/form-data">
                                                        <div class="col-sm-4">
                                                          <label for="pais_cp" class="control-label">Pais</label>
                                                          <div class="form-group">
                                                              <select id="pais_cp" name="pais_cp" class="form-control" style="width:100%" required>
                                                                  <option value="">Seleccione</option>
                                                              </select>
                                                          </div>                                                  
                                                        </div>
                                                        <div class="col-sm-8">
                                                          <label for="evento_cp" class="control-label">Evento</label>
                                                          <div class="form-group">
                                                              <input type="text" name="evento_cp" id="evento_cp" class="form-control" placeholder="evento" required>
                                                          </div>
                                                        </div>
                                                        <div class="col-sm-6">
                                                          <label for="tipo_cp" class="control-label">Tipo</label>
                                                          <div class="form-group">
                                                              <select id="tipo_cp" name="tipo_cp" class="form-control" required>
                                                                  <option value="">Selecione</option>
                                                              </select>
                                                           </div>
                                                        </div>
                                                        <div class="col-sm-6">
                                                           <label for="auspiciante_cp" class="control-label">Auspiciante</label>
                                                           <div class="form-group">
                                                               <input type="text" id="auspiciante_cp" name="auspiciante_cp" class="form-control" placeholder="auspiciante" required>
                                                           </div>
                                                        </div>
                                                        <div class="col-sm-3">
                                                           <label for="horas_cp" class="control-label">Duracion Horas</label>
                                                           <div class="form-group">
                                                                <input type="text" id="horas_cp" name="horas_cp" class="form-control" min="1" data-smk-type="number" placeholder="horas" required>
                                                           </div>
                                                        </div>
                                                        <div class="col-sm-5">
                                                           <label for="certificado_cp" class="control-label">Certificado Por</label>
                                                           <div class="form-group">
                                                                <input type="text" id="certificado_cp" name="certificado_cp" class="form-control" placeholder="certificado por" required>
                                                           </div>
                                                        </div> 
                                                        <div class="col-sm-4">
                                                            <label for="" class="control-label">Tipo Certificado</label>
                                                            <div class="form-group">
                                                                <select id="tipo_cert_cp" name="tipo_cert_cp" class="form-control" required>
                                                                 <option value="">SeLeccione</option>
                                                                </select>
                                                            </div>
                                                        </div>
                                                        <div class="col-sm-3">
                                                            <label for="fecha_inicio_cp" class="control-label">Fecha Inicio</label>
                                                            <div class="form-group">
                                                                 <input type="text" id="fecha_inicio_cp" name="fecha_inicio_cp" class="form-control" placeholder="yyyy-mm-dd" required>
                                                            </div>
                                                        </div>
                                                        <div class="col-sm-3">
                                                            <label for="fecha_final_cp" class="control-label">Fecha final</label>
                                                            <div class="form-group">
                                                                <input type="text" id="fecha_final_cp" name="fecha_final_cp" class="form-control" placeholder="yyyy-mm-dd" required>
                                                            </div>
                                                        </div>
                                                        <div class="col-sm-4">
                                                            <label for="" class="control-label">Archivo</label>
                                                            <div class="form-group">
                                                                <input type="file" id="archivo_cp" name="archivo_cp" class="form-control" required>
                                                            </div>
                                                        </div>
                                                        <div class="col-sm-2">
                                                            <label></label>
                                                            <div class="form-group">
                                                                <button type="button" id="btn_subir_file_cp" class="btn btn-success"><i class="fa fa-upload"></i></button>
                                                                <button type="button" id="btn_elimina_file_cp" class=" btn btn-danger"><i class="fa fa-trash"></i></button>
                                                            </div>
                                                        </div>                                                        
                                                    </form>
                                                </div>                                                                                                                                             
                                            </div>
                                            <div class="row">
                                                <div class="col-sm-12">
                                                    <div class="pull-right">
                                                        <button type="button" id="btn_save_cp" name="btn_save_cp" class="btn btn-primary"><i class="fa fa-save"></i> Guardar</button>
                                                    </div>
                                                </div>                                                     
                                            </div>                                                                                                                                     
                                        </div>                                       
                                    </div>
                                </div>
                            </div>                    
                        </div>
                    </div>
                </div>
                <div id="exp_profesional" role="tabpanel" class="tab-pane fade">
                    <div class="box box-primary">
                            <div class="box-header">
                                <div class="col-sm-4">
                                    <button type="button" id="btn_nuevo_exp_pro" class="btn btn-primary" data-toggle="modal" data-target="#modal_experiencia_pro"><i class="glyphicon glyphicon-plus"></i> Nuevo</button>
                                </div>
                            </div>
                    <div class="box-body">
                     <div class="col-sm-12">
                         <div class="panel-body">
                              <table id="tabla_exp_profesional" class="table small table-hover table-bordered">
                                  <thead class="bg-light-blue">
                                    <tr>
                                        <th>País</th>
                                        <th>Institución</th>
                                        <th>Unidad Administrativa</th>
                                        <th>Cargo/Actividad</th>
                                        <th>Área Conocimiento</th>
                                        <th>Sub-Área Conocimiento</th>
                                        <th>Sub-Área Especifica</th>
                                        <th>Sostenibilidad</th>
                                        <th>Motivo Ingreso</th>
                                        <th>Fecha Ingreso</th>
                                        <th>Motivo Salida</th>
                                        <th>Fecha Salida</th>
                                        <th>Actividad Docencia</th>
                                        <th>Actividad Gestión</th>
                                        <th>Acción</th>
                                    </tr>  
                                  </thead>
                              </table>
                         </div> 
                     </div>
                       <!-- Modal experiencia profesional -->
                        <div id="modal_experiencia_pro" class="modal fade"  role="modal" data-backdrop="static" data-keyboard=”false” >
                                <div class="modal-dialog modal-lg center-block">
                                    <!-- Modal content-->
                                    <div class="modal-content">
                                        <div class="modal-header" style="background-color: #3c8dbc ; color: white;">
                                            <button type="button"  id="btn_cerrar_md_exp_pro" name="btn_cerrar_md_exp_pro" class="close" data-dismiss="modal">&times;</button>
                                            <h4 class="modal-title">Experiencia Profesional</h4>
                                        </div>
                                        <div class="modal-body">
                                           <div class="panel">
                                                <div class="panel-body">
                                                    <form id="form_experiencia_pro" data-smk-icon="glyphicon glyphicon-remove" role="form" class="small" enctype="multipart/form-data">
                                                                <div class="col-sm-12">
                                                                   <h5 class="text-muted">Datos De La Institucion</h5>
                                                                </div>
                                                                <div class="col-sm-3">
                                                                    <label  for="pais_exp_pro" class="control-label">Pais</label>
                                                                    <div class="form-group">
                                                                        <select id="pais_exp_pro" name="pais_exp_pro" class="form-control" style="width:100%" required>
                                                                            <option value="">SeLeccione</option>
                                                                        </select>
                                                                    </div>
                                                                </div>
                                                                <div class="col-sm-3">
                                                                     <label for="" class="control-label">Sostenibilidad</label>
                                                                     <div class="form-group">
                                                                         <select id="sostenibilidad_exp_pro" name="sostenibilidad_exp_pro" class="form-control" required>
                                                                             <option value="">SeLeccione</option>
                                                                         </select>
                                                                     </div>                                                    
                                                                </div>
                                                                <div class="col-sm-6">
                                                                    <label for="instruccion_exp_pro" class="control-label">Institucion</label>
                                                                    <div class="form-group">
                                                                        <input type="text" id="instruccion_exp_pro" name="instruccion_exp_pro" class="form-control" placeholder="instruccion" required>
                                                                    </div>
                                                                </div>
                                                                <div class="col-sm-6">
                                                                    <label for="uni_admin_exp_pro" class="control-label">Unidad</label>
                                                                    <div class="form-group">
                                                                       <input type="text" id="uni_admin_exp_pro" name="uni_admin_exp_pro" class="form-control" placeholder="nombre de unidad" required>                                                
                                                                    </div>
                                                                </div>
                                                                <div class="col-sm-6">
                                                                    <label for="" class="control-label">Cargo/Act</label>
                                                                    <div class="form-group">
                                                                        <input type="text" id="cargo_exp_pro" name="cargo_exp_pro" class="form-control" placeholder="cargo o actividad" required>
                                                                    </div>
                                                                </div>
                                                                <div class="col-sm-6">
                                                                    <label class="checkbox-inline">
                                                                        <input type="checkbox" id="chk_docencia" data-toggle="toggle" data-on="Si" data-off="No" data-onstyle="success" data-offstyle="warning">
                                                                        ¿Puesto asignado con Actividad relacionado a la Docencia?
                                                                    </label>
                                                                </div>
                                                                <div class="col-sm-6">
                                                                    <label class="checkbox-inline">
                                                                        <input type="checkbox" id="chk_gestion" data-toggle="toggle" data-on="Si" data-off="No" data-onstyle="success" data-offstyle="warning">
                                                                        ¿Puesto asignado con cargo de Gestion?
                                                                    </label>
                                                                </div>
                                                                <div class="col-sm-12">
                                                                    <h5 class="text-muted">Area De Conocimiento</h5>
                                                                </div>
                                                                <div class="col-sm-4">
                                                                     <label for="area_exp_pro" class="control-label">Area</label>
                                                                     <div class="form-group">
                                                                         <select id="area_exp_pro" name="area_exp_pro" class="form-control" required>
                                                                           <option value="">SeLeccione</option>                                                         
                                                                         </select>
                                                                     </div>
                                                                </div>
                                                                <div class="col-sm-4">
                                                                     <label for="sub_area_exp_pro" class="control-label">Sub-Area</label>
                                                                     <div class="form-group">
                                                                         <select id="sub_area_exp_pro" name="sub_area_exp_pro" class="form-control" required>
                                                                             <option value="">Selecione</option>
                                                                         </select>
                                                                     </div>
                                                                </div>
                                                                <div class="col-sm-4">
                                                                    <label for="especifica_exp_pro" class="control-label">Especifica</label>
                                                                    <div class="form-group">
                                                                        <select id="especifica_exp_pro" name="especifica_exp_pro" class="form-control" required>
                                                                            <option value="">SeLeccione</option>
                                                                        </select>
                                                                    </div>
                                                                </div>
                                                                <div class="col-sm-12">
                                                                   <h5 class="text-muted">Relacion Laboral</h5>
                                                                </div>
                                                                <div class="col-sm-4">
                                                                    <label for="fecha_inicio_exp_pro" class="control-label">Fecha Inicio</label>
                                                                    <div class="form-group">
                                                                        <input type="text" id="fecha_inicio_exp_pro" name="fecha_inicio_exp_pro" class="form-control" placeholder="yyyy-mm-dd" required>
                                                                    </div>                                                    
                                                                </div>
                                                                <div class="col-sm-4">
                                                                    <label for="" class="control-label">Fecha Fin</label>
                                                                    <div class="form-group">
                                                                         <input type="text" id="fecha_fin_exp_pro" name="fecha_fin_exp_pro" class="form-control" placeholder="yyyy-mm-dd" required>
                                                                    </div>
                                                                </div>
                                                                <div class="col-sm-4">
                                                                    <label></label>
                                                                    <div class="form-group">
                                                                        <label class="checkbox-inline">
                                                                             <input type="checkbox" id="chk_vigente" data-toggle="toggle" data-on="Si" data-off="No" data-onstyle="success" data-offstyle="warning">
                                                                             Vigente
                                                                        </label>
                                                                    </div>                                                                   
                                                                </div>
                                                                <div class="col-sm-6">
                                                                    <label for="M_ingreso_exp_pro" class="control-label">Motivo Ingreso</label>
                                                                    <div class="form-group">
                                                                        <select id="M_ingreso_exp_pro" name="M_ingreso_exp_pro" class="form-control" required>
                                                                                <option value="">SeLeccione</option>
                                                                        </select>
                                                                    </div>
                                                                </div>
                                                                <div class="col-sm-6">
                                                                    <label for="M_salida_exp_pro" class="control-label">Motivo Salida</label>
                                                                    <div class="form-group">
                                                                        <select id="M_salida_exp_pro" name="M_salida_exp_pro" class="form-control" required>
                                                                                <option value="">SeLeccione</option>
                                                                        </select>
                                                                    </div>
                                                                </div>
                                                                <div class="col-sm-6">
                                                                    <label for="archivo_exp_pro" class="control-label">Archivo</label>
                                                                    <div class="form-group">
                                                                        <input type="file"  id="archivo_exp_pro" name="archivo_exp_pro" class="form-control" required>
                                                                    </div>
                                                                </div>
                                                                <div class="col-sm-4">
                                                                    <label></label>
                                                                    <div class="form-group">
                                                                        <button type="button" id="btn_subir_file_exp" class="btn btn-success"><i class="fa fa-upload"></i></button>
                                                                        <button type="button" id="btn_elimina_file_exp" class=" btn btn-danger"><i class="fa fa-trash"></i></button>
                                                                    </div>
                                                                </div>                                                                  
                                                    </form>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-sm-12">
                                                    <div class="pull-right">
                                                        <button type="button" id="btn_save_exp_pro" name="btn_save_btn_save_exp_pro" class="btn btn-primary"><i class="fa fa-save"></i> Guardar</button>
                                                    </div>                                                    
                                                </div>
                                            </div>
                                        </div>                                     
                                    </div>
                                </div>
                        </div>
                    </div>
                    </div>                   
                </div>
                <div id="publicacion" role="tabpanel" class="tab-pane fade">
                    <div class="box box-primary">
                         <div class="box-header">
                            <div class="col-md-6">
                                <select id="tipo_publicacion_pb" name="tipo_publicacion_pb" class="form-control"  required>
                                    <option value="">Tipo Publicacion</option>
                                </select>
                            </div>
                            <div class="col-md-3">
                                 <button type="button" id="btn_nuevo_publicacion" class="btn btn-primary"><i class="glyphicon glyphicon-plus"></i> Nuevo</button>
                            </div>
                         </div>
                         <div class="box-body">
                            <div class="col-sm-12">
                                 <div class="panel-body">
                                     <table id="table_libro" hidden class="table small table-hover table-bordered">
                                         <thead class="bg-light-blue">
                                            <tr>
                                                <th>Tipo Publicacion</th>
                                                <th>Instrumento</th>
                                                <th>Estado Publicacion</th>
                                                <th>Sub-Area Especifica</th>
                                                <th>Link</th>
                                                <th>Ciudad</th>
                                                <th>Participacion</th>
                                                <th>Fecha</th>
                                                <th>Accion</th>
                                            </tr>
                                         </thead>
                                     </table>
                                     <table id="table_Cap_libro"  hidden class="table small table-hover table-bordered">
                                         <thead class="bg-light-blue">
                                             <tr>
                                                 <th>Tipo Publicacion</th>
                                                 <th>Instrumento</th>
                                                 <th>Estado Publicacion</th>
                                                 <th>Sub-Area Especifica</th>
                                                 <th>Nom.Capitulo</th>
                                                 <th>Link</th>
                                                 <th>Ciudad</th>
                                                 <th>Edito/Compilador</th>
                                                 <th>Participacion</th>
                                                 <th>Rango-Paginas</th>
                                                 <th>Fecha</th>
                                                 <th>Accion</th>
                                             </tr>
                                         </thead>
                                     </table>
                                     <table id="table_Art_Revista" hidden class="table small table-hover table-bordered">
                                         <thead class="bg-light-blue">
                                             <tr>
                                                 <th>Tipo Publicacion</th>
                                                 <th>Instrumento</th>
                                                 <th>Estado Publicacion</th>
                                                 <th>Sub-Area Especifica</th>
                                                 <th>Nom.Articulo</th>
                                                 <th>Link</th>
                                                 <th>Ciudad</th>
                                                 <th>Participacion</th>
                                                 <th>Num.Revista</th>
                                                 <th>Num.Volumen</th>
                                                 <th>Rango-Paginas</th>
                                                 <th>Fecha</th>
                                                 <th>Accion</th>
                                             </tr>
                                         </thead>
                                     </table>
                                     <table id="table_Art_Memoria" hidden class="table small table-hover table-bordered">
                                         <thead class="bg-light-blue">
                                             <tr>
                                                 <th>Tipo Publicacion</th>
                                                 <th>Instrumento</th>
                                                 <th>Estado Publicacion</th>
                                                 <th>Sub-Area Especifica</th>
                                                 <th>Nom.Articulo</th>
                                                 <th>Link</th>
                                                 <th>Ciudad</th>
                                                 <th>Participacion</th>
                                                 <th>Fecha</th>
                                                 <th>Accion</th>
                                             </tr>
                                         </thead>
                                     </table>
                                 </div>
                            </div>
                            <!-- Modal publicaciones -->
                            <div id="modal_publicacion" class="modal fade"  role="modal" data-backdrop="static" data-keyboard=”false”>
                                <div class="modal-dialog modal-lg">
                                    <!-- Modal content-->
                                    <div class="modal-content">
                                        <div class="modal-header" style="background-color: #3c8dbc ; color: white;">
                                            <button type="button"  id="btn_cerrar_md_publicacion" name="btn_cerrar_md_publicacion" class="close">&times;</button>
                                            <h4 class="modal-title">Publicacion</h4>
                                        </div>
                                        <div class="modal-body">
                                            <div class="panel-default">
                                                <div class="panel-body">
                                                    <form id="form_cabecera_pb" data-smk-icon="glyphicon glyphicon-remove" class="small">
                                                        <div class="col-sm-6">
                                                            <label for="area_conocimiento_CB" class="control-label">Area De Conocimiento</label>
                                                            <div class="form-group">
                                                                <select name="area_conocimiento_CB" id="area_conocimiento_CB" class="form-control" required>
                                                                    <option value="">Seleccione</option>
                                                                </select>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-6">
                                                            <label for="sub_area_CB" class="control-label">Sub-Area</label>
                                                            <div class="form-group">
                                                                <select name="sub_area_CB" id="sub_area_CB" class="form-control" data-placeholder="seleciones" required>
                                                                    <option value="">Seleccion</option>
                                                                </select>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-6">
                                                            <label for="area_espe_CB" class="control-label">Área Especifica</label>
                                                            <div class="form-group">
                                                                <select name="area_espe_CB" id="area_espe_CB" class="form-control" required>
                                                                    <option value="">Seleccione</option>
                                                                </select>
                                                            </div>
                                                        </div>

                                                        <div class="col-md-12">
                                                            <h5 id="descripcion_CB" class="text-muted"></h5>
                                                            <label for="instrumento_CB" class="control-label">Instrumento</label>
                                                            <div class="form-group">
                                                                <select id="instrumento_CB"  name="instrumento_CB" class="form-control" required style="width:100%">
                                                                    <option value="">Seleccione</option>
                                                                </select>
                                                            </div>
                                                        </div>
                                                    </form>
                                                    <form id="form_libro_pb" data-smk-icon="glyphicon glyphicon-remove" hidden class="small">
                                                        <div class="col-md-6">
                                                            <label for="fecha_publicacion_LB" class="control-label">Fecha Publicacion</label>
                                                            <div class="form-group">
                                                                <input type="text" id="fecha_publicacion_LB" name="fecha_publicacion_LB" class="form-control" placeholder="yyyy-MM-dd" required>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-6">
                                                            <label for="participacion_LB" class="control-label">Participacion</label>
                                                            <div class="form-group">
                                                                <select name="participacion_LB" id="participacion_LB" class="form-control" required>
                                                                    <option value="">Seleccione</option>
                                                                </select>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-6">
                                                            <label for="url_LB" class="control-label">Link</label>
                                                            <div class="form-group">
                                                                <input type="url" id="url_LB" name="url_LB" class="form-control" placeholder="https://url.com" required>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-6">
                                                            <label for="ciudad_LB" class="control-label">Ciudad</label>
                                                            <div class="form-group">
                                                                <input type="text" id="ciudad_LB" name="ciudad_LB" class="form-control" placeholder="ciudad" required>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-6">
                                                            <label for="estado_pub_LB" class="control-label">Estado Publicacion</label>
                                                            <div class="form-group">
                                                                <select name="estado_pub_LB" id="estado_pub_LB" class="form-control" required>
                                                                    <option value="">Seleccione</option>
                                                                </select>
                                                            </div>
                                                        </div>
                                                        <div class="row">
                                                            <div class="col-sm-12">
                                                                <div class="pull-right">
                                                                    <button type="button" id="btn_save_libro" name="btn_save_libro" class="btn btn-primary"><i class="fa fa-save"></i> Guardar</button>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </form>
                                                    <form id="form_cap_libro_pb" data-smk-icon="glyphicon glyphicon-remove" hidden class="small">
                                                        <div class="col-md-6">
                                                            <label for="nom_capitulo_CL" class="control-label">Nom. Capitulo</label>
                                                            <div class="form-group">
                                                                <input type="text" id="nom_capitulo_CL" name="nom_capitulo_CL" class="form-control" placeholder="capitulo libro" required>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-6">
                                                            <label for="fecha_publicacion_CL" class="control-label">Fecha Publicacion</label>
                                                            <div class="form-group">
                                                                <input type="text" id="fecha_publicacion_CL" name="fecha_publicacion_CL" class="form-control" placeholder="yyyy-MM-dd" required>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-6">
                                                            <label for="participacion_CL" class="control-label">Participacion</label>
                                                            <div class="form-group">
                                                                <select name="participacion_CL" id="participacion_CL" class="form-control" required>
                                                                    <option value="">Seleccione</option>
                                                                </select>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-6">
                                                            <label for="url_CL" class="control-label">Link</label>
                                                            <div class="form-group">
                                                                <input type="url" id="url_CL" name="url_CL" class="form-control" placeholder="https://url.com" required>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-6">
                                                            <label for="ciudad_CL" class="control-label">Ciudad</label>
                                                            <div class="form-group">
                                                                <input type="text" id="ciudad_CL" name="ciudad_CL" class="form-control" placeholder="ciudad" required>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-6">
                                                            <label for="editor_CL" class="control-label">Editor/Compilador</label>
                                                            <div class="form-group">
                                                                <input type="text" id="editor_CL" name="editor_CL" class="form-control" placeholder="editor o compilador" required>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-6">
                                                            <label for="rango_pagina_CL" class="control-label">Rango Paginas</label>
                                                            <div class="form-group">
                                                                <input type="text" id="rango_pagina_CL" name="rango_pagina_CL" class="form-control" data-smk-pattern="[0-9]+[-]+[0-9]+[0-9]" placeholder="nn-nn" required>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-6">
                                                            <label for="estado_pub_CL" class="control-label">Estado Publicacion</label>
                                                            <div class="form-group">
                                                                <select name="estado_pub_CL" id="estado_pub_CL" class="form-control" required>
                                                                    <option value="">Seleccione</option>
                                                                </select>
                                                            </div>
                                                        </div>
                                                        <div class="row">
                                                            <div class="col-sm-12">
                                                                <div class="pull-right">
                                                                    <button type="button" id="btn_save_Capitulo_L" name="btn_save_Capitulo_L" class="btn btn-primary"><i class="fa fa-save"></i> Guardar</button>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </form>
                                                    <form id="form_art_revista_pb" data-smk-icon="glyphicon glyphicon-remove" hidden class="small">
                                                        <div class="col-md-6">
                                                            <label for="nom_articulo_Art_rev" class="control-label">Nombre Articulo</label>
                                                            <div class="form-group">
                                                                <input type="text" id="nom_articulo_Art_rev" name="nom_articulo_Art_rev" class="form-control" placeholder="nombre articulo" required>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-6">
                                                            <label for="fecha_publicacion_Art_rev" class="control-label">Fecha Publicacion</label>
                                                            <div class="form-group">
                                                                <input type="text" id="fecha_publicacion_Art_rev" name="fecha_publicacion_Art_rev" class="form-control" placeholder="yyyy-MM-dd" required>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-6">
                                                            <label for="participacion_Art_rev" class="control-label">Participacion</label>
                                                            <div class="form-group">
                                                                <select name="participacion_Art_rev" id="participacion_Art_rev" class="form-control" required>
                                                                    <option value="">Seleccione</option>
                                                                </select>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-6">
                                                            <label for="url_Art_rev" class="control-label">Link</label>
                                                            <div class="form-group">
                                                                <input type="url" id="url_Art_rev" name="url_Art_rev" class="form-control" placeholder="https://url.com" required>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-6">
                                                            <label for="ciudad_Art_rev" class="control-label">Ciudad</label>
                                                            <div class="form-group">
                                                                <input type="text" id="ciudad_Art_rev" name="ciudad_Art_rev" class="form-control" placeholder="ciudad" required>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-6">
                                                            <label for="estado_pub_Art_rev" class="control-label">Estado Publicacion</label>
                                                            <div class="form-group">
                                                                <select name="estado_pub_Art_rev" id="estado_pub_Art_rev" class="form-control" required>
                                                                    <option value="">Seleccione</option>
                                                                </select>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-6">
                                                            <label for="num_revista_Art_rev" class="control-label">Num. Revista</label>
                                                            <div class="form-group">
                                                                <input type="text" id="num_revista_Art_rev" name="num_revista_Art_rev" class="form-control" data-smk-type="number" placeholder="num revista" required>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-6">
                                                            <label for="num_volumen_Art_rev" class="control-label">Num Volumen</label>
                                                            <div class="form-group">
                                                                <input type="text" id="num_volumen_Art_rev" name="num_volumen_Art_rev" class="form-control" placeholder="numero volumen" required>
                                                            </div>
                                                        </div>
                                                        <div  class="col-md-6">
                                                            <label for="rango_pagina_Art_rev" class="control-label">Rango Paginas</label>
                                                            <div class="form-group">
                                                                <input type="text" id="rango_pagina_Art_rev" name="rango_pagina_Art_rev" class="form-control" data-smk-pattern="[0-9]+[-]+[0-9]+[0-9]" placeholder="nn-nn" required>
                                                            </div>
                                                        </div>
                                                        <div class="row">
                                                            <div class="col-sm-12">
                                                                <div class="pull-right">
                                                                    <button type="button" id="btn_save_Art_rev" name="btn_save_Art_rev" class="btn btn-primary"><i class="fa fa-save"></i> Guardar</button>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </form>
                                                    <form id="form_art_memoria_pb" data-smk-icon="glyphicon glyphicon-remove" hidden class="small">
                                                        <div class="col-md-6">
                                                            <label for="nom_articulo_Art_me" class="control-label">Nombre Articulo</label>
                                                            <div class="form-group">
                                                                <input type="text" id="nom_articulo_Art_me" name="nom_articulo_Art_me" class="form-control" placeholder="nombre articulo" required>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-6">
                                                            <label for="fecha_publicacion_Art_me" class="control-label">Fecha Publicacion</label>
                                                            <div class="form-group">
                                                                <input type="text" id="fecha_publicacion_Art_me" name="fecha_publicacion_Art_me" class="form-control" placeholder="yyyy-MM-dd" required>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-6">
                                                            <label for="participacion_Art_me" class="control-label">Participacion</label>
                                                            <div class="form-group">
                                                                <select name="participacion_Art_me" id="participacion_Art_me" class="form-control" required>
                                                                    <option value="">Seleccione</option>
                                                                </select>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-6">
                                                            <label for="url_Art_me" class="control-label">Link</label>
                                                            <div class="form-group">
                                                                <input type="url" id="url_Art_me" name="url_Art_me" class="form-control" placeholder="https://url.com" required>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-6">
                                                            <label for="ciudad_Art_Me" class="control-label">Ciudad</label>
                                                            <div class="form-group">
                                                                <input type="text" id="ciudad_Art_Me" name="ciudad_Art_Me" class="form-control" placeholder="ciudad" required>
                                                            </div>
                                                        </div>
                                                        <div  class="col-md-8">
                                                            <label for="arch_subido_Art_Me" class="control-label">Archivo Subido</label>
                                                            <div class="form-group">
                                                                    <input type="file" id="arch_subido_Art_Me" name="arch_subido_Art_Me" class="form-control">
                                                            </div>
                                                        </div>
                                                        <div class="col-md-4">
                                                            <label for=""></label>
                                                            <div class="form-group">
                                                                <button type="button" id="btn_subir_1_Art_Me" title="subir archivo al servidor" name="btn_subir_1_Art_Me" class="btn btn-success"><i class="fa fa-upload"></i></button>
                                                                <button type="button" id="btn_eliminar_1_Art_Me" title="eliminar archivo del servidor" name="btn_eliminar_1_Art_Me" class="btn btn-danger"><i class="fa fa-trash"></i></button>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-8">
                                                            <label for="arch_progr_cient_pb" class="control-label">Programacion Cientifica</label>
                                                            <div class="form-group">
                                                                <input type="file" id="arch_progr_cient_pb" name="arch_progr_cient_pb" class="form-control">
                                                            </div>
                                                        </div>
                                                        <div class="col-md-4">
                                                            <label for="btn_pro_cient_Art_Me"></label>
                                                            <div class="form-group">
                                                                <button type="button" id="btn_subir_2_Art_Me" title="subir archivo al servidor" name="btn_subir_2_Art_Me" class="btn btn-success"><i class="fa fa-upload"></i></button>
                                                                <button type="button" id="btn_eliminar_2_Art_Me" title="eliminar archivo del servidor" name="btn_eliminar_2_Art_Me" class="btn btn-danger"><i class="fa fa-trash"></i></button>
                                                            </div>
                                                        </div>
                                                        <div class="row">
                                                            <div class="col-sm-12">
                                                                <div class="pull-right">
                                                                    <button type="button" id="btn_save_art_memoria" name="btn_save_art_memoria" class="btn btn-primary"><i class="fa fa-save"></i> Guardar</button>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>    
                            </div>
                         </div>
                    </div>
                </div>
                <div id="banco" role="tabpanel" class="tab-pane fade">
                    <div class="box box-primary">
                        <div class="box-header">
                            <div class="col-sm-4">
                                    <button type="button" id="btn_nuevo_banco" class="btn btn-primary" data-toggle="modal" data-target="#modal_banco"><i class="glyphicon glyphicon-plus"></i> Nuevo</button>
                            </div>
                        </div>
                        <div class="box-body">
                            <div class="col-sm-10">
                                 <div class="panel-body">
                                     <table id="tabla_banco" class="table small table-hover table-bordered">
                                         <thead class="bg-light-blue">
                                             <tr>
                                                <th>Institución Financiera</th>
                                                <th>Tipo De Cuenta</th>
                                                <th>Numero Cuenta</th>
                                                <th>Acción</th>
                                             </tr>
                                         </thead>
                                     </table>
                                 </div>
                            </div>
                             <!-- Modal banco -->
                            <div id="modal_banco" class="modal fade"  role="modal" data-backdrop="static" data-keyboard=”false”>
                                 <div class="modal-dialog">
                                      <!-- Modal content-->
                                    <div class="modal-content">
                                        <div class="modal-header" style="background-color: #3c8dbc ; color: white;">
                                            <button type="button"  id="btn_cerrar_md_banco" name="btn_cerrar_md_banco" class="close" data-dismiss="modal">&times;</button>
                                            <h4 class="modal-title">Cuenta Bancaria</h4> 
                                        </div>
                                        <div class="modal-body">
                                             <div class="panel">
                                                 <div class="panel-body">
                                                     <form id="form_banco" data-smk-icon="glyphicon glyphicon-remove" role="form">
                                                        <div class="col-sm-12">
                                                            <label for="inst_financiera" class="control-label">Institucion Financiera</label>
                                                            <div class="form-group">
                                                                <select  id="inst_financiera_bc" name="inst_financiera_bc" class="form-control" required>
                                                                      <option value="">Selecccione</option>
                                                                </select>
                                                            </div>
                                                        </div>
                                                        <div class="col-sm-8">
                                                            <label for="tipo_cuenta_bc" class="control-label">Tipo Cuenta</label>
                                                            <div class="form-group">
                                                                <select id="tipo_cuenta_bc" name="tipo_cuenta_bc" class="form-control" required>
                                                                     <option value="">SeLeccione</option>
                                                                </select>
                                                            </div>
                                                        </div>
                                                        <div class="col-sm-8">
                                                            <label for="numero_cuenta_bc" class="control-label">Numero Cuenta</label>
                                                            <div class="form-group">
                                                                <input type="text" id="numero_cuenta_bc" name="numero_cuenta_bc" class="form-control" placeholder="n° cuenta bancaria" data-smk-type="number" required>
                                                            </div>
                                                        </div>
                                                     </form>
                                                 </div>
                                             </div>
                                              <div class="row">
                                                <div class="col-sm-12">
                                                    <div class="pull-right">
                                                        <button type="button" id="btn_save_banco" name="btn_save_banco" class="btn btn-primary"><i class="fa fa-save"></i> Guardar</button>
                                                    </div>                                                    
                                                </div>
                                            </div> 
                                        </div>
                                    </div>
                                 </div> 
                            </div>
                        </div>
                    </div> 
                </div>
                <div id="discapacidad" class="tab-pane fade">
                     <div class="box box-primary">
                         <div class="box-header">
                              <div class="col-sm-4">
                                  <button type="button" id="btn_save_discapacidad" name="btn_save_discapacidad" class="btn btn-primary"><i class="fa fa-save"></i> Guardar</button>
                              </div>
                         </div>
                         <div class="box-body">
                              <div class="col-sm-12">
                                  <div class="panel-body">
                                     <form  id="form_discapacidad" data-smk-icon="glyphicon glyphicon-remove" role="form">
                                         <div class="col-sm-4">
                                             <label for="" class="control-label">Tipo Discapacidad</label>
                                             <div class="form-group">
                                                  <select id="tipo_discapacidad" name="tipo_discapacidad" class="form-control" required>
                                                      <option value="">Seleccione</option>
                                                  </select>
                                             </div>
                                         </div>
                                         <div class="col-sm-4">
                                             <label for="" class="control-label">Porcentaje</label>
                                             <div class="form-group">
                                                 <input type="text" id="porcentaje" name="porcentaje" class="form-control" placeholder="%" data-smk-type="number" required>
                                             </div>
                                         </div>
                                         <div class="col-sm-4">
                                             <label for="" class="control-label">N° Carnet</label>
                                             <div class="form-group">
                                                 <input type="text" id="numero_carnet" name="numero_carnet" class="form-control" placeholder="numero carnet" data-smk-type="number" required>
                                             </div>
                                         </div>
                                         <div class="col-sm-12">
                                             <label for="" class="control-label">Observacion</label>
                                             <div class="form-group">
                                                 <textarea name="observacion_dis" id="observacion_dis" rows="3" class="form-control" placeholder="observacion discapacidad"></textarea>
                                             </div>
                                         </div>
                                     </form>
                                  </div>
                              </div>                             
                         </div>
                     </div>                    
                </div>
            </div>
        </div>
    </div>
 </div>   
<!-- Mi codigo  Js -->
<script src="<?php base_url()?>src/app/perfil_info_per.js"></script>
<script src="<?php base_url()?>src/app/perfil_domi_per.js"></script>
<script src="<?php base_url()?>src/app/perfil_instruc_formal.js"></script>
<script src="<?php base_url()?>src/app/perfil_capacitaciones.js"></script>
<script src="<?php base_url()?>src/app/perfil_expe_profesional.js"></script>
<script src="<?php base_url()?>src/app/perfil_publicacion.js"></script>
<script src="<?php base_url()?>src/app/perfil_banco.js"></script>
<script src="<?php base_url()?>src/app/perfil_discapacidad.js"></script>
