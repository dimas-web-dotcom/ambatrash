document.addEventListener('DOMContentLoaded', function () {
    const userTableBody = document.getElementById('user-table-body');
    const prevPageBtn = document.getElementById('prev-page');
    const nextPageBtn = document.getElementById('next-page');
    const pageInfo = document.getElementById('page-info');
    
    let currentPage = 1;
    let totalPages = 1;

    function loadUsers(page = 1) {
        const xhr = new XMLHttpRequest();
        xhr.open('GET', `php/fetch_user_data.php?page=${page}`, true);
        xhr.onload = function () {
            if (xhr.status === 200) {
                const response = JSON.parse(xhr.responseText);
                const users = response.users;
                totalPages = response.totalPages;
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
                pageInfo.textContent = `Page ${currentPage} of ${totalPages}`;
                prevPageBtn.disabled = currentPage === 1;
                nextPageBtn.disabled = currentPage === totalPages;
            } else {
                console.error('Error fetching data');
            }
        };
        xhr.send();
    }

    prevPageBtn.addEventListener('click', function () {
        if (currentPage > 1) {
            currentPage--;
            loadUsers(currentPage);
        }
    });

    nextPageBtn.addEventListener('click', function () {
        if (currentPage < totalPages) {
            currentPage++;
            loadUsers(currentPage);
        }
    });

    loadUsers();
});
