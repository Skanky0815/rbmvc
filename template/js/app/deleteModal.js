define(['jquery'
        , 'lib/bootstrap.min'

], function($) {
    var _ = {
        isInit: false,
    };
    var pub = {};

    _.isInit = false;
    
    _.$delelteButton = null;
    _.$deleteModal = null;
    
    _.url = ''


    pub.init = function() {
        if (_.isInit) {
            return;
        }
        
        _.$delelteButton = $('.delete');
        _.$deleteModal = $('#deleteModal');
        
        
        _.$delelteButton.on('click', _.deleteAction);
        _.$deleteModal.on('click', '.btn-danger', _.doAjaxAction);

        _.isInit = true;
    };
    
    _.deleteAction = function(e) {
        e.preventDefault();
        
        var $this = $(this);
        _.url = $this.attr('href');
        _.$deleteModal.modal();
    };
    
    _.doAjaxAction = function() {
        $.ajax({
           url: _.url,
           dataType: 'JSON',
           success: _.respons
        });
    };
    
    _.respons = function(data) {
        if (data.status === 'ok') {
            var url = location.href;
            location.href = url;
        } else {
            _.$deleteModal.find('.modal-body').html(data.data);
        }
    };
    
    return pub;
});