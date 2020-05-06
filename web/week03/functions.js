$(document).ready(function () {
   $('.addCart').click(function() {
      let val = $(this).val();
      let url = 'browseItems.php';
      let data = {'item': val};
      $.post(url, data, function () {
         return;
      });
   });
});