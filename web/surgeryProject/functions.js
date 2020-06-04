$(document).ready(function () {
   $('#search').click(function() {
      $.post('query.php', $('form').serialize(), function(data) {
         $('#out').html(data);
      });
   });

   $('#surgerycheck').change(function() {
      if ($('#surgerycheck').is(':checked')) {
         $('.surg').removeClass('hide');
         $('#insert').removeClass('hide');
         $('.req').prop('require', true);
      } else {
         $('.surg').addClass('hide');
         $('.req').prop('required', false);
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

   $('#updatenote').click(function(){
      var newnote = $('#newnotes').val();
      var record = $('#record').html();
      $.post('update.php', {newnotes: newnote, record: record}, function(data) {
         $('#res').html(data);
      });
   });
});