@include('/componentes/header')


<div class="cuerpo">

    <!-- Modal crear evento -->
    <div class="modal fade" id="modalRegistrar" tabindex="-1" aria-labelledby="modalEditarLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="modalEditarLabel">Crear nuevo evento</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                        aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form id="formularioregistro" action="{{ route('evento.add') }}" method="POST">
                        @csrf
                        <div class="mb-3">
                            <label for="exampleInputEmail1" class="form-label">Nombre del evento *</label>
                            <input placeholder="Torneo Pillán" type="text" class="form-control" id="idnombre" aria-describedby="nombresHelp" name="idnombre">
                        </div>
                        <div class="mb-3">
                            <label for="exampleInputEmail1" class="form-label">Fecha de inicio</label>
                            <input type="date" class="form-control" id="idfechainicio" aria-describedby="papellidoHelp" name="idfechainicio" min="{{ $fechahoy }}" max="{{ $fechamaximo }}">
                        </div>
                        <div class="mb-3">
                            <label for="exampleInputEmail1" class="form-label">Fecha de cierre</label>
                            <input type="date" class="form-control" id="idfechacierre" aria-describedby="sapellidoHelp" name="idfechacierre" min="{{ $fechahoy }}" max="{{ $fechamaximo }}">
                        </div>
                        <label class="form-label">Deporte *</label>
                        <div class="botonesformulario">
                            <div class="dropdown-center">
                                <button class="btn btn-secondary dropdown-toggle btn-sm" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                                    Deporte *
                                </button>
                                <ul class="dropdown-menu">
                                    @foreach ($deportes as $deporte)
                                        <li id="{{ $deporte->id_deporte }}" class="dropdown-item" onclick="actualizarTextoEscuela('deporteregistro', 'inputdeporteregistro', '{{ $deporte->id_deporte }} - {{ $deporte->nombre_deporte }}', '{{ $deporte->id_deporte }}')">{{ $deporte->id_deporte }} - {{ $deporte->nombre_deporte }}</li>
                                    @endforeach
                                </ul>
                            </div>
                            <p id="deporteregistro"></p>
                            <input type="text" name="inputdeporteregistro" id="inputdeporteregistro" hidden>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                    <button form="formularioregistro" type="submit" class="btn btn-primary">Crear evento</button>
                </div>
            </div>
        </div>
    </div>

    <div class="menu">
        <ul>
            <li><a href="{{ url('/eventos') }}">Lista de eventos</a></li>
            <li><a href="{{ url('/addeventos') }}" data-bs-toggle="modal" data-bs-target="#modalRegistrar">Crear nuevo evento</a></li>
        </ul>
    </div>
    <div class="contenido table-responsive">

        <div class="herramientasarriba">
            <div class="buscador">
                <h2>Buscar</h2>
                <p>Filtro 1:</p>
                <input class="form-control inputbuscador" id="myInput1" type="text" placeholder="Buscar nombre, rut...">
            </div>

        </div>

        <table class="tabla table table-hover">
            <thead>
                <tr>
                    <th scope="col">Nombre evento</th>
                    <th scope="col">Fecha de inicio</th>
                    <th scope="col">Fecha de termino</th>
                    <th scope="col">Disciplina</th>
                    <th scope="col">Estado</th>
                    <th></th>
                </tr>
            </thead>
            <tbody id="cuerpotabla">
                @foreach ($eventos as $evento)
                    <tr>
                        <td>{{ $evento->nombre_evento }}</td>
                        <td>{{ $evento->f_inicio_evento }}</td>
                        <td>{{ $evento->f_cierre_evento }}</td>
                        <td>{{ $evento->nombre_deporte }}</td>
                        <td>{{ $evento->nombre_estado_evento }}</td>
                        <td>
                            <div class="botonestablainstructors">
                                <button class="btn btn-warning btn-sm"  data-bs-toggle="modal" data-bs-target="#modalEditar{{ $evento->id_evento }}" href="#">
                                    <i class="fa-solid fa-pen-to-square" style="color: #ffffff;"></i>
                                </button>
                            </div>
                        </td>

                        <!-- Modal editar evento -->
                        <div class="modal fade" id="modalEditar{{ $evento->id_evento }}" tabindex="-1" aria-labelledby="modalEditarLabel"
                            aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h1 class="modal-title fs-5" id="modalEditarLabel{{ $evento->id_evento }}">Editando {{ $evento->id_evento }} - {{ $evento->nombre_evento }} / {{ $evento->f_inicio_evento }}</h1>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                        <form id="formularioeditar{{ $evento->id_evento }}" action="{{ route('evento.editar') }}" method="POST">
                                            @csrf
                                            <div class="mb-3">
                                                <label for="exampleInputEmail1" class="form-label">Nombre del evento *</label>
                                                <input value="{{ $evento->nombre_evento }}" placeholder="Torneo..." type="text" class="form-control" id="editarnombreevento" aria-describedby="rutHelp" name="editarnombreevento">
                                            </div>
                                            <div class="mb-3">
                                                <label for="exampleInputEmail1" class="form-label">Fecha de inicio</label>
                                                <input value="{{ $evento->f_inicio_evento }}" type="date" class="form-control" id="editarfechainicio" aria-describedby="nombresHelp" name="editarfechainicio">
                                            </div>
                                            <div class="mb-3">
                                                <label for="exampleInputEmail1" class="form-label">Fecha de cierre</label>
                                                <input value="{{ $evento->f_cierre_evento }}" type="date" class="form-control" id="editarfechacierre" aria-describedby="papellidoHelp" name="editarfechacierre">
                                            </div>
                                            <label class="form-label">Disciplina</label>
                                            <div class="botonesformulario">
                                                <div class="dropdown-center">
                                                    <button class="btn btn-secondary dropdown-toggle btn-sm" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                                                        Disciplina
                                                    </button>
                                                    <ul class="dropdown-menu">
                                                        @foreach ($deportes as $deporte)
                                                            <li id="{{ $deporte->id_deporte }}" class="dropdown-item" onclick="actualizarTextoEscuela('editareventodeporte', 'inputdeporteeditar', '{{ $deporte->id_deporte }} - {{ $deporte->nombre_deporte }}', '{{ $deporte->id_deporte }}')">{{ $deporte->id_deporte }} - {{ $deporte->nombre_deporte }}</li>
                                                        @endforeach
                                                    </ul>
                                                </div>
                                                <p id="editareventodeporte">{{ $evento->id_deporte }} - {{ $evento->nombre_deporte }}</p>
                                                <input value="{{ $evento->id_deporte }}" type="text" name="inputdeporteeditar" id="inputdeporteeditar" hidden>
                                            </div>
                                            <label class="form-label">Estado del evento</label>
                                            <div class="botonesformulario">
                                                <div class="dropdown-center">
                                                    <button class="btn btn-secondary dropdown-toggle btn-sm" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                                                        Estado del evento
                                                    </button>
                                                    <ul class="dropdown-menu">
                                                        @foreach ($estados_evento as $estado_evento)
                                                            <li id="{{ $estado_evento->id_estado_evento }}" class="dropdown-item" onclick="actualizarTextoEscuela('editareventoestado', 'inputestadoeditar', '{{ $estado_evento->nombre_estado_evento }}', '{{ $estado_evento->id_estado_evento }}')">{{ $estado_evento->nombre_estado_evento }}</li>
                                                        @endforeach
                                                    </ul>
                                                </div>
                                                <p id="editareventoestado">{{ $evento->nombre_estado_evento }}</p>
                                                <input value="{{ $evento->id_estado_evento }}" type="text" name="inputestadoeditar" id="inputestadoeditar" hidden>
                                            </div>
                                            <input value="{{ $evento->id_evento }}" type="text" name="inputeditarid" id="inputeditarid" hidden>
                                        </form>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                                        <button type="submit" form="formularioeditar{{ $evento->id_evento }}" class="btn btn-primary">Guardar cambios</button>
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
        // Get the values from all filter inputs
        var value1 = $("#myInput1").val().toLowerCase();

        $("#cuerpotabla tr").filter(function() {
          // Check if the text in any column contains any of the filter values
          var rowText = $(this).text().toLowerCase();

          var match1 = rowText.indexOf(value1) > -1 || value1 === "";

          // Toggle the row based on any filter condition
          $(this).toggle(match1);
        });
      });
    });
</script>


