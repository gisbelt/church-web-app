$(document).ready(function () {

    $('[data-bs-target]').click(function() {
        let target = $(this).data('bs-target')
        $(target).trigger('click');
        switch (target) {
            case '#report1':
                report1();
                break;

            case '#report2':
                report2();
                break;

            case '#report3':
                report3();
                break;

            case '#report4':
                report4();
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

const report2 = function () {
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
    let $grafica_one = document.querySelector("#report_tre");
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
}


