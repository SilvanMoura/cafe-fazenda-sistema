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
            <h5>Máquinas Explodidas</h5>
        </div>
        <!-- php if ($this->permission->checkPermission($this->session->userdata('permissao'), 'aCliente')) { ?> -->
        <a class="button btn btn-mini btn-success open-modal-create" style="max-width: 165px">
            <span class="button__icon"><i class='bx bx-plus-circle'></i></span><span class="button__text2">
                Máquinas Explodidas
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
                            <th>Nome/Modelo</th>
                            <th>Fabricante</th>
                        </tr>
                    </thead>
                    <tbody>

                        @if($infoEexplanation->count() > 0)
                        @foreach ($infoEexplanation as $r)
                        <tr>
                            <td id="idExploded" style="width:5%;">{{ $r->id }}</td>
                            <td style="width:43%;">{{ $r->nome }}</td>
                            <td style="width:42%;">{{ $r->fabricante_id }}</td>
                            <input type="hidden" id="fileExploded-{{$r->id}}" class="fileExploded" name="fileExploded" value="{{$r->anexo}}" />
                            <td style="width:6%;">
                                <a href="#modal-edit" role="button" data-toggle="modal" data-explodedId="{{ $r->id }}" data-explodedName="{{ $r->nome }}" data-exploded="{{ $r->fabricante_id }}" data-fileName="{{ $r->anexo }}" class="btn-nwe3 open-edit-exploded" title="Editar Máquina"><i class="bx bx-edit bx-xs"></i></a>
                                <a href="#modal-open" role="button" data-toggle="modal" data-fileNameAnexo="{{ $r->anexo }}" class="" title="Abrir anexo"><i class="bx bx-search-alt bx-xs open-file"></i></a>
                            </td>
                        </tr>
                        @endforeach
                        @else
                        <tr>
                            <td colspan="6">Nenhum Manual Cadastrado</td>
                        </tr>
                        @endif

                    </tbody>
                </table>
            </div>
        </div>
        <!-- <php echo $this->pagination->create_links(); ?> -->

        <!-- Modal Estoque -->
        <div id="edit-exploded" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
            <form id="formEdit">
                @csrf
                <div class="modal-header">
                    <button type="button" class="close close-btn" data-dismiss="modal" aria-hidden="true">×</button>
                    <h5 id="myModalLabel"><i class="fas fa-plus-square"></i> Editar Manual</h5>
                </div>

                <div class="modal-body">

                    <input type="hidden" id="idExploded" class="idExploded" name="id" value="" />

                    <div class="control-group">
                        <label for="name" class="control-label">Nome/Modelo Atual</label>
                        <div class="controls">
                            <input id="name" type="text" name="name" value="" />
                        </div>
                    </div>

                    <input type="hidden" id="fileName" class="fileName" name="fileName" value="" />
                    <div class="control-group">
                        <label for="exploded" class="control-label">Fabricante Atual</label>
                        <div class="controls">
                            <input id="explodedName" type="text" name="explodedName" readonly value="" />
                        </div>
                    </div>

                    <div class="control-group" style="width: 42%">
                        <label for="exploded" class="control-label">Novo Fabricante</label>
                        <div class="controls">
                            <select id="exploded" class="js-example-basic-single" style="width: 100%">
                                <option>Selecione</option>
                                @foreach ($manufacturers as $r)
                                <option value="{{ $r->id }}">{{ $r->nome }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    <div class="control-group">
                        <label for="anexo" class="control-label">Anexo <small>(max: 8MB)</small></label>
                        <div class="controls">
                            <input type="file" class="custom-file-input" id="anexo" name="anexo">
                        </div>
                    </div>

                    <div class="modal-footer" style="display:flex;justify-content: center">
                        <button id="btnUpdate" class="button btn btn-primary"><span class="button__icon"><i class="bx bx-sync"></i></span><span class="button__text2">Atualizar</span></button>
                        <button type="button" class="button btn btn-warning close-btn" data-dismiss="modal" aria-hidden="true"><span class="button__icon"><i class="bx bx-x"></i></span><span class="button__text2">Cancelar</span></button>
                    </div>
            </form>
        </div>

    </div>

    <div id="create-exploded" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <form id="formCreate">
            @csrf
            <div class="modal-header">
                <button type="button" class="close close-create" data-dismiss="modal" aria-hidden="true">×</button>
                <h5 id="myModalLabel"><i class="fas fa-plus-square"></i> Criar Novo Manual</h5>
            </div>

            <div class="modal-body">

                <div class="control-group">
                    <label for="explodedName-create" class="control-label">Nome/Modelo</label>
                    <div class="controls">
                        <input id="explodedName-create" type="text" name="explodedName-create" value="" />
                    </div>
                </div>

                <div class="control-group" style="width: 42%">
                    <label for="explodedCreate" class="control-label">Fabricante</label>
                    <div class="controls">
                        <select id="explodedCreate" class="js-example-basic-single" style="width: 100%">
                            <option>Selecione</option>
                            @foreach ($manufacturers as $r)
                            <option value="{{ $r->id }}">{{ $r->nome }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>

                <div class="control-group">
                    <label for="anexo" class="control-label">Anexo <small>(max: 8MB)</small></label>
                    <div class="controls">
                        <input type="file" class="custom-file-input" id="anexo" name="anexo">
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
        $('#exploded').select2({
            tags: true
        });

        $('#explodedCreate').select2({
            tags: true
        });

        $('.open-edit-exploded').on('click', function(event) {
            var modal = document.getElementById("edit-exploded");
            modal.classList.remove("hide", "fade");

            var name = $(this).attr('data-explodedName');
            var explodedName = $(this).attr('data-exploded');
            var explodedId = $(this).attr('data-explodedId');
            var fileName = $(this).attr('data-fileName');

            $('#name').val(name);
            $('#idExploded').val(explodedId);
            $('#fileName').val(fileName);
            $('#explodedName').val(explodedName);
        });

        $('.open-modal-create').on('click', function(event) {
            var modal = document.getElementById("create-exploded");
            modal.classList.remove("hide", "fade");
        });

        $('.close-btn').on('click', function(event) {
            var modal = document.getElementById("edit-exploded");
            modal.classList.add("hide", "fade");
        })

        $('.close-create').on('click', function(event) {
            var modal = document.getElementById("create-exploded");
            modal.classList.add("hide", "fade");
        })

        $('.close-delete').on('click', function(event) {
            var modal = document.getElementById("delete-exploded");
            modal.classList.add("hide", "fade");
        })

        $('#btnCreate').on('click', function(e) {
            e.preventDefault();

            // Validação do formulário usando o plugin validate
            if ($("#formCreate").valid()) {

                var selectedManufacturer = $('#explodedCreate').val();

                var formData = new FormData($("#formCreate")[0]);

                // Use formData.append to add additional data
                formData.append('manufacturer', selectedManufacturer);

                // Requisição AJAX
                $.ajax({
                    type: "POST",
                    url: "http://191.252.192.67/explodida/adicionar",
                    data: formData,
                    processData: false,
                    contentType: false,
                    dataType: 'json',
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    success: function(data) {
                        if (data.message === "Manual cadastrado com sucesso") {
                            var modal = document.getElementById("create-exploded");
                            modal.classList.add("hide", "fade");
                            Swal.fire({
                                icon: 'success',
                                title: 'Cadastro Concluído',
                                text: 'Manual cadastrado com sucesso!',
                            }).then(() => {
                                window.location.href = "http://191.252.192.67/dashboard";
                            });
                        } else {
                            var modal = document.getElementById("create-exploded");
                            modal.classList.add("hide", "fade");
                            Swal.fire({
                                icon: 'error',
                                title: 'Erro no cadastro',
                                text: data.message,
                            });
                        }
                    },
                    error: function(xhr, status, error) {

                        var modal = document.getElementById("create-exploded");
                        modal.classList.add("hide", "fade");

                        Swal.fire({
                            icon: 'error',
                            title: 'Erro no cadastro',
                            text: xhr.responseJSON.message,
                        });
                    }
                });
            }
        });

        $('#btnUpdate').on('click', function(e) {
            e.preventDefault();

            // Validação do formulário usando o plugin validate
            if ($("#formEdit").valid()) {

                var selectedManufacturer = $('#exploded').val();
                var explodedId = $('#idExploded').val();

                var formData = new FormData($("#formEdit")[0]);

                // Use formData.append to add additional data
                formData.append('manufacturer', selectedManufacturer);

                // Requisição AJAX
                $.ajax({
                    type: "POST",
                    url: "http://191.252.192.67/explodida/atualizar/" + explodedId,
                    data: formData,
                    processData: false,
                    contentType: false,
                    dataType: 'json',
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    success: function(data) {
                        if (data.message === "Manual alterado com sucesso") {
                            var modal = document.getElementById("edit-exploded");
                            modal.classList.add("hide", "fade");
                            Swal.fire({
                                icon: 'success',
                                title: 'Cadastro Concluído',
                                text: 'Manual alterado com sucesso!',
                            }).then(() => {
                                window.location.href = "http://191.252.192.67/dashboard";
                            });
                        } else {
                            var modal = document.getElementById("edit-exploded");
                            modal.classList.add("hide", "fade");
                            Swal.fire({
                                icon: 'error',
                                title: 'Erro na alteração',
                                text: data.message,
                            });
                        }
                    },
                    error: function(xhr, status, error) {

                        var modal = document.getElementById("edit-exploded");
                        modal.classList.add("hide", "fade");

                        Swal.fire({
                            icon: 'error',
                            title: 'Erro na alteração',
                            text: xhr.responseJSON.message,
                        });
                    }
                });
            }
        });

        $('.open-file').on('click', function(e) {
            e.preventDefault();

            var fileName = $('#fileExploded-'+id).val();
            var id = $(this).closest('tr').find('#idExploded').text();
            var fileName = $('#fileExploded-'+id).val();
            
            window.open("http://191.252.192.67/explodida/abrir-pdf/" + fileName, '_blank');
        });
    });
</script>

@endsection