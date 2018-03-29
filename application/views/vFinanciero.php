<div class="row">
    <div class="col-xs-12">
        <div class="nav-tabs-justified">
            <ul class="nav nav-tabs bg-gray-light">
                <li role="presentation" class="active" >
                    <a href="#proc_financiero" data-toggle="tab">
                        <i class="far fa-folder fa-2x"></i>
                        <i class="fas fa-cogs"></i>
                    </a>
                </li>
                <li role="presentation"   title="contratos aprobados">
                    <a href="#contratosaprobados" data-toggle="tab">
                        <i class="far fa-folder fa-2x"></i>
                        <i class="fas fa-check"></i>
                    </a>
                </li>
                <li role="presentation"   title="contratos rechazados">
                    <a href="#contratos_rechazados" data-toggle="tab">
                        <i class="far fa-folder fa-2x"></i>
                        <i class="fas fa-times"></i>
                    </a>
                </li>
            </ul>
            <div class="tab-content">
                <div id="proc_financiero" role="tabpanel" class="tab-pane fade in active">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <div class="row">
                                <div class="col-md-6">
                                    <h4 class="text-muted">APROBAR CONTRATOS</h4>
                                </div>
                                 <div class="col-md-2">
                                    <div class="form-group">
                                        <a name="btn_apro_masivo_fn" id="btn_apro_masivo_fn" class="btn btn-primary" data-toggle="tooltip" data-placement="bottom" title="Aprobar todos los contratos seleccionados">
                                            <span class="badge" id="spNumSolApro"></span>
                                            <i class="fa fa-check-square-o"></i> APROBAR
                                        </a>
                                    </div>
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
                                <thead class="bg-light-blue-active">
                                <tr>
                                    <th>CODIGO</th>
                                    <th>MODALIDAD LABORAL</th>
                                    <th>PAIS</th>
                                    <th>ASPIRANTE</th>
                                    <th>TIPO</th>
                                    <th>DENOMINACION</th>
                                    <th>RMU</th>
                                    <th>Fecha Inicio</th>
                                    <th>Fecha Final</th>
                                    <th>MESES</th>
                                    <th>510510</th>
                                    <th>510203</th>
                                    <th>510204</th>
                                    <th>510601</th>
                                    <th>510602</th>
                                    <th>T.M.SALARIAL</th>
                                    <th> <i class="far fa-check-square fa-1x"></i></th>
                                    <th class="text-bold">Accion</th>
                                </tr>
                                </thead>
                                <tfoot> 
                                   <th class=''></th>
                                   <th></th>
                                   <th></th>
                                   <th></th>
                                   <th></th>
                                   <th></th>
                                   <th></th>
                                   <th></th>
                                   <th></th>
                                   <th class="text-center label-success"></th>
                                   <th class="text-center bg-gray-light" id="p_10"></th>
                                   <th class="text-center bg-gray-light" id="p_11"></th>
                                   <th class="text-center bg-gray-light" id="p_12"></th>
                                   <th class="text-center bg-gray-light" id="p_13"></th>
                                   <th class="text-center bg-gray-light" id="p_14"></th>
                                   <th class="text-center bg-gray-light" id="p_15"></th>
                                   <th></th>
                                   <th></th>                                 
                                </tfoot>                               
                            </table>                                                 
                    
                        </div>
                    </div>
                </div>
                <div id="contratosaprobados" role="tabpanel" class="tab-pane fade">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <div class="row">
                                <div class="col-md-8">
                                    <h4 class="text-muted">CONTRATOS APROBADOS</h4>
                                </div>
                                <div class="col-md-4">
                                    <select id="departamento_ctr_apb"  class="form-control" style="width: 100%">
                                        <option value="-2">SELECCIONE DEPARTAMENTO</option>
                                        <option value="-3">TODOS LOS DEPARTAMENTOS</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="panel-body">
                            <table id="tabla_contratos_apb" class="table small table-hover table-bordered">
                                <thead class="bg-light-blue-active">
                                <tr>
                                    <th>CODIGO</th>
                                    <th>MODALIDAD LABORAL</th>
                                    <th>PAIS</th>
                                    <th>ASPIRANTE</th>
                                    <th>TIPO</th>
                                    <th>DENOMINACION</th>
                                    <th>RMU</th>
                                    <th>Fecha Inicio</th>
                                    <th>Fecha Final</th>
                                    <th>MESES</th>
                                    <th>510510</th>
                                    <th>510203</th>
                                    <th>510204</th>
                                    <th>510601</th>
                                    <th>510602</th>
                                    <th>T.M.SALARIAL</th>
                                    <th>PARTIDA</th>
                                    <th>ACCION</th>
                                </tr>
                                </thead>
                            </table>
                        </div>
                    </div>
                </div>
                <div id="contratos_rechazados" role="tabpanel" class="tab-pane fade">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <div class="row">
                                <div class="col-md-8">
                                    <h4 class="text-muted">CONTRATOS RECHAZADOS</h4>
                                </div>
                                <div class="col-md-4">
                                    <select id="departamento_ctr_re"  class="form-control" style="width: 100%">
                                        <option value="-2">SELECCIONE DEPARTAMENTO</option>
                                        <option value="-3">TODOS LOS DEPARTAMENTOS</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="panel-body">
                            <table id="tabla_contratos_fn_re" class="table small table-hover table-bordered">
                                <thead class="bg-light-blue-active">
                                <tr>
                                    <th>CODIGO</th>
                                    <th>MODALIDAD LABORAL</th>
                                    <th>PAIS</th>
                                    <th>ASPIRANTE</th>
                                    <th>TIPO</th>
                                    <th>DENOMINACION</th>
                                    <th>RMU</th>
                                    <th>Fecha Inicio</th>
                                    <th>Fecha Final</th>
                                    <th>MESES</th>
                                    <th>510510</th>
                                    <th>510203</th>
                                    <th>510204</th>
                                    <th>510601</th>
                                    <th>510602</th>
                                    <th>T.M. Salarial</th>
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
    <div id="md_contrato_proceso"  class="modal fade" role="dialog" data-backdrop="static" data-keyboard=”false”>
        <div class="modal-dialog modal-lg">
            <!-- Modal content-->
            <div class="modal-content">
                <div class="modal-header" style="background-color: #3c8dbc ; color: white;">
                    <button type="button"  id="btn_cerrar_md_asp" name="btn_cerrar_md_asp" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title">Estado Contrato</h4>
                </div>
                <div class="modal-body">
                    <div class="panel-body">
                        <table id="tabla_proceso_contrato" class="table small table-hover table-bordered">
                            <thead class="bg-light-blue">
                            <tr>
                                <th>
                                    <i class='fa fa-cogs'></i>
                                    Proceso
                                </th>
                                <th>
                                    <i class="fa fa-user-o" aria-hidden="true"></i>
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
                                <th>Codigo</th>
                                <th>Observacion</th>
                                <th>Estado</th>
                            </tr>
                            </thead>
                        </table>
                        <br>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
