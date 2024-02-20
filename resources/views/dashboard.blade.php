@extends('layouts/app')

@section('content')
<!-- New Bem-vindos -->
<div id="content-bemv">
    <div class="bemv">Dashboard</div>
    <div></div>
</div>

<!--Action boxes-->
<ul class="cardBox">
    <li class="card">
        <div class="grid-blak">
            <a href="/clientes">
                <div class="numbers">Clientes</div>
            </a>
        </div>
        <a href="/clientes">
            <div class="lord-icon02">
                <i class='bx bx-user iconBx02'></i>
            </div>
        </a>
    </li>

    <li class="card">
        <div class="grid-blak">
            <a href="/produtos">
                <div class="numbers">Produtos</div>
            </a>
        </div>
        <a href="/produtos">
            <div class="lord-icon02">
                <i class='bx bx-basket iconBx02'></i>
            </div>
        </a>
    </li>

    <li class="card">
        <div class="grid-blak">
            <a href="/servicos">
                <div class="numbers">Serviços</div>
            </a>
        </div>
        <a href="/servicos">
            <div class="lord-icon03">
                <i class='bx bx-wrench iconBx03'></i>
            </div>
        </a>
    </li>

    <li class="card">
        <div class="grid-blak">
            <a href="/os">
                <div class="numbers N-tittle">Ordens</div>
            </a>
        </div>
        <a href="/os">
            <div class="lord-icon04">
                <i class='bx bx-file iconBx04'></i>
            </div>
        </a>
    </li>

    <li class="card">
        <div class="grid-blak">
            <a href="/maquinas">
                <div class="numbers N-tittle">Máquinas</div>
            </a>
        </div>
        <a href="/maquinas">
            <div class="lord-icon05">
                <i class='bx bx-cart-alt iconBx05'></i></span>
            </div>
        </a>
    </li>

    <li class="card">
        <div class="grid-blak">
            <a href="/garantias">
                <div class="numbers">Garantias</div>
            </a>
        </div>
        <a href="/garantias">
            <div class="lord-icon06">
                <i class="bx bx-receipt iconBx6"></i>
            </div>
        </a>
    </li>

</ul>
<!--End-Action boxes-->

<div class="row-fluid" style="margin-left: 8%; margin-top: 0; display: flex">
    <div class="Sspan12">

        <!-- New widget right -->
        <div class="new-statisc">
            <div class="widget-box-new widbox-blak" style="height:100%">
                <div>
                    <h5 class="cardHeader">Estatísticas do Sistema</h5>
                </div>

                <div class="new-bottons">

                    <a href="/clientes/adicionar" class="card tip-top" title="Add Clientes e Fornecedores">
                        <div><i class='bx bxs-group iconBx'></i></div>
                        <div>
                            <div class="cardName2">{{ $dashboard['clientes'] }}</div>
                            <div class="cardName">Clientes</div>
                        </div>
                    </a>

                    <a href="/produtos/adicionar" class="card tip-top" title="Adicionar Produtos">
                        <div><i class='bx bxs-package iconBx2'></i></div>
                        <div>
                            <div class="cardName2">{{ $dashboard['produto'] }}</div>
                            <div class="cardName">Produtos</div>
                        </div>
                    </a>

                    <a href="/os/adicionar" class="card tip-top" title="Adicionar serviços">
                        <div><i class='bx bxs-stopwatch iconBx3'></i></div>
                        <div>
                            <div class="cardName2">{{ $dashboard['osServicoNumber'] }}</div>
                            <div class="cardName">Serviços</div>
                        </div>
                    </a>

                    <a href="/os/adicionar" class="card tip-top" title="Adicionar serviços">
                        <div><i class='bx bx-file iconBx3'></i></div>
                        <div>
                            <div class="cardName2">{{ $dashboard['osOrcamentoNumber'] }}</div>
                            <div class="cardName">Orçamentos</div>
                        </div>
                    </a>

                    <a href="/os/adicionar" class="card tip-top" title="Adicionar OS">
                        <div><i class='bx bxs-spreadsheet iconBx4'></i></div>
                        <div>
                            <div class="cardName2">{{ $dashboard['os'] }}</div>
                            <div class="cardName">Ordens</div>
                        </div>
                    </a>

                    <a href="/maquinas" class="card tip-top" title="Adicionar Máquina">
                        <div><i class='bx bxs-cart-alt iconBx5'></i></div>
                        <div>
                            <div class="cardName2">{{ $dashboard['maquinaNumber'] }}</div>
                            <div class="cardName">Máquinas</div>
                        </div>
                    </a>

                    <a href="/garantias" class="card tip-top" title="Adicionar garantia">
                        <div><i class='bx bxs-receipt iconBx6'></i></div>
                        <div>
                            <div class="cardName2">{{ $dashboard['garantiasNumber'] }}</div>
                            <div class="cardName">Garantias</div>
                        </div>
                    </a>
                    <!-- responsavel por fazer complementar a variavel "$financeiro_mes_dia->" de receita e despesa -->
                    <!-- if ($estatisticas_financeiro != null) {
                        if ($estatisticas_financeiro->total_receita != null || $estatisticas_financeiro->total_despesa != null || $estatisticas_financeiro->total_receita_pendente != null || $estatisticas_financeiro->total_despesa_pendente != null) { -->

                    <?php $diaRec = "VALOR_" . date('m') . "_REC";
                    $diaDes = "VALOR_" . date('m') . "_DES"; ?>

                    <!-- <a href="/financeiro/lancamentos" class="card tip-top" title="Adicionar receita">
                            <div><i class='bx bxs-up-arrow-circle iconBx7'></i></div>
                            <div>
                                <div class="cardName1 cardName2">R$ 0.00</div>
                                <div class="cardName">Receita do dia</div>
                            </div>
                        </a> -->

                    <!-- <a href="/financeiro/lancamentos" class="card tip-top" title="Adiciona despesa">
                            <div><i class='bx bxs-down-arrow-circle iconBx8'></i></div>
                            <div>
                                <div class="cardName1 cardName2">R$ 0.01</div>
                                <div class="cardName">Despesa do dia</div>
                            </div>
                        </a> -->

                    <!-- php  }
                    } -->
                </div>

            </div>
        </div>
    </div>
</div>
<!-- Fim new widget right -->

<!-- if ($estatisticas_financeiro != null) {
    if ($estatisticas_financeiro->total_receita != null || $estatisticas_financeiro->total_despesa != null || $estatisticas_financeiro->total_receita_pendente != null || $estatisticas_financeiro->total_despesa_pendente != null) { -->

<!-- Start Charts -->
<!-- <div class="new-balance">
        <div class="widget-box0">
            <div class="widget-title2">
                <h5 class="cardHeader">Balanço Mensal do Ano</h5>
                <form method="get" style="display:flex;margin-right:18px;justify-content:flex-end">
                    <input type="number" name="year" style="width:65px;margin-left:17px;margin-bottom:25px;margin-top:10px;padding-left: 35px" value="<?php echo intval(preg_replace('/[^0-9]/', '', date('Y'))) ?>">
                    <button type="submit" class="btn-xsx"><i class='bx bx-search iconX'></i></button>
                </form>
            </div>
            <div class="widget-content" style="padding:10px 25px 5px 25px">
                <div class="row-fluid" style="margin-top:-35px;">
                    <div class="span12">
                        <canvas id="myChart" style="overflow-x: scroll;margin-left: -14px"></canvas>
                    </div>
                </div>
            </div>
        </div>

        <div class="widget-box-statist">
            <h5 class="cardHeader">Estatísticas Financeira</h5>
            <div class="widget-content" style="padding:10px;margin:25px 0 0">
                <canvas id="statusOS"> </canvas>
            </div>
        </div>
    </div> -->

<script type="text/javascript">
    if (window.outerWidth > 2000) {
        Chart.defaults.font.size = 15;
    };
    if (window.outerWidth < 2000 && window.outerWidth > 1367) {
        Chart.defaults.font.size = 11;
    };
    if (window.outerWidth < 1367 && window.outerWidth > 480) {
        Chart.defaults.font.size = 9.5;
    };
    if (window.outerWidth < 480) {
        Chart.defaults.font.size = 8.5;
    };

    var ctx = document.getElementById('myChart').getContext('2d');
    var StatusOS = document.getElementById('statusOS').getContext('2d');

    var myChart = new Chart(ctx, {
        data: {
            labels: ['Jan', 'Fev', 'Mar', 'Abr', 'Mai', 'Jun', 'Jul', 'Ago', 'Set', 'Out', 'Nov', 'Dez'],
            datasets: [{
                    label: 'Receita Líquida',
                    data: [<?php echo (0 - 0); ?>,
                        <?php echo (0 - 0); ?>,
                        <?php echo (0 - 0); ?>,
                        <?php echo (0 - 0); ?>,
                        <?php echo (0 - 0); ?>,
                        <?php echo (0 - 0); ?>,
                        <?php echo (0 - 0); ?>,
                        <?php echo (0 - 0); ?>,
                        <?php echo (0 - 0); ?>,
                        <?php echo (0 - 0); ?>,
                        <?php echo (0 - 0); ?>,
                        <?php echo (0 - 0); ?>
                    ],

                    backgroundColor: 'rgba(75, 192, 192, 0.5)',
                    borderRadius: 15,
                },

                {
                    label: 'Receita Bruta',
                    data: [<?php echo (1); ?>,
                        <?php echo (1); ?>,
                        <?php echo (1); ?>,
                        <?php echo (1); ?>,
                        <?php echo (1); ?>,
                        <?php echo (1); ?>,
                        <?php echo (1); ?>,
                        <?php echo (1); ?>,
                        <?php echo (1); ?>,
                        <?php echo (1); ?>,
                        <?php echo (1); ?>,
                        <?php echo (1); ?>
                    ],

                    backgroundColor: 'rgba(255, 206, 86, 0.5)',
                    borderRadius: 15,
                },

                {
                    label: 'Despesas',
                    data: [<?php echo (1); ?>,
                        <?php echo (1); ?>,
                        <?php echo (1); ?>,
                        <?php echo (1); ?>,
                        <?php echo (1); ?>,
                        <?php echo (1); ?>,
                        <?php echo (1); ?>,
                        <?php echo (1); ?>,
                        <?php echo (1); ?>,
                        <?php echo (1); ?>,
                        <?php echo (1); ?>,
                        <?php echo (1); ?>
                    ],

                    backgroundColor: 'rgba(255, 99, 132, 0.5)',
                    borderRadius: 15,
                },

                {
                    label: 'Inadimplência',
                    data: [<?php echo (2); ?>,
                        <?php echo (2); ?>,
                        <?php echo (2); ?>,
                        <?php echo (2); ?>,
                        <?php echo (2); ?>,
                        <?php echo (2); ?>,
                        <?php echo (2); ?>,
                        <?php echo (2); ?>,
                        <?php echo (2); ?>,
                        <?php echo (2); ?>,
                        <?php echo (2); ?>,
                        <?php echo (2); ?>
                    ],

                    backgroundColor: 'rgba(54, 162, 235, 0.5)',
                    borderRadius: 15,
                }
            ]

        },
        // configuração
        type: 'bar',
        options: {
            locale: 'pt-BR',
            scales: {
                y: {
                    ticks: {
                        callback: (value, index, values) => {
                            return new Intl.NumberFormat('pt-BR', {
                                style: 'currency',
                                currency: 'BRL',
                                maximumSignificantDidits: 1
                            }).format(value);
                        }
                    }
                },
                x: {
                    beginAtZero: true,
                    title: {
                        display: true,
                        text: 'Meses'
                    }
                }
            },

            plugins: {
                tooltip: {
                    callbacks: {
                        beforeTitle: function(context) {
                            return 'Referente ao mês de';
                        }
                    }
                },

                legend: {
                    position: "bottom",
                    labels: {
                        usePointStyle: true,
                    }
                }
            }
        }
    });

    var myChart = new Chart(statusOS, {
        data: {
            labels: [
                'Receita total', 'Receita pendente',
                'Previsto em caixa', 'Despesa total',
                'Despesa pendente', 'Previsto a entrar'
            ],
            datasets: [{
                label: 'Total',
                data: [
                    <?php echo ('0.00'); ?>,
                    <?php echo ('0.00'); ?>,
                    <?php echo ('0'); ?>,
                    <?php echo ('0.00'); ?>,
                    <?php echo ('0.00'); ?>,
                    <?php echo ('0'); ?>
                ],

                backgroundColor: [
                    'rgba(75, 192, 192, 0.5)',
                    'rgba(54, 162, 235, 0.5)',
                    'rgba(255, 206, 86, 0.5)',
                    'rgba(255, 99, 132, 0.5)',
                    'rgba(255, 159, 64, 0.5)',
                    'rgba(153, 102, 255, 0.5)'
                ],
                borderWidth: 1
            }]
        },

        // configuração
        type: 'polarArea',
        options: {
            locale: 'pt-BR',
            scales: {
                r: {
                    ticks: {
                        callback: (value, index, values) => {
                            return new Intl.NumberFormat('pt-BR', {
                                style: 'currency',
                                currency: 'BRL',
                                maximumSignificantDidits: 1
                            }).format(value);
                        }
                    },
                    beginAtZero: true,
                }
            },
            plugins: {
                legend: {
                    position: "bottom",
                    labels: {
                        usePointStyle: true,

                    }
                }
            }
        }
    });

    function responsiveFonts() {
        myChart.update();
    }
</script>
<!-- php  }
} -->
</div>
</div>

<!-- Start Staus OS -->
<div class="span12A" style="margin-left: 8%; width:90vw">
    <div class="AAA">
        <div class="widget-box0 widbox-blak">
            <div>
                <h5 class="cardHeader">Orçamentos</h5>
            </div>
            <div class="widget-content">
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>Cod.</th>
                            <th>Nome</th>
                            <th>Data Avaliação</th>
                            <th>Status</th>
                            <th>Ver</th>
                        </tr>
                    </thead>
                    <tbody>
                        @if(isset($dashboard['osOrcamento']))
                        @foreach($dashboard['osOrcamento'] as $osOrcamento)
                        <tr>
                            <td>
                                {{ $osOrcamento->id }}
                            </td>
                            <td class="cli1">
                                {{ $osOrcamento->cliente_id }}
                            </td>
                            <td>
                                {{ $osOrcamento->data }}
                            </td>
                            <td>
                                {{ $osOrcamento->status_os_id }}
                            </td>
                            <td>
                                <a href="/os/visualizar/" class="btn-nwe tip-top" title="Visualizar">
                                    <i class="bx bx-show"></i> </a>
                            </td>
                        </tr>
                        @endforeach
                        @else
                        <tr>
                            <td colspan="6">Nenhum orçamento encontrado.</td>
                        </tr>
                        @endif
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <div class="widget-box0 widbox-blak">
        <div>
            <h5 class="cardHeader">Ordens de Serviço Em Aberto</h5>
        </div>
        <div class="widget-content">
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>N°</th>
                        <th>Cliente</th>
                        <th>Data Avaliação</th>
                        <th>Status</th>
                        <th>Valor</th>
                        <th>Ver</th>
                    </tr>
                </thead>
                <tbody>
                    @if(isset($dashboard['osServicos']))
                    @foreach($dashboard['osServicos'] as $osServicos)
                    <tr>
                        <td>
                            {{ $osServicos->id }}
                        </td>
                        <td>
                            {{ $osServicos->cliente_id }}
                        </td>

                        <td>
                            {{ $osServicos->data_avaliacao }}
                        </td>

                        <td class="cli1">
                            {{ $osServicos->status_os_id }}
                        </td>
                        <td class="cli1">
                            R$ {{ $osServicos->valor_os }}
                        </td>
                        <td>
                            <a href="/os/visualizar/" class="btn-nwe tip-top" title="Visualizar">
                                <i class="bx bx-show"></i> </a>

                        </td>
                    </tr>
                    @endforeach
                    @else
                    <tr>
                        <td colspan="5">Nenhuma OS em aberto.</td>
                    </tr>
                    @endif
                </tbody>
            </table>
        </div>
    </div>


    <!--<div class="widget-box0 widbox-blak">
            <div>
                <h5 class="cardHeader">Ordens de Serviço Aguardando Peças</h5>
            </div>
            <div class="widget-content">
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>N°</th>
                            <th>Data Inicial</th>
                            <th>Data Final</th>
                            <th>Cliente</th>
                            <th>Ações</th>
                        </tr>
                    </thead>
                    <tbody>
                        if ($ordens1 != null) : ?>
                         foreach ($ordens1 as $o) : ?>
                            <tr>
                                <td>
                                    = $o->idOs ?>
                                </td>
                                <td>
                                    = date('d/m/Y', strtotime($o->dataInicial)) ?>
                                </td>
                                <td>
                                    = date('d/m/Y', strtotime($o->dataFinal)) ?>
                                </td>
                                <td class="cli1">
                                    = $o->nomeCliente ?>
                                </td>
                                <td>
                                     if ($this->permission->checkPermission($this->session->userdata('permissao'), 'vOs')) : ?>
                                        <a href="= base_url() ?>index.php/os/visualizar/= $o->idOs ?>" class="btn-nwe tip-top" title="Visualizar">
                                            <i class="bx bx-show"></i></a>
                                     endif ?>
                                </td>
                            </tr>
                         endforeach ?>
                     else : ?> --
                        <tr>
                            <td colspan="5">Nenhuma OS Aguardando Peças.</td>
                        </tr>
                        <!-endif ?> --
                    </tbody>
                </table>
            </div>
        </div>-->

    <!-- <div class="widget-box0 widbox-blak">
            <div>
                <h5 class="cardHeader">Ordens de Serviço Em Andamento</h5>
            </div>
            <div class="widget-content">
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>N°</th>
                            <th>Data Inicial</th>
                            <th>Data Final</th>
                            <th>Cliente</th>
                            <th>Ações</th>
                        </tr>
                    </thead>
                    <tbody>
                        <!-- if ($ordens_andamento != null) : ?>
                         foreach ($ordens_andamento as $o) : ?>
                            <tr>
                                <td>
                                     $o->idOs ?>
                                </td>
                                <td>
                                     date('d/m/Y', strtotime($o->dataInicial)) ?>
                                </td>
                                <td>
                                     date('d/m/Y', strtotime($o->dataFinal)) ?>
                                </td>
                                <td class="cli1">
                                     $o->nomeCliente ?>
                                </td>
                                <td>
                                     if ($this->permission->checkPermission($this->session->userdata('permissao'), 'vOs')) : ?>
                                        <a href=" base_url() ?>index.php/os/visualizar/ $o->idOs ?>" class="btn-nwe tip-top" title="Visualizar">
                                            <i class="bx bx-show"></i></a>
                                     endif ?>
                                </td>
                            </tr>
                         endforeach ?>
                     else : ?> --
                        <tr>
                            <td colspan="5">Nenhuma OS em Andamento.</td>
                        </tr>
                        <!-- endif ?> --
                    </tbody>
                </table>
            </div>
        </div> -->
</div>
<!-- Fim Staus OS -->

<!-- Modal Status OS Calendar -->
<div id="calendarModal" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
        <h3 id="myModalLabel">Status OS Detalhada</h3>
    </div>
    <div class="modal-body">
        <div class="span5" id="divFormStatusOS" style="margin-left: 0"></div>
        <h4><b>OS:</b> <span id="modalId" class="modal-id"></span></h4>
        <h5 id="modalCliente" class="modal-cliente"></h5>
        <div id="modalDataInicial" class="modal-DataInicial"></div>
        <div id="modalDataFinal" class="modal-DataFinal"></div>
        <div id="modalGarantia" class="modal-Garantia"></div>
        <div id="modalStatus" class="modal-Status"></div>
        <div id="modalDescription" class="modal-Description"></div>
        <div id="modalDefeito" class="modal-Defeito"></div>
        <div id="modalObservacoes" class="modal-Observacoes"></div>
        <div id="modalTotal" class="modal-Total"></div>
        <div id="modalDesconto" class="modal-Total"></div>
        <div id="modalValorFaturado" class="modal-ValorFaturado"></div>
    </div>
    <div class="modal-footer">
        <?php
        //if ($this->permission->checkPermission($this->session->userdata('permissao'), 'vOs')) {
        echo '<a id="modalIdVisualizar" style="margin-right: 1%" href="" class="btn tip-top" title="Ver mais detalhes"><i class="fas fa-eye"></i></a>';
        //}
        //if ($this->permission->checkPermission($this->session->userdata('permissao'), 'eOs')) {
        echo '<a id="modalIdEditar" style="margin-right: 1%" href="" class="btn btn-info tip-top" title="Editar OS"><i class="fas fa-edit"></i></a>';
        //}
        //if ($this->permission->checkPermission($this->session->userdata('permissao'), 'dOs')) {
        echo '<a id="linkExcluir" href="#modal-excluir-os" role="button" data-toggle="modal" os="" class="btn btn-danger tip-top" title="Excluir OS"><i class="fas fa-trash-alt"></i></a>  ';
        //}
        ?>
    </div>
</div>

<!-- Modal Excluir Os -->
<div id="modal-excluir-os" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <form action="/os/excluir" method="post">
        <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
            <h5 id="myModalLabel">Excluir OS</h5>
        </div>
        <div class="modal-body">
            <input type="hidden" id="modalIdExcluir" name="id" value="" />
            <h5 style="text-align: center">Deseja realmente excluir esta OS?</h5>
        </div>
        <div class="modal-footer" style="display:flex;justify-content: center">
            <button class="button btn btn-warning" data-dismiss="modal" aria-hidden="true"><span class="button__icon"><i class="bx bx-x"></i></span><span class="button__text2">Cancelar</span></button>
            <button class="button btn btn-danger"><span class="button__icon"><i class='bx bx-trash'></i></span> <span class="button__text2">Excluir</span></button>
        </div>
    </form>
</div>

<!-- Modal Estoque -->
<!-- <div id="atualizar-estoque" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <form action="/produtos/atualizar_estoque" method="post" id="formEstoque">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                <h5 id="myModalLabel"><i class="fas fa-plus-square"></i> Atualizar Estoque</h5>
            </div>
            <div class="modal-body">
                <div class="control-group">
                    <label for="estoqueAtual" class="control-label">Estoque Atual</label>
                    <div class="controls">
                        <input id="estoqueAtual" type="text" name="estoqueAtual" value="" readonly />
                    </div>
                </div>

                <div class="control-group">
                    <label for="estoque" class="control-label">Adicionar Produtos<span class="required">*</span></label>
                    <div class="controls">
                        <input type="hidden" id="idProduto" class="idProduto" name="id" value="" />
                        <input id="estoque" type="text" name="estoque" value="" />
                    </div>
                </div>
            </div>
            <div class="modal-footer" style="display:flex;justify-content: center">
                <button class="button btn btn-warning" data-dismiss="modal" aria-hidden="true"><span class="button__icon"><i class="bx bx-x"></i></span><span class="button__text2">Cancelar</span></button>
                <button class="button btn btn-primary"><span class="button__icon"><i class="bx bx-sync"></i></span><span class="button__text2">Atualizar</span></button>
            </div>
        </form>
    </div> -->

<script src="{{ asset('js/jquery.validate.js') }}"></script>
<!-- Modal Estoque-->
<!-- <script type="text/javascript">
        $(document).ready(function() {
            $(document).on('click', 'a', function(event) {
                var produto = $(this).attr('produto');
                var estoque = $(this).attr('estoque');
                $('.idProduto').val(produto);
                $('#estoqueAtual').val(estoque);
            });

            $('#formEstoque').validate({
                rules: {
                    estoque: {
                        required: true,
                        number: true
                    }
                },
                messages: {
                    estoque: {
                        required: 'Campo Requerido.',
                        number: 'Informe um número válido.'
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

            var srcCalendarEl = document.getElementById('source-calendar');
            var srcCalendar = new FullCalendar.Calendar(srcCalendarEl, {
                locale: 'pt-br',
                height: 500,
                editable: false,
                selectable: false,
                businessHours: true,
                dayMaxEvents: true, // allow "more" link when too many events
                displayEventTime: false,
                events: {
                    url: "/calendario",
                    method: 'GET',
                    extraParams: function() { // a function that returns an object
                        return {
                            status: $("#statusOsGet").val(),
                        };
                    },
                    failure: function() {
                        alert('Falha ao buscar OS de calendário!');
                    },
                },
                eventClick: function(info) {
                    var eventObj = info.event.extendedProps;
                    $('#modalId').html(eventObj.id);
                    $('#modalIdVisualizar').attr("href", "/os/visualizar/" + eventObj.id);
                    if (eventObj.editar) {
                        $('#modalIdEditar').show();
                        $('#linkExcluir').show();
                        $('#modalIdEditar').attr("href", "/os/editar/" + eventObj.id);
                        $('#modalIdExcluir').val(eventObj.id);
                    } else {
                        $('#modalIdEditar').hide();
                        $('#linkExcluir').hide();
                    }
                    $('#modalCliente').html(eventObj.cliente);
                    $('#modalDataInicial').html(eventObj.dataInicial);
                    $('#modalDataFinal').html(eventObj.dataFinal);
                    $('#modalGarantia').html(eventObj.garantia);
                    $('#modalStatus').html(eventObj.status);
                    $('#modalDescription').html(eventObj.description);
                    $('#modalDefeito').html(eventObj.defeito);
                    $('#modalObservacoes').html(eventObj.observacoes);
                    $('#modalTotal').html(eventObj.total);
                    $('#modalDesconto').html(eventObj.desconto);
                    $('#modalValorFaturado').html(eventObj.valorFaturado);

                    $('#eventUrl').attr('href', event.url);
                    $('#calendarModal').modal();
                },
            });

            srcCalendar.render();

            $('#btn-calendar').on('click', function() {
                srcCalendar.refetchEvents();
            });
        });
    </script> -->
@endsection