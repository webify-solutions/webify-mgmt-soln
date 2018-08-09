$(document).ready(function() {
  $('#product').on('change', function() {
    price_list_json = $('#unit-price').data('price-list');
    // console.log(price_list_json);
    // console.log(JSON.stringify(price_list_json));
    price_json = price_list_json[$( this ).val()];
    // console.log(JSON.stringify(price_json));

    product_keys = Object.keys(price_json);
    // console.log(price_json[product_keys]);
    $('#unit-price').val(price_json[product_keys]);
  });

  $('#submit-done').click(function () {
    // alert('Submit and Done');
    $('#do-continue').val('false');
    // alert($('#do-continue').val());
  });
});
