$(window).scroll(function () {
  var scroll = $(window).scrollTop();
  if (scroll >= 300) {
    $("header").addClass("shadow");
  }
  else {
    $("header").removeClass("shadow");
  }
});

$(".upper-header .close").click(function () {
  $(".upper-header").hide();
  $("main").css("padding-top", "110px");
  if ($(window).width() <= 576) {
    $("main").css("padding-top", "100px");
  }
  else if ($(window).width() <= 768) {
    $("main").css("padding-top", "70px");
  }
  else if ($(window).width() <= 992) {
    $("main").css("padding-top", "80px");
  }
})

 

function readURLimg(input) {
  if (input.files && input.files[0]) {
    var reader = new FileReader();
    reader.onload = function (e) {
      $('.image-upload-wrap').hide();
      $('.img-upload-image').attr('src', e.target.result);
      $('.img-upload-content').css("display", "flex");
      $('.image-title').html(input.files[0].name);
    };
    reader.readAsDataURL(input.files[0]);

  } else {
    removeUploadimg();
  }
}


function Favfunction(x) {
  x.classList.toggle("active");
}

$("#delete-btn").click(function () {
  $(this).parents(".address-card").remove();
})
$(".delete-btn").click(function () {
  $(this).parents(".order-card").remove();
})



var swiper = new Swiper(".offersSwiper", {
  spaceBetween: 0,
  centeredSlides: true,
  autoplay: {
    delay: 4500,
    disableOnInteraction: true,
  },
  pagination: {
    el: ".swiper-pagination",
    clickable: true,
  },
  navigation: {
    nextEl: ".swiper-button-next",
    prevEl: ".swiper-button-prev",
  },
});


var swiper = new Swiper(".productSwiper", {   
  cssMode: true,
  spaceBetween: 20,
  mousewheel: true,
  keyboard: true,
  autoplay: {
    delay: 2500,
    disableOnInteraction: true,
  },
  breakpoints: {
    340: {
      slidesPerView: 2,
    },
    768: {
      slidesPerView: 3,
    },
    1024: {
      slidesPerView: 4,
    },
    1400: {
      slidesPerView: 5,
    },
  },
});

var swiperV = new Swiper('.nestedSwiper', {
  pagination: {
    el: ".swiper-pagination-v",
    dynamicBullets: true,
  },
  paginationClickable: false,
  slidesPerView: 1,
});



var currentTab = 0; // Current tab is set to be the first tab (0)
if ($('#payment').length) {

  showTab(currentTab); // Display the current tab
}
function showTab(n) {
  // This function will display the specified tab of the form...
  var x = document.getElementsByClassName("tab");
  if ($('#payment').length) {
    x[n].style.display = "block";
  }
  //... and fix the Previous/Next buttons:
  if (n == 0) {
    document.getElementById("prevBtn").style.display = "none";
  } else {
    document.getElementById("prevBtn").style.display = "flex";
  }
}

function nextPrev(n) {
  // This function will figure out which tab to display
  var x = document.getElementsByClassName("tab");
  // Exit the function if any field in the current tab is invalid:
  x[currentTab].style.display = "none";
  // Increase or decrease the current tab by 1:s
  currentTab = currentTab + n;
  // Otherwise, display the correct tab:
  showTab(currentTab);
}

function validateForm() {
  // This function deals with validation of the form fields
  var x, y, i, valid = true;
  x = document.getElementsByClassName("tab");
  y = x[currentTab].getElementsByTagName("input");
  // A loop that checks every input field in the current tab:
  for (i = 0; i < y.length; i++) {
    // If a field is empty...
    if (y[i].value == "") {
      // add an "invalid" class to the field:
      y[i].className += " invalid";
      // and set the current valid status to false
      valid = false;
    }
  }
  // If the valid status is true, mark the step as finished and valid:
  if (valid) {
    document.getElementsByClassName("step")[currentTab].className += " finish";
  }
  return valid; // return the valid status
}



jQuery(document).ready(function () {
  $('[data-quantity="plus"]').click(function (e) {
    e.preventDefault();
    fieldName = $(this).attr('data-field');
    var currentVal = parseInt($('input[name=' + fieldName + ']').val());
    if (!isNaN(currentVal)) {
      $('input[name=' + fieldName + ']').val(currentVal + 1);
    } else {
      $('input[name=' + fieldName + ']').val(0);
    }
  });
  $('[data-quantity="minus"]').click(function (e) {
    e.preventDefault();
    fieldName = $(this).attr('data-field');
    var currentVal = parseInt($('input[name=' + fieldName + ']').val());
    if (!isNaN(currentVal) && currentVal > 0) {
      $('input[name=' + fieldName + ']').val(currentVal - 1);
    } else {
      $('input[name=' + fieldName + ']').val(0);
    }
  });
});




$("#visa-section").click(function () {
  $(".visa").show(500)
  $(this).toggleClass("active");
  $("#wallet-section").removeClass("active");
  $("#cash-section").removeClass("active")
})


$("#cash-section").click(function () {
  $(".visa").hide(500)
  $(this).toggleClass("active");
  $("#wallet-section").removeClass("active");
  $("#visa-section").removeClass("active")
})

$("#wallet-section").click(function () {
  $(".visa.method").hide(500)
  $(this).toggleClass("active");
  $("#visa-section").removeClass("active");
  $("#cash-section").removeClass("active")
})




const ratingStars = [...document.getElementsByClassName("rating-star")];

function executeRating(stars) {
  const starClassActive = "rating-star active";
  const starClassInactive = "rating-star";
  const starsLength = stars.length;
  let i;
  stars.map((star) => {
    star.onclick = () => {
      i = stars.indexOf(star);

      if (star.className === starClassInactive) {
        for (i; i >= 0; --i) stars[i].className = starClassActive;
      } else {
        for (i; i < starsLength; ++i) stars[i].className = starClassInactive;
      }
    };
  });
}
executeRating(ratingStars);




function currentDiv(n) {
  showDivs(slideIndex = n);
}
function showDivs(n) {
  var i;
  var x = document.getElementsByClassName("productSlides");
  var dots = document.getElementsByClassName("preview");
  if (n > x.length) { slideIndex = 1 }
  if (n < 1) { slideIndex = x.length }
  for (i = 0; i < x.length; i++) {
    x[i].style.display = "none";
  }
  for (i = 0; i < dots.length; i++) {
    dots[i].className = dots[i].className.replace("opacity-low", "opacity-full");
  }
  x[slideIndex - 1].style.display = "block";
  dots[slideIndex - 1].className += " opacity-low";
}




$(document).ready(function () {
  $(document).on("click", "#ShareButton", function (e) {
    $("body").append('<input id="copyURL" type="text" value="" />');
    $("#copyURL").val(window.location.href).select();
    document.execCommand("copy");
    $("#copyURL").remove();
  });
});


if ($('.login-form').length) {
  const togglePassword = document.querySelector('#togglePassword');
  togglePassword.classList.add('opacity-full')
  const password = document.querySelector("input[type='password']");
  togglePassword.addEventListener('click', function (e) {
    // toggle the type attribute
    const type = password.getAttribute('type') === 'password' ? 'text' : 'password';
    password.setAttribute('type', type);
    // toggle the eye slash icon
    this.classList.toggle('opacity-full');
    this.classList.toggle('opacity-low');
  });
}
