@include('/componentes/header')


<div class="cuerpo">

    <!-- Modal registrar escuela -->
    <div class="modal fade" id="modalRegistrar" tabindex="-1" aria-labelledby="modalEditarLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="modalEditarLabel">Registrar escuela</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                        aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form id="formularioregistro" action="{{ route('escuela.add') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="mb-3">
                            <label for="exampleInputEmail1" class="form-label">Nombre de la escuela *</label>
                            <input placeholder="Escuela" type="text" class="form-control" id="idnombres" aria-describedby="nombresHelp" name="idnombres">
                        </div>
                        <label class="form-label">Instructor</label>
                        <div class="botonesformulario">
                            <div class="dropdown-center">
                                <button class="btn btn-secondary dropdown-toggle btn-sm" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                                  Instructor *
                                </button>
                                <ul class="dropdown-menu">
                                    @foreach ($instructores as $instructor)
                                        <li id="{{ $instructor->id_instructor }}" class="dropdown-item" onclick="actualizarTextoEscuela('escuelaregistro', 'inputescuelaregistro', '{{ $instructor->rut_instructor }} - {{ $instructor->nombre_instructor }} {{ $instructor->primer_apellido_instructor }}', '{{ $instructor->id_instructor }}')">{{ $instructor->rut_instructor }} - {{ $instructor->nombre_instructor }} {{ $instructor->primer_apellido_instructor }}</li>
                                    @endforeach
                                </ul>
                            </div>
                            <p id="escuelaregistro"></p>
                            <input type="text" name="inputescuelaregistro" id="inputescuelaregistro" hidden>
                        </div>
                        <div class="mb-3">
                            <label for="exampleInputEmail1" class="form-label">Logo de la escuela (opcional)</label>
                            <input type="file" name="image" id="inputImage" class="form-control" id="idlogo" aria-describedby="logoHelp" name="idlogo">
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                    <button form="formularioregistro" type="submit" class="btn btn-primary">Agregar escuela</button>
                </div>
            </div>
        </div>
    </div>

    <div class="menu">
        <ul>
            <li><a href="{{ url('/escuelas') }}">Lista de escuelas</a></li>
            <li><a href="{{ url('/addescuelas') }}" data-bs-toggle="modal" data-bs-target="#modalRegistrar">Registrar escuelas</a></li>
        </ul>
    </div>
    <div class="contenido table-responsive">

        <div class="herramientasarriba">
            <div class="buscador">
                <h2>Buscar</h2>
                <p>Filtro 1:</p>
                <input class="form-control inputbuscador" id="myInput1" type="text" placeholder="Buscar nombre, rut,...">
            </div>

        </div>

        <table class="tabla table table-hover">
            <thead>
                <tr>
                    <th scope="col">Escudo</th>
                    <th scope="col">Nombre</th>
                    <th scope="col">Instructor</th>
                    <th scope="col">Telefono instructor</th>
                    <th></th>
                </tr>
            </thead>
            <tbody id="cuerpotabla">
                @foreach ($escuelas as $escuela)
                    <tr>
                        <td><img id="escudoescuelas" src="{{ asset($escuela->escudo_escuela) }}" alt="Escudo {{ $escuela->nombre_escuela }}"></td>
                        <td>{{ $escuela->nombre_escuela }}</td>
                        <td>{{ $escuela->nombre_instructor }} {{ $escuela->primer_apellido_instructor }}</td>
                        <td>{{ $escuela->telefono_instructor }}</td>
                        <td>
                            <div class="botonestablaescuelas">
                                <button class="btn btn-warning btn-sm"  data-bs-toggle="modal" data-bs-target="#modalEditar{{ $escuela->id_escuela }}" href="#">
                                    <i class="fa-solid fa-pen-to-square" style="color: #ffffff;"></i>
                                </button>
                                <form action="{{ route('escuela.borrar', $escuela->id_escuela) }}" method="POST" style="display: inline;">
                                    @csrf
                                    <button type="submit" class="btn btn-danger btn-sm">
                                        <i class="fa-solid fa-trash" style="color: #ffffff;"></i>
                                    </button>
                                </form>
                            </div>
                        </td>

                        <!-- Modal editar escuela -->
                        <div class="modal fade" id="modalEditar{{ $escuela->id_escuela }}" tabindex="-1" aria-labelledby="modalEditarLabel"
                            aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h1 class="modal-title fs-5" id="modalEditarLabel{{ $escuela->id_escuela }}">Editando {{ $escuela->nombre_escuela }}</h1>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                        <form id="formularioeditar{{ $escuela->id_escuela }}" action="{{ route('escuela.editar') }}" method="POST">
                                            @csrf
                                            <div class="mb-3">
                                                <label for="exampleInputEmail1" class="form-label">Nombre escuela *</label>
                                                <input value="{{ $escuela->nombre_escuela }}" placeholder="Escuela" type="text" class="form-control" id="editarnombres" aria-describedby="nombresHelp" name="editarnombres">
                                            </div>
                                            <label class="form-label">Instructor</label>
                                            <div class="botonesformulario">
                                                <div class="dropdown-center">
                                                    <button class="btn btn-secondary dropdown-toggle btn-sm" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                                                        Instructor *
                                                    </button>
                                                    <ul class="dropdown-menu">
                                                        @foreach ($instructores as $instructor)
                                                            <li id="{{ $instructor->id_instructor }}" class="dropdown-item" onclick="actualizarTextoEscuela('cargoeditar{{ $escuela->id_escuela }}', 'inputescuelaeditar{{ $escuela->id_escuela }}', '{{ $instructor->rut_instructor }} - {{ $instructor->nombre_instructor }} {{ $instructor->primer_apellido_instructor }}', '{{ $instructor->id_instructor }}')">{{ $instructor->rut_instructor }} - {{ $instructor->nombre_instructor }} {{ $instructor->primer_apellido_instructor }}</li>
                                                        @endforeach
                                                    </ul>
                                                </div>
                                                <p id="cargoeditar{{ $escuela->id_escuela }}">{{ $escuela->rut_instructor }} - {{ $escuela->nombre_instructor }} {{ $escuela->primer_apellido_instructor }}</p>
                                                <input value="{{ $escuela->instructor_id_instructor }}" type="text" name="inputescuelaeditar{{ $escuela->id_escuela }}" id="inputescuelaeditar{{ $escuela->id_escuela }}" hidden>
                                            </div>
                                            <input value="{{ $escuela->id_escuela }}" type="text" name="inputeditarid" id="inputeditarid" hidden>
                                        </form>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                                        <button type="submit" form="formularioeditar{{ $escuela->id_escuela }}" class="btn btn-primary">Guardar cambios</button>
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


