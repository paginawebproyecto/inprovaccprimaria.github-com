function confirmPaymentMethod() {
    const selectedMethod = document.querySelector('input[name="payment-method"]:checked').value;
    
    if (selectedMethod === 'nequi') {
        window.location.href = 'https://www.nequi.com.co/';
    } else if (selectedMethod === 'bancolombia') {
        window.location.href = 'https://www.bancolombia.com/';
    } else if (selectedMethod === 'efectivo') {
        alert("Has seleccionado pagar en efectivo. Puedes pagar al recibir tu pedido.");
    } else if (selectedMethod === 'otros-bancos') {
        window.location.href = 'https://www.pagos-otrosbancos.com/';
    } else {
        alert("Por favor, selecciona un método de pago.");
    }
}
