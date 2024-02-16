@include('/componentes/header')


<div class="cuerpo">

    <!-- Modal registrar competidor -->
    <div class="modal fade" id="modalRegistrar" tabindex="-1" aria-labelledby="modalEditarLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="modalEditarLabel">Registrar competidor</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                        aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form id="formularioregistro" action="{{ route('competidor.add') }}" method="POST">
                        @csrf
                        <div class="mb-3">
                            <label for="exampleInputEmail1" class="form-label">RUT *</label>
                            <input placeholder="Sin puntos, guión ni digito verificador" type="text" class="form-control" id="idrut" aria-describedby="rutHelp" name="idrut">
                        </div>
                        <div class="mb-3">
                            <label for="exampleInputEmail1" class="form-label">Nombres *</label>
                            <input placeholder="Javier Nicolas" type="text" class="form-control" id="idnombres" aria-describedby="nombresHelp" name="idnombres">
                        </div>
                        <div class="mb-3">
                            <label for="exampleInputEmail1" class="form-label">Primer Apellido *</label>
                            <input placeholder="Sanchez" type="text" class="form-control" id="idprimerap" aria-describedby="papellidoHelp" name="idprimerap">
                        </div>
                        <div class="mb-3">
                            <label for="exampleInputEmail1" class="form-label">Segundo Apellido</label>
                            <input placeholder="Aguilar" type="text" class="form-control" id="idsegundoap" aria-describedby="sapellidoHelp" name="idsegundoap">
                        </div>
                        <div class="mb-3">
                            <label for="exampleInputEmail1" class="form-label">Correo electronico *</label>
                            <input placeholder="ejemplo@correo.com" type="email" class="form-control" id="idcorreo" aria-describedby="correoHelp" name="idcorreo">
                        </div>
                        <div class="mb-3">
                            <label for="exampleInputEmail1" class="form-label">Telefono *</label>
                            <input placeholder="+56911223344" type="text" class="form-control" id="idtelefono" aria-describedby="telefonoHelp" name="idtelefono">
                        </div>
                        <label class="form-label">Cargo</label>
                        <div class="botonesformulario">
                            <div class="dropdown-center">
                                <button class="btn btn-secondary dropdown-toggle btn-sm" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                                  Cargo *
                                </button>
                                <ul class="dropdown-menu">
                                    {{-- @foreach ($cargos as $cargo)
                                        <li id="{{ $cargo->id_cargo }}" class="dropdown-item" onclick="actualizarTextoCargo('cargoregistro', 'inputcargoregistro', '{{ $cargo->nomb_cargo }}', '{{ $cargo->id_cargo }}')">{{ $cargo->nomb_cargo }}</li>
                                    @endforeach --}}
                                </ul>
                            </div>
                            <p id="cargoregistro"></p>
                            <input type="text" name="inputcargoregistro" id="inputcargoregistro" hidden>
                        </div>
                        <label class="form-label">Turno</label>
                        <div class="botonesformulario">
                            <div class="dropdown-center">
                                <button class="btn btn-secondary dropdown-toggle btn-sm" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                                  Turno *
                                </button>
                                <ul class="dropdown-menu">
                                    {{-- @foreach ($turnos as $turno)
                                        <li id="{{ $turno->id_turno }}" class="dropdown-item" onclick="actualizarTextoTurno('turnoregistro', 'inputturnoregistro', '{{ $turno->hora_entrada_turno }} - {{ $turno->hora_salida_turno }}', '{{ $turno->id_turno }}')">{{ $turno->hora_entrada_turno }} - {{ $turno->hora_salida_turno }}</li>
                                    @endforeach --}}
                                </ul>
                            </div>
                            <p id="turnoregistro"></p>
                            <input type="text" name="inputturnoregistro" id="inputturnoregistro" hidden>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                    <button form="formularioregistro" type="submit" class="btn btn-primary">Registrar competidor</button>
                </div>
            </div>
        </div>
    </div>

    <div class="menu">
        <ul>
            <li><a href="{{ url('/competidores') }}">Lista de competidores</a></li>
            <li><a href="{{ url('/addcompetidores') }}" data-bs-toggle="modal" data-bs-target="#modalRegistrar">Registrar competidores</a></li>
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
                    <th scope="col">ID</th>
                    <th scope="col">RUT</th>
                    <th scope="col">Nombre</th>
                    <th scope="col">Apellidos</th>
                    <th scope="col">Peso</th>
                    <th scope="col">Cinturon</th>
                    <th scope="col">Edad</th>
                    <th scope="col">Correo</th>
                    <th scope="col">Telefono</th>
                    <th scope="col">Escuela</th>
                    <th></th>
                </tr>
            </thead>
            <tbody id="cuerpotabla">
                @foreach ($competidores as $competidor)
                    <tr>
                        <th scope="row">{{ $competidor->id_competidor }}</th>
                        <td>{{ $competidor->rut_competidor }}</td>
                        <td>{{ $competidor->nombre_competidor }}</td>
                        <td>{{ $competidor->primer_apellido_competidor }} {{ $competidor->segundo_apellido_competidor }}</td>
                        <td>{{ $competidor->peso_competidor }}</td>
                        <td>{{ $competidor->cinturon_competidor }}</td>
                        <td>{{ $competidor->edad_competidor }}</td>
                        <td>{{ $competidor->correo_competidor }}</td>
                        <td>{{ $competidor->telefono_competidor }}</td>
                        <td>{{ $competidor->escuela_id_escuela }}</td>
                        <td>
                            <div class="botonestablacompetidors">
                                <button class="btn btn-warning btn-sm"  data-bs-toggle="modal" data-bs-target="#modalEditar{{ $competidor->id_competidor }}" href="#">
                                    <i class="fa-solid fa-pen-to-square" style="color: #ffffff;"></i>
                                </button>
                                <form action="{{ route('competidor.borrar', $competidor->id_competidor) }}" method="POST" style="display: inline;">
                                    @csrf
                                    <button type="submit" class="btn btn-danger btn-sm">
                                        <i class="fa-solid fa-trash" style="color: #ffffff;"></i>
                                    </button>
                                </form>
                            </div>
                        </td>

                        <!-- Modal editar competidor -->
                        <div class="modal fade" id="modalEditar{{ $competidor->id_competidor }}" tabindex="-1" aria-labelledby="modalEditarLabel"
                            aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h1 class="modal-title fs-5" id="modalEditarLabel{{ $competidor->id_competidor }}">Editando {{ $competidor->rut_competidor }} - {{ $competidor->nombre_competidor }} {{ $competidor->primer_apellido_competidor }}</h1>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                        <form id="formularioeditar{{ $competidor->id_competidor }}" action="{{ route('competidor.editar') }}" method="POST">
                                            @csrf
                                            <div class="mb-3">
                                                <label for="exampleInputEmail1" class="form-label">RUT *</label>
                                                <input value="{{ $competidor->rut_competidor }}" placeholder="Sin puntos, guión ni digito verificador" type="text" class="form-control" id="editarrut" aria-describedby="rutHelp" name="editarrut">
                                            </div>
                                            <div class="mb-3">
                                                <label for="exampleInputEmail1" class="form-label">Nombres *</label>
                                                <input value="{{ $competidor->nombre_competidor }}" placeholder="Javier Nicolas" type="text" class="form-control" id="editarnombres" aria-describedby="nombresHelp" name="editarnombres">
                                            </div>
                                            <div class="mb-3">
                                                <label for="exampleInputEmail1" class="form-label">Primer Apellido *</label>
                                                <input value="{{ $competidor->primer_apellido_competidor }}" placeholder="Sanchez" type="text" class="form-control" id="editarpapellido" aria-describedby="papellidoHelp" name="editarpapellido">
                                            </div>
                                            <div class="mb-3">
                                                <label for="exampleInputEmail1" class="form-label">Segundo Apellido</label>
                                                <input value="{{ $competidor->segundo_apellido_competidor }}" placeholder="Aguilar" type="text" class="form-control" id="editarsapellido" aria-describedby="sapellidoHelp" name="editarsapellido">
                                            </div>
                                            <div class="mb-3">
                                                <label for="exampleInputEmail1" class="form-label">Correo electronico *</label>
                                                <input value="{{ $competidor->correo_competidor }}" placeholder="ejemplo@correo.com" type="email" class="form-control" id="editaremail" aria-describedby="correoHelp" name="editaremail">
                                            </div>
                                            <div class="mb-3">
                                                <label for="exampleInputEmail1" class="form-label">Telefono *</label>
                                                <input value="{{ $competidor->telefono_competidor }}" placeholder="+56911223344" type="text" class="form-control" id="editartelefono" aria-describedby="telefonoHelp" name="editartelefono">
                                            </div>
                                            <label class="form-label">Cargo</label>
                                            <div class="botonesformulario">
                                                <div class="dropdown-center">
                                                    <button class="btn btn-secondary dropdown-toggle btn-sm" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                                                      Cargo *
                                                    </button>
                                                    <ul class="dropdown-menu">
                                                        {{-- @foreach ($cargos as $cargo)
                                                            <li id="{{ $cargo->id_cargo }}" class="dropdown-item" onclick="actualizarTextoCargo('cargoeditar{{ $competidor->id_competidor }}', 'inputcargoeditar{{ $competidor->id_competidor }}', '{{ $cargo->nomb_cargo }}', '{{ $cargo->id_cargo }}')">{{ $cargo->nomb_cargo }}</li>
                                                        @endforeach --}}
                                                    </ul>
                                                </div>
                                                {{-- <p id="cargoeditar{{ $competidor->id_competidor }}">{{ $competidor->nomb_cargo }}</p>
                                                <input value="{{ $cargo->id_cargo }}" type="text" name="inputcargoeditar{{ $competidor->id_competidor }}" id="inputcargoeditar{{ $competidor->id_competidor }}" hidden> --}}
                                            </div>
                                            <label class="form-label">Turno</label>
                                            <div class="botonesformulario">
                                                <div class="dropdown-center">
                                                    <button class="btn btn-secondary dropdown-toggle btn-sm" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                                                      Turno *
                                                    </button>
                                                    <ul class="dropdown-menu">
                                                        {{-- @foreach ($turnos as $turno)
                                                            <li id="{{ $turno->id_turno }}" class="dropdown-item" onclick="actualizarTextoTurno('turnoeditar{{ $competidor->id_competidor }}', 'inputturnoeditar{{ $competidor->id_competidor }}', '{{ $turno->hora_entrada_turno }} - {{ $turno->hora_salida_turno }}', '{{ $turno->id_turno }}')">{{ $turno->hora_entrada_turno }} - {{ $turno->hora_salida_turno }}</li>
                                                        @endforeach --}}
                                                    </ul>
                                                </div>
                                                {{-- <p id="turnoeditar{{ $competidor->id_competidor }}">{{ $competidor->hora_entrada_turno }} - {{ $competidor->hora_salida_turno }}</p>
                                                <input value="{{ $competidor->id_turno }}" type="text" name="inputturnoeditar{{ $competidor->id_competidor }}" id="inputturnoeditar{{ $competidor->id_competidor }}" hidden> --}}
                                            </div>
                                            <input value="{{ $competidor->id_competidor }}" type="text" name="inputeditarid" id="inputeditarid" hidden>
                                        </form>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                                        <button type="submit" form="formularioeditar{{ $competidor->id_competidor }}" class="btn btn-primary">Guardar cambios</button>
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


