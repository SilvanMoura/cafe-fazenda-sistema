@extends('layouts/app')

@section('content')

<script src="{{ asset('js/jquery.mask.min.js') }}"></script>
<script src="{{ asset('js/sweetalert2.all.min.js') }}"></script>
<script src="{{ asset('js/funcoes.js') }}"></script>
<style>
    .custom-panel {
        margin: auto;
        border: 1px solid red;
        padding: 10px;
        width: 84vw;
        margin-bottom: 10px;
    }

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

    .control-group.error .help-inline {
        display: flex;
    }

    .form-horizontal .control-group {
        border-bottom: 1px solid #ffffff;
    }

    .form-horizontal .controls {
        margin-left: 20px;
        padding-bottom: 8px 0;
    }

    .form-horizontal .control-label {
        text-align: left;
        padding-top: 15px;
    }

    .nopadding {
        padding: 0 20px !important;
        margin-right: 20px;
    }

    .widget-title h5 {
        padding-bottom: 30px;
        text-align-last: left;
        font-size: 2em;
        font-weight: 500;
    }

    @media (max-width: 480px) {
        form {
            display: contents !important;
        }

        .form-horizontal .control-label {
            margin-bottom: -6px;
        }

        .btn-xs {
            position: initial !important;
        }

        #elementOrcamento {
            display: flex;
        }

        #elementServico {
            display: none;
        }

    }
</style>
<div style="height: 92vh;">
    <div class="row-fluid" style="margin: 0% 0% 0 7%; width: 91vw;">
        <div class="span12">
            <div class="widget-box">
                <div class="widget-title" style="margin: -10px 0 0">
                    <span class="icon">
                        <i class="fas fa-user"></i>
                    </span>
                    <h5>Editar OS/Orçamento</h5>
                </div>

                <div class="alert alert-danger hide" id="error-message"></div>

                <div class="container mt-5">
                    <form id="formOs">
                        @csrf
                        <!-- Primeira Linha -->
                        <div class="form-row" style="display:flex; justify-content: space-between;">
                            <input type="hidden" id="os" name="os" value="{{ $os->id }}" />
                            <div class="form-group col-md-4" style="display: flex; flex-direction: row; align-items: center;">
                                <label for="operacao" style="margin-right: 10px;">Operação:</label>
                                <select type="text" class="form-control" id="operacao" name="operacao" style="margin-right: 20px">
                                    <option value="1" id="orcamento">Orçamento</option>
                                    <option value="2" id="servico">Serviço</option>
                                </select>
                            </div>

                            <div class="form-group col-md-4" id="elementOrcamento" style="display: flex; flex-direction: row; align-items: center;">
                                <label for="status_os_orcamento" style="margin-right: 10px;">Status Os:</label>
                                <select type="text" class="form-control" id="status_os_orcamento" name="status_os_orcamento" style="margin-right: 20px">
                                    @foreach($statusOs as $s)
                                    @if($s->operacao_os_id == 1)
                                    <option value="{{ $s->id }}">{{ $s->nome }}</option>
                                    @endif
                                    @endforeach
                                </select>
                            </div>

                            <div class="form-group col-md-4" id="elementServico" style="display: flex; flex-direction: row; align-items: center;">
                                <label for="status_os_servico" style="margin-right: 10px;">Status Os:</label>
                                <select type="text" class="form-control" id="status_os_servico" name="status_os_servico" style="margin-right: 20px">
                                    @foreach($statusOs as $s)
                                    @if($s->operacao_os_id == 2)
                                    <option value="{{ $s->id }}">{{ $s->nome }}</option>
                                    @endif
                                    @endforeach
                                </select>
                            </div>

                            <div class="form-group col-md-4" style="display: flex; flex-direction: row; align-items: center;">
                                <label for="data" style="margin-right: 10px">Data:</label>
                                <input type="text" class="form-control" id="data" name="data" placeholder="Data" value="{{ $data }}" style="margin-right: 20px">
                            </div>
                            <div class="form-group col-md-4" style="display: flex; flex-direction: row; align-items: center;">
                                <label for="hora" style="margin-right: 10px">Hora:</label>
                                <input type="text" class="form-control" id="hora" name="hora" placeholder="Hora" value="{{ $hora }}">
                            </div>
                        </div>

                        <!-- Segunda Linha -->
                        <div class="form-row" style="display:flex; justify-content: space-between; margin-bottom:10px;">
                            <div class="form-group col-md-6" style="display: flex; flex-direction: row; align-items: center;">
                                <label for="maquina" style="margin-right: 20px">Máquina:</label>
                                <div class="controls">
                                    <select id="maquina" name="maquina" class="form-control" style="width: 35vw; margin-right: 20px">
                                        <option>Selecione</option>
                                        @foreach($machines as $f)
                                        <option @if ($f->id == $machineById->id) selected @endif value="{{ $f->id }}">{{ $f->nomemodelo }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="form-group col-md-6" style="display: flex; flex-direction: row; align-items: center;">
                                <label for="cliente" style="margin-right: 20px">Cliente:</label>
                                <div class="controls">
                                    <select id="cliente" name="cliente" class="form-control" style="width: 35vw;">
                                        <option>Selecione</option>
                                        @foreach($clients as $f)
                                        <option @if ($f->nome == $clientById->nome) selected @endif value="{{ $f->id }}">{{ $f->nome }}</option>
                                        @endforeach
                                    </select>

                                </div>
                            </div>
                        </div>

                        <!-- Terceira Linha -->
                        <div class="form-row" style="display:flex; justify-content: space-between;">
                            <div class="form-group col-md-8" style="display: flex; flex-direction: row; align-items: center;">
                                <label for="endereco" style="margin-right: 20px">Endereço:</label>
                                <input type="text" class="form-control" readonly id="endereco" name="endereco" style="width:50vw; background-color: #EEE; margin-right: 20px" placeholder="Endereço" style="width: 60vw" value="{{$clientById->endereco}}">
                            </div>
                            <div class="form-group col-md-4" style="display: flex; flex-direction: row; align-items: center;">
                                <label for="complemento" style="margin-right: 20px">Complemento:</label>
                                <input type="text" class="form-control" id="complemento" name="complemento" style="background-color: #EEE; width:15vw;" readonly placeholder="Complemento" value="{{$clientById->complemento}}">
                            </div>
                        </div>

                        <!-- Quarta Linha -->
                        <div class="form-row" style="display:flex; justify-content: space-between;">
                            <div class="form-group col-md-4" style="display: flex; flex-direction: row; align-items: center;">
                                <label for="bairro" style="margin-right: 10px">Bairro:</label>
                                <input type="text" class="form-control" style="background-color: #EEE" readonly id="bairro" name="bairro" style="width: 40vw; background-color:EEE; margin-right: 20px" placeholder="Bairro" value="{{$clientById->bairro}}">
                            </div>
                            <div class="form-group col-md-4" style="display: flex; flex-direction: row; align-items: center;">
                                <label for="cpfcnpj" style="margin-right: 10px">CPF/CNPJ:</label>
                                <input type="text" class="form-control" style="width: 20vw; background-color: #EEE; margin-right: 20px" readonly id="cpfcnpj" name="cpfcnpj" placeholder="CPF/CNPJ" value="{{ $clientById->cpf ? $clientById->cpf : $clientById->cnpj }}">
                            </div>
                            <div class="form-group col-md-4" style="display: flex; flex-direction: row; align-items: center;">
                                <label for="telefone" style="margin-right: 10px">Telefone:</label>
                                <input type="text" class="form-control" style="background-color: #EEE; width: 20vw;" readonly id="telefone" name="telefone" placeholder="Telefone" value="{{$clientById->telefone}}">
                            </div>
                        </div>

                        <!-- Quinta Linha -->
                        <div class="form-row" style="display: flex; justify-content: space-between;">
                            <div class="form-group col-md-6" style="display: flex; flex-direction: row; align-items: center;">
                                <label for="bebidas" style="margin-right: 10px;">Nº de Bebidas Extraídas:</label>
                                <input type="text" class="form-control" id="bebidas" name="bebidas" style="width: 35vw;" placeholder="Nº de Bebidas Extraídas" value="{{ $os->bebidas_extraidas }}">
                            </div>
                            <div class="form-group col-md-6" style="display: flex; flex-direction: row; align-items: center;">
                                <label for="checklist" style="margin-right: 10px;">Checklist:</label>
                                <input type="text" class="form-control" id="checklist" name="checklist" style="width: 30vw; background-color: #EEE;" readonly placeholder="Checklist" value="{{ $os->checklist }}">
                            </div>
                        </div>

                        <div id="panel-radio" class="container mt-4 custom-panel" style=" margin:auto; border: 1px solid #DDDDDD; padding: 10px; width: 84vw; margin-bottom: 10px;">

                            <div class="row" style="display: flex; justify-content: space-around;">
                                <div class="col-md-4">
                                    <div class="form-group" style="display: flex;">
                                        <label for="cabo" style="margin-right: 10px; margin-top: 4px;" class="control-label col-md-7">Cabo de alimentação:</label>
                                        <div class="form-check form-check-inline" style="display: flex;">
                                            <input @if($os->cabo == 's') checked @endif type="radio" id="cabo-sim" name="cabo" style="margin-left: 20px;" value="s" class="form-check-input">
                                            <label class="form-check-label" for="cabo-sim" style="margin-left: 5px; padding-top: 5px">Sim</label>
                                        </div>
                                        <div class="form-check form-check-inline" style="display: flex;">
                                            <input @if($os->cabo == 'n') checked @endif type="radio" id="cabo-nao" name="cabo" style="margin-left: 20px;" value="n" class="form-check-input">
                                            <label class="form-check-label" for="cabo-nao" style="margin-left: 5px; padding-top: 5px">Não</label>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-md-4">
                                    <div class="form-group" style="display: flex;">
                                        <label for="bomba" style="margin-right: 10px; margin-top: 4px;" class="control-label col-md-7">Bomba submersa:</label>
                                        <div class="form-check form-check-inline" style="display: flex;">
                                            <input @if($os->bomba == 's') checked @endif type="radio" id="bomba-sim" name="bomba" style="margin-left: 20px;" value="s" class="form-check-input">
                                            <label class="form-check-label" for="bomba-sim" style="margin-left: 5px; padding-top: 5px">Sim</label>
                                        </div>
                                        <div class="form-check form-check-inline" style="display: flex;">
                                            <input @if($os->bomba == 'n') checked @endif type="radio" id="bomba-nao" style="margin-left: 20px;" name="bomba" value="n" class="form-check-input">
                                            <label class="form-check-label" style="margin-left: 5px; padding-top: 5px;" for="bomba-nao">Não</label>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-md-4">
                                    <div class="form-group" style="display: flex;">
                                        <label for="chave" style="margin-right: 10px; margin-top: 4px;" class="control-label col-md-7">Chave Máquina:</label>
                                        <div class="form-check form-check-inline" style="display: flex;">
                                            <input @if($os->chave == 's') checked @endif type="radio" id="chave-sim" name="chave" style="margin-left: 20px;" value="s" class="form-check-input">
                                            <label class="form-check-label" for="chave-sim" style="margin-left: 5px; padding-top: 5px">Sim</label>
                                        </div>
                                        <div class="form-check form-check-inline" style="display: flex;">
                                            <input @if($os->chave == 'n') checked @endif type="radio" id="chave-nao" name="chave" style="margin-left: 20px;" value="n" class="form-check-input">
                                            <label class="form-check-label" for="chave-nao" style="margin-left: 5px; padding-top: 5px">Não</label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div id="panel-radio" class="container mt-4 custom-panel" style=" margin:auto; border: 1px solid #DDDDDD; padding: 10px; width: 84vw; margin-bottom: 10px;">

                            <div class="row" style="display: flex; justify-content: space-around;">
                                <div class="col-md-4">
                                    <div class="form-group" style="display: flex;">
                                        <label for="locada" style="margin-right: 10px; margin-top: 4px;" class="control-label col-md-7">Locada:</label>
                                        <div class="form-check form-check-inline" style="display: flex;">
                                            <input @if($os->locada == 's') checked @endif type="radio" id="locada-sim" name="locada" style="margin-left: 20px;" value="s" class="form-check-input">
                                            <label class="form-check-label" for="locada-sim" style="margin-left: 5px; padding-top: 5px">Sim</label>
                                        </div>
                                        <div class="form-check form-check-inline" style="display: flex;">
                                            <input @if($os->locada == 'n') checked @endif type="radio" id="locada-nao" name="locada" style="margin-left: 20px;" value="n" class="form-check-input">
                                            <label class="form-check-label" for="locada-nao" style="margin-left: 5px; padding-top: 5px">Não</label>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-md-4">
                                    <div class="form-group" style="display: flex;">
                                        <label for="adaptador" style="margin-right: 10px; margin-top: 4px;" class="control-label col-md-7">Adaptador:</label>
                                        <div class="form-check form-check-inline" style="display: flex;">
                                            <input @if($os->adaptador == 's') checked @endif type="radio" id="adaptador-sim" name="adaptador" style="margin-left: 20px;" value="s" class="form-check-input">
                                            <label class="form-check-label" for="adaptador-sim" style="margin-left: 5px; padding-top: 5px">Sim</label>
                                        </div>
                                        <div class="form-check form-check-inline" style="display: flex;">
                                            <input @if($os->adaptador == 'n') checked @endif type="radio" id="adaptador-nao" style="margin-left: 20px;" name="adaptador" value="n" class="form-check-input">
                                            <label class="form-check-label" style="margin-left: 5px; padding-top: 5px;" for="adaptador-nao">Não</label>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-md-4">
                                    <div class="form-group" style="display: flex;">
                                        <label for="mangueira" style="margin-right: 10px; margin-top: 4px;" class="control-label col-md-7">Mangueira:</label>
                                        <div class="form-check form-check-inline" style="display: flex;">
                                            <input @if($os->mangueira == 's') checked @endif type="radio" id="mangueira-sim" name="mangueira" style="margin-left: 20px;" value="s" class="form-check-input">
                                            <label class="form-check-label" for="mangueira-sim" style="margin-left: 5px; padding-top: 5px">Sim</label>
                                        </div>
                                        <div class="form-check form-check-inline" style="display: flex;">
                                            <input @if($os->mangueira == 'n') checked @endif type="radio" id="mangueira-nao" name="mangueira" style="margin-left: 20px;" value="n" class="form-check-input">
                                            <label class="form-check-label" for="mangueira-nao" style="margin-left: 5px; padding-top: 5px">Não</label>
                                        </div>
                                    </div>
                                </div>
                            </div>

                        </div>

                        <div id="panel-radio" class="container mt-4 custom-panel" style=" margin:auto; border: 1px solid #DDDDDD; padding: 10px; width: 84vw; margin-bottom: 10px;">

                            <div class="row" style="display: flex; justify-content: space-around;">
                                <div class="col-md-4">
                                    <div class="form-group" style="display: flex;">
                                        <label for="validador" style="margin-right: 10px; margin-top: 4px;" class="control-label col-md-7">Validador:</label>
                                        <div class="form-check form-check-inline" style="display: flex;">
                                            <input @if($os->validador == 's') checked @endif type="radio" id="validador-sim" name="validador" style="margin-left: 20px;" value="s" class="form-check-input">
                                            <label class="form-check-label" for="validador-sim" style="margin-left: 5px; padding-top: 5px">Sim</label>
                                        </div>
                                        <div class="form-check form-check-inline" style="display: flex;">
                                            <input @if($os->validador == 'n') checked @endif type="radio" id="validador-nao" name="validador" style="margin-left: 20px;" value="n" class="form-check-input">
                                            <label class="form-check-label" for="validador-nao" style="margin-left: 5px; padding-top: 5px">Não</label>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-md-4">
                                    <div class="form-group" style="display: flex;">
                                        <label for="cofre" style="margin-right: 10px; margin-top: 4px;" class="control-label col-md-7">Cofre:</label>
                                        <div class="form-check form-check-inline" style="display: flex;">
                                            <input @if($os->cofre == 's') checked @endif type="radio" id="cofre-sim" name="cofre" style="margin-left: 20px;" value="s" class="form-check-input">
                                            <label class="form-check-label" for="cofre-sim" style="margin-left: 5px; padding-top: 5px">Sim</label>
                                        </div>
                                        <div class="form-check form-check-inline" style="display: flex;">
                                            <input @if($os->cofre == 'n') checked @endif type="radio" id="cofre-nao" style="margin-left: 20px;" name="cofre" value="n" class="form-check-input">
                                            <label class="form-check-label" style="margin-left: 5px; padding-top: 5px;" for="cofre-nao">Não</label>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-md-4">
                                    <div class="form-group" style="display: flex;">
                                        <label for="chaveCofre" style="margin-right: 10px; margin-top: 4px;" class="control-label col-md-7">Chave do Cofre:</label>
                                        <div class="form-check form-check-inline" style="display: flex;">
                                            <input @if($os->chaveCofre == 's') checked @endif type="radio" id="chaveCofre-sim" name="chaveCofre" style="margin-left: 20px;" value="s" class="form-check-input">
                                            <label class="form-check-label" for="chaveCofre-sim" style="margin-left: 5px; padding-top: 5px">Sim</label>
                                        </div>
                                        <div class="form-check form-check-inline" style="display: flex;">
                                            <input @if($os->cofre_chave == 'n') checked @endif type="radio" id="chaveCofre-nao" name="chaveCofre" style="margin-left: 20px;" value="n" class="form-check-input">
                                            <label class="form-check-label" for="chaveCofre-nao" style="margin-left: 5px; padding-top: 5px">Não</label>
                                        </div>
                                    </div>
                                </div>
                            </div>

                        </div>

                        <div class="panel-body panel panel-default" style="padding: 20px 0; display: flex; justify-content: center; border: 1px solid #DDDDDD">
                            <div class="row">
                                <div class="col-md-12" style="display: flex; justify-content:center; flex-flow: row wrap;">
                                    <div class="form-group" style="padding: 15px; margin-right:20px; display: flex; border: 1px solid #DDDDDD">
                                        <div class="col-md-4">
                                            <div class="form-group" style="display: flex;">
                                                <label for="evs" style="margin-right: 10px; margin-top: 4px;" class="control-label col-md-7">Ev's:</label>
                                                <div class="form-check form-check-inline" style="display: flex;">
                                                    <input @if($os->evs == 's') checked @endif type="radio" id="evs-sim" name="evs" style="margin-left: 20px;" value="s" class="form-check-input">
                                                    <label class="form-check-label" for="evs-sim" style="margin-left: 5px; padding-top: 5px">Sim</label>
                                                </div>
                                                <div class="form-check form-check-inline" style="display: flex;">
                                                    <input @if($os->evs == 'n') checked @endif type="radio" id="evs-nao" name="evs" style="margin-left: 20px;" value="n" class="form-check-input">
                                                    <label class="form-check-label" for="evs-nao" style="margin-left: 5px; padding-top: 5px; margin-right:10px">Não</label>
                                                </div>
                                            </div>
                                        </div>
                                        <div id="evs-container" class="radio-inline hide fade">
                                            <input type="number" class="form-control" id="evs_qtd" name="evs_qtd" min="1" placeholder="Quant." value="{{ $os->evs_qtd }}">
                                            <br>
                                            <input type="text" class="form-control" id="evs_obs" name="evs_obs" placeholder="Obs" value="{{ $os->evs_obs }}">
                                        </div>
                                    </div>

                                    <div class="form-group" style="padding: 15px; border: 1px solid #DDDDDD">
                                        <div style="display: flex; flex-direction: column;">

                                            <div style="display: flex; flex-direction: row;">
                                                <div class="col-md-4">
                                                    <div class="form-group" style="display: flex;">
                                                        <label for="reservatorioAgua" style="margin-right: 10px; margin-top: 4px;" class="control-label col-md-7">Reservatório D'água:</label>
                                                        <div class="form-check form-check-inline" style="display: flex;">
                                                            <input @if($os->reservatorio == 's') checked @endif type="radio" id="reservatorioAgua-sim" name="reservatorioAgua" style="margin-left: 20px;" value="s" class="form-check-input">
                                                            <label class="form-check-label" for="reservatorioAgua-sim" style="margin-left: 5px; padding-top: 5px">Sim</label>
                                                        </div>
                                                        <div class="form-check form-check-inline" style="display: flex;">
                                                            <input @if($os->reservatorio == 'n') checked @endif type="radio" id="reservatorioAgua-nao" name="reservatorioAgua" style="margin-left: 20px;" value="n" class="form-check-input">
                                                            <label class="form-check-label" for="reservatorioAgua-nao" style="margin-left: 5px; padding-top: 5px; margin-right:10px">Não</label>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div id="reservatorioAgua-container" class="radio-inline hide fade">
                                                    <input type="text" class="form-control" id="reservatorioAgua_obs" name="reservatorioAgua_obs" placeholder="Obs" value="{{ $os->reservatorio_obs }}">
                                                </div>
                                            </div>



                                            <div>
                                                <div class="col-md-4">
                                                    <div class="form-group" style="display: flex;">
                                                        <label for="tampaReservatorioAgua" style="margin-right: 10px; margin-top: 4px;" class="control-label col-md-7">Tampa do reservatório D'água:</label>
                                                        <div class="form-check form-check-inline" style="display: flex;">
                                                            <input @if($os->tampa == 's') checked @endif type="radio" id="tampaReservatorioAgua-sim" name="tampaReservatorioAgua" style="margin-left: 20px;" value="s" class="form-check-input">
                                                            <label class="form-check-label" for="tampaReservatorioAgua-sim" style="margin-left: 5px; padding-top: 5px">Sim</label>
                                                        </div>
                                                        <div class="form-check form-check-inline" style="display: flex;">
                                                            <input @if($os->tampa == 'n') checked @endif type="radio" id="tampaReservatorioAgua-nao" name="tampaReservatorioAgua" style="margin-left: 20px;" value="n" class="form-check-input">
                                                            <label class="form-check-label" for="tampaReservatorioAgua-nao" style="margin-left: 5px; padding-top: 5px; margin-right:10px">Não</label>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                        </div>

                                    </div>


                                    <div class="form-group" style="padding: 15px; width: 66vw; margin-top: 20px; border: 1px solid #DDDDDD">
                                        <div style="display: flex; flex-direction: column;">

                                            <div style="display: flex; justify-content:center; flex-direction: row;">
                                                <div class="col-md-4">
                                                    <div class="form-group" style="display: flex;">
                                                        <label for="compartimentos" style="margin-right: 10px; margin-top: 4px;" class="control-label col-md-7">Compartimentos:</label>
                                                        <div class="form-check form-check-inline" style="display: flex;">
                                                            <input @if($os->compartimento == 's') checked @endif type="radio" id="compartimentos-sim" name="compartimentos" style="margin-left: 20px;" value="s" class="form-check-input">
                                                            <label class="form-check-label" for="compartimentos-sim" style="margin-left: 5px; padding-top: 5px">Sim</label>
                                                        </div>
                                                        <div class="form-check form-check-inline" style="display: flex;">
                                                            <input @if($os->compartimento == 'n') checked @endif type="radio" id="compartimentos-nao" name="compartimentos" style="margin-left: 20px;" value="n" class="form-check-input">
                                                            <label class="form-check-label" for="compartimentos-nao" style="margin-left: 5px; padding-top: 5px; margin-right:10px">Não</label>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div id="compartimentos-container" class="radio-inline hide fade">
                                                    <input type="number" class="form-control" id="compartimentos_qtd" name="compartimentos_qtd" placeholder="Quant." value="{{ $os->tampa_compartimento_qtd }}">
                                                </div>
                                            </div>

                                            <div style="display: flex; justify-content:center;">
                                                <div class="col-md-4">
                                                    <div class="form-group" style="display: flex;">
                                                        <label for="tampaCompartimentos" style="margin-right: 10px; margin-top: 4px;" class="control-label col-md-7">Tampa dos compartimentos:</label>
                                                        <div class="form-check form-check-inline" style="display: flex;">
                                                            <input @if($os->tampa_compartimento == 's') checked @endif type="radio" id="tampaCompartimentos-sim" name="tampaCompartimentos" style="margin-left: 20px;" value="s" class="form-check-input">
                                                            <label class="form-check-label" for="tampaCompartimentos-sim" style="margin-left: 5px; padding-top: 5px">Sim</label>
                                                        </div>
                                                        <div class="form-check form-check-inline" style="display: flex;">
                                                            <input @if($os->tampa_compartimento == 'n') checked @endif type="radio" id="tampaCompartimentos-nao" name="tampaCompartimentos" style="margin-left: 20px;" value="n" class="form-check-input">
                                                            <label class="form-check-label" for="tampaCompartimentos-nao" style="margin-left: 5px; padding-top: 5px; margin-right:10px">Não</label>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div id="tampaCompartimentos-container" class="radio-inline hide fade">
                                                    <input type="number" class="form-control" id="tampaCompartimentos_qtd" name="tampaCompartimentos_qtd" min="1" placeholder="Quant." value="{{ $os->tampa_compartimento_qtd }}">
                                                    <br>
                                                    <input type="text" class="form-control" id="tampaCompartimentos_obs" name="tampaCompartimentos_obs" placeholder="Obs" value="{{ $os->tampa_compartimento_obs }}">
                                                </div>
                                            </div>

                                        </div>

                                    </div>

                                    <div class="form-group" style="padding: 15px; width: 66vw; margin-top: 20px; border: 1px solid #DDDDDD">
                                        <div style="display: flex; flex-direction: column;">

                                            <div style="display: flex; justify-content:center; flex-direction: row;">
                                                <div class="col-md-4">
                                                    <div class="form-group" style="display: flex;">
                                                        <label for="bandeja" style="margin-right: 10px; margin-top: 4px;" class="control-label col-md-7">Bandeja:</label>
                                                        <div class="form-check form-check-inline" style="display: flex;">
                                                            <input @if($os->bandeja == 's') checked @endif type="radio" id="bandeja-sim" name="bandeja" style="margin-left: 20px;" value="s" class="form-check-input">
                                                            <label class="form-check-label" for="bandeja-sim" style="margin-left: 5px; padding-top: 5px">Sim</label>
                                                        </div>
                                                        <div class="form-check form-check-inline" style="display: flex;">
                                                            <input @if($os->bandeja == 'n') checked @endif type="radio" id="bandeja-nao" name="bandeja" style="margin-left: 20px;" value="n" class="form-check-input">
                                                            <label class="form-check-label" for="bandeja-nao" style="margin-left: 5px; padding-top: 5px; margin-right:10px">Não</label>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                            <div style="display: flex; justify-content:center;">
                                                <div class="col-md-4">
                                                    <div class="form-group" style="display: flex;">
                                                        <label for="produtos" style="margin-right: 10px; margin-top: 4px;" class="control-label col-md-7">Produtos:</label>
                                                        <div class="form-check form-check-inline" style="display: flex;">
                                                            <input @if($os->produtos == 's') checked @endif type="radio" id="produtos-sim" name="produtos" style="margin-left: 20px;" value="s" class="form-check-input">
                                                            <label class="form-check-label" for="produtos-sim" style="margin-left: 5px; padding-top: 5px">Sim</label>
                                                        </div>
                                                        <div class="form-check form-check-inline" style="display: flex;">
                                                            <input @if($os->produtos == 'n') checked @endif type="radio" id="produtos-nao" name="produtos" style="margin-left: 20px;" value="n" class="form-check-input">
                                                            <label class="form-check-label" for="produtos-nao" style="margin-left: 5px; padding-top: 5px; margin-right:10px">Não</label>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div id="produtos-container" class="radio-inline fade hide" style="display: flex; justify-content:center;">
                                                <input type="text" class="form-control" id="produtos_quais" style="width:50vw;" name="produtos_quais" placeholder="Quais" value="{{ $os->produtos_quais }}">
                                            </div>

                                        </div>

                                    </div>

                                </div>

                                <div class="form-group" style="margin-left: 6vw; width:70vw; display: flex; justify-content: center; margin-top:10px">
                                    <label for="obs" class="control-label col-md-2" style="margin-right: 10px;">Observação:</label>
                                    <div class="col-md-10">
                                        <textarea name="obs" style="width:67vw" id="obs" class="form-control" rows="8">{{ $os->obs }}</textarea>
                                    </div>
                                </div>

                                <div class="form-group" style="margin-left: 4vw; width:74vw; display: flex; justify-content: center; margin-top:10px">
                                    <label for="descricao_cliente" class="control-label col-md-2" style="width: 75px; margin-right: 10px;">Defeito descrito pelo cliente:</label>
                                    <div class="col-md-10" style="width:100%">
                                        <textarea name="descricao_cliente" style="width:98%" id="descricao_cliente" class="form-control" rows="8">{{ $os->descricao_cliente }}</textarea>
                                    </div>
                                </div>



                            </div>
                        </div>

                        <div style="margin-top: 50px;">
                            <table id="tabela" class="table table-bordered">
                                <thead>
                                    <tr>
                                        <th>Produto/Serviço</th>
                                        <th>Rep.</th>
                                        <th>Quantidade</th>
                                        <th>Val. Unit.</th>
                                        <th>Total</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @if($productsByIdOs->count() >= 1)
                                    @foreach($productsByIdOs as $index => $product)
                                    <tr id="linha_{{$index+1}}">
                                        <!-- Conteúdo da primeira linha -->
                                        <!-- <input type="hidden" id="productOS_{{$index+1}}" name="productOS_{{$index+1}}" value="{{ $product->id }}" /> -->
                                        <td id="produto_{{$index+1}}">
                                            <select id="select_{{$index+1}}" name="select_{{$index+1}}" onchange="getServiceById(this)" class="form-control produto" style="width: 30vw;">
                                                <option>Selecione</option>
                                                @foreach($productsOs as $f)
                                                <option value="{{ $f->id }}" @if($f->id == $product->produto_id) selected="true" @endif >{{ $f->nome }}</option>
                                                @endforeach
                                            </select>
                                        </td>
                                        <td id="rep_{{$index+1}}" name="rep_{{$index+1}}" value="{{ $product->representacao_id }}" style="width: 10vw;">{{ $product->representacao_nome }}</td>
                                        <td style="width: 10vw;">
                                            <input type="number" class="form-control" id="qtd_{{$index+1}}" name="qtd_{{$index+1}}" min="1" onchange="changeTotalById(this)" placeholder="Quant." value="{{ $product->quantidade }}">
                                        </td>
                                        <td style="width: 10vw;">
                                            <input type="number" class="form-control" id="valUnit_{{$index+1}}" name="valUnit_{{$index+1}}" min="1" onchange="changeTotalById(this)" placeholder="Val. Unit." value="{{ $product->valor_unitario }}">
                                        </td>
                                        <td id="total_{{$index+1}}" name="total_{{$index+1}}" class="tdLast" style="width: 10vw;">R$ {{ $product->quantidade * $product->valor_unitario }}</td>
                                        <td id="delete_{{$index+1}}"><a href="#modal-excluir" role="button" data-toggle="modal" cliente="" style="margin-right: 1%" class="btn-nwe4" title="Excluir Cliente"><i class="bx bx-trash-alt bx-xs"></i></a></td>
                                    </tr>
                                    @endforeach
                                    @else
                                    <tr id="linha_1">
                                        <td id="produto_1">
                                            <select id="select_1" name="select_1" onchange="getServiceById(this)" class="form-control produto" style="width: 30vw;">
                                                <option>Selecione</option>
                                                @foreach($productsOs as $f)
                                                <option value="{{ $f->id }}">{{ $f->nome }}</option>
                                                @endforeach
                                            </select>
                                        </td>
                                        <td id="rep_1" name="rep_1" value="" style="width: 10vw;"></td>
                                        <td style="width: 10vw;">
                                            <input type="number" class="form-control" id="qtd_1" name="qtd_1" min="1" onchange="changeTotalById(this)" placeholder="Quant." value="">
                                        </td>
                                        <td style="width: 10vw;">
                                            <input type="number" class="form-control" id="valUnit_1" name="valUnit_1" min="1" onchange="changeTotalById(this)" placeholder="Val. Unit." value="">
                                        </td>
                                        <td id="total_1" name="total_1" class="tdLast" style="width: 10vw;"></td>
                                        <td id="delete_1"><a href="#modal-excluir" role="button" data-toggle="modal" cliente="" style="margin-right: 1%" class="btn-nwe4" title="Excluir Cliente"><i class="bx bx-trash-alt bx-xs"></i></a></td>
                                    </tr>
                                    @endif

                                </tbody>

                            </table>
                            <div style="display: flex; justify-content: center; align-items: center; margin-bottom: 30px">
                                <button id="btnAdd" type="submit" class="button btn btn-mini btn-success">
                                    <span class="button__icon">
                                        <i class='bx bx-plus'></i>
                                    </span>
                                    <span class="button__text2">
                                        Adicionar Novo Produto/Serviço
                                    </span>
                                </button>
                            </div>
                        </div>

                        <div class="form-group" style=" width:85vw; display: flex; margin-top:10px">
                            <label for="avaliacao" class="control-label col-md-2" style="margin-right: 10px;">Avaliação Técnica:</label>
                            <div class="col-md-6">
                                <textarea name="avaliacao" style="width:66vw" id="avaliacao" class="form-control" rows="5">{{ $os->avaliacao }}</textarea>
                            </div>
                        </div>

                        <div class="form-row" style="display:flex; justify-content: space-between;">
                            <div class="form-group col-md-4" style="display: flex; flex-direction: row; align-items: center;">
                                <label for="dataAvaliacao" style="margin-right: 10px; margin-bottom: 10px">Data de avaliação:</label>
                                <input type="text" class="form-control" id="dataAvaliacao" name="dataAvaliacao" placeholder="Data de avaliação" value="{{ $dataAvaliacao }}" style="margin-right: 20px">
                            </div>
                        </div>

                        <div class="form-actions">
                            <div class="span12">
                                <div class="span6 offset3" style="display:flex;justify-content: center">
                                    <!-- <button id="btnCreate" type="submit" class="button btn btn-mini btn-success"><span class="button__icon"><i class='bx bx-save'></i></span> <span class="button__text2">Salvar</span></a></button> -->
                                    <button id="btnUpdate" type="submit" class="button btn btn-primary" style="max-width: 160px">
                                        <span class="button__icon"><i class="bx bx-sync"></i></span><span class="button__text2">Atualizar</span></button>
                                    <a title="Voltar" class="button btn btn-warning" href="/clientes"><span class="button__icon"><i class="bx bx-undo"></i></span> <span class="button__text2">Voltar</span></a>
                                </div>
                            </div>
                        </div>


                    </form>
                </div>

            </div>
        </div>

    </div>
    <script src="{{ asset('js/jquery.validate.js') }}"></script>
    <script src="{{ asset('js/sweetalert2.all.min.js') }}"></script>
    <script type="text/javascript">
        $(document).ready(function() {

            var contadorLinhas = $("#tabela tbody tr").length;

            if ($('#evs-sim').prop('checked')) {
                var modal = document.getElementById("evs-container");
                modal.classList.remove("hide", "fade");
            } else {
                $("#evs_qtd").val('');
                $("#evs_obs").val('');
            }
            $('#evs-sim').on('change', function() {
                var modal = document.getElementById("evs-container");
                modal.classList.remove("hide", "fade");
            });

            if ($('#reservatorioAgua-sim').prop('checked')) {
                var modal = document.getElementById("reservatorioAgua-container");
                modal.classList.remove("hide", "fade");
            } else {
                $("#reservatorioAgua_obs").val('');
            }
            $('#reservatorioAgua-sim').on('change', function() {
                var modal = document.getElementById("reservatorioAgua-container");
                modal.classList.remove("hide", "fade");
            });

            if ($('#compartimentos-sim').prop('checked')) {
                var modal = document.getElementById("compartimentos-container");
                modal.classList.remove("hide", "fade");
            } else {
                $("#compartimentos_qtd").val('');
            }
            $('#compartimentos-sim').on('change', function() {
                var modal = document.getElementById("compartimentos-container");
                modal.classList.remove("hide", "fade");
            });

            if ($('#tampaCompartimentos-sim').prop('checked')) {
                var modal = document.getElementById("tampaCompartimentos-container");
                modal.classList.remove("hide", "fade");
            } else {
                $("#tampaCompartimentos_qtd").val('');
                $("#tampaCompartimentos_obs").val('');
            }
            $('#tampaCompartimentos-sim').on('change', function() {
                var modal = document.getElementById("tampaCompartimentos-container");
                modal.classList.remove("hide", "fade");
            });

            if ($('#produtos-sim').prop('checked')) {
                var modal = document.getElementById("produtos-container");
                modal.classList.remove("hide", "fade");
            } else {
                $("#produtos_quais").val('');
            }
            $('#produtos-sim').on('change', function() {
                var modal = document.getElementById("produtos-container");
                modal.classList.remove("hide", "fade");
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
                ajustarVisibilidade();
            });

            // Chama a função inicialmente para garantir que o estado inicial seja correto
            ajustarVisibilidade();


            $('#maquina').select2({
                tags: true
            });

            $('#cliente').select2({
                tags: true
            });

            $('#operacao').select2({
                tags: true
            });

            $('#status_os_orcamento').select2({
                tags: true
            });

            $('#status_os_servico').select2({
                tags: true
            });

            for (var i = 1; i <= contadorLinhas; i++) {
                $('#select_' + i).select2({
                    tags: true
                });

                if ($('delete_' + i) != 'delete_1') {
                    var modal = document.getElementById("delete_1");
                    modal.classList.add("hide", "fade");
                }
            }

            $('#cliente').on('select2:select', function() {
                fazerRequisicao();
            });

            $('#cliente').on('keydown', function(event) {
                if (event.key === 'Enter') {
                    fazerRequisicao();
                }
            });

            function fazerRequisicao() {

                var id = $("#cliente").val();

                // Requisição AJAX
                $.ajax({
                    type: "POST",
                    url: "http://localhost:8000/os/encontrar/" + id,
                    data: {
                        'id': id
                    },
                    dataType: 'json',
                    success: function(data) {
                        if (data.message === "Cliente encontrado com sucesso") {
                            $('#endereco').val(data.cliente[0].endereco);
                            $('#complemento').val(data.cliente[0].complemento);
                            $('#telefone').val(data.cliente[0].telefone);
                            $('#bairro').val(data.cliente[0].bairro);

                            data.cliente[0].cpf == "" ? $('#cpfcnpj').val(data.cliente[0].cnpj) : $('#cpfcnpj').val(data.cliente[0].cpf);
                            data.cliente[0].telefone != "" ? $('#telefone').val(data.cliente[0].telefone) : $('#telefone').val(data.cliente[0].celular);

                        } else {
                            Swal.fire({
                                icon: 'error',
                                title: 'Erro na procura',
                                text: data.message,
                            });
                        }
                    },
                    error: function(xhr, status, error) {
                        Swal.fire({
                            icon: 'error',
                            title: 'Erro na procura',
                            text: xhr.responseJSON.message,
                        });
                    }
                });
            }

            $('#evs-sim').on('change', function() {
                var modal = document.getElementById("evs-container");
                modal.classList.remove("hide", "fade");
            });

            $('#evs-nao').on('change', function() {
                var modal = document.getElementById("evs-container");
                modal.classList.add("hide", "fade");
            });

            $('#reservatorioAgua-sim').on('change', function() {
                var modal = document.getElementById("reservatorioAgua-container");
                modal.classList.remove("hide", "fade");
            });

            $('#reservatorioAgua-nao').on('change', function() {
                var modal = document.getElementById("reservatorioAgua-container");
                modal.classList.add("hide", "fade");
            });

            $('#compartimentos-sim').on('change', function() {
                var modal = document.getElementById("compartimentos-container");
                modal.classList.remove("hide", "fade");
            });

            $('#compartimentos-nao').on('change', function() {
                var modal = document.getElementById("compartimentos-container");
                modal.classList.add("hide", "fade");
            });

            $('#tampaCompartimentos-sim').on('change', function() {
                var modal = document.getElementById("tampaCompartimentos-container");
                modal.classList.remove("hide", "fade");
            });

            $('#tampaCompartimentos-nao').on('change', function() {
                var modal = document.getElementById("tampaCompartimentos-container");
                modal.classList.add("hide", "fade");
            });

            $('#produtos-sim').on('change', function() {
                var modal = document.getElementById("produtos-container");
                modal.classList.remove("hide", "fade");
            });

            $('#produtos-nao').on('change', function() {
                var modal = document.getElementById("produtos-container");
                modal.classList.add("hide", "fade");
            });

            $('#btnCreate').on('click', function(e) {
                e.preventDefault();

                // Validação do formulário usando o plugin validate
                if ($("#formOs").valid()) {


                    var selectedMaquina = $('#maquina').val();
                    var selectedCliente = $('#cliente').val();

                    var dados = $("#formOs").serializeArray();

                    dados.push({
                        name: 'maquina',
                        value: selectedMaquina
                    });
                    dados.push({
                        name: 'cliente',
                        value: selectedCliente
                    });

                    // Requisição AJAX
                    $.ajax({
                        type: "POST",
                        url: "http://localhost:8000/os/cadastrar/",
                        data: dados,
                        dataType: 'json',
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        },
                        success: function(data) {
                            if (data.message === "Os registrada com sucesso") {
                                Swal.fire({
                                    icon: 'success',
                                    title: 'Cadastro Concluído',
                                    text: 'Os registrada com sucesso!',
                                }).then(() => {
                                    window.location.href = "http://localhost:8000/dashboard";
                                });
                            } else {
                                Swal.fire({
                                    icon: 'error',
                                    title: 'Erro na criação',
                                    text: data.message,
                                });
                            }
                        },
                        error: function(xhr, status, error) {
                            Swal.fire({
                                icon: 'error',
                                title: 'Erro na criação',
                                text: xhr.responseJSON.message,
                            });
                        }
                    });
                }
            });

            var contadorLinhas = $("#tabela tbody tr").length;
            $("#btnAdd").on("click", function(e) {
                // Clonar a linha original
                e.preventDefault();

                $('#select_1').prop('disabled', true).select2('destroy');

                // Clonar a linha original
                var cloneRow = $("#linha_1").clone();

                // Incrementar o contador de linhas
                contadorLinhas++;
                cloneRow.attr('id', 'linha_' + contadorLinhas);
                // Atualizar os IDs e classes dentro do clone
                cloneRow.find('#produto_1').attr('id', 'produto_' + contadorLinhas).attr('name', 'produto_' + contadorLinhas);
                cloneRow.find('#select_1').attr('id', 'select_' + contadorLinhas).attr('name', 'select_' + contadorLinhas).val('Selecione');
                cloneRow.find('#rep_1').attr('id', 'rep_' + contadorLinhas).attr('name', 'rep_' + contadorLinhas).text('');
                cloneRow.find('#qtd_1').attr('id', 'qtd_' + contadorLinhas).attr('name', 'qtd_' + contadorLinhas).val('');
                cloneRow.find('#valUnit_1').attr('id', 'valUnit_' + contadorLinhas).attr('name', 'valUnit_' + contadorLinhas).val('');
                cloneRow.find('.tdLast').attr('id', 'total_' + contadorLinhas).attr('name', 'total_' + contadorLinhas).text('');

                cloneRow.find('td:last').after('<td><a href="#modal-excluir" role="button" data-toggle="modal" cliente="" style="margin-right: 1%" class="btn-nwe4" title="Excluir Cliente"><i class="bx bx-trash-alt bx-xs"></i></a></td>');
                // Remover as classes "hide" e "fade" da linha clonada
                cloneRow.removeClass('hide fade');

                // Adicionar o clone após a última linha na tabela
                $("#tabela tbody tr:last").after(cloneRow);

                // Adicionar evento de clique ao botão de exclusão do clone
                cloneRow.find('.btn-nwe4').on('click', function(e) {
                    e.preventDefault();
                    $(this).closest('tr').remove();
                });

                $('#select_' + contadorLinhas).prop('disabled', false).select2({
                    tags: true
                });

                $('#select_1').prop('disabled', false).select2({
                    tags: true
                });
            });

            $("#linha_2 .btn-nwe4").on('click', function() {
                $(this).closest('tr').remove();
            });

            let dataAtual = new Date();
            let dataFormatada = `${String(dataAtual.getDate()).padStart(2, '0')}/${String(dataAtual.getMonth() + 1).padStart(2, '0')}/${dataAtual.getFullYear()}`;

            if ($("#dataAvaliacao").val() == '') {
                $("#dataAvaliacao").val(dataFormatada);
            }


        })

        function changeTotalById(selectElement) {
            var linhaID = $(selectElement).closest('tr').attr('id');
            var partes = linhaID.split("_");

            // Pegue a última parte e converta para número inteiro
            var numeroDaLinha = parseInt(partes[partes.length - 1]);

            var quantidade = parseFloat($('#qtd_' + numeroDaLinha).val()) || 0;
            var valorUnitario = parseFloat($('#valUnit_' + numeroDaLinha).val()) || 0;

            parseFloat($('#total_' + numeroDaLinha).text('R$ ' + quantidade * valorUnitario));
        }

        function getServiceById(selectElement) {
            var linhaID = $(selectElement).closest('tr').attr('id');
            var partes = linhaID.split("_");

            // Pegue a última parte e converta para número inteiro
            var numeroDaLinha = parseInt(partes[partes.length - 1]);
            var id = $('#select_' + numeroDaLinha).val();

            $.ajax({
                type: "POST",
                url: "http://localhost:8000/os/produtos/",
                data: {
                    'id': id
                },
                dataType: 'json',
                success: function(data) {
                    if (data.message === "Produto encontrado com sucesso") {
                        $('#rep_' + numeroDaLinha).text(data.product[0].nome_representacao);
                        $('#qtd_' + numeroDaLinha).val(1);
                        $('#valUnit_' + numeroDaLinha).val(data.product[0].valor);

                        var quantidade = parseFloat($('#qtd_' + numeroDaLinha).val()) || 0;
                        var valorUnitario = parseFloat($('#valUnit_' + numeroDaLinha).val()) || 0;
                        $('#total_' + numeroDaLinha).text('R$' + quantidade * valorUnitario);
                    } else {
                        Swal.fire({
                            icon: 'error',
                            title: 'Erro na procura',
                            text: data.message,
                        });
                    }
                },
                error: function(xhr, status, error) {
                    Swal.fire({
                        icon: 'error',
                        title: 'Erro na procura',
                        text: xhr.responseJSON.message,
                    });
                }
            });
        }

        $('#btnUpdate').on('click', function(e) {
            e.preventDefault();

            // Validação do formulário usando o plugin validate
            if ($("#formOs").valid()) {

                var dados = $("#formOs").serializeArray();

                // Requisição AJAX
                $.ajax({
                    type: "PUT",
                    url: "http://localhost:8000/os/atualizar/" + dados[1]['value'],
                    data: dados,
                    dataType: 'json',
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    success: function(data) {
                        if (data.message === "Os alterada com sucesso") {
                            Swal.fire({
                                icon: 'success',
                                title: 'Alteração Concluída',
                                text: 'Os alterada com sucesso!',
                            }).then(() => {
                                window.location.href = "http://localhost:8000/dashboard";
                            });
                        } else {
                            Swal.fire({
                                icon: 'error',
                                title: 'Erro na alteração',
                                text: data.message,
                            });
                        }
                    },
                    error: function(xhr, status, error) {
                        Swal.fire({
                            icon: 'error',
                            title: 'Erro na alteração',
                            text: xhr.responseJSON.message,
                        });
                    }
                });
            }
        })
    </script>


    @endsection