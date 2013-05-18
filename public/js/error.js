define([

], function() {
   var _ = {};
   var pub = {};
   
   _.isInit = false;
   
   pub.init = function() {
       if (_.isInit) {
           return;
       }
       
       _.isInit = true;
   };
   
   return pub;
});