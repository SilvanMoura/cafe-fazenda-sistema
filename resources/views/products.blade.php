@extends('layouts/app')

@section('content')

<script src="{{ asset('js/sweetalert2.all.min.js') }}"></script>

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

    .quantity-container {
        display: flex;
        align-items: center;
        background-color: #f8f8f8;
        border-radius: 8px;
        overflow: hidden;
        width: 120px;
        box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
    }

    .arrow {
        cursor: pointer;
        font-size: 20px;
        padding: 8px;
        background-color: #3498db;
        color: #fff;
        transition: background-color 0.3s ease;
    }

    .arrow:hover {
        background-color: #2980b9;
    }

    #quantity {
        flex: 1;
        text-align: center;
        font-size: 18px;
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
                                <a style="margin-right: 1%" href="produtos/visualizar/{{ $r->id }}" class="btn-nwe" title="Visualizar Produto"><i class="bx bx-show bx-xs"></i></a>
                                <a style="margin-right: 1%" href="produtos/editar/{{ $r->id }}" class="btn-nwe3" title="Editar Produto"><i class="bx bx-edit bx-xs"></i></a>
                                <a style="margin-right: 1%" href="#modal-excluir" role="button" data-toggle="modal" produto="{{ $r->id }}" class="btn-nwe4 open-modal-delete" title="Excluir Produto"><i class="bx bx-trash-alt bx-xs"></i></a>
                                <a role="button" data-toggle="modal" data-produto="{{ $r->id }}" data-estoque="{{ $r->estoque }}" data-nome="{{ $r->nome }}" class="btn-nwe5 open-edit-estoque" title="Atualizar Estoque">
                                    <i class="bx bx-plus-circle bx-xs"></i>
                                </a>
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
            <form id="formDelete">
                @csrf
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                    <h5 id="myModalLabel"><i class="fas fa-trash-alt"></i> Excluir Produto</h5>
                </div>
                <div class="modal-body">
                    <input type="hidden" id="idProduto" class="idProduto" name="id" value="" />
                    <h5 style="text-align: center">Deseja realmente excluir o produto <span id="id-delete"></span>?</h5>
                </div>
                <div class="modal-footer" style="display:flex;justify-content: center">
                    <button class="button btn btn-warning" data-dismiss="modal" aria-hidden="true">
                        <span class="button__icon"><i class="bx bx-x"></i></span><span class="button__text2">Cancelar</span></button>
                    <button id="btnDelete" class="button btn btn-danger"><span class="button__icon"><i class='bx bx-trash'></i></span> <span class="button__text2">Excluir</span></button>
                </div>
            </form>
        </div>

        <!-- Modal Estoque -->
        <div id="atualizar-estoque" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
            <form id="formEstoque">
                @csrf
                <div class="modal-header">
                    <button type="button" class="close close-btn" data-dismiss="modal" aria-hidden="true">×</button>
                    <h5 id="myModalLabel"><i class="fas fa-plus-square"></i> Atualizar Estoque</h5>
                </div>

                <div class="modal-body">

                    <input type="hidden" id="idProduto" class="idProduto" name="id" value="" />
                    <div class="control-group">
                        <span class="control-label">Nome: </span>
                        <span id="nomeProduct" class="control-label"></span>
                    </div>

                    <div class="control-group">
                        <label for="estoqueAtual" class="control-label">Estoque Atual</label>
                        <div class="controls">
                            <input id="estoqueAtual" type="text" name="estoqueAtual" value="" readonly />
                        </div>
                    </div>

                    <div class="control-group">
                        <label for="estoque" class="control-label">Adicionar Produtos<span class="required">*</span></label>
                        <div class="quantity-container">
                            <div class="arrow" id="decrease">-</div>
                            <span id="quantity" contenteditable="true">1</span>
                            <div class="arrow" id="increase">+</div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer" style="display:flex;justify-content: center">
                    <button id="btnUpdate" class="button btn btn-primary"><span class="button__icon"><i class="bx bx-sync"></i></span><span class="button__text2">Atualizar</span></button>
                    <button type="button" class="button btn btn-warning close-btn" data-dismiss="modal" aria-hidden="true"><span class="button__icon"><i class="bx bx-x"></i></span><span class="button__text2">Cancelar</span></button>
                </div>
            </form>
        </div>

    </div>
</div>
<script src="{{ asset('js/jquery.validate.js') }}"></script>
<script type="text/javascript">
    $(document).ready(function() {

        var quantityElement = document.getElementById('quantity');
        var decreaseButton = document.getElementById('decrease');
        var increaseButton = document.getElementById('increase');

        decreaseButton.addEventListener('click', function() {
            var currentQuantity = parseInt(quantityElement.textContent);
            if (currentQuantity > 1) {
                quantityElement.textContent = currentQuantity - 1;
            }
        });

        increaseButton.addEventListener('click', function() {
            var currentQuantity = parseInt(quantityElement.textContent);
            quantityElement.textContent = currentQuantity + 1;
        });


        $('.open-edit-estoque').on('click', function(event) {
            var modal = document.getElementById("atualizar-estoque");
            modal.classList.remove("hide", "fade");

            var produto = $(this).attr('data-produto');
            var estoque = $(this).attr('data-estoque');
            var nome = $(this).attr('data-nome');

            $('.idProduto').val(produto);
            $('#estoqueAtual').val(estoque);
            $('#nomeProduct').text(nome);
            $('#quantity').text('1');
        });

        $('.open-modal-delete').on('click', function(event) {
            var modal = document.getElementById("modal-excluir");
            modal.classList.remove("hide", "fade");

            var produto = $(this).attr('produto');

            $('#idProduto').val(produto);
            $('#id-delete').text(produto);
        });

        $('.close-btn').on('click', function(event) {
            var modal = document.getElementById("atualizar-estoque");
            modal.classList.add("hide", "fade");
        })

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

        $('#btnUpdate').on('click', function(e) {
            e.preventDefault();

            // Validação do formulário usando o plugin validate
            if ($("#formEstoque").valid()) {

                var quantidade = parseInt($("#quantity").text());

                var dados = $("#formEstoque").serializeArray();
                dados.push({
                    name: 'novaQuantidade',
                    value: quantidade
                });

                $(this).addClass('disabled');
                $('#progress-acessar').removeClass('hide');

                // Requisição AJAX
                $.ajax({
                    type: "PUT",
                    url: "http://localhost:8000/produtos/atualizar/estoque/" + dados[1]['value'],
                    data: dados,
                    dataType: 'json',
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    success: function(data) {
                        if (data.message === "Estoque alterado com sucesso") {
                            var modal = document.getElementById("atualizar-estoque");
                            modal.classList.add("hide", "fade");
                            Swal.fire({
                                icon: 'success',
                                title: 'Alteração Concluído',
                                text: 'Estoque alterado com sucesso!',
                            }).then(() => {
                                window.location.href = "http://localhost:8000/dashboard";
                            });
                        } else {
                            $('#error-message').text(data.message || 'Erro na alteração. Por favor, tente novamente.');
                            $('#error-message').removeClass('hide');
                        }
                    },
                    error: function(xhr, status, error) {
                        console.error("Erro na requisição AJAX:", error);
                        // Adicione manipulação de erro conforme necessário
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
                    url: "http://localhost:8000/produtos/delete/" + dados[1]['value'],
                    data: dados,
                    dataType: 'json',
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    success: function(data) {
                        if (data.message === "Produto excluido com sucesso") {
                            var modal = document.getElementById("modal-excluir");
                            modal.classList.add("hide", "fade");
                            Swal.fire({
                                icon: 'success',
                                title: 'Exclusão Concluído',
                                text: 'Produto excluido com sucesso!',
                            }).then(() => {
                                window.location.href = "http://localhost:8000/dashboard";
                            });
                        } else {
                            $('#error-message').text(data.message || 'Erro na alteração. Por favor, tente novamente.');
                            $('#error-message').removeClass('hide');
                        }
                    },
                    error: function(xhr, status, error) {
                        console.error("Erro na requisição AJAX:", error);
                        // Adicione manipulação de erro conforme necessário
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