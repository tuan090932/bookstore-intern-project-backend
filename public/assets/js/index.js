document.addEventListener('DOMContentLoaded', function () {
    var ageRangeSlider = document.getElementById('age_range');
    var minAgeInput = document.getElementById('min_age');
    var maxAgeInput = document.getElementById('max_age');
    var ageRangeValues = document.getElementById('age_range_values');

    noUiSlider.create(ageRangeSlider, {
        start: [minAgeInput.value || 0, maxAgeInput.value || 100],
        connect: true,
        range: {
            'min': 0,
            'max': 100
        },
        tooltips: [true, true],
        format: {
            to: function (value) {
                return Math.round(value);
            },
            from: function (value) {
                return Number(value);
            }
        }
    });

    ageRangeSlider.noUiSlider.on('update', function (values, handle) {
        minAgeInput.value = values[0];
        maxAgeInput.value = values[1];
        ageRangeValues.innerHTML = values.join(' - ');
    });

    ageRangeSlider.noUiSlider.on('set', function (values, handle) {
        minAgeInput.value = values[0];
        maxAgeInput.value = values[1];
    });
});
