@extends('layouts/app')

@section('content')
<style>
    /* Hiding the checkbox, but allowing it to be focused */
    .badgebox {
        opacity: 0;
    }

    .badgebox+.badge {
        /* Move the check mark away when unchecked */
        text-indent: -999999px;
        /* Makes the badge's width stay the same checked and unchecked */
        width: 27px;
    }

    .badgebox:focus+.badge {
        /* Set something to make the badge looks focused */
        /* This really depends on the application, in my case it was: */

        /* Adding a light border */
        box-shadow: inset 0px 0px 5px;
        /* Taking the difference out of the padding */
    }

    .badgebox:checked+.badge {
        /* Move the check mark back when checked */
        text-indent: 0;
    }
</style>

<div style="height: 92vh;">
    <div class="row-fluid" style="margin: 0% 0% 0 7%; width: 91vw;">
        <div class="span12">
            <div class="widget-box">
                <div class="widget-title" style="margin: -20px 0 0">
                    <span class="icon">
                        <i class="fas fa-shopping-bag"></i>
                    </span>
                    <h5>Editar Produto</h5>
                </div>
                <div class="widget-content nopadding tab-content">

                    <form id="formProduto" class="form-horizontal">
                        @csrf
                        <div class="widget-content nopadding tab-content">
                            <div class="span6">
                                <div class="control-group">
                                    <label for="codDeBarra" class="control-label">Id<span class=""></span></label>
                                    <div class="controls">
                                        <input id="codDeBarra" disabled type="text" name="codDeBarra" value="{{ $infoProduct->first()->id }}" />
                                    </div>
                                </div>
                                <div class="control-group">
                                    <label for="descricao" class="control-label">Nome<span class="required">*</span></label>
                                    <div class="controls">
                                        <input id="descricao" type="text" name="descricao" value="{{ $infoProduct->first()->nome }}" />
                                    </div>
                                </div>

                                <div class="control-group">
                                    <label for="descricao" class="control-label">Tags<span class="required">*</span></label>
                                    <div class="controls">
                                        <input id="descricao" type="text" name="descricao" value="{{ $infoProduct->first()->tags }}" />
                                    </div>
                                </div>

                                <div class="control-group">
                                    <label for="descricao" class="control-label">Descrição<span class="required">*</span></label>
                                    <div class="controls">
                                        <input id="descricao" type="text" name="descricao" value="{{ $infoProduct->first()->descricao }}" />
                                    </div>
                                </div>

                            </div>

                            <div class="span6">

                                <div class="control-group">
                                    <label for="precoVenda" class="control-label">Valor<span class="required">*</span></label>
                                    <div class="controls">
                                        <input id="precoVenda" class="money" data-affixes-stay="true" data-thousands="" data-decimal="." type="text" name="precoVenda" value="{{ $infoProduct->first()->valor }}" />
                                    </div>
                                </div>

                                <div class="control-group">
                                    <label for="unidade" class="control-label">Representação<span class="required">*</span></label>
                                    <div class="controls">
                                        <select id="unidade" name="unidade" style="width: 15em;">
                                        @foreach($infoProduct as $product)
                                            @foreach($product->all_representation as $opcao)
                                            <option value="{{ $opcao->id }}" @if($opcao->nome == $infoProduct->first()->nome_representacao) selected @endif>{{ $opcao->nome }}</option>
                                            @endforeach
                                        @endforeach
                                        </select>
                                    </div>
                                </div>

                                <div class="control-group">
                                    <label for="estoque" class="control-label">Estoque<span class="required">*</span></label>
                                    <div class="controls">
                                        <input id="estoque" type="text" name="estoque" value="{{ $infoProduct->first()->estoque }}" />
                                    </div>
                                </div>

                                <div class="control-group">
                                    <label for="estoqueMinimo" class="control-label">Estoque Mínimo</label>
                                    <div class="controls">
                                        <input id="estoqueMinimo" type="text" name="estoqueMinimo" value="{{ $infoProduct->first()->estoque_minimo }}" />
                                    </div>
                                </div>

                            </div>
                        </div>

                        <div class="form-actions">
                            <div class="span12">
                                <div class="span6 offset3" style="display: flex;justify-content: center">
                                    <button type="submit" class="button btn btn-primary" style="max-width: 160px">
                                        <span class="button__icon"><i class="bx bx-sync"></i></span><span class="button__text2">Atualizar</span></button>
                                    <a href="/produtos" id="" class="button btn btn-mini btn-warning">
                                        <span class="button__icon"><i class="bx bx-undo"></i></span><span class="button__text2">Voltar</span></a>
                                </div>
                            </div>
                        </div>
                    </form>

                </div>

            </div>
        </div>
    </div>
</div>


<script src="{{ asset('js/jquery.validate.js') }}"></script>
<!-- <script src="{{ asset('js/maskmoney.js') }}"></script> -->
<script type="text/javascript">
    $(document).ready(function() {
        /* $(".money").maskMoney(); */
        /* $.getJSON("{{ asset('json/tabela_medidas.json') }} ", function(data) {
            for (i in data.medidas) {
                $('#unidade').append(new Option(data.medidas[i].descricao, data.medidas[i].sigla));
                $("#unidade option[value=" + '?php echo $result->unidade; ?>' + "]").prop("selected", true);
            }
        }); */
        $('#formProduto').validate({
            rules: {
                descricao: {
                    required: true
                },
                unidade: {
                    required: true
                },
                /* precoCompra: {
                    required: true
                },
                precoVenda: {
                    required: true
                }, */
                estoque: {
                    required: true
                }
            },
            messages: {
                descricao: {
                    required: 'Campo Requerido.'
                },
                unidade: {
                    required: 'Campo Requerido.'
                },
                /* precoCompra: {
                    required: 'Campo Requerido.'
                },
                precoVenda: {
                    required: 'Campo Requerido.'
                }, */
                estoque: {
                    required: 'Campo Requerido.'
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