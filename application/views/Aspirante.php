<div class="row">
    <div class="col-xs-12">
        <div class="nav-tabs-justified">
            <ul class="nav nav-tabs bg-gray-light">
                <li  role="presentation" class="active" >
                    <a href="#reg_aspirante" data-toggle="tab" class="fa fa-user-plus fa-2x" aria-hidden="true" title="per-inscripcion persona"></a>
                </li>
                <li  role="presentation">
                    <a href="#usuario_rol" data-toggle="tab" class="fa fa-unlock-alt fa-2x" aria-hidden="true" title="Usuario Permiso"></a>
                </li>
            </ul>
            <div class="tab-content">
                <div id="reg_aspirante"  class="tab-pane bg-gray-light active">
                    <div class="box box-primary">
                        <div class="box-header">
                            <div class="col-sm-4">
                                <button type="button" name="btn_nuevo_asp" id="btn_nuevo_asp" class="btn btn-primary" data-toggle="modal" data-target="#modal_pre_inscripcion"><i class="glyphicon glyphicon-plus"></i> Nuevo</button>
                            </div>
                        </div>
                        <div class="box-body">
                            <div class="col-sm-12">
                                <div class="panel-body">
                                    <table id="tabla_inscricion" class="table small table-striped table-hover table-bordered">
                                        <thead>
                                        <tr>
                                            <th>Cedula</th>
                                            <th>Apellido Paterno</th>
                                            <th>Apellido Materno</th>
                                            <th>Nombres</th>
                                            <th>Accion</th>
                                        </tr>
                                        </thead>
                                    </table>
                                </div>
                            </div>
                            <!-- Modal capacitaciones -->
                            <div id="modal_pre_inscripcion" class="modal fade" role="dialog" data-backdrop="static" data-keyboard=”false” >
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
                        </div>
                    </div>
                </div>
                <div id="usuario_rol" role="tabpanel" class="tab-pane fade in">
                    <div class="box box-primary">
                        <div class="box-header">
                            <div class="col-sm-4">
                                <button type="button" name="btn_nuevo_rol" id="btn_nuevo_rol" class="btn btn-primary" data-toggle="modal" data-target=""><i class="glyphicon glyphicon-plus"></i> Nuevo</button>
                            </div>
                        </div>
                        <div class="box-body">
                            <div class="col-sm-12">

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<script src="<?php base_url()?>src/app/registro_asp.js"></script>