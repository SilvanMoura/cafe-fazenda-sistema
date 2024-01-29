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
            <h5>Máquinas</h5>
        </div>
        <!-- php if ($this->permission->checkPermission($this->session->userdata('permissao'), 'aCliente')) { ?> -->
        <a class="button btn btn-mini btn-success open-modal-create" style="max-width: 165px">
            <span class="button__icon"><i class='bx bx-plus-circle'></i></span><span class="button__text2">
                Máquina
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
                            <th>Nº Série</th>
                            <th>Fabricante</th>
                        </tr>
                    </thead>
                    <tbody>

                        @if($infoMachines->count() > 0)
                        @foreach ($infoMachines as $r)
                        <tr>
                            <td style="width:5%;">{{ $r->id }}</td>
                            <td style="width:20%;">{{ $r->nomemodelo }}</td>
                            <td style="width:20%;">{{ $r->numeroserie }}</td>
                            <td style="width:20%;">{{ $r->fabricante_id }}</td>
                            <td style="width:6%;">
                                <a href="#modal-edit" role="button" data-toggle="modal" data-machineId="{{ $r->id }}" data-machineName="{{ $r->nomemodelo }}" data-machineNumber="{{ $r->numeroserie }}" data-machineManufacturer="{{ $r->fabricante_id }}" class="btn-nwe3 open-edit-machine" title="Editar Máquina"><i class="bx bx-edit bx-xs"></i></a>
                                <a href="#modal-delete" role="button" data-toggle="modal" data-machineId="{{ $r->id }}" data-machineName="{{ $r->nomemodelo }}" data-machineNumber="{{ $r->numeroserie }}" data-machineManufacturer="{{ $r->fabricante_id }}" class="btn-nwe4 open-modal-delete" title="Excluir Máquina"><i class="bx bx-trash-alt bx-xs"></i></a>
                            </td>
                        </tr>
                        @endforeach
                        @else
                        <tr>
                            <td colspan="6">Nenhuma Máquina Cadastrada</td>
                        </tr>
                        @endif

                    </tbody>
                </table>
            </div>
        </div>
        <!-- <php echo $this->pagination->create_links(); ?> -->

        <!-- Modal Estoque -->
        <div id="edit-machine" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
            <form id="formEdit">
                @csrf
                <div class="modal-header">
                    <button type="button" class="close close-btn" data-dismiss="modal" aria-hidden="true">×</button>
                    <h5 id="myModalLabel"><i class="fas fa-plus-square"></i> Editar Máquina</h5>
                </div>

                <div class="modal-body">

                    <input type="hidden" id="idMachine" class="idMachine" name="id" value="" />
                    <div class="control-group">
                        <label for="machineNameModelo" class="control-label">Nome/Modelo</label>
                        <div class="controls">
                            <input id="machineNameModelo" type="text" name="machineNameModelo" value="" />
                        </div>
                    </div>

                    <div class="control-group">
                        <label for="NumberSerie" class="control-label">Nº Série</label>
                        <div class="controls">
                            <input id="NumberSerie" type="text" name="NumberSerie" value="" />
                        </div>
                    </div>

                    <div class="control-group">
                        <label for="machineManufacturer" class="control-label">Fabricante Atual</label>
                        <div class="controls">
                            <input id="machineManufacturer" type="text" name="machineManufacturer" readonly value="" />

                        </div>
                    </div>
                    <div class="control-group" style="width: 42%">
                        <label for="Manufacturer" class="control-label">Novo Fabricante</label>
                        <div class="controls">
                            <select id="Manufacturer" class="js-example-basic-single" style="width: 100%" data-default-value="NomeDesejado">
                                <option></option>
                                @foreach($manufactures as $f)
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

    <div id="delete-machine" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <form id="formDelete">
            @csrf
            <div class="modal-header">
                <button type="button" class="close close-delete" data-dismiss="modal" aria-hidden="true">×</button>
                <h5 id="myModalLabel"><i class="fas fa-trash-alt"></i> Excluir Máquina</h5>
            </div>
            <div class="modal-body">
                <input type="hidden" id="idMachine" class="idMachine" name="id" value="" />
                <h5 style="text-align: center">Deseja realmente excluir a máquina <span id="id-delete"></span>?</h5>
            </div>
            <div class="modal-footer" style="display:flex;justify-content: center">
                <button type="button" class="button btn btn-warning close-delete" data-dismiss="modal" aria-hidden="true"><span class="button__icon"><i class="bx bx-x"></i></span><span class="button__text2">Cancelar</span></button>
                <button id="btnDelete" class="button btn btn-danger"><span class="button__icon"><i class='bx bx-trash'></i></span> <span class="button__text2">Excluir</span></button>
            </div>
        </form>
    </div>

    <div id="create-machine" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <form id="formCreate">
            @csrf
            <div class="modal-header">
                <button type="button" class="close close-create" data-dismiss="modal" aria-hidden="true">×</button>
                <h5 id="myModalLabel"><i class="fas fa-plus-square"></i> Criar Máquina</h5>
            </div>

            <div class="modal-body">

                <input type="hidden" id="idMachine" class="idMachine" name="id" value="" />
                <div class="control-group">
                    <label for="machineNameModelo" class="control-label">Nome/Modelo</label>
                    <div class="controls">
                        <input id="machineNameModelo" type="text" name="machineNameModelo" value="" />
                    </div>
                </div>

                <div class="control-group">
                    <label for="NumberSerie" class="control-label">Nº Série</label>
                    <div class="controls">
                        <input id="NumberSerie" type="text" name="NumberSerie" value="" />
                    </div>
                </div>

                <div class="control-group">
                    <label for="nameFacturer" class="control-label">Nome do Fabricate</label>
                    <div class="controls">
                        <input id="nameFacturer" type="text" name="nameFacturer" value="" />
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

<script type="text/javascript">
    $(document).ready(function() {
        $('#Manufacturer').select2({
            tags: true
        });

        $('.open-edit-machine').on('click', function(event) {
            var modal = document.getElementById("edit-machine");
            modal.classList.remove("hide", "fade");

            var machineId = $(this).attr('data-machineId');
            var machineName = $(this).attr('data-machineName');
            var machineNumber = $(this).attr('data-machineNumber');
            var machineManufacturer = $(this).attr('data-machineManufacturer');

            $('#idMachine').val(machineId);
            $('#machineNameModelo').val(machineName);
            $('#NumberSerie').val(machineNumber);
            $('#machineManufacturer').val(machineManufacturer);


        });

        $('.open-modal-delete').on('click', function(event) {
            var modal = document.getElementById("delete-machine");
            modal.classList.remove("hide", "fade");

            var machineId = $(this).attr('data-machineId');

            $('#idMachine').val(machineId);
            $('#id-delete').text(machineId);
        });

        $('.open-modal-create').on('click', function(event) {
            var modal = document.getElementById("create-machine");
            modal.classList.remove("hide", "fade");
        });

        $('.close-btn').on('click', function(event) {
            var modal = document.getElementById("edit-machine");
            modal.classList.add("hide", "fade");
        })

        $('.close-create').on('click', function(event) {
            var modal = document.getElementById("create-machine");
            modal.classList.add("hide", "fade");
        })

        $('.close-delete').on('click', function(event) {
            var modal = document.getElementById("delete-machine");
            modal.classList.add("hide", "fade");
        })
    });
</script>

@endsection