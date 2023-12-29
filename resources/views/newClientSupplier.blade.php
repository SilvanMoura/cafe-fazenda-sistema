@extends('layouts/app')

@section('content')

<script src="{{ asset('js/jquery.mask.min.js') }}"></script>
<script src="{{ asset('js/sweetalert2.all.min.js') }}"></script>
<script src="{{ asset('js/funcoes.js') }}"></script>
<style>
    #imgSenha {
        width: 18px;
        cursor: pointer;
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
                <!-- ?php if ($custom_error != '') {
                echo ' -->
                <div class="alert alert-danger">teste</div>
                <!-- } ?> -->
                <form id="formCliente" class="form-horizontal">
                    @csrf
                    <div class="widget-content nopadding tab-content">
                        <div class="span6">
                            <div class="control-group">
                                <label for="documento" class="control-label">CPF/CNPJ</label>
                                <div class="controls">
                                    <input id="documento" class="cpfcnpj" type="text" name="documento" value="" />
                                    <button id="buscar_info_cnpj" class="btn btn-xs" type="button">Buscar(CNPJ)</button>
                                </div>
                            </div>
                            <div class="control-group">
                                <label for="nomeCliente" class="control-label">Nome/Razão Social<span class="required">*</span></label>
                                <div class="controls">
                                    <input id="nomeCliente" type="text" name="nomeCliente" value="" />
                                </div>
                            </div>
                            <div class="control-group">
                                <label for="IeRg" class="control-label">I.E/RG:</label>
                                <div class="controls">
                                    <input class="IeRg" type="text" name="IeRg" value="" />
                                </div>
                            </div>
                            <div class="control-group">
                                <label for="telefone" class="control-label">Telefone</label>
                                <div class="controls">
                                    <input id="telefone" type="text" name="telefone" value="" />
                                </div>
                            </div>
                            <div class="control-group">
                                <label for="celular" class="control-label">Celular</label>
                                <div class="controls">
                                    <input id="celular" type="text" name="celular" value="" />
                                </div>
                            </div>
                            <div class="control-group">
                                <label for="email" class="control-label">Email</label>
                                <div class="controls">
                                    <input id="email" type="text" name="email" value="" />
                                </div>
                            </div>
                            <div class="control-group">
                                <label class="control-label">Tipo de Pessoa</label>
                                <div class="controls">
                                    <label for="Jurídica" class="btn btn-default">Jurídica
                                        <input type="checkbox" id="Jurídica" name="Jurídica" class="badgebox" value="j">
                                        <span class="badge">&check;</span>
                                    </label>
                                </div>
                            </div>
                        </div>

                        <div class="span6">
                            <div class="control-group" class="control-label">
                                <label for="cep" class="control-label">CEP</label>
                                <div class="controls">
                                    <input id="cep" type="text" name="cep" value="" />
                                </div>
                            </div>
                            <div class="control-group" class="control-label">
                                <label for="rua" class="control-label">Rua</label>
                                <div class="controls">
                                    <input id="rua" type="text" name="rua" value="" />
                                </div>
                            </div>
                            <div class="control-group">
                                <label for="numero" class="control-label">Número</label>
                                <div class="controls">
                                    <input id="numero" type="text" name="numero" value="" />
                                </div>
                            </div>
                            <div class="control-group">
                                <label for="complemento" class="control-label">Complemento</label>
                                <div class="controls">
                                    <input id="complemento" type="text" name="complemento" value="" />
                                </div>
                            </div>
                            <div class="control-group" class="control-label">
                                <label for="bairro" class="control-label">Bairro</label>
                                <div class="controls">
                                    <input id="bairro" type="text" name="bairro" value="" />
                                </div>
                            </div>
                            <div class="control-group" class="control-label">
                                <label for="cidade" class="control-label">Cidade</label>
                                <div class="controls">
                                    <input id="cidade" type="text" name="cidade" value="" />
                                </div>
                            </div>
                            <div class="control-group" class="control-label">
                                <label for="estado" class="control-label">Estado</label>
                                <div class="controls">
                                    <select id="estado" name="estado">
                                        <option value="">Selecione...</option>
                                    </select>
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
<script type="text/javascript">
    $(document).ready(function() {
        let container = document.querySelector('div');

        $.getJSON("{{ asset('json/estados.json') }}", function(data) {
            for (i in data.estados) {
                $('#estado').append(new Option(data.estados[i].nome, data.estados[i].sigla));
            }
            var curState = "{{ old('estado') }}";
            if (curState) {
                $("#estado option[value=" + curState + "]").prop("selected", true);
            }
        });
        $("#nomeCliente").focus();
        $('#formCliente').validate({
            rules: {
                nomeCliente: {
                    required: true
                },
            },
            messages: {
                nomeCliente: {
                    required: 'Campo Requerido.'
                },
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

        $('#btnRegister').on('click', function(e) {
            e.preventDefault();

            // Validação do formulário usando o plugin validate
            if ($("#formCliente").valid()) {
                var dados = $("#formCliente").serialize();

                $(this).addClass('disabled');
                $('#progress-acessar').removeClass('hide');

                // Requisição AJAX
                $.ajax({
                    type: "POST",
                    url: "http://localhost:8000/clientes/adicionar",
                    data: dados,
                    dataType: 'json',
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    success: function(data) {
                        if (data.success === true) {
                            window.location.href = "http://localhost:8000/dashboard";
                        } else {
                            $('#btn-acessar').removeClass('disabled');
                            $('#progress-acessar').addClass('hide');

                            $('#message').text(data.message || 'Os dados de acesso estão incorretos, por favor tente novamente!');
                            $('#call-modal').trigger('click');
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