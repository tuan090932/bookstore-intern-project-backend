// Global variables
var DELETE_URL;
var MODAL_CONFIRM_URL;

document.addEventListener('DOMContentLoaded', function () {
    window.showModalConfirmation = function(ids) {
        var url = DELETE_URL.replace(':id', ids.join(','));
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
});
