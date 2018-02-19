<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<div class="row">
    <div class="col-xs-12">
        <div class="nav-tabs-justified" id="tabs_th">
            <ul class="nav nav-tabs bg-gray-light">
                <li role="presentation" class="active">
                    <a href="#texto_contratos" data-toggle="tab" title="texto de contrato">
                        <i class="far fa-file-alt fa-2x"></i>
                        <i class="fas fa-pencil-alt"></i>
                    </a>
                </li>
            </ul>
            <div class="tab-content">
               <div id="texto_contratos">
                   <div class="panel panel-default">
                       <div class="panel-heading">
                          <div class="row">
                              <div class="col-sm-6">
                                  <h4 class="text-muted">TEXTO CONTRATOS</h4>
                              </div>
                              <div class="col-sm-3">
                                  <select name="tipo_ctr_2" id="tipo_ctr_2" class="form-control">
                                      <option value="">seleccione</option>
                                  </select>
                              </div>
                              <div class="col-sm-3">
                                  <div class="pull-right">
                                      <button class="btn btn-primary" id="btn_agregar_texto"><i class="fas fa-edit"></i>&nbsp; Agregar</button>
                                  </div>
                              </div>
                          </div>
                       </div>
                       <div class="panel-body">
                           <table id="tbl_texto" class="table table-bordered">
                               <thead class="bg-light-blue">
                                 <tr>
                                     <th>DENOMINACION</th>
                                     <th>FECHA</th>
                                     <th>ACCIONES</th>
                                 </tr>
                               </thead>
                               <tbody></tbody>
                           </table>
                       </div>
                   </div>
               </div>
            </div>
        </div>
        <div id="md_agregar_texto_ctr" class="modal fade" role="dialog" data-backdrop="static" data-keyboard=”false”>
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header" style="background-color: #3c8dbc ; color: white;">
                        <button type="button"  id="btn_cerrar_md_texto" name="btn_cerrar_md_solicitud_asp" class="close" data-dismiss="modal">&times;</button>
                        <h4 class="modal-title"><i class="fa fa-pencil-square-o" aria-hidden="true"></i>&nbsp; Formulario Texto Contrato</h4>
                    </div>
                    <div class="modal-body">
                        <div class="panel-body">
                            <form id="form_texto" role="form">
                                <div class="col-sm-4">
                                    <input type="text" id="id_texto" hidden>
                                    <label for="tipo_ctr" class="control-label">TIPO</label>
                                    <div class="form-group">
                                        <select name="tipo_ctr" id="tipo_ctr" class="form-control" required>
                                            <option value="">seleccione</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-sm-12">
                                    <label for="denominacion_ctr" class="control-label">DENOMINACION</label>
                                    <div class="form-group">
                                        <select name="denominacion_ctr" id="denominacion_ctr" class="form-control" required>
                                            <option value="">seleccione</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-sm-12">
                                    <textarea class="form-control" name="txt_texto" id="txt_texto" cols="30" rows="20" required></textarea>
                                </div>
                            </form>
                        </div>
                        <div class="row">
                            <div class="col-sm-12">
                                <div class="pull-right">
                                    <button type="button" class="btn btn-primary" id="btn_guardar_texto"> <i class="far fa-save fa-1x"></i> &nbsp; Guardar</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
