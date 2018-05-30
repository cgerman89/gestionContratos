<div class="row">
    <div class="col-xs-12">
        <div class="nav-tabs-justified">
            <ul class="nav nav-tabs bg-gray-light">
                <li role="presentation" class="active">
                    <a href="#solicitudes" data-toggle="tab" title="buscar Solicitud">
                        <i class="far fa-file-alt fa-2x info"></i>
                    </a>
                </li>
                <li role="presentation">
                    <a href="#contratos" data-toggle="tab" title="buscar Contratos">
                        <i class="far fa-folder fa-2x info"></i>
                    </a>
                </li>
            </ul>
            <div class="tab-content">
                <div id="solicitudes" class="tab-pane fade in active">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <div class="row">
                                <div class="col-md-2">
                                    <h4 class="text-muted">SOLICITUDES</h4>
                                </div>
                                <form id="form_consulta_sl">
                                <div class="col-sm-2">
                                    <label for="fecha_inicio_sl" class="control-label">Desde</label>
                                    <input type="text" id="fecha_inicio_sl" name="fecha_inicio_sl" class="form-control" placeholder="YYYY-MM-DD">
                                </div>
                                <div class="col-sm-2">
                                    <label for="fecha_fin_sl" class="control-label">Hasta</label>
                                    <input type="text" id="fecha_fin_sl" name="fecha_fin_sl" class="form-control" placeholder="YYYY-MM-DD">
                                </div>
                                <div class="col-md-6">
                                    <label for="departamento_sl_ctr_th" class="control-label">Departamento</label>
                                    <select id="departamento_sl_ctr_th"  class="form-control" style="width: 100%">
                                        <option value="-2">SELECCIONE DEPARTAMENTO</option>
                                        <option value="-3">TODOS LOS DEPARTAMENTOS</option>
                                    </select>
                                </div>
                                </form>
                            </div>
                        </div>
                        <div class="panel-body">
                            <table id="buscar_solicitudes" class="table small table-hover table-bordered">
                                <thead class="bg-light-blue">
                                <tr>
                                    <th>
                                        Codigo
                                    </th>
                                    <th class="text-center">
                                        Aspirante
                                    </th>
                                    <th>
                                        Solicitud
                                    </th>
                                    <th>
                                        Puesto / Dedicacion
                                    </th>
                                    <th>
                                        Fecha
                                    </th>
                                    <th>
                                        Observacion
                                    </th>
                                    <th>
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
                <div id="contratos" class="tab-pane fade in">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <div class="row">
                                <div class="col-md-2">
                                    <h4 class="text-muted">CONTRATOS</h4>
                                </div>
                                <form id="form_consulta_ctr">
                                    <div class="col-sm-2">
                                        <label for="fecha_inicio_ctr" class="control-label">Desde</label>
                                        <input type="text" id="fecha_inicio_ctr" name="fecha_inicio_ctr" class="form-control" placeholder="YYYY-MM-DD">
                                    </div>
                                    <div class="col-sm-2">
                                        <label for="fecha_fin_ctr" class="control-label">Hasta</label>
                                        <input type="text" id="fecha_fin_ctr" name="fecha_fin_ctr" class="form-control" placeholder="YYYY-MM-DD">
                                    </div>
                                    <div class="col-md-6">
                                        <label for="departamento_ctr_th" class="control-label">Departamento</label>
                                        <select id="departamento_ctr_th"  class="form-control" style="width: 100%">
                                            <option value="-2">SELECCIONE DEPARTAMENTO</option>
                                            <option value="-3">TODOS LOS DEPARTAMENTOS</option>
                                        </select>
                                    </div>
                                </form>
                            </div>
                        </div>
                        <div class="panel-body">
                            <table id="buscar_contratos" class="table small table-hover table-bordered">
                                <thead class="bg-light-blue">
                                <tr>
                                    <th>CODIGO</th>
                                    <th>ASPIRANTE</th>
                                    <th>MODALIDAD LABORAL</th>
                                    <th>TIPO</th>
                                    <th>DENOMINACION</th>
                                    <th>RMU</th>
                                    <th>FECHA</th>
                                    <th>Fecha Inicio</th>
                                    <th>Fecha Final</th>
                                    <th>MESES</th>
                                    <th>TITULO</th>
                                    <th>DPTO.SOLICITANTE</th>
                                    <th>COD.SOLICITUD</th>
                                    <th>ESTADO</th>
                                    <th>Accion</th>
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
<div id="pdf_contenedor_general" class="modal fullscreen-modal fade"  role="modal" data-backdrop="static" data-keyboard=”false”>
</div>