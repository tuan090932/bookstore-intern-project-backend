document.addEventListener('DOMContentLoaded', function () {
    function initializeCheckboxes(selectAllId, selectAllFooterId, checkboxName, btnId, inputId) {
        const selectAllCheckbox = document.getElementById(selectAllId);
        const selectAllFooterCheckbox = document.getElementById(selectAllFooterId);
        const checkboxes = document.querySelectorAll(`input[name="${checkboxName}"]`);
        const btn = document.getElementById(btnId);
        const authorIdsInput = document.getElementById(inputId);

        function toggleCheckboxes(checked) {
            checkboxes.forEach(checkbox => {
                checkbox.checked = checked;
            });
        }

        if (selectAllCheckbox) {
            selectAllCheckbox.addEventListener('change', function () {
                toggleCheckboxes(this.checked);
                if (selectAllFooterCheckbox) selectAllFooterCheckbox.checked = this.checked;
            });
        }

        if (selectAllFooterCheckbox) {
            selectAllFooterCheckbox.addEventListener('change', function () {
                toggleCheckboxes(this.checked);
                if (selectAllCheckbox) selectAllCheckbox.checked = this.checked;
            });
        }

        checkboxes.forEach(checkbox => {
            checkbox.addEventListener('change', function () {
                if (!this.checked) {
                    if (selectAllCheckbox) selectAllCheckbox.checked = false;
                    if (selectAllFooterCheckbox) selectAllFooterCheckbox.checked = false;
                } else if (Array.from(checkboxes).every(chk => chk.checked)) {
                    if (selectAllCheckbox) selectAllCheckbox.checked = true;
                    if (selectAllFooterCheckbox) selectAllFooterCheckbox.checked = true;
                }
            });
        });

        if (btn) {
            btn.addEventListener('click', function () {
                const selectedIds = Array.from(checkboxes).filter(checkbox => checkbox.checked).map(checkbox => checkbox.value);
                authorIdsInput.value = selectedIds.join(',');
            });
        }
    }

    //Authors index page
    initializeCheckboxes('select-all', 'select-all-footer', 'author_ids[]', 'selected-delete-btn', 'author_ids');
    //Authors restore page
    initializeCheckboxes('select-all', 'select-all-footer', 'author_ids[]', 'selected-restore-btn', 'author_ids');
    // Admins index page

    //Admins restore page
    initializeCheckboxes('select-all', 'select-all-footer', 'admin_ids[]', 'selected-restore-btn', 'admin_ids');
});
