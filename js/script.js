document.addEventListener('DOMContentLoaded', function () {
    const paymentList = document.getElementById('paymentList');
    const total = document.getElementById('total');
    let totalAmount = 0;
  
    paymentList.addEventListener('click', function (event) {
      event.preventDefault();
      const target = event.target;
      if (target.tagName.toLowerCase() === 'a') {
        const priceElement = target.nextElementSibling;
        const price = parseFloat(priceElement.textContent.substring(1));
        totalAmount += price;
        total.innerHTML = `<b>$${totalAmount.toFixed(2)}</b>`;
      }
    });
  });
  