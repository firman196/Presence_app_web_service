$(function() {
  'use strict'

  if ($(".select-item").length) {
    $(".select-item").select2();
  
  }
  
  //multiple select 2
  if ($(".select-item-multiple").length) {
    $(".select-item-multiple").select2({
      maximumSelectionLength: 5,
      placeholder: "Pilih Ruangan",
      allowClear: true

    });
   
    $('#roles_id').select2({
      placeholder: "Hak Akses",
      allowClear: true
    });
   
  }
  

  //menonaktifkan autosorting pada select2
  $(".select-item-multiple").on("select2:select", function (evt) {
    var element = evt.params.data.element;
    var $element = $(element);
   
    $element.detach();
    $(this).append($element);
    $(this).trigger("change");
  });
});