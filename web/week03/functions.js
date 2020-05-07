$(document).ready(function () {
   $('.addCart').click(function() {
      let val = $(this).val();
      let url = 'browseItems.php';
      let data = {'item': val};
      $.post(url, data, function () {
         return;
      });
   });
   $('removeone').click(function() {
      let val = $(this).val();
      let url = 'cartRemove.php';
      let data = {'action': 'removeone', 'item': val};
      $.post(url, data, function () {
         location.reload();
      });
   });
});