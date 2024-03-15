@include('/componentes/header')


<div class="cuerpo">

    <!-- Modal crear deporte -->
    <div class="modal fade" id="modalRegistrarDeporte" tabindex="-1" aria-labelledby="modalEditarLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="modalEditarLabel">Añadir nuevo deporte</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form id="formularioregistrodeporte" action="{{ route('deportcateg.deporteadd') }}" method="POST">
                        @csrf
                        <div class="mb-3">
                            <label for="exampleInputEmail1" class="form-label">Nombre del deporte *</label>
                            <input placeholder="BJJ, Taekwondo..." type="text" class="form-control"
                                id="nombrenuevodeporte" aria-describedby="rutHelp" name="nombrenuevodeporte" required>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                    <button form="formularioregistrodeporte" type="submit" class="btn btn-primary">Crear
                        deporte</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal crear categoria -->
    <div class="modal fade" id="modalRegistrarCategoria" tabindex="-1" aria-labelledby="modalEditarLabel"
        aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="modalEditarLabel">Añadir nueva categoria</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form id="formularioregistrocategoria" action="{{ route('deportcateg.categoriaadd') }}"
                        method="POST">
                        @csrf
                        <div class="mb-3">
                            <label for="exampleInputEmail1" class="form-label">Nombre de la categoria *</label>
                            <input placeholder="Cinturon, peso, edad..." type="text" class="form-control"
                                id="nombrenuevacategoria" aria-describedby="rutHelp" name="nombrenuevacategoria"
                                required>
                        </div>
                        <label class="form-label">Deporte</label>
                        <div class="botonesformulario">
                            <div class="dropdown-center">
                                <button class="btn btn-secondary dropdown-toggle btn-sm" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                                    Deporte *
                                </button>
                                <ul class="dropdown-menu">
                                    @foreach ($deportes as $deporte)
                                        <li id="{{ $deporte->id_deporte }}" class="dropdown-item" onclick="actualizarTextoEscuela('categoriaregistro', 'inputcategoriaregistro', '{{ $deporte->nombre_deporte }}', '{{ $deporte->id_deporte }}')">{{ $deporte->nombre_deporte }}</li>
                                    @endforeach
                                </ul>
                            </div>
                            <p id="categoriaregistro"></p>
                            <input type="text" name="inputcategoriaregistro" id="inputcategoriaregistro" hidden>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                    <button form="formularioregistrocategoria" type="submit" class="btn btn-primary">Crear
                        categoria</button>
                </div>
            </div>
        </div>
    </div>

    <div class="menu">
        <ul>
            <li><a href="{{ url('/deportesycategorias') }}">Mostrar deportes y categorias</a></li>
            <li><a href="{{ url('/adddeporte') }}" data-bs-toggle="modal" data-bs-target="#modalRegistrarDeporte">Añadir
                    deporte</a></li>
            <li><a href="{{ url('/addcategoria') }}" data-bs-toggle="modal"
                    data-bs-target="#modalRegistrarCategoria">Crear nueva categoria</a></li>
        </ul>
    </div>

    <div class="contenido">

        <!-- Tabla categorias -->
        <div id="tablacategoria" class="table-responsive">
            <div class="herramientasarriba">
                <div class="buscador">
                    <h2>Buscar categorias</h2>
                    <p>Filtro 1:</p>
                    <input class="form-control inputbuscador" id="myInput1" type="text"
                        placeholder="Buscar nombre...">
                </div>

            </div>

            <table class="tabla table table-hover">
                <thead>
                    <tr>
                        <th scope="col">ID</th>
                        <th scope="col">Nombre categoria</th>
                        <th scope="col">Deporte</th>
                    </tr>
                </thead>
                <tbody id="cuerpotablacategoria">
                    @foreach ($deportesycategorias as $categoria)
                        <tr>
                            <td>{{ $categoria->id_categoria }}</td>
                            <td>{{ $categoria->nombre_categoria }}</td>
                            <td>{{ $categoria->nombre_deporte }}</td>
                        </tr>
                    @endforeach

                </tbody>
            </table>
        </div>

        <!-- Tabla deportes -->
        <div id="tabladeporte" class="table-responsive">
            <div class="herramientasarriba">
                <div class="buscador">
                    <h2>Buscar deportes</h2>
                    <p>Filtro 1:</p>
                    <input class="form-control inputbuscador" id="myInput2" type="text"
                        placeholder="Buscar nombre...">
                </div>

            </div>

            <table class="tabla table table-hover">
                <thead>
                    <tr>
                        <th scope="col">ID</th>
                        <th scope="col">Nombre deporte</th>
                    </tr>
                </thead>
                <tbody id="cuerpotabladeporte">
                    @foreach ($deportes as $deporte)
                        <tr>
                            <td>{{ $deporte->id_deporte }}</td>
                            <td>{{ $deporte->nombre_deporte }}</td>
                        </tr>
                    @endforeach

                </tbody>
            </table>
        </div>

    </div>
</div>

<script>
    $(document).ready(function() {
        $("#myInput1").on("keyup", function() {
            // Get the values from all filter inputs
            var value1 = $("#myInput1").val().toLowerCase();

            $("#cuerpotablacategoria tr").filter(function() {
                // Check if the text in any column contains any of the filter values
                var rowText = $(this).text().toLowerCase();

                var match1 = rowText.indexOf(value1) > -1 || value1 === "";

                // Toggle the row based on any filter condition
                $(this).toggle(match1);
            });
        });
    });
</script>

<script>
    $(document).ready(function() {
        $("#myInput2").on("keyup", function() {
            // Get the values from all filter inputs
            var value1 = $("#myInput2").val().toLowerCase();

            $("#cuerpotabladeporte tr").filter(function() {
                // Check if the text in any column contains any of the filter values
                var rowText = $(this).text().toLowerCase();

                var match1 = rowText.indexOf(value1) > -1 || value1 === "";

                // Toggle the row based on any filter condition
                $(this).toggle(match1);
            });
        });
    });
</script>
