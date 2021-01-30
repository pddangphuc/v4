  $(document).ready(function () {

  // search block   

    var addInput = '#txtguests'; //This is the id of the input you are changing
    var n = 2; //n is equal to 1
    
    $('.list-filter-tag .close-item').click(function(){
        $(this).parent('.item').remove();
    });

    $('.opacity-search-bar-nav-bg').on('click', function(e) {
        $(".opacity-search-bar-nav-bg").hide();
        $('#popover_template_search').hide();
        $('#popover_template').hide();
    });
    
    $('.txtguests-main').click(function () {
         $('#popover_template').toggle();
    });
    // hide background opacity of search bar
    window.onscroll = function() {
       $(".popover").hide();
      // $(".opacity-search-bar-nav-bg").css({"display":"none"});
     
    }
    // show background opacity when clcik search 
    $(document).on('click', '.search-bar-main', function(){
         $(".opacity-search-bar-nav-bg").css({"display":"block", "width":"100%"});
    });
    $(document).on('click', '.search-bar', function(){
         $(".opacity-search-bar-nav-bg").css({"display":"block", "width":"100%"});
    });
    $(document).on('click', '#txtcal', function(){
         $("[rel=comments]").not(this).popover('hide');
    });
    $(document).on('click', '#txtcal-search-block', function(){
         $("[rel=comments]").not(this).popover('hide');
          $('#popover_template_search').hide();
        $('#popover_template').hide();
    });
    
    // call function event of search bar
    
    $( "#txtsearch" ).focus(function() {
     $(".opacity-search-bar-nav-bg").show();
    });
    
    $('.txtguests').click(function () {
        $('#popover_template').toggle();
        $('#popover_template_search').hide();
        $('.daterangepicker').hide();
    });
    $('#txtsearch').click(function () {
        $('#popover_template_search').toggle();
        $('#popover_template').hide();
         $('.daterangepicker').hide();
    });
    
});

$(document).on('keyup', '#txtsearch', function(){
    var value_search_location = $(this).val().toLowerCase();
    $(".search_location_ul li").filter(function() {
        let match = $(this).text().toLowerCase().indexOf(value_search_location) > -1;
        if(match) {
            let newString = $(this).text().replace('<strong>','');
            newString = newString.replace('</strong>','');
            newString = newString.replace(value_search_location,'<strong>'+value_search_location+'</strong>')
            $(this).html(newString);
        }
      $(this).toggle(match);
      $('#popover_template_search').toggle();
    });
})

//search location in search bar sub


$(document).on('click', '#btnsearch', function(){
  $('form' ).submit();
})
//calculator total guests in search hero block
$(document).on('click', '.btn-plus-a', function() {
    //alert('it works!');
    var n = $('#txtadults').val();
    var total_pet = $('#txtpets').val();
    var total_guest_p = $('#txtguests').val();
    var total_child_p = $('#txtchildren').val();
    var split_guest = total_guest_p.slice(0,2);
    var total_guest_type_p = Number(split_guest);
 
    $('#txtadults').val(++n);
    
       
    //$('#txtguests').val(n + ' Guests');
    $('.total-adult').html(n);
    if(n > 0){
        $('.btn-minus-a').css("opacity","1");
    }
    var total_a = Math.abs( Number(total_child_p) + Number(n));
    var text_a = '';
    if ((total_a) < 2) {
        text_a = total_a + ' Guest';
    }else{
        text_a = total_a + ' Guests';
    }
    $('#txtguests').val(text_a);
});


$(document).on('click', '.btn-minus-a', function() {
    //alert('it works!');
    var n = $('#txtadults').val();
    var total_guest_m = $('#txtguests').val();
    var total_child_m = $('#txtchildren').val();
    var total_infant = $('#txtinfants').val();
    var split_guest_m = total_guest_m.slice(0,2);
    var total_guest_type_m = Number(split_guest_m);
    if((n-1) === 0){
        $('.btn-minus-a').css("opacity","0.5");
    }else{
        $('.btn-minus-a').css("opacity","1");
    }
    
    if (n > 0) {
        $('#txtadults').val(--n);
        $('#txtguests').val(n + ' Guest');
        $('.total-adult').html(n);
        
        var text_c = '';
        if ((total_guest_type_m-1) < 2) {
            text_c = ' Guest';
        }else{
            text_c = ' Guests';
        }
        $('#txtguests').val(--total_guest_type_m + text_c);
      } else {
         $('.btn-minus-a').css("opacity","0.5");
        //Otherwise do nothing
      }  
});


$(document).on('click', '.btn-plus-c', function() {
    //alert('it works!');
    var n_child = $('#txtchildren').val();
    //console.log(++n);
    $('#txtchildren').val(++n_child);
    var nc_d = $('#txtadults').val();
    
    if(n_child > 0){
        $('.btn-minus-c').css("opacity","1");
    }
    var total_c = Math.abs(Number(nc_d) + Number(n_child));
    var text_c = '';
    if ((total_c) < 2) {
        text_c = total_c + ' Guest';
    }else{
        text_c = total_c + ' Guests';
    }
    
     $('#txtguests').val(text_c);
   
    $('.total-children').html(n_child);
    ClickAddChild(n_child);
});


$(document).on('click', '.btn-minus-c', function() {
    //alert('it works!');
    var n_child = $('#txtchildren').val();
    //console.log(--n);
    if((n_child-1) == 0){
        $('.btn-minus-c').css("opacity","0.5");
    }else{
        $('.btn-minus-c').css("opacity","1");
    }
    if (n_child > 0) {
       
        $('#txtchildren').val(--n_child);
        //$('#txtguests').val(n);
        var nc_m = $('#txtguests').val();
        var split_guest_nc_m = nc_m.slice(0,2);
        var total_guest_type_nc_m = Number(split_guest_nc_m);
        
        var text_check= '';
        if((total_guest_type_nc_m-1) < 2){
            text_check = ' Guest';
        }else{ 
             text_check = ' Guests';
        }
        
        $('#txtguests').val(--total_guest_type_nc_m + text_check);
        
        
        $('.total-children').html(n_child);
        $('.infants-popup .item:last-child').remove();
      } else {
          $('.btn-minus-c').css("opacity","0.5");
        //Otherwise do nothing
      }
});
function ClickAddChild(index){
    var structure = $('<div class="item" >' +
                                '<label for="item-child">Child '+index+'</label>' +
                                '<select name="child" class="form-control" id="item-child-'+index+'">' +
                                  '<option value="0">Age</option>' +
                                  '<option value="1">1</option>' + 
                                   '<option value="2">2</option>' + 
                                    '<option value="3">3</option>' + 
                                     '<option value="4">4</option>' + 
                                      '<option value="5">5</option>' + 
                               ' </select>' +
                                '</div>');
    $(".infants-popup").append(structure);
}
function ClickAddRoom(){
   // Selecting last id 
  var lastname_id = $('.room-item').last().attr('id');
  var split_id = lastname_id.split('_');

  // New index
  var index = Number(split_id[1]) + 1;
    
  // Create clone
  var newel = $('.room-item:last').clone(true);
    console.log(index);
  // Set id of new element
  $(newel).find('.room-item').attr("id","item_"+index);
  $(newel).find('.room-item h5 span').attr("id","name_"+index);
  $(newel).find('.room-item h5 span').text(index);
  
  // Insert element
  $(newel).insertAfter(".room-item:last");
}


function toggleSearch() {
  $('.search-bar').slideToggle("fast");
  $(".opacity-search-bar-nav-bg").css({"display":"block", "width":"100%"});
  $('.search-bar-main').slideToggle("fast");
  $("[rel=comments]").not(this).popover('hide');
}


/* Set the width of the side navigation to 250px */
function openNav() {
  $(".body_main_side_tab").css({"display":"block", "width":"100%"});
  $(".sn-login-links .pull-right").css("display","block");
  $("#mySidenav").css({"right":"0"});
}
function openUer() {
  $(".body_main_side_tab").css({"display":"block", "width":"100%"});
  $(".sn-login-links .pull-right").css("display","block");
  $("#mysideUser").css({"right":"0"});
}

/* Set the width of the side navigation to 0 */
function closeNav() {
  $("#mySidenav").css({"right":"-390px"});
  $(".body_main_side_tab").css("display","none");
  $(".sn-login-links .pull-right").css("display","none");
  var x = screen.width;
  if(x <= 576){
   $("#mySidenav").css({"right":"-90%"});
  }
  //document.getElementsByClassName("image-icon-arrow-down-des").style.opacity = "0";
}
function closeUser() {
  $("#mysideUser").css({"right":"-390px"});
  $(".body_main_side_tab").css("display","none");
  $(".sn-login-links .pull-right").css("display","none");
  var x = screen.width;
  if(x <= 576){
   $("#mysideUser").css({"right":"-90%"});
  }
  //document.getElementsByClassName("image-icon-arrow-down-des").style.opacity = "0";
}

// Detect Scroll
$(window).scroll(function () {
  $(document).scrollTop() > 10 ? $(".nav-bg").addClass("bgHeader") : $(".nav-bg").removeClass("bgHeader");
  //$(document).scrollTop() > 2 ? $('.search-bar').hide() : $('.search-bar').show();
  //console.log('scroll');
});

// owl carousel
$('.owl-carousel').owlCarousel({
  items:1,
  loop: true,
  autoplay: true,
  nav: true,
  autoplayTimeout: 10000
});

$(function() {

  $('input[name="txtcal"]').daterangepicker({
      autoUpdateInput: false,
      autoApply: true,

      //linkedCalendars: false,
      locale: {
          firstDay: 1,
          format: 'ddd DD MMM YYYY',
          daysOfWeek: [
            "S",
            "M",
            "T",
            "W",
            "T",
            "F",
            "S"
        ],
        applyLabel: "Apply",
        cancelLabel: "Cancel",
      },
     
  },function() {
       $('input[name="txtguests"]').click();
       // $("[rel=comments]").not(this).popover('show');
    }).on('apply.daterangepicker', function(ev, picker) {
                var start = moment(picker.startDate.format('YYYY-MM-DD'));
                var end   = moment(picker.endDate.format('YYYY-MM-DD'));
                var diff_days = Math.abs(start.diff(end, 'days'));
                if(Number(diff_days) <= 1){
                    $(".drp-buttons").html('<div style="font-family: Open Sans; font-style: normal; font-weight: 600; font-size: 14px; line-height: 19px; position: relative; text-align: center; top: 5px; color: #323A45;">'+ picker.startDate.format('ddd DD MMM YYYY') +' - '+picker.endDate.format('ddd DD MMM YYYY') +'<span style="opacity: 0.5;"> ('+ diff_days +' night)</span></div>');
                }else{
                    $(".drp-buttons").html('<div style="font-family: Open Sans; font-style: normal; font-weight: 600; font-size: 14px; line-height: 19px; position: relative; text-align: center; top: 5px; color: #323A45;">'+ picker.startDate.format('ddd DD MMM YYYY') +' - '+picker.endDate.format('ddd DD MMM YYYY') +'<span style="opacity: 0.5;"> ('+ diff_days +' nights)</span></div>');
                }
    
    });

  $('input[name="txtcal"]').on('apply.daterangepicker', function(ev, picker) {
      $(this).val(picker.startDate.format('DD/MM/YYYY') + ' - ' + picker.endDate.format('DD/MM/YYYY'));
  });

  $('input[name="txtcal"]').on('cancel.daterangepicker', function(ev, picker) {
      $(this).val('');
  });

});

$(function() {

  $('input[name="txtcal-search-block"]').daterangepicker({
      autoUpdateInput: false,
      autoApply: true,
      //linkedCalendars: false,
      locale: {
          firstDay: 1,
          format: 'ddd DD MMM YYYY',
          daysOfWeek: [
            "S",
            "M",
            "T",
            "W",
            "T",
            "F",
            "S"
        ],
        applyLabel: "Apply",
        cancelLabel: "Cancel",
      },
     
  },function() {
       $('input[name="txtguests-search-block"]').click();
       // $("[rel=comments]").not(this).popover('show');
    }).on('apply.daterangepicker', function(ev, picker) {
                var start = moment(picker.startDate.format('YYYY-MM-DD'));
                var end   = moment(picker.endDate.format('YYYY-MM-DD'));
                var diff_days = Math.abs(start.diff(end, 'days'));
                if(Number(diff_days) <= 1){
                    $(".drp-buttons").html('<div style="font-family: Open Sans; font-style: normal; font-weight: 600; font-size: 14px; line-height: 19px; position: relative; text-align: center; top: 5px; color: #323A45;">'+ picker.startDate.format('ddd DD MMM YYYY') +' - '+picker.endDate.format('ddd DD MMM YYYY') +'<span style="opacity: 0.5;"> ('+ diff_days +' night)</span></div>');
                }else{
                    $(".drp-buttons").html('<div style="font-family: Open Sans; font-style: normal; font-weight: 600; font-size: 14px; line-height: 19px; position: relative; text-align: center; top: 5px; color: #323A45;">'+ picker.startDate.format('ddd DD MMM YYYY') +' - '+picker.endDate.format('ddd DD MMM YYYY') +'<span style="opacity: 0.5;"> ('+ diff_days +' nights)</span></div>');
                }     
    });

  $('input[name="txtcal-search-block"]').on('apply.daterangepicker', function(ev, picker) {
      $(this).val(picker.startDate.format('DD/MM/YYYY') + ' - ' + picker.endDate.format('DD/MM/YYYY'));
  });

  $('input[name="txtcal-search-block"]').on('cancel.daterangepicker', function(ev, picker) {
      $(this).val('');
  });

});


//click icon heart page landing
$(document).ready(function(){
  $('.hover-fa-heart').click(function(){
    $(this).toggleClass("fa-heart fa-heart-o");
  });
  
  //loading modal in checkout template
$('#checkout-button-reverve-id').click(function(){
    setTimeout(function(){
      $('#reserveModal').modal('hide');
      location.reload();
  }, 10000);

  });

});

$(document).on('click', '#down-1', function() {
    if (!$('#property-type').hasClass('display-none')) {
        $('#arrow1').attr('src', 'https://app.dev.viewretreats.net/themes/view-retreats/assets/images/arrow-down-small-grey@2x.png');
        $('#property-type').addClass('display-none')  
    } else  {
        $('#arrow1').attr('src', 'https://app.dev.viewretreats.net/themes/view-retreats/assets/images/nav-arrow-up-blue.png');
        $('#property-type').removeClass('display-none')
    }
});
$(document).on('click', '#down-2', function() {
    if (!$('#holiday-style').hasClass('display-none')) {
        $('#arrow2').attr('src', 'https://app.dev.viewretreats.net/themes/view-retreats/assets/images/arrow-down-small-grey@2x.png');
        $('#holiday-style').addClass('display-none')  
    } else  {
        $('#arrow2').attr('src', 'https://app.dev.viewretreats.net/themes/view-retreats/assets/images/nav-arrow-up-blue.png');
        $('#holiday-style').removeClass('display-none')
    }
});
$(document).on('click', '#down-3', function() {
    if (!$('#amenities-ie').hasClass('display-none')) {
        $('#arrow3').attr('src', 'https://app.dev.viewretreats.net/themes/view-retreats/assets/images/arrow-down-small-grey@2x.png');
        $('#amenities-ie').addClass('display-none')  
    } else  {
        $('#arrow3').attr('src', 'https://app.dev.viewretreats.net/themes/view-retreats/assets/images/nav-arrow-up-blue.png');
        $('#amenities-ie').removeClass('display-none')
    }
});
$(document).on('click', '#down-4', function() {
    if (!$('#suitability').hasClass('display-none')) {
        $('#arrow4').attr('src', 'https://app.dev.viewretreats.net/themes/view-retreats/assets/images/arrow-down-small-grey@2x.png');
        $('#suitability').addClass('display-none')  
    } else  {
        $('#arrow4').attr('src', 'https://app.dev.viewretreats.net/themes/view-retreats/assets/images/nav-arrow-up-blue.png');
        $('#suitability').removeClass('display-none')
    }
});
$(document).on('click', '#btn-map', function() {
    if ($('#search-localtion').hasClass('display-none')) {
        $('#search-localtion').removeClass('display-none');
        $('#search-results').addClass('display-none');
         $('#search-softby').addClass('display-none')
    }
});


//side nav

$(document).on('click', '#destinations_id', function(){
   
    if($('#destinations_id').attr('aria-expanded') == "false") {
        $(".image-icon-arrow-up-des").show();
        $(".image-icon-arrow-down-des").hide();
        
        $('#collapseCollections').collapse('hide');
        $(".image-icon-arrow-up-col").hide();
        $(".image-icon-arrow-down-col").show();
    } else {
        $(".image-icon-arrow-up-des").hide();
        $(".image-icon-arrow-down-des").show();
        
    }

});

$(document).on('click', '#collections_id', function(){
   
    if($('#collections_id').attr('aria-expanded') == "false") {
        $(".image-icon-arrow-up-col").show();
        $(".image-icon-arrow-down-col").hide();
        
        $('#collapseDestination').collapse('hide');
        $(".image-icon-arrow-up-des").hide();
        $(".image-icon-arrow-down-des").show();
    } else {
        $(".image-icon-arrow-up-col").hide();
        $(".image-icon-arrow-down-col").show();
    }

});
//button login google
function onSuccess(googleUser) {
  console.log('Logged in as: ' + googleUser.getBasicProfile().getName());
}
function onFailure(error) {
  console.log(error);
}
function renderButton() {
  gapi.signin2.render('my-signin2', {
    'scope': 'profile email',
    'width': 185,
    'height': 40,
    'longtitle': true,
    'theme': 'dark',
    'onsuccess': onSuccess,
    'onfailure': onFailure
  });
}


//get value location search hero block
    $(document).on('click', ' #location-list #li_a1', function(){
          $(".txtsearch").val($(this).text());
          var data_search_val =  $(".txtsearch").val();
          
          if(data_search_val != ""){
            $(".popover").hide();
            $('input[name="txtcal"]').focus();
          
          }
    });
  
    $(document).on('click', ' #location-list #li_a2', function(){
          $(".txtsearch").val($(this).text());
          var data_search_val =  $(".txtsearch").val();
          
          if(data_search_val != ""){
            $(".popover").hide();
            $('input[name="txtcal"]').focus();
           
          }
    });
     $(document).on('click', ' #location-list #li_a3', function(){
          $(".txtsearch").val($(this).text());
          var data_search_val =  $(".txtsearch").val();
          
          if(data_search_val != ""){
            $(".popover").hide();
            $('input[name="txtcal"]').focus();
          
          }
    });
     $(document).on('click', ' #location-list #li_a4', function(){
          $(".txtsearch").val($(this).text());
          var data_search_val =  $(".txtsearch").val();
          
          if(data_search_val != ""){
            $(".popover").hide();
            $('input[name="txtcal"]').focus();
           
          }
    });
     $(document).on('click', ' #location-list #li_a5', function(){
          $(".txtsearch").val($(this).text());
          var data_search_val =  $(".txtsearch").val();
          
          if(data_search_val != ""){
            $(".popover").hide();
            $('input[name="txtcal"]').focus();
           
          }
    });
     $(document).on('click', ' #location-list #li_a6', function(){
          $(".txtsearch").val($(this).text());
          var data_search_val =  $(".txtsearch").val();
          
          if(data_search_val != ""){
            $(".popover").hide();
            $('input[name="txtcal"]').focus();
           
          }
    });
     $(document).on('click', ' #location-list #li_a7', function(){
          $(".txtsearch").val($(this).text());
          var data_search_val =  $(".txtsearch").val();
          
          if(data_search_val != ""){
            $(".popover").hide();
            $('input[name="txtcal"]').focus();
           
          }
    });
     $(document).on('click', ' #location-list #li_a8', function(){
          $(".txtsearch").val($(this).text());
          var data_search_val =  $(".txtsearch").val();
          
          if(data_search_val != ""){
            $(".popover").hide();
            $('input[name="txtcal"]').focus();
           
          }
    });
     $(document).on('click', ' #location-list #li_a9', function(){
          $(".txtsearch").val($(this).text());
          var data_search_val =  $(".txtsearch").val();
          
          if(data_search_val != ""){
            $(".popover").hide();
            $('input[name="txtcal"]').focus();
          
          }
    });
    $(document).on('click', ' #location-list #li_a10', function(){
          $(".txtsearch").val($(this).text());
          var data_search_val =  $(".txtsearch").val();
          
          if(data_search_val != ""){
            $(".popover").hide();
            $('input[name="txtcal"]').focus();
           
          }
    });
     $(document).on('click', ' #location-list #li_a11', function(){
          $(".txtsearch").val($(this).text());
          var data_search_val =  $(".txtsearch").val();
          
          if(data_search_val != ""){
            $(".popover").hide();
            $('input[name="txtcal"]').focus();
           
          }
    });
     $(document).on('click', ' #location-list #li_a12', function(){
          $(".txtsearch").val($(this).text());
          var data_search_val =  $(".txtsearch").val();
          
          if(data_search_val != ""){
            $(".popover").hide();
            $('input[name="txtcal"]').focus();
          
          }
    });
    $(document).on('click', ' #location-list #li_a13', function(){
          $(".txtsearch").val($(this).text());
          var data_search_val =  $(".txtsearch").val();
          
          if(data_search_val != ""){
            $(".popover").hide();
            $('input[name="txtcal"]').focus();
          
          }
    });
    $(document).on('click', ' #location-list #li_a14', function(){
          $(".txtsearch").val($(this).text());
          var data_search_val =  $(".txtsearch").val();
          
          if(data_search_val != ""){
            $(".popover").hide();
            $('input[name="txtcal"]').focus();
          
          }
    });
    
    //Next/Back slide
    var w = screen.width;
    var i = 1;
    // var c = document.getElementById("imageGallery").childElementCount;
    var c=15;
    if(w <= 576){
        $('#imageGallery > div:nth-child('+ i +')').addClass('only_show');
    }
    function arrow_left(){
        alert("slide truoc");    
    }
    function arrow_right(){
        // alert("slide tiep tieo");
        var next = i+1;
        if(w <= 576){
            if(i<=c){
                $('#imageGallery > div:nth-child('+ i +')').removeClass('only_show');
                $('#imageGallery > div:nth-child('+ next +')').addClass('only_show');
                i++;
            }
        }
    }
