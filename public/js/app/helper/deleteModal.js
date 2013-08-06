define(['../../lib/bootstrap.min'
], function() {
    var _ = {};
    var pub = {};
    
    _.$delelteButton = null;
    _.$deleteModal = null;
    
    _.url = '';

    pub.init = function() {
        console.log('Delete-Modal loaded!');

        _.$delelteButton = $('.delete');
        _.$deleteModal = $('#deleteModal');
        
        
        _.$delelteButton.on('click', _.deleteAction);
        _.$deleteModal.on('click', '.btn-danger', _.doAjaxAction);
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
           success: _.response
        });
    };
    
    _.response = function(data) {
        if (data.status === 'ok') {
            var url = location.href;
            location.href = url;
        } else {
            _.$deleteModal.find('.modal-body').html(data.data);
        }
    };
    
    return pub;
});