$(document).ready(function(){
  $('#type').on('change', function() {
    // alert($( this ).val());
    if ($( this ).val() === 'one-time') {
      $('.period-picker').addClass('hidden')
    } else if ($( this ).val() === 'recurring-payments') {
      $('.period-picker').removeClass('hidden');
      $('.type_period').text('Reminder every');
    } else {
      $('.period-picker').removeClass('hidden');
      $('.type_period').text('Invoice every');
    }
  });
});
