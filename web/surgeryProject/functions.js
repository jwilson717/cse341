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
         $('.surg').removeClass('hide');
         $('#insert').removeClass('hide');
      } else {
         $('.surg').addClass('hide');
         $('.preq').prop('required', false);
      }
   });

   $('#patientcheck').change(function() {
      if ($('#patientcheck').is(':checked')) {
         $('.pat').removeClass('hide');
         $('#insert').removeClass('hide');
         $('.preq').prop('required', true);
      } else {
         $('.pat').addClass('hide');
         $('.preq').prop('required', false);
      }
   });

});