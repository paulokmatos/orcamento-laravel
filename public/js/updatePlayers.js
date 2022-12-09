async function  sumPlayersTotalValue(element  ) {
  const id = element.getAttribute('data-player-id')
  const quantity = element.value
  const price = document.getElementById(`price-player-${id}`).textContent.replace('R$ ', '')
  const totalPrice = document.getElementById(`player-total-id-${id}`)
  totalPrice.innerText = `R$ ${quantity * price }`
  sumAllPlayersPrices()
  sumTotalBudget()
  await updatePlayerQuantityOnDB(id, quantity)
}

function sumAllPlayersPrices() {
  const tbody = document.getElementById('players-tbody')
  const playersIds = tbody.getAttribute('data-player-ids').split(',')
  let total = 0
  for (const playerId of playersIds) {
    const price = document.getElementById(`price-player-${playerId}`).textContent.replace('R$ ', '')
    const quantity = document.querySelector(`.player-quantity-${playerId}`).value
    total += price * quantity;
  }

  const playersTotal = document.getElementById('players-total');
  playersTotal.innerText = total
}

async function updatePlayerQuantityOnDB(playerId, quantity) {
  const budgetCpf = localStorage.getItem('cpf')
  const data = {
    'cpf': budgetCpf,
    'playerId': playerId,
    'quantity': quantity
  }
  await fetch('/api/update-player-quantity', {
    headers: {
      "Content-Type": "application/json",
    },
    method: 'POST',
    body: JSON.stringify(data)

  }).catch((error) => {
    console.error("Error:", error);
  })
}
