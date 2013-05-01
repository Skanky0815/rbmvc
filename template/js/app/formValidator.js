define(['jquery'
], function($) {
    var _ = {};
    var pub = {};
    
    _.hasError = false;
    _.$form = null;

    pub.init = function() {
        _.$form = $('form');
        
        _.$form.on('click', '.btn-primary', _.submitAction);
    };
    
    _.submitAction = function(e) {
        e.preventDefault();
        _.validate();
    };
    
    _.validate = function() {
        _.$form.find('.required').each(_.validateElement);
        if (!_.hasError) {
            _.$form.submit();
        }
        _.hasError = false;
    };

    _.validateElement = function(key, element) {
        var value = $(element).val();
        
        if (value.length <= 0) {
            $(element).parent().parent().addClass('error');
            _.hasError = true;
        } else {
            $(element).parent().parent().removeClass('error');
        }
    };
    
    return pub;
});