<div class="row">
    <div class="col-xs-12">
        <div class="nav-tabs-justified" id="tabs_th">
            <ul class="nav nav-tabs bg-gray-light">
                <li role="presentation" class="active"  title="lista solicitudes aprobadas">
                    <a href="#lista_solicitud_sl_ctr_th"  data-toggle="tab">
                        <i class="fa fa-file-text-o fa-2x text-info" aria-hidden="true"></i>
                    </a>
                </li>
                <li role="presentation" title="se crea un nuevo contrato">
                    <a href="#crear_contrato_th"  data-toggle="tab">
                        <i class="fa fa-folder-open-o fa-2x text-info" aria-hidden="true"></i>
                    </a>
                </li>
                <li role="presentation"   title="estado de contrato">
                    <a href="#lista_contrato_th"  data-toggle="tab">
                        <i class="fa fa-cogs fa-2x text-info" aria-hidden="true"></i>
                    </a>
                </li>
            </ul>
            <div class="tab-content">
                <div id="lista_solicitud_sl_ctr_th" role="tabpanel" class="tab-pane fade in active">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                           <div class="row">
                               <div class="col-md-4">
                                   <h4 class="text-muted">LISTAR SOLICITUDES</h4>
                               </div>
                               <div class="col-md-4">
                                   <select  id="departamento_sl_ctr_th"  class="form-control" style="width: 100%">
                                       <option value="">SELECCIONE DEPARTAMENTO</option>
                                       <option value="-1">TODOS LOS DEPARTAMENTOS</option>
                                   </select>
                               </div>
                               <div class="col-md-4">
                                   <select id="tipo_solicitud_sl_ctr_th" class="form-control" style="width: 100%">
                                       <option value="0">SELECCIONE TIPO SOLICITUD </option>
                                   </select>
                               </div>
                           </div>
                        </div>
                        <div class="panel-body">
                            <table id="tabla_lista_solicitud_contrato_th" class="table small table-hover table-bordered">
                                <thead class="bg-light-blue">
                                <tr>
                                    <th>
                                        <i class="fa fa-user-o" aria-hidden="true"></i>
                                        Aspirante
                                    </th>
                                    <th>
                                        <i class="fa fa-building-o" aria-hidden="true"></i>
                                        Dpto. solicitante
                                    </th>
                                    <th>
                                        <i class="fa fa-user-o" aria-hidden="true"></i>
                                        Coord. Departamento
                                    </th>
                                    <th>
                                        <i class="fa fa-calendar-o" aria-hidden="true"></i>
                                        Fecha Solicitud
                                    </th>
                                    <th>
                                        <i class="fa fa-file-text" aria-hidden="true"></i>
                                        Solicitud
                                    </th>
                                    <th>
                                        <i class="fa fa-flag" aria-hidden="true"></i>
                                        Categoria
                                    </th>
                                    <th>
                                        <i class="fa fa-briefcase" aria-hidden="true"></i>
                                        Dedicacion/Puesto
                                    </th>
                                    <th>
                                        <i class="fa fa-commenting" aria-hidden="true"></i>
                                        Observacion
                                    </th>
                                    <th>
                                        <i class="fa fa-check-square-o" aria-hidden="true"></i>
                                        Estado
                                    </th>
                                    <th>
                                        <i class="fa fa-cog" aria-hidden="true"></i>
                                        Accion
                                    </th>
                                </tr>
                                </thead>
                            </table>
                        </div>
                    </div>
                </div>
                <div id="crear_contrato_th" role="tabpanel" class="tab-pane fade">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <div class="pull-right">
                                <div class="col-md-4">
                                    <button type="submit" class="btn btn-primary"><i class="fa fa-save"></i> Guardar</button>
                                </div>
                            </div>
                            <h4 class="text-muted">CREAR CONTRATO</h4>
                        </div>
                        <div class="panel-body">
                          <div>
                              <form id="form_encabezado_contrato">
                                  <input type="text" id="id_aspirante_th_ctr" name="id_aspirante_th_ctr" disabled hidden required>
                                  <div class="col-md-4">
                                      <label for="tipo_contrato_th_ctr">TIPO CONTRATO</label>
                                      <div class="form-group">
                                          <input type="text" id="tipo_contrato_th_ctr" name="tipo_contrato_th_ctr" class="form-control" placeholder="tipo contrato" disabled required>
                                      </div>
                                  </div>
                                  <div class="col-md-4">
                                      <label for="aspirante_th_ctr">ASPIRANTE</label>
                                      <div class="form-group">
                                          <input type="text" id="aspirante_th_ctr" name="aspirante_th_ctr" class="form-control" placeholder="aspirante" disabled required>
                                      </div>
                                  </div>
                                  <div class="col-md-4">
                                      <label for="n_documento_th_ctr">N° DOCUMENTO</label>
                                      <div class="form-group">
                                          <input type="text" id="n_documento_th_ctr" name="n_documento_th_ctr" class="form-control" placeholder="n° documento" disabled>
                                      </div>
                                  </div>
                                  <div class="col-md-4">
                                      <label for="observacion_th_ctr">OBSERVACION</label>
                                      <div class="form-group">
                                          <input type="text" id="observacion_th_ctr" name="observacion_th_ctr" class="form-control" placeholder="observacion" disabled>
                                      </div>
                                  </div>
                                  <div class="col-md-6">
                                      <label for="puesto_dedicacion_th_ctr">PUESTO / DEDICACION</label>
                                      <div class="form-group">
                                          <input type="text" id="puesto_dedicacion_th_ctr" name="puesto_dedicacion_th_ctr" class="form-control" placeholder="puesto / dedicacion" disabled required>
                                      </div>
                                  </div>
                                  <div class="col-md-4">
                                      <label for="regimen_laboral_th_ctr">RÉGIMEN LABORAL</label>
                                      <div class="form-group">
                                          <select name="regimen_laboral_th_ctr" id="regimen_laboral_th_ctr" class="form-control" required>
                                              <option value="">SELECCIONE</option>
                                          </select>
                                      </div>
                                  </div>
                                  <div class="col-md-4">
                                      <label for="">INSTRUCCIÓN FORMAL</label>
                                      <div class="form-group">
                                          <select name="instrucion_formal_th_ctr" id="instrucion_formal_th_ctr" class="form-control">
                                              <option value="">SELECCIONE</option>
                                          </select>
                                      </div>
                                  </div>
                              </form>
                              <form id="form_administrativo_th_ctr">
                                  <div class="col-md-4">

                                  </div>
                              </form>
                          </div>
                        </div>
                    </div>
                </div>
                <div id="lista_contrato_th" role="tabpanel" class="tab-pane fade">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <h4 class="panel-title">PROCESO CONTRATO</h4>
                        </div>
                        <div class="panel-body">


                        </div>
                    </div>
                </div>
                <!-- Modal lista de solicitudes -->
                <div class="modal fade" id="modal_lista_solicitud_th" role="dialog" data-backdrop="static" data-keyboard=”false”>
                    <div class="modal-dialog modal-lg">
                        <div class="modal-content">
                            <div class="modal-header bg-light-blue">
                                <button type="button" id="btn_cerrar_md_solicitud_th"  class="close" data-dismiss="modal">&times;</button>
                                <h4 class="modal-title">Solicitudes Aprobadas</h4>
                            </div>
                            <div class="modal-body">

                            </div>
                            <div class="modal-footer">

                            </div>
                        </div>
                    </div>
                </div>
                <!-- final modal lista solicitud -->
            </div>
        </div>
    </div>
</div>


