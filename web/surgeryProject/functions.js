$(document).ready(function () {
   $('#search').click(function() {
      document.forms[0].reportValidity();
      $.post('query.php', $('form').serialize(), function(data) {
         $('#out').html(data);
      });
   });
});