$(document).ready(function() {
  $('#product').on('change', function() {
    var product_info_list = $( this ).data('product-info-list');
    var product_info = product_info_list[$( this ).val()]
    // console.log(product_info_list);
    // console.log(product_info);

    var price = product_info['price'];
    // console.log(price);
    $('#unit-price').val(price);

    /*
     * Clear all custom field values
     */
    for (var i = 1; i <= 20; i++) {
      $('#div-custom-field-' + i).addClass('hidden');
      $('#custom-field-' + i).val(null);
    }

    var product_related_info_list = $( this ).data('product-related-info-list');
    // console.log(product_related_info_list);
    var product_related_info = product_related_info_list[$( this ).val()];
    console.log(product_related_info);

    $('#notes').val(product_related_info['order_item_notes']);

    var product_custom_fields = product_info['custom_fields'];
    // console.log(product_custom_fields)
    for(var custom_field_id in product_custom_fields) {
      // console.log('id: ' + custom_field_id);
      var custom_field = product_custom_fields[custom_field_id];
      if(custom_field['label'] !== null) {
        // console.log(custom_field['label']);
        // console.log(custom_field['type']);
        var html_custom_field_id = custom_field_id.replace(/_/g , "-");
        // console.log(custom_field_id);
        // console.log($('label[for="' + custom_field_id + '"]').html());
        $('label[for="' + html_custom_field_id + '"]').html(custom_field['label']);
        // console.log($('label[for="' + custom_field_id + '"]').html());
        // console.log(product_related_info[custom_field_id]['value']);
        if (custom_field['type'] == 'file') {
          var index =  custom_field_id.match(/(\d)/g);
          // console.log('extracted index: ' + index);
          $('#' + html_custom_field_id)
            .clone()
            .attr('type', custom_field['type'])
            .attr('name', 'custom_field_upload_link_' + index)
            .insertAfter('#' + html_custom_field_id)
            .removeAttr("maxlength")
            .prev().remove();

            $('label[for="' + html_custom_field_id + '"]').html(
              custom_field['label'] +
               ' (<a href="' + product_related_info[custom_field_id]['upload_link'] + '">' +
               product_related_info[custom_field_id]['value'] + '</a>)'
            );
        } else if (custom_field['type'] != 'text') {
          $('#' + html_custom_field_id)
            .clone()
            .attr('type', custom_field['type'])
            .val(product_related_info[custom_field_id]['value'])
            .insertAfter('#' + html_custom_field_id)
            .removeAttr("maxlength")
            .prev().remove();
        } else {
          $('#' + html_custom_field_id).val(product_related_info[custom_field_id]['value']);
        }

        // console.log('div-' + custom_field_id);
        $('#div-' + html_custom_field_id).removeClass('hidden');
      }
    }

  });

  $('#submit-done').click(function () {
    // alert('Submit and Done');
    $('#do-continue').val('false');
    // alert($('#do-continue').val());
  });
});
