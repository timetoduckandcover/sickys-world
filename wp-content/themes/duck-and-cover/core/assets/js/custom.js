jQuery(document).ready(function($){

  function custom_title_style () {
    var value = $("#facewp_abbey_title_style").val();
    switch(value) {
      case "bg_color":
        $(".cmb2-id-facewp-heading-image").hide();
        $(".cmb2-id-facewp-disable-parallax").hide();
        break;
      case "image":
        $(".cmb2-id-facewp-heading-bg-color").hide();
        break;
      default:
        $(".cmb2-id-facewp-heading-image").hide();
        $(".cmb2-id-facewp-disable-parallax").hide();
        $(".cmb2-id-facewp-heading-bg-color").hide();
        $(".cmb2-id-facewp-heading-color").hide();
    }
  }

  custom_title_style();

  if(!$("#facewp_abbey_enable_title").prop("checked")) {
    $(".cmb2-id-facewp-title-style").hide();
    $(".cmb2-id-facewp-heading-image").hide();
    $(".cmb2-id-facewp-disable-parallax").hide();
    $(".cmb2-id-facewp-heading-bg-color").hide();
    $(".cmb2-id-facewp-heading-color").hide();
    $(".cmb2-id-facewp-alt-title").hide();
  }

  //"Enable title" options
  $("#facewp_abbey_enable_title").change(function(){
    if($("#facewp_abbey_enable_title").prop("checked")) {
      $(".cmb2-id-facewp-title-style").slideDown();
      $(".cmb2-id-facewp-heading-image").slideDown();
      $(".cmb2-id-facewp-disable-parallax").slideDown();
      $(".cmb2-id-facewp-alt-title").slideDown();
      $(".cmb2-id-facewp-heading-bg-color").slideDown();
      $(".cmb2-id-facewp-heading-color").slideDown();
      custom_title_style();
    } else {
      $(".cmb2-id-facewp-title-style").slideUp();
      $(".cmb2-id-facewp-heading-image").slideUp();
      $(".cmb2-id-facewp-disable-parallax").slideUp();
      $(".cmb2-id-facewp-alt-title").slideUp();
      $(".cmb2-id-facewp-heading-bg-color").slideUp();
      $(".cmb2-id-facewp-heading-color").slideUp();
    }
  });

  // Choose heading title style
  $("#facewp_abbey_title_style").change(function(){
    var value = $(this).val();
    switch(value) {
      case "bg_color":
        $(".cmb2-id-facewp-heading-image").slideUp();
        $(".cmb2-id-facewp-disable-parallax").slideUp();
        $(".cmb2-id-facewp-heading-bg-color").slideDown();
        $(".cmb2-id-facewp-heading-color").slideDown();
        break;
      case "image":
        $(".cmb2-id-facewp-heading-image").slideDown();
        $(".cmb2-id-facewp-disable-parallax").slideDown();
        $(".cmb2-id-facewp-heading-bg-color").slideUp();
        $(".cmb2-id-facewp-heading-color").slideDown();
        break;
      default:
        $(".cmb2-id-facewp-heading-image").slideUp();
        $(".cmb2-id-facewp-disable-parallax").slideUp();
        $(".cmb2-id-facewp-heading-bg-color").slideUp();
        $(".cmb2-id-facewp-heading-color").slideUp();
    }
  });
});