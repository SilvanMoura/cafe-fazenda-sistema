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
                                    {{ $infoProduct->first()->id }}
                                </td>
                            </tr>
                            <tr>
                                <td style="text-align: right; width: 30%"><strong>Nome:</strong></td>
                                <td>
                                    {{ $infoProduct->first()->nome }}
                                </td>
                            </tr>
                            <tr>
                                <td style="text-align: right"><strong>Tags:</strong></td>
                                <td>
                                {{ $infoProduct->first()->tags }}
                                </td>
                            </tr>
                            <tr>
                                <td style="text-align: right"><strong>Descrição:</strong></td>
                                <td>
                                {{ $infoProduct->first()->descricao }}
                                </td>
                            </tr>
                            <tr>
                                <td style="text-align: right"><strong>Valor:</strong></td>
                                <td>R$
                                {{ $infoProduct->first()->valor }}
                                </td>
                            </tr>
                            <tr>
                                <td style="text-align: right"><strong>Estoque Atual:</strong></td>
                                <td>
                                {{ $infoProduct->first()->estoque }}
                                </td>
                            </tr>
                            <tr>
                                <td style="text-align: right"><strong>Estoque Mínimo:</strong></td>
                                <td>
                                {{ $infoProduct->first()->estoque_minimo }}
                                </td>
                            </tr>
                            <tr>
                                <td style="text-align: right"><strong>Nome da representação:</strong></td>
                                <td>
                                {{ $infoProduct->first()->nome_representacao }}
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