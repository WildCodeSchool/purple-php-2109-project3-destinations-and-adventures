document
    .getElementById('financial_info_total')
    .addEventListener('blur', () => {
        const numberOfTravelers = document
            .getElementById('financial_info_total')
            .getAttribute('data-travelers');

        const total = document.getElementById('financial_info_total').value;

        document.getElementById('financial_info_perPerson').value = total / numberOfTravelers;
        document.getElementById('financial_info_depositAmount').value = total * 0.35;

        let departure = document
            .getElementById('financial_info_total')
            .getAttribute('data-date');
        departure = new Date(departure);
        departure.setDate(departure.getDate() - 90);

        document.getElementById('financial_info_dueDepositDate').value = departure.toISOString().slice(0, 10);
    });
