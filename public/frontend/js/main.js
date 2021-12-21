/*  ---------------------------------------------------
    Template Name: Fashi
    Description: Fashi eCommerce HTML Template
    Author: Colorlib
    Author URI: https://colorlib.com/
    Version: 1.0
    Created: Colorlib
---------------------------------------------------------  */

"use strict";

(function ($) {
  /*------------------
        Preloader
    --------------------*/
  $(window).on("load", function () {
    $(".loader").fadeOut();
    $("#preloder").delay(200).fadeOut("slow");
  });

  /*------------------
        Background Set
    --------------------*/
  $(".set-bg").each(function () {
    var bg = $(this).data("setbg");
    $(this).css("background-image", "url(" + bg + ")");
  });

  /*------------------
		Navigation
	--------------------*/
  $(".mobile-menu").slicknav({
    prependTo: "#mobile-menu-wrap",
    allowParentLinks: true,
  });

  /*------------------
        Hero Slider
    --------------------*/
  $(".hero-items").owlCarousel({
    loop: true,
    margin: 0,
    nav: true,
    items: 1,
    dots: false,
    animateOut: "fadeOut",
    animateIn: "fadeIn",
    navText: [
      '<i class="ti-angle-left"></i>',
      '<i class="ti-angle-right"></i>',
    ],
    smartSpeed: 1200,
    autoHeight: false,
    autoplay: true,
  });

  /*------------------
        Product Slider
    --------------------*/
  $(".product-slider").owlCarousel({
    loop: true,
    margin: 25,
    nav: true,
    items: 4,
    dots: true,
    navText: [
      '<i class="ti-angle-left"></i>',
      '<i class="ti-angle-right"></i>',
    ],
    smartSpeed: 1200,
    autoHeight: false,
    autoplay: true,
    responsive: {
      0: {
        items: 1,
      },
      576: {
        items: 2,
      },
      992: {
        items: 2,
      },
      1200: {
        items: 6,
      },
    },
  });

  /*------------------
        Product Slider
    --------------------*/
  $(".testimonial-slider").owlCarousel({
    loop: true,
    margin: 25,
    nav: true,
    items: 4,
    dots: true,
    navText: [
      '<i class="ti-angle-left"></i>',
      '<i class="ti-angle-right"></i>',
    ],
    smartSpeed: 1200,
    autoHeight: false,
    autoplay: true,
    responsive: {
      0: {
        items: 1,
      },
    },
  });

  /*------------------
        Related products
    --------------------*/
  $(".related-slider").owlCarousel({
    loop: true,
    margin: 10,
    nav: true,
    items: 4,
    dots: true,
    navText: [
      '<i class="ti-angle-left"></i>',
      '<i class="ti-angle-right"></i>',
    ],
    smartSpeed: 1200,
    autoHeight: false,
    autoplay: true,
    responsive: {
      0: {
        items: 2,
      },
      576: {
        items: 2,
      },
      992: {
        items: 2,
      },
      1200: {
        items: 4,
      },
    },
  });

  $(".brands-carousel").owlCarousel({
    loop: true,
    margin: 0,
    nav: true,
    items: 4,
    dots: true,
    navText: [""],
    smartSpeed: 1200,
    autoHeight: false,
    autoplay: true,
    responsive: {
      0: {
        items: 2,
      },
      576: {
        items: 2,
      },
      992: {
        items: 2,
      },
      1200: {
        items: 6,
      },
    },
  });

  $("#schedule-carousel").owlCarousel({
    loop: true,
    margin: 0,
    nav: true,
    items: 1,
    dots: true,
    navText: [""],
    smartSpeed: 1200,
    autoHeight: false,
    autoplay: true,
    autoplayTimeout: 4000,
  });

  /*------------------
       logo Carousel
    --------------------*/
  $(".logo-carousel").owlCarousel({
    loop: false,
    margin: 30,
    nav: false,
    items: 5,
    dots: false,
    navText: [
      '<i class="ti-angle-left"></i>',
      '<i class="ti-angle-right"></i>',
    ],
    smartSpeed: 1200,
    autoHeight: false,
    mouseDrag: false,
    autoplay: true,
    responsive: {
      0: {
        items: 3,
      },
      768: {
        items: 5,
      },
    },
  });

  /*-----------------------
       Product Single Slider
    -------------------------*/
  $(".ps-slider").owlCarousel({
    loop: false,
    margin: 10,
    nav: true,
    items: 6,
    dots: false,
    navText: [
      '<i class="fa fa-angle-left"></i>',
      '<i class="fa fa-angle-right"></i>',
    ],
    smartSpeed: 1200,
    autoHeight: false,
    autoplay: true,
  });

  /*------------------
        CountDown
    --------------------*/
  // For demo preview
  var today = new Date();
  var dd = String(today.getDate()).padStart(2, "0");
  var mm = String(today.getMonth() + 1).padStart(2, "0"); //January is 0!
  var yyyy = today.getFullYear();

  if (mm == 12) {
    mm = "01";
    yyyy = yyyy + 1;
  } else {
    mm = parseInt(mm) + 1;
    mm = String(mm).padStart(2, "0");
  }
  var timerdate = mm + "/" + dd + "/" + yyyy;
  // For demo preview end

  console.log(timerdate);

  // Use this for real timer date
  /* var timerdate = "2020/01/01"; */

  $("#countdown").countdown(timerdate, function (event) {
    $(this).html(
        event.strftime(
            "<div class='cd-item'><span>%D</span> <p>Days</p> </div>" +
            "<div class='cd-item'><span>%H</span> <p>Hrs</p> </div>" +
            "<div class='cd-item'><span>%M</span> <p>Mins</p> </div>" +
            "<div class='cd-item'><span>%S</span> <p>Secs</p> </div>"
        )
    );
  });

  /*----------------------------------------------------
     Language Flag js
    ----------------------------------------------------*/
  $(document).ready(function (e) {
    //no use
    try {
      var pages = $("#pages")
          .msDropdown({
            on: {
              change: function (data, ui) {
                var val = data.value;
                if (val != "") window.location = val;
              },
            },
          })
          .data("dd");

      var pagename = document.location.pathname.toString();
      pagename = pagename.split("/");
      pages.setIndexByValue(pagename[pagename.length - 1]);
      $("#ver").html(msBeautify.version.msDropdown);
    } catch (e) {
      // console.log(e);
    }
    $("#ver").html(msBeautify.version.msDropdown);

    //convert
    $(".language_drop").msDropdown({ roundedBorder: false });
    $("#tech").data("dd");
  });
  /*-------------------
		Range Slider
	--------------------- */
  var rangeSlider = $(".price-range"),
      minamount = $("#minamount"),
      maxamount = $("#maxamount"),
      minPrice = rangeSlider.data("min"),
      maxPrice = rangeSlider.data("max");
  rangeSlider.slider({
    range: true,
    min: minPrice,
    max: maxPrice,
    values: [minPrice, maxPrice],
    slide: function (event, ui) {
      minamount.val("$" + ui.values[0]);
      maxamount.val("$" + ui.values[1]);
    },
  });
  minamount.val("$" + rangeSlider.slider("values", 0));
  maxamount.val("$" + rangeSlider.slider("values", 1));

  /*-------------------
		Radio Btn
	--------------------- */
  $(".fw-size-choose .sc-item label, .pd-size-choose .sc-item label").on(
      "click",
      function () {
        $(
            ".fw-size-choose .sc-item label, .pd-size-choose .sc-item label"
        ).removeClass("active");
        $(this).addClass("active");
      }
  );

  /*-------------------
		Nice Select
    --------------------- */
  $(
      ".sorting, .p-show, .service-selector, .search-type-selector, #currency-selector"
  ).niceSelect();

  $(".insta-item").click(function () {
    console.log($(this).find("a"));
    window.open($(this).find("a")[0]);
  });

  // $('.viewList').each(function(){
  //   console.log($(this))

  // })

  // $('.viewParent').append(
  //   `  <a  class="viewList">
  //   View all
  // </a>`
  // )

  // $('.viewList').on('click',function(){
  //   alert("hoi")
  // })

  $(".viewParent").css("padding-bottom", "2rem");

  $(function () {
    $("#datepicker").datepicker({
      minDate: 0,
      showOtherMonths: true,
      selectOtherMonths: true,
      defaultDate: new Date(),
    });
  });

  /*------------------
		Single Product
	--------------------*/
  $(".product-thumbs-track .pt").on("click", function () {
    $(".product-thumbs-track .pt").removeClass("active");
    $(this).addClass("active");
    var imgurl = $(this).data("imgbigurl");
    var bigImg = $(".product-big-img").attr("src");
    if (imgurl != bigImg) {
      $(".product-big-img").attr({ src: imgurl });
      $(".zoomImg").attr({ src: imgurl });
    }
  });

  $(".product-pic-zoom").zoom();

  if ($(window).width() < 480) {
    $(".product-pic-zoom").trigger('zoom.destroy')

  }

  /*-------------------
		Quantity change
	--------------------- */
  // var proQty = $(".pro-qty");
  // proQty.on("click", ".qtybtn", function () {
  //   var $button = $(this);
  //   var oldValue = $button.parent().find("input").val();
  //   if ($button.hasClass("inc")) {
  //     var newVal = parseFloat(oldValue) + 1;
  //   } else {
  //     // Don't allow decrementing below zero
  //     if (oldValue > 0) {
  //       var newVal = parseFloat(oldValue) - 1;
  //     } else {
  //       newVal = 0;
  //     }
  //   }
  //   $button.parent().find("input").val(newVal);
  //   $button.parent().find("input").attr("value", newVal);
  // });
})(jQuery);

$(".heart-icon").click(function (e) {
  e.stopPropagation();
  $(this).addClass("active");
  $(".user-acc, .cart-icon").removeClass("active");
});

$(".cart-icon").click(function (e) {
  e.stopPropagation();
  $(this).addClass("active");
  $(".user-acc, .heart-icon").removeClass("active");
});

$(".user-acc").click(function (e) {
  e.stopPropagation();
  $(this).addClass("active");
  $(".cart-icon, .heart-icon").removeClass("active");
});

$("body").click(function () {
  $(".user-acc, .heart-icon, .cart-icon").removeClass("active");
});

// for dashboard image
$(".user-img-box .overlay").click(function () {
  $(this).parents(".user-img-box").find("input").trigger("click");
});

// $(".service-sub-details").hide();

$("#mbServiceExPopup .service-sub-details").show();

$(".service-explore-card .view-btn, .service-explore-card primary-btn").click(
    function (e) {
      e.preventDefault();
      $(".service-sub-details").fadeIn();
    }
);

$("#service-sub-carousel, #service-sub-carousel2").owlCarousel({
  loop: true,
  margin: 0,
  nav: true,
  items: 1,
  dots: false,
  animateOut: "fadeOut",
  animateIn: "fadeIn",
  navText: ['<i class="ti-angle-left"></i>', '<i class="ti-angle-right"></i>'],
  smartSpeed: 1200,
  autoHeight: false,
  autoplay: true,
});

// change id of search field on the basis of selected dropdown

$(".search-type-selector").bind("DOMSubtreeModified", function () {
  // console.log("hi");
  let selectedCat = $(this).find(".current").text();

  $("#search-input-wrapper")
      .find("input")
      .attr("id", selectedCat + "_data");

  // $(this)
  //   .find("li")
  //   .each(function () {
  //     if ($(this).hasClass("selected")) {
  //       console.log($(this).attr("data-value"));
  //     }
  //   });
});

// for scheduling service

// $(function () {
//   $("#datepicker").datepicker("setDate", "today");
//   $("#fdate")
//       .datetimepicker({
//         dateFormat: "yy-mm-dd",
//         timeFormat: "HH:mm:ss",
//         onShow: function () {
//           this.setOptions({
//             maxDate: $("#tdate").val() ? $("#tdate").val() : false,
//             maxTime: $("#tdate").val() ? $("#tdate").val() : false,
//           });
//         },
//       })
//       .attr("readonly", "readonly");
// });

// ---------------------------for rating

// on mouse over
let currentIndex = -1;
$(".give-stars span").hover(() => {});
$(".give-stars span").mouseover(function () {
  removeClass(this);
  var upto = $(this).index();
  $(this)
      .parent()
      .children()
      .each(function (index, value) {
        if (index <= upto) {
          $(this).addClass("hoveredYellow");
        } else {
        }
      });
});

// on mouse out

$(".give-stars span").mouseout(function () {
  var upto = $(this).index();
  $(this)
      .parent()
      .children()
      .each(function (index, value) {
        $(this).removeClass("hoveredYellow");
      });
  setColor(this, currentIndex);
});
const removeClass = ($this) => {
  $($this)
      .parent()
      .children()
      .each(function () {
        $(this).removeClass("clickedYellow");
      });
};
const setColor = ($this, upto) => {
  $($this)
      .parent()
      .children()
      .each(function (index, value) {
        if (index <= upto) {
          $(this).addClass("clickedYellow");
        } else {
        }
      });
};
// on mouse click
$(".give-stars span").click(function () {
  var upto = $(this).index();
  currentIndex = upto;
  $(".ratingGiven").text(upto + 1 + " / 5");
  setColor(this, upto);
});

$(function () {
  $('[data-toggle="tooltip"]').tooltip();
});

$(document).ready(function () {
  $(".venobox").venobox({
    share: [],
  });
});

$("#offcanvas-filter-btn").click(function () {
  $(".produts-sidebar-filter").addClass("open");
  $("body").addClass("offcanvas-filter-active");
});

$("#offcanvas-filter-closebtn").click(function () {
  $(".produts-sidebar-filter").removeClass("open");
  $("body").removeClass("offcanvas-filter-active");
  console.log("removed");
});


// remove from checkout
$(".order-table li:nth-of-type(n+2) .close-td").click(function () {
  $(this).parents("li").remove();
});

$("#form-search").hide();

$("#form-next").click(function () {
  let curTab = $("#sbsformTab").find(".active");
  let curTabIndex = $("#sbsformTab").find(".active").parents("li").index();
  let nextTab = $("#sbsformTab").find(".active").parents("li").next().index();
  let totalTabs = $("#sbsformTab").find("li").length;

  if (nextTab < totalTabs && nextTab > 0) {
    $("#sbsformTab").find("li").eq(nextTab).find("a").addClass("active");
    curTab.removeClass("active");
    console.log(curTab.index());

    $("#sbsformTabContent")
        .find(".tab-pane")
        .eq(nextTab)
        .addClass("show active");
    $("#sbsformTabContent")
        .find(".tab-pane")
        .eq(curTabIndex)
        .removeClass("show active");
  }

  if (nextTab + 1 === totalTabs) {
    $("#form-search").show();
    $("#form-next").hide();
  }
});

$("#sbsformTabContent")
    .find(".tab-pane.active")
    .find("label")
    .each(function () {
      let selectFlag = $(this).find("input:checked");
      console.log(selectFlag);
    });

$("#form-prev").click(function () {
  let curTab = $("#sbsformTab").find(".active");
  let prevTabIndex = $("#sbsformTab").find(".active").parents("li").index();
  let prevTab = $("#sbsformTab").find(".active").parents("li").prev().index();
  let totalTabs = $("#sbsformTab").find("li").length;
  if (prevTab < totalTabs && prevTab >= 0) {
    $("#sbsformTab").find("li").eq(prevTab).find("a").addClass("active");
    curTab.removeClass("active");

    $("#sbsformTabContent")
        .find(".tab-pane")
        .eq(prevTab)
        .addClass("show active");
    $("#sbsformTabContent")
        .find(".tab-pane")
        .eq(prevTabIndex)
        .removeClass("show active");
  }

  $("#form-search").hide();
  $("#form-next").show();

  $(".tab-pane.active").css(" animation", "slide-left 1s ease-out;");
});

$("#sbsformTabContent input").click(function () {
  $("#form-next").trigger("click");

  // get values

  var skinType = $('input[name=skin_type]:checked + span').text();
  var skinConcern = $('input[name=skin_concern]:checked + span').text();
  var productType = $('input[name=product_type]:checked + span').text();

  console.log(skinType, skinConcern, productType);

  $('#selectedValues').html(
      `<li>${skinType}</li><li>${skinConcern}</li><li>${productType}</li>`
  )
});