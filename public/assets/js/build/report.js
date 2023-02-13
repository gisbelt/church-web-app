$(document).ready(function () {
    $('[data-bs-target]').click(function() {
        let target = $(this).data('bs-target')
        $(target).trigger('click');
        switch (target) {
            case '#report1':
                report1();
                break;
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
    report1();
    report5();
    report6();
    report7();
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
                        color.push('rgba(54, 162, 235, 1)');
                        bordercolor = ['rgba(54, 162, 235, 1)'];
                    } else {
                        color = ['rgba(255, 99, 132, 1)'];
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
                        maintainAspectRatio: false,
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
            for (let j=0; j<mes.length; j++) {
                const r = Math.floor(Math.random() * 255)
                const g = Math.floor(Math.random() * 255)
                const b = Math.floor(Math.random() * 255)
                color.push(`rgba(${r}, ${g}, ${b}, 1)`)                
                bordercolor.push(`rgba(${r}, ${g}, ${b}, 1)`)                
            }
            let chartdata = {
                labels: mes,
                datasets: [{
                    label: mes,
                    backgroundColor: color,
                    borderColor: bordercolor,
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
                    maintainAspectRatio: false,
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
                    let color = [];
                    let bordercolor = [];
                    for (let i in data.gruposAmigos) {
                        grupo.push(data.gruposAmigos[i].grupo);
                        cantidad_amigos.push(data.gruposAmigos[i].cantidad_amigos);
                    }
                    for (let j=0; j<grupo.length; j++) {
                        const r = Math.floor(Math.random() * 255)
                        const g = Math.floor(Math.random() * 255)
                        const b = Math.floor(Math.random() * 255)
                        color.push(`rgba(${r}, ${g}, ${b}, 1)`)                
                        bordercolor.push(`rgba(${r}, ${g}, ${b}, 1)`)                
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
                            maintainAspectRatio: false,
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
                    let color = [];
                    let bordercolor = [];
                    for (let i in data.gruposIngresados) {
                        grupo.push(data.gruposIngresados[i].grupo);
                        cantidad_familia.push(data.gruposIngresados[i].cantidad_familia);
                    }
                    for (let j=0; j<grupo.length; j++) {
                        const r = Math.floor(Math.random() * 255)
                        const g = Math.floor(Math.random() * 255)
                        const b = Math.floor(Math.random() * 255)
                        color.push(`rgba(${r}, ${g}, ${b}, 1)`)                
                        bordercolor.push(`rgba(${r}, ${g}, ${b}, 1)`)                
                    }
                    let chartdata = {
                        labels: grupo,
                        datasets: [{
                            label: grupo,
                            backgroundColor: color,
                            borderColor: bordercolor,
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
                            maintainAspectRatio: false,
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



