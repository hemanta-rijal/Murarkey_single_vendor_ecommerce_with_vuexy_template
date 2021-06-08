//Todays Slider
$('.slider').slick({
  slidesToShow: 6,
  slidesToScroll: 3,
  dots: true,
  autoplay: true,
  autoplaySpeed: 2000,
  infinite: true,
  cssEase: 'linear',

  responsive: [
    {
      breakpoint: 1024,
      settings: {
        slidesToShow: 3,
        slidesToScroll: 2,
        infinite: true,
        dots: true
      }
    },
    {
      breakpoint: 600,
      settings: {
        slidesToShow: 1,
        slidesToScroll: 1
      }
    },
  ]
});


//Grocery Slider
$('.grocery').slick({
  slidesToShow: 4,
  slidesToScroll: 2,
  dots: true,
  autoplay: true,
  autoplaySpeed: 2000,
  infinite: true,
  cssEase: 'linear',

  responsive: [
    {
      breakpoint: 1024,
      settings: {
        slidesToShow: 3,
        slidesToScroll: 2,
        infinite: true,
        dots: true
      }
    },
    {
      breakpoint: 600,
      settings: {
        slidesToShow: 1,
        slidesToScroll: 1
      }
    },
  ]
});


$('.minus-btn').on('click', function (e) {
  e.preventDefault();
  var $this = $(this);
  var $input = $this.closest('div').find('input');
  var value = parseInt($input.val());

  if (value > 1) {
    value = value - 1;
  } else {
    value = 0;
  }

  $input.val(value);

});


/*=========Quantity============*/

$('.plus-btn').on('click', function (e) {
  e.preventDefault();
  var $this = $(this);
  var $input = $this.closest('div').find('input');
  var value = parseInt($input.val());

  if (value < 100) {
    value = value + 1;
  } else {
    value = 100;
  }

  $input.val(value);
});


$(document).ready(function () {

  // Specific code for the heart fill toggle
  $("#heart-liked").click(function (e) {
    $(this).toggleClass("far").toggleClass("fas"); // Toggle the filling !
  });

  // Action when click on a link (color)
  $(".item-details a").click(function (e) {
    e.preventDefault();
    $(this).toggleClass("selected"); // Toggle the colored class !
  });

});


/*=========ADD TO CART============*/
var currentItems = 0;
$(document).ready(function () {
  $(".cart").click(function () {
    currentItems++;
    $(".cart-badge").text(currentItems);
  });
});


/*=========Filter Page============*/
//Partial Collapse for Related Categories
$('.expand-button').on('click', function () {
  $('.list').toggleClass('-expanded');

  if ($('.list').hasClass('-expanded')) {
    $('.expand-button').html('View Less');
  } else {
    $('.expand-button').html('View More');
  }
});


//Partial Collapse for Brand
$('.brand-expand').on('click', function () {
  $('.brand-form').toggleClass('-expanded');

  if ($('.brand-form').hasClass('-expanded')) {
    $('.brand-expand').html('View Less');
  } else {
    $('.brand-expand').html('View More');
  }
});


//Partial Collapse for color
$('.color-expand').on('click', function () {
  $('.color-form').toggleClass('-expanded');

  if ($('.color-form').hasClass('-expanded')) {
    $('.color-expand').html('View Less');
  } else {
    $('.color-expand').html('View More');
  }
});



$(function () {



  /*==========================*
    * PRODUCT GALLERY
  ===========================*/
  //Static Variable
  var THUMBNAIL_WIDTH = 140,
    GALLERY = $('#slideshow');


  /******************************
  * EVENT LISTENERS
  ******************************/
  GALLERY.find('.thumb').on('click', function () {
    loadClickedImage($(this).data('thumb-id'));
  });
  GALLERY.find('#prev-btn').on('click', function () {
    slidePrev();
  });
  GALLERY.find('#next-btn').on('click', function () {
    slideNext();
  });
  $(document).keydown(function (e) {
    switch (e.keyCode) {
      // Left arrow press
      case 37:
        slidePrev();
        break;
      // Right arrow press
      case 39:
        slideNext();
        break;
      default:
        break;
    }
  });



  /******************************
  * GALLERY FUNCTIONS
  ******************************/
  var slideNext = function () {

    var active = GALLERY.find('.img-wrapper.active');

    if (active.length === 0) {
      active = GALLERY.find('.img-wrapper:last');
    }

    // Setting next image & thumb properties
    loadNextImage(active);
  };

  var loadNextImage = function (active) {
    var next = active.next(".img-wrapper").length ? active.next(".img-wrapper") : GALLERY.find('.img-wrapper:first'),
      nextThumb = GALLERY.find('[data-thumb-id="' + next.data('img-id') + '"]');

    // Setting next image & thumb properties
    GALLERY.find('.thumb').removeClass('active');
    nextThumb.addClass('active');
    active.addClass('last-active');

    // Transitioning to next image & thumbnail
    scrollThumbnails(nextThumb);
    next.css({ opacity: 0.0 })
      .addClass('active')
      .animate({ opacity: 1.0 }, 1000, function () {
        active.removeClass('active last-active');
      });
  };

  var slidePrev = function () {
    var active = GALLERY.find('.img-wrapper.active');

    if (active.length === 0) {
      active = GALLERY.find('.img-wrapper:last');
    }

    // Setting next image & thumb properties
    loadPrevImage(active);
  };

  var loadPrevImage = function (active) {
    var prev = active.prev(".img-wrapper").length ? active.prev(".img-wrapper") : GALLERY.find('.img-wrapper:last'),
      prevThumb = GALLERY.find('[data-thumb-id="' + prev.data('img-id') + '"]');

    // Setting next image & thumb properties
    GALLERY.find('.thumb').removeClass('active');
    prevThumb.addClass('active');
    active.addClass('last-active');

    // Transitioning to next image & thumbnail
    scrollThumbnails(prevThumb);
    prev.css({ opacity: 0.0 })
      .addClass('active')
      .animate({ opacity: 1.0 }, 1000, function () {
        active.removeClass('active last-active');
      });
  };

  var loadClickedImage = function (id) {
    var image = GALLERY.find('[data-img-id="' + id + '"]'),
      imgThumb = GALLERY.find('[data-thumb-id="' + id + '"]'),
      currActive = GALLERY.find('.img-wrapper.active');

    // Setting image & thumb properties
    GALLERY.find('.thumb').removeClass('active');
    currActive.addClass('last-active').removeClass('active');
    imgThumb.addClass('active');

    // Transitioning to image & thumbnail
    scrollThumbnails(imgThumb);
    image.css({ opacity: 0.0 })
      .addClass('active')
      .animate({ opacity: 1.0 }, 1000, function () {
        currActive.removeClass('last-active');
      });
  };

  var scrollThumbnails = function (thumb) {
    var offset, // used for thumbnail offset
      first,  // stores first thumbnail object
      x = thumb.position().left + parseInt(thumb.css('margin-left'), 10);

    // Checking current thumbnail offset
    if (x < 0) {
      first = GALLERY.find('.thumb:first');
      offset = parseInt(first.css('margin-left'), 10) - x;
      first.animate({
        marginLeft: offset
      }, 1000);
    } else {
      x = thumb.position().left;
      var currOffset = (x + THUMBNAIL_WIDTH) - thumb.parent().width();
      if (currOffset > 0) {
        first = GALLERY.find('.thumb:first');
        offset = parseInt(first.css('margin-left'), 10) - currOffset;
        first.animate({
          marginLeft: offset
        }, 1000);
      }
    }
  };
}());


// dashboard sidebar
$(document).ready(function () {
  $('#sidebarCollapse').on('click', function () {
      $('#db-sidebar').toggleClass('active');
      $(this).toggleClass('active');
      // $(this).find('svg').css('transform','rotate(180deg)')
      
     
      
      
  });

});
