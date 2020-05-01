$(document).ready(function(){
   $('#colorchange').click(function() {
      console.log($('header'));
      if ($('header').css('background-color') != 'darkred') {
         $('header').css('background-color', 'darkred');
         $('footer').css('background-color', 'darkred');
         $('nav').css('background-color', 'darkred');
      } else {
         $('header').css('background-color', 'rgb(2, 4, 117)');
         $('footer').css('background-color', 'rgb(3, 15, 53)');
         $('nav').css('background-color', 'rgb(2, 4, 117)');
      }
   });
});