async function sumTotalBudget() {
  const playersTotal = document.getElementById('players-total').innerText.replace('R$ ', '')
  const tvsTotal = document.getElementById('tvs-total').innerText.replace('R$ ', '')
  const manpowerCost = document.querySelector('.manpower-input').value.replace('R$ ', '')
  const planTotalValue = document.getElementById('plan-total-price').innerText.replace('R$ ', '')
  const totalBudget = parseInt(playersTotal) + parseInt(tvsTotal) +   parseInt(planTotalValue) + parseInt(manpowerCost)

  const initialInvestment = document.getElementById('initialInvest')
  initialInvestment.innerText = `${totalBudget},00`

  const instalmentPrice = document.getElementById('instalmentPrice')

  instalmentPrice.innerText = planTotalValue
  console.log(instalmentPrice.innerText)
  updateChart()
  await storeBudgetOnDB(totalBudget, instalmentPrice.innerText)
}


async function storeBudgetOnDB(totalPrice, instalmentPrice) {
  const budgetCpf = localStorage.getItem('cpf')
  const data = {
    'cpf': budgetCpf,
    'totalPrice': totalPrice,
    'instalmentPrice': instalmentPrice
  }
  await fetch('/api/store-budget', {
    headers: {
      "Content-Type": "application/json",
    },
    method: 'POST',
    body: JSON.stringify(data)

  }).catch((error) => {
    console.error("Error:", error);
  })
}


