@extends('layouts/app')

@section('content')

<style>
    select {
        width: 70px;
    }

    .scrollable-container {
        height: 400px;
        overflow-y: auto;
    }

    .select2-container {
        z-index: 99999;
    }

    .select2-search__field {
        width: 100% !important;
    }
</style>
<div style="height: 90vh; width: 99vw;">
    <div class="new122" style="margin: 1% 1% 0 7%;">
        <div class="widget-title" style="margin: -20px 0 0">
            <span class="icon">
                <i class="fas fa-user"></i>
            </span>
            <h5>Cidades</h5>
        </div>
        <!-- php if ($this->permission->checkPermission($this->session->userdata('permissao'), 'aCliente')) { ?> -->
        <a class="button btn btn-mini btn-success open-modal-create" style="max-width: 165px">
            <span class="button__icon"><i class='bx bx-plus-circle'></i></span><span class="button__text2">
                Cidades
            </span>
        </a>
        <!-- ?php } ?> -->

        <div class="widget-box">
            <h5 style="padding: 3px 0"></h5>
            <div class="widget-content nopadding tab-content scrollable-container">
                <table id="tabela" class="table table-bordered ">
                    <thead>
                        <tr>
                            <th>Id</th>
                            <th>Nome</th>
                            <th>Sigla - Estado</th>
                        </tr>
                    </thead>
                    <tbody>

                        @if($cities->count() > 0)
                        @foreach ($cities as $r)
                        <tr>
                            <td style="width:5%;">{{ $r->id }}</td>
                            <td style="width:43%;">{{ $r->nome }}</td>
                            <td style="width:42%;">{{ $r->estado_nome }}</td>
                            <td style="width:6%;">
                                <a href="#modal-edit" role="button" data-toggle="modal" data-cityId="{{ $r->id }}" data-cityName="{{ $r->nome }}" data-stateName="{{ $r->estado_nome }}" data-cityName="{{ $r->nome }}" class="btn-nwe3 open-edit-city" title="Editar Máquina"><i class="bx bx-edit bx-xs"></i></a>
                                <a href="#modal-delete" role="button" data-toggle="modal" data-cityId="{{ $r->id }}" data-cityName="{{ $r->nome }}" data-stateName="{{ $r->estado_nome }}" class="btn-nwe4 open-delete-city" title="Excluir Máquina"><i class="bx bx-trash-alt bx-xs"></i></a>
                            </td>
                        </tr>
                        @endforeach
                        @else
                        <tr>
                            <td colspan="6">Nenhuma Cidade Cadastrada</td>
                        </tr>
                        @endif

                    </tbody>
                </table>
            </div>
        </div>
        <!-- <php echo $this->pagination->create_links(); ?> -->

        <!-- Modal Estoque -->
        <div id="edit-city" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
            <form id="formEdit">
                @csrf
                <div class="modal-header">
                    <button type="button" class="close close-btn" data-dismiss="modal" aria-hidden="true">×</button>
                    <h5 id="myModalLabel"><i class="fas fa-plus-square"></i> Editar Cidade</h5>
                </div>

                <div class="modal-body">

                    <input type="hidden" id="id" class="id" name="id" value="" />

                    <div class="control-group">
                        <label for="cityName" class="control-label">Cidade Atual</label>
                        <div class="controls">
                            <input id="cityName" type="text" name="cityName" value="" />

                        </div>
                    </div>

                    <div class="control-group">
                        <label for="stateName" class="control-label">Estado Atual</label>
                        <div class="controls">
                            <input id="stateName" type="text" name="stateName" readonly value="" />
                        </div>
                    </div>

                    <div class="control-group" style="width: 42%">
                        <label for="state" class="control-label">Novo Estado</label>
                        <div class="controls">
                            <select id="state" class="js-example-basic-single" name="stateEdit" style="width: 100%">
                                <option>Selecione</option>
                                @foreach($states as $f)
                                <option value="{{ $f->id }}">{{ $f->nome }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    <div class="modal-footer" style="display:flex;justify-content: center">
                        <button id="btnUpdate" class="button btn btn-primary"><span class="button__icon"><i class="bx bx-sync"></i></span><span class="button__text2">Atualizar</span></button>
                        <button type="button" class="button btn btn-warning close-btn" data-dismiss="modal" aria-hidden="true"><span class="button__icon"><i class="bx bx-x"></i></span><span class="button__text2">Cancelar</span></button>
                    </div>
            </form>
        </div>

    </div>

    <div id="delete-city" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <form id="formDelete">
            @csrf
            <div class="modal-header">
                <button type="button" class="close close-delete" data-dismiss="modal" aria-hidden="true">×</button>
                <h5 id="myModalLabel"><i class="fas fa-trash-alt"></i> Excluir Cidade</h5>
            </div>
            <div class="modal-body">
                <input type="hidden" id="idCity" class="idCity" name="id" value="" />
                <h5 style="text-align: center">Deseja realmente excluir a Cidade <span id="id-delete"></span> - <span id="city-delete"></span>?</h5>
            </div>
            <div class="modal-footer" style="display:flex;justify-content: center">
                <button type="button" class="button btn btn-warning close-delete" data-dismiss="modal" aria-hidden="true"><span class="button__icon"><i class="bx bx-x"></i></span><span class="button__text2">Cancelar</span></button>
                <button id="btnDelete" class="button btn btn-danger"><span class="button__icon"><i class='bx bx-trash'></i></span> <span class="button__text2">Excluir</span></button>
            </div>
        </form>
    </div>

    <div id="create-city" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <form id="formCreate">
            @csrf
            <div class="modal-header">
                <button type="button" class="close close-create" data-dismiss="modal" aria-hidden="true">×</button>
                <h5 id="myModalLabel"><i class="fas fa-plus-square"></i> Criar Cidade</h5>
            </div>

            <div class="modal-body">

                <div class="control-group">
                    <label for="cityName-create" class="control-label">Nome da Cidade</label>
                    <div class="controls">
                        <input id="cityName-create" type="text" name="cityName-create" value="" />
                    </div>
                </div>

                <div class="control-group" style="width: 42%">
                        <label for="state-create" class="control-label">Sigla do Estado</label>
                        <div class="controls">
                            <select id="state-create" class="js-example-basic-single" style="width: 100%">
                                <option>Selecione</option>
                                @foreach($states as $f)
                                <option value="{{ $f->id }}">{{ $f->nome }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                <div class="modal-footer" style="display:flex;justify-content: center">
                    <button id="btnCreate" class="button btn btn-success"><span class="button__icon"><i class="bx bx-plus"></i></span><span class="button__text2">Adicionar</span></button>
                    <button type="button" class="button btn btn-warning close-btn close-create" data-dismiss="modal" aria-hidden="true"><span class="button__icon"><i class="bx bx-x"></i></span><span class="button__text2">Cancelar</span></button>
                </div>
        </form>
    </div>

</div>

</div>


</div>

</div>
</div>

<script src="{{ asset('js/jquery.validate.js') }}"></script>
<script src="{{ asset('js/sweetalert2.all.min.js') }}"></script>
<script type="text/javascript">
    $(document).ready(function() {
        $('#state').select2({
            tags: true
        });

        $('#state-create').select2({
            tags: true
        });

        $('.open-edit-city').on('click', function(event) {
            var modal = document.getElementById("edit-city");
            modal.classList.remove("hide", "fade");


            var id = $(this).attr('data-cityId');
            var cityName = $(this).attr('data-cityName');
            var stateName = $(this).attr('data-stateName');

            $('#id').val(id);
            $('#cityName').val(cityName);
            $('#stateName').val(stateName);
        });

        $('.open-delete-city').on('click', function(event) {
            var modal = document.getElementById("delete-city");
            modal.classList.remove("hide", "fade");

            var cityId = $(this).attr('data-cityId');
            var cityName = $(this).attr('data-cityName');

            $('#idCity').val(cityId);
            $('#id-delete').text(cityId);
            $('#city-delete').text(cityName);
        });

        $('.open-modal-create').on('click', function(event) {
            var modal = document.getElementById("create-city");
            modal.classList.remove("hide", "fade");
        });

        $('.close-btn').on('click', function(event) {
            var modal = document.getElementById("edit-city");
            modal.classList.add("hide", "fade");
        })

        $('.close-create').on('click', function(event) {
            var modal = document.getElementById("create-city");
            modal.classList.add("hide", "fade");
        })

        $('.close-delete').on('click', function(event) {
            var modal = document.getElementById("delete-city");
            modal.classList.add("hide", "fade");
        })

        $('#btnCreate').on('click', function(e) {
            e.preventDefault();

            // Validação do formulário usando o plugin validate
            if ($("#formCreate").valid()) {

                var selectedManufacturer = $('#state-create').val();

                // Serializar dados incluindo o valor selecionado
                var dados = $("#formCreate").serialize() + '&state=' + selectedManufacturer;

                // Requisição AJAX
                $.ajax({
                    type: "POST",
                    url: "http://localhost:8000/cidades/adicionar",
                    data: dados,
                    dataType: 'json',
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    success: function(data) {
                        if (data.message === "Cidade registrada com sucesso") {
                            var modal = document.getElementById("create-city");
                            modal.classList.add("hide", "fade");

                            Swal.fire({
                                icon: 'success',
                                title: 'Cadastro Concluído',
                                text: 'Cidade registrada com sucesso!',
                            }).then(() => {
                                window.location.href = "http://localhost:8000/dashboard";
                            });
                        } else {
                            var modal = document.getElementById("create-manufacturer");
                            modal.classList.add("hide", "fade");

                            Swal.fire({
                                icon: 'error',
                                title: 'Erro na criação',
                                text: data.message,
                            });
                        }
                    },
                    error: function(xhr, status, error) {
                        var modal = document.getElementById("create-city");
                        modal.classList.add("hide", "fade");

                        Swal.fire({
                            icon: 'error',
                            title: 'Erro na criação',
                            text: xhr.responseJSON.message,
                        });
                    },
                    complete: function() {
                        // Limpar qualquer indicação visual de loading, se necessário
                    }
                });
            }
        })

        $('#btnUpdate').on('click', function(e) {
            e.preventDefault();

            // Validação do formulário usando o plugin validate
            if ($("#formEdit").valid()) {

                var dados = $("#formEdit").serializeArray();

                // Requisição AJAX
                $.ajax({
                    type: "PUT",
                    url: "http://localhost:8000/cidades/atualizar/" + dados[1]['value'],
                    data: dados,
                    dataType: 'json',
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    success: function(data) {
                        if (data.message === "Cidade alterada com sucesso") {
                            var modal = document.getElementById("edit-city");
                            modal.classList.add("hide", "fade");
                            Swal.fire({
                                icon: 'success',
                                title: 'Alteração Concluído',
                                text: 'Cidade alterada com sucesso!',
                            }).then(() => {
                                window.location.href = "http://localhost:8000/dashboard";
                            });
                        } else {
                            var modal = document.getElementById("edit-city");
                            modal.classList.add("hide", "fade");
                            Swal.fire({
                                icon: 'error',
                                title: 'Erro na alteração',
                                text: data.message,
                            });
                        }
                    },
                    error: function(xhr, status, error) {

                        var modal = document.getElementById("edit-city");
                        modal.classList.add("hide", "fade");

                        Swal.fire({
                            icon: 'error',
                            title: 'Erro na alteração',
                            text: xhr.responseJSON.message,
                        });
                    },
                    complete: function() {
                        // Limpar qualquer indicação visual de loading, se necessário
                    }
                });
            }
        })
    });
</script>

@endsection