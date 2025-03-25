// potwierdz usuniecie
const deleteFormClass = 'js-delete-form'

document.addEventListener('submit', function (event) {
    const form = event.target;
    if (form.classList.contains(deleteFormClass)) {
        const confirmation = confirm('Czy na pewno chcesz usunąć?');
        if (!confirmation) {
            event.preventDefault();
        }
    }
});