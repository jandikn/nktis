// odesílání odkazů
$('a.ajax').live('click', function (event) {
    event.preventDefault();
    $.get(this.href);
});

/* AJAXové odeslání formulářů */
$("form.ajax").live("submit", function () {
    $(this).ajaxSubmit();
    return false;
});

$("form.ajax :submit").live("click", function () {
    $(this).ajaxSubmit();
    return false;
});

jQuery.ajaxSetup({
    cache: false,
    dataType: 'json',
    success: function (payload) {
        if (payload.snippets) {
            for (var i in payload.snippets) {
                $('#' + i).html(payload.snippets[i]);
            }
        }
    }
});