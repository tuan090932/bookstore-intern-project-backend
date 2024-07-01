document.addEventListener('DOMContentLoaded', function()
{
    flatpickr("#birth_date", {
        dateFormat: "d/m/Y",
        altFormat: "d/m/Y",
        allowInput: true
    });

    flatpickr("#death_date", {
        dateFormat: "d/m/Y",
        altFormat: "d/m/Y",
        allowInput: true
    });

    function autoInsertSlashes(input) {
        let value = input.value.replace(/\D/g, '');
        let finalValue = '';
        for (let i = 0; i < value.length && i < 8; i++) {
            if (i === 2 || i === 4) {
                finalValue += '/';
            }
            finalValue += value[i];
        }
        input.value = finalValue;
    }

    const birthDateInput = document.getElementById('birth_date');
    const deathDateInput = document.getElementById('death_date');

    birthDateInput.addEventListener('input', function() {
        autoInsertSlashes(birthDateInput);
    });

    deathDateInput.addEventListener('input', function() {
        autoInsertSlashes(deathDateInput);
    });

    const authorNameInput = document.getElementById('author_name');
    const nationalInput = document.getElementById('national');

    function capitalizeWords(input) {
        let words = input.value.split(' ');
        for (let i = 0; i < words.length; i++) {
            words[i] = words[i].charAt(0).toUpperCase() + words[i].slice(1).toLowerCase();
        }
        input.value = words.join(' ');
    }

    authorNameInput.addEventListener('input', function() {
        capitalizeWords(authorNameInput);
    });

    nationalInput.addEventListener('input', function() {
        capitalizeWords(nationalInput);
    });
});
