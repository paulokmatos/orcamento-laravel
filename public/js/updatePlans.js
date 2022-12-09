const plansQuantity = document.getElementById('plans-qnt-input')
function updatePlans() {
  const plansTotalBudget = document.getElementById('plan-total-price')
  const planPrice = document.getElementById('plan-price').innerText.replace('R$ ', '')

  plansTotalBudget.innerText = parseInt(planPrice) * plansQuantity.value
  sumTotalBudget()
}

function syncLicenses() {
  plansQuantity.value = document.getElementById('licenses').value
  plansQuantity.dispatchEvent(new Event('change'))


}
