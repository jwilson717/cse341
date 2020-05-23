$(document).ready(function () {
   $('#search').click(function() {
      $('form').reportValidity();
      $.post('query.php', $('form').serialize(), function(data) {
         $('#out').html(data);
      });
   });
});