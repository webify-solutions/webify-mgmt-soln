$(document).ready(function() {
  $('#technician').on('change', function() {
    console.log('Update status to assigned')
    $('#status').val('Assigned')
  });
});
