<div class="row">
    <div class="col-xs-12">
        <div class="nav-tabs-justified">
            <ul class="nav nav-tabs bg-gray-light">
                <li  role="presentation" class="active" >
                    <a href="#reg_aspirante" data-toggle="tab" class="fa fa-user-plus fa-2x" aria-hidden="true" title="per-inscripcion persona"></a>
                </li>
                <li  role="presentation">
                    <a href="#usuario_rol" id="tab_solicitud" data-toggle="tab" class="fa fa-list-alt fa-2x" aria-hidden="true" title="Solicitud contrato"></a>
                </li>
            </ul>
            <div class="tab-content">
                <div id="reg_aspirante"  class="tab-pane bg-gray-light active">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <div class="row">
                                <div class="col-md-6">
                                    <h4 class="text-muted">AGREGAR ASPIRANTE</h4>
                                </div>
                                <div class="col-md-6">
                                    <div class="pull-right">
                                        <div class='pull-left'><div class='btn-group'><button type='button' class='btn btn-primary'><i class='fa fa-bars'></i>  AGREGAR</button><button type='button' class='btn btn-primary dropdown-toggle' data-toggle='dropdown' aria-expanded='false'><span class='caret'></span><span class='sr-only'>Toggle Dropdown</span></button><ul class='dropdown-menu' role='menu'><li><a href='#' data-toggle="modal" data-target="#modal_registro_asp"><span class='text-bold'><i class="fa fa-user-plus"></i> Aspirante</span></a></li><li><a href='#' data-toggle="modal" data-target="#modal_pre_inscripcion"><span class='text-bold'><i class="fa fa-plus-circle"></i> Permiso </span></a></li></ul></div></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="panel-body">
                            <div class="col-sm-12">
                                <div class="panel-body">
                                    <table id="tabla_inscricion" class="table table-hover table-bordered">
                                        <thead class="bg-light-blue">
                                        <tr>
                                            <th class="text-center">
                                                <i class="fa fa-user-o" aria-hidden="true"></i>
                                                Aspirante
                                            </th>
                                            <th class="text-center">
                                                <i class="fa fa-address-card-o" aria-hidden="true"></i>
                                                Usuario
                                            </th>
                                            <th class="text-center">
                                                <i class="fa fa-building-o" aria-hidden="true"></i>
                                                Departamento
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
                            <!-- Modal inscripciones -->
                            <div id="modal_registro_asp" class="modal fade" role="dialog" data-backdrop="static" data-keyboard=”false”>
                                <div class="modal-dialog modal-lg">
                                    <div class="modal-content">
                                        <div class="modal-header bg-light-blue">
                                            <button type="button"  id="cerrar_md_reg_asp" name="cerrar_md_reg_asp" class="close" data-dismiss="modal">&times;</button>
                                            <h4 class="modal-title"><i class="fa fa-user-o" aria-hidden="true"></i> REGISTRAR ASPIRANTE </h4>
                                        </div>
                                        <div class="modal-body">
                                            <div class="panel panel-default">
                                                <div class="panel-body">
                                                    <form id="form_reg_aspirante" role="form" class="modal-form" data-smk-icon="glyphicon glyphicon-remove">
                                                        <div class="col-md-6">
                                                            <label for="t_documento_asp" class="control-label">TIPO DOCUMENTO</label>
                                                            <div class="form-group">
                                                                <select name="t_documento_asp" id="t_documento_asp" class="form-control" required>
                                                                    <option value="">Seleccione</option>
                                                                </select>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-6">
                                                            <label for="n_documento_asp" class="control-label">N° DOCUMENTO</label>
                                                            <div class="form-group">
                                                                <input type="text" name="n_documento_asp" id="n_documento_asp" class="form-control" required>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-6">
                                                            <label for="apellido1_reg_asp">APELLIDO PATERNO</label>
                                                            <div class="form-group">
                                                                <input type="text" id="apellido1_reg_asp" name="apellido1_reg_asp" class="form-control" required>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-6">
                                                            <label for="apellido2_reg_asp" class="control-label">APELLIDO MATERNO</label>
                                                            <div class="form-group">
                                                                <input type="text" name="apellido2_reg_asp" id="apellido2_reg_asp" class="form-control" required>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-6">
                                                            <label for="nombres_reg_asp" class="control-label">NOMBRES</label>
                                                            <div class="form-group">
                                                                <input type="text" id="nombres_reg_asp" name="nombres_reg_asp" class="form-control" required>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-6">
                                                            <label for="f_nacimiento_reg_asp" class="control-label">FECHA DE NACIMIENTO</label>
                                                            <div class="form-group">
                                                                <input type="text" id="f_nacimiento_reg_asp" name="f_nacimiento_reg_asp" class="form-control" required>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-6">
                                                            <label for="sexo_reg_asp" class="control-label">SEXO</label>
                                                            <div class="form-group">
                                                                <select name="sexo_reg_asp" id="sexo_reg_asp" class="form-control" required>
                                                                    <option value="">Seleccione</option>
                                                                </select>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-6">
                                                            <label for="nacionalidad_reg_asp" class="control-label">NACIONALIDAD</label>
                                                            <div class="form-group">
                                                                <select name="nacionalidad_reg_asp" id="nacionalidad_reg_asp" class="form-control" required>
                                                                    <option value="">Seleccione</option>
                                                                </select>
                                                            </div>
                                                        </div>
                                                    </form>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-sm-12">
                                                    <div class="pull-right">
                                                        <button type="button" id="btn_save_reg_asp" name="btn_save_reg_asp" class="btn btn-primary"><i class="fa fa-save"></i> Guardar</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div id="modal_pre_inscripcion" class="modal fade" role="dialog" data-backdrop="static" data-keyboard=”false”>
                                <div class="modal-dialog modal-lg">
                                    <!-- Modal content-->
                                    <div class="modal-content">
                                        <div class="modal-header" style="background-color: #3c8dbc ; color: white;">
                                            <button type="button"  id="btn_cerrar_md_asp" name="btn_cerrar_md_asp" class="close" data-dismiss="modal">&times;</button>
                                            <h4 class="modal-title">Agregar Permiso</h4>
                                        </div>
                                        <div class="modal-body">
                                            <div class="panel panel-default">
                                                <div class="panel-body">
                                                    <form id="form_aspirante" role="form" class="modal-form" data-smk-icon="glyphicon glyphicon-remove">
                                                        <div class="col-sm-8">
                                                            <label for="cedula_asp">Cedula / Pasaporte</label>
                                                            <div class="form-group">
                                                                <input type="text" id="cedula_asp" name="cedula_asp" class="form-control" minlength="10"  placeholder="cedula / pasaporte"  autofocus required>
                                                            </div>
                                                        </div>
                                                        <div class="col-sm-6">
                                                            <label for="apellido1_asp">Apellido Paterno</label>
                                                            <div class="form-group">
                                                                <input type="text" id="apellido1_asp" name="apellido1_asp" class="form-control" placeholder="apellido paterno" disabled required>
                                                            </div>
                                                        </div>
                                                        <div class="col-sm-6">
                                                            <label for="apellido2_asp" class="control-label">Apellido Materno</label>
                                                            <div class="form-group">
                                                                <input type="text" id="apellido2_asp" name="apellido2_asp" class="form-control" placeholder="apellido materno" disabled required>
                                                            </div>
                                                        </div>
                                                        <div class="col-sm-12">
                                                            <label for="nombres_asp" class="control-label">Nombres</label>
                                                            <div class="form-group">
                                                                <input type="text" id="nombres_asp"  name="nombres_asp" class="form-control" placeholder="nombres"  disabled required>
                                                            </div>
                                                        </div>
                                                    </form>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-sm-12">
                                                    <div class="pull-right">
                                                        <button type="button" id="btn_save_pre_insc" name="btn_save_pre_insc" class="btn btn-primary"><i class="fa fa-save"></i> Agregar </button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div id="modal_solicitud_contrato_asp" class="modal fade" role="dialog" data-backdrop="static" data-keyboard=”false” >
                                <div class="modal-dialog modal-lg">
                                    <div class="modal-content">
                                        <div class="modal-header" style="background-color: #3c8dbc ; color: white;">
                                            <button type="button"  id="btn_cerrar_md_solicitud_asp" name="btn_cerrar_md_solicitud_asp" class="close" data-dismiss="modal">&times;</button>
                                            <h4 class="modal-title">Solicitud Contrato</h4>
                                        </div>
                                        <div class="modal-body">
                                            <div class="panel-body">
                                                <form id="form_solicitud_contrato_asp" role="form" class="small" data-smk-icon="glyphicon glyphicon-remove">
                                                    <input type="text" id="txt_id_personal" name="txt_id_personal" hidden required>
                                                    <div class="col-md-6">
                                                        <label for="n_documento_sl_ctr" class="control-label">N° Documento</label>
                                                        <div class="form-group">
                                                            <input type="text" id="n_documento_sl_ctr" name="n_documento_sl_ctr" class="form-control" placeholder="n° documento" disabled>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <label for="nombres_sl_ctr" class="control-label">Aspirante</label>
                                                        <div class="form-group">
                                                            <input type="text" id="nombres_sl_ctr" name="nombres_sl_ctr" placeholder="nombres" class="form-control" disabled>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <label for="departamento_sl_ctr" class="control-label">Departamento</label>
                                                        <div class="form-group">
                                                            <input type="text" id="departamento_sl_ctr" name="departamento_sl_ctr" class="form-control" placeholder="departamento" disabled>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <label for="tipo_contrato_sl_ctr" class="control-label">Tipo Solicitud Contrato</label>
                                                        <div class="form-group">
                                                            <select name="tipo_contrato_sl_ctr" id="tipo_contrato_sl_ctr" class="form-control" required>
                                                                <option value="">seleccione</option>
                                                            </select>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <label for="fecha_sl_ctr" class="control-label">Fecha Solicitud</label>
                                                        <div class="form-group">
                                                            <input type="text" id="fecha_sl_ctr" name="fecha_sl_ctr" class="form-control" placeholder="YYYY-MM-DD" required>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <label for="tipo_categoria_sl_ctr" class="control-label">Categoria</label>
                                                        <div class="form-group">
                                                            <select name="tipo_categoria_sl_ctr" id="tipo_categoria_sl_ctr" class="form-control" required>
                                                                <option value="">seleccione</option>
                                                            </select>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <label for="tipo_observacion_sl" class="control-label">Observacion</label>
                                                        <div class="form-group">
                                                            <select name="tipo_observacion_sl" id="tipo_observacion_sl" class="form-control" required>
                                                                <option value="">seleccione</option>
                                                            </select>
                                                        </div>
                                                    </div>
                                                </form>
                                                <form id="form_tipo_docente" role="form" class="small" data-smk-icon="glyphicon glyphicon-remove" hidden>
                                                    <div class="col-md-6">
                                                        <label for="tipo_categoria_docente" class="control-label">Dedicacion</label>
                                                        <div class="form-group">
                                                            <select name="tipo_dedicacion_docente" id="tipo_dedicacion_docente" class="form-control" required>
                                                                <option value="">seleccione</option>
                                                            </select>
                                                        </div>
                                                    </div>
                                                    <div class="row">
                                                        <div class="col-sm-12">
                                                            <div class="pull-right">
                                                                <button type="button" id="btn_enviar_docente_sl_ctr" name="btn_enviar_sl_ctr" class="btn btn-primary"><i class="fa fa-paper-plane"></i>  Enviar</button>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </form>
                                                <form id="form_administrativo" role="form" class="small" data-smk-icon="glyphicon glyphicon-remove" hidden>
                                                    <div class="col-md-6">
                                                        <label for="puesto_admin" class="control-label">Puesto</label>
                                                        <div class="form-group">
                                                            <select name="puesto_admin" id="puesto_admin" class="form-control" required>
                                                                <option value="">seleccione</option>
                                                            </select>
                                                        </div>
                                                    </div>
                                                    <div class="row">
                                                        <div class="col-sm-12">
                                                            <div class="pull-right">
                                                                <button type="button" id="btn_enviar_admin_sl_ctr" name="btn_enviar_sl_ctr" class="btn btn-primary"><i class="fa fa-paper-plane"></i>  Enviar</button>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div id="usuario_rol" role="tabpanel" class="tab-pane fade in">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                           <div class="row">
                               <div class="col-md-8">
                                   <h4 class="text-muted">LISTA DE SOLICITUDES</h4>
                               </div>
                           </div>
                        </div>
                        <div class="panel-body">
                            <div class="col-sm-12">
                                   <table id="tabla_solicitud" class="table small table-hover table-bordered">
                                        <thead class="bg-light-blue">
                                        <tr>
                                            <th class="text-center">
                                                <i class="fa fa-user-o" aria-hidden="true"></i>
                                                Aspirante
                                            </th>
                                            <th>
                                                <i class="fa fa-file-text" aria-hidden="true"></i>
                                                Solicitud
                                            </th>
                                            <th class="text-center">
                                                <i class="fa fa-flag" aria-hidden="true"></i>
                                                Categoria
                                            </th>
                                            <th>
                                                <i class="fa fa-black-tie" aria-hidden="true"></i>
                                                Puesto / Dedicacion
                                            </th>
                                            <th>
                                                <i class="fa fa-calendar-o" aria-hidden="true"></i>
                                                Fecha
                                            </th>
                                            <th>
                                                <i class="fa fa-commenting" aria-hidden="true"></i>
                                                Observacion
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
                                    </table>
                              </div>
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
                                                <h4 class="text-muted">Proceso Solicitud</h4>
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
                                                <h4 class="text-muted">Proceso Contrato</h4>
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
        <div id="pdf_contenedor_hv" class="modal fullscreen-modal fade"  role="modal" data-backdrop="static" data-keyboard=”false”></div>
    </div>
</div>
<script src="<?php base_url()?>src/app/registro_asp.js"></script>