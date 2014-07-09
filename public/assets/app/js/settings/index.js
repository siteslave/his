$(function() {

    var target = $('#content');

    var setActive = function (obj) {
        $('#collapseMain a').each(function () {
            var $this = $(this);
            $this.removeClass('list-group-item-success');
        });

        $('#collapseOther a').each(function () {
            var $this = $(this);
            $this.removeClass('list-group-item-success');
        });

        obj.addClass('list-group-item-success');
    };

    $('a[href="#vaccines"]').on('click', function() {
        setActive($(this));
        app.loadPage({
            target: target,
            url: pageUrl[0],
            scripts: [scriptUrl[0]]
        });
    });

});
