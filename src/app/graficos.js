$(document).ready(function () {
    console.log('modulo graficos cargado...');
    const  departamento_soli=$('#departamento_soli');
    const  btn_reporte_soli=$('#btn_reporte_soli');
    const  departamento_ctr=$('#departamento_ctr');
    const  btn_reporte_ctr=$('#btn_reporte_ctr');
    var barras = document.getElementById("barras_soli").getContext('2d');
    var mybar  = null;


    departamento_soli.select2({theme:"bootstrap"});
    departamento_ctr.select2({theme:"bootstrap"});
    CargaComboDepartamentos_gr(departamento_soli);
    CargaComboDepartamentos_gr(departamento_ctr);


    btn_reporte_soli.click(function (e) {
        e.preventDefault();
        if((departamento_soli.val() !=='-2') && (departamento_soli.val() !=='-3')){
            Solicitudes(departamento_soli.val(),function (data) {
                    if(data !== null){
                        if (mybar !=null){
                            mybar.destroy();
                        }
                        var datos = {
                            labels: ["TOTAL","DOCENTES", "ADMINISTRATIVOS", "APROBADAS", "RECHAZADAS", "ANULADAS"],
                            datasets: [{
                                label: 'SOLICITUDES DE CONTRATOS',
                                data: [data.total,data.docentes,data.administrativos,data.aprobadas,data.rechazadas,data.anuladas],
                                backgroundColor: [
                                    'rgba(99, 149, 236, 0.5)',
                                    'rgba(111, 227, 82, 0.5)',
                                    'rgba(243, 246, 71, 0.5)',
                                    'rgba(14, 208, 238 , 0.5)',
                                    'rgba(237, 26, 16 , 0.5)',
                                    'rgba(255, 159, 64, 0.5)'
                                ],
                                borderColor: [
                                    'rgba(99, 149, 236,1)',
                                    'rgba(111, 227, 82,1)',
                                    'rgba(243, 246, 71,1)',
                                    'rgba(14, 208, 238 ,1)',
                                    'rgba(237, 26, 16 ,1)',
                                    'rgba(255, 159, 64,1)'
                                ],
                                borderWidth: 1
                            }]
                        };
                        var options = {
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
                        var datas = {
                            labels: data.titulos,
                            datasets: [
                                {
                                    label: 'DOCENTES',
                                    data: data.docentes,
                                    backgroundColor:'rgba(111, 227, 82, 0.5)',
                                    borderColor:'rgba(111, 227, 82,1)',
                                    borderWidth: 1
                                },
                                {
                                    label: 'ADMINISTRATIVOS',
                                    data: data.administrativos,
                                    backgroundColor:'rgba(243, 246, 71, 0.5)',
                                    borderColor:'rgba(243, 246, 71,1)',
                                    borderWidth: 1
                                }
                            ]
                        };
                        var opction = {
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

function Solicitudes(id_dpto,callback) {
    $.post('Grafico/Solicitudes',{'id_dpto':id_dpto},function (data) {
        callback(data);
    },'json');
}