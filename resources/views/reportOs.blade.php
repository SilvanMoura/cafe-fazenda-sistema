<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Meu Layout</title>
    <!-- Adicione o link para o Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
    <style>
        body {
            padding: 0;
            margin: 0;
            box-sizing: border-box;
            font-family: Arial, sans-serif;
            display: flex;
            flex-direction: column;
            height: 100%;
        }

        main {
            flex: 1;
            height: 100%;
        }

        footer {
            position: fixed;
            left: 0;
            right: 0;
            bottom: 0;
            text-align: center;
        }

        .line-basic {
            display: flex;
            justify-content: center;
            align-items: center;
            margin-top: 100px;
            margin-bottom: 20px;
        }

        .line-basic-alt {
            display: flex;
            justify-content: center;
            align-items: center;
        }

        .margin {
            margin-left: 20px;
            margin-right: 20px;
        }

        .margin-alt {
            margin-left: 3%;
            margin-right: 3%;
        }

        .grid-container {
            display: flex;
            flex-wrap: wrap;
            justify-content: space-between;
        }

        .line-os {
            flex: 0 0 30%;
            /* Ajuste a largura das colunas conforme necessário */
            margin-bottom: 10px;
        }

        .line-os-alt {
            display: flex;
            flex-direction: column;
            flex: 0 0 46%;
            margin-bottom: 10px;
        }

        .line-os span,
        .line-os-alt span {
            display: block;
            margin-bottom: 5px;
            font-size: 13px;
        }

        .tabela-produto {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 40px;
        }

        .tabela-produto th,
        .tabela-produto td {
            border: 1px solid #dddddd;
            padding: 8px;
            text-align: left;
        }
    </style>
</head>

<body>

    <main>
        <div data-page-no="1">
            <div>
                <div class="line-basic">
                    <span>
                        <h5>FECHAMENTO DE SERVIÇO - ASSISTÊNCIA TÉCNICA</h5>
                    </span>
                </div>

                <div>

                    <div class="line-basic-alt">
                        <h5>Café da Fazenda</h5>
                    </div>
                    <div class="line-basic-alt">
                        <p>Rua Conde de Porto Alegre, 506 - Centro - Pelotas/RS</p>
                    </div>
                    <div class="line-basic-alt">
                        <p>CGM/MF:10.969.610/0001-51</p>
                        <p class="margin">Inscr. Estad.: 0930413172</p>
                        <p>Fone:(53) 3228-1092</p>
                    </div>
                </div>
            </div>
        </div>

        <div class="grid-container margin-alt">
            <div class="line-os">
                <span><strong>Data/Hora do pedido:</strong> {{$os->data}}</span>
                <span><strong>Status:</strong> {{$os->status_os_id}}</span>
                <span><strong>Número da Ordem:</strong> {{$os->id}}</span>
                <span><strong>Máquina/Modelo:</strong> {{$machine->nomemodelo}}</span>
            </div>
            <div class="line-os">
                <span><strong>Cliente:</strong> {{$client->nome}}</span>
                <span><strong>CNPJ:</strong> {{$client->cnpj}}</span>
                <span><strong>I.E/RG:</strong>{{$client->ierg}}</span>
            </div>
            <div class="line-os">
                <span><strong>Endereço:</strong> {{$client->endereco}}, {{$client->complemento}} - {{$client->bairro}} - {{$client->cep}}</span>
                <span><strong>Cidade/UF:</strong> {{$client->cidade}}/ {{$client->uf}}</span>
                <span><strong>Contato(s):</strong> {{$client->telefone}}</span>
                <span><strong>Nº de Série:</strong> {{$machine->numeroserie}}</span>
            </div>
        </div>

        <hr style="margin-bottom:30px; margin-left: 3%; margin-right: 3%;">

        <div>
            <div class="line-basic-alt">
                <p>Avaliação:</p>
            </div>
            <div class="margin-alt">
                <p>{{$os->avaliacao}}</p>
            </div>
        </div>

        <hr class="margin-alt" style="margin-bottom: 30px;">

        <div>
            <div class="line-basic-alt">
                <p>Descrição do Cliente:</p>
            </div>
            <div class="margin-alt">
                <p>{{$os->descricao_cliente}}</p>
            </div>
        </div>

        <hr class="margin-alt" style="margin-bottom: 30px;">

        <div>
            <div class="line-basic-alt">
                <p>Observação:</p>
            </div>
            <div class="margin-alt">
                <p>{{$os->obs}}</p>
            </div>
        </div>

        <hr class="margin-alt" style="margin-bottom: 30px;">

        <div class="line-basic-alt">
            <p>Peças e Serviços</p>
        </div>
        <div class="grid-container margin-alt">
            <div class="line-os-alt">
                <span><strong>Responsável pelo Checklist*:</strong> Max </span>
                <span><strong>Nº de Bebidas Extraídas:</strong> {{$os->bebidas_extraidas}}</span>
                <span><strong>Cabo de Alimentação:</strong> {{ $os->cabo == 'n' ? 'Não' : 'Sim' }}</span>
                <span><strong>Bomba Submersa:</strong> {{ $os->bomba == 'n' ? 'Não' : 'Sim' }}</span>
                <span><strong>Chave Máquina:</strong> {{ $os->chave == 'n' ? 'Não' : 'Sim' }}</span>
                <span><strong>Tampa do Reservatório D'água:</strong> {{ $os->tampa == 'n' ? 'Não' : 'Sim' }}</span>
                <span><strong>Locada:</strong> {{ $os->locada == 'n' ? 'Não' : 'Sim' }} </span>
                <span><strong>Compartimentos:</strong> {{ $os->compartimento == 'n' ? 'Não' : 'Sim' }} / <strong>Qnt:</strong> {{ $os->compartimento_qtd }} </span>
                <span><strong>Tampa dos Compartimentos:</strong> {{ $os->tampa_compartimento == 'n' ? 'Não' : 'Sim' }} / <strong>Qnt:</strong> {{ $os->tampa_compartimento_qtd }} / <strong>Obs: </strong>{{ $os->tampa_compartimento_obs }}</span>
            </div>
            <div class="line-os-alt">
                <span><strong>Adaptador:</strong> {{ $os->adaptador == 'n' ? 'Não' : 'Sim' }} </span>
                <span><strong>Mangueira:</strong> {{ $os->mangueira == 'n' ? 'Não' : 'Sim' }} </span>
                <span><strong>Validador:</strong> {{ $os->validador == 'n' ? 'Não' : 'Sim' }} </span>
                <span><strong>Cofre:</strong> {{ $os->cofre == 'n' ? 'Não' : 'Sim' }} </span>
                <span><strong>Chave do cofre:</strong> {{ $os->cofre_chave == 'n' ? 'Não' : 'Sim' }} </span>
                <span><strong>Produtos:</strong> {{ $os->produtos == 'n' ? 'Não' : 'Sim' }} </span>
                <span><strong>Bandeja:</strong> {{ $os->bandeja == 'n' ? 'Não' : 'Sim' }} </span>
                <span><strong>Ev's:</strong> {{ $os->evs == 'n' ? 'Não' : 'Sim' }} / <strong>Qnt:</strong> {{ $os->evs_qtd}} </span>
                <span><strong>Reservatório D'água:</strong> {{ $os->reservatorio == 'n' ? 'Não' : 'Sim' }} <strong>Obs: </strong> {{ $os->reservatorio_obs }} </span>
            </div>
        </div>


    </main>

    <footer>
        <div class="margin-alt">
            <div class="line-basic-alt">
                <p>Técnico Responsável: {{$os->checklist}}</p>
                <p class="margin">Responsável pelo Checklist: {{$os->checklist}}</p>
                <p>Data da Avaliação: {{$os->data_avaliacao}}</p>
            </div>
            <p style="margin-top:-25px;">-------------------------------------------------------------------------------------------------------------------------------------------------------recortar</p>

            <div style="margin-top:-10px;" class="line-basic-alt">
                <p>Café da Fazenda</p>
            </div>

            <div style="margin-top:-5px;" class="line-basic-alt">
                <p>O.S. Nº: 1001</p>
                <p class="margin">Operação: Pedido de Serviço</p>
                <p>Data/Pedido: 05/02/2024 20:15</p>
            </div>

            <div style=" margin-top: 20px; display: flex; justify-content: space-between">
                <div>
                    <div>_____________________________________________</div>
                    <div>{{$client->nome}}</div>
                </div>
                <div>
                    <div>_____________________________________________</div>
                    <div>Café da Fazenda</div>
                </div>
            </div>
        </div>
    </footer>

</body>

</html>