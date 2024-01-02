@extends('layouts/app')

@section('content')

<div style="height: 90vh; width: 99vw;">
    <div class="accordion" id="collapse-group" style="margin: 1% 1% 0 7%;">
        <div class="accordion-group widget-box">
            <div class="accordion-heading">
                <div class="widget-title" style="margin: -20px 0 0">
                    <a data-parent="#collapse-group" href="#collapseGOne" data-toggle="collapse">
                        <span class="icon"><i class="fas fa-shopping-bag"></i></span>
                        <h5>Dados do Produto</h5>
                    </a>
                </div>
            </div>
            <div class="collapse in accordion-body">
                <div class="widget-content">
                    <table class="table table-bordered">
                        <tbody>
                            <tr>
                                <td style="text-align: right; width: 30%"><strong>Cód.:</strong></td>
                                <td>
                                    codDeBarra
                                </td>
                            </tr>
                            <tr>
                                <td style="text-align: right; width: 30%"><strong>Descrição:</strong></td>
                                <td>
                                    descricao
                                </td>
                            </tr>
                            <tr>
                                <td style="text-align: right"><strong>Unidade:</strong></td>
                                <td>
                                    unidade
                                </td>
                            </tr>
                            <tr>
                                <td style="text-align: right"><strong>Preço de Compra:</strong></td>
                                <td>R$
                                    precoCompra
                                </td>
                            </tr>
                            <tr>
                                <td style="text-align: right"><strong>Preço de Venda:</strong></td>
                                <td>R$
                                    precoVenda
                                </td>
                            </tr>
                            <tr>
                                <td style="text-align: right"><strong>Estoque:</strong></td>
                                <td>
                                    estoque
                                </td>
                            </tr>
                            <tr>
                                <td style="text-align: right"><strong>Estoque Mínimo:</strong></td>
                                <td>
                                    estoqueMinimo
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
                <div class="form-actions">
                    <div class="span12">
                        <div class="span6 offset3" style="display:flex;justify-content: center">
                            <a title="Voltar" class="button btn btn-warning" href="/produtos">
                                <span class="button__icon">
                                    <i class="bx bx-undo"></i>
                                </span>
                                <span class="button__text2">
                                    Voltar
                                </span>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection