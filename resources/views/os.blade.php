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
            <h5>Ordens de Serviço</h5>
        </div>
        <!-- php if ($this->permission->checkPermission($this->session->userdata('permissao'), 'aCliente')) { ?> -->
        <a href="servico/adicionar" class="button btn btn-mini btn-success" style="max-width: 165px">
            <span class="button__icon"><i class='bx bx-plus-circle'></i></span><span class="button__text2">
                Ordem de Serviço
            </span>
        </a>
        <!-- ?php } ?> -->

        <div class="widget-box">
            <h5 style="padding: 3px 0"></h5>
            <div class="widget-content nopadding tab-content scrollable-container">
                <table id="tabela" class="table table-bordered ">
                    <thead>
                        <tr>
                            <th>Id</th>
                            <th>Nome</th>
                            <th>Máquina</th>
                            <th>Status</th>
                            <th>Tipo</th>
                            <th>Avaliação</th>
                            <th>Valor</th>
                            <th>Data Entrega</th>
                            <th>Garantia</th>
                        </tr>
                    </thead>
                    <tbody>


                        @if($getOS->count() > 0)
                        @foreach ($getOS as $r)
                        <tr>

                            <td style="width:5%;">{{ $r->id }}</td>
                            <td style="width:25%;"><a href="{{ 'clientes/visualizar/'.$r->id }}">{{ $r->cliente_id }}</a></td>
                            <td style="width:12%;"><a href="{{ 'clientes/visualizar/'.$r->id }}">{{ $r->maquina_id }}</a></td>
                            <td style="width:10%;"><a href="{{ 'clientes/visualizar/'.$r->id }}">{{ $r->status_os_id }}</a></td>
                            <td style="width:6%;"><a href="{{ 'clientes/visualizar/'.$r->id }}">{{ $r->operacao_os_id }}</a></td>
                            <td style="width:6%;"><a href="{{ 'clientes/visualizar/'.$r->id }}">{{ $r->data_avaliacao }}</a></td>
                            <td style="width:7%;"><a href="{{ 'clientes/visualizar/'.$r->id }}">R$ {{ $r->valor_os }}</a></td>

                            <td style="width:8%;"><a href="{{ 'clientes/visualizar/'.$r->id }}">{{ $r->data_entrega }}</a></td>
                            @if( $r->garantia != null)
                            <td style="width:9%;"><a href="{{ 'clientes/visualizar/'.$r->id }}"> {{ $r->garantiaFinalData }}</a></td>
                            @else
                            <td style="width:9%;"><a href="{{ 'clientes/visualizar/'.$r->id }}">sem garantia</a></td>
                            @endif
                            <td style="width:6%;">
                                <a href="{{ 'clientes/visualizar/'. $r->id }}" class="btn-nwe" title="Ver mais detalhes"><i class="bx bx-show bx-xs"></i></a>
                                <a href="{{ 'clientes/editar/'. $r->id }}" class="btn-nwe3" title="Editar Cliente"><i class="bx bx-printer bx-xs"></i></a>
                            </td>
                        </tr>
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