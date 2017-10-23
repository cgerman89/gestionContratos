<div class="row">
    <div class="col-xs-12">
        <div class="nav-tabs-justified">
            <ul class="nav nav-tabs bg-gray-light">
                <li  role="presentation" class="active" >
                    <a href="#reg_aspirante" data-toggle="tab" class="fa fa-user-plus fa-2x" aria-hidden="true" title="per-inscripcion persona"></a>
                </li>
                <li  role="presentation">
                    <a href="#usuario_rol" data-toggle="tab" class="fa fa-list-alt fa-2x" aria-hidden="true" title="Solicitud contrato"></a>
                </li>
            </ul>
            <div class="tab-content">
                <div id="reg_aspirante"  class="tab-pane bg-gray-light active">
                    <div class="box box-primary">
                        <div class="box-header">
                            <div class="col-sm-4">
                                <button type="button" name="btn_nuevo_asp" id="btn_nuevo_asp" class="btn btn-primary" data-toggle="modal" data-target="#modal_pre_inscripcion"><i class="fa fa-user-plus"></i> Aspirante</button>
                            </div>
                        </div>
                        <div class="box-body">
                            <div class="col-sm-12">
                                <div class="panel-body">
                                    <table id="tabla_inscricion" class="table small table-hover">
                                        <thead class="bg-light-blue">
                                        <tr>
                                            <th>Cedula</th>
                                            <th>Apellido Paterno</th>
                                            <th>Apellido Materno</th>
                                            <th>Nombres</th>
                                            <th>Usuario</th>
                                            <th>Departamento</th>
                                            <th><i class="fa fa-check"></i></th>
                                            <th>Accion</th>
                                        </tr>
                                        </thead>
                                    </table>
                                </div>
                            </div>
                            <!-- Modal inscripciones -->
                            <div id="modal_pre_inscripcion" class="modal fade" role="dialog" data-backdrop="static" data-keyboard=”false”>
                                <div class="modal-dialog">
                                    <!-- Modal content-->
                                    <div class="modal-content">
                                        <div class="modal-header" style="background-color: #3c8dbc ; color: white;">
                                            <button type="button"  id="btn_cerrar_md_asp" name="btn_cerrar_md_asp" class="close" data-dismiss="modal">&times;</button>
                                            <h4 class="modal-title">Registro Aspirante</h4>
                                        </div>
                                        <div class="modal-body">
                                            <div class="panel">
                                                <div class="panel-body">
                                                    <form id="form_aspirante" role="form" class="small" data-smk-icon="glyphicon glyphicon-remove">
                                                        <div class="col-sm-8">
                                                            <label for="cedula_asp">Cedula</label>
                                                            <div class="form-group">
                                                                <input type="text" id="cedula_asp" name="cedula_asp" class="form-control" minlength="10" data-smk-type="number" placeholder="cedula"  autofocus required>
                                                            </div>
                                                        </div>
                                                        <div class="col-sm-6">
                                                            <label for="apellido1_asp">Apellido Paterno</label>
                                                            <div class="form-group">
                                                                <input type="text" id="apellido1_asp" name="apellido1_asp" class="form-control" placeholder="apellido paterno" required>
                                                            </div>
                                                        </div>
                                                        <div class="col-sm-6">
                                                            <label for="apellido2_asp" class="control-label">Apellido Materno</label>
                                                            <div class="form-group">
                                                                <input type="text" id="apellido2_asp" name="apellido2_asp" class="form-control" placeholder="apellido materno" required>
                                                            </div>
                                                        </div>
                                                        <div class="col-sm-12">
                                                            <label for="nombres_asp" class="control-label">Nombres</label>
                                                            <div class="form-group">
                                                                <input type="text" id="nombres_asp"  name="nombres_asp" class="form-control" placeholder="nombres" required>
                                                            </div>
                                                        </div>
                                                        <div class="col-sm-12">
                                                            <label for="correo_institucion_asp" class="control-label">Usuario</label>
                                                            <div class="form-group">
                                                                <input type="email" id="correo_institucion_asp" name="correo_institucion_asp" class="form-control" placeholder="cuenta@utm.edu.ec" required>
                                                            </div>
                                                        </div>
                                                        <div id="claves_asp" hidden>
                                                            <div class="col-sm-6">
                                                                <label for="clave_asp" class="control-label">Contraseña</label>
                                                                <div class="form-group">
                                                                    <input type="password" id="clave_asp" name="clave_asp" class="form-control" placeholder="************">
                                                                </div>
                                                            </div>
                                                            <div class="col-sm-6">
                                                                <label for="clave_verifica_asp" class="control-label">Verificar Contraseña</label>
                                                                <div class="form-group">
                                                                    <input type="password" id="clave_verifica_asp" class="form-control" placeholder="*************">
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </form>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-sm-12">
                                                    <div class="pull-right">
                                                        <button type="button" id="btn_save_pre_insc" name="btn_save_pre_insc" class="btn btn-primary"><i class="fa fa-save"></i> Guardar</button>
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
                                                        <label for="usuario_sl_ctr" class="control-label">Usuario</label>
                                                        <div class="form-group">
                                                            <input type="text" id="usuario_sl_ctr" name="usuario_sl_ctr" class="form-control" placeholder="usuario" disabled>
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
                    <div class="box box-primary">
                        <div class="box-header">
                            <div class="col-md-4">
                                <label for="">Tipo Solicitud</label>
                                <div class="form-group">
                                    <select name="tipo_solicitud_tabla" id="tipo_solicitud_tabla" class="form-control">
                                        <option value="">seleccione</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="box-body">
                            <div class="col-sm-12">
                                <div id="tb_docente" hidden>
                                    <table id="tabla_solicitud_docente" class="table small table-hover table-bordered">
                                        <thead class="bg-light-blue">
                                        <tr>
                                            <th>Aspirante</th>
                                            <th>Tipo Solicitud</th>
                                            <th>Categoria</th>
                                            <th>Tipo Dedicacion</th>
                                            <th>Fecha</th>
                                            <th>Observacion</th>
                                            <th>Estado</th>
                                            <th>Accion</th>
                                        </tr>
                                        </thead>
                                    </table>
                                </div>
                                <div  id="tb_admin" hidden>
                                    <table id="tabla_solicitud_admini" class="table small table-hover table-bordered">
                                        <thead class="bg-light-blue">
                                        <tr>
                                            <th>Aspirante</th>
                                            <th>Tipo Solicitud</th>
                                            <th>Categoria</th>
                                            <th>Puesto</th>
                                            <th>Fecha</th>
                                            <th>Observacion</th>
                                            <th>Estado</th>
                                            <th>Accion</th>
                                        </tr>
                                        </thead>
                                    </table>
                                </div>
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
                                                <table id="tabla_proceso_solicitud" class="table small table-hover table-bordered">
                                                    <thead class="bg-light-blue">
                                                    <tr>
                                                        <th>
                                                            <i class="fa fa-cog" aria-hidden="true"></i>
                                                            Proceso
                                                        </th>
                                                        <th>
                                                            <i class="fa fa-calendar" aria-hidden="true"></i>
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
                                                            <i class="fa fa-info-circle" aria-hidden="true"></i>
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
    </div>
</div>
<script src="<?php base_url()?>src/app/registro_asp.js"></script>