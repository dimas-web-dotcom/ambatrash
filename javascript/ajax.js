$(document).ready(function () {
    const userTableBody = $("#user-table-body");
    const prevPageBtn = $("#prev-page");
    const nextPageBtn = $("#next-page");
    const pageInfo = $("#page-info");

    let currentPage = 1;
    let totalPages = 1;

    function loadUsers(page = 1) {
        $.getJSON(`php/fetch_user_data.php?page=${page}`, function (response) {
            const users = response.users;
            totalPages = response.totalPages;
            let html = "";

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
                html = "<tr><td colspan='4'>No users found</td></tr>";
            }

            userTableBody.html(html);
            pageInfo.text(`Page ${currentPage} of ${totalPages}`);
            prevPageBtn.prop("disabled", currentPage === 1);
            nextPageBtn.prop("disabled", currentPage === totalPages);
        }).fail(function () {
            console.error("Error fetching data");
        });
    }

    prevPageBtn.click(function () {
        if (currentPage > 1) {
            currentPage--;
            loadUsers(currentPage);
        }
    });

    nextPageBtn.click(function () {
        if (currentPage < totalPages) {
            currentPage++;
            loadUsers(currentPage);
        }
    });

    loadUsers();
});
