@extends('layouts/app')

@section('content')

<style>
    select {
        width: 70px;
    }

    .scrollable-container {
        height: 400px;
        /* Altura fixa da div */
        overflow-y: auto;
        /* Adiciona rolagem vertical quando necessário */
    }
</style>
<div style="height: 90vh; width: 99vw;">
    <div class="new122" style="margin: 1% 1% 0 7%;">
        <div class="widget-title" style="margin: -20px 0 0">
            <span class="icon">
                <i class="fas fa-user"></i>
            </span>
            <h5>Garantias</h5>
        </div>

        <div class="widget-box">
            <h5 style="padding: 3px 0"></h5>
            <div class="widget-content nopadding tab-content scrollable-container">
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