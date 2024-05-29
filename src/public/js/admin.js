"use strict";
function setupDeleteForms() {
    let deleteForms = document.querySelectorAll('form.deletionform'); // Changed 'deletion-form' to 'deletionform'
    for (let form of deleteForms) {
        form.addEventListener('submit', function (event) {
            event.preventDefault();
            if (window.confirm('Vai tiešām vēlaties dzēst šo ierakstu?')) {
                form.submit();
            } else {
                return false;
            }
        });
    }
}
document.addEventListener("DOMContentLoaded", function () {
    setupDeleteForms();
});
