requirejs.config({
    baseUrl: '/js/lib',
    paths: {
        jquery: 'jquery-2.0.3.min',
        jquery_ui: 'jquery-ui-1.10.3.custom.min',
        bootstrap: 'bootstrap.min',
        app: '../app',
        helper: '../app/helper'
    },
    shim: {
        bootstrap: {
            deps: ['jquery']
        }
    }
});

requirejs([
    'jquery',
    'bootstrap'
], function ($) {
    var _ = {};

    _.loadedModules = [];

    $(function () {
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

        if ($body.find('.deleteTrigger').length !== 0) {
            require(['helper/deleteModal'], function (deleteModal) {
                deleteModal.init();
            });
            _.loadedModules.push('helper/deleteModal');
        }

        if ($body.find('.searchTrigger').length !== 0) {
            require(['helper/search'], function (search) {
                search.init();
            });
            _.loadedModules.push('helper/search');
        }

        /**
         * Load all js modules by there given paths in data-js attributes
         */
        $body.find('[data-js]').each(function (k, element) {
            var data = $(element).data();
            if (_.loadedModules.indexOf(data.js) < 0) {
                requirejs([data.js], function (js) {
                    if (js !== undefined) {
                        js.init(data);
                    }
                });
                _.loadedModules.push(data.js);
            }
        });

        console.log(_.loadedModules);

//        var connection = new WebSocket('ws://127.0.0.1:5000');
//        // When the connection is open, send some data to the server
//        $('#socketTest').keypress(function(e) {
//            if (e.keyCode == 13) {
//                e.preventDefault();
//                $('#socketTestResponse').append($(this).val())
//                connection.send($(this).val());
//            }
//        });
//
//        // Log errors
//        connection.onerror = function (error) {
//            $('#socketTestResponse').html(error);
//        };
//
//        // Log messages from the server
//        connection.onmessage = function (e) {
//            $('#socketTestResponse').append(e.data + "\n");
//        };
    });
});