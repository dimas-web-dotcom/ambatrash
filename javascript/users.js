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