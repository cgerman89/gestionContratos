$(document).ready(function () {
    console.log('modulo graficos cargado...');
    const  departamento_soli=$('#departamento_soli');
    const  btn_reporte_soli=$('#btn_reporte_soli');
    const  departamento_ctr=$('#departamento_ctr');
    const  btn_reporte_ctr=$('#btn_reporte_ctr');
    let barras = document.getElementById("barras_soli").getContext('2d');
    let mybar  = null;
    let barras_ctr = document.getElementById("barras_contratos").getContext('2d');
    let mybar_ctr  = null;
    const t_contrato=$('#t_contrato');


    departamento_soli.select2({theme:"bootstrap"});
    departamento_ctr.select2({theme:"bootstrap"});
    CargaComboDepartamentos_gr(departamento_soli);
    CargarTipo(t_contrato);
    CargaComboDepartamentos_gr(departamento_ctr);



    btn_reporte_soli.click(function (e) {
        e.preventDefault();
        if((departamento_soli.val() !=='-2') && (departamento_soli.val() !=='-3')){
            Solicitudes(departamento_soli.val(),function (data) {
                    if(data !== null){
                        if (mybar !=null){
                            mybar.destroy();
                        }
                        let datos = {
                            labels: ["PROCESO", "APROBADA","RECHAZADA","ANULADA","TOTAL"],
                            datasets: [{
                                label: 'DOCENTES',
                                data: [data.proceso_docente,data.apb_docente,data.rdz_docente,data.anu_docente,data.docente],
                                backgroundColor:'rgba(8, 214, 80  , 0.5)',
                                borderColor:'rgba(8, 214, 80 ,1)',
                                borderWidth: 1
                            },
                            {   label: 'ADMINISTRATIVOS',
                                data: [data.proceso_administrativo,data.apb_administrativo,data.rdz_administrativo,data.anu_administrativo,data.administrativo],
                                backgroundColor:'rgba(5, 116, 193, 0.5)',
                                borderColor:'rgba(5, 116, 193,1)',
                                borderWidth: 1
                            }
                            ]
                        };
                        let options = {
                            responsive: true,
                            title: {
                                display: true,
                                position: "top",
                                text: "SOLICITUD CONTRATO",
                                fontSize: 18,
                                fontColor: "#111"
                            },
                            legend: {
                                display: true,
                                position: "bottom",
                                labels: {
                                    fontColor: "#333",
                                    fontSize: 16
                                }
                            },
                            scales: {
                                yAxes: [{
                                    ticks: {
                                        beginAtZero:true
                                    }
                                }]
                            }
                        };
                        mybar = Chart.Bar(barras, {
                            type: 'bar',
                            data: datos,
                            options: options
                        });
                    }else{
                        if (mybar !=null){
                            mybar.destroy();
                        }
                        toastr.error('No Tiene Registros');
                    }
                });
        }else if (departamento_soli.val() === '-3'){
                Solicitudes(departamento_soli.val(), function (data) {
                    if (data !== null) {
                        if (mybar !=null){
                            mybar.destroy();
                        }
                        let datas = {
                            labels: data.titulos,
                            datasets: [
                                {
                                    label: 'DOCENTES',
                                    data: data.docentes,
                                    backgroundColor:'rgba(8, 214, 80, 0.5)',
                                    borderColor:'rgba(8, 214, 80  , 1)',
                                    borderWidth: 1
                                },
                                {
                                    label: 'ADMINISTRATIVOS',
                                    data: data.administrativos,
                                    backgroundColor:'rgba(5, 116, 193, 0.5)',
                                    borderColor:'rgba(5, 116, 193, 1)',
                                    borderWidth: 1
                                }
                            ]
                        };
                        let opction = {
                            responsive: true,
                            title: {
                                display: true,
                                position: "top",
                                text: "SOLICITUD CONTRATO",
                                fontSize: 18,
                                fontColor: "#111"
                            },
                            legend: {
                                display: true,
                                position: "bottom",
                                labels: {
                                    fontColor: "#333",
                                    fontSize: 16
                                }
                            },
                            scales: {
                                yAxes: [{
                                    ticks: {
                                        beginAtZero: true
                                    }
                                }]
                            }
                        };
                        mybar = Chart.Bar(barras, {
                            data: datas,
                            options:opction
                        });
                    } else {
                        if (mybar !=null){
                            mybar.destroy();
                        }
                        toastr.error('No Tiene Registros');
                    }
                });
        }
    });

    btn_reporte_ctr.click(function (e) {
        e.preventDefault();

    });

});

function CargaComboDepartamentos_gr(combo) {
    $.post('cTalento_humano/GetListadoDepartamentos',function (datos, estado, xhr) {
        if (estado === 'success') $.each(datos, function (index, value) {
            $(combo).append('<option value='+value.iddepartamento+'>'+value.nombre+'</option>');
        });
    },'json');
}

function CargarTipo(combo){
   $.post('Campos/Tipo2',{'id':1},function (datos,estado) {
      if (estado === 'success'){
          if (estado === 'success') $.each(datos, function (index, value) {
              $(combo).append('<option value='+value.idtipo+'>'+value.nombre+'</option>');
          });
      }
    },'json');
}

function Solicitudes(id_dpto,callback) {
    $.post('Grafico/Solicitudes',{'id_dpto':id_dpto},function (data) {
        callback(data);
    },'json');
}