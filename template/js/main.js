require(["jquery", "jquery.alpha"], function($) {
    $(function() {
        $('body').alpha();
    });
});

var Main = (function() {
    var _ = {}, pub = {};
    
    pub.init = function() {
//        alert(42);
    };
    
    return pub;
})();


$(document).ready(function() {
    Main.init();
});