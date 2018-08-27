$(document).ready(function(){

  var availableCategories = [];
  $("#category-id option").each(function() {
    availableCategories.push($( this ).text());
  });
  $( "#category-name" ).autocomplete({
    source: availableCategories
  });

  $('#category-name').change(function(){
    // console.log($( this ).val());
    $("#category-id").val(null);

    var category_name = $( this ).val();
    $("#category-id option").filter(function() {
      //may want to use $.trim in here
      return $( this ).text() == category_name;
    }).prop('selected', true);
    // console.log($('#category-id').val());
    // console.log($('#category-id'));

    // console.log('clear custom fields');
    for (i = 1; i <= 20; i++) {
      // console.log('checking #div-custom-field-' + i);
      if (!($('#div-custom-field-' + i).hasClass('hidden'))) {
        // console.log('clearing custom field ' + i);
        $('#custom-field-' + i).val(null);
        $('#custom-field-type-' + i).val(null);
        $('#div-custom-field-' + i).addClass('hidden');
      }
    }

    // console.log($('#category-name').val());
    // prefill default custom fields
    var category_custom_fields = ($('#category-name').data('custom-fields'))[$('#category-id').val()];
    // console.log(category_custom_fields);
    // console.log(category_custom_fields['custom_field_1'])
    if (typeof category_custom_fields !== 'undefined') {
      for (i = 1; i <= 20; i++) {
        // console.log(i);
        var key = 'custom_field_' + i;
        var key2 = 'custom_field_type_' + i;
        var custom_field_label = category_custom_fields[key];
        // console.log(custom_field_label);
        if (custom_field_label != null) {
          // console.log('#' + key.replace(/_/g, '-'));
          $('#' + key.replace(/_/g, '-')).val(custom_field_label);
          $('#' + key2.replace(/_/g, '-')).val(category_custom_fields[key2])
          $('#div-custom-field-' + i).removeClass('hidden');
        } else {
          $('#div-custom-field-' + i).removeClass('hidden');
          break;
        }
      }
    } else if ($('#category-name').val() != null && $('#category-name').val() != '') {
      $('#div-custom-field-1').removeClass('hidden');
    }

  });

  for (i = 1; i <= 20; i++) {
    $('#custom-field-' + i).focusin(function() {
      // console.log('add new custom field');
      // console.log($( this ).attr('id'));

      var current_index = parseInt($( this ).attr('id').split('-')[2]);
      // console.log(current_index);
      if (current_index != 20) {
        var next_index = current_index + 1;
        // console.log(next_index);
        var next_id = '#div-custom-field-' + next_index;
        // console.log(next_id);
        $(next_id).removeClass('hidden');
      }

    });

    $('#delete-custom-field-' + i).click(function() {
      // console.log('delete click');
      var current_index = parseInt($( this ).attr('id').split('-')[3]);
      // console.log(current_index);
      var current_id = 'custom-field-' + current_index;
      // console.log(current_id);
      $('#' + current_id).val(null);
      $('#div-' + current_id).addClass('hidden');
    });
  }

});
