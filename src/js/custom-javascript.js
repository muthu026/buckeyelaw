// Add your custom JS here.

(function ($) {
  $(document).ready(function () {
    $('li.menu-item-has-children').on('mouseover', function () {
      let valueWidth = $(this).find('ul.dropdown-menu').width();
      $('li.menu-item-has-children ul li ul').css('left', valueWidth + 'px');
    });

    $('li.menu-item-has-children > a').after(
      '<span class="new-span d-inline-block d-xl-none ms-auto"><i class="fa fa-plus" aria-hidden="true"></i></span>'
    );

    $('li.menu-item-has-children > span.new-span').click(function () {
      $(this).closest('li').children('ul').toggleClass('show');
      $(this).closest('li').children('.new-span').toggleClass('active');
    });
  });

  jQuery(document).ready(function ($) {
    $('.logocarousel').slick({
      slidesToShow: 6,
      slidesToScroll: 1,
      autoplay: false,
      autoplaySpeed: 2000,
      arrows: true,
      dots: false,
      responsive: [
        {
          breakpoint: 1024,
          settings: {
            slidesToShow: 3,
            slidesToScroll: 1,
          },
        },
        {
          breakpoint: 600,
          settings: {
            slidesToShow: 2,
            slidesToScroll: 1,
          },
        },
        {
          breakpoint: 480,
          settings: {
            slidesToShow: 1,
            slidesToScroll: 1,
          },
        },
      ],
    });
  });
})(jQuery);
