  $(document).ready(function () {

   // Add autodate 
    // Auto date setup
  /*  var DateHelper = {
      addDays: function(aDate, numberOfDays) {
        aDate.setDate(aDate.getDate() + numberOfDays); // Add numberOfDays
        return aDate; // Return the date
      },
      format: function format(date) {
        return [
          ("0" + date.getDate()).slice(-2), // Get day and pad it with zeroes
          ("0" + (date.getMonth() + 1)).slice(-2), // Get month and pad it with zeroes
          date.getFullYear() // Get full year
        ].join('/'); // Glue the pieces together
      }
    }
*/

 /*   $empty = $('#txtcal-search-block').val();

  if($empty == "") {
    $newdate = DateHelper.format(DateHelper.addDays(new Date(), 30)) + ' - ' + DateHelper.format(DateHelper.addDays(new Date(), 32));
    $('#txtcal-search-block').val($newdate);
  }
*/
  // end auto date

      $(document).on('click', '.action-view', function(){
          $(".box-bookings").hide();
          $(".box-detail-booking").show();
    });
    $(document).on('click', '#close-booking, #btn-wishlist-bookin', function(){
          $(".box-bookings").show();
          $(".box-detail-booking").hide();
    });
     $(document).on('click', '.close-form', function(){
          $("#requied-login").hide();
    });
    
  // search block   
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
	  
	  $('.info, .btn-tax, .btn-detail, .show-info-guest, .price-detail, .non-refundable').popover({
        trigger: 'manual',
		 placement: 'top',
		 html: true
	  }).click(function (e) {
		 //e.preventDefault();
		 $(this).popover('show');
	     $('.popover').addClass("popover-info");
	     $('.popover').append("<span class='close'></span>");
	  });
    });
    $(document).on('click', '.popover .close', function(){
          $(".popover").removeClass('show');
          $(".popover").popover('hide');
    });
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
    
    /*$( "#txtsearch" ).focus(function() {
     $(".opacity-search-bar-nav-bg").show();
    });*/
    
    $('.txtguests').click(function () {
        $('#popover_template').toggle();
        $('#popover_template_search').hide();
        $('.daterangepicker').hide();
    });
    /*$('#txtsearch').click(function () {
        $('#popover_template_search').toggle();
        $('#popover_template').hide();
         $('.daterangepicker').hide();
    });*/
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

    $('.onUpdateProfile-form').on('submit', function(e){
        if($("#update-password").val() != ''){
            if($("#update-password").val() != $("#update-confirm-password").val()){
                alert('Password doesn\'t match with Confirmation Password');
                return false;
            }
        }

        if($(".checkbox-subscription").prop("checked")){
        	$("input[name='iu_email_newsletter']").val(1);
        }else{
        	$("input[name='iu_email_newsletter']").val(0);
        	console.log($("input[name='iu_email_newsletter']").val());
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
        console.log(len+'fffffff');
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
    var myId = $(this).parent().parent().parent().attr('id');
    //alert('it works!');
   // console.log(myId);
    var n = $('#txtadults').val();
    var total_guest_p = $('#txtguests').val();
    var total_child_p = $('#txtchildren').val();
    //var total_guest = $('#txttotalguests').val();
    var total_guest = +$('#txttotalguests').val();
    $('#txtadults').val(++n);

    // room count
    let roomNr = $('.room-list .room-item').length;
    
    let text_a = '';
  
    if(roomNr < 2) {
      text_a = roomNr + ' Room, ';
    } else {
      text_a = roomNr + ' Rooms, ';
    }
       
    //$('#txtguests').val(n + ' Guests');
    let adults = +$(this).prev('div').html() + 1;
    //console.log(adults);
    $('#adults_' + myId).val(adults);
    $(this).prev('div').html(adults);
    if(n > 0){
        $('.btn-minus-a').css("opacity","1");
    }
    //var total_a = Math.abs( Number(total_child_p) + Number(n));
    let total_a = total_guest + 1;
    //console.log("total_a" + total_a);
    if ((total_a) < 2) {
        text_a += total_a + ' Guest';
    }else{
        text_a += total_a + ' Guests';
    }
    $('#txtguests').val(text_a);
    $('#txtroom').val(roomNr);
    $('#txttotalguests').val(total_a);
    //$('#txttotalguests').val(total_guest + 2);
});


$(document).on('click', '.btn-minus-a', function() {
    var myId = $(this).parent().parent().parent().attr('id');
    console.log(myId);
    var n = $('#txtadults').val();
    let adults = +$(this).next('div').html();
    $('#adults_' + myId).val(adults-1);
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
    var myId = $(this).parent().parent().parent().attr('id');
    //console.log(myId);
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
    //console.log(total_c);
    let childs = +$(this).prev('div').html();
    $('#child_' + myId).val(childs+1);
    $(this).prev('div').html(childs+1);

  

    ClickAddChild(childs, $(this), myId);
});


$(document).on('click', '.btn-minus-c', function() {
    //alert('it works!');
    var myId = $(this).parent().parent().parent().attr('id');
    console.log(myId);
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
        $('#child_' + myId).val(childs-1);
        $(this).next('div').html(childs-1);
        //$('#txtguests').val(n);
        
        let roomNr = $('.room-list .room-item').length;
  
          let text = '';
          
          if(roomNr < 2) {
              text = roomNr + ' Room, ';
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
        
        $("#children_"+myId).find(' .child_count:last-child').remove();
      } else {
          $(this).css("opacity","0.5");
        //Otherwise do nothing
      }
});
function ClickAddChild(index, JqueryObject, parentId){

   

    //var initChild = $('#child_'+ parentId).val();
    // selectCustom();
    var ctr = index + 1;

     // add hidden field 
    $("#children_"+parentId).append('<input type="hidden" class="child_count" name="child_'+parentId+'_sel_'+ctr+'" id="child_'+parentId+'_sel_'+ctr+'"/>');
    var structure = $('<div class="item" >' +
                                '<label for="item-child">Child '+(ctr)+'</label>' +
                                '<select name="item-child-'+parentId+'-'+ctr+'" class="select-custom" id="item-child-'+parentId+'-'+ctr+'">' +
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

    $(document).on('change', '#item-child-'+parentId+'-'+ctr,function() {
      var selectedAge = $(this).children("option:selected").val();
      $('#child_'+ parentId+'_sel_'+ctr).val(selectedAge);

      console.log('Child:' + ctr + ' Age:' + selectedAge + 'Parent:' +  parentId);
    })
}




var num = 1;

function ClickAddRoom(){

  // increment num 
  num++;
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
  //$('.room-item:last').attr("id","item_"+index);
  //$('.room-item:last h5 span:first-child').attr("id","name_"+index);
  //$('.room-item:last h5 span:first-child').text(index);

  $('.room-item:last').attr("id","item_"+num);
  $('.room-item:last h5 span:first-child').attr("id","name_"+num);
  $('.room-item:last h5 span:first-child').text(num);
  
  $('.room-item:last .infants-popup .item').remove();
  $('.room-item:last .guests-popup .total-adult').html(2);
  $('.room-item:last .guests-popup .total-children').html(0);
  
  let n = +$('#txtadults').val();
  let total_guest = +$('#txttotalguests').val();
   
  $('#txtadults').val(n+2);
  //edited mike 
 // var num = +$('#txtroom').val() + 1;
 
  $('#txtroom').val(num);
  $("#addedrooms").append('<div class="room_block" id="room_item_'+num+'"><input type="hidden" name="adults_item_'+num+'" id="adults_item_'+num+'" value="2" /><input type="hidden" name="child_item_'+num+'" id="child_item_'+num+'"/><div id="children_item_'+num+'"></div></div>');
  //$("#addedrooms").append('<input type="hidden" name="child_item_'+num+'" id="child_item_'+num+'"/>');



  
  
  let total_child_p = $('#txtchildren').val();
  
  //let total_a = n + 2 + +total_child_p;
  let total_a = total_guest + 2 ;
  
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
    //$('#txttotalguests').val(total_a);
    $('#txttotalguests').val(total_guest + 2);
    //$('#txtguests').val(total_guest);


  console.log(roomNr);

}
$('.remove').on('click',function () {
    let total_guest =  $('#txttotalguests').val();
    let adult =  $(this).parent().parent().find('.guests-popup .total-adult').text();
    let child = $(this).parent().parent().find('.guests-popup .total-children').text();
    let total_remove =  Math.abs(Number(adult) + Number(child));
    let total_remove_adults = +$('#txtadults').val() - Math.abs(Number(adult));
    let roomNr = $('.room-list .room-item').length;
    let total_count = Math.abs(Number(total_guest) - Number(total_remove));
    let text_guest = "";
    let text = "";
    
    //$('#txtroom').val(--roomNr);
    $('#txtroom').val(--roomNr);
    $('#txttotalguests').val(total_count);
    $('#txtadults').val(total_remove_adults);
    // edited Mike
    
    //$('#adults_item_'+ num).remove();
    //$('#child_item_'+ num).remove();
    var myId = $(this).parent().parent().attr('id');
    console.log(myId + " removed.")
    $('#room_'+ myId).remove();
    if(num > 1) {    
      console.log(num);
      num--;
      $('.room-item:last h5 span:first-child').text(num);
      //$('.room-item:last').attr("id","item_"+num);
      //$('.room_block:last').attr("id","room_item_"+num);

    }
    

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
   $("#mySidenav").css({"right":"-100%"});
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
        
          $(".txtsearch-nav").val($(this).text());
          var data_search_val =  $(".txtsearch-nav").val();
          if(data_search_val != ""){
            $("#popover_template_search").hide();
            $('input[name="txtcal"]').focus();
           
          }
    });
     $(document).on('click', ' #location-list #li_a3', function(){
          $(".txtsearch-nav").val($(this).text());
          var data_search_val =  $(".txtsearch-nav").val();
          if(data_search_val != ""){
            $("#popover_template_search").hide();
            $('input[name="txtcal"]').focus();
          
          }
    });
    $(document).on('click', ' #location-list #li_a4', function(){
        
          $(".txtsearch-nav").val($(this).text());
          var data_search_val =  $(".txtsearch-nav").val();
          if(data_search_val != ""){
            $("#popover_template_search").hide();
            $('input[name="txtcal"]').focus();
           
          }
    });
     $(document).on('click', ' #location-list #li_a5', function(){
          $(".txtsearch-nav").val($(this).text());
          var data_search_val =  $(".txtsearch-nav").val();
          
          if(data_search_val != ""){
            $("#popover_template_search").hide();
            $('input[name="txtcal"]').focus();
          }
    });
    $(document).on('click', ' #location-list #li_a6', function(){
        
          $(".txtsearch-nav").val($(this).text());
          var data_search_val =  $(".txtsearch-nav").val();
          if(data_search_val != ""){
            $("#popover_template_search").hide();
            $('input[name="txtcal"]').focus();
           
          }
    });
     $(document).on('click', ' #location-list #li_a7', function(){
          $(".txtsearch-nav").val($(this).text());
          var data_search_val =  $(".txtsearch-nav").val();
          
          if(data_search_val != ""){
            $("#popover_template_search").hide();
            $('input[name="txtcal"]').focus();
          
          }
    });
    $(document).on('click', ' #location-list #li_a8', function(){
        
          $(".txtsearch-nav").val($(this).text());
          var data_search_val =  $(".txtsearch-nav").val();
          if(data_search_val != ""){
            $("#popover_template_search").hide();
            $('input[name="txtcal"]').focus();
           
          }
    });
     $(document).on('click', ' #location-list #li_a9', function(){
          $(".txtsearch-nav").val($(this).text());
          var data_search_val =  $(".txtsearch-nav").val();
          
          if(data_search_val != ""){
            $("#popover_template_search").hide();
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

  $('.your-class').slick({
      infinite: true,
        slidesToShow: 3,
        slidesToScroll: 1,
        dots: true
    });
    $('.gallery').slick({
      infinite: true,
      slidesToShow: 1,
      slidesToScroll: 1,
      arrows: true
    });


// Lazy load 

$(function() {
        $('.lazy').Lazy({
          beforeLoad: function(element) {
            console.log('loaded');
          }
        });
    });




