@extends('layouts/app')

@section('content')
<div style="margin-left: 7%; width: 91vw; min-height: 90vh">
    <a href="clientes/adicionar" class="button btn btn-mini btn-success" style="max-width: 165px">
        <span class="button__icon"><i class='bx bx-plus-circle'></i></span><span class="button__text2">
            Os's
        </span>
    </a>
    <div class="widget-box">

        <div class="widget-content tab-content">
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
                                        
                                        <tr>
                                            <td style="width:5%"></td>
                                            <td style="width:15%"></td>
                                            <td style="width:10%"></td>
                                            <td style="width:10%"></td>
                                            <td style="width:33%"></td>
                                            <td style="width:7%">R$ </td>

                                            <td>

                                                <a href="os/visualizar/" style="margin-right: 1%" class="btn btn-alt tip-top" title="Ver mais detalhes">
                                                    <i class="fas fa-eye"></i>
                                                </a>
                                                <a href="os/editar/" class="btn btn-alt btn-info tip-top" title="Editar OS">
                                                    <i class="fas fa-edit"></i>
                                                </a>

                                            </td>
                                        </tr>
                                        <tr>
                                            <td colspan="6">Nenhuma OS Cadastrada</td>
                                        </tr>
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