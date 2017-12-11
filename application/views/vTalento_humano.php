<div class="row">
    <div class="col-xs-12">
        <div class="nav-tabs-justified" id="tabs_th">
            <ul class="nav nav-tabs bg-gray-light">
                <li role="presentation" class="active"  title="lista solicitudes aprobadas">
                    <a href="#lista_solicitud_sl_ctr_th"  data-toggle="tab">
                        <i class="fa fa-file-text-o fa-2x text-info" aria-hidden="true"></i>
                    </a>
                </li>
                <li role="presentation"   title="estado de contrato">
                    <a href="#lista_contrato_th"  data-toggle="tab">
                        <i class="fa fa-list-alt fa-2x text-info" aria-hidden="true"></i>
                    </a>
                </li>
            </ul>
            <div class="tab-content">
                <div id="lista_solicitud_sl_ctr_th" role="tabpanel" class="tab-pane fade in active">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                           <div class="row">
                               <div class="col-md-8">
                                   <h4 class="text-muted">LISTAR SOLICITUDES</h4>
                               </div>
                               <div class="col-md-4">
                                   <select id="departamento_sl_ctr_th"  class="form-control" style="width: 100%">
                                       <option value="-2">SELECCIONE DEPARTAMENTO</option>
                                       <option value="-3">TODOS LOS DEPARTAMENTOS</option>
                                   </select>
                               </div>
                           </div>
                        </div>
                        <div class="panel-body">
                            <table id="tabla_lista_solicitud_contrato_th" class="table small table-hover table-bordered">
                                <thead class="bg-light-blue">
                                <tr>
                                    <th>
                                        <i class="glyphicon glyphicon glyphicon-barcode"></i>
                                        Codigo
                                    </th>
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
                            </table>
                        </div>
                    </div>
                </div>
                <div id="lista_contrato_th" role="tabpanel" class="tab-pane fade">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <div class="row">
                                <div class="col-md-8">
                                    <h4 class="text-muted"><span class="label label-warning">CONTRATOS EN PROCESO</span></h4>
                                </div>
                                <div class="col-md-4">
                                    <select id="departamento_ctr_th"  class="form-control" style="width: 100%">
                                        <option value="-2">SELECCIONE DEPARTAMENTO</option>
                                        <option value="-3">TODOS LOS DEPARTAMENTOS</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="panel-body">
                            <table id="tabla_lista_contratos" class="table small table-hover table-bordered">
                                <thead class="bg-light-blue">
                                    <tr>
                                        <th>
                                            <i class="glyphicon glyphicon glyphicon-barcode"></i>&nbsp;
                                            CODIGO
                                        </th>
                                        <th>
                                            <i class="fa fa-user-o" aria-hidden="true"></i>&nbsp;
                                            ASPIRANTE
                                        </th>
                                        <th>
                                            MODALIDAD LABORAL
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
                                            <i class="fa fa-building-o" aria-hidden="true"></i>
                                            DPTO.SOLICITANTE
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
    <!-- Modal crear contrato-->
    <div class="modal fade" id="modal_crear_contrato_th" role="dialog" data-backdrop="static" data-keyboard=”false”>
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header bg-light-blue">
                    <button type="button" id="btn_cerrar_md_contrato_th"  class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title" title="formulario creacion un nuevo registro de contrato"> <i class="fa fa-file-o" aria-hidden="true"></i> &nbsp; Formulario Contrato</h4>
                </div>
                <div class="modal-body">
                    <div class="panel-body">
                        <form id="form_cabecera_ctr" class="small">
                            <input type="text" name="id_contrato_txt" id="id_contrato_txt" hidden>
                            <input type="text" name="personal_txt" id="personal_txt" hidden>
                            <input type="text" name="id_solicitud_txt" id="id_solicitud_txt" hidden>
                            <input type="text" name="id_departamento_txt" id="id_departamento_txt" hidden>
                            <div class="col-sm-6">
                                <label class="control-label" for="tipo_solicitud_th_ctr">TIPO SOLICITUD</label>
                                <div class="form-group">
                                    <input type="text" id="tipo_solicitud_th_ctr" name="tipo_solicitud_th_ctr" class="form-control" placeholder="tipo contrato" disabled required>
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <label class="control-label" for="">DEPARTAMENTO / FACULTAD</label>
                                <div class="form-group">
                                    <input type="text" name="departamento_th_ctr" id="departamento_th_ctr" class="form-control" placeholder="departamento" disabled required>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <label for="observacion_th_ctr">OBSERVACION</label>
                                <div class="form-group">
                                    <input type="text" id="observacion_th_ctr" name="observacion_th_ctr" class="form-control" placeholder="observacion" disabled required>
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <label class="control-label" for="n_documento_th_ctr">CEDULA / PASARPORTE</label>
                                <div class="form-group">
                                    <input type="text" id="n_documento_th_ctr" name="n_documento_th_ctr" class="form-control" placeholder="n° documento" disabled required>
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <label class="control-label" for="aspirante_th_ctr">ASPIRANTE</label>
                                <div class="form-group">
                                    <input type="text" id="aspirante_th_ctr" name="aspirante_th_ctr" class="form-control" placeholder="aspirante" disabled required>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <label for="puesto_dedicacion_th_ctr">PUESTO / DEDICACION</label>
                                <div class="form-group">
                                    <input type="text" id="puesto_dedicacion_th_ctr" name="puesto_dedicacion_th_ctr" class="form-control" placeholder="puesto / dedicacion"  disabled required>
                                </div>
                            </div>
                            <div class="col-sm-12">
                                <label class="control-label" for="titulo_academico_ctr">TITULO ACADEMICO</label>
                                <div class="form-group">
                                    <select name="titulo_academico_ctr" id="titulo_academico_ctr" class="form-control" required>
                                        <option value="">seleccione</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <label class="control-label" for="tipo_regimen_ctr">TIPO REGIMEN LABORAL</label>
                                <div class="form-group">
                                    <select name="tipo_regimen_ctr" id="tipo_regimen_ctr" class="form-control" required>
                                        <option value="">seleccione</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-sm-3">
                                <label class="control-label" for="">FECHA INICIO</label>
                                <div class="form-group">
                                    <input type="text" name="fecha_inicio_ctr" id="fecha_inicio_ctr" class="form-control" placeholder="YYYY-MM-dd" required>
                                </div>
                            </div>
                            <div class="col-sm-3">
                                <label class="control-label" for="">FECHA FIN</label>
                                <div class="form-group">
                                    <input type="text" name="fecha_fin_ctr" id="fecha_fin_ctr" class="form-control" placeholder="YYYY-MM-dd" required>
                                </div>
                            </div>
                            <div class="col-sm-2">
                                <label class="control-label" for="meses_ctr">MESES</label>
                                <div class="form-group">
                                    <input type="text" name="meses_ctr" id="meses_ctr" class="form-control" placeholder=" # meses"required>
                                </div>
                            </div>
                        </form>
                    </div>
                    <div id="panel_docente_ctr" hidden>
                        <div class="panel-body">
                            <form id="form_ctr_docente" class="small" role="form">
                                <div class="col-md-5">
                                    <label class="control-label" for="tipo_categoria_docente_ctr">CATEGORIA</label>
                                    <div class="form-group">
                                        <select name="tipo_categoria_docente_ctr" id="tipo_categoria_docente_ctr" class="form-control" required>
                                            <option value="">seleccione</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <label class="control-label" for="nivel_docente_ctr">NIVEL</label>
                                    <div class="form-group">
                                        <select name="nivel_docente_ctr" id="nivel_docente_ctr" class="form-control" required>
                                            <option value="">seleccione</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-sm-3">
                                    <label class="control-label" for="dedicacion_docente_ctr">DEDICACION</label>
                                    <div class="form-group">
                                        <select name="dedicacion_docente_ctr" id="dedicacion_docente_ctr" class="form-control" required>
                                            <option value="">Seleccione</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-sm-2">
                                    <label class="control-label" for="rmu_docente_ctr">RMU</label>
                                    <div class="form-group">
                                        <input type="text" id="id_denominacion_docente" name="id_denominacion_docente" hidden required>
                                        <input type="text" class="form-control" id="rmu_docente_ctr" name="rmu_docente_ctr" data-smk-pattern="^[0-9]+([.][0-9]+)?$" placeholder="rmu" required>
                                    </div>
                                </div>
                            </form>
                        </div>
                        <div class="row">
                            <div class="col-sm-12">
                                <div class="pull-right">
                                    <button type="button" id="btn_save_docente_ctr" name="btn_save_docente_ctr" class="btn btn-primary"><i class="fa fa-save"></i> &nbsp; Guardar</button>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div id="panel_administrativo_ctr" hidden>
                        <div class="panel-body">
                            <form id="form_ctr_admin" class="small" role="form">
                                <div class="col-sm-4">
                                    <label class="control-label" for="gp_ocupacional_admin_ctr">GRUPO OCUPACIONAL</label>
                                    <div class="form-group">
                                        <select name="gp_ocupacional_admin_ctr" id="gp_ocupacional_admin_ctr" class="form-control" required>
                                            <option value="">seleccione</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-sm-8">
                                    <label class="control-label" for="puesto_administrativo_ctr">PUESTO/OCUPACION</label>
                                    <div class="form-group">
                                        <select name="puesto_administrativo_ctr" id="puesto_administrativo_ctr" class="form-control" required>
                                            <option value="">seleccione</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-sm-2">
                                    <label class="control-label" for="rmu_admin_ctr">RMU</label>
                                    <div class="form-group">
                                        <input type="text" id="id_denominacion_admin" name="id_denominacion_admin" hidden>
                                        <input type="text" name="rmu_admin_ctr" id="rmu_admin_ctr" class="form-control" data-smk-pattern="^[0-9]+([.][0-9]+)?$" placeholder="rmu" required>
                                    </div>
                                </div>
                            </form>
                        </div>
                        <div class="row">
                            <div class="col-sm-12">
                                <div class="pull-right">
                                    <button type="button" id="btn_save_admin_ctr" name="btn_save_admin_ctr" class="btn btn-primary"><i class="fa fa-save"></i> &nbsp; Guardar</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- final modal crear contrato -->
    <!-- Modal proceso solicitud -->
    <div id="md_solicitud_proceso"  class="modal fade" role="dialog" data-backdrop="static" data-keyboard=”false”>
        <div class="modal-dialog modal-lg">
            <!-- Modal content-->
            <div class="modal-content">
                <div class="modal-header" style="background-color: #3c8dbc ; color: white;">
                    <button type="button"  id="btn_cerrar_md_asp" name="btn_cerrar_md_asp" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title">Estado Solicitud</h4>
                </div>
                <div class="modal-body">
                    <div class="panel-body">
                        <table id="tabla_proceso_solicitud" class="table small table-hover table-bordered">
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
