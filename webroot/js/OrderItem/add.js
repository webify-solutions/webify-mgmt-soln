$(document).ready(function() {
  $('#product').on('change', function() {
    var price_list_json = $('#unit-price').data('price-list');
    // console.log(price_list_json);
    // console.log(JSON.stringify(price_list_json));
    var price_json = price_list_json[$( this ).val()];
    // console.log(JSON.stringify(price_json));

    var product_keys = Object.keys(price_json);
    // console.log(price_json[product_keys]);
    $('#unit-price').val(price_json[product_keys]);

    /*
     * Clear all custom field values
     */
    for (var i = 1; i <= 20; i++) {
      $('#div-custom-field-' + i).addClass('hidden');
      $('#custom-field-' + i).val(null);
    }

    var all_custom_fields_json = $( this ).data('custom-fields');
    var product_custom_fields_json = all_custom_fields_json[$( this ).val()]
    console.log(product_custom_fields_json);
    for(var custom_field_id in product_custom_fields_json) {
      console.log('id: ' + custom_field_id);
      var custom_field = product_custom_fields_json[custom_field_id];
      if(custom_field['label'] !== null) {
        console.log(custom_field['label']);
        console.log(custom_field['type']);
        var custom_field_id = custom_field_id.replace(/_/g , "-");
        console.log(custom_field_id);
        // console.log($('label[for="' + custom_field_id + '"]').html());
        $('label[for="' + custom_field_id + '"]').html(custom_field['label']);
        // console.log($('label[for="' + custom_field_id + '"]').html());
        $('#' + custom_field_id).clone().attr('type', custom_field['type']).insertAfter('#' + custom_field_id).removeAttr("maxlength").prev().remove();

        // console.log('div-' + custom_field_id);
        $('#div-' + custom_field_id).removeClass('hidden');
      }
    }

  });

  $('#submit-done').click(function () {
    // alert('Submit and Done');
    $('#do-continue').val('false');
    // alert($('#do-continue').val());
  });
});
