$(document).ready(function(){
   $('#colorchange').click(function() {
      if ($('header').css('background-color') != 'red') {
         $('header').css('background-color', 'red');
         $('footer').css('background-color', 'red');
         $('nav').css('background-color', 'red');
      } else {
         $('header').css('background-color', 'rgb(2, 4, 117)');
         $('footer').css('background-color', 'rgb(3, 15, 53)');
         $('nav').css('background-color', 'rgb(2, 4, 117)');
      }
   });
});