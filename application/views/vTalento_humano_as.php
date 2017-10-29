<div class="row">
    <div class="col-xs-12">
        <div class="nav-tabs-justified">
            <ul class="nav nav-tabs bg-gray-light">
                <li role="presentation" class="active" >
                    <a href="#solicitudes_por_aprobarTH" data-toggle="tab" class="fa fa-file-text-o fa-2x" title="Solicitud(es) por aprobar (Talento humano)"></a>
                </li>
            </ul>
            <div class="tab-content">
                <div id="solicitudes_por_aprobarTH" role="tabpanel" class="tab-pane fade in active">
                    <div class="box box-primary">
                        <div class="box-header with-border">
                            <div class="col-sm-6">
                                <label for="cbodepartamentoaproth" class="control-label">Departamento:</label>
                                <select name="cbodepartamentoaproth" id="cbodepartamentoaproth" class="form-control" >
                                    <option value="-2">Seleccione el departamento</option>
                                    <option value="-3">Todos los departamentos</option>
                                </select>
                            </div>
                        </div>
                        <div class="box-body">
                            <div class="col-sm-12">
                                <!-- <div class="box box-primary"> -->
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
                                            Coord.Departamento
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
                                <!-- </div> -->
                            </div>
                            <!--div class="col-sm-2"><span class='label label-warning' id="spSuma"></span></div-->
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>