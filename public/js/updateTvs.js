async function  sumTvsTotalValue(element) {
  const id = element.getAttribute('data-tv-id')
  const quantity = element.value
  const price = document.getElementById(`price-tv-${id}`).textContent.replace('R$ ', '')
  const totalPrice = document.getElementById(`tv-total-id-${id}`)
  totalPrice.innerText = `R$ ${quantity * price }`
  sumAllTvsPrices()
  sumTotalBudget()
  await updateTvQuantityOnDB(id, quantity)
}

function sumAllTvsPrices() {
  const tbody = document.getElementById('tvs-tbody')
  const tvIds = tbody.getAttribute('data-tv-ids').split(',')
  let total = 0
  for (const tvId of tvIds) {
    const price = document.getElementById(`price-tv-${tvId}`).textContent.replace('R$ ', '')
    const quantity = document.querySelector(`.tv-quantity-${tvId}`).value
    total += price * quantity;
  }

  const tvsTotal = document.getElementById('tvs-total');
  tvsTotal.innerText = total
}

async function updateTvQuantityOnDB(tvId, quantity) {
  const budgetCpf = localStorage.getItem('cpf')
  const data = {
    'cpf': budgetCpf,
    'tvId': tvId,
    'quantity': quantity
  }
  await fetch('/api/update-tv-quantity', {
    headers: {
      "Content-Type": "application/json",
    },
    method: 'POST',
    body: JSON.stringify(data)

  }).catch((error) => {
    console.error("Error:", error);
  })
}

