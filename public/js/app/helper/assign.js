/**
 * Created by ricoschulz on 12.11.13.
 *
 * @TODO remove grant specifically thing and make it generic.
 */
define([
    'jquery',
    'jquery_ui'
], function ($) {
    var _ = {}, pub = {};

    _.$form = {};

    _.options = {};

    pub.init = function (options) {
        _.$form = $('form');
        _.setup(options);

        $(options.assign).sortable({
            connectWith: options.unassign,
            update: _.addHiddenInputAction
        }).height(160).css('overflow', 'scroll');

        $(options.unassign).sortable({
            connectWith: options.assign,
            update: _.removeHiddenInputAction
        }).height(160).css('overflow', 'scroll');
    };

    _.setup = function (options) {
        _.options = options;

        _.addHiddenInput({value: ''});
        $(options.assign).find('li').each(function () {
            var data = $(this).data();
            _.addHiddenInput(data);
        });
    };

    _.addHiddenInputAction = function (event, ui) {
        var data = $(ui.item.get(0)).data();
        _.addHiddenInput(data);
    };

    _.addHiddenInput = function (data) {
        _.$form.append('<input type="hidden" name="' + _.options.name + '[]" value="' + data.value + '" />');
    };

    _.removeHiddenInputAction = function (event, ui) {
        var data = $(ui.item.get(0)).data();
        $('[name="' + _.options.name + '[]"][value="' + data.value + '"]').remove();
    };

    return pub;
});