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
                <i class="fas fa-user"></i>
            </span>
            <h5>Clientes</h5>
        </div>
        <div style="display: flex; justify-content: space-between">
            <a href="clientes/adicionar" class="button btn btn-mini btn-success" style="max-width: 165px">
                <span class="button__icon"><i class='bx bx-plus-circle'></i></span><span class="button__text2">
                    Cliente / Fornecedor
                </span>
            </a>
            <label id="search">
                Pesquisar
                <input type="search" id="searchInput" class="" placeholder="Nome ou CPF/CNPJ" aria-controls="tabela">
            </label>

        </div>

        <div class="widget-box">
            <h5 style="padding: 3px 0"></h5>
            <div class="widget-content nopadding tab-content scrollable-container">
                <table id="tabela" class="table table-bordered ">
                    <thead>
                        <tr>
                            <th>Cod.</th>
                            <th>Nome</th>
                            <th>CPF/CNPJ</th>
                            <th>Telefone</th>
                            <th>Email</th>
                            <th>Ações</th>
                        </tr>
                    </thead>
                    <tbody>

                        @if($infoClients->count() > 0)
                        @foreach ($infoClients as $r)
                        <tr>
                            <td>{{ $r->id }}</td>
                            <td style="width:35%;"><a href="{{ 'clientes/visualizar/'.$r->id }}">{{ $r->nome }}</a></td>
                            @if($r->cpf != '')
                            <td>{{ $r->cpf }}</td>
                            @else
                            <td>{{ $r->cnpj }}</td>
                            @endif
                            @if($r->celular != '')
                            <td>{{ $r->celular }}</td>
                            @else
                            <td>{{ $r->telefone }}</td>
                            @endif
                            <td style="width:20%;">{{ $r->email }}</td>
                            <td>
                                <a href="{{ 'clientes/visualizar/'. $r->id }}" style="margin-right: 1%" class="btn-nwe" title="Ver mais detalhes"><i class="bx bx-show bx-xs"></i></a>
                                <a href="{{ 'clientes/editar/'. $r->id }}" style="margin-right: 1%" class="btn-nwe3" title="Editar Cliente"><i class="bx bx-edit bx-xs"></i></a>
                                <a href="#modal-excluir" role="button" data-toggle="modal" cliente="{{ $r->id }}" style="margin-right: 1%" class="btn-nwe4" title="Excluir Cliente"><i class="bx bx-trash-alt bx-xs"></i></a>
                            </td>
                        </tr>
                        @endforeach
                        @else
                        <tr>
                            <td colspan="6">Nenhum Cliente Cadastrado</td>
                        </tr>
                        @endif


                    </tbody>
                </table>
            </div>
        </div>
        <!-- <php echo $this->pagination->create_links(); ?> -->


        <!-- Modal -->
        <div id="modal-excluir" class="modal hide" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
            <form action="clientes/excluir" method="post">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                    <h5 id="myModalLabel">Excluir Cliente</h5>
                </div>
                <div class="modal-body">
                    <input type="hidden" id="idCliente" name="id" value="" />
                    <h5 style="text-align: center">Deseja realmente excluir este cliente e os dados associados a ele (OS, Vendas, Receitas)?</h5>
                </div>
                <div class="modal-footer" style="display:flex;justify-content: center">
                    <button class="button btn btn-warning" data-dismiss="modal" aria-hidden="true"><span class="button__icon"><i class="bx bx-x"></i></span><span class="button__text2">Cancelar</span></button>
                    <button class="button btn btn-danger"><span class="button__icon"><i class='bx bx-trash'></i></span> <span class="button__text2">Excluir</span></button>
                </div>
            </form>
        </div>
    </div>
</div>
<script type="text/javascript">
    $(document).ready(function() {
        $(document).on('click', 'a', function(event) {
            var cliente = $(this).attr('cliente');
            $('#idCliente').val(cliente);
        });

        $('#searchInput').on('input', function() {
            performSearch();
        });

        $('#searchInput').on('keydown', function(e) {
            if (e.key === 'Enter') {
                performSearch();
            }
        });

        function performSearch() {
            var searchTerm = $('#searchInput').val();

            // Selecione o elemento `tbody` dentro do widget
            var tableBody = $('.widget-content.nopadding.tab-content.scrollable-container #tabela tbody');

            // Faça a requisição AJAX
            $.ajax({
                type: 'POST',
                url: '/search/clientes',
                data: {
                    search: searchTerm
                },
                success: function(data) {
                    // Limpe a tabela antes de inserir novos dados
                    tableBody.empty();

                    // Declare a variável `item` fora do loop
                    var item;

                    // Crie linhas para cada item da lista de resultados
                    $.each(data, function(index, item) {
                        var row = '<tr>';
                        row += '<td>' + item.id + '</td>';
                        row += '<td style="width:35%;"><a href="clientes/visualizar/' + item.id + '">' + item.nome + '</a></td>';

                        if (item.cpf != '') {
                            row += '<td>' + item.cpf + '</td>';
                        } else {
                            row += '<td>' + item.cnpj + '</td>';
                        }

                        if (item.celular != '') {
                            row += '<td>' + item.celular + '</td>';
                        } else {
                            row += '<td>' + item.telefone + '</td>';
                        }

                        row += '<td style="width:20%;">' + item.email + '</td>';
                        row += '<td>';
                        row += '<a href="clientes/visualizar/' + item.id + '" style="margin-right: 1%" class="btn-nwe" title="Ver mais detalhes"><i class="bx bx-show bx-xs"></i></a>';
                        row += '<a href="clientes/editar/' + item.id + '" style="margin-right: 1%" class="btn-nwe3" title="Editar Cliente"><i class="bx bx-edit bx-xs"></i></a>';
                        row += '<a href="#modal-excluir" role="button" data-toggle="modal" cliente="' + item.id + '" style="margin-right: 1%" class="btn-nwe4" title="Excluir Cliente"><i class="bx bx-trash-alt bx-xs"></i></a>';
                        row += '</td>';
                        row += '</tr>';

                        // Adicione a linha à tabela
                        tableBody.append(row);
                    });
                },
                error: function(erro) {
                    console.error('Erro:', erro);
                }
            });



        }
    });
</script>


@endsection