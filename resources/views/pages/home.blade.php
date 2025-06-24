@extends('layouts.app')

@section('title','Dashboard')

@section('content')
<div class="container mt-4">

    <div class="row mb-4 gx-2">
        <div class="card h-100 border" style="background: #fafafa;">
          <div class="card-body text-center py-2">
            <strong>Saldo Atual:</strong> R$ {{ number_format($saldo, 2, ',', '.') }}
          </div>
        </div>
    </div>

  <div class="row mb-4 gx-2">
    @foreach ([['title'=>'Veículos','count'=>$veiculos->count()],['title'=>'Clientes','count'=>$clientes->count()],['title'=>'Usuários','count'=>$users->count()],['title'=>'Locações','count'=>$locacoes->count()]] as $item)
      <div class="col-6 col-md-3">
        <div class="card h-100 border" style="background: #fafafa;">
          <div class="card-body text-center py-2">
            <h6 class="card-title mb-1 text-muted">{{ $item['title'] }}</h6>
            <p class="h4 mb-0">{{ $item['count'] }}</p>
          </div>
        </div>
      </div>
    @endforeach
  </div>

  {{-- Lista de veículos--}}
  <h5 class="mb-3">Veículos para locação</h5>
  <div class="row g-3">
    @foreach($veiculos as $veiculo)
      <div class="col-6 col-md-4 col-lg-3">
        <div class="card h-100 border" style="background: #fff;">
          <div class="card-body p-2">
            <h6 class="card-title mb-1">{{ $veiculo->modelo }}</h6>
            <small class="text-muted">{{ $veiculo->placa }}</small>
            <p class="mt-1 mb-0 small">R$ {{ number_format($veiculo->valor_diaria,2,',','.') }} / dia</p>
            <a href="{{ route('veiculos.show', $veiculo) }}" class="stretched-link"></a>
          </div>
        </div>
      </div>
    @endforeach
  </div>

  {{-- Tabela de locações recente simplificada --}}
  <h5 class="mt-4 mb-2">Locações Recentes</h5>
  <div class="table-responsive">
    <table class="table table-borderless align-middle">
      <thead>
        <tr class="text-muted small">
          <th>Cliente</th>
          <th>Carro</th>
          <th>Início</th>
          <th>Fim</th>
          <th>Custo</th>
        </tr>
      </thead>
      <tbody>
        @foreach($locacoes as $locacao)
          <tr>
            <td class="small">{{ $locacao->cliente->nome }}</td>
            <td class="small">{{ $locacao->veiculo->modelo }}</td>
            <td class="small">{{ $locacao->data_inicio->format('d/m/Y') }}</td>
            <td class="small">{{ $locacao->data_fim->format('d/m/Y') }}</td>
            <td class="small">R$ {{ number_format($locacao->valor_total,2,',','.') }}</td>
          </tr>
        @endforeach
      </tbody>
    </table>
  </div>
</div>
@endsection
