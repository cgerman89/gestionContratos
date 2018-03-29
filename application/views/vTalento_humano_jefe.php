<div class="row">
	 <div class="col-xs-12">
	 	<div  class="nav-tabs-justified">
	 		<ul class="nav nav-tabs bg-gray-light">
                <li role="presentation" class="active" >
                    <a href="#lista_contratos"  data-toggle="tab">
                        <i class="far fa-folder fa-2x"></i>
                        <i class="fas fa-cogs"></i>
                    </a>
                </li>
                <li role="presentation"   title="contratos aprobados">
                    <a href="#list_contratos_activos" data-toggle="tab">
                        <i class="far fa-folder fa-2x"></i>
                        <i class="fas fa-check"></i>
                    </a>
                </li>
                <li role="presentation"   title="contratos rechazados">
                    <a href="#list_contratos_rechazados" data-toggle="tab">
                        <i class="far fa-folder fa-2x"></i>
                        <i class="fas fa-times"></i>
                    </a>
                </li>
	 		</ul>
	 		<div class="tab-content">
	 			<div id="lista_contratos" role="tabpanel" class="tab-pane fade in active">
	 				<div class="panel panel-default">
                        <div class="panel-heading">
                            <div class="row">
                                <div class="col-md-6">
                                    <h4 class="text-muted"> CONTRATOS POR APROBAR</h4>
                                </div>
                                <div class="col-md-6">
                                    <select id="departamento_ctr_th"  class="form-control" style="width: 100%">
                                        <option value="-2">SELECCIONE DEPARTAMENTO</option>
                                        <option value="-3">TODOS LOS DEPARTAMENTOS</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="panel-body">
                            <table id="tabla_contratos_th_jefe" class="table small table-hover table-bordered">
                                <thead class="bg-light-blue-active">
                                <tr>
                                    <th>CODIGO</th>
                                    <th>ASPIRANTE</th>
                                    <th>MODALIDAD LABORAL</th>
                                    <th>TIPO</th>
                                    <th>DENOMINACION</th>
                                    <th>RMU</th>
                                    <th>Fecha Inicio</th>
                                    <th>Fecha Final</th>
                                    <th>MESES</th>
                                    <th>TITULO</th>
                                    <th>DPTO.SOLICITANTE</th>
                                    <th>Accion</th>
                                </tr>
                                </thead>
                            </table>
                        </div>
                    </div>
	 			</div>
                <div id="list_contratos_activos" role="tabpanel" class="tab-pane fade">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <div class="row">
                                <div class="col-md-6">
                                    <h4 class="text-muted">CONTRATOS APROBADOS</h4>
                                </div>
                                <div class="col-md-6">
                                    <select id="departamento_ctr_apb"  class="form-control" style="width: 100%">
                                        <option value="-2">SELECCIONE DEPARTAMENTO</option>
                                        <option value="-3">TODOS LOS DEPARTAMENTOS</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="panel-body">
                            <table id="tabla_lista_contratos_apb" class="table small table-hover table-bordered">
                                <thead class="bg-light-blue-active">
                                <tr>
                                    <th>CODIGO</th>
                                    <th>ASPIRANTE</th>
                                    <th>MODALIDAD LABORAL</th>
                                    <th>TIPO</th>
                                    <th>DENOMINACION</th>
                                    <th>RMU</th>
                                    <th>Fecha Inicio</th>
                                    <th>Fecha Final</th>
                                    <th>MESES</th>
                                    <th>TITULO</th>
                                    <th>DPTO.SOLICITANTE</th>
                                    <th>COD.SOLICITUD</th>
                                    <th>Accion</th>
                                </tr>
                                </thead>
                            </table>
                        </div>
                    </div>
                </div>
                <div id="list_contratos_rechazados" role="tabpanel" class="tab-pane fade">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <div class="row">
                                <div class="col-md-6">
                                    <h4 class="text-muted">CONTRATOS RECHAZADOS</h4>
                                </div>
                                <div class="col-md-6">
                                    <select id="departamento_ctr_re"  class="form-control" style="width: 100%">
                                        <option value="-2">SELECCIONE DEPARTAMENTO</option>
                                        <option value="-3">TODOS LOS DEPARTAMENTOS</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="panel-body">
                            <table id="tabla_lista_contratos_r" class="table small table-hover table-bordered">
                                <thead class="bg-light-blue-active">
                                <tr>
                                    <th>CODIGO</th>
                                    <th>ASPIRANTE</th>
                                    <th>MODALIDAD LABORAL</th>
                                    <th>TIPO</th>
                                    <th>DENOMINACION</th>
                                    <th>RMU</th>
                                    <th>Fecha Inicio</th>
                                    <th>Fecha Final</th>
                                    <th>MESES</th>
                                    <th>TITULO</th>
                                    <th>DPTO.SOLICITANTE</th>
                                    <th>COD.SOLICITUD</th>
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
    <!-- Modal proceso contrato -->
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
                        <br>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div id="pdf_contenedor_hv" class="modal fullscreen-modal fade"  role="modal" data-backdrop="static" data-keyboard=”false”></div>

</div>