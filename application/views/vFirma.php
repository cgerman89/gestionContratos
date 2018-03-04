<div class="row">
    <div class="col-xs-12">
        <div class="nav-tabs-justified">
            <ul class="nav nav-tabs bg-gray-light">
                <li role="presentation"  class="active" title="contratos por  aprobados">
                    <a href="#contratos_firmar" data-toggle="tab">
                        <i class="far fa-folder fa-2x"></i>
                        <i class="fas fa-pencil-alt"></i>
                    </a>
                </li>
                <li role="presentation"  title="contratos aprobados">
                    <a href="#contratos_aprobados" data-toggle="tab">
                        <i class="far fa-folder fa-2x"></i>
                        <i class="fas fa-check"></i>
                    </a>
                </li>
                <li role="presentation"  title="contratos rechazados">
                    <a href="#contratos_rechazados" data-toggle="tab">
                        <i class="far fa-folder fa-2x"></i>
                        <i class="fas fa-times"></i>
                    </a>
                </li>
            </ul>
            <div class="tab-content">
                <div id="contratos_firmar" role="tabpanel" class="tab-pane fade in active">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <div class="row">
                                <div class="col-md-8">
                                    <h4 class="text-muted">CONTRATOS POR FIRMAR</h4>
                                </div>
                                <div class="col-md-4">
                                    <select id="departamento_ctr_firma_th"  class="form-control" style="width: 100%">
                                        <option value="-2">SELECCIONE DEPARTAMENTO</option>
                                        <option value="-3">TODOS LOS DEPARTAMENTOS</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="panel-body">
                            <table id="tabla_lista_contratos_firma" class="table small table-hover table-bordered">
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
                                        <i class="fa fa-money" aria-hidden="true"></i>&nbsp;
                                        RMU
                                    </th>
                                    <th>
                                        <i class="fa fa-calendar" aria-hidden="true"></i>&nbsp;
                                        Fecha Inicio
                                    </th>
                                    <th>
                                        <i class="fa fa-calendar" aria-hidden="true"></i>&nbsp;
                                        Fecha Final
                                    </th>
                                    <th>
                                        <i class="fa fa-hashtag" aria-hidden="true"></i>
                                        MESES
                                    </th>
                                    <th>
                                        <i class="fa fa-graduation-cap" aria-hidden="true"></i>&nbsp;
                                        TITULO
                                    </th>
                                    <th>
                                        <i class="fa fa-building-o" aria-hidden="true"></i>
                                        DPTO.SOLICITANTE
                                    </th>
                                    <th>
                                        <i class="glyphicon glyphicon glyphicon-barcode"></i>
                                        COD.SOLICITUD
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
                <div id="contratos_aprobados" role="tabpanel" class="tab-pane fade in">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <div class="row">
                                <div class="col-md-8">
                                    <h4 class="text-muted">CONTRATOS APROBADOS</h4>
                                </div>
                                <div class="col-md-4">
                                    <select id="departamento_ctr_firma_apb"  class="form-control" style="width: 100%">
                                        <option value="-2">SELECCIONE DEPARTAMENTO</option>
                                        <option value="-3">TODOS LOS DEPARTAMENTOS</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="panel-body">
                            <table id="tabla_lista_contratos_apb" class="table small table-hover table-bordered">
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
                                        <i class="fa fa-money" aria-hidden="true"></i>&nbsp;
                                        RMU
                                    </th>
                                    <th>
                                        <i class="fa fa-calendar" aria-hidden="true"></i>&nbsp;
                                        Fecha Inicio
                                    </th>
                                    <th>
                                        <i class="fa fa-calendar" aria-hidden="true"></i>&nbsp;
                                        Fecha Final
                                    </th>
                                    <th>
                                        <i class="fa fa-hashtag" aria-hidden="true"></i>
                                        MESES
                                    </th>
                                    <th>
                                        <i class="fa fa-graduation-cap" aria-hidden="true"></i>&nbsp;
                                        TITULO
                                    </th>
                                    <th>
                                        <i class="fa fa-building-o" aria-hidden="true"></i>
                                        DPTO.SOLICITANTE
                                    </th>
                                    <th>
                                        <i class="glyphicon glyphicon glyphicon-barcode"></i>
                                        COD.SOLICITUD
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
                <div id="contratos_rechazados" role="tabpanel" class="tab-pane fade in">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <div class="row">
                                <div class="col-md-8">
                                    <h4 class="text-muted">CONTRATOS RECHAZADOS</h4>
                                </div>
                                <div class="col-md-4">
                                    <select id="departamento_ctr_firma_rdz"  class="form-control" style="width: 100%">
                                        <option value="-2">SELECCIONE DEPARTAMENTO</option>
                                        <option value="-3">TODOS LOS DEPARTAMENTOS</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="panel-body">
                            <table id="tabla_lista_contratos_rdz" class="table small table-hover table-bordered">
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
                                        <i class="fa fa-money" aria-hidden="true"></i>&nbsp;
                                        RMU
                                    </th>
                                    <th>
                                        <i class="fa fa-calendar" aria-hidden="true"></i>&nbsp;
                                        Fecha Inicio
                                    </th>
                                    <th>
                                        <i class="fa fa-calendar" aria-hidden="true"></i>&nbsp;
                                        Fecha Final
                                    </th>
                                    <th>
                                        <i class="fa fa-hashtag" aria-hidden="true"></i>
                                        MESES
                                    </th>
                                    <th>
                                        <i class="fa fa-graduation-cap" aria-hidden="true"></i>&nbsp;
                                        TITULO
                                    </th>
                                    <th>
                                        <i class="fa fa-building-o" aria-hidden="true"></i>
                                        DPTO.SOLICITANTE
                                    </th>
                                    <th>
                                        <i class="glyphicon glyphicon glyphicon-barcode"></i>
                                        COD.SOLICITUD
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
</div>
<div id="pdf_contrato" class="modal fullscreen-modal fade"  role="modal" data-backdrop="static" data-keyboard=”false”>
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header" style="background-color: #3c8dbc ; color: white;">
                <button type="button"  id="btn_cerrar_md_solicitud_asp" name="btn_cerrar_md_solicitud_asp" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title"> <i class="fas fa-file-pdf"></i> &nbsp;CONTRATO PDF</h4>
            </div>
            <div class="modal-body">
                <div id="contenedor_pdf_ctr"></div>
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
<div id="pdf_contenedor_hv" class="modal fullscreen-modal fade"  role="modal" data-backdrop="static" data-keyboard=”false”></div>
<div id="firma_md" class="modal fade" role="dialog" data-backdrop="static" data-keyboard=”false”>
    <div class="modal-dialog center-block">
        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header" style="background-color: #3c8dbc ; color: white;">
                <button type="button"  id="btn_cerrar_md_firma" name="btn_cerrar_md_firma" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">SUBIR CONTRATO</h4>
            </div>
            <div class="modal-body">
                <form id="form_file">
                    <input type="text" id="cedula_asp" hidden>
                    <input type="text" id="id_ctr" hidden>
                    <input type="file" id="contrato_file" name="contrato_file" class="form-control" placeholder="archivo pdf">
                    <br>
                    <div class="pull-right">
                        <button type="button" class="btn btn-success" id="btn_save_pdf" title="subir documento"><i class="fas fa-upload"></i></button>
                        <button type="button" class="btn btn-danger" id="btn_delete_pdf" title="eliminar documento"><i class="fas fa-trash-alt"></i></button>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <div class="pull-left">
                    <button type="button" id="btn_save_firma" class="btn btn-primary"><i class="fas fa-paper-plane"></i> &nbsp; &nbsp;Enviar</button>
                </div>
            </div>
        </div>
    </div>
</div>