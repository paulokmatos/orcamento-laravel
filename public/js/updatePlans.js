const plansQuantity = document.getElementById('plans-qnt-input')
function updatePlans() {
  const plansTotalBudget = document.getElementById('plan-total-price')
  const planPrice = document.getElementById('plan-price').innerText.replace('R$ ', '')

  plansTotalBudget.innerText = parseInt(planPrice) * plansQuantity.value
  sumTotalBudget()
}

function getPlans(plans, payment) {
  console.log(payment)

  const plansPriceTable = document.getElementById('plans-pricing-table')
  plans.forEach(plan => {
    plansPriceTable.innerHTML = `
    <div  class="flex">
        <span>${plan.name}</span>
        <span>R$ ${payment === 'Anual' ? plan.annual_price : plan.monthly_price}</span>
    </div>
   `
    plansPriceTable.innerText = ''
    console.log(plan)
  })

}
function syncLicenses() {
  plansQuantity.value = document.getElementById('licenses').value
  plansQuantity.dispatchEvent(new Event('change'))


}
