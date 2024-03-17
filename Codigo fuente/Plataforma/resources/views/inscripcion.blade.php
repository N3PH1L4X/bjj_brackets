@include('/componentes/header')


<div class="cuerpo">

    <!-- Modal registrar inscripcion -->
    <div class="modal fade" id="modalRegistrar" tabindex="-1" aria-labelledby="modalEditarLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="modalEditarLabel">Crear nueva inscripcion</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                        aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form id="formularioregistro" action="{{ route('inscripcion.add') }}" method="POST">
                        @csrf

                        <div class="form-group">
                            <label for="competidor">Competidor</label>
                            <select name="competidor" id="competidor" class="form-control" class="selectpicker">
                                <option value="">Seleccionar Competidor</option>
                                @foreach ($competidores as $competidor)
                                    <option value="{{ $competidor->id_competidor }}">{{ $competidor->rut_competidor }} - {{ $competidor->nombre_competidor }} {{ $competidor->primer_apellido_competidor }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="form-group">
                            <label for="evento">Evento</label>
                            <select name="evento" id="evento" class="form-control">
                                <option value="">Seleccionar Evento</option>
                                @foreach ($eventos as $evento)
                                    <option value="{{ $evento->id_evento }}">{{ $evento->nombre_evento }}</option>
                                @endforeach
                            </select>
                        </div>


                        <div class="form-group">
                            <label for="categoria">Categoria</label>
                            <select name="categoria" id="categoria" class="form-control" disabled>
                                <option value="">Seleccionar Categoria</option>
                            </select>
                        </div>



                        <label class="form-label">Estado del pago</label>
                        <div class="botonesformulario">
                            <div class="dropdown-center">
                                <button class="btn btn-secondary dropdown-toggle btn-sm" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                                    Estado del pago *
                                </button>
                                <ul class="dropdown-menu">
                                    @foreach ($estadopagos as $estadopago)
                                        <li id="{{ $estadopago->id_estado_pago }}" class="dropdown-item" onclick="actualizarTextoEscuela('estadopagoregistro', 'inputestadopagoregistro', '{{ $estadopago->nombre_estado_pago }}', '{{ $estadopago->id_estado_pago }}')">{{ $estadopago->nombre_estado_pago }}</li>
                                    @endforeach
                                </ul>
                            </div>
                            <p id="estadopagoregistro"></p>
                            <input type="text" name="inputestadopagoregistro" id="inputestadopagoregistro" hidden>
                        </div>


                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                    <button form="formularioregistro" type="submit" class="btn btn-primary">Registrar inscripcion</button>
                </div>
            </div>
        </div>
    </div>


    <div class="menu">
        <ul>
            <li><a href="{{ url('/escuelas') }}">Lista de inscripciones</a></li>
            <li><a href="{{ url('/addinscripcion') }}" data-bs-toggle="modal" data-bs-target="#modalRegistrar">Registrar nueva inscripcion</a></li>
        </ul>
    </div>


    <div class="contenido table-responsive">

        <div class="herramientasarriba">
            <div class="buscador">
                <h2>Buscar</h2>
                <p>Filtro 1:</p>
                <input class="form-control inputbuscador" id="myInput1" type="text" placeholder="Buscar nombre, escuela, estado del pago...">
            </div>
        </div>

        <table class="tabla table table-hover">
            <thead>
                <tr>
                    <th scope="col">RUT</th>
                    <th scope="col">Nombre</th>
                    <th scope="col">Edad</th>
                    <th scope="col">Peso</th>
                    <th scope="col">Categoria</th>
                    <th scope="col">Escuela</th>
                    <th scope="col">Evento</th>
                    <th scope="col">Estado del pago</th>
                    <th></th>
                </tr>
            </thead>
            <tbody id="cuerpotabla">
                @foreach ($inscripciones as $inscripcion)
                    <tr>
                        <td>{{ $inscripcion->rut_competidor }}</td>
                        <td>{{ $inscripcion->nombre_competidor }} {{ $inscripcion->primer_apellido_competidor }} {{ $inscripcion->segundo_apellido_competidor }}</td>
                        <td>{{ $inscripcion->edad_competidor }}</td>
                        <td>{{ $inscripcion->peso_competidor }}</td>
                        <td>{{ $inscripcion->nombre_categoria }}</td>
                        <td>{{ $inscripcion->nombre_escuela }}</td>
                        <td>{{ $inscripcion->nombre_evento }}</td>
                        <td>{{ $inscripcion->nombre_estado_pago }}</td>
                        <td>
                            <div class="botonestablaescuelas">
                                <button class="btn btn-warning btn-sm"  data-bs-toggle="modal" data-bs-target="#modalEditar{{ $inscripcion->id_inscripcion }}" href="#">
                                    <i class="fa-solid fa-pen-to-square" style="color: #ffffff;"></i>
                                </button>
                                <form action="{{ route('inscripcion.borrar', $inscripcion->id_inscripcion) }}" method="POST" style="display: inline;">
                                    @csrf
                                    <button type="submit" class="btn btn-danger btn-sm">
                                        <i class="fa-solid fa-trash" style="color: #ffffff;"></i>
                                    </button>
                                </form>
                            </div>
                        </td>

                        <!-- Modal editar escuela -->
                        <div class="modal fade" id="modalEditar{{ $inscripcion->id_inscripcion }}" tabindex="-1" aria-labelledby="modalEditarLabel"
                            aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h1 class="modal-title fs-5" id="modalEditarLabel{{ $inscripcion->id_inscripcion }}">Editando {{ $inscripcion->nombre_competidor }} {{ $inscripcion->primer_apellido_competidor }} - {{ $inscripcion->nombre_evento }}</h1>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                        <form id="formularioeditar{{ $inscripcion->id_inscripcion }}" action="{{ route('inscripcion.editar') }}" method="POST">
                                            @csrf
                                            <div class="mb-3">
                                                <label for="exampleInputEmail1" class="form-label">Nombre competidor</label>
                                                <input value="{{ $inscripcion->nombre_competidor }}" placeholder="nombrecompetidor" type="text" class="form-control" id="editarnombres" aria-describedby="nombresHelp" name="editarnombres" disabled>
                                            </div>
                                            <div class="mb-3">
                                                <label for="exampleInputEmail1" class="form-label">Evento</label>
                                                <input value="{{ $inscripcion->nombre_evento }}" placeholder="nombreevento" type="text" class="form-control" id="editarnombres" aria-describedby="nombresHelp" name="editarnombres" disabled>
                                            </div>
                                            <div class="mb-3">
                                                <label for="exampleInputEmail1" class="form-label">Categoria</label>
                                                <input value="{{ $inscripcion->nombre_categoria }}" placeholder="nombreevento" type="text" class="form-control" id="editarnombres" aria-describedby="nombresHelp" name="editarnombres" disabled>
                                            </div>
                                            <label class="form-label">Estado del pago</label>
                                            <div class="botonesformulario">
                                                <div class="dropdown-center">
                                                    <button class="btn btn-secondary dropdown-toggle btn-sm" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                                                        Estado del pago *
                                                    </button>
                                                    <ul class="dropdown-menu">
                                                        @foreach ($estadopagos as $estadopago)
                                                            <li id="{{ $estadopago->id_estado_pago }}" class="dropdown-item" onclick="actualizarTextoEscuela('cargoeditar{{ $inscripcion->id_inscripcion }}', 'inputescuelaeditar{{ $inscripcion->id_inscripcion }}', '{{ $estadopago->id_estado_pago }} - {{ $estadopago->nombre_estado_pago }}', '{{ $estadopago->id_estado_pago }}')">{{ $estadopago->id_estado_pago }} - {{ $estadopago->nombre_estado_pago }}</li>
                                                        @endforeach
                                                    </ul>
                                                </div>
                                                <p id="cargoeditar{{ $inscripcion->id_inscripcion }}">{{ $estadopago->id_estado_pago }} - {{ $inscripcion->nombre_estado_pago }}</p>
                                                <input value="{{ $inscripcion->estado_pago_id_estado_pago }}" type="text" name="inputescuelaeditar{{ $inscripcion->id_inscripcion }}" id="inputescuelaeditar{{ $inscripcion->id_inscripcion }}" hidden>
                                            </div>
                                            <input value="{{ $inscripcion->id_inscripcion }}" type="text" name="inputeditarid" id="inputeditarid" hidden>
                                        </form>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                                        <button type="submit" form="formularioeditar{{ $inscripcion->id_inscripcion }}" class="btn btn-primary">Guardar cambios</button>
                                    </div>
                                </div>
                            </div>
                        </div>

                    </tr>
                @endforeach

            </tbody>
        </table>
    </div>
</div>

<script>
    $(document).ready(function() {
      $("#myInput1").on("keyup", function() {
        var value1 = $("#myInput1").val().toLowerCase();
        $("#cuerpotabla tr").filter(function() {
          var rowText = $(this).text().toLowerCase();
          var match1 = rowText.indexOf(value1) > -1 || value1 === "";
          $(this).toggle(match1);
        });
      });
    });
</script>

<script>
    $(document).ready(function() {
        $('.selectpicker').select2({
            placeholder: "Seleccionar Competidor"
        });
    });
</script>



<script>
    $(document).ready(function() {
        // Populate eventos dropdown
        $.get('/obtenereventos', function(data) {
            $('#evento').empty();
            $('#evento').append('<option value="">Seleccionar Evento</option>');
            $.each(data, function(index, evento) {
                $('#evento').append('<option value="' + evento.id_evento + '">' + evento.nombre_evento + ' (' + evento.nombre_deporte + ')</option>');
            });
        });

        // Disable the categoria dropdown by default
        $('#categoria').prop('disabled', true);

        // On evento selection, enable and populate the categoria dropdown
        $('#evento').change(function() {
            var evento_id = $(this).val();
            if (evento_id) {
                // Disable the categoria dropdown until data is fetched
                $('#categoria').prop('disabled', true);

                // Make an AJAX request to get data for the second dropdown based on the selected evento_id
                $.get('/obtenercategorias/' + evento_id, function(data) {
                    $('#categoria').empty();
                    $('#categoria').append('<option value="">Elegir categoria</option>');
                    $.each(data, function(index, categoria) {
                        $('#categoria').append('<option value="' + categoria.id_categoria + '">' + categoria.nombre_categoria + '</option>');
                    });

                    // Enable the categoria dropdown after data is fetched
                    $('#categoria').prop('disabled', false);
                });
            } else {
                // If no evento is selected, disable and empty the categoria dropdown
                $('#categoria').prop('disabled', true);
                $('#categoria').empty();
                $('#categoria').append('<option value="">Select Categoria</option>');
            }
        });
    });
</script>
