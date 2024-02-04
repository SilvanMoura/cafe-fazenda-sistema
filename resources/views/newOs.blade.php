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
    }
</style>
<div style="height: 92vh;">
    <div class="row-fluid" style="margin: 0% 0% 0 7%; width: 91vw;">
        <div class="span12">
            <div class="widget-box">
                <div class="widget-title" style="margin: -20px 0 0">
                    <span class="icon">
                        <i class="fas fa-user"></i>
                    </span>
                    <h5>Cadastro de Cliente</h5>
                </div>

                <div class="alert alert-danger hide" id="error-message"></div>

                <div class="container mt-5">
                    <form>
                        <!-- Primeira Linha -->
                        <div class="form-row" style="display:flex; justify-content: space-between;">
                            <div class="form-group col-md-4" style="display: flex; flex-direction: row; align-items: center;">
                                <label for="operacao" style="margin-right: 10px;">Operação:</label>
                                <input type="text" style="background-color: #EEE" class="form-control" id="operacao" style="margin-right: 20px" readonly value="Orçamento" placeholder="Operação">
                            </div>
                            <div class="form-group col-md-4" style="display: flex; flex-direction: row; align-items: center;">
                                <label for="data" style="margin-right: 10px">Data:</label>
                                <input type="text" class="form-control" id="data" placeholder="Data" style="margin-right: 20px">
                            </div>
                            <div class="form-group col-md-4" style="display: flex; flex-direction: row; align-items: center;">
                                <label for="hora" style="margin-right: 10px">Hora:</label>
                                <input type="text" class="form-control" id="hora" placeholder="Hora">
                            </div>
                        </div>

                        <!-- Segunda Linha -->
                        <div class="form-row" style="display:flex; justify-content: space-between; margin-bottom:10px;">
                            <div class="form-group col-md-6" style="display: flex; flex-direction: row; align-items: center;">
                                <label for="maquina" style="margin-right: 20px">Máquina:</label>
                                <div class="controls">
                                    <select id="maquina" class="form-control" style="width: 35vw; margin-right: 20px">
                                        <option>Selecione</option>
                                        @foreach($machines as $f)
                                        <option value="{{ $f->fabricante_id }}">{{ $f->nomemodelo }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="form-group col-md-6" style="display: flex; flex-direction: row; align-items: center;">
                                <label for="cliente" style="margin-right: 20px">Cliente:</label>
                                <div class="controls">
                                    <select id="cliente" class="form-control" style="width: 35vw;">
                                        <option>Selecione</option>
                                        @foreach($clients as $f)
                                        <option value="{{ $f->id }}">{{ $f->nome }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>

                        <!-- Terceira Linha -->
                        <div class="form-row" style="display:flex; justify-content: space-between;">
                            <div class="form-group col-md-8" style="display: flex; flex-direction: row; align-items: center;">
                                <label for="endereco" style="margin-right: 20px">Endereço:</label>
                                <input type="text" class="form-control" readonly id="endereco" style="width:50vw; background-color: #EEE; margin-right: 20px" placeholder="Endereço" style="width: 60vw">
                            </div>
                            <div class="form-group col-md-4" style="display: flex; flex-direction: row; align-items: center;">
                                <label for="complemento" style="margin-right: 20px">Complemento:</label>
                                <input type="text" class="form-control" id="complemento" style="background-color: #EEE; width:15vw;" readonly placeholder="Complemento">
                            </div>
                        </div>

                        <!-- Quarta Linha -->
                        <div class="form-row" style="display:flex; justify-content: space-between;">
                            <div class="form-group col-md-4" style="display: flex; flex-direction: row; align-items: center;">
                                <label for="bairro" style="margin-right: 10px">Bairro:</label>
                                <input type="text" class="form-control" style="background-color: #EEE" readonly id="bairro" style="width: 20vw; background-color:EEE; margin-right: 20px" placeholder="Bairro" style="width: 40vw">
                            </div>
                            <div class="form-group col-md-4" style="display: flex; flex-direction: row; align-items: center;">
                                <label for="cpfcnpj" style="margin-right: 10px">CPF/CNPJ:</label>
                                <input type="text" class="form-control" style="background-color: #EEE" readonly id="cpfcnpj" placeholder="CPF" style="width: 20vw; background-color:EEE; margin-right:20px">
                            </div>
                            <div class="form-group col-md-4" style="display: flex; flex-direction: row; align-items: center;">
                                <label for="telefone" style="margin-right: 10px">Telefone:</label>
                                <input type="text" class="form-control" style="background-color: #EEE; width: 20vw;" readonly id="telefone" placeholder="Telefone">
                            </div>
                        </div>

                        <!-- Quinta Linha -->
                        <div class="form-row" style="display: flex; justify-content: space-between;">
                            <div class="form-group col-md-6" style="display: flex; flex-direction: row; align-items: center;">
                                <label for="bebidas" style="margin-right: 10px;">Nº de Bebidas Extraídas:</label>
                                <input type="text" class="form-control" id="bebidas" style="width: 35vw;" placeholder="Nº de Bebidas Extraídas">
                            </div>
                            <div class="form-group col-md-6" style="display: flex; flex-direction: row; align-items: center;">
                                <label for="checklist" style="margin-right: 10px;">Checklist:</label>
                                <input type="text" class="form-control" id="checklist" style="width: 30vw; background-color: #EEE;" readonly placeholder="Checklist">
                            </div>
                        </div>

                        <div id="panel-radio" class="container mt-4 custom-panel" style=" margin:auto; border: 1px solid #DDDDDD; padding: 10px; width: 84vw; margin-bottom: 10px;">

                            <div class="row" style="display: flex; justify-content: space-around;">
                                <div class="col-md-4">
                                    <div class="form-group" style="display: flex;">
                                        <label for="cabo" style="margin-right: 10px; margin-top: 4px;" class="control-label col-md-7">Cabo de alimentação:</label>
                                        <div class="form-check form-check-inline" style="display: flex;">
                                            <input type="radio" id="cabo-sim" name="cabo" style="margin-left: 20px;" value="s" class="form-check-input">
                                            <label class="form-check-label" for="cabo-sim" style="margin-left: 5px; padding-top: 5px">Sim</label>
                                        </div>
                                        <div class="form-check form-check-inline" style="display: flex;">
                                            <input type="radio" id="cabo-nao" name="cabo" style="margin-left: 20px;" value="n" checked="" class="form-check-input">
                                            <label class="form-check-label" for="cabo-nao" style="margin-left: 5px; padding-top: 5px">Não</label>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-md-4">
                                    <div class="form-group" style="display: flex;">
                                        <label for="bomba" style="margin-right: 10px; margin-top: 4px;" class="control-label col-md-7">Bomba submersa:</label>
                                        <div class="form-check form-check-inline" style="display: flex;">
                                            <input type="radio" id="bomba-sim" name="bomba" style="margin-left: 20px;" value="s" class="form-check-input">
                                            <label class="form-check-label" for="bomba-sim" style="margin-left: 5px; padding-top: 5px">Sim</label>
                                        </div>
                                        <div class="form-check form-check-inline" style="display: flex;">
                                            <input type="radio" id="bomba-nao" style="margin-left: 20px;" name="bomba" value="n" checked="" class="form-check-input">
                                            <label class="form-check-label" style="margin-left: 5px; padding-top: 5px;" for="bomba-nao">Não</label>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-md-4">
                                    <div class="form-group" style="display: flex;">
                                        <label for="chave" style="margin-right: 10px; margin-top: 4px;" class="control-label col-md-7">Chave Máquina:</label>
                                        <div class="form-check form-check-inline" style="display: flex;">
                                            <input type="radio" id="chave-sim" name="chave" style="margin-left: 20px;" value="s" class="form-check-input">
                                            <label class="form-check-label" for="chave-sim" style="margin-left: 5px; padding-top: 5px">Sim</label>
                                        </div>
                                        <div class="form-check form-check-inline" style="display: flex;">
                                            <input type="radio" id="chave-nao" name="chave" style="margin-left: 20px;" value="n" checked="" class="form-check-input">
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
                                            <input type="radio" id="locada-sim" name="locada" style="margin-left: 20px;" value="s" class="form-check-input">
                                            <label class="form-check-label" for="locada-sim" style="margin-left: 5px; padding-top: 5px">Sim</label>
                                        </div>
                                        <div class="form-check form-check-inline" style="display: flex;">
                                            <input type="radio" id="locada-nao" name="locada" style="margin-left: 20px;" value="n" checked="" class="form-check-input">
                                            <label class="form-check-label" for="locada-nao" style="margin-left: 5px; padding-top: 5px">Não</label>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-md-4">
                                    <div class="form-group" style="display: flex;">
                                        <label for="adaptador" style="margin-right: 10px; margin-top: 4px;" class="control-label col-md-7">Adaptador:</label>
                                        <div class="form-check form-check-inline" style="display: flex;">
                                            <input type="radio" id="adaptador-sim" name="adaptador" style="margin-left: 20px;" value="s" class="form-check-input">
                                            <label class="form-check-label" for="adaptador-sim" style="margin-left: 5px; padding-top: 5px">Sim</label>
                                        </div>
                                        <div class="form-check form-check-inline" style="display: flex;">
                                            <input type="radio" id="adaptador-nao" style="margin-left: 20px;" name="adaptador" value="n" checked="" class="form-check-input">
                                            <label class="form-check-label" style="margin-left: 5px; padding-top: 5px;" for="adaptador-nao">Não</label>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-md-4">
                                    <div class="form-group" style="display: flex;">
                                        <label for="mangueira" style="margin-right: 10px; margin-top: 4px;" class="control-label col-md-7">Mangueira:</label>
                                        <div class="form-check form-check-inline" style="display: flex;">
                                            <input type="radio" id="mangueira-sim" name="mangueira" style="margin-left: 20px;" value="s" class="form-check-input">
                                            <label class="form-check-label" for="mangueira-sim" style="margin-left: 5px; padding-top: 5px">Sim</label>
                                        </div>
                                        <div class="form-check form-check-inline" style="display: flex;">
                                            <input type="radio" id="mangueira-nao" name="mangueira" style="margin-left: 20px;" value="n" checked="" class="form-check-input">
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
                                            <input type="radio" id="validador-sim" name="validador" style="margin-left: 20px;" value="s" class="form-check-input">
                                            <label class="form-check-label" for="validador-sim" style="margin-left: 5px; padding-top: 5px">Sim</label>
                                        </div>
                                        <div class="form-check form-check-inline" style="display: flex;">
                                            <input type="radio" id="validador-nao" name="validador" style="margin-left: 20px;" value="n" checked="" class="form-check-input">
                                            <label class="form-check-label" for="validador-nao" style="margin-left: 5px; padding-top: 5px">Não</label>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-md-4">
                                    <div class="form-group" style="display: flex;">
                                        <label for="cofre" style="margin-right: 10px; margin-top: 4px;" class="control-label col-md-7">Cofre:</label>
                                        <div class="form-check form-check-inline" style="display: flex;">
                                            <input type="radio" id="cofre-sim" name="cofre" style="margin-left: 20px;" value="s" class="form-check-input">
                                            <label class="form-check-label" for="cofre-sim" style="margin-left: 5px; padding-top: 5px">Sim</label>
                                        </div>
                                        <div class="form-check form-check-inline" style="display: flex;">
                                            <input type="radio" id="cofre-nao" style="margin-left: 20px;" name="cofre" value="n" checked="" class="form-check-input">
                                            <label class="form-check-label" style="margin-left: 5px; padding-top: 5px;" for="cofre-nao">Não</label>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-md-4">
                                    <div class="form-group" style="display: flex;">
                                        <label for="chaveCofre" style="margin-right: 10px; margin-top: 4px;" class="control-label col-md-7">Chave do Cofre:</label>
                                        <div class="form-check form-check-inline" style="display: flex;">
                                            <input type="radio" id="chaveCofre-sim" name="chaveCofre" style="margin-left: 20px;" value="s" class="form-check-input">
                                            <label class="form-check-label" for="chaveCofre-sim" style="margin-left: 5px; padding-top: 5px">Sim</label>
                                        </div>
                                        <div class="form-check form-check-inline" style="display: flex;">
                                            <input type="radio" id="chaveCofre-nao" name="chaveCofre" style="margin-left: 20px;" value="n" checked="" class="form-check-input">
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
                                                    <input type="radio" id="evs-sim" name="evs" style="margin-left: 20px;" value="s" class="form-check-input">
                                                    <label class="form-check-label" for="evs-sim" style="margin-left: 5px; padding-top: 5px">Sim</label>
                                                </div>
                                                <div class="form-check form-check-inline" style="display: flex;">
                                                    <input type="radio" id="evs-nao" name="evs" style="margin-left: 20px;" checked="" value="n" class="form-check-input">
                                                    <label class="form-check-label" for="evs-nao" style="margin-left: 5px; padding-top: 5px; margin-right:10px">Não</label>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="radio-inline">
                                            <input type="number" class="form-control" id="evs_qtd" name="evs_qtd" min="1" style="background-color: #EEE;" readonly disabled="" placeholder="Quant.">
                                            <br>
                                            <input type="text" class="form-control" id="evs_obs" name="evs_obs" style="background-color: #EEE;" readonly disabled="" placeholder="Obs">
                                        </div>
                                    </div>

                                    <div class="form-group" style="padding: 15px; border: 1px solid #DDDDDD">
                                        <div style="display: flex; flex-direction: column;">

                                            <div style="display: flex; flex-direction: row;">
                                                <div class="col-md-4">
                                                    <div class="form-group" style="display: flex;">
                                                        <label for="reservatiorioAgua" style="margin-right: 10px; margin-top: 4px;" class="control-label col-md-7">Reservatório D'água:</label>
                                                        <div class="form-check form-check-inline" style="display: flex;">
                                                            <input type="radio" id="reservatiorioAgua-sim" name="reservatiorioAgua" style="margin-left: 20px;" value="s" class="form-check-input">
                                                            <label class="form-check-label" for="reservatiorioAgua-sim" style="margin-left: 5px; padding-top: 5px">Sim</label>
                                                        </div>
                                                        <div class="form-check form-check-inline" style="display: flex;">
                                                            <input type="radio" id="reservatiorioAgua-nao" name="reservatiorioAgua" style="margin-left: 20px;" checked="" value="n" class="form-check-input">
                                                            <label class="form-check-label" for="reservatiorioAgua-nao" style="margin-left: 5px; padding-top: 5px; margin-right:10px">Não</label>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="radio-inline">
                                                    <input type="text" class="form-control" style="background-color: #EEE;" readonly id="reservatiorioAgua_obs" name="reservatiorioAgua_obs" disabled="" placeholder="Obs">
                                                </div>
                                            </div>



                                            <div>
                                                <div class="col-md-4">
                                                    <div class="form-group" style="display: flex;">
                                                        <label for="tampaReservatiorioAgua" style="margin-right: 10px; margin-top: 4px;" class="control-label col-md-7">Tampa do reservatório D'água:</label>
                                                        <div class="form-check form-check-inline" style="display: flex;">
                                                            <input type="radio" id="tampaReservatiorioAgua-sim" name="tampaReservatiorioAgua" style="margin-left: 20px;" value="s" class="form-check-input">
                                                            <label class="form-check-label" for="tampaReservatiorioAgua-sim" style="margin-left: 5px; padding-top: 5px">Sim</label>
                                                        </div>
                                                        <div class="form-check form-check-inline" style="display: flex;">
                                                            <input type="radio" id="tampaReservatiorioAgua-nao" name="tampaReservatiorioAgua" style="margin-left: 20px;" checked="" value="n" class="form-check-input">
                                                            <label class="form-check-label" for="tampaReservatiorioAgua-nao" style="margin-left: 5px; padding-top: 5px; margin-right:10px">Não</label>
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
                                                            <input type="radio" id="compartimentos-sim" name="compartimentos" style="margin-left: 20px;" value="s" class="form-check-input">
                                                            <label class="form-check-label" for="compartimentos-sim" style="margin-left: 5px; padding-top: 5px">Sim</label>
                                                        </div>
                                                        <div class="form-check form-check-inline" style="display: flex;">
                                                            <input type="radio" id="compartimentos-nao" name="compartimentos" style="margin-left: 20px;" checked="" value="n" class="form-check-input">
                                                            <label class="form-check-label" for="compartimentos-nao" style="margin-left: 5px; padding-top: 5px; margin-right:10px">Não</label>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="radio-inline">
                                                    <input type="text" class="form-control" style="background-color: #EEE;" readonly id="compartimentos_obs" name="compartimentos_obs" disabled="" placeholder="Quant.">
                                                </div>
                                            </div>



                                            <div style="display: flex; justify-content:center;">
                                                <div class="col-md-4">
                                                    <div class="form-group" style="display: flex;">
                                                        <label for="tampaCompartimentos" style="margin-right: 10px; margin-top: 4px;" class="control-label col-md-7">Tampa dos compartimentos:</label>
                                                        <div class="form-check form-check-inline" style="display: flex;">
                                                            <input type="radio" id="tampaCompartimentos-sim" name="tampaCompartimentos" style="margin-left: 20px;" value="s" class="form-check-input">
                                                            <label class="form-check-label" for="tampaCompartimentos-sim" style="margin-left: 5px; padding-top: 5px">Sim</label>
                                                        </div>
                                                        <div class="form-check form-check-inline" style="display: flex;">
                                                            <input type="radio" id="tampaCompartimentos-nao" name="tampaCompartimentos" style="margin-left: 20px;" checked="" value="n" class="form-check-input">
                                                            <label class="form-check-label" for="tampaCompartimentos-nao" style="margin-left: 5px; padding-top: 5px; margin-right:10px">Não</label>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="radio-inline">
                                                    <input type="number" class="form-control" style="background-color: #EEE;" readonly id="tampaCompartimentos_qtd" name="tampaCompartimentos_qtd" min="1" disabled="" placeholder="Quant.">
                                                    <br>
                                                    <input type="text" class="form-control" style="background-color: #EEE;" readonly id="tampaCompartimentos_obs" name="tampaCompartimentos_obs" disabled="" placeholder="Obs">
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
                                                            <input type="radio" id="bandeja-sim" name="bandeja" style="margin-left: 20px;" value="s" class="form-check-input">
                                                            <label class="form-check-label" for="bandeja-sim" style="margin-left: 5px; padding-top: 5px">Sim</label>
                                                        </div>
                                                        <div class="form-check form-check-inline" style="display: flex;">
                                                            <input type="radio" id="bandeja-nao" name="bandeja" style="margin-left: 20px;" checked="" value="n" class="form-check-input">
                                                            <label class="form-check-label" for="bandeja-nao" style="margin-left: 5px; padding-top: 5px; margin-right:10px">Não</label>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                            <div style="display: flex; justify-content:center; flex-direction: row;">
                                                <div class="col-md-4">
                                                    <div class="form-group" style="display: flex;">
                                                        <label for="gradeBandeja" style="margin-right: 10px; margin-top: 4px;" class="control-label col-md-7">Grade da Bandeja:</label>
                                                        <div class="form-check form-check-inline" style="display: flex;">
                                                            <input type="radio" id="gradeBandeja-sim" name="gradeBandeja" style="margin-left: 20px;" value="s" class="form-check-input">
                                                            <label class="form-check-label" for="gradeBandeja-sim" style="margin-left: 5px; padding-top: 5px">Sim</label>
                                                        </div>
                                                        <div class="form-check form-check-inline" style="display: flex;">
                                                            <input type="radio" id="gradeBandeja-nao" name="gradeBandeja" style="margin-left: 20px;" checked="" value="n" class="form-check-input">
                                                            <label class="form-check-label" for="gradeBandeja-nao" style="margin-left: 5px; padding-top: 5px; margin-right:10px">Não</label>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>



                                            <div style="display: flex; justify-content:center;">
                                                <div class="col-md-4">
                                                    <div class="form-group" style="display: flex;">
                                                        <label for="produtos" style="margin-right: 10px; margin-top: 4px;" class="control-label col-md-7">Produtos:</label>
                                                        <div class="form-check form-check-inline" style="display: flex;">
                                                            <input type="radio" id="produtos-sim" name="produtos" style="margin-left: 20px;" value="s" class="form-check-input">
                                                            <label class="form-check-label" for="produtos-sim" style="margin-left: 5px; padding-top: 5px">Sim</label>
                                                        </div>
                                                        <div class="form-check form-check-inline" style="display: flex;">
                                                            <input type="radio" id="produtos-nao" name="produtos" style="margin-left: 20px;" checked="" value="n" class="form-check-input">
                                                            <label class="form-check-label" for="produtos-nao" style="margin-left: 5px; padding-top: 5px; margin-right:10px">Não</label>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="radio-inline" style="display: flex; justify-content:center;">
                                                <input type="text" class="form-control" id="produtos_obs" style="width:50vw; background-color: #EEE;" readonly name="produtos_obs" disabled="" placeholder="Quais">
                                            </div>

                                        </div>

                                    </div>

                                </div>

                                <div class="form-group" style="margin-left: 6vw; width:70vw; display: flex; justify-content: center; margin-top:10px">
                                    <label for="obs" class="control-label col-md-2" style="margin-right: 10px;">Observação:</label>
                                    <div class="col-md-10">
                                        <textarea name="obs" style="width:67vw" id="obs" class="form-control" rows="8"></textarea>
                                    </div>
                                </div>

                                <div class="form-group" style="margin-left: 4vw; width:74vw; display: flex; justify-content: center; margin-top:10px">
                                    <label for="descricao_cliente" class="control-label col-md-2" style="width: 75px; margin-right: 10px;">Defeito descrito pelo cliente:</label>
                                    <div class="col-md-10" style="width:100%">
                                        <textarea name="descricao_cliente" style="width:98%" id="descricao_cliente" class="form-control" rows="8"></textarea>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="form-actions">
                            <div class="span12">
                                <div class="span6 offset3" style="display:flex;justify-content: center">
                                    <button id="btnRegister" type="submit" class="button btn btn-mini btn-success"><span class="button__icon"><i class='bx bx-save'></i></span> <span class="button__text2">Salvar</span></a></button>
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
            $('#maquina').select2({
                tags: true
            });

            $('#cliente').select2({
                tags: true
            });

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
                    data: {'id':id},
                    dataType: 'json',
                    success: function(data) {
                        if (data.message === "Cliente encontrado com sucesso") {} else {
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

            let dataAtual = new Date();
            let dataFormatada = `${String(dataAtual.getDate()).padStart(2, '0')}/${String(dataAtual.getMonth() + 1).padStart(2, '0')}/${dataAtual.getFullYear()}`;
            let horaFormatada = `${String(dataAtual.getHours()).padStart(2, '0')}:${String(dataAtual.getMinutes()).padStart(2, '0')}:${String(dataAtual.getSeconds()).padStart(2, '0')}`;

            $("#data").val(dataFormatada);
            $("#hora").val(horaFormatada);

        })
    </script>


    @endsection