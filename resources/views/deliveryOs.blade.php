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
                    <h5>Retirada de Equipamento</h5>
                </div>

                <div class="alert alert-danger hide" id="error-message"></div>

                <div class="container mt-5">
                    <form id="formOs">
                        @csrf
                        <!-- Primeira Linha -->
                        <div class="form-row" style="display:flex; justify-content: space-between;">
                            <input type="hidden" id="os" name="os" value="{{ $os->id }}" />

                            <div class="form-group col-md-6" style="display: flex; flex-direction: row; align-items: center;">
                                <label for="cliente" style="margin-right: 20px">Cliente:</label>
                                <div class="controls">
                                    <input type="text" class="form-control" id="maquinas" name="maquinas" style="width: 35vw; background-color: #EEE;" readonly value="{{ $client->nome }}">
                                </div>
                            </div>

                            <div class="form-group col-md-4" style="display: flex; flex-direction: row; align-items: center;">
                                <label for="operacao" style="margin-right: 10px;">Operação:</label>
                                <input type="text" class="form-control" id="maquinas" name="maquinas" style="width: 15vw; background-color: #EEE; margin-right:20px;" readonly value="{{ $os->operation_name }}">
                            </div>

                            <div class="form-group col-md-4" style="display: flex; flex-direction: row; align-items: center;">
                                <label for="data" style="margin-right: 10px">Data:</label>
                                <input readonly type="text" class="form-control" id="data" name="data" placeholder="Data" value="" style="margin-right: 20px; background-color: #EEE;">
                            </div>
                        </div>

                        <!-- Terceira Linha -->
                        <div class="form-row" style="display:flex; justify-content: space-between;">
                            <div class="form-group col-md-8" style="display: flex; flex-direction: row; align-items: center;">
                                <label for="endereco" style="margin-right: 20px">Endereço:</label>
                                <input type="text" class="form-control" readonly id="endereco" name="endereco" style="width:50vw; background-color: #EEE; margin-right: 20px" placeholder="Endereço" style="width: 60vw" value="{{$client->endereco}}">
                            </div>
                            <div class="form-group col-md-4" style="display: flex; flex-direction: row; align-items: center;">
                                <label for="complemento" style="margin-right: 20px">Complemento:</label>
                                <input type="text" class="form-control" id="complemento" name="complemento" style="background-color: #EEE; width:15vw;" readonly placeholder="Complemento" value="{{$client->complemento}}">
                            </div>
                        </div>

                        <!-- Quarta Linha -->
                        <div class="form-row" style="display:flex; justify-content: space-between;">
                            <div class="form-group col-md-4" style="display: flex; flex-direction: row; align-items: center;">
                                <label for="bairro" style="margin-right: 10px">Bairro:</label>
                                <input type="text" class="form-control" style="background-color: #EEE" readonly id="bairro" name="bairro" style="width: 40vw; background-color:EEE; margin-right: 20px" placeholder="Bairro" value="{{$client->bairro}}">
                            </div>
                            <div class="form-group col-md-4" style="display: flex; flex-direction: row; align-items: center;">
                                <label for="cpfcnpj" style="margin-right: 10px">CPF/CNPJ:</label>
                                <input type="text" class="form-control" style="width: 20vw; background-color: #EEE; margin-right: 20px" readonly id="cpfcnpj" name="cpfcnpj" placeholder="CPF/CNPJ" value="{{ $client->cpf ? $client->cpf : $client->cnpj }}">
                            </div>
                            <div class="form-group col-md-4" style="display: flex; flex-direction: row; align-items: center;">
                                <label for="telefone" style="margin-right: 10px">Telefone:</label>
                                <input type="text" class="form-control" style="background-color: #EEE; width: 20vw;" readonly id="telefone" name="telefone" placeholder="Telefone" value="{{$client->telefone}}">
                            </div>
                        </div>

                        <div class="form-row" style="display:flex; justify-content: space-between;">
                            <div class="form-group col-md-4" style="display: flex; flex-direction: row; align-items: center;">
                                <label for="garantia" style="margin-right: 10px">Garantia:</label>
                                <input type="text" class="form-control" id="garantia" name="garantia" style="width: 10vw; margin-right: 5px" placeholder="Garantia" value="{{ $os->garantia == '' ? '' : $os->garantia }}">
                                <span>Dia(s) a partir de <span id="dataHoje"></span></span>
                            </div>

                            <div class="form-group col-md-4" style="display: flex; flex-direction: row; align-items: center;">
                                <label for="desconto" style="margin-right: 10px">Desconto:</label>
                                <input type="number" class="form-control" id="desconto" name="desconto" style="width: 10vw; margin-right: 5px" placeholder="Desconto" value="">
                            </div>

                        </div>

                        <div class="form-actions">
                            <div class="span12">

                                <div class="span6 offset3" style="display:flex;justify-content: center">
                                    <button id="btnPrint" type="submit" class="button btn btn-success" style="max-width: 160px">
                                        <span class="button__icon"><i class="bx bx-file"></i></span><span class="button__text2">Imprimir</span></button>
                                    <a title="Voltar" class="button btn btn-warning" href="/os"><span class="button__icon"><i class="bx bx-undo"></i></span> <span class="button__text2">Voltar</span></a>
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

            let dataAtual = new Date();
            let dataFormatada = `${String(dataAtual.getDate()).padStart(2, '0')}/${String(dataAtual.getMonth() + 1).padStart(2, '0')}/${dataAtual.getFullYear()}`;
            $("#dataHoje").text(dataFormatada);

            $('#btnPrint').on('click', function(e) {
                e.preventDefault();

                // Validação do formulário usando o plugin validate
                if ($("#formOs").valid()) {

                    var dados = $("#formOs").serializeArray();

                    // Requisição AJAX
                    $.ajax({
                        type: "POST",
                        url: "http://localhost:8000/os/entrega/" + dados[1].value,
                        data: dados,
                        dataType: 'json',
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        },
                        success: function(data) {
                            if (data.message === "Garantia registrada com sucesso") {
                                Swal.fire({
                                    icon: 'success',
                                    title: 'Registro Concluído',
                                    text: 'Garantia registrada com sucesso!',
                                }).then(() => {
                                    window.open('http://localhost:8000/dashboard', "_blank");
                                    window.location.href = "http://localhost:8000/os/imprimirEntrega/" + dados[1].value;
                                });
                            } else {
                                Swal.fire({
                                    icon: 'error',
                                    title: 'Erro no registro',
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

        })
    </script>


    @endsection