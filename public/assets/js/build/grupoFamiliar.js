$(document).ready(function(){    
    listaAmigos();
    buscarAmigo();    
    registrarGrupoFamiliar();  
    listaGrupoFamiliar();
    actualizar();
    eliminarGrupo()
    asignarAmigo()
    eliminarAmigo()
});

const button = document.getElementById('agregarGrupoFamiliar');
const button2 = document.getElementById('add-amigo');
const button3 = document.getElementsByClassName('add-amigo-lista');
const button4 = document.getElementById('agregar-amigo-grupo');

//Lista Amigos
const listaAmigos = function (){
    let $table = $("#amigos-table");
    $table.DataTable({
        "ajax": {
            "url": $table.data("route"),
            "dataSrc": "amigos"
        },
        "columns": [
            {"data": "cedula"},
            {"data": "nombre_completo", "className": "nombre_completo"},
            {"data": "actions", "className": "center"},
        ],
        dom: 'Bfrtip',
        buttons: [
            'copyHtml5',
            'excelHtml5',
            'csvHtml5',
            'pdfHtml5'
        ],
        "initComplete": function () {
            api = this.api();
            api.buttons().container().appendTo($('#table-buttons'));
            nuevoAmigo('add-amigo','.new-amigo');
        }
    })
}

// Buscar amigo que no tenga grupo familiar 
const buscarAmigo = () =>{       
    $("#amigo").keyup(function () {
        const valorBusqueda = this.value;
        var v = $(this).val().length;
        if (v > 0) {
            obtener_registros(valorBusqueda);
        } else {
            $(".tabla_resultado").fadeOut(100);
            button2.classList.add('disabled') 
        }
    });              
    const obtener_registros = (amigos) => {
        const nombreAmigo = document.getElementById('amigo').value;
        $.ajax({
            url: '/grupo-familiares/buscar-amigo',
            data:{
                'nombreAmigo':nombreAmigo
            },
            type: 'POST',
            dataType: 'json',
            success: function(data){
                const lista = document.querySelector('#tabla_resultado');
                const campoAmigo = document.getElementById('amigo'); 
                //Filtramos los resultados según el valor que ha insertado el usuario
                const datos = data.filter ( results => results );                                         
                // Recorremos con el map los resultados filtrados para crear cada elemento
                lista.innerHTML = datos.map((result) => {
                    return `
                    <li 
                    class='list-group-item bi bi-chevron-right pointer tabla_resultado' 
                    data-id='${result.id }'
                    >${result.cedula} - <span>${result.nombre_completo}</span></li>
                    `                        
                }).join("");
                // Rellenar campo al hacer click en el elemento creado 
                $('.tabla_resultado').click(function (e) {                        
                    const id = $(this).attr("data-id");
                    const texto = $(this).children().text();
                    campoAmigo.setAttribute('data-id', id);
                    campoAmigo.value = texto;
                    campoAmigo.focus();
                    button2.classList.remove('disabled')  
                    $('.tabla_resultado').fadeOut(100);
                });
            },
            error: function(){} 
        })
    }        
}

// Agregar item de amigo    
const nuevoAmigo = (addAmigo, nuevoAmigo) =>{
    const add = document.getElementById(addAmigo), 
    NuevoAmigo = $(nuevoAmigo);
    if(add, NuevoAmigo){
        var i=0;
        $(button2).on('click', function (e){
            i++;
            button.disabled = false;
            $(this).addClass("disabled");
            
            const amigo = $('#amigo').val(); 
            const amigo_id = $('#amigo').attr("data-id");
            
            const div = $("<div class='amigo-numero"+i+" input-group'></div>");
            const input = $("<input type='text' name='amigo_id' class='form-control form-input mb-4 amigo_id' id='integrante"+i+"' value='"+amigo+"' placeholder=' ' data-id='"+amigo_id+"' disabled>");
            const label = $("<label for='integrante"+i+"' class='form-label fw-bold' id='form-label'>Integrante:</label>")
            const input_group_append = $("<span class='input-group-append'></span>")
            const input_group_text = $("<span class='input-group-text bg-transparent border-0'></span>")
            const btn_remove = $("<a id='"+i+"' class='btn btn-danger btn-remove'></a>")
            const icon = $("<i class='bi bi-x'></i>");

            btn_remove.append(icon);
            input_group_text.append(btn_remove);
            input_group_append.append(input_group_text);
            div.append(input);
            div.append(label);
            div.append(input_group_append);
            NuevoAmigo.append(div);
            $('#amigo').val(''); 
        })
        //Agregar de la lista
        $(button3).on('click', function (e){
            i++;
            button ? button.disabled = false: true;
            button4 ? button4.disabled = false: true;
            const amigo = $(this).parents("tr").find(".nombre_completo").text();
            const amigo_id = $(this).attr("data-id");
            
            const div = $("<div class='amigo-numero"+i+" input-group'></div>");
            const input = $("<input type='text' name='amigo_id' class='form-control form-input mb-4 amigo_id' id='integrante"+i+"' value='"+amigo+"' placeholder=' ' data-id='"+amigo_id+"' disabled>");
            const label = $("<label for='integrante"+i+"' class='form-label fw-bold' id='form-label'>Integrante:</label>")
            const input_group_append = $("<span class='input-group-append'></span>")
            const input_group_text = $("<span class='input-group-text bg-transparent border-0'></span>")
            const btn_remove = $("<a id='"+i+"' class='btn btn-danger btn-remove'></a>")
            const icon = $("<i class='bi bi-x'></i>");

            btn_remove.append(icon);
            input_group_text.append(btn_remove);
            input_group_append.append(input_group_text);
            div.append(input);
            div.append(label);
            div.append(input_group_append);
            NuevoAmigo.append(div);
            $('#amigo').val(''); 
        })
        $(document).on('click', ".btn-remove", function(e){
            var button_id = $(this).attr("id"); 
            $(".amigo-numero"+button_id).remove();
            if(NuevoAmigo.html() == ""){
                button ? button.disabled = true: false;
                button4 ? button4.disabled = true: false;
            }
        });
    }
}    

// Registrar GrupoFamiliar
const registrarGrupoFamiliar = () =>{  
    const newAmigo = document.getElementById('new-amigo');
    if(button !== null){
    button.addEventListener('click', (ev) => {
        // Registramos los datos del grupo 
        let $form = $('#form-registrarGrupo');     
        $.ajax({
            url: $form.attr('action'),
            data: $form.serialize(),
            type: 'POST',
            dataType: 'json',
            success: function(response){
                if (response.code == 422) {
                    let html = '<ul class="list-group list-group-flush">';
                    $.each(response.messages, function (index, value) {
                        html += '<li class="list-group-item">' + value + '</li>';
                    });
                    html += '</ul>';
    
                    swal.fire({
                        title: response.title,
                        html: html,
                        icon: 'error',
                        showConfirmButton: false,
                        showCancelButton: true,
                        cancelButtonText: 'close'
                    });
                } else {
                    exito();
                }
            },
            error: function(){} 
        })
        // Registramos cada amigo al nuevo grupo
        const exito = () => {
            const amigo_id = document.getElementsByClassName('amigo_id');
            for (i = 0; i < amigo_id.length; i++) {
                $.ajax({
                    url: '/grupo-familiares/guardar',
                    data:{
                        'amigo_id': amigo_id[i].getAttribute('data-id')
                    },
                    type: 'POST',
                    dataType: 'json',
                    success: function(response){
                        swal.fire({
                            title: response[1].title,
                            html: response[1].messages,
                            icon: 'success',
                            showConfirmButton: false,
                            showCancelButton: true,
                            cancelButtonText: 'close'
                        });
                        $("#form-registrarGrupo")[0].reset();
                        $("#nombre").focus(); 
                        button.disabled = true; 
                        setTimeout(function() {
                            newAmigo.innerHTML = "";                            
                        },1000); 
                    },
                    error: function(){} 
                })
            }
        }
    }, false);
    }
}

const listaGrupoFamiliar = function () {
    let $table = $("#grupo-table");
    $table.DataTable({
        "ajax": {
            "url": $table.data("route"),
            "dataSrc": "grupos",
        },
        "columns": [
            {"data": "nombre"},
            {"data": "direccion"},
            {"data": "lider"},
            {"data": "zona"},
            {"data": "actions", "className": "center"},
        ],
        "initComplete": function () {
            let api = this.api();
            api.buttons().container().appendTo($('#table-buttons'));
            observar_amigos();
        }
    })   
    
}

const observar_amigos = function () {
    let $table= $('#integrantes-grupo-table');
    let $modal = $('#integrantes');

    $modal.on('show.bs.modal', function(event) {
        let $target = $(event.relatedTarget);
        let grupo = $target.data('id');
        let route = `${$table.data('route')}?grupo_id=${grupo}`;
        $table.DataTable({
            "ajax": {
                "url": route,
                "dataSrc": "amigos"
            },
            "columns": [
                {"data": "nombre_completo"},
                {"data": "actions", "className": "center"},
            ],
            destroy: true,
            "initComplete": function () {
                let api = this.api();
                api.buttons().container()
                    .appendTo($('#table-buttons'));
            }
        })
    })
}

const actualizar = function () {
    let $button = $('#actualizar-grupo');
    $button.click(function (e) {
        e.preventDefault();
        let $form = $('#form-actualizarGrupo');
        $button.disabled = true;
        $.ajax({
            type: $form.attr('method'),
            url: $form.attr('action'),
            data: $form.serialize(),
            dataType: 'json',
        }).done(function (response) {
            if (response.code == 422) {
                let html = '<ul class="list-group list-group-flush">';
                $.each(response.messages, function (index, value) {
                    html += '<li class="list-group-item">' + value + '</li>';
                });
                html += '</ul>';
                swal.fire({
                    title: response.title,
                    html: html,
                    icon: 'error',
                    showConfirmButton: false,
                    showCancelButton: true,
                    cancelButtonText: 'close'
                });
                $button.disabled = false;
            } else {
                swal.fire({
                    title: response.title,
                    html: response.messages,
                    icon: 'success',
                    showConfirmButton: false,
                    showCancelButton: true,
                    cancelButtonText: 'close'
                });
                $button.disabled = false;
            }
        }).fail(function (json) {
            console.log(json);
        });
    });
}

const eliminarGrupo = function () {
    $(document).on('click', '#eliminar-grupo', function (e) {
        e.preventDefault();
        let route = $(this).data('route');
        let tr = $(this).parents("tr");
        console.log(tr)
        Swal.fire({
            title: '¿Estás seguro?',
            text: "No podrás revertir esto.",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Eliminar',
            preConfirm: () => {
                return fetch(route)
                .then(response => {
                    if (!response.ok) {
                        response.json().then(json => {
                            swal.fire({
                                title: json.title,
                                text: json.message,
                                type: 'error',
                                showConfirmButton: false,
                                showCancelButton: true,
                                cancelButtonText: '<i class="hs-admin-close"></i> ' + json.data.close
                            });
                        });
                    }
                    return response.json();
                });
            },
        }).then((result) => {
            if (result.value.code == 200) {
                Swal.fire(
                    result.value.title,
                    result.value.messages,
                    'success'
                )
                tr.remove();
            }
        })
    });
}

const asignarAmigo = function () {
    let $button = $('#agregar-amigo-grupo');
    const newAmigo = document.getElementById('new-amigo');
    $button.click(function (e) {
        e.preventDefault();
        let amigo_id = document.getElementsByClassName('amigo_id');
        let grupo_id = $('#grupo_id').val();
        for (i = 0; i < amigo_id.length; i++) {
            $.ajax({
                url: '/grupo-familiares/asignar-amigos',
                data:{
                    'grupo_id': grupo_id,
                    'amigo_id': amigo_id[i].getAttribute('data-id')
                },
                type: 'POST',
                dataType: 'json',
                success: function(response){
                    if (response.code == 422) {
                        let html = '<ul class="list-group list-group-flush">';
                        $.each(response.messages, function (index, value) {
                            html += '<li class="list-group-item">' + value + '</li>';
                        });
                        html += '</ul>';        
                        swal.fire({
                            title: response.title,
                            html: html,
                            icon: 'error',
                            showConfirmButton: false,
                            showCancelButton: true,
                            cancelButtonText: 'close'
                        });
                        $button.disabled = false;
                    } else {
                        swal.fire({
                            title: response.title,
                            html: response.messages,
                            icon: 'success',
                            showConfirmButton: false,
                            showCancelButton: true,
                            cancelButtonText: 'close'
                        });
                        setTimeout(function() {
                            newAmigo.innerHTML = "";                            
                        },1000); 
                    }
                },
                error: function(response){
                    console.log(response)
                } 
            })
        }
    });
}

const eliminarAmigo = function () {
    $(document).on('click', '#eliminar-amigo-grupo', function (e) {
        e.preventDefault();
        let route = $(this).data('route');
        let tr = $(this).parents("tr");
        console.log(tr)
        Swal.fire({
            title: '¿Estás seguro?',
            text: "No podrás revertir esto.",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Eliminar',
            preConfirm: () => {
                return fetch(route)
                .then(response => {
                    if (!response.ok) {
                        response.json().then(json => {
                            swal.fire({
                                title: json.title,
                                text: json.message,
                                type: 'error',
                                showConfirmButton: false,
                                showCancelButton: true,
                                cancelButtonText: '<i class="hs-admin-close"></i> ' + json.data.close
                            });
                        });
                    }
                    return response.json();
                });
            },
        }).then((result) => {
            if (result.value.code == 200) {
                Swal.fire(
                    result.value.title,
                    result.value.messages,
                    'success'
                )
                tr.remove();
            }
        })
    });
}


