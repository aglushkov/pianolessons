$(function(){
  $(function() {
    var slider = $('.slider-for')
    slider.slick({
      slidesToShow: 1,
      slidesToScroll: 1,
      arrows: false,
      fade: true
    });
    $('.slick-custom-nav img').click(function(){
      slider.slick('slickGoTo', $(this).index());
    });
  });
});


