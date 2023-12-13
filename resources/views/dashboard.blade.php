<!DOCTYPE html>
<html lang="pt-br">

<head>
    <title>Dashboard - Café da Fazenda</title>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="shortcut icon" type="image/png" href="{{ asset('images/favicon.png') }}" />
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
    <script type="text/javascript" src="{{ asset('js/bootstrap.min.js') }}"></script>
    <script type="text/javascript">
        shortcut.add("escape", function() {
            location.href = '/';
        });
        // Add other shortcut functions here...
        window.BaseUrl = "/";
    </script>
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

