$(document).ready(function() {
  $('#customers').on('change', function() {
    var customers_product_list = $( this ).data('customers-product-list');
    // console.log(customers_product_list);

    var product_list = customers_product_list[$( this ).val()];
    // console.log(product_list);

    var product_select = $('#products');
    // clear product select
    product_select.find('option')
      .remove()
      .end()
      .append($("<option>").attr('value', '').text(''));

    // console.log(product_select);
    // Refill product select with current customer product list
    $(product_list).each(function() {
      console.log(this);
      product_select.append($("<option>").attr('value',this.id).text(this.name));
    });

  });

  $('#technician').on('change', function() {
    console.log('Update status to assigned')
    $('#status').val('Assigned')
  });
});
