  $(document).ready(function () {

// test
  //slider
   $('.your-class').slick({
      infinite: true,
  		slidesToShow: 3,
  		slidesToScroll: 1,
  		dots: true
    });

   // slick slider
   $('.gallery').slick({
      infinite: true,
      slidesToShow: 1,
      slidesToScroll: 1,
      arrows: false
    });

  // search block   
   searchBlk = $('<div class="search-bar search-main"><div class="container page-container p-0"><div class="search-block"><div class="search-left float-left"><input type="search" name="txtsearch" placeholder="Where do you want to go?" class="txtsearch" /><input type="text" name="txtcal" class="txtcal" /><input type="text" name="txtguests" class="txtguests"></div><div class="search-right float-left"><button name="btnsearch" class="btn btn-primary btn-search">SEARCH</button></div></div></div></div>');
   $('.hero-block .slide-content').append(searchBlk);

   // pop-over
   $("[data-toggle=popover]").popover();
   //$('#collapseDestination').collapse();

});


function toggleSearch() {
	$('.search-bar').slideToggle("fast");
}

/* Set the width of the side navigation to 250px */
function openNav() {
  document.getElementById("mySidenav").style.width = "310px";
  document.body.style.backgroundColor = "rgba(0,0,0,0.4)";
}

/* Set the width of the side navigation to 0 */
function closeNav() {
  document.getElementById("mySidenav").style.width = "0";
  document.body.style.backgroundColor = "rgba(0,0,0,0)";
}

// Detect Scroll
$(window).scroll(function () {
	//$(document).scrollTop() > 2 ? $("#topnav").addClass("bgHeader") : $("#header").removeClass("bgHeader")
	console.log('scroll');
 });

// Pop-up on info icon
$(function () {
  $('.btn-popup').popover({
    //trigger: 'hover',
    container: 'body',
    placement:'top',
    html: true
  })
})

// bootstrap slider 
/*
 $('.carousel-inner').each(function(){
        $(this).find('.carousel-item').first().addClass('active');
    });
*/


// owl carousel
$('.owl-carousel').owlCarousel({
  items:1,
  loop: true,
  autoplay: true,
  autoplayTimeout: 10000
});



//accordion page gift voucher
var acc = document.getElementsByClassName("accordion");
var i;
for (i = 0; i < acc.length; i++) {
  acc[i].addEventListener("click", function() {
    this.classList.toggle("active");
    var panel = this.nextElementSibling;
    if (panel.style.display === "block") {
      panel.style.display = "none";
    } else {
      panel.style.display = "block";
    }
  });
}

//click icon heart page landing
$(document).ready(function(){
  $('.hover-fa-heart').click(function(){
    $(this).toggleClass("fa-heart fa-heart-o");
  });
});

//loading modal in checkout template
$(document).ready(function(){
  $('#checkout-button-reverve-id').click(function(){
    setTimeout(function(){
       $('#reserveModal').modal('hide');
       location.reload();
   }, 3000);

  });
});


