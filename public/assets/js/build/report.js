$(document).ready(function () {
    $('[data-bs-target]').click(function() {
        let target = $(this).data('bs-target')
        $(target).trigger('click');
        switch (target) {
            case '#report1':
                report1();
                break;

            /*case '#report2':
                report2();
                break;

            case '#report3':
                report3();
                break;

            case '#report4':
                report4(); 
                break;*/
            case '#report5':
                report5(); 
                break;
            case '#report6':
                report6(); 
                break;
            case '#report7':
                report7(); 
                break;
        }
    })   
});

const report1 = function () {
    let $grafica_one = $("#report_one");
    let $form = $("#form-report-one");
    let $button = $("#busqueda_reporte_one");
    $button.click(function () {
        $.ajax({
            url: $form.attr('action') + '?' + $form.serialize(),
            dataType: 'json',
            contentType: "application/json; charset=utf-8",
            method: "GET",
            success: function (data) {
                let sexo = [];
                let cantidad = [];
                let color = [];
                let bordercolor = [];

                for (let i in data.miembros) {
                    sexo.push(data.miembros[i].sexo);
                    cantidad.push(data.miembros[i].cantidad);
                    if(data.miembros[i].sexo == 'Masculino'){
                        color.push('rgba(54, 162, 235, 0.2)');
                        bordercolor = ['rgba(54, 162, 235, 1)'];
                    } else {
                        color = ['rgba(255, 99, 132, 0.2)'];
                        bordercolor = ['rgba(255,99,132,1)'];
                    }
                }

                let chartdata = {
                    labels: sexo,
                    datasets: [{
                        label: sexo,
                        backgroundColor: color,
                        borderColor: color,
                        borderWidth: 2,
                        hoverBackgroundColor: color,
                        hoverBorderColor: bordercolor,
                        data: cantidad
                    }]
                };

                new Chart($grafica_one, {
                    type: 'doughnut',
                    data: chartdata,
                    options: {
                        responsive: true,
                        scales: {
                            yAxes: [{
                                ticks: {
                                    beginAtZero: true
                                }
                            }]
                        }
                    }
                });
            },
            error: function (data) {
                console.log(data);
            }
        });
    });
}

/*const report2 = function () {
    let $grafica_one = document.querySelector("#report_two");
    let datosVentas2020 = {
        label: "Ventas por mes",
        data: [5000, 1500, 8000, 5102],
        backgroundColor: [
            'rgb(255, 99, 132)',
            'rgb(54, 162, 235)',
            'rgb(255, 205, 86)'
        ],
        borderColor: 'rgba(54, 162, 235, 1)',
        borderWidth: 2,
    };

    let $report_one = new Chart($grafica_one, {
        type: 'doughnut',
        data: {
            labels: ["Enero", "Febrero", "Marzo", "Abril"],
            datasets: [
                datosVentas2020,
            ]
        },
        options: {
            scales: {
                yAxes: [{
                    ticks: {
                        beginAtZero: true
                    }
                }],
            },
        }
    });
}

const report3 = function () {
    let $grafica_one = document.querySelector("#report_three");
    let datosVentas2020 = {
        label: "Ventas por mes",
        data: [5000, 1500, 8000, 5102],
        backgroundColor: [
            'rgb(255, 99, 132)',
            'rgb(54, 162, 235)',
            'rgb(255, 205, 86)'
        ],
        borderColor: 'rgba(54, 162, 235, 1)',
        borderWidth: 2,
    };

    let $report_one = new Chart($grafica_one, {
        type: 'doughnut',
        data: {
            labels: ["Enero", "Febrero", "Marzo", "Abril"],
            datasets: [
                datosVentas2020,
            ]
        },
        options: {
            scales: {
                yAxes: [{
                    ticks: {
                        beginAtZero: true
                    }
                }],
            },
        }
    });
}

const report4 = function () {
    let $grafica_one = document.querySelector("#report_four");
    let datosVentas2020 = {
        label: "Ventas por mes",
        data: [5000, 1500, 8000, 5102],
        backgroundColor: [
            'rgb(255, 99, 132)',
            'rgb(54, 162, 235)',
            'rgb(255, 205, 86)'
        ],
        borderColor: 'rgba(54, 162, 235, 1)',
        borderWidth: 2,
    };

    let $report_one = new Chart($grafica_one, {
        type: 'doughnut',
        data: {
            labels: ["Enero", "Febrero", "Marzo", "Abril"],
            datasets: [
                datosVentas2020,
            ]
        },
        options: {
            scales: {
                yAxes: [{
                    ticks: {
                        beginAtZero: true
                    }
                }],
            },
        }
    });
}*/

const report5 = function () {
    let $grafica_five = $("#report_five");
    $.ajax({
        url: $grafica_five.data('route'),
        dataType: 'json',
        contentType: "application/json; charset=utf-8",
        method: "GET",
        success: function (data) {                
            let mes = [];
            let cantidad = [];
            let color = [];
            let bordercolor = [];
            for (let i in data.grupos) {                    
                mes.push(data.grupos[i].mes)
                cantidad.push(data.grupos[i].cantidad);
            }
            let chartdata = {
                labels: mes,
                datasets: [{
                    label: mes,
                    backgroundColor: [
                        'rgb(255, 205, 86)',
                        'rgb(54, 162, 70)',
                        'rgb(54, 162, 165)',
                        'rgb(54, 162, 40)',
                        'rgb(54, 162, 145)',
                        'rgb(54, 162, 20)',
                        'rgb(54, 162, 125)',
                        'rgb(54, 162, 19)',
                        'rgb(54, 162, 219)',
                        'rgb(54, 162, 17)',
                        'rgb(255, 99, 132)',
                        'rgb(54, 162, 235)',
                    ],
                    borderColor: [
                        'rgb(255, 99, 132)',
                        'rgb(54, 162, 235)',
                        'rgb(255, 205, 86)',
                        'rgb(54, 162, 70)',
                        'rgb(54, 162, 165)',
                        'rgb(54, 162, 40)',
                        'rgb(54, 162, 145)',
                        'rgb(54, 162, 20)',
                        'rgb(54, 162, 125)',
                        'rgb(54, 162, 19)',
                        'rgb(54, 162, 219)',
                        'rgb(54, 162, 17)',
                    ],
                    borderWidth: 2,
                    hoverBackgroundColor: color,
                    hoverBorderColor: bordercolor,
                    data: cantidad
                }]
            };

            new Chart($grafica_five, {
                type: 'pie',
                data: chartdata,
                options: {
                    responsive: true,
                    scales: {
                        yAxes: [{
                            ticks: {
                                beginAtZero: true
                            }
                        }]
                    }
                }
            });
        },
        error: function (data) {
            console.log(data);
        }
    });
}

const report6 = function () {
    let $grafica_six = $("#report_six");
    let $form = $("#form-report-six");
    let $button = $("#busqueda_reporte_six");
    $button.click(function () {
        $.ajax({
            url: $form.attr('action'),
            data: $form.serialize(),
            dataType: 'json',
            contentType: "application/json; charset=utf-8",
            method: "GET",
            success: function (data) {
                if (data.code == 422) {
                    let html = '<ul class="list-group list-group-flush">';
                    html += '<li class="list-group-item">' + data.messages + '</li>';
                    html += '</ul>';    
                    swal.fire({
                        title: data.title,
                        html: html,
                        icon: 'error',
                        showConfirmButton: false,
                        showCancelButton: true,
                        cancelButtonText: 'close'
                    });
                } else {
                    let grupo = [];
                    let cantidad_amigos = [];
                    let color = [
                        'rgb(255, 99, 132, 0.7)',
                        'rgb(54, 162, 235, 0.7)',
                        'rgb(255, 205, 86, 0.7)',
                    ];
                    let bordercolor = [
                        'rgb(255, 99, 132)',
                        'rgb(54, 162, 235)',
                        'rgb(255, 205, 86)',
                    ];

                    for (let i in data.gruposAmigos) {
                        grupo.push(data.gruposAmigos[i].grupo);
                        cantidad_amigos.push(data.gruposAmigos[i].cantidad_amigos);
                    }
                    let chartdata = {
                        labels: grupo,
                        datasets: [{
                            label: grupo,
                            backgroundColor: color,
                            borderColor: color,
                            borderWidth: 2,
                            hoverBackgroundColor: color,
                            hoverBorderColor: bordercolor,
                            data: cantidad_amigos
                        }]
                    };
                    new Chart($grafica_six, {
                        type: 'doughnut',
                        data: chartdata,
                        options: {
                            responsive: true,
                            scales: {
                                yAxes: [{
                                    ticks: {
                                        beginAtZero: true
                                    }
                                }]
                            }
                        }
                    });
                }
            },
            error: function (data) {
                console.log(data);
            }
        });
    });
}

const report7 = function () {
    let $grafica_seven = $("#report_seven");
    let $form = $("#form-report-seven");
    let $button = $("#busqueda_reporte_seven");
    $button.click(function () {
        $.ajax({
            url: $form.attr('action'),
            data: $form.serialize(),
            dataType: 'json',
            contentType: "application/json; charset=utf-8",
            method: "GET",
            success: function (data) {
                if (data.code == 422) {
                    let html = '<ul class="list-group list-group-flush">';
                    html += '<li class="list-group-item">' + data.messages + '</li>';
                    html += '</ul>';    
                    swal.fire({
                        title: data.title,
                        html: html,
                        icon: 'error',
                        showConfirmButton: false,
                        showCancelButton: true,
                        cancelButtonText: 'close'
                    });
                } else {
                    let grupo = [];
                    let cantidad_familia = [];
                    let color = [
                        'rgb(255, 99, 132, 0.7)',
                        'rgb(54, 162, 235, 0.7)',
                        'rgb(255, 205, 86, 0.7)',
                    ];
                    let bordercolor = [
                        'rgb(255, 99, 132)',
                        'rgb(54, 162, 235)',
                        'rgb(255, 205, 86)',
                    ];

                    for (let i in data.gruposIngresados) {
                        grupo.push(data.gruposIngresados[i].grupo);
                        cantidad_familia.push(data.gruposIngresados[i].cantidad_familia);
                    }
                    let chartdata = {
                        labels: grupo,
                        datasets: [{
                            label: grupo,
                            backgroundColor: color,
                            borderColor: color,
                            borderWidth: 2,
                            hoverBackgroundColor: color,
                            hoverBorderColor: bordercolor,
                            data: cantidad_familia
                        }]
                    };
                    new Chart($grafica_seven, {
                        type: 'doughnut',
                        data: chartdata,
                        options: {
                            responsive: true,
                            scales: {
                                yAxes: [{
                                    ticks: {
                                        beginAtZero: true
                                    }
                                }]
                            }
                        }
                    });
                }
            },
            error: function (data) {
                console.log(data);
            }
        });
    });
}



