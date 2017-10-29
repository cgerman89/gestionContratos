<div class="row">
    <div class="col-xs-12">
        <div class="nav-tabs-justified">
            <ul class="nav nav-tabs bg-gray-light">
                <li role="presentation" class="active" >
                    <a href="#proc_financiero" data-toggle="tab" class="fa fa-usd fa-2x" title="Proceso financiero"></a>
                </li>
            </ul>
            <div class="tab-content">
                <div id="proc_financiero" role="tabpanel" class="tab-pane fade in active">
                    <div class="box box-primary">
                        <div class="box-header with-border">
                            <div class="col-sm-12">
                                <span style='color:#006699;'><i class="fa fa-usd"></i>&nbsp;<h3 class="box-title">Proceso financiero</h3></span>
                            </div>
                            <br><br>
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
                                    <thead>
                                    <tr class="bg-primary">
                                        <th style="background-color: #006699; color: white;">Aspirante</th>
                                        <th style="background-color: #006699; color: white;">Departamento de la solicitud</th>
                                        <th style="background-color: #006699; color: white;">Coordinador Departamento</th>
                                        <th style="background-color: #006699; color: white;">Fecha de Solicitud</th>
                                        <th style="background-color: #006699; color: white;">Tipo de Contrato</th>
                                        <th style="background-color: #006699; color: white;">Estado</th>
                                        <th style="background-color: #006699; color: white;"><i class="fa fa-ellipsis-v"></i></th>
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