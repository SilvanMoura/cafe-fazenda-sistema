@extends('layouts/app')

@section('content')

<style>
    select {
        width: 70px;
    }

    @media (min-width: 1370px) {
        .ajuste-cardbox {
            margin-top: -60% !important;
            margin-left: 1%;
        }
    }

    @media (max-width: 1369px) {
        .ajuste-cardbox {
            margin-top: 3% !important;
        }

        .ajuste-statisc {
            margin-left: 7vw;
            width: 80vw;
        }

        .display1366 {
            margin-left: -5%;
        }

        .ajuste-status {
            margin-left: 13%;
            width: 89vw;
        }

        .atalhos {
            margin-left: 14vw;
        }
    }

    @media (max-width: 485px) {
        .ajuste-statisc {
            width: 92%;
            margin-top: 5%;
        }

    }
</style>
<div class="ajuste-cardbox" style="margin-left: 9%; width: 89vw;">
    <div class="new122">
        <div class="widget-title" style="margin: -20px 0 0">
            <span class="icon">
                <i class="fas fa-user"></i>
            </span>
            <h5>Garantias</h5>
        </div>

        <div class="widget-box">
            <h5 style="padding: 3px 0"></h5>
            <div class="widget-content nopadding tab-content">
                <table id="tabela" class="table table-bordered ">
                    <thead>
                        <tr>
                            <th>Id</th>
                            <th>Cliente</th>
                            <th>Máquina</th>
                            <th>Data Avaliação</th>
                            <th>Data Entrega</th>
                            <th>Garantia Até</th>
                            <th>Valor</th>
                        </tr>
                    </thead>
                    <tbody>
                        @if($getOsAll->count() > 0)
                        @foreach($getOsAll as $r)
                        @if($r->garantiaFinalData != '')
                        <tr>
                            <td style="width:3%;">{{ $r->id }}</td>
                            <td style="width:40%;">{{ $r->cliente_id }}</td>
                            <td style="width:15%;">{{ $r->maquina_id }}</td>
                            <td style="width:10%;">{{ $r->data_avaliacao }}</td>
                            <td style="width:10%;">{{ $r->data_entrega }}</td>
                            <td style="width:10%;">{{ $r->garantiaFinalData }}</td>
                            <td style="width:10%;">R$ {{ $r->valor_os - $r->desconto }}</td>
                        </tr>
                        @endif
                        @endforeach
                        @else
                        <tr>
                            <td colspan="6">Nenhum OS Cadastrado</td>
                        </tr>
                        @endif

                    </tbody>
                </table>
            </div>
        </div>
        <!-- <php echo $this->pagination->create_links(); ?> -->

    </div>
</div>

@endsection