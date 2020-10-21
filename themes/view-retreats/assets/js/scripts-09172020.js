  $(document).ready(function (e) {
       $(document).on('click', '.wishlist-navbar .nav-link', function(){
           scrollTo(0,0);
        });
      $(document).on('click', '#close-booking, #btn-wishlist-bookin', function(){
          $(".box-bookings").show();
          $(".box-detail-booking").hide();
    });
    
     $(document).on('click', '.action-view', function(){
          $(".box-bookings").hide();
          $(".box-detail-booking").show();
    }); 
     $(document).on('click', '.close-form', function(){
          $("#requied-login").hide();
    });
    $(document).on('click', '#show-more-amenities', function(){
          $(".room-amenities .col-md-4:nth-child(2), .room-amenities .col-md-4:nth-child(3)").show();
          $("#show-more-amenities").hide();
    });
    $(document).on('click', '#show-more-property', function(){
          $(".property-amenities .col-md-4:nth-child(2), .property-amenities .col-md-4:nth-child(3)").show();
          $("#show-more-property").hide();
    });
    $(function () {
      $('.btn-popup').popover({
        trigger: 'manual',
		 placement: 'top',
		 html: true
	  }).click(function (e) {
		 //e.preventDefault();
		 $(this).popover('show');
	     //$('.popover').addClass("popover-info");
	     $('.popover').addClass("popover-no-title");
	     $('.popover').append("<span class='close'></span>");
	  });
	  
	  $('.info img, .btn-tax, .btn-detail, .show-info-guest, .price-detail, .non-refundable').popover({
        trigger: 'manual',
		 placement: 'top',
		 html: true
	  }).click(function (e) {
	     $(".popover").popover('hide');
		 $(this).popover('show');
	     $('.popover').addClass("popover-info");
	     $('.popover').append("<span class='close'></span>");
	  });
    });
    $(document).on('click', '.popover .close', function(){
          $(".popover").removeClass('show');
          $(".popover").popover('hide');
    });
    if(window.innerWidth > 768) {
        $("#search_guest_mobile").remove();
        //get value location search hero block
        $(document).on('click', ' .search_location_ul li', function(){
            var data = $(this).data("name");
              $(".txtsearch-nav").val(data);
              var data_search_val =  $(".txtsearch-nav").val();
              $("#popover_template_search").hide();
              $('#txtcal-search-block').focus();
              $(".opacity-search-bar-nav-bg").hide();
        });
    }
    if(window.innerWidth < 769) {
        $(".page-search .search-bar").addClass("search-hide");
        $('.page-search .search-bar').click(function () {
            $(this).removeClass("search-hide");
            $(this).css({"height":"auto"});
            $('.search-bar .search-block').css({"height":"auto"});
        });
        $("#popover_template_search").remove();
        $("#popover_template").remove();
        
        $('#txtsearch').click(function () {
            $("#search_location_mobile").css({"right":"0"});
            $(".txtsearch-mobile").focus();
        });
        $('#txtguests').click(function () {
            $("#search_guest_mobile").css({"right":"0"});
            $(".txtsearch-mobile").focus();
        });
        $('#txtcal-search-block').click(function () {
            $("#search_datepicker_mobile").css({"right":"0"});
            $(".txtsearch-mobile").focus();
        });
        $('#close-localtion-mobile, .search_form_footer button').click(function () {
            $(".search_form_mobile").css({"right":"-100%"});
            $(".opacity-search-bar-nav-bg").hide();
        });
        
        //get value location search hero block
        $(document).on('click', ' .search_location_ul li', function(){
            var data = $(this).data("name");
              $(".txtsearch-nav").val(data);
              $(".txtsearch-mobile").val(data);
              var data_search_val =  $(".txtsearch-nav").val();
              $('.txtsearch-mobile').focus();
        });
        new Litepicker({
    	  element: document.getElementById('datepicker_litepicker'),
          singleMode: false,
          numberOfMonths: 5,
          numberOfColumns: 1,
          inlineMode: true,
          mobileFriendly: false,
          autoApply: true,
          minDate: new Date() - 1,
          onSelect: function(date1, date2) { 
             let formatted_date1 = date1.getDate() + "/" + (date1.getMonth() + 1) + "/" + date1.getFullYear();
             let formatted_date2 = date2.getDate() + "/" + (date2.getMonth() + 1) + "/" + date2.getFullYear();
             $("#txtcal-search-block").val(formatted_date1 +" - "+ formatted_date2);
             $("#btn-select").show();
             $(".btn-default").hide();
             $(".datepicker-show-text").show();
             $(".date-start h2").text(date1.getDate());
             $(".date-start h4.date").text(moment(date1).format("ddd"));
             $(".date-start h4.month").text(moment(date1).format("MMM"));
             $(".date-end h2").text(date2.getDate());
             $(".date-end h4.date").text(moment(date2).format("ddd"));
             $(".date-end h4.month").text(moment(date2).format("MMM"));
        }
        });
    }
    if(window.innerWidth < 575) {
        
        var showChar = 150;  // How many characters are shown by default
        var ellipsestext = ".";
        var moretext = "Read more >";
        var lesstext = "Show less";
        
        $('.show-more').each(function() {
            var content = $(this).html();
            if(content.length > showChar) {
     
                var c = content.substr(0, showChar);
                var h = content.substr(showChar, content.length - showChar);
     
                var html = c + '<span class="moreellipses">' + ellipsestext+ '&nbsp;</span><span class="morecontent"><span>' + h + '</span>&nbsp;&nbsp;<a href="" class="morelink">' + moretext + '</a></span>';
     
                $(this).html(html);
            }
     
        });
        
        
        $(".morelink").click(function(){
            if($(this).hasClass("less")) {
                $(this).removeClass("less");
                $(this).html(moretext);
            } else {
                $(this).addClass("less");
                $(this).html(lesstext);
            }
            $(this).parent().prev().toggle();
            $(this).prev().toggle();
            return false;
        });
        $(".page-search #txtsearch").click(function(){
            $(".search-bar, .search-block").css({"height":"auto"});
            
        });
    }
    
  // search block   
   
    var n = 2; //n is equal to 1
    $('#id-signup-popup').on('click', function(e) {
        $('#login-modal').modal('hide');
        $('#login-modal').hide();
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
       $(".popover").removeClass('show');
       $('#popover_template_search').hide();
       $('.daterangepicker').hide();
       //$('#popover_template').hide();
       //$(".opacity-search-bar-nav-bg").css({"display":"none"});
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
        //$('#popover_template_search').toggle();
        $('#popover_template').hide();
        $('.daterangepicker').hide();
    });
    $("#signup-button").click(function(){
          var email = $('#signup-by-email').val();
          if(ValidateEmail(email)){
              $("#form-signup-email").hide();
              $("#form-signup-password").show();
              $("#back-signup").show();
              $('.email-show-register').text(email);
          }else{
              alert('Please Input Valid Email Address');
          }
          
    });
    $("#back-signup").click(function(){
          $("#form-signup-email").show();
          $("#form-signup-password").hide();
          $("#back-signup").hide();
    });
    $("#forgot-button").click(function(){
          $("#form-forgot-email").hide();
          $("#form-forgot-password").show();
          $("#back-forgot").show();
    });
    $("#back-forgot").click(function(){
          $("#form-forgot-email").show();
          $("#form-forgot-password").hide();
          $("#back-forgot").hide();
    });
    $("#login-button").click(function(){
          
          var email = $('input[name="login"]').val();
          if(ValidateEmail(email)){
              $("#form-login-email").hide();
              $("#form-login-password").show();
              $("#back-login").show();
              $('.email-show-login').text(email);
          }else{
              alert('Please Input Valid Email Address');
          }
          
    });
    $("#back-login").click(function(){
          $("#form-login-email").show();
          $("#form-login-password").hide();
          $("#back-login").hide();
    });
    
    $('.form-login').on('submit', function(e){
        var email = $('input[name="login"]').val();
        var password = $('#loginmodal-by-password').val();
        
        if(email === '' && !ValidateEmail(email)){
           console.log('no value');
           alert('Please Input Valid Email Address');
           return false;

        }else if(ValidateEmail(email) && password === '' && $("#form-login-email").is(":visible")){
              $('.email-show-login').text(email);
              $("#form-login-email").hide();
              $("#form-login-password").show();
              $("#back-login").show();
              return false;
        }else{
            return true;
        }
    });
    
    $('.onRegister-form').on('submit', function(e){
        var email = $('#signup-by-email').val();
        var password = $('.signup-password').val();
        var confirm_password = $('input[name="confirm_password"]').val();
        if(email === '' && !ValidateEmail(email)){
            
           alert('Please Input Valid Email Address');
           return false;

        }else if(ValidateEmail(email) && password === '' && $("#form-signup-email").is(":visible")){
            
              $("#form-signup-email").hide();
              $("#form-signup-password").show();
              $("#back-signup").show();
              $('.email-show-register').text(email);
              
              return false;
        }else if(ValidateEmail(email) && $("#form-signup-password").is(":visible")){
            
              if($('.first_name').val() == ''){
                  
                  alert('First Name must not be empty');
                  return false;
                  
              }else if($('.last_name').val() == ''){
                  
                  alert('Last Name must not be empty');
                  return false;
                  
              }else if($('.signup-password').val() == ''){
                  
                  alert('Password is required');
                  return false;
                  
              }else if(password != '' && password != confirm_password){
                  
                  alert('Password must be the same with Confirm password');
                  return false;
                  
              }else{
                  
                  return true;
              }
              
              
              return false;
        }else{
            return true;
        }
    });
});

let jsCourses = $("li input[type=checkbox]"),
    btnSignMeUp = $("#btn-refine-search"),
    myCourses = $(".list-filter-tag");
    btnSignMeUp.on("click", signMeUp);
    
    $('.list-filter-tag').on('click', '.close-item', function(e) {
        e.preventDefault();
        let checkedCourses = getCheckedControls(jsCourses), len = checkedCourses.length;
        let itemId = $(this).parent('.item').attr('id');
        let countItem = $('.list-filter-tag .item').length;
        $(this).parent('.item').remove();
        $('li').find('#'+itemId).prop("checked", false);
        
        if(countItem  > 1){
            $("#count-filter").text(countItem - 1);
            $(".filter-btn #btn-filter").addClass("btn-active");
        }else{
            $("#count-filter").css("display","none");
             $("#btn-filter").removeClass("btn-active");
        }
        
    });
    
  function signMeUp() {
    let checkedCourses = getCheckedControls(jsCourses), len = checkedCourses.length, datatext, dataid;
    
    if(len>0){
        $("#count-filter").html(len);
        $("#count-filter").css("display","inline-block");
        $("#btn-filter").addClass("btn-active");
    }else{
        $("#count-filter").html();
        $("#count-filter").css("display","none");
         $("#btn-filter").removeClass("btn-active");
    }
    $(myCourses).html('');
    for (let c = 0; c < len; c++) {
      datatext = checkedCourses[c].find(jsCourses).data("val");
      dataid = checkedCourses[c].find(jsCourses).attr('id');
      if(jsCourses.is(':checked')) {
            $(myCourses).append('<span class="item" id="'+dataid+'">'+datatext+'<span class="close-item">x</span> </span>');
        } else {
            $(myCourses).find('#'+dataid).remove();
        } }
     
  }

  function getCheckedControls(jsCourses) {
    let result = [], len = jsCourses.length, element;
    for (let c = 0; c < len; c++) {
      if (jsCourses[c].checked) {
        result.push($(jsCourses[c]).parent());
      }
    }
    return result;
    
  }


function ValidateEmail(inputText){
    var mailformat = /^[a-zA-Z0-9.!#$%&'*+/=?^_`{|}~-]+@[a-zA-Z0-9-]+(?:\.[a-zA-Z0-9-]+)*$/;
    console.log(inputText);
    if(inputText.match(mailformat)){
        return true;
    }else{
        return false;
    }
}

function uncheckAll() {
  $("input[type='checkbox']:checked").prop("checked", false);
  $("#count-filter").css("display","none");
  $(".list-filter-tag").html("");
  $("#btn-filter").removeClass("btn-active");
}
$('.btn-refine-clear-all').on('click', uncheckAll)

/*$(document).on('keyup', '#txtsearch', function(){
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
    
})*/

//search location in search bar sub


$(document).on('click', '#btnsearch', function(){
  $('form' ).submit();
})
//calculator total guests in search hero block
$(document).on('click', '.btn-plus-a', function() {
    //alert('it works!');
    var n = $('#txtadults').val();
    var total_guest_p = $('#txtguests').val();
    var total_child_p = $('#txtchildren').val();
    var total_guest = $('#txttotalguests').val();
    $('#txtadults').val(++n);
    let roomNr = $('.room-list .room-item').length;
    
    
    
    let text_a = '';
  
    if(roomNr < 2) {
      text_a = roomNr + ' Room, ';
    } else {
      text_a = roomNr + ' Rooms, ';
    }
       
    //$('#txtguests').val(n + ' Guests');
    let adults = +$(this).prev('div').html();
    $(this).prev('div').html(adults+1);
    if(n > 0){
        $('.btn-minus-a').css("opacity","1");
    }
    var total_a = Math.abs( Number(total_child_p) + Number(n));
    if ((total_a) < 2) {
        text_a += total_a + ' Guest';
    }else{
        text_a += total_a + ' Guests';
    }
    $('#txtguests').val(text_a);
    $('#txtroom').val(roomNr);
    $('#txttotalguests').val(total_a);
});


$(document).on('click', '.btn-minus-a', function() {
    var n = $('#txtadults').val();
    let adults = +$(this).next('div').html();
    var total_guest = $('#txttotalguests').val();
    var total_guest_m = $('#txtguests').val();
    var total_child_m = $('#txtchildren').val();
    var total_room = $('#txtroom').val();
    
    if((adults-1) === 0){
        $(this).css("opacity","0.5");
    }else{
        $(this).css("opacity","1");
    }
    
    if (adults > 0) {
        $('#txtadults').val(--n);
        $(this).next('div').html(adults-1);
        $('#txttotalguests').val(total_guest-1);
        //$('.total-adult').html(n);
        let roomNr = $('.room-list .room-item').length;
        var text_c = '';
        var text_r = '';
        if(roomNr < 2) {
          text_r = roomNr + ' Room, ';
        } else {
          text_r = roomNr + ' Rooms, ';
        }
        
        if ((total_guest-1) < 2) {
            text_c = ' Guest';
        }else{
            text_c = ' Guests';
        }
        $('#txtguests').val( text_r + --total_guest + text_c);
      } 
      else {
         $('.btn-minus-a').css("opacity","0.5");
      }  
     
});


$(document).on('click', '.btn-plus-c', function() {
    //alert('it works!');
    var n_child = $('#txtchildren').val();
    var total_room = $('#txtroom').val();
    var total_guest = $('#txttotalguests').val();
    $('#txtchildren').val(++n_child);
    var nc_d = $('#txtadults').val();
    
    if(n_child > 0){
        $(this).css("opacity","1");
    }
    var total_c = Math.abs(Number(nc_d) + Number(n_child));
    var text_c = '';
    let roomNr = $('.room-list .room-item').length;
    
    if(total_room < 2) {
      text_c = roomNr + ' Room, ';
    } else {
      text_c = roomNr + ' Rooms, ';
    }
       
    if ((total_c) < 2) {
        text_c += total_c + ' Guest';
    }else{
        text_c += total_c + ' Guests';
    }
    
    $('#txtguests').val(text_c);
    $('#txttotalguests').val(total_c);
    let childs = +$(this).prev('div').html();
    $(this).prev('div').html(childs+1);
    ClickAddChild(childs, $(this));
});


$(document).on('click', '.btn-minus-c', function() {
    //alert('it works!');
    var n_child = $('#txtchildren').val();
    var total_guest = $('#txttotalguests').val();
    //console.log(--n);
    if((n_child-1) == 0){
        $('.btn-minus-c').css("opacity","0.5");
    }else{
        $('.btn-minus-c').css("opacity","1");
    }
    let childs = +$(this).next('div').html();
    if (childs > 0) {
       $('#txttotalguests').val(total_guest-1)
        $('#txtchildren').val(n_child-1);
        $(this).next('div').html(childs-1);
        //$('#txtguests').val(n);
        
        let roomNr = $('.room-list .room-item').length;
  
          let text = '';
          
          if(roomNr < 2) {
              text = roomNr + ' Room,';
          } else {
              text = roomNr + ' Rooms,';
          }
        var text_check= '';
        if((total_guest-1) < 2){
            text_check = ' Guest';
        }else{ 
             text_check = ' Guests';
        }
        
        $('#txtguests').val(text + --total_guest + text_check);
        
        $(this).parent().parent().next('.infants-popup').find(' .item:last-child').remove();
      } else {
          $(this).css("opacity","0.5");
        //Otherwise do nothing
      }
});
function ClickAddChild(index, JqueryObject){
    // selectCustom();
    var structure = $('<div class="item" >' +
                        '<label for="item-child">Child '+(index+1)+'</label>' +
                        '<select name="child" class="select-custom" id="item-child-'+index+'">' +
                          '<option value="0" rel="icon-temperature">Age</option>' +
                          '<option value="1">1</option>' + 
                           '<option value="2">2</option>' + 
                            '<option value="3">3</option>' + 
                             '<option value="4">4</option>' + 
                              '<option value="5">5</option>' + 
                              '<option value="6">6</option>' + 
                              '<option value="7">7</option>' + 
                              '<option value="8">8</option>' + 
                              '<option value="9">9</option>' + 
                              '<option value="10">10</option>' + 
                              '<option value="11">11</option>' + 
                              '<option value="12">12</option>' + 
                              '<option value="13">13</option>' + 
                              '<option value="14">14</option>' + 
                              '<option value="15">15</option>' + 
                              '<option value="16">16</option>' + 
                              '<option value="17">17</option>' + 
                       ' </select>' +
                        '</div>');
    
    JqueryObject.parent().parent().next('.infants-popup').append(structure);
}
function ClickAddRoom(){
   // Selecting last id 
  var lastname_id = $('.room-item ').last().attr('id');
  var split_id = lastname_id.split('_');

  // New index
  var index = Number(split_id[1]) + 1;
    
  // Create clone
  var newel = $('.room-item:last').clone(true);
    
  // Insert element
  $(newel).insertAfter(".room-item:last");
  
  // Set id of new element
  $('.room-item:last').attr("id","item_"+index);
  $('.room-item:last h5 span:first-child').attr("id","name_"+index);
  $('.room-item:last h5 span:first-child').text(index);
  
  $('.room-item:last .infants-popup .item').remove();
  $('.room-item:last .guests-popup .total-adult').html(2);
  $('.room-item:last .guests-popup .total-children').html(0);
  
  let n = +$('#txtadults').val();
  let total_guest = $('#txttotalguests').val();
   
  $('#txtadults').val(n+2);
  $('#txtroom').val(n+1);
  
  let total_child_p = $('#txtchildren').val();
  
  let total_a = n + 2 + +total_child_p;
  
  let roomNr = $('.room-list .room-item').length;
  
  let text = '';
  
  if(roomNr < 2) {
      text = roomNr + ' Room,';
  } else {
      text = roomNr + ' Rooms,';
  }
  
  if ((total_a) < 2) {
        text += ' ' + total_a + ' Guest';
    }else{
        text += ' ' + total_a + ' Guests';
    }
    $('#txtguests').val(text);
    $('#txttotalguests').val(total_a);
}

$('.remove').on('click',function () {
    let total_guest =  $('#txttotalguests').val();
    let adult =  $(this).parent().parent().find('.guests-popup .total-adult').text();
    let child = $(this).parent().parent().find('.guests-popup .total-children').text();
    let total_remove =  Math.abs(Number(adult) + Number(child));
    let roomNr = $('.room-list .room-item').length;
    let total_count = Math.abs(Number(total_guest) - Number(total_remove));
    let text_guest = "";
    let text = "";
    
    $('#txtroom').val(--roomNr);
    $('#txttotalguests').val(total_count);
    
    if(roomNr < 2) {
      text = roomNr + ' Room, ';
     } else {
          text = roomNr + ' Rooms, ';
     }
     
     if(total_count < 2) {
          text_guest = total_count + ' Guest';
    } else {
        text_guest = total_count + ' Guests';
    }
    
    $('#txtguests').val(text + text_guest);
    $(this).parent().parent().remove();   
});

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
  $("#mySidenav").css({"right":"-400px"});
  $(".body_main_side_tab").css("display","none");
  $(".sn-login-links .pull-right").css("display","none");
  var x = screen.width;
  if(x <= 576){
   $("#mySidenav").css({"right":"-105%"});
  }
  //document.getElementsByClassName("image-icon-arrow-down-des").style.opacity = "0";
}
function closeUser() {
  $("#mysideUser").css({"right":"-400px"});
  $(".body_main_side_tab").css("display","none");
  $(".sn-login-links .pull-right").css("display","none");
  var x = screen.width;
  if(x <= 576){
   $("#mysideUser").css({"right":"-105%"});
  }
  //document.getElementsByClassName("image-icon-arrow-down-des").style.opacity = "0";
}
$('.body_main_side_tab').on('click', function(e) {
    $(".body_main_side_tab").hide();
    $("#mysideUser").css({"right":"-400px"});
    $("#mySidenav").css({"right":"-400px"});
    var x = screen.width;
    if(x <= 576){
       $("#mySidenav").css({"right":"-90%"});
        $("#mysideUser").css({"right":"-90%"});
     }
});
// Detect Scroll
$(window).scroll(function () {
  $(document).scrollTop() > 10 ? $(".nav-bg").addClass("bgHeader") : $(".nav-bg").removeClass("bgHeader");
  $(document).scrollTop() > 10 ? $("#layout-header form").addClass("fixed") : $("#layout-header form").removeClass("fixed");
  $(document).scrollTop() > 10 ? $(".landing_post_content").addClass("fixed") : $(".landing_post_content").removeClass("fixed");
  $(document).scrollTop() > 10 ? $("#wish-list-navbar").addClass("sticky-1") : $("#wish-list-navbar").removeClass("sticky-1");
  $('.tt-menu').hide();
});  
$(document).on('click', '.btn-plus-bedrooms', function() {
    var n = $('#txtbedrooms').val();
    $('#txtbedrooms').val(++n);
    $('.total-bedrooms').html(n);
});
$(document).on('click', '#check-bedrooms', function() {
    if ($(this).is(":checked")) {
        $("#show-bedrooms").show();
    } else {
        $("#show-bedrooms").hide();
    }
});

$(document).on('click', '.btn-minus-bedrooms', function() {
    var n = $('#txtbedrooms').val();
    if (n > 1) {
        $('#txtbedrooms').val(--n);
        $('.total-bedrooms').html(n)
      } else {
          $(this).css("opacity","0.5");
        //Otherwise do nothing
      }
});

if ($('.list-type li').length > 4) {
  $('.list-type li:gt(3)').hide(100);
  $('#show-type').show();
}

$('#show-extras').on('click', function() {
  //toggle elements with class .ty-compact-list that their index is bigger than 2
  $('.list-extras li:gt(3)').toggle(100);
  //change text of show more element just for demonstration purposes to this demo
  $(this).text() === 'Show more' ? $(this).html('Show less') : $(this).html('Show more');
  $(this).text() === 'Show more' ? $(this).addClass('more') : $(this).removeClass('more');
});

if ($('.list-extras li').length > 4) {
  $('.list-extras li:gt(3)').hide(100);
  $('#show-extras').show();
}

$('#show-type').on('click', function() {
  //toggle elements with class .ty-compact-list that their index is bigger than 2
  $('.list-type li:gt(3)').toggle(100);
  //change text of show more element just for demonstration purposes to this demo
  $(this).text() === 'Show more' ? $(this).html('Show less') : $(this).html('Show more');
  $(this).text() === 'Show more' ? $(this).addClass('more') : $(this).removeClass('more');
});

// owl carousel
$('.owl-carousel').owlCarousel({
  items:1,
  loop: false,
  autoplay: false,
  nav: true,
  autoplayTimeout: 10000
});

$(function() {
    if(window.innerWidth > 575) {
      $('input[name="txtcal-search-block"]').daterangepicker({
          opens: 'right',
          autoUpdateInput: false,
          autoApply: true,
          minDate: new Date(),
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
      },function(start_date, end_date) {
          this.element.val(start_date.format('DD/MM/YYYY')+' - '+end_date.format('DD/MM/YYYY'));
        }).on('apply.daterangepicker', function(ev, picker) {
                var start = moment(picker.startDate.format('YYYY-MM-DD'));
                var end   = moment(picker.endDate.format('YYYY-MM-DD'));
                var diff_days = Math.abs(start.diff(end, 'days'));
                
                if(Number(diff_days) <= 1){
                    $(".drp-buttons").html('<div>'+ picker.startDate.format('ddd DD MMM YYYY') +' - '+picker.endDate.format('ddd DD MMM YYYY') +'<span style="opacity: 0.5;"> ('+ diff_days +' night)</span></div>');
                }else{
                    $(".drp-buttons").html('<div>'+ picker.startDate.format('ddd DD MMM YYYY') +' - '+picker.endDate.format('ddd DD MMM YYYY') +'<span style="opacity: 0.5;"> ('+ diff_days +' nights)</span></div>');
                }     
        });
        
      $('input[name="txtcal-search-block"]').on('cancel.daterangepicker', function(ev, picker) {
          $(this).val('');
      });
        $('.daterangepicker .drp-buttons').html("Choose your dates");
    }
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
      //location.reload();
  }, 10000);

  });

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
  //console.log('Logged in as: ' + googleUser.getBasicProfile().getName());
}
function onFailure(error) {
  //console.log(error);
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



    
  
    //Next/Back slide
    var w = screen.width;
    var i = 1;
    // var c = document.getElementById("imageGallery").childElementCount;
    var c=15;
    if(w <= 576){
        $('#imageGallery > div:nth-child('+ i +')').addClass('only_show');
    }
    function arrow_left(){
        //alert("slide truoc");    
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
  $("#nav-header a").on('click', function(event) {

    if (this.hash !== "") {
      var hash = this.hash;
      $('html, body').animate({
        scrollTop: ($(hash).offset().top - 120)
      }, 500, function(){
        window.location.hash = hash;
      });
       event.preventDefault();
    } // End if
  });

  
    
