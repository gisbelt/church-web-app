$(document).ready(function () {
    // Registrar rol o permisos
    const registrarPermisoRol = () => {
        let agregarPermisoRol = document.getElementById('agregar-permisos-rol');
        if (agregarPermisoRol !== null) {
            agregarPermisoRol.addEventListener('click', (e) => {
                e.preventDefault();
                // Registramos el nombre del grupo
                let seguridadForm = document.getElementById('form-registrar-permisos');
                let nombre_permisos = document.getElementById('nombre_permisos');
                const formData = new FormData(seguridadForm);
                console.log(formData);
                $.ajax({
                    url: seguridadForm.action,
                    data: {
                        formData
                    },
                    type: 'POST',
                    dataType: 'json',
                    success: function (data) {
                        if (data.msj1) exito()
                    },
                    error: function () {
                    }
                })
                // Registramos cada miembro al nuevo grupo
                /*const exito = () => {
                    const miembroId = document.getElementsByClassName('miembroId');
                    const newMiembro = document.getElementById('new-miembro');
                    for (i = 0; i < miembroId.length; i++) {
                        $.ajax({
                            url: '/grupo-familiares/registrar-grupoFamiliar',
                            data:{
                                'miembroId': miembroId[i].getAttribute('data-id')
                            },
                            type: 'POST',
                            dataType: 'json',
                            success: function(data){
                                $("#tabla_exito").html("Registrado exitosamente").fadeIn(100);
                                setTimeout(function() {
                                    $("#tabla_exito").html("Registrado exitosamente").slideUp('slow');
                                    newMiembro.remove('slow');
                                    $("#nombreGrupoFamiliar").val('');
                                    $("#nombreGrupoFamiliar").focus();
                                },1000);
                            },
                            error: function(){}
                        })
                    }
                }*/
            }, false);
        }
    }
    registrarPermisoRol();
})