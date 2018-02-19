<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<div class="row">
    <div class="col-xs-12">
        <div class="nav-tabs-justified" id="tabs_th">
            <ul class="nav nav-tabs bg-gray-light">
                <li role="presentation" class="active">
                    <a href="#g_solicitudes" data-toggle="tab" title="graficos de solicitudes">
                        <i class="far fa-file-alt fa-2x info"></i>
                    </a>
                </li>
                <li role="presentation">
                    <a href="#g_contratos" data-toggle="tab" title="graficos de contratos">
                        <i class="far fa-folder fa-2x"></i>
                        <i class="fa fa-line-chart text-info" aria-hidden="true"></i>
                    </a>
                </li>
            </ul>
            <div class="tab-content">
              <div id="g_solicitudes" class="tab-pane fade in active">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <div class="row">
                                <div class="col-sm-6">
                                    <h4 class="text-muted">GRAFICOS SOLICITUDES</h4>
                                </div>
                                <div class="col-sm-4">
                                    <select id="departamento_soli"  class="form-control" style="width: 100%">
                                        <option value="-2">SELECCIONE DEPARTAMENTO</option>
                                        <option value="-3">TODOS LOS DEPARTAMENTOS</option>
                                    </select>
                                </div>
                                <div class="col-sm-2">
                                    <div class="pull-right">
                                        <button type="button" class="btn btn-primary" id="btn_reporte_soli"><i class="fas fa-chart-bar"></i> &nbsp; Generar</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="panel-body">
                            <div class="row">
                                <div  class="col-xs-10 col-xs-offset-1">
                                    <canvas id="barras_soli" width="500" height="200"></canvas>
                                </div>
                            </div>
                        </div>
                    </div>
              </div>
              <div id="g_contratos" class="tab-pane fade in">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <div class="row">
                                <div class="col-sm-6">
                                    <h4 class="text-muted">GRAFICOS CONTRATOS</h4>
                                </div>
                                <div class="col-sm-4">
                                    <select id="departamento_ctr"  class="form-control" style="width: 100%">
                                        <option value="-2">SELECCIONE DEPARTAMENTO</option>
                                        <option value="-3">TODOS LOS DEPARTAMENTOS</option>
                                    </select>
                                </div>
                                <div class="col-sm-2">
                                    <div class="pull-right">
                                        <button type="button" class="btn btn-primary" id="btn_reporte_ctr"><i class="fa fa-line-chart" aria-hidden="true"></i> &nbsp; Generar</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="panel-body">
                            <div class="row">
                                <div class="col-xs-10 col-xs-offset-1">
                                    <canvas id="barras_contratos" width="500" height="200"></canvas>
                                </div>
                            </div>
                        </div>
                    </div>

              </div>
            </div>
        </div>
    </div>

</div>