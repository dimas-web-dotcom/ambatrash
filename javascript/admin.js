// Get the modal and button elements
const addPackageBtn = document.getElementById('add-package-btn');
const addPackageModal = document.getElementById('add-package-modal');
const closeBtn = document.querySelector('.close');


addPackageBtn.addEventListener('click', () => {
    addPackageModal.style.display = 'block';
});

closeBtn.addEventListener('click', () => {
    addPackageModal.style.display = 'none';
});

window.addEventListener('click', (event) => {
    if (event.target === addPackageModal) {
        addPackageModal.style.display = 'none';
    }
});


// ini adalah pembatas antara add dan edit 

// Get all edit buttons
const editButtons = document.querySelectorAll('.edit-btn');

// Get the edit modal and its elements
const editModal = document.getElementById('edit-package-modal');
const closeSpan = document.querySelector('.closeDua');
const editForm = document.getElementById('edit-package-form');
const packageIdInput = document.getElementById('ID_packet');
const packageNameInput = document.getElementById('packet_name');
const packagePriceInput = document.getElementById('packet_price');
const packageDescriptionInput = document.getElementById('packet_description');

// Function to open the edit modal and populate the form
editButtons.forEach(button => {
    button.addEventListener('click', (event) => {
        event.preventDefault();

        // Get data from the button's data attributes
        const id = button.getAttribute('data-id');
        const name = button.getAttribute('data-name');
        const price = button.getAttribute('data-price');
        const description = button.getAttribute('data-description');

        // Populate the form fields
        packageIdInput.value = id;
        packageNameInput.value = name;
        packagePriceInput.value = price;
        packageDescriptionInput.value = description;

        // Show the modal
        editModal.style.display = 'block';
    });
});

// Close the modal when the close button is clicked
closeSpan.addEventListener('click', () => {
    editModal.style.display = 'none';
});

// Close the modal if the user clicks outside of it
window.addEventListener('click', (event) => {
    if (event.target === editModal) {
        editModal.style.display = 'none';
    }
});