<div class="row">
    <div class="col-xs-12">
        <div class="nav-tabs-justified">
            <ul class="nav nav-tabs bg-gray-light">
                <li role="presentation" class="active" >
                    <a href="#solicitudes_por_aprobar" data-toggle="tab" class="fa fa-file-text-o fa-2x" title="Solicitud(es) por aprobar (Rector(a))"></a>
                </li>
                <li role="presentation">
                    <a href="#flujo_procesos" data-toggle="tab" class="fa fa-gears fa-2x" title="Flujo de procesos para la elaboración de un nuevo contrato (Contrato(s) en proceso)"></a>
                </li>
            </ul>
            <div class="tab-content">
                <div id="solicitudes_por_aprobar" role="tabpanel" class="tab-pane fade in active">
                    <div class="box box-primary">
                        <div class="box-header with-border">
                            <div class="col-sm-6">
                                <label for="cbodepartamentoapro" class="control-label">Departamento:</label>
                                <div class="form-group">
                                    <select name="cbodepartamentoapro" id="cbodepartamentoapro" class="form-control" >
                                        <option value="-2">Seleccione el departamento</option>
                                        <option value="-3">Todos los departamentos</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-sm-2">
                                <div class="form-group">
                                    <a name="btn_apro_mas" id="btn_apro_mas" class="btn btn-default" data-toggle="tooltip" data-placement="bottom" title="Aprobar masivamente">
                                        <span class="badge bg-blue" id="spNumSolApro"></span><br>
                                        <i class="fa fa-check-square-o"></i>
                                        APROBAR
                                    </a>
                                </div>
                            </div>
                        </div>
                        <div class="box-body">
                             <div class="col-sm-12">
                                    <!-- <div class="box box-primary"> -->
                                    <table id="tblLisAspPorApro" class="table small table-bordered table-hover table-responsive">
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
                                            <th class="text-center">
                                                <i class="fa fa-check-square-o"></i>
                                            </th>
                                            <th>
                                                <i class="fa fa-cog" aria-hidden="true"></i>
                                                Accion
                                            </th>
                                        </tr>
                                        </thead>
                                    </table>
                                 <!-- </div> -->
                             </div>
                            <!--div class="col-sm-2"><span class='label label-warning' id="spSuma"></span></div-->
                        </div>
                    </div>
                </div>
                <div id="flujo_procesos" role="tabpanel" class="tab-pane fade">
                    <div class="box box-primary">
                        <div class="box-header with-border">
                            <div class="col-sm-12">
                                <span style='color:#006699;'><i class="fa fa-gears"></i>&nbsp;<h3 class="box-title">Flujo de procesos para la elaboración de un nuevo contrato (Contrato(s) en proceso)</h3></span>
                            </div>
                            <br><br>
                            <div class="col-sm-6">
                                <label for="cbodepartamentoflu" class="control-label">Departamento:</label>
                                <select name="cbodepartamentoflu" id="cbodepartamentoflu" class="form-control" style="width:100%">
                                    <option value="-2">Seleccione el departamento</option>
                                    <option value="-3">Todos los departamentos</option>
                                </select>
                            </div>
                        </div>
                        <div class="box-body">
                            <div class="col-sm-12">
                                <!-- <div class="box box-primary"> -->
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
                                            <i class="fa fa-cog" aria-hidden="true"></i>
                                            Accion
                                        </th>
                                    </tr>
                                    </thead>
                                    <tbody></tbody>
                                </table>
                                <!-- </div> -->
                            </div>
                            <!-- Modal procesos de solicitudes y contratos-->
                            <div id="md_proc_solic_y_contr"  class="modal fade" role="dialog" data-backdrop="static" data-keyboard=”false”>
                                <div class="modal-dialog modal-lg">
                                    <!-- Modal content-->
                                    <div class="modal-content">
                                        <div class="modal-header" style="background-color: #3c8dbc ; color: white;">
                                            <button type="button"  id="btn_cerrar_md_asp" name="btn_cerrar_md_asp" class="close" data-dismiss="modal">&times;</button>
                                            <h4 class="modal-title">Procesos</h4>
                                        </div>
                                        <div class="modal-body">
                                            <div class="panel-body">
                                                <div class="col-sm-12">
                                                    <span style='color:#black;'><h3 class="panel-title">Procesos solicitud</h3></span>
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
                                                    <span style='color:#black;'><h3 class="panel-title">Procesos contrato</h3></span>
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
            </div>
        </div>
    </div>
</div>

<!--script type="text/javascript">
    var baseurl = "<?php base_url(); ?>";
</script-->