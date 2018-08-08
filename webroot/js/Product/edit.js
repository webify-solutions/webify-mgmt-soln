$(document).ready(function(){
  $('#category-name').change(function(){
    console.log($( this ).val());

    category_name = $( this ).val();
    $("#category-id option").filter(function() {
      //may want to use $.trim in here
      return $( this ).text() == category_name;
    }).prop('selected', true);
    console.log($('#category-id').val());
    console.log($('#category-id'));
  })
});
