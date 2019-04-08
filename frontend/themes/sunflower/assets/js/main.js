$('#gen').click(function generate() {
    $.post('/site/recommend-code-captcha', function(data) {
        if (data) {
            $('#recommend-broad').html(data.data)
        }
    });
});