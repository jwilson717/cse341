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

   $('#surgerycheck').change(function() {
      if ($('#surgerycheck').is(':checked')) {
         $('#surgeryData').removeClass('hide');
      } else {
         $('#surgeryData').addClass('hide');
      }
   });

   $('#patientcheck').change(function() {
      if ($('#patientcheck').is(':checked')) {
         $('#patientData').removeClass('hide');
      } else {
         $('#patientData').addClass('hide');
      }
   });

});