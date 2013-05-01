define(['jquery'
      , 'app/deleteModal'
      , 'app/formValidator'
], function($, deleteModal, formValidator) {
    var _ = {};

    $(function() {
        deleteModal.init();
        formValidator.init();
    });
});