define(['../lib/bootstrap.min'
], function () {
    var _ = {};

    $(function () {
        console.log('Index JS');

        $('[data-toggle="tooltip"]').tooltip();
    });
});