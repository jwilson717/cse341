$(document).ready(function () {
   $('#search').click(function() {
      console.log('Test');
      $.post('query.php', $('form').serialize(), function(data) {
         console.log('Test2');
         $('#out').html(data);
      });
   });
});