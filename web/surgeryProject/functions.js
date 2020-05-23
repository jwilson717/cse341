$(document).ready(function () {
   $('#search').click(function() {
      console.log('Test');
      $('form').reportValidity();
      $.post('query.php', $('form').serialize(), function(data) {
         $('#out').html(data);
      });
   });
});