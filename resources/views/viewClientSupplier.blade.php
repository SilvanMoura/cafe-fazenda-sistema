@extends('layouts/app')

@section('content')
<div class="widget-box" style="margin-left: 7%; width: 91vw; min-height: 90vh">
    <div class="widget-title" style="margin: 0;font-size: 1.1em">
        <ul class="nav nav-tabs">
            <li><a data-toggle="tab" href="#tab1">Dados do Cliente</a></li> <!-- class="active" -->
            <li><a data-toggle="tab" href="#tab2">Ordens de Serviço</a></li>
            <li><a data-toggle="tab" href="#tab3">Máquinas</a></li>
        </ul>
    </div>
    <div class="widget-content tab-content">
        <div id="tab1" class="tab-pane active" style="min-height: 300px">
            <div class="accordion" id="collapse-group">

                <div class="accordion-group widget-box">
                    <div class="accordion-heading">
                        <div class="widget-title">
                            <a data-parent="#collapse-group" href="#collapseGOne" data-toggle="collapse">
                                <span><i class='bx bx-user icon-cli'></i></span>
                                <h5 style="padding-left: 28px">Dados Pessoais</h5>
                            </a>
                        </div>
                    </div>
                    <div> <!-- class="collapse in accordion-body" id="collapseGOne" -->
                        <div class="widget-content">
                            <table class="table table-bordered" style="border: 1px solid #ddd">
                                <tbody>
                                    <tr>
                                        <td style="text-align: right; width: 30%"><strong>Nome:</strong></td>
                                        <td>
                                            {{ $infoClient->nome }}
                                        </td>
                                    </tr>
                                    <tr>
                                        <td style="text-align: right"><strong>{{ $infoClient->cpf != '' ? 'CPF:' : 'CNPJ:' }}</strong></td>
                                        <td>
                                            {{ $infoClient->cpf != '' ? $infoClient->cpf : $infoClient->cnpj }}
                                        </td>
                                    </tr>
                                    <tr>
                                        <td style="text-align: right"><strong>Tipo do Cliente:</strong></td>
                                        <td>
                                            {{ $infoClient->pessoa == "j" ? 'Jurídica' : 'Física' }}
                                        </td>
                                    </tr>
                                    @if($infoClient->ierg != "")
                                    <tr>
                                        <td style="text-align: right"><strong>I.E/RG:</strong></td>
                                        <td>
                                            {{ $infoClient->ierg }}
                                        </td>
                                    </tr>
                                    @endif
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>

                <div class="accordion-group widget-box">
                    <div class="accordion-heading">
                        <div class="widget-title">
                            <a data-parent="#collapse-group" href="#collapseGTwo" data-toggle="collapse">
                                <span><i class='bx bx-phone icon-cli'></i></span>
                                <h5 style="padding-left: 28px">Contatos</h5>
                            </a>
                        </div>
                    </div>
                    <div><!-- class="collapse accordion-body" id="collapseGTwo" -->
                        <div class="widget-content">
                            <table class="table table-bordered" style="border: 1px solid #ddd">
                                <tbody>

                                    @if( $infoClient->telefone != "" )
                                    <tr>
                                        <td style="text-align: right; width: 30%"><strong>Telefone:</strong></td>
                                        <td>
                                            {{ $infoClient->telefone }}
                                        </td>
                                    </tr>
                                    @endif

                                    @if( $infoClient->celular != "" )
                                    <tr>
                                        <td style="text-align: right; width: 30%;"><strong>Celular:</strong></td>
                                        <td>
                                            {{ $infoClient->celular }}
                                        </td>
                                    </tr>
                                    @endif

                                    @if($infoClient->email != '')
                                    <tr>
                                        <td style="text-align: right"><strong>Email:</strong></td>
                                        <td>
                                            {{ $infoClient->email }}
                                        </td>
                                    </tr>
                                    @endif

                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                <div class="accordion-group widget-box">
                    <div class="accordion-heading">
                        <div class="widget-title">
                            <a data-parent="#collapse-group" href="#collapseGThree" data-toggle="collapse">
                                <span><i class='bx bx-map-alt icon-cli'></i></span>
                                <h5 style="padding-left: 28px">Endereço</h5>
                            </a>
                        </div>
                    </div>
                    <div><!-- class="collapse accordion-body" id="collapseGThree" -->
                        <div class="widget-content">
                            <table class="table table-bordered th" style="border: 1px solid #ddd;border-left: 1px solid #ddd">
                                <tbody>
                                    <tr>
                                        <td style="text-align: right; width: 30%;"><strong>Rua:</strong></td>
                                        <td>
                                            {{ $infoClient->endereco }}
                                        </td>
                                    </tr>
                                    <tr>
                                        <td style="text-align: right"><strong>Complemento:</strong></td>
                                        <td>
                                            {{ $infoClient->complemento }}
                                        </td>
                                    </tr>
                                    <tr>
                                        <td style="text-align: right"><strong>Bairro:</strong></td>
                                        <td>
                                            {{ $infoClient->bairro }}
                                        </td>
                                    </tr>
                                    <tr>
                                        <td style="text-align: right"><strong>Cidade:</strong></td>
                                        <td>
                                            {{ $infoClient->cidade }} -
                                            {{ $infoClient->uf }}
                                        </td>
                                    </tr>
                                    <tr>
                                        <td style="text-align: right"><strong>CEP:</strong></td>
                                        <td>
                                            {{ $infoClient->cep }}
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!--Tab 2-->
        <div id="tab2" class="tab-pane" style="min-height: 300px">
            <!-- ?php if (!$results) { ?> -->
            <table class="table table-bordered ">
                <thead>
                    <tr>
                        <th>N° OS</th>
                        <th>Data Avaliação</th>
                        <th>Defeito descrito pelo cliente</th>
                        <th>Avaliação</th>
                        <th>Obs.</th> 
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                @if($osInfo->count() > 0) 
                        @foreach ($osInfo as $r) 
                            <tr>
                                <td style="width:5%">{{ $r->id }}</td>
                                <td style="width:10%">{{ $r->data_avaliacao }}</td>
                                <td style="width:20%">{{ $r->descricao_cliente }}</td>
                                <td style="width:35%">{{ $r->avaliacao }}</td>
                                <td style="width:20%">@if($r->obs != '') {{ $r->obs }} @endif</td>
                                
                                <td>
                                    
                                    <a href="{{ url('os/visualizar/' . $r->id) }}" style="margin-right: 1%" class="btn tip-top" title="Ver mais detalhes">
                                        <i class="fas fa-eye"></i>
                                    </a>
                                     <a href="{{ url('os/editar/' . $r->id) }}" class="btn btn-info tip-top" title="Editar OS">
                                        <i class="fas fa-edit"></i>
                                    </a>
                                </td>
                            </tr>
                        @endforeach
                    @else
                        <tr>
                            <td colspan="6">Nenhuma OS Cadastrada</td>
                        </tr>
                    @endif
                </tbody>
            </table>
        </div>

        <!--Tab 3-->
        <div id="tab3" class="tab-pane" style="min-height: 300px">
            <!-- ?php if (!$result_vendas) { ?> -->
                <table class="table table-bordered ">
                <thead>
                    <tr>
                        <th>N° Máquina</th>
                        <th>N° Série</th>
                        <th>Nome Modelo</th>
                        <th>Nome do fabricante</th>
                        <th>Está em garantia</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                @if($osInfo->count() > 0) 
                        @foreach ($osInfo as $r) 
                            <tr>
                                <td style="width:15%">{{ $r->maquinaNome->id }}</td>
                                <td style="width:15%">{{ $r->maquinaNome->numeroserie }}</td>
                                <td style="width:20%">{{ $r->maquinaNome->nomemodelo }}</td>
                                <td style="width:20%">{{ $r->maquinaNome->fabricante_nome }}</td>
                                <td style="width:20%">{{ $r->temGarantia }}</td>
                            </tr>
                        @endforeach
                    @else
                        <tr>
                            <td colspan="6">Nenhuma Máquina Encontrada</td>
                        </tr>
                    @endif
                </tbody>
            </table>
        </div>
    </div>
</div>
<div class="modal-footer" style="display:flex;justify-content: center; margin-left: 7%;">
    <a title="Icon Title" class="button btn btn-mini btn-info" style="min-width: 140px; top:10px" href="clientes/editar/">
    <span class="button__icon"><i class="bx bx-edit"></i></span> <span class="button__text2"> Editar</span></a>';
    
    <a title="Voltar" class="button btn btn-mini btn-warning" style="min-width: 140px; top:10px" href="/clientes">
    <span class="button__icon"><i class="bx bx-undo"></i></span><span class="button__text2">Voltar</span></a>
</div>
@endsection
