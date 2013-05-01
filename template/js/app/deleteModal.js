define(['jquery'

], function($) {
    var _ = {};
    var pub = {};

    _.isInit = false;
    
    _.$delelteButton = null;
    _.$deleteModal = null;


    pub.init = function() {
        if (_.isInit) {
            return;
        }
        
        _.$delelteButton = $('.delete');
        _.$deleteModal = $('#deleteModal');
        
        
        _.$delelteButton.on('click', _.deleteAction);

        _.isInit = true;
    };
    
    _.deleteAction = function(e) {
        e.preventDefault();
        
        var $this = $(this);
        var url = $this.attr('href');
        console.log('url= ', url);
    };
    
    return pub;
});