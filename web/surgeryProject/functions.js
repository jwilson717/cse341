$(document).ready(function () {
   $('#search').click(function() {
      if (!$('#surgeryDate').val()) {
         $('#error1').removeClass('hide');
         $('#error1').css('color', 'red');
      } else {
         $('#error1').addClass('hide');
         $.post('query.php', $('form').serialize(), function(data) {
            $('#out').html(data);
         });
      }
   });
});