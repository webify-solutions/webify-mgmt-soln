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
  });

});
