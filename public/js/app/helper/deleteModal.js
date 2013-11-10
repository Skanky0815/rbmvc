define([
    'jquery',
    'bootstrap'
], function ($) {
    var _ = {}, pub = {};

    _.$deleteModal = null;

    _.url = '';

    pub.init = function () {
        $('body').on('click', '.deleteTrigger', _.showModalAction);
    };

    _.showModalAction = function (e) {
        e.preventDefault();

        var $this = $(this);
        var url = $this.attr('href');
        var id = $this.attr('data-id');
        if (_.$deleteModal === null) {
            $.getJSON(url, _.showModal);
        } else {
            _.$deleteModal.modal();
        }
        _.url = url + '?id=' + id;
    };

    _.showModal = function (json) {
        if (json.content === undefined) {
            return;
        }

        _.$deleteModal = $(json.content);
        _.$deleteModal.on('click', '.btn-danger', _.deleteAction);
        _.$deleteModal.modal();
    };

    _.deleteAction = function () {
        $.getJSON(_.url, _.response);
    };

    _.response = function (json) {
        if (json.status === 'ok') {
            var url = location.href;
            location.href = url;
        } else {
            _.$deleteModal.find('.modal-body').html(json.data);
        }
    };

    return pub;
});