@extends('layouts/app')

@section('content')
<style>
    #elementOrcamento {
        display: flex;
    }

    #elementServico {
        display: none;
    }
</style>
<div style="height: 90vh; width: 99vw;">
    <div class="row-fluid" style="margin: 1% 1% 0 7%;">
        <div class="span4">
            <div class="widget-box">
                <div class="widget-title">
                    <span class="icon">
                        <i class="fas fa-diagnoses"></i>
                    </span>
                    <h5>Relatórios Rápidos</h5>
                </div>
                <div class="widget-content">
                    <ul style="flex-direction: row;" class="site-stats">
                        <li><a target="_blank" href="/relatorios/osRapid"><i class="fas fa-diagnoses"></i> <small>Todas as OS - pdf</small></a></li>
                    </ul>
                </div>
            </div>
        </div>
        <div class="span7">
            <div class="widget-box">
                <div class="widget-title">
                    <span class="icon">
                        <i class="fas fa-diagnoses"></i>
                    </span>
                    <h5>Relatórios Customizáveis</h5>
                </div>
                <div class="widget-content">
                    <div class="span12 well">
                        <form target="_blank" action="/relatorios/osCustom" method="get">
                            <div class="span12 well">
                                <div class="span6">
                                    <label for="">Data de:</label>
                                    <input type="date" name="dataInicial" class="span12" />
                                </div>
                                <div class="span6">
                                    <label for="">até:</label>
                                    <input type="date" name="dataFinal" class="span12" />
                                </div>
                            </div>
                            <div class="span12 well" style="margin-left: 0">
                                <div class="span6">
                                    <label for="operacao" style="margin-right: 10px;">Operação:</label>
                                    <select type="text" class="form-control span12" id="operacao" name="operacao" style="margin-right: 20px">
                                        <option value="1" id="orcamento">Orçamento</option>
                                        <option value="2" id="servico">Serviço</option>
                                    </select>
                                </div>

                                <!-- <div class="span6" id="elementOrcamento">
                                    <label for="status_os_orcamento" style="margin-right: 10px;">Status Os:</label>
                                    <select type="text" class="form-control" id="status_os_orcamento" name="status_os_orcamento" style="margin-right: 20px">
                                        @foreach($statusOs as $s)
                                        @if($s->operacao_os_id == 1)
                                        <option value="{{ $s->id }}">{{ $s->nome }}</option>
                                        @endif
                                        @endforeach
                                    </select>
                                </div> -->

                                <div class="span6" id="elementOrcamento">
                                <div>
                                    <label for="status_os_orcamento">Status Os:</label>
                                        <select type="text" class="form-control span12" id="status_os_orcamento" name="status_os_orcamento" style="width:150px">
                                            @foreach($statusOs as $s)
                                            @if($s->operacao_os_id == 1)
                                            <option value="{{ $s->id }}">{{ $s->nome }}</option>
                                            @endif
                                            @endforeach
                                        </select>
                                    </div>
                                </div>

                                <div class="span6" id="elementServico">
                                    <label for="status_os_servico">Status Os:</label>
                                    <select type="text" class="form-control span12" id="status_os_servico" name="status_os_servico">
                                        @foreach($statusOs as $s)
                                        @if($s->operacao_os_id == 2)
                                        <option value="{{ $s->id }}">{{ $s->nome }}</option>
                                        @endif
                                        @endforeach
                                    </select>
                                </div>
                                <!-- <div class="span6">
                                    <label for="">Tipo de impressão:</label>
                                    <select name="format" class="span12">
                                        <option value="">PDF</option>
                                        <option value="xls">XLS</option>
                                    </select>
                                </div> -->
                            </div>
                            <div class="span12" style="display:flex;justify-content: center">
                                <button type="reset" class="button btn btn-warning">
                                    <span class="button__icon"><i class="bx bx-brush-alt"></i></span>
                                    <span class="button__text">Limpar</span>
                                </button>
                                <button class="button btn btn-inverse">
                                    <span class="button__icon"><i class="bx bx-printer"></i></span>
                                    <span class="button__text">Imprimir</span>
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<link rel="stylesheet" href="{{ asset('js/jquery-ui/css/smoothness/jquery-ui-1.9.2.custom.css') }}" />
<script type="text/javascript" src="{{ asset('js/jquery-ui/js/jquery-ui-1.9.2.custom.js') }}"></script>
<script src="{{ asset('js/maskmoney.js') }}"></script>
<script type="text/javascript">
    $(document).ready(function() {
        $(".money").maskMoney();
        $("#cliente").autocomplete({
            source: "index.php/os/autoCompleteCliente",
            minLength: 2,
            select: function(event, ui) {
                $("#clienteHide").val(ui.item.id);
            }
        });
        $("#tecnico").autocomplete({
            source: "index.php/os/autoCompleteUsuario",
            minLength: 2,
            select: function(event, ui) {
                $("#responsavelHide").val(ui.item.id);
            }
        });

        function ajustarVisibilidade() {
            var operacaoSelecionada = $('#operacao').val();

            if (operacaoSelecionada == '1') {
                // Se a opção for Orçamento, mostra elementOrcamento e esconde elementServico
                $('#elementOrcamento').show();
                $('#elementServico').hide();
            } else {
                // Se a opção for Serviço, mostra elementServico e esconde elementOrcamento
                $('#elementOrcamento').hide();
                $('#elementServico').show();
            }
        }

        // Adiciona um listener de mudança ao <select>
        $('#operacao').on('change', function() {
            // Chama a função ao selecionar uma opção diferente
            console.log("troca")
            ajustarVisibilidade();
        });

        // Chama a função inicialmente para garantir que o estado inicial seja correto
        ajustarVisibilidade();
    });
</script>
@endsection