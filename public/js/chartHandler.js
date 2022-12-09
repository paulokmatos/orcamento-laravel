const ctx = document.getElementById('myChart');
const labels = [
  '1º Mês',
  '2º Mês',
  '3º Mês',
  '4º Mês',
  '5º Mês',
  '6º Mês',
  '7º Mês',
  '8º Mês',
  '9º Mês',
  '10º Mês',
  '11º Mês',
  '12º Mês',
]
function getChartData () {
  const initialInvest = document.getElementById('initialInvest').innerText
  const instalment = document.getElementById('instalmentPrice').innerText.replace('R$ ', '')
  const chartDataset = []


  for (let i = 0; i < labels.length; i++) {
    if(i === 0) {
      chartDataset.push(parseInt(initialInvest))
      continue
    }
    chartDataset.push(parseInt(instalment))
  }
  return chartDataset
}




const config = {
  type: 'bar',
  data: {
    labels: labels,
    datasets: [{
      label: '',
      data: [],
      borderWidth: 1,
      backgroundColor: '#4f81bd'
    }]
  },
  options: {
    scales: {
      y: {
        beginAtZero: true
      }
    }
  }
}

const chart = new Chart(ctx, config);


function updateChart() {
  chart.data.datasets[0].data = getChartData()
  chart.update()
}
