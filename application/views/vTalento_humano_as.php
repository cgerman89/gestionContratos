<div class="row">
    <div class="col-xs-12">
        <div class="nav-tabs-justified">
            <ul class="nav nav-tabs bg-gray-light">
                <li role="presentation" class="active" >
                    <a href="#solicitudes_por_aprobarTH" data-toggle="tab" class="fa fa-file-text-o fa-2x" title="Solicitudes por aprobar"></a>
                </li>
                <li role="presentation">
                    <a href="#flujo_procesos" data-toggle="tab" class="fa fa-check-square-o fa-2x" title="Solicitudes aprobadas"></a>
                </li>
                <li role="presentation">
                    <a href="#Solicitudes_rechazadas" data-toggle="tab" class="fa fa-times fa-2x" title="Solicitudes rechazadas"></a>
                </li>
            </ul>
            <div class="tab-content">
                <div id="solicitudes_por_aprobarTH" role="tabpanel" class="tab-pane fade in active">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                          <div class="row">
                              <div class="col-md-8">
                                  <h4 class="text-muted">SOLICITUDES PENDIENTES</h4>
                              </div>
                              <div class="col-md-4">
                                  <select name="cbodepartamentoaproth" id="cbodepartamentoaproth" class="form-control" >
                                      <option value="-2">SELECCIONE DEPARTAMENTO</option>
                                      <option value="-3">TODOS LOS DEPARTAMENTOS</option>
                                  </select>
                              </div>
                          </div>
                        </div>
                        <div class="panel-body">
                            <div class="col-sm-12">
                                <table id="tblLisAspPorAproTH" class="table small table-bordered table-hover table-responsive">
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
                                            <i class="fa fa-black-tie" aria-hidden="true"></i>
                                            Dedicacion / 
                                            <i class="fa fa-briefcase" aria-hidden="true"></i> 
                                            Puesto
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
                                    <tbody></tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
                <div id="flujo_procesos" role="tabpanel" class="tab-pane fade">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                           <div class="row">
                               <div class="col-md-8">
                                    <h4 class="text-muted">SOLICITUDES APROBADAS</h4>
                               </div>
                               <div class="col-sm-4">
                                   <select name="cbodepartamentoflu" id="cbodepartamentoflu" class="form-control" style="width:100%">
                                       <option value="-1">SELECCIONE DEPARTAMENTO</option>
                                       <option value="-3">TODOS LOS DEPARTAMENTOS</option>
                                   </select>
                               </div>
                           </div>
                        </div>
                        <div class="panel-body">
                            <div class="col-sm-12">
                                <table id="tblLisAspFluProc" class="table small table-bordered table-hover table-responsive">
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
                            <div id="md_proc_solic_y_contr"  class="modal fade" role="dialog" data-backdrop="static" data-keyboard=”false”>
                                <div class="modal-dialog modal-lg">
                                    <div class="modal-content">
                                        <div class="modal-header" style="background-color: #3c8dbc ; color: white;">
                                            <button type="button"  id="btn_cerrar_md_procesos_apro" name="btn_cerrar_md_procesos_apro" class="close" data-dismiss="modal">&times;</button>
                                            <h4 class="modal-title">Procesos</h4>
                                        </div>
                                        <div class="modal-body">
                                            <div class="panel-body">
                                                <div class="col-sm-12">
                                                    <span><h3 class="panel-title">Procesos solicitud</h3></span>
                                                </div>
                                                <br>
                                                <table id="tabla_proceso_solicitud" class="table small table-hover table-bordered">
                                                    <thead class="bg-light-blue">
                                                    <tr>
                                                        <th>
                                                            <i class='fa fa-cogs'></i>
                                                            Proceso
                                                        </th>
                                                        <th>
                                                            <i class="fa fa-address-card-o" aria-hidden="true"></i>
                                                            Usuario
                                                        </th>
                                                        <th>
                                                            <i class="fa fa-calendar-check-o" aria-hidden="true"></i>
                                                            Fecha Revision
                                                        </th>
                                                        <th>
                                                            <i class="fa fa-clock-o" aria-hidden="true"></i>
                                                            Hora Revision
                                                        </th>
                                                        <th>
                                                            <i class="fa fa-commenting" aria-hidden="true"></i>
                                                            Observacion
                                                        </th>
                                                        <th>
                                                            <i class="fa fa-check-square-o" aria-hidden="true"></i>
                                                            Estado
                                                        </th>
                                                    </tr>
                                                    </thead>
                                                </table>
                                            </div>
                                            <div class="panel-body">
                                                <div class="col-sm-12">
                                                    <span><h3 class="panel-title">Procesos contrato</h3></span>
                                                </div>
                                                <br>
                                                <table id="tabla_procesos_contrato" class="table small table-hover table-bordered">
                                                    <thead class="bg-light-blue">
                                                    <tr>
                                                        <th>
                                                            <i class='fa fa-cogs'></i>
                                                            Proceso
                                                        </th>
                                                        <th>
                                                            <i class="fa fa-address-card-o" aria-hidden="true"></i>
                                                            Usuario
                                                        </th>
                                                        <th>
                                                            <i class="fa fa-calendar-check-o" aria-hidden="true"></i>
                                                            Fecha Revision
                                                        </th>
                                                        <th>
                                                            <i class="fa fa-clock-o" aria-hidden="true"></i>
                                                            Hora Revision
                                                        </th>
                                                        <th>
                                                            <i class="fa fa-commenting" aria-hidden="true"></i>
                                                            Observacion
                                                        </th>
                                                        <th>
                                                            <i class="fa fa-check-square-o" aria-hidden="true"></i>
                                                            Estado
                                                        </th>
                                                    </tr>
                                                    </thead>
                                                </table>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div id="Solicitudes_rechazadas" role="tabpanel" class="tab-pane fade">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <div class="row">
                                <div class="col-md-8">
                                    <h4 class="text-muted">SOLICITUDES RECHAZADAS</h4>
                                </div>
                                <div class="col-md-4">
                                    <select name="cbodetoSolicitudesRechazadas" id="cbodetoSolicitudesRechazadas" class="form-control" style="width:100%">
                                        <option value="-1">SELECCIONE DEPARTAMENTO</option>
                                        <option value="-3">TODOS LOS DEPARTAMENTOS</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="panel-body">
                            <div class="col-sm-12">
                                <table id="tblSolicitudesRechazadas" class="table small table-bordered table-hover table-responsive">
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
                            <div id="md_proc_solic_y_contr_rechazadas" class="modal fade" role="dialog" data-backdrop="static" data-keyboard=”false”>
                                <div class="modal-dialog modal-lg">
                                    <div class="modal-content">
                                        <div class="modal-header" style="background-color: #3c8dbc ; color: white;">
                                            <button type="button"  id="btn_cerrar_md_procesos_recha" name="btn_cerrar_md_procesos_recha" class="close" data-dismiss="modal">&times;</button>
                                            <h4 class="modal-title">Procesos</h4>
                                        </div>
                                        <div class="modal-body">
                                            <div class="panel-body">
                                                <div class="col-sm-12">
                                                    <span><h3 class="panel-title">Procesos solicitud</h3></span>
                                                </div>
                                                <br>
                                                <table id="tabla_proceso_solicitud_recha" class="table small table-hover table-bordered">
                                                    <thead class="bg-light-blue">
                                                    <tr>
                                                        <th>
                                                            <i class='fa fa-cogs'></i>
                                                            Proceso
                                                        </th>
                                                        <th>
                                                            <i class="fa fa-address-card-o" aria-hidden="true"></i>
                                                            Usuario
                                                        </th>
                                                        <th>
                                                            <i class="fa fa-calendar-check-o" aria-hidden="true"></i>
                                                            Fecha Revision
                                                        </th>
                                                        <th>
                                                            <i class="fa fa-clock-o" aria-hidden="true"></i>
                                                            Hora Revision
                                                        </th>
                                                        <th>
                                                            <i class="fa fa-commenting" aria-hidden="true"></i>
                                                            Observacion
                                                        </th>
                                                        <th>
                                                            <i class="fa fa-check-square-o" aria-hidden="true"></i>
                                                            Estado
                                                        </th>
                                                    </tr>
                                                    </thead>
                                                </table>
                                            </div>
                                            <div class="panel-body">
                                                <div class="col-sm-12">
                                                    <span><h3 class="panel-title">Procesos contrato</h3></span>
                                                </div>
                                                <br>
                                                <table id="tabla_procesos_contrato_recha" class="table small table-hover table-bordered">
                                                    <thead class="bg-light-blue">
                                                    <tr>
                                                        <th>
                                                            <i class='fa fa-cogs'></i>
                                                            Proceso
                                                        </th>
                                                        <th>
                                                            <i class="fa fa-address-card-o" aria-hidden="true"></i>
                                                            Usuario
                                                        </th>
                                                        <th>
                                                            <i class="fa fa-calendar-check-o" aria-hidden="true"></i>
                                                            Fecha Revision
                                                        </th>
                                                        <th>
                                                            <i class="fa fa-clock-o" aria-hidden="true"></i>
                                                            Hora Revision
                                                        </th>
                                                        <th>
                                                            <i class="fa fa-commenting" aria-hidden="true"></i>
                                                            Observacion
                                                        </th>
                                                        <th>
                                                            <i class="fa fa-check-square-o" aria-hidden="true"></i>
                                                            Estado
                                                        </th>
                                                    </tr>
                                                    </thead>
                                                </table>
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
    </div>

    <div id="pdf_contenedor_hv" class="modal fullscreen-modal fade"  role="modal" data-backdrop="static" data-keyboard=”false”></div>


</div>