$(document).ready(function () {
   $('#search').click(function() {
      $.post('query.php', $('form').serialize(), function(data) {
         $('#out').html(data);
      });
   });
});