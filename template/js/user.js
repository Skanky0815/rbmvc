define(['jquery'
        , 'app/formValidator'

], function($, formValidator) {
    var _ = {};

    $(function() {
        console.log('user');
        formValidator.init();
    });
});