@include('/componentes/header')


<div class="cuerpo">

    <!-- Modal registrar instructor -->
    <div class="modal fade" id="modalRegistrar" tabindex="-1" aria-labelledby="modalEditarLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="modalEditarLabel">Registrar instructor</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                        aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form id="formularioregistro" action="{{ route('instructor.add') }}" method="POST">
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
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                    <button form="formularioregistro" type="submit" class="btn btn-primary">Registrar instructor</button>
                </div>
            </div>
        </div>
    </div>

    <div class="menu">
        <ul>
            <li><a href="{{ url('/instructores') }}">Lista de instructores</a></li>
            <li><a href="{{ url('/addinstructores') }}" data-bs-toggle="modal" data-bs-target="#modalRegistrar">Registrar instructores</a></li>
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
                    <th scope="col">RUT</th>
                    <th scope="col">Nombre</th>
                    <th scope="col">Apellidos</th>
                    <th scope="col">Correo</th>
                    <th scope="col">Telefono</th>
                    <th></th>
                </tr>
            </thead>
            <tbody id="cuerpotabla">
                @foreach ($instructores as $instructor)
                    <tr>
                        <td>{{ $instructor->rut_instructor }}</td>
                        <td>{{ $instructor->nombre_instructor }}</td>
                        <td>{{ $instructor->primer_apellido_instructor }} {{ $instructor->segundo_apellido_instructor }}</td>
                        <td>{{ $instructor->correo_instructor }}</td>
                        <td>{{ $instructor->telefono_instructor }}</td>
                        <td>
                            <div class="botonestablainstructors">
                                <button class="btn btn-warning btn-sm"  data-bs-toggle="modal" data-bs-target="#modalEditar{{ $instructor->id_instructor }}" href="#">
                                    <i class="fa-solid fa-pen-to-square" style="color: #ffffff;"></i>
                                </button>
                                <form action="{{ route('instructor.borrar', $instructor->id_instructor) }}" method="POST" style="display: inline;">
                                    @csrf
                                    <button type="submit" class="btn btn-danger btn-sm">
                                        <i class="fa-solid fa-trash" style="color: #ffffff;"></i>
                                    </button>
                                </form>
                            </div>
                        </td>

                        <!-- Modal editar instructor -->
                        <div class="modal fade" id="modalEditar{{ $instructor->id_instructor }}" tabindex="-1" aria-labelledby="modalEditarLabel"
                            aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h1 class="modal-title fs-5" id="modalEditarLabel{{ $instructor->id_instructor }}">Editando {{ $instructor->rut_instructor }} - {{ $instructor->nombre_instructor }} {{ $instructor->primer_apellido_instructor }}</h1>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                        <form id="formularioeditar{{ $instructor->id_instructor }}" action="{{ route('instructor.editar') }}" method="POST">
                                            @csrf
                                            <div class="mb-3">
                                                <label for="exampleInputEmail1" class="form-label">RUT *</label>
                                                <input value="{{ $instructor->rut_instructor }}" placeholder="Sin puntos, guión ni digito verificador" type="text" class="form-control" id="editarrut" aria-describedby="rutHelp" name="editarrut">
                                            </div>
                                            <div class="mb-3">
                                                <label for="exampleInputEmail1" class="form-label">Nombres *</label>
                                                <input value="{{ $instructor->nombre_instructor }}" placeholder="Javier Nicolas" type="text" class="form-control" id="editarnombres" aria-describedby="nombresHelp" name="editarnombres">
                                            </div>
                                            <div class="mb-3">
                                                <label for="exampleInputEmail1" class="form-label">Primer Apellido *</label>
                                                <input value="{{ $instructor->primer_apellido_instructor }}" placeholder="Sanchez" type="text" class="form-control" id="editarpapellido" aria-describedby="papellidoHelp" name="editarpapellido">
                                            </div>
                                            <div class="mb-3">
                                                <label for="exampleInputEmail1" class="form-label">Segundo Apellido</label>
                                                <input value="{{ $instructor->segundo_apellido_instructor }}" placeholder="Aguilar" type="text" class="form-control" id="editarsapellido" aria-describedby="sapellidoHelp" name="editarsapellido">
                                            </div>
                                            <div class="mb-3">
                                                <label for="exampleInputEmail1" class="form-label">Correo electronico *</label>
                                                <input value="{{ $instructor->correo_instructor }}" placeholder="ejemplo@correo.com" type="email" class="form-control" id="editaremail" aria-describedby="correoHelp" name="editaremail">
                                            </div>
                                            <div class="mb-3">
                                                <label for="exampleInputEmail1" class="form-label">Telefono *</label>
                                                <input value="{{ $instructor->telefono_instructor }}" placeholder="+56911223344" type="text" class="form-control" id="editartelefono" aria-describedby="telefonoHelp" name="editartelefono">
                                            </div>
                                            <input value="{{ $instructor->id_instructor }}" type="text" name="inputeditarid" id="inputeditarid" hidden>
                                        </form>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                                        <button type="submit" form="formularioeditar{{ $instructor->id_instructor }}" class="btn btn-primary">Guardar cambios</button>
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


