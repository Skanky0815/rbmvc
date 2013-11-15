require.config({
    baseUrl: '/js/lib',
    paths: {
        jquery: 'jquery-2.0.3.min',
        bootstrap: 'bootstrap.min',
        app: '../app',
        helper: '../app/helper'
    }
});

require([
    'jquery',
    'wysihtml5-0.3.0_rc2.min',
    'bootstrap-wysihtml5-0.0.2.min'
], function ($) {
    var _ = {};

    $(function () {
        console.log('Entry/Index JS');

        $('#text').wysihtml5({
            'font-styles': true, //Font styling, e.g. h1, h2, etc. Default true
            emphasis: true, //Italics, bold, etc. Default true
            lists: true, //(Un)ordered lists, e.g. Bullets, Numbers. Default true
            html: false, //Button which allows you to edit the generated HTML. Default false
            link: true, //Button to insert a link. Default true
            image: true, //Button to insert an image. Default true,
            colo: true //Button to change color of font
        });
    });
});