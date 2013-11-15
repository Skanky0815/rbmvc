define([
    'jquery'
], function ($) {
    var _ = {}, pub = {};

    _.$targe = null;

    _.$searchIcon = null;

    pub.init = function () {
        var $body = $('body');

        $body.on('click', '.searchTrigger', _.searchAction);
        $body.on('keyup', '.searchInputTrigger', _.searchElementAction);
        $body.on('focusout', '.searchInputTrigger', _.hideSearchElementAction);
    };

    _.searchAction = function (e) {
        e.preventDefault();

        var $this = $(this);

        var options = $this.data();
        _.$targe = $('.' + options.target);
        $this.replaceWith('<div class="input-group col-6">' +
            '<span class="input-group-addon">' +
            '<i class="icon-search"></i>' +
            '</span>' +
            '<input name="search" class="form-control searchInputTrigger">' +
            '</div>');
        _.$searchIcon = $this;
        $('.searchInputTrigger').focus();
    };

    _.searchElementAction = function (e) {
        e.preventDefault();

        if (e.keyCode === 13) {
            _.hideSearchElementAction(e);
            _.$searchIcon = null;
            _.$targe = null;
        }

        var $this = $(this);
        var value = $this.val();
        if (typeof value !== 'string') {
            return;
        }

        _.$targe.children().each(function (key, element) {
            var $element = $(element);
            var text = $element.text().toLowerCase();

            if (text.indexOf(value.toLowerCase()) !== -1) {
                $element.show();
            } else {
                $element.hide();
            }
        });
    };

    _.hideSearchElementAction = function (e) {
        e.preventDefault();
        var $this = $(this);
        $this.parent().replaceWith(_.$searchIcon);
    };

    return pub;
});