$(function () {

    var target = $('#content'),
        id = $('#txtPregnancyId').val(),
        person_id = $('#txtPersonId').val(),
        gravida = $('#txtGravida').val();

    var setActive = function (obj) {
        $('#collapseTools a').each(function () {
            var $this = $(this);

            $this.removeClass('list-group-item-success');
        });

        obj.addClass('list-group-item-success');
    };

    $('a[href="#info"]').on('click', function() {
        setActive($(this));
        app.loadPage({
            target: target,
            url: pageUrl[0],
            params: { id: id },
            scripts: [scriptUrl[0]]
        });
    });

    $('a[href="#anc"]').on('click', function() {
        setActive($(this));
        app.loadPage({
            target: target,
            url: pageUrl[1],
            params: { id: id, person_id: person_id, gravida: gravida },
            scripts: [scriptUrl[1]]
        });
    });

    $('a[href="#postnatal"]').on('click', function() {
        setActive($(this));
        app.loadPage({
            target: target,
            url: pageUrl[2],
            params: { id: id, person_id: person_id, gravida: gravida },
            scripts: [scriptUrl[2]]
        });
    });

    setActive($('a[href="#info"]'));
    app.loadPage({
        target: target,
        url: pageUrl[0],
        params: { id: id },
        scripts: [scriptUrl[0]]
    });

});
