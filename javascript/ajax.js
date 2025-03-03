document.addEventListener('DOMContentLoaded', function () {
    const searchBtn = document.getElementById('search-btn');
    const searchInput = document.getElementById('search-name');
    const userTableBody = document.getElementById('user-table-body');

    function loadUsers(searchName = '') {
        const xhr = new XMLHttpRequest();
        xhr.open('GET', `php/search_user.php?search_name=${searchName}`, true);
        xhr.onload = function () {
            if (xhr.status === 200) {
                console.log('Response:', xhr.responseText);
                const users = JSON.parse(xhr.responseText);
                let html = '';

                if (users.length > 0) {
                    users.forEach(user => {
                        html += `
                            <tr>
                                <td>${user.ID_user}</td>
                                <td>${user.email}</td>
                                <td>${user.password}</td>
                                <td>
                                    <a href='php/delete_user.php?ID_user=${user.ID_user}' class='delete-btn'>DELETE</a>
                                </td>
                            </tr>
                        `;
                    });
                } else {
                    html = '<tr><td colspan="4">No users found</td></tr>';
                }

                userTableBody.innerHTML = html;
            } else {
                console.error('Error fetching data');
            }
        };
        xhr.send();
    }

    loadUsers();

    searchBtn.addEventListener('click', function () {
        const searchName = searchInput.value.trim();
        loadUsers(searchName);
    });

    searchInput.addEventListener('input', function () {
        const searchName = searchInput.value.trim();
        loadUsers(searchName);
    });
});