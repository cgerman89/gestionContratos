<div class="row">
    <div class="col-xs-12">
        <div class="nav-tabs-justified">
            <ul class="nav nav-tabs bg-gray-light">
                <li role="presentation" class="active" >
                    <a href="#proc_tal_humano" data-toggle="tab" class="fa fa-file-text-o fa-2x" title="Proceso talento humano"></a>
                </li>
            </ul>
            <div class="tab-content">
                <div id="proc_tal_humano" role="tabpanel" class="tab-pane fade in active">
                    <div class="box box-primary">
                        <div class="box-header with-border">
                            <div class="col-sm-12">
                                <span style='color:#006699;'><i class="fa fa-eye"></i>&nbsp;<h3 class="box-title">Proceso talento humano</h3></span>
                            </div>
                            <br><br>
                            <div class="col-sm-6">
                                <label for="cbodepartamentotalhum" class="control-label">Departamento:</label>
                                <select name="cbodepartamentotalhum" id="cbodepartamentotalhum" class="form-control" >
                                    <option value="-2">Seleccione el departamento</option>
                                    <option value="-3">Todos los departamentos</option>
                                </select>
                            </div>
                        </div>
                        <div class="box-body">
                            <div class="col-sm-12">
                                <!-- <div class="box box-primary"> -->
                                <table id="tblTalHumano" class="table small table-bordered table-striped table-hover table-responsive">
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


<!-- Modal RRHH -->
<div class="modal fade" id="modalProSolRRHH" role="dialog" data-backdrop="static" data-keyboard=”false”>
    <div class="modal-dialog modal-lg center-block">
        <div class="modal-content">

            <div class="modal-header" style="background-color: #3c8dbc; color: white;">
                <button type="button" id="btn_cerrar_modalRH" name="btn_cerrar_modalRH" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">Procesar contrato</h4>
            </div>

            <div class="modal-body">
                <div class="panel">
                    <div class="panel-body">
                        <form id="form_pro_rrhh" role="form" class="small" data-smk-icon="glyphicon glyphicon-remove" enctype="multipart/form-data">
                            <!-- parametros ocultos -->
                            <input type="hidden" id="mhdnIdContProRRHH" name="mhdnIdContProRRHH">
                            <input type="hidden" id="mhdnIdDenoDocenProRRHH" name="mhdnIdDenoDocenProRRHH">

                            <div class="col-sm-6">
                                <label for="mtxtAspirante" class="control-label">Aspirante:</label>
                                <div class="form-group">
                                    <input type="text" name="mtxtAspirante" class="form-control" id="mtxtAspirante" disabled>
                                </div>
                            </div>

                            <div class="col-sm-3">
                                <label for="mtxtReqDedi" class="control-label">Requerimiento de dedicación:</label>
                                <div class="form-group">
                                    <input type="text" name="mtxtReqDedi" class="form-control" id="mtxtReqDedi" disabled>
                                </div>
                            </div>

                            <div class="col-sm-3">
                                <label for="mtxtObservacion" class="control-label">Observación:</label>
                                <div class="form-group">
                                    <input type="text" name="mtxtObservacion" class="form-control" id="mtxtObservacion" disabled>
                                </div>
                            </div>

                            <div class="col-sm-7">
                                <label for="mcboFormProfesional" class="control-label">Formación profesional:</label>
                                <div class="form-group">
                                    <select class="form-control" id="mcboFormProfesional" name="mcboFormProfesional">
                                        <option value="">Seleccione la profesión</option>
                                    </select>
                                </div>
                            </div>

                            <div class="col-sm-5">
                                <label for="mcboRegLaboral" class="control-label">Régimen laboral:</label>
                                <div class="form-group">
                                    <select class="form-control" id="mcboRegLaboral" name="mcboRegLaboral" required>
                                        <option value="">Seleccione el régimen laboral</option>
                                    </select>
                                </div>
                            </div>

                            <br><br><br><br><br><br><br><br>
                            <hr width="850">

                            <div class="col-sm-6">
                                <label for="mcboCategoria" class="control-label">Categoría:</label>
                                <div class="form-group">
                                    <select class="form-control" id="mcboCategoria" name="mcboCategoria" required>
                                        <option value="">Seleccione la categoría</option>
                                    </select>
                                </div>
                            </div>

                            <div class="col-sm-3">
                                <label for="mcboNivel" class="control-label">Nivel:</label>
                                <div class="form-group">
                                    <select class="form-control" id="mcboNivel" name="mcboNivel" required>
                                        <option value="">Seleccione el nivel</option>
                                    </select>
                                </div>
                            </div>

                            <div class="col-sm-3">
                                <label for="mcboDedicacion" class="control-label">Dedicación:</label>
                                <div class="form-group">
                                    <select class="form-control" id="mcboDedicacion" name="mcboDedicacion" required>
                                        <option value="">Seleccione la dedicación</option>
                                    </select>
                                </div>
                            </div>

                            <div class="col-sm-3">
                                <label for="mtxtRMU" class="control-label">Remuneración:</label>
                                <div class="form-group">
                                    <input type="number" name="mtxtRMU" class="form-control" id="mtxtRMU" required>
                                </div>
                            </div>

                            <div class="col-sm-3">
                                <label for="mtxtAbreviatura" class="control-label">Abreviatura:</label>
                                <div class="form-group">
                                    <input type="text" name="mtxtAbreviatura" class="form-control" id="mtxtAbreviatura" disabled>
                                </div>
                            </div>

                            <br><br><br><br><br><br><br><br>
                            <hr width="850">

                            <div class="col-sm-3">
                                <label for="mtxtFecIni" class="control-label">Fecha inicio:</label>
                                <div class="form-group">
                                    <input type="text" id="mtxtFecIni" name="mtxtFecIni" class="form-control" placeholder="yyyy-mm-dd" required>
                                </div>
                            </div>

                            <div class="col-sm-3">
                                <label for="mtxtFecFin" class="control-label">Fecha fin:</label>
                                <div class="form-group">
                                    <input type="text" id="mtxtFecFin" name="mtxtFecFin" class="form-control" placeholder="yyyy-mm-dd" required>
                                </div>
                            </div>

                            <div class="col-sm-3">
                                <label for="mtxtNumMeses" class="control-label">Número de meses:</label>
                                <div class="form-group">
                                    <input type="number" name="mtxtNumMeses" class="form-control" id="mtxtNumMeses" required>
                                </div>
                            </div>

                            <!--div class="col-sm-6">
                                <label for="mtxtCodCont" class="control-label">Código:</label>
                                <div class="form-group">
                                    <input type="text" name="mtxtCodCont" class="form-control" id="mtxtCodCont" placeholder="Escriba el código del contrato" required>
                                </div>
                            </div-->
                        </form>
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-12">
                        <div class="pull-right">
                            <button type="button" class="btn btn-primary" id="mbtnProcRRHH" name="mbtnProcRRHH"><i class="fa fa-floppy-o"></i> Guardar</button>
                        </div>
                    </div>
                </div>
            </div>

            <!--div class="modal-footer">
                <button type="button" class="btn btn-danger" id="mbtnCerrarModalRRHH" data-dismiss="modal">Cancelar</button>
            </div-->
        </div>
    </div>
</div>
