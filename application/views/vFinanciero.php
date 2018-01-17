<div class="row">
    <div class="col-xs-12">
        <div class="nav-tabs-justified">
            <ul class="nav nav-tabs bg-gray-light">
                <li role="presentation" class="active" >
                    <a href="#proc_financiero" data-toggle="tab">
                        <i class="fa fa-folder-open-o fa-2x text-info" aria-hidden="true"></i>
                        <i class="glyphicon glyphicon-random text-info" aria-hidden="true"></i>
                    </a>
                </li>
                <li role="presentation"   title="contratos aprobados">
                    <a href="#contratosaprobados" data-toggle="tab">
                        <i class="fa fa-folder-open-o fa-2x text-info" aria-hidden="true"></i>
                        <i class="fa fa-check text-info" aria-hidden="true"></i>
                    </a>
                </li>
                <li role="presentation"   title="contratos rechazados">
                    <a href="#contratos_rechazados" data-toggle="tab">
                        <i class="fa fa-folder-o fa-2x text-info" aria-hidden="true"></i>
                        <i class="fa fa-times text-info" aria-hidden="true"></i>
                    </a>
                </li>
            </ul>
            <div class="tab-content">
                <div id="proc_financiero" role="tabpanel" class="tab-pane fade in active">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <div class="row">
                                <div class="col-md-8">
                                    <h4 class="text-muted">APROBAR CONTRATOS</h4>
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
                                <thead class="bg-light-blue">
                                <tr>
                                    <th>
                                        <i class="glyphicon glyphicon glyphicon-barcode"></i>&nbsp;
                                        CODIGO
                                    </th>
                                    <th>
                                        MODALIDAD LABORAL
                                    </th>
                                    <th>
                                        <i class="fa fa-globe" aria-hidden="true"></i>&nbsp;
                                        PAIS
                                    </th>
                                    <th>
                                        <i class="fa fa-user-o" aria-hidden="true"></i>&nbsp;
                                        ASPIRANTE
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
                                        <i class="fa fa-money" aria-hidden="true"></i>&nbsp;
                                        RMU
                                    </th>
                                    <th>
                                        <i class="fa fa-calendar" aria-hidden="true"></i>&nbsp;&nbsp;
                                        Fecha Inicio
                                    </th>
                                    <th>
                                        <i class="fa fa-calendar" aria-hidden="true"></i>&nbsp;&nbsp;
                                        Fecha Final
                                    </th>
                                    <th>
                                        <i class="fa fa-calendar-o" aria-hidden="true"></i>&nbsp;
                                        MESES
                                    </th>
                                    <th>
                                        510510
                                    </th>
                                    <th>
                                        510203
                                    </th>
                                    <th>
                                        510204
                                    </th>
                                    <th>
                                        510601
                                    </th>
                                    <th>
                                        510602
                                    </th>
                                    <th>
                                        TOTAL MASA SALARIAL 
                                    </th>                                    
                                    <th>
                                        <i class="fa fa-cog" aria-hidden="true"></i>
                                        Accion
                                    </th>
                                </tr>
                                </thead>
                                <tfoot> 
                                   <th></th>
                                   <th></th>
                                   <th></th>
                                   <th></th>
                                   <th></th>
                                   <th></th>
                                   <th></th>
                                   <th></th>
                                   <th></th>
                                   <th></th>
                                   <th></th>
                                   <th></th>
                                   <th></th>
                                   <th></th>
                                   <th></th>
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
                                <thead class="bg-light-blue">
                                <tr>
                                    <th>
                                        <i class="glyphicon glyphicon glyphicon-barcode"></i>&nbsp;
                                        CODIGO
                                    </th>
                                    <th>
                                        MODALIDAD LABORAL
                                    </th>
                                    <th>
                                        <i class="fa fa-globe" aria-hidden="true"></i>&nbsp;
                                        PAIS
                                    </th>
                                    <th>
                                        <i class="fa fa-user-o" aria-hidden="true"></i>&nbsp;
                                        ASPIRANTE
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
                                        <i class="fa fa-money" aria-hidden="true"></i>&nbsp;
                                        RMU
                                    </th>
                                    <th>
                                        <i class="fa fa-calendar" aria-hidden="true"></i>&nbsp;&nbsp;
                                        Fecha Inicio
                                    </th>
                                    <th>
                                        <i class="fa fa-calendar" aria-hidden="true"></i>&nbsp;&nbsp;
                                        Fecha Final
                                    </th>
                                    <th>
                                        <i class="fa fa-calendar-o" aria-hidden="true"></i>&nbsp;
                                        MESES
                                    </th>
                                    <th>
                                        510510
                                    </th>
                                    <th>
                                        510203
                                    </th>
                                    <th>
                                        510204
                                    </th>
                                    <th>
                                        510601
                                    </th>
                                    <th>
                                        510602
                                    </th>
                                    <th>
                                        TOTAL MASA SALARIAL 
                                    </th>                                    
                                    <th>
                                        PARTIDA
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
                                <thead class="bg-light-blue">                           
                                <tr>
                                    <th>
                                        <i class="glyphicon glyphicon glyphicon-barcode"></i>&nbsp;
                                        CODIGO
                                    </th>
                                    <th>
                                        MODALIDAD LABORAL
                                    </th>
                                    <th>
                                        <i class="fa fa-globe" aria-hidden="true"></i>&nbsp;
                                        PAIS
                                    </th>
                                    <th>
                                        <i class="fa fa-user-o" aria-hidden="true"></i>&nbsp;
                                        ASPIRANTE
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
                                        <i class="fa fa-money" aria-hidden="true"></i>&nbsp;
                                        RMU
                                    </th>
                                    <th>
                                        <i class="fa fa-calendar" aria-hidden="true"></i>&nbsp;&nbsp;
                                        Fecha Inicio
                                    </th>
                                    <th>
                                        <i class="fa fa-calendar" aria-hidden="true"></i>&nbsp;&nbsp;
                                        Fecha Final
                                    </th>
                                    <th>
                                        <i class="fa fa-calendar-o" aria-hidden="true"></i>&nbsp;
                                        MESES
                                    </th>
                                    <th>
                                        510510
                                    </th>
                                    <th>
                                        510203
                                    </th>
                                    <th>
                                        510204
                                    </th>
                                    <th>
                                        510601
                                    </th>
                                    <th>
                                        510602
                                    </th>
                                    <th>
                                        TOTAL MASA SALARIAL 
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
</div>
