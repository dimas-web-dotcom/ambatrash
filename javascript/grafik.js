fetch('php/get_sales_data.php')
        .then(response => response.json())
        .then(data => {
            const labels = data.map(item => item.date); // Label perhari
            const salesData = data.map(item => item.total_sales); // Data penjualan

            const ctx = document.getElementById('salesChart').getContext('2d');
            new Chart(ctx, {
                type: 'line', // Bisa juga 'bar' untuk grafik batang
                data: {
                    labels: labels,
                    datasets: [{
                        label: 'Total Penjualan',
                        data: salesData,
                        backgroundColor: 'rgba(54, 162, 235, 0.5)',
                        borderColor: 'rgba(54, 162, 235, 1)',
                        borderWidth: 2,
                        fill: true
                    }]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    scales: {
                        y: {
                            beginAtZero: true
                        }
                    }
                }
            });
        })
        .catch(error => console.error('Error fetching sales data:', error));


// Hamburger menu functionality
$(document).ready(function() {
    const $sidebar = $('.sidebar');
    const $mobileToggle = $('.mobile-menu-toggle');
    const $body = $('body');
    
    // Toggle sidebar
    $mobileToggle.click(function(e) {
      e.stopPropagation();
      $sidebar.toggleClass('active');
      $body.toggleClass('sidebar-open');
    });
    
    // Close sidebar when clicking outside
    $(document).click(function() {
      $sidebar.removeClass('active');
      $body.removeClass('sidebar-open');
    });
    
    // Prevent closing when clicking inside sidebar
    $sidebar.click(function(e) {
      e.stopPropagation();
    });
    
    // Close sidebar when a menu item is clicked (for single page apps)
    $('.nav-menu a').click(function() {
      $sidebar.removeClass('active');
      $body.removeClass('sidebar-open');
    });
  });