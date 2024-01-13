@extends('layouts/app')

@section('content')
<div style="margin-left: 7%; width: 91vw; min-height: 90vh">
    <a href="clientes/adicionar" class="button btn btn-mini btn-success" style="max-width: 165px">
        <span class="button__icon"><i class='bx bx-plus-circle'></i></span><span class="button__text2">
            Orçamento
        </span>
    </a>
    <div class="widget-box">

        <div class="widget-title" style="margin: 0;font-size: 1.1em">
            <ul class="nav nav-tabs">
                <li><a data-toggle="tab" href="#tab1">Orçamentos</a></li> <!-- class="active" -->
                <li><a data-toggle="tab" href="#tab2">Serviços</a></li>
            </ul>
        </div>

        <div class="widget-content tab-content">
            <div id="tab1" class="tab-pane active" style="min-height: 300px">
                <div class="accordion" id="collapse-group">

                    <div class="accordion-group widget-box">
                        <div class="accordion-heading">
                            <div class="widget-title">
                                <a data-parent="#collapse-group" href="#collapseGOne" data-toggle="collapse">
                                    <span><i class='bx bx-receipt icon-cli'></i></span>
                                    <h5 style="padding-left: 28px">Orçamentos</h5>
                                </a>
                            </div>
                        </div>
                        <div> <!-- class="collapse in accordion-body" id="collapseGOne" -->
                            <div class="widget-content">
                                <table class="table table-bordered ">
                                    <thead>
                                        <tr>
                                            <th>N°</th>
                                            <th>Nome</th>
                                            <th>Status</th>
                                            <th>Data Avaliação</th>
                                            <th>Avaliação</th>
                                            <th></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @if($infoOsOrcamentos->count() > 0)
                                        @foreach($infoOsOrcamentos as $r)
                                        <tr>
                                            <td style="width:5%">{{ $r->id }}</td>
                                            <td style="width:15%">{{ $r->cliente_id }}</td>
                                            <td style="width:10%">{{ $r->status_os_id }}</td>
                                            <td style="width:10%">{{ $r->data_avaliacao }}</td>
                                            <td style="width:43%">{{ $r->avaliacao }}</td>

                                            <td>

                                                <a href="os/visualizar/{{ $r->id }}" style="margin-right: 1%" class="btn btn-alt tip-top" title="Ver mais detalhes">
                                                    <i class="fas fa-eye"></i>
                                                </a>
                                                <a href="os/editar/{{ $r->id }}" class="btn btn-alt btn-info tip-top" title="Editar OS">
                                                    <i class="fas fa-edit"></i>
                                                </a>

                                                <a href="os/visualizar/{{ $r->id }}" style="margin-right: 1%" class="btn btn-alt tip-top" title="Ver mais detalhes">
                                                    <i class="fas fa-print"></i>
                                                </a>
                                                <a href="os/editar/{{ $r->id }}" class="btn btn-alt btn-info tip-top" title="Editar OS">
                                                    <i class="fas fa-folder"></i>
                                                </a>

                                            </td>
                                        </tr>
                                        @endforeach
                                        @else
                                        <tr>
                                            <td colspan="6">Nenhuma Orçamento Cadastrada</td>
                                        </tr>
                                        @endif
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
            <!--Tab 2-->
            <div id="tab2" class="tab-pane" style="min-height: 300px">
                <div class="accordion" id="collapse-group">

                    <div class="accordion-group widget-box">
                        <div class="accordion-heading">
                            <div class="widget-title">
                                <a data-parent="#collapse-group" href="#collapseGOne" data-toggle="collapse">
                                    <span><i class='bx bx-receipt icon-cli'></i></span>
                                    <h5 style="padding-left: 28px">Serviços</h5>
                                </a>
                            </div>
                        </div>
                        <div> <!-- class="collapse in accordion-body" id="collapseGOne" -->
                            <div class="widget-content">
                                <table class="table table-bordered ">
                                    <thead>
                                        <tr>
                                            <th>N°</th>
                                            <th>Nome</th>
                                            <th>Status</th>
                                            <th>Data Avaliação</th>
                                            <th>Avaliação</th>
                                            <th>Valor</th>
                                            <th></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @if($infoOsServices->count() > 0)
                                        @foreach($infoOsServices as $r)
                                        <tr>
                                            <td style="width:5%">{{ $r->id }}</td>
                                            <td style="width:15%">{{ $r->cliente_id }}</td>
                                            <td style="width:10%">{{ $r->status_os_id }}</td>
                                            <td style="width:10%">{{ $r->data_avaliacao }}</td>
                                            <td style="width:33%">{{ $r->avaliacao }}</td>
                                            <td style="width:7%">R$ {{ $r-> valor_os}}</td>

                                            <td>

                                                <a href="os/visualizar/{{ $r->id }}" style="margin-right: 1%" class="btn btn-alt tip-top" title="Ver mais detalhes">
                                                    <i class="fas fa-eye"></i>
                                                </a>
                                                <a href="os/editar/{{ $r->id }}" class="btn btn-alt btn-info tip-top" title="Editar OS">
                                                    <i class="fas fa-edit"></i>
                                                </a>

                                                <a href="os/visualizar/{{ $r->id }}" style="margin-right: 1%" class="btn btn-alt tip-top" title="Ver mais detalhes">
                                                    <i class="fas fa-print"></i>
                                                </a>
                                                <a href="os/editar/{{ $r->id }}" class="btn btn-alt btn-info tip-top" title="Editar OS">
                                                    <i class="fas fa-folder"></i>
                                                </a>
                                                <a href="os/visualizar/{{ $r->id }}" style="margin-right: 1%" class="btn btn-alt tip-top" title="Ver mais detalhes">
                                                    <i class="fas fa-truck"></i>
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
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
    <div class="modal-footer" style="display:flex;justify-content: center;">
        <a title="Voltar" class="button btn btn-mini btn-warning" style="min-width: 140px; top:10px" href="/dashboard">
            <span class="button__icon"><i class="bx bx-undo"></i></span><span class="button__text2">Voltar</span></a>
    </div>
    </div>
    @endsection