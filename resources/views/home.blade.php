<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="icon" href="{{ url('/img/favicon.png') }}">
  <link rel="stylesheet" type="text/css" href="{{ url('css/app.css') }}">

  <!-- Fonts -->
  <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400&display=swap" rel="stylesheet">

  <title>Escalar Midia Indoor - Orçamento por licença</title>
  <script>
    const plans = @json($plans);
  </script>
</head>

<body>
  <header>
    <div class="logo">
      <a href="#"><img width="150px" src="{{ url('/img/logo.png') }}" alt="logo"></a>
    </div>
    <h1 class="title">Planilha de orçamento Midia Indoor por licença</h1>
  </header>
  <div class="subtitle">
    Instruções: siga a sequência TVs, Players, Mão de Obra, Formas de Pamagento, Quantidade de Licenças e Planos,
    alterando as células em verde com a quantidade e o valor adequado e será gerado o orçamento na planilha abaixo:
  </div>

  <div class="wrapper">
    <div class="col-12 col-6">
      <div class="tv">
        <table class="table table-sm">
          <thead>
            <tr>
              <th>Quant</th>
              <th>TVs</th>
              <th>Valor Unitário</th>
              <th>Valor Total</th>
            </tr>
          </thead>
          <tbody id="tvs-tbody" data-tv-ids="{{$tvsIds}}">
            @foreach ($tvs as $tv)
            <tr>
              <td>
                <input class="table-inner-input tv-quantity-{{$tv['id']}}" data-tv-id="{{ $tv['id'] }}" onchange="sumTvsTotalValue(this)" type="number" value="0">
              </td>
              <td>{{ $tv['name'] }}</td>
              <td id="price-tv-{{ $tv['id']}}">
                {{ isset($tv['price']) ? 'R$ ' . $tv['price'] : 0 }}
              </td>
              <td id="tv-total-id-{{ $tv['id'] }}">R$ {{ $tv['total'] ?? '' }}</td>
              @endforeach
            </tr>
            <tr>
              <td></td>
              <td></td>
              <td></td>
              <td class="bg-primary-500">R$ <strong id="tvs-total"></strong></td>
            </tr>
          </tbody>
        </table>
      </div>
    </div>
    <div class=" col-6" >
      <div class="row">
        <table class="table" style="margin-bottom: 8px">
          <thead>
            <tr>
              <th>Quant.</th>
              <th>Player</th>
              <th>Valor Unitário</th>
              <th>Valor Total</th>
            </tr>
          </thead>
          <tbody id="players-tbody" data-player-ids="{{$playersIds}}">
            @foreach ($players as $player)
            <tr>
              <td><input data-player-id="{{$player['id']}}" onchange="sumPlayersTotalValue(this)" class="table-inner-input player-quantity-{{$player['id']}}" type="number" value="0"></td>
              <td>{{ $player['name'] }}</td>
              <td id="price-player-{{$player['id']}}">{{ isset($player['price']) ? 'R$ ' . $player['price'] : 'R$ ' . 0 }}</td>
              <td id="player-total-id-{{$player['id']}}">R$ {{ $player['total'] ?? 0 }}</td>
              @endforeach
            </tr>
            <tr>
              <td></td>
              <td></td>
              <td></td>
              <td class="bg-primary-500">R$ <strong id="players-total"></strong></td>
            </tr>
          </tbody>
        </table>
      </div>
      <div class="row">
        <div class=" col-6 column">
          <div class="licenses">
            <span class="subtitle">Quantidade de Licensas</span>
            <select onchange="syncLicenses()" name="licenses" id="licenses">
              <option value="0">0</option>
              <option value="1">1</option>
              <option value="10">10</option>
              <option value="20">20</option>
              <option value="30">30</option>
              <option value="40">40</option>
              <option value="50">60</option>
              <option value="100">100</option>
            </select>
          </div>
          <div class="payment">
            <span class="subtitle">Forma de Pagamento</span>
            <select onchange="getPlans(plans, this.value)" name="payment" id="payment">
              <option value="Mensal">Mensal</option>
              <option value="Anual">Anual</option>
            </select>
          </div>
          <div class="manpower">
            <span class="subtitle">Mão de Obra de Instalação</span>
            <input onchange="sumTotalBudget()" value="0" type="number" class="manpower-input" placeholder="R$ 2.000,00">
          </div>
        </div>
        <div class="col-6">
          <div class="plans-pricing column text-center">
            <span class="subtitle">Valores dos Planos / Mês</span>
            @foreach($plans as $plan)
            <div class="flex">
              <span>{{$plan['name']}}</span>
              <span>R$ {{$plan['monthly_price']}}</span>
            </div>
            @endforeach
            <span class="subtitle">
              Link para tabela e descrição dos planos
            </span>
            <div><a class="link" target="_blank" href="https://midiaindoor.tv.br/tabelas/pp/">https://midiaindoor.tv.br/tabelas/pp/</a>
            </div>
          </div>
        </div>
      </div>



    </div>
    <div class="row">
      <div class="col-6">
        <div class="subtitle">
          Orçamento
        </div>
        <div class="flex subtitle bg-primary-500 justify-between">
          <span>Investimento Inicial</span>
          <span>Mensalidade</span>
        </div>
        <div class="flex">

          <div class="budget flex  justify-between">
            <span>R$</span>
            <span class="" id="initialInvest">{{$budget['total_price']}}</span>
          </div>
          <div class="budget flex  justify-between">
            <span>R$</span>
            <span id="instalmentPrice">{{$budget['instalment_price']}}</span>
          </div>
        </div>
      </div>
      <div class="col-6">
        <div class="row wrap bg-primary-400">
          <div class="subtitle  row"><span class="text-center">Planos</span></div>
          <table class="table ">
            <thead>
              <tr>
                <th>Quant.</th>
                <th>Plano</th>
                <th>Valor Unitário</th>
                <th>Valor Total</th>
              </tr>
              <tr>
                <td><input type="number" onchange="updatePlans()" id="plans-qnt-input" class="table-inner-input text-white"></td>
                <td><select class="plan-qnt-select">
                    @foreach ($plans as $plan)
                    <option value="{{ $plan['name'] }}">{{ $plan['name'] }}</option>
                    @endforeach
                  </select></td>
                <td id="plan-price"> R$ {{ $plan['monthly_price']}}</td>
                <td >R$ <strong id="plan-total-price">0</strong></td>
              </tr>
            </thead>
          </table>
        </div>
      </div>
    </div>
  </div>


  <div class="grphic">
    <canvas id="myChart"></canvas>
  </div>

  <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

  <script src="{{ url('/js/updateTvs.js') }}"></script>
  <script src="{{ url('/js/updatePlayers.js') }}"></script>
  <script src="{{ url('/js/sumTotalBudget.js') }}"></script>
  <script src="{{ url('/js/updatePlans.js') }}"></script>
  <script src="{{ url('/js/chartHandler.js') }}"></script>

  <script>
    window.onload = () => {
      const cpf = @json($budget->cpf);
      localStorage.setItem('cpf', cpf)
      sumAllTvsPrices()
      sumAllPlayersPrices()
      sumTotalBudget()
    }
    function onlyNumbers(e) {

    }
  </script>

</body>

</html>
