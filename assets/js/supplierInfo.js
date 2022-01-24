document
    .getElementById('supplier_information_exchangeRate')
    .addEventListener('blur', () => {
        const amount = document
            .getElementById('supplier_information_dueAmount').value;
        const exchangeRate = document.getElementById('supplier_information_exchangeRate').value;
        document.getElementById('supplier_information_dueDollarsAmount').value = Math.round(amount * exchangeRate);
    });
