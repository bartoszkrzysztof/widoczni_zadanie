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

const addContactButtonId = 'js-add-contact';
const addContactListId = 'js-contact-list';
const removeContactClass = 'js-remove-contact';

document.addEventListener('DOMContentLoaded', function () {
    console.log(document.getElementById(addContactButtonId));

    document.getElementById(addContactButtonId).addEventListener('click', function () {
        const contactList = document.getElementById(addContactListId);
        const newContactIndex = Date.now();
        const contactItem = document.createElement('div');
        contactItem.classList.add('contact-item');
        contactItem.innerHTML = `
            <input type="text" name="contacts[new_${newContactIndex}][name]" placeholder="Imię i nazwisko" required>
            <input type="email" name="contacts[new_${newContactIndex}][email]" placeholder="Email" required>
            <input type="text" name="contacts[new_${newContactIndex}][phone]" placeholder="Telefon">
            <button type="button" class="${removeContactClass}">Usuń</button>
        `;
        contactList.appendChild(contactItem);
    });

    document.getElementById(addContactListId).addEventListener('click', function (e) {
        if (e.target.classList.contains(removeContactClass)) {
            e.target.parentElement.remove();
        }
    });
});