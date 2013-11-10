require.config({
    baseUrl: '/js/lib',
    paths: {
        jquery: 'jquery-2.0.3.min',
        bootstrap: 'bootstrap.min',
        app: '../app',
        helper: '../app/helper'
    },
    shim: {
        'bootstrap': {
            deps: ['jquery']
        }
    }
});

require([
    'jquery',
    'bootstrap'
], function ($) {

    $(function () {
        console.log('Index JS');

        $('[data-toggle="tooltip"]').tooltip();

        if ($('body').find('.deleteTrigger').length !== 0) {
            require(['helper/deleteModal'], function (deleteModal) {
                deleteModal.init();
            });
        }


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