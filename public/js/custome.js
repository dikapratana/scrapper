jQuery(document).ready(function($) {
  var alterClass = function() {
    var ww = document.body.clientWidth;
    if (ww < 767) {
      $('.chiller-theme').removeClass('toggled');
      $('.chiller-theme').removeClass('desktop-min');
    } else if (ww >= 767) {
      $('.chiller-theme').addClass('toggled');
    };
  };
  $(window).resize(function(){
    alterClass();
  });
  //Fire it when the page first loads:
  alterClass();

  $('body').on('click','.btn-toggle-menu',function(){
        if ($('.page-wrapper').hasClass('toggled')) {
          $(this).find('.fa').addClass('fa-angle-right').removeClass('fa-angle-left');
          $('.page-wrapper').removeClass('toggled').addClass('desktop-min');
          // $('.page-wrapper').addClass('desktop-min');
        }else{
          $('.page-wrapper').addClass('toggled').removeClass('desktop-min');
          $(this).find('.fa').addClass('fa-angle-left').removeClass('fa-angle-right');
          // $('.page-wrapper').removeClass('desktop-min');
        }
      });
});