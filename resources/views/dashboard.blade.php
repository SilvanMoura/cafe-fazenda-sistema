<!DOCTYPE html>
<html lang="pt-br">

<head>
    <title>Dashboard - Café da Fazenda</title>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="shortcut icon" type="image/png" href="{{ asset('images/cafe-fazenda-logo-sistema.png') }}" />
    <link rel="stylesheet" href="{{ asset('css/bootstrap.min.css') }}" />
    <link rel="stylesheet" href="{{ asset('css/bootstrap-responsive.min.css') }}" />
    <link rel="stylesheet" href="{{ asset('css/matrix-style.css') }}" />
    <link rel="stylesheet" href="{{ asset('css/matrix-media.css') }}" />
    <link href="{{ asset('font-awesome/css/font-awesome.css') }}" rel="stylesheet" />
    <link rel="stylesheet" href="{{ asset('css/fullcalendar.css') }}" />

    <link rel="stylesheet" href=" {{asset('css/tema-white.css')}} " />

    <link href='https://fonts.googleapis.com/css?family=Open+Sans:400,700,800' rel='stylesheet' type='text/css'>
    <link href='https://fonts.googleapis.com/css2?family=Roboto+Condensed:wght@300;400;500;700&display=swap' rel='stylesheet' type='text/css'>
    <link href='https://unpkg.com/boxicons@2.1.1/css/boxicons.min.css' rel='stylesheet'>
    <script type="text/javascript" src="{{ asset('js/jquery-1.12.4.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('js/shortcut.js') }}"></script>
    <script type="text/javascript" src="{{ asset('js/funcoesGlobal.js') }}"></script>
    <script type="text/javascript" src="{{ asset('js/datatables.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('js/sweetalert.min.js') }}"></script>
    <script type="text/javascript">
        shortcut.add("escape", function() {
            location.href = '/';
        });
        // Add other shortcut functions here...
        window.BaseUrl = "/";
    </script>

    <script language="javascript" type="text/javascript" src="{{ asset('js/dist/jquery.jqplot.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('js/dist/plugins/jqplot.pieRenderer.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('js/dist/plugins/jqplot.donutRenderer.min.js') }}"></script>
    <script src="{{ asset('js/fullcalendar.min.js')}}"></script>
    <script src="{{ asset('js/fullcalendar/locales/pt-br.js') }}"></script>

    <link href="{{ asset('css/fullcalendar.min.css') }}" rel='stylesheet' />
    <link rel="stylesheet" type="text/css" href="{{ asset('js/dist/jquery.jqplot.min.css') }}" />

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@300;400&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Orbitron:wght@400;500;600;700&display=swap" rel="stylesheet">

    <script src="https://cdn.jsdelivr.net/npm/chart.js@3.7.0/dist/chart.min.js"></script>

    <!-- Inclua o Bootstrap JS -->
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
</head>

<body>
    <!--top-Header-menu-->
    <div class="navebarn">
        <div id="user-nav" class="navbar navbar-inverse">
            <ul class="nav">
                <!-- Perfil -->
                <li class="dropdown">
                    <a href="#" class="tip-right dropdown-toggle" data-toggle="dropdown" title="Perfis">
                        <i class='bx bx-user-circle iconN'></i><span class="text"></span>
                    </a>
                    <ul class="dropdown-menu">
                        <li><a title="Área do Cliente" href="/mine" target="_blank">Área do Cliente</a></li>
                        <li><a title="Meu Perfil" href="mapos/minhaConta">Meu Perfil</a></li>
                        <li class="divider"></li>
                        <li><a title="Sair do Sistema" href="login/sair"><i class='bx bx-log-out-circle'></i>Sair do Sistema</a></li>
                    </ul>
                </li>
                <!-- Relatórios -->
                <li class="dropdown">
                    <a href="#" class="tip-right dropdown-toggle" data-toggle="dropdown" title="Relatórios">
                        <i class='bx bx-pie-chart-alt-2 iconN'></i><span class="text"></span>
                    </a>
                    <ul class="dropdown-menu">
                        <li><a href="relatorios/clientes">Clientes</a></li>
                        <li><a href="relatorios/produtos">Produtos</a></li>
                        <li><a href="relatorios/servicos">Serviços</a></li>
                        <li><a href="relatorios/os">Ordens de Serviço</a></li>
                        <li><a href="relatorios/vendas">Vendas</a></li>
                        <li><a href="relatorios/financeiro">Financeiro</a></li>
                        <li><a href="relatorios/sku">SKU</a></li>
                        <li><a href="relatorios/receitasBrutasMei">Receitas Brutas - MEI</a></li>
                    </ul>
                </li>
                <!-- Configurações -->
                <li class="dropdown">
                    <a href="#" class="tip-right dropdown-toggle" data-toggle="dropdown" title="Configurações">
                        <i class='bx bx-cog iconN'></i><span class="text"></span>
                    </a>
                    <ul class="dropdown-menu">
                        <li><a href="mapos/configurar">Sistema</a></li>
                        <li><a href="usuarios">Usuários</a></li>
                        <li><a href="mapos/emitente">Emitente</a></li>
                        <li><a href="permissoes">Permissões</a></li>
                        <li><a href="auditoria">Auditoria</a></li>
                        <li><a href="mapos/emails">Emails</a></li>
                        <li><a href="mapos/backup">Backup</a></li>
                    </ul>
                </li>
            </ul>
        </div>
    </div>

    <!-- New User -->
    <div id="userr" style="margin-top: -20px;padding-right: 45px;display:flex;flex-direction:column;align-items:flex-end;justify-content:center;">
        <div class="user-names userT0">
            <?php
            function saudacao()
            {
                $hora = date('H');
                if ($hora >= 8 && $hora < 12) {
                    return 'Bom dia, ';
                } elseif ($hora >= 12 && $hora < 18) {
                    return 'Boa tarde, ';
                } else {
                    return 'Boa noite, ';
                }
            }

            $login = '';
            echo saudacao($login); // Irá retornar conforme o horário
            ?>
        </div>
        <div class="userT">admin</div>

        <section style="display:block;position:absolute;right:10px">
            <div class="profile">
                <div class="profile-img">
                    <a href="/minhaConta">
                        <img src="{{ asset('images/User.png') }}" alt="">
                    </a>
                </div>
            </div>
        </section>
    </div>
    <!-- End User -->


    <!--start-top-serch-->
    <div style="display: none" id="search">
        <form action="mapos/pesquisar">
            <input type="text" name="termo" placeholder="Pesquisar..." />
            <button type="submit" class="tip-bottom" title="Pesquisar"><i class="fas fa-search fa-white"></i></button>
        </form>
    </div>
    <!--close-top-serch-->








    <!--sidebar-menu-->
    <nav id="sidebar" class="menu-closed">

        <a href="#" class="visible-phone">
            <div class="mode">
                <div class="moon-menu">
                    <i class='bx bx-chevron-right iconX open-2'></i>
                    <i class='bx bx-chevron-left iconX close-2'></i>
                </div>
            </div>
        </a>
        <!-- Start Pesquisar-->
        <li class="search-box">
            <form style="display: flex" action="pesquisar">
                <button style="background:transparent;border:transparent" type="submit" class="tip-bottom" title="">
                    <i class='bx bx-search iconX'></i></button>
                <input style="background:transparent; color:#313030;border:transparent" type="search" name="termo" placeholder="Pesquise aqui...">
                <span class="title-tooltip">Pesquisar</span>
            </form>
        </li>
        <!-- End Pesquisar-->

        <div class="menu-bar">
            <div class="menu">

                <ul class="menu-links" style="position: relative;">
                    <li class="<?php if (isset($menuPainel)) {
                                    echo 'active';
                                }; ?>">
                        <a class="tip-bottom" title="" href="/dashboard"><i class='bx bx-home-alt iconX'></i>
                            <span class="title nav-title">Home</span>
                            <span class="title-tooltip">Início</span>
                        </a>
                    </li>

                    <li class="<?php if (isset($menuClientes)) {
                                    echo 'active';
                                }; ?>">
                        <a class="tip-bottom" title="" href="clientes">
                            <i class='bx bx-user iconX'></i>
                            <span class="title">Cliente / Fornecedor</span>
                            <span class="title-tooltip">Clientes</span>
                        </a>
                    </li>

                    <li class="<?php if (isset($menuProdutos)) {
                                    echo 'active';
                                } ?>">
                        <a class="tip-bottom" title="Produtos" href="produtos">
                            <i class="bx bx-basket iconX"></i>
                            <span class="title">Produtos</span>
                            <span class="title-tooltip">Produtos</span>
                        </a>
                    </li>


                    <li class="<?php if (isset($menuServicos)) {
                                    echo 'active';
                                } ?>">
                        <a class="tip-bottom" title="Serviços" href="servicos">
                            <i class='bx bx-wrench iconX'></i>
                            <span class="title">Serviços</span>
                            <span class="title-tooltip">Serviços</span>
                        </a>

                    </li>


                    <li class="<?php if (isset($menuVendas)) {
                                    echo 'active';
                                } ?>">
                        <a class="tip-bottom" title="Vendas" href="vendas">
                            <i class='bx bx-cart-alt iconX'></i>
                            <span class="title">Vendas</span>
                            <span class="title-tooltip">Vendas</span>
                        </a>

                    </li>


                    <li class="<?php if (isset($menuOs)) {
                                    echo 'active';
                                } ?>">
                        <a class="tip-bottom" title="Ordens de Serviço" href="os">
                            <i class='bx bx-file iconX'></i>
                            <span class="title">Ordens de Serviço</span>
                            <span class="title-tooltip">Ordens</span>
                        </a>

                    </li>


                    <li class="<?php if (isset($menuGarantia)) {
                                    echo 'active';
                                } ?>">
                        <a class="tip-bottom" title="Termos de Garantias" href="garantias">
                            <i class='bx bx-receipt iconX'></i>
                            <span class="title">Termos de Garantias</span>
                            <span class="title-tooltip">Garantias</span>
                        </a>


                    </li>


                    <li class="<?php if (isset($menuArquivos)) {
                                    echo 'active';
                                } ?>">
                        <a class="tip-bottom" title="Arquivos" href="arquivos">
                            <i class="bx bx-box iconX"></i>
                            <span class="title">Arquivos</span>
                            <span class="title-tooltip">Arquivos</span>
                        </a>

                    </li>


                    <li class="<?php if (isset($menuLancamentos)) {
                                    echo 'active';
                                } ?>">
                        <a class="tip-bottom" title="Lançamentos" href="financeiro/lancamentos">
                            <i class="bx bx-bar-chart-alt-2 iconX"></i>
                            <span class="title">Lançamentos</span>
                            <span class="title-tooltip">Lançamentos</span>
                        </a>
                    </li>

                    <li class="<?php if (isset($menuCobrancas)) {
                                    echo 'active';
                                }; ?>">
                        <a class="tip-bottom" title="" href="cobrancas/cobrancas"><i class='bx bx-dollar-circle iconX'></i>
                            <span class="title">Cobranças</span>
                            <span class="title-tooltip">Cobranças</span>
                        </a>
                    </li>
                </ul>
            </div>

            <div class="botton-content">
                <li class="">
                    <a class="tip-bottom" title="" href="login/sair">
                        <i class='bx bx-log-out-circle iconX'></i>
                        <span class="title">Sair</span>
                        <span class="title-tooltip">Sair</span>
                    </a>
                </li>
            </div>
        </div>
    </nav>
    <!--End sidebar-menu-->

    <div id="content">
        <!--start-top-serch-->
        <div id="content-header">
            <div></div>
            <div id="breadcrumb">
                <a href="/" title="" class="tip-bottom">Início</a>

                @if(request()->segment(1) !== null)
                <a href="{{ '/' . request()->segment(1) }}" class="tip-bottom" title="{{ ucfirst(request()->segment(1)) }}">
                    {{ ucfirst(request()->segment(1)) }}
                </a>

                @if(request()->segment(2) !== null)
                <a href="{{ '/' . request()->segment(1) . '/' . request()->segment(2) . '/' . request()->segment(3) }}" class="current tip-bottom" title="{{ ucfirst(request()->segment(2)) }}">
                    {{ ucfirst(request()->segment(2)) }}
                </a>
                @endif
                @endif
            </div>

        </div>
        <div class="container-flu">
            <div class="row-fluid">

                <div class="span12">
                    @if($var = session()->get('success'))
                    <script>
                        swal("Sucesso!", "<?php echo str_replace('"', '', $var); ?>", "success");
                    </script>
                    @endif

                    @if($var = session()->get('error'))
                    <script>
                        swal("Falha!", "<?php echo str_replace('"', '', $var); ?>", "error");
                    </script>
                    @endif

                    @isset($view)
                    {{ view($view)->render() }}
                    @endisset
                </div>
            </div>
        </div>
    </div>






















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
                <a href="/vendas">
                    <div class="numbers N-tittle">Vendas</div>
                </a>
            </div>
            <a href="/vendas">
                <div class="lord-icon05">
                    <i class='bx bx-cart-alt iconBx05'></i></span>
                </div>
            </a>
        </li>

        <li class="card">
            <div class="grid-blak">
                <a href="/financeiro/lancamentos">
                    <div class="numbers">Lançamentos</div>
                </a>
            </div>
            <a href="/financeiro/lancamentos">
                <div class="lord-icon06">
                    <i class="bx bx-bar-chart-alt-2 iconBx06"></i>
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

                        <a href="/servicos/adicionar" class="card tip-top" title="Adicionar serviços">
                            <div><i class='bx bxs-stopwatch iconBx3'></i></div>
                            <div>
                                <div class="cardName2">{{ $dashboard['osServicoNumber'] }}</div>
                                <div class="cardName">Serviços</div>
                            </div>
                        </a>

                        <a href="/servicos/adicionar" class="card tip-top" title="Adicionar serviços">
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

                        <a href="/garantias" class="card tip-top" title="Adicionar garantia">
                            <div><i class='bx bxs-receipt iconBx6'></i></div>
                            <div>
                                <div class="cardName2">{{ $dashboard['garantiasNumber'] }}</div>
                                <div class="cardName">Garantias</div>
                            </div>
                        </a>

                        <a href="/vendas/adicionar" class="card tip-top" title="Adicionar Vendas">
                            <div><i class='bx bxs-cart-alt iconBx5'></i></div>
                            <div>
                                <div class="cardName2">{{ $dashboard['maquinaNumber'] }}</div>
                                <div class="cardName">Máquinas</div>
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





































































    <div class="row-fluid" style="display: flex; flex-direction: column;">
        <div id="footer" class="span12">
            <a class="pecolor" href="https://github.com/SilvanMoura" target="_blank">
                <?= date('Y'); ?> &copy; Silvan Moura - Café da Fazenda - Versão: 1.0
            </a>
        </div>
    </div>
    <!--end-Footer-part-->
    <script src="{{ asset('js/matrix.js') }}"></script>
</body>
<script type="text/javascript">
    $(document).ready(function() {
        var dataTableEnabled = '1';
        if (dataTableEnabled == '1') {
            $('#tabela').dataTable({
                "ordering": false,
                "language": {
                    "url": "{{ asset('js/dataTable_pt-br.json') }}"
                }
            });
        }
    });
</script>

</html>