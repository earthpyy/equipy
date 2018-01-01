$(document).find(".li-dd").closest("li").find("[class^='ul_submenu']").hide();

$('.li-dd').click(function(e) {
    e.preventDefault();
    $(this).closest("li").find("[class^='ul_submenu']").slideToggle();
});

$(document).on('click', 'form input.btn-danger[value="Delete"]', function() {
    return confirm("Are you sure you want to delete?");
});