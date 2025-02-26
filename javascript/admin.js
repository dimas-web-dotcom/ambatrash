const addPackageBtn = document.getElementById('add-package-btn');
const modal = document.getElementById('add-package-modal');
const closeBtn = document.querySelector('.close');
const addPackageForm = document.getElementById('add-package-form');

addPackageBtn.addEventListener('click', () => {
    modal.style.display = 'block';
});

// Close the modal
closeBtn.addEventListener('click', () => {
    modal.style.display = 'none';
});

// Close the modal if the user clicks outside of it
window.addEventListener('click', (event) => {
    if (event.target === modal) {
        modal.style.display = 'none';
    }
});

function confirmDelete(userId) {
    if (confirm('Are you sure you want to delete this user?')) {
        window.location.href = 'php/delete_user.php?id=' + userId;
    }
}

// modal edit button

// Get the modal
const editModal = document.getElementById('edit-package-modal');
const closeSpan = document.querySelector('.closeDua');
const editButtons = document.querySelectorAll('.edit-btn');

// Function to toggle the modal
function toggleEditModal() {
    if (editModal.style.display === 'block') {
        editModal.style.display = 'none';
    } else {
        editModal.style.display = 'block';
    }
}

editButtons.forEach(button => {
    button.addEventListener('click', (event) => {
        event.preventDefault();
        toggleEditModal(); 
    });
});

closeSpan.addEventListener('click', () => {
    editModal.style.display = 'none';
});

