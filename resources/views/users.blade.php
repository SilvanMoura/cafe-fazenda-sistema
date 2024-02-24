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
            <h5>Usuários</h5>
        </div>
        <!-- php if ($this->permission->checkPermission($this->session->userdata('permissao'), 'aCliente')) { ?> -->
        <a class="button btn btn-mini btn-success open-modal-create" style="max-width: 165px">
            <span class="button__icon"><i class='bx bx-plus-circle'></i></span><span class="button__text2">
                Usuário
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
                            <th>Email</th>
                        </tr>
                    </thead>
                    <tbody>

                        <tr>
                            <td style="width:5%;"></td>
                            <td style="width:20%;"></td>
                            <td style="width:20%;"></td>
                            <td style="width:6%;">
                                <a href="#modal-edit" role="button" data-toggle="modal" class="btn-nwe3 open-edit-user" title="Editar Máquina"><i class="bx bx-edit bx-xs"></i></a>
                                <a href="#modal-delete" role="button" data-toggle="modal" class="btn-nwe4 open-modal-delete" title="Excluir Máquina"><i class="bx bx-trash-alt bx-xs"></i></a>
                            </td>
                        </tr>
                        <tr>
                            <td colspan="6">Nenhum Usuário Cadastrado</td>
                        </tr>

                    </tbody>
                </table>
            </div>
        </div>
        <!-- <php echo $this->pagination->create_links(); ?> -->

        <!-- Modal Estoque -->
        <div id="edit-user" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
            <form id="formEdit">
                @csrf
                <div class="modal-header">
                    <button type="button" class="close close-btn" data-dismiss="modal" aria-hidden="true">×</button>
                    <h5 id="myModalLabel"><i class="fas fa-plus-square"></i> Editar Usuário</h5>
                </div>

                <div class="modal-body">

                    <input type="hidden" id="idUser" class="idUser" name="id" value="" />
                    <div class="control-group">
                        <label for="userNameModelo" class="control-label">Nome</label>
                        <div class="controls">
                            <input id="userNameModelo" type="text" name="userNameModelo" value="" />
                        </div>
                    </div>

                    <div class="control-group">
                        <label for="numberSerie" class="control-label">E-mail</label>
                        <div class="controls">
                            <input id="numberSerie" type="text" name="numberSerie" value="" />
                        </div>
                    </div>

                    <div class="modal-footer" style="display:flex;justify-content: center">
                        <button id="btnUpdate" class="button btn btn-primary"><span class="button__icon"><i class="bx bx-sync"></i></span><span class="button__text2">Atualizar</span></button>
                        <button type="button" class="button btn btn-warning close-btn" data-dismiss="modal" aria-hidden="true"><span class="button__icon"><i class="bx bx-x"></i></span><span class="button__text2">Cancelar</span></button>
                    </div>
            </form>
        </div>

    </div>

    <div id="delete-user" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <form id="formDelete">
            @csrf
            <div class="modal-header">
                <button type="button" class="close close-delete" data-dismiss="modal" aria-hidden="true">×</button>
                <h5 id="myModalLabel"><i class="fas fa-trash-alt"></i> Excluir Usuário</h5>
            </div>

            <div class="modal-body">
                <input type="hidden" id="idUser-delete" class="idUser-delete" name="id" value="" />
                <h5 style="text-align: center">Deseja realmente excluir o usuário <span id="id-delete"></span>?</h5>
            </div>
            <div class="modal-footer" style="display:flex;justify-content: center">
                <button type="button" class="button btn btn-warning close-delete" data-dismiss="modal" aria-hidden="true"><span class="button__icon"><i class="bx bx-x"></i></span><span class="button__text2">Cancelar</span></button>
                <button id="btnDelete" class="button btn btn-danger"><span class="button__icon"><i class='bx bx-trash'></i></span> <span class="button__text2">Excluir</span></button>
            </div>
        </form>
    </div>

    <div id="create-user" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <form id="formCreate">
            @csrf
            <div class="modal-header">
                <button type="button" class="close close-create" data-dismiss="modal" aria-hidden="true">×</button>
                <h5 id="myModalLabel"><i class="fas fa-plus-square"></i> Criar Usuário</h5>
            </div>

            <div class="modal-body">

                <div class="control-group">
                    <label for="userNameModelo" class="control-label">Nome</label>
                    <div class="controls">
                        <input id="userNameModelo" type="text" name="userNameModelo" value="" />
                    </div>
                </div>

                <div class="modal-footer" style="display:flex;justify-content: center">
                    <button id="btnCreate" class="button btn btn-success"><span class="button__icon"><i class="bx bx-plus"></i></span><span class="button__text2">Adicionar</span></button>
                    <button type="button" class="button btn btn-warning close-btn close-create" data-dismiss="modal" aria-hidden="true"><span class="button__icon"><i class="bx bx-x"></i></span><span class="button__text2">Cancelar</span></button>
                </div>
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
        $('#Manufacturer').select2({
            tags: true
        });

        $('#Manufacturers').select2({
            tags: true
        });

        $('.open-edit-user').on('click', function(event) {
            var modal = document.getElementById("edit-user");
            modal.classList.remove("hide", "fade");

            var userId = $(this).attr('data-userId');
            var userName = $(this).attr('data-userName');
            var userNumber = $(this).attr('data-userNumber');
            var userManufacturer = $(this).attr('data-userManufacturer');

            $('#idUser').val(userId);
            $('#userNameModelo').val(userName);
            $('#numberSerie').val(userNumber);
            $('#userManufacturer').val(userManufacturer);
        });

        $('.open-modal-delete').on('click', function(event) {
            var modal = document.getElementById("delete-user");
            modal.classList.remove("hide", "fade");

            var userId = $(this).attr('data-userId');

            $('#idUser-delete').val(userId);
            $('#id-delete').text(userId);
        });

        $('.open-modal-create').on('click', function(event) {
            var modal = document.getElementById("create-user");
            modal.classList.remove("hide", "fade");
        });

        $('.close-btn').on('click', function(event) {
            var modal = document.getElementById("edit-user");
            modal.classList.add("hide", "fade");
        })

        $('.close-create').on('click', function(event) {
            var modal = document.getElementById("create-user");
            modal.classList.add("hide", "fade");
        })

        $('.close-delete').on('click', function(event) {
            var modal = document.getElementById("delete-user");
            modal.classList.add("hide", "fade");
        })

        $('#btnCreate').on('click', function(e) {
            e.preventDefault();

            // Validação do formulário usando o plugin validate
            if ($("#formCreate").valid()) {

                // Serializar dados incluindo o valor selecionado
                var dados = $("#formCreate").serialize();

                // Requisição AJAX
                $.ajax({
                    type: "POST",
                    url: "http://localhost:8000/usuarios/adicionar",
                    data: dados,
                    dataType: 'json',
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    success: function(data) {
                        if (data.message === "Usuário registrado com sucesso") {
                            var modal = document.getElementById("create-user");
                            modal.classList.add("hide", "fade");

                            Swal.fire({
                                icon: 'success',
                                title: 'Cadastro Concluído',
                                text: 'Usuário registrado com sucesso!',
                            }).then(() => {
                                window.location.href = "http://localhost:8000/dashboard";
                            });
                        } else {
                            var modal = document.getElementById("create-user");
                            modal.classList.add("hide", "fade");

                            Swal.fire({
                                icon: 'error',
                                title: 'Erro na criação',
                                text: data.message,
                            });
                        }
                    },
                    error: function(xhr, status, error) {
                        var modal = document.getElementById("create-user");
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

        $('#btnDelete').on('click', function(e) {
            e.preventDefault();

            // Validação do formulário usando o plugin validate
            if ($("#formDelete").valid()) {

                var dados = $("#formDelete").serializeArray();

                $(this).addClass('disabled');
                $('#progress-acessar').removeClass('hide');

                // Requisição AJAX
                $.ajax({
                    type: "DELETE",
                    url: "http://localhost:8000/maquinas/delete/" + dados[1]['value'],
                    data: dados,
                    dataType: 'json',
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    success: function(data) {
                        if (data.message === "Máquina excluida com sucesso") {
                            var modal = document.getElementById("delete-user");
                            modal.classList.add("hide", "fade");
                            Swal.fire({
                                icon: 'success',
                                title: 'Exclusão Concluída',
                                text: 'Máquina excluida com sucesso!',
                            }).then(() => {
                                window.location.href = "http://localhost:8000/dashboard";
                            });
                        } else {
                            var modal = document.getElementById("delete-user");
                            modal.classList.add("hide", "fade");

                            Swal.fire({
                                icon: 'error',
                                title: 'Erro na exclusão',
                                text: data.message,
                            });
                        }
                    },
                    error: function(xhr, status, error) {
                        var modal = document.getElementById("delete-user");
                        modal.classList.add("hide", "fade");

                        Swal.fire({
                            icon: 'error',
                            title: 'Erro na exclusão',
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

                var selectedManufacturer = $('#Manufacturer').val();

                var dados = $("#formEdit").serializeArray();
                dados.push({
                    name: 'manufacturerNew',
                    value: selectedManufacturer
                });

                // Requisição AJAX
                $.ajax({
                    type: "PUT",
                    url: "http://localhost:8000/maquinas/atualizar/" + dados[1]['value'],
                    data: dados,
                    dataType: 'json',
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    success: function(data) {
                        if (data.message === "Máquina alterada com sucesso") {
                            var modal = document.getElementById("edit-user");
                            modal.classList.add("hide", "fade");
                            Swal.fire({
                                icon: 'success',
                                title: 'Alteração Concluído',
                                text: 'Máquina alterada com sucesso!',
                            }).then(() => {
                                window.location.href = "http://localhost:8000/dashboard";
                            });
                        } else {
                            var modal = document.getElementById("edit-user");
                            modal.classList.add("hide", "fade");
                            Swal.fire({
                                icon: 'error',
                                title: 'Erro na alteração',
                                text: data.message,
                            });
                        }
                    },
                    error: function(xhr, status, error) {

                        var modal = document.getElementById("edit-user");
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