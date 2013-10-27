define(['../helper/deleteModal'
    , '../../lib/bootstrap.min'
    , '../../lib/wysihtml5-0.3.0_rc2.min'
    , '../../lib/bootstrap-wysihtml5-0.0.2.min'
], function () {
    var _ = {};

    $(function () {
        console.log('Entry/Index JS');

        var $body = $('body');

        $body.popover({
            selector: '[data-toggle="popover"]',
            placement: 'bottom',
            trigger: 'hover'
        });

        $body.tooltip({
            selector: 'a[rel="tooltip"], [data-toggle="tooltip"], a[title]',
            container: 'body'
        });


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