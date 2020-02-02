$(document).ready(function() {
   $(':radio:not(:checked)').attr('disabled', true);
   $('select').attr("disabled", true);
   $('input').attr("disabled", true);
});