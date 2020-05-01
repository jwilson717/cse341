$(document).ready(function(){
   $('#colorchange').click(function() {
      if ($('header').css('background-color') == 'rgb(139, 0, 0)') {
         $('header').css('background-color', 'rgb(2, 4, 117)');
         $('nav').css('background-color', 'rgb(3, 15, 53)');
         $('footer').css('background-color', 'rgb(2, 4, 117)');
      } else {
         $('header').css('background-color', 'darkred');
         $('footer').css('background-color', 'darkred');
         $('nav').css('background-color', 'darkred');
      }
   });
});