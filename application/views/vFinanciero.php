<div class="row">
    <div class="col-xs-12">
        <div class="nav-tabs-justified">
            <ul class="nav nav-tabs bg-gray-light">
                <li role="presentation" class="active" >
                    <a href="#proc_financiero" data-toggle="tab" class="fa fa-money fa-2x"></a>
                </li>
            </ul>
            <div class="tab-content">
                <div id="proc_financiero" role="tabpanel" class="tab-pane fade in active">
                    <div class="box box-primary">
                        <div class="box-header with-border">
                              <div class="col-sm-6">
                                <label for="cbodepartamentofinan" class="control-label">Departamento:</label>
                                <select name="cbodepartamentofinan" id="cbodepartamentofinan" class="form-control" >
                                    <option value="-2">Seleccione el departamento</option>
                                    <option value="-3">Todos los departamentos</option>
                                </select>
                            </div>
                        </div>
                        <div class="box-body">
                            <div class="col-sm-12">
                                <!-- <div class="box box-primary"> -->
                                <table id="tblFinanciero" class="table small table-bordered table-striped table-hover table-responsive">
                                    <thead class="bg-light-blue">
                                       <tr>
                                        <th>Aspirante</th>
                                        <th>Departamento de la solicitud</th>
                                        <th>Coordinador Departamento</th>
                                        <th>Fecha de Solicitud</th>
                                        <th>Tipo de Contrato</th>
                                        <th>Estado</th>
                                        <th>Acciones</th>
                                       </tr>
                                    </thead>
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