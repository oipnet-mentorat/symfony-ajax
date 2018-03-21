var $ = require('jquery');

$(document).ready(() => {
    $('#more').click(function(e) {
        e.preventDefault();

        var target = $(this).attr('href')
        console.log(target)
        $.get({
            url: target,
            dataType: 'json'
        }).done(function (response) {
            response = JSON.parse(response)
            if (response.has_next_page) {
                $("#more").attr('href', response.next)
            } else {
                $("#more").remove()
            }
            $("#posts").append(response.render)
        });
    })
})