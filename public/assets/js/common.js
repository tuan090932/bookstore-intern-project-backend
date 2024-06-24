// Global variables
var ACTION_URL;
var MODAL_CONFIRM_URL;

document.addEventListener('DOMContentLoaded', function () {
    window.showModalConfirmation = function(ids) {
        var url = ACTION_URL;
        $.ajax({
            url: MODAL_CONFIRM_URL,
            method: 'POST',
            data: {
                ids: ids,
                url: url,
                title: title,
                body: body,
                confirmText: confirmText,
                _token: $('meta[name="csrf-token"]').attr('content')
            },
            success: function (response) {
                $('body #confirmModal').remove();
                $('body').append(response);
                $('body #confirmModal').modal('show');
            },
            error: function (xhr) {
                console.error('Error loading confirmation modal:', xhr.responseText);
            }
        });
    }

    window.initializeCheckboxes = function(selectAllHeaderId, selectAllFooterId, individualCheckboxName, buttonId) {
        function updateAllCheckboxes(isChecked) {
            var checkboxes = document.querySelectorAll(`input[name="${individualCheckboxName}"]`);
            checkboxes.forEach(function(checkbox) {
                checkbox.checked = isChecked;
            });
            document.getElementById(selectAllHeaderId).checked = isChecked;
            document.getElementById(selectAllFooterId).checked = isChecked;
        }

        function updateSelectAllCheckboxes() {
            var individualCheckboxes = document.querySelectorAll(`input[name="${individualCheckboxName}"]`);
            var allChecked = Array.from(individualCheckboxes).every(function(cb) {
                return cb.checked;
            });
            document.getElementById(selectAllHeaderId).checked = allChecked;
            document.getElementById(selectAllFooterId).checked = allChecked;
        }

        // Add event listeners for both select all checkboxes
        [selectAllHeaderId, selectAllFooterId].forEach(function(id) {
            document.getElementById(id).addEventListener('change', function() {
                updateAllCheckboxes(this.checked);
            });
        });

        // Add event listener for individual checkboxes
        var individualCheckboxes = document.querySelectorAll(`input[name="${individualCheckboxName}"]`);
        individualCheckboxes.forEach(function(checkbox) {
            checkbox.addEventListener('change', updateSelectAllCheckboxes);
        });

        // Add event listener for the delete selected button
        document.getElementById(buttonId).addEventListener('click', function() {
            var selectedIds = Array.from(document.querySelectorAll(`input[name="${individualCheckboxName}"]:checked`))
                .map(checkbox => checkbox.value);

            if (selectedIds.length > 0) {
                showModalConfirmation(selectedIds);
            } else {
                alert('Please select at least one item to delete.');
            }
        });
    }
});
