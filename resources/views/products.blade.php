@extends('layouts/app')

@section('content')

<style>
    select {
        width: 70px;
    }
    .scrollable-container {
        height: 400px;
        /* Altura fixa da div */
        overflow-y: auto;
        /* Adiciona rolagem vertical quando necessário */
    }
</style>
<div style="height: 90vh; width: 99vw;">
    <div class="new122" style="margin: 1% 1% 0 7%;">
        <div class="widget-title" style="margin: -20px 0 0">
            <span class="icon">
                <i class="fas fa-shopping-bag"></i>
            </span>
            <h5>Produtos</h5>
        </div>
        <div class="flexxn" style="display: flex;">
            <a href="produtos/adicionar" class="button btn btn-mini btn-success" style="max-width: 160px">
                <span class="button__icon">
                    <i class='bx bx-plus-circle'></i>
                </span>
                <span class="button__text2"> Produtos</span>
            </a>
        </div>

        <div class="widget-box">
            <h5 style="padding: 3px 0"></h5>
            <div class="widget-content nopadding tab-content scrollable-container">
                <table id="tabela" class="table table-bordered ">
                    <thead>
                        <tr>
                            <th>Cod.</th>
                            <th>Nome</th>
                            <th>Estoque</th>
                            <th>Preço</th>
                            <th>Ações</th>
                        </tr>
                    </thead>
                    <tbody>
                        @if($infoProducts->count() > 0)
                        @foreach($infoProducts as $r)
                        <tr>
                            <td>{{ $r->id }}</td>
                            <td style="max-width: 20vw">{{ $r->nome }}</td>
                            <td>{{ $r->estoque }}</td>
                            <td>R$ {{ $r->valor }}</td>

                            <td>
                                <a style="margin-right: 1%" href="produtos/visualizar/' . $r->idProdutos . '" class="btn-nwe" title="Visualizar Produto"><i class="bx bx-show bx-xs"></i></a>
                                <a style="margin-right: 1%" href="produtos/editar/' . $r->idProdutos . '" class="btn-nwe3" title="Editar Produto"><i class="bx bx-edit bx-xs"></i></a>
                                <a style="margin-right: 1%" href="#modal-excluir" role="button" data-toggle="modal" produto="' . $r->idProdutos . '" class="btn-nwe4" title="Excluir Produto"><i class="bx bx-trash-alt bx-xs"></i></a>
                                <a href="#atualizar-estoque" role="button" data-toggle="modal" produto="' . $r->idProdutos . '" estoque="' . $r->estoque . '" class="btn-nwe5" title="Atualizar Estoque"><i class="bx bx-plus-circle bx-xs"></i></a>
                            </td>
                        </tr>
                        @endforeach
                        @else
                        <tr>
                            <td colspan="6">Nenhum Produto Cadastrado</td>
                        </tr>
                        @endif
                    </tbody>
                </table>
            </div>
        </div>
        <!-- $this->pagination->create_links(); -->

        <!-- Modal -->
        <div id="modal-excluir" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
            <form action="produtos/excluir" method="post">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                    <h5 id="myModalLabel"><i class="fas fa-trash-alt"></i> Excluir Produto</h5>
                </div>
                <div class="modal-body">
                    <input type="hidden" id="idProduto" class="idProduto" name="id" value="" />
                    <h5 style="text-align: center">Deseja realmente excluir este produto?</h5>
                </div>
                <div class="modal-footer" style="display:flex;justify-content: center">
                    <button class="button btn btn-warning" data-dismiss="modal" aria-hidden="true">
                        <span class="button__icon"><i class="bx bx-x"></i></span><span class="button__text2">Cancelar</span></button>
                    <button class="button btn btn-danger"><span class="button__icon"><i class='bx bx-trash'></i></span> <span class="button__text2">Excluir</span></button>
                </div>
            </form>
        </div>

        <!-- Modal Estoque -->
        <div id="atualizar-estoque" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
            <form action="produtos/atualizar_estoque" method="post" id="formEstoque">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                    <h5 id="myModalLabel"><i class="fas fa-plus-square"></i> Atualizar Estoque</h5>
                </div>
                <div class="modal-body">
                    <div class="control-group">
                        <label for="estoqueAtual" class="control-label">Estoque Atual</label>
                        <div class="controls">
                            <input id="estoqueAtual" type="text" name="estoqueAtual" value="" readonly />
                        </div>
                    </div>

                    <div class="control-group">
                        <label for="estoque" class="control-label">Adicionar Produtos<span class="required">*</span></label>
                        <div class="controls">
                            <input type="hidden" id="idProduto" class="idProduto" name="id" value="" />
                            <input id="estoque" type="text" name="estoque" value="" />
                        </div>
                    </div>
                </div>
                <div class="modal-footer" style="display:flex;justify-content: center">
                    <button class="button btn btn-primary"><span class="button__icon"><i class="bx bx-sync"></i></span><span class="button__text2">Atualizar</span></button>
                    <button class="button btn btn-warning" data-dismiss="modal" aria-hidden="true"><span class="button__icon"><i class="bx bx-x"></i></span><span class="button__text2">Cancelar</span></button>
                </div>
            </form>
        </div>

    </div>
</div>
<script src="{{ asset('js/jquery.validate.js') }}"></script>
<script type="text/javascript">
    $(document).ready(function() {
        $(document).on('click', 'a', function(event) {
            var produto = $(this).attr('produto');
            var estoque = $(this).attr('estoque');
            $('.idProduto').val(produto);
            $('#estoqueAtual').val(estoque);
        });

        $('#formEstoque').validate({
            rules: {
                estoque: {
                    required: true,
                    number: true
                }
            },
            messages: {
                estoque: {
                    required: 'Campo Requerido.',
                    number: 'Informe um número válido.'
                }
            },
            errorClass: "help-inline",
            errorElement: "span",
            highlight: function(element, errorClass, validClass) {
                $(element).parents('.control-group').addClass('error');
            },
            unhighlight: function(element, errorClass, validClass) {
                $(element).parents('.control-group').removeClass('error');
                $(element).parents('.control-group').addClass('success');
            }
        });
    });
</script>

@endsection