<div class="row">
    <div class="col-xs-12">
        <div class="nav-tabs-justified">
            <ul class="nav nav-tabs bg-gray-light">
                <li role="presentation" class="active" >
                    <a href="#proc_financiero" data-toggle="tab"><i class="fa fa-list-alt fa-2x text-info"></i></a>
                </li>
            </ul>
            <div class="tab-content">
                <div id="proc_financiero" role="tabpanel" class="tab-pane fade in active">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <div class="row">
                                <div class="col-md-8">
                                    <h4 class="text-muted">LISTA CONTRATOS</h4>
                                </div>
                                <div class="col-md-4">
                                    <select id="departamento_fn"  class="form-control" style="width: 100%">
                                        <option value="-2">SELECCIONE DEPARTAMENTO</option>
                                        <option value="-3">TODOS LOS DEPARTAMENTOS</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="panel-body">
                            <table id="tabla_contratos_fn" class="table small table-hover table-bordered">
                                <thead class="bg-light-blue">
                                <tr>
                                    <th>
                                        <i class="glyphicon glyphicon glyphicon-barcode"></i>&nbsp;
                                        CODIGO
                                    </th>
                                    <th>
                                        MODALIDAD LABORAL
                                    </th>
                                    <th>
                                        <i class="fa fa-globe" aria-hidden="true"></i>&nbsp;
                                        PAIS
                                    </th>
                                    <th>
                                        <i class="fa fa-user-o" aria-hidden="true"></i>&nbsp;
                                        ASPIRANTE
                                    </th>
                                    <th>
                                        <i class="fa fa-file-text" aria-hidden="true"></i>&nbsp;
                                        TIPO
                                    </th>
                                    <th>
                                        <i class="fa fa-briefcase" aria-hidden="true"></i>&nbsp;
                                        DENOMINACION
                                    </th>
                                    <th>
                                        <i class="fa fa-money" aria-hidden="true"></i>&nbsp;
                                        RMU
                                    </th>
                                    <th>
                                        <i class="fa fa-calendar" aria-hidden="true"></i>&nbsp;&nbsp;
                                        Fecha Inicio
                                    </th>
                                    <th>
                                        <i class="fa fa-calendar" aria-hidden="true"></i>&nbsp;&nbsp;
                                        Fecha Final
                                    </th>
                                    <th>
                                        <i class="fa fa-calendar-o" aria-hidden="true"></i>&nbsp;
                                        MESES
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
            </div>
        </div>
    </div>
</div>