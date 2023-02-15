<div class="card mb-5">
    <div class="card-header">
        <a href="/actividades" class="btn btn-outline-success text-center mt-3">Ver Lista de Actividades</a>
    </div>
    <div class="card-body px-5 pb-5 pt-3">
        <form method="POST" enctype="multipart/form-data" id="form-registrarActividades" action="/actividades/store">
            
            <div class="form-group">
                <div class="mb-4 input-group">
                    <select class="form-control" name="miembro_id" id="miembro_id">
                        <option value="" selected disabled>Seleccione un miembro</option>
                    </select>
                </div>
                <ul class="list-group" id="tabla_resultado_usuarios"></ul>
            </div>    

            <div class="form-group">
                <input type="text" required name="nombre" class="form-control form-input mb-4" id="nombre" value="" placeholder=" " >
                <label for="nombre" class="form-label fw-bold">Nombre de la Actividad:*</label>
            </div>
            
            <div class="form-group">
                <div class="mb-3">
                    <p class="">Descripción:*</p>
                    <textarea class="form-control" name="descripcion" id="descripcion" rows="3"></textarea>
                </div>
            </div>
            
            <div class="mb-3">
                <p class="">Tipo de actividad:* </p>
                <select class="form-select" name="tipo_actividad" id="tipo_actividad">
                    <option>Seleccione</option>
                </select>
            </div>
            
            <div class="mb-3">
                <p class="">Estado:* </p>
                <select class="form-control" name="status" id="status">
                    <option value="1">En curso</option>
                    <option value="2">Terminada</option>
                    <option value="3">Pausada</option>
                </select>
            </div>

            <div class="row p-3">                      
                <h5 class="mb-4">Horario:*</h5>
                <div class="form-group col-md-6">
                    <div class="input-group input-time">
                        <input type="time" required name="hora" class="form-control form-input mb-4" id="hora" value="" placeholder=" ">
                        <label for="hora" class="form-label fw-bold">Hora:*</label>
                    </div>
                </div>
                <div class="form-group col-md-6">
                    <div class="input-group input-daterange" id="datepicker">
                        <input type="text" required name="fecha" class="form-control form-input mb-4" id="fecha" value="dd/mm/aaaa" placeholder=" ">
                        <label for="fecha" class="form-label fw-bold">Fecha:*</label>
                        <span class="input-group-append">
                            <span class="input-group-text bg-transparent border-0">
                                <i class="bi bi-calendar-minus"></i>
                            </span>
                        </span>
                    </div>
                </div>
            </div>
            
            <hr>
            <h5 class="mb-4 text-danger">Opcional:</h5>
            
            <div class="form-group">
                <div class="mb-3">
                    <p class="">Observación:</p>
                    <textarea class="form-control" name="observacion" id="observacion" rows="3"></textarea>
                </div>
            </div>

            <!--Botones-->
            <div class="btn-group modal-footer" role="group" aria-label="">
                <button type="submit" name="agregar" value="Agregar" id="agregar-actividad" class="btn btn-success">Agregar</button>
                <a name="limpiar" value="Limpiar" class="btn btn-secondary" onclick="limpiar();">Limpiar</a>
            </div>
            <!--Botones-->
        </form>
    </div><!--card-body-->
</div><!--card-->