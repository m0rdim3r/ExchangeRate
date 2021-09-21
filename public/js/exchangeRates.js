$(function () {
    $.extend( $.fn.dataTable.defaults, {
        info: false,
        language: {
            url: 'https://cdn.datatables.net/plug-ins/1.11.2/i18n/pl.json'
        },
    });

    window.setTimeout(function() {
        $(".alert").fadeTo(500, 0).slideUp(500, function(){
            $(this).remove();
        });
    }, 4000);
});