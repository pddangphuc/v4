  $(document).ready(function () {

  //slider
   // $('.your-class').slick({
   //    infinite: true,
    //  slidesToShow: 3,
    //  slidesToScroll: 1,
    //  dots: true
   //  });

   // slick slider
   /*$('.gallery').slick({
      infinite: true,
      slidesToShow: 1,
      slidesToScroll: 1,
      arrows: false
    });*/

  // search block   
   searchBlk = $('<div class="search-bar-main search-main"><div class="container page-container p-0"><form action="search" method="post"><div class="search-block"><div class="search-left float-left"><div class="search-box"><input type="text" autocomplete="off" id="txtsearch-main" rel="comments" name="txtsearch" placeholder="Where do you want to go?" class="txtsearch" /></div><div class="date-box"><input type="text" autocomplete="off" name="txtcal" class="txtcal" id="txtcal" placeholder="Dates"/></div><div class="guests-box"><input type="text" rel="comments" autocomplete="off" name="txtguests" placeholder="Guests" class="txtguests-main" id="txtguests"></div></div><div class="search-right float-left"><input type="hidden" name="txtadults" id="txtadults" min="0" value="2" /><input type="hidden" name="txtchildren" id="txtchildren" /><input type="hidden" name="txtinfants" id="txtinfants" /><input type="hidden" name="txtpets" id="txtpets" /><button name="btnsearch" class="btn btn-primary btn-search">SEARCH</button></div></div></form></div></div>');
   $('.hero-block').append(searchBlk);

   // pop-over
  // $("[data-toggle=popover]").popover();
   //$('#collapseDestination').collapse();


   /* $("#wrap-top").length && $("#header").addClass("hasslide")

    var width = $(window).width(); 
    if ( width < 768 ) {
    console.log($(document).scrollTop());
    $("#header").addClass("hasslide")
    $(window).scroll(function () {
        $(document).scrollTop() > 2 ? $("#header").addClass("bgHeader") : $("#header").removeClass("bgHeader")
    });
    }*/


    //var j = jQuery; //Just a variable for using jQuery without conflicts
    var addInput = '#txtguests'; //This is the id of the input you are changing
    var n = 2; //n is equal to 1
    
    //Set default value to n (n = 1)
    //$('#txtguests').val(n);
    /*
    //On click add 1 to n
    $('.btn-plus').on('click', function(){
      //$(addInput).val(++n);
      console.log(n);
    });

    $('.btn-minus').on('click', function(){
      //If n is bigger or equal to 1 subtract 1 from n
      if (n > 1) {
        $('#txtguests').val(--n);
      } else {
        //Otherwise do nothing
      }
    });
 */

$(".txtguests-main").change(function(){
    var n = $(this).val();
    console.log(n);
});

$('.txtguests').click(function () {
        // $('.popover').hide();
        // $(' #txtsearch-body-nav').hide();
        $("[rel=comments]").not(this).popover('hide');
        $(this).val( 2 + ' Guests');
        var n = $(this).val();
        console.log(n);
        $(this).popover({
            html: true,
            container: '.nav-bg, .nav-bg-fix',
            trigger: 'manual',
            placement: 'bottom',
            content: function () {
                var $buttons = $('#popover_template').html();
                return "<div id='txtguests-body'>"+$buttons+"</div>";
            }
        }).popover('toggle');
    });
    $('.opacity-search-bar-nav-bg').on('click', function(e) {
      if (typeof $(e.target).data('original-title') == 'undefined' &&
         !$(e.target).parents().is('.popover.in')) {
        $('[data-original-title]').popover('hide');
        $(".opacity-search-bar-nav-bg").hide();
      }
    });
    
    $('.txtguests-main').click(function () {
        $(this).val( 2 + ' Guests');
        //$('#txtsearch-body').hide();
        //$('.txtguests-main .popover').hide();
        $("[rel=comments]").not(this).popover('hide');
        $(this).popover({
                    html: true,
                    container: '.hero-block',
                    trigger: 'manual',
                    placement: 'bottom',
                    content: function () {
                        var $buttons = $('#popover_template').html();
                        return "<div id='txtguests-body-main'>"+$buttons+"</div>";
                    }
        }).popover('toggle');
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
    });
    
    // call function event of search bar
    
    $( "#txtsearch" ).focus(function() {
     $(".opacity-search-bar-nav-bg").show();
    });
    
    $('.txtsearch').click(function () {
        //$('.popover').hide();
        //$(' #txtguests-body-main').hide();
        
        $(this).popover({
                    html: true,
                    container: '.hero-block',
                    trigger: 'manual',
                    placement: 'bottom',
                    content: function () {
                        var $buttons = $('#popover_template_search').html();
                        return "<div id='txtsearch-body'>"+$buttons+"</div>";
                    }
        }).popover('toggle');
        $('.popover').css({
            "display":"table"
        });

    });
    
    $('.txtsearch-nav').click(function () {
        // $('.popover').hide();
        // $(' #txtguests-body').hide();
        $("[rel=comments]").not(this).popover('hide');
        $(this).popover({
                    html: true,
                    container: '.nav-bg, .nav-bg-fix',
                    trigger: 'manual',
                    placement: 'bottom',
                    content: function () {
                        var $buttons = $('#popover_template_search').html();
                        return "<div id='txtsearch-body-nav'>"+$buttons+"</div>";
                    }
        }).popover('toggle');
        $('.popover').css({
            "display":"table"
        });
    });
    
});

//search location in search bar main
// $(document).on('keyup', '#txtsearch-main', function(){
//     var value_search_location = $(".popover li span").val().toLowerCase();
//     $(".popover li").filter(function() {
//       let match = $(".popover li span").text().toLowerCase().indexOf(value_search_location) > -1;
//       if(match) {
//         console.log('match');
//         let newString = $(".popover li span").text().replace('<b>','');
//         newString = newString.replace('</b>','');
//         newString = newString.replace(value_search_location, '<b>' + value_search_location + '</b>');
//         $(".popover li span").html(newString);
//       }
//       $(this).toggle(match)
//     });
// });

$(document).on('keyup', '#txtsearch-main', function(){
    var value_search_location = $(this).val().toLowerCase();
    $(".popover li").filter(function() {
      $(this).toggle($(this).text().toLowerCase().indexOf(value_search_location) > -1)
    });
})

//search location in search bar sub
$(document).on('keyup', '#txtsearch', function(){
    var value_search_location = $(this).val().toLowerCase();
    $(".popover li").filter(function() {
      $(this).toggle($(this).text().toLowerCase().indexOf(value_search_location) > -1);
    });
})

$(document).on('click', '#btnsearch', function(){
  $('form' ).submit();
})

//calculator total guests in search nav-bg 

$(document).on('click', '.nav-bg .btn-plus-a', function() {
    //alert('it works!');
    var n = $('#txtadults').val();
    var total_pet = $('#txtpets').val();
    var total_guest_p_sub = $('#txtguests-sub').val();
    var total_child_p = $('#txtchildren').val();
    var split_guest_sub = total_guest_p_sub.slice(0,2);
    var total_guest_type_p_sub = Number(split_guest_sub);
    //console.log(++n);
    $('#txtadults').val(++n);
    //$('#txtguests-sub').val(n + ' Guests');
    $('.total-adult').html(n);
    if(n < 2){
        $('#txtguests-sub').val(n + ' Guest');
    }else{
        $('#txtguests-sub').val(n + ' Guests');
    }
    if(n > 0){
        $('.btn-minus-a').css("opacity","1");
    }
    if (total_pet != 0){
        if(total_pet == 1){
            $('#txtguests-sub').val(++total_guest_type_p_sub + ' Guests' + ', ' + total_pet + ' Pet');
        }else{
            $('#txtguests-sub').val(++total_guest_type_p_sub + ' Guests' + ', ' + total_pet + ' Pets');
        }
            
    }else{
            if(total_guest_type_p_sub > 0 & total_child_p > 0 & n > 0){
                $('#txtguests-sub').val(++total_guest_type_p_sub + ' Guests');
            } 
    }
    
});

$(document).on('click', '.nav-bg .btn-minus-a', function() {
    //alert('it works!');
    var n = $('#txtadults').val();
    var total_pet = $('#txtpets').val();
    var total_guest_m_sub = $('#txtguests-sub').val();
    var total_child_m = $('#txtchildren').val();
    var split_guest_m_sub = total_guest_m_sub.slice(0,2);
    var total_guest_type_m_sub = Number(split_guest_m_sub);
    //console.log(--n);
    if(n == 0){
        $(this).css("opacity","0.5");
        $(this).prop('disabled',true);
    }else{
        $('.btn-minus-a').css("opacity","1");
    }
    if(n < 2){
        $('#txtguests-sub').val(n + ' Guest');
    }else{
        $('#txtguests-sub').val(n + ' Guests');
    }
    if (n > 0) {
       
        $('#txtadults').val(--n);
        // $('#txtguests-sub').val(n + ' Guests');

        $('.total-adult').html(n);
        if (total_pet != 0){
            if(total_pet == 1){
                    $('#txtguests-sub').val(--total_guest_type_m_sub + ' Guests' + ', ' + total_pet + ' Pet');
                }else{
                    $('#txtguests-sub').val(--total_guest_type_m_sub + ' Guests' + ', ' + total_pet + ' Pets');
                }
                    
            }else{
                    if(total_guest_type_m_sub > 0){
                        $('#txtguests-sub').val(--total_guest_type_m_sub + ' Guests');
                    }
            }
      } else {
          $('.btn-minus-a').css("opacity","0.5");
        //Otherwise do nothing
      }
     
    
});


$(document).on('click', '.nav-bg .btn-plus-c', function() {
    //alert('it works!');
    var n_child = $('#txtchildren').val();
    var total_pet_c = $('#txtpets').val();
    //console.log(++n);
    $('#txtchildren').val(++n_child);
    var nc_d = $('#txtadults').val();
    var nc_i = $('#txtinfants').val();
    if(n_child > 0){
        $('.btn-minus-c').css("opacity","1");
    }
    if(total_pet_c != 0){
        if(total_pet_c == 1){
            $('#txtguests-sub').val(Math.abs(Number(nc_d) + Number(nc_i) + Number(n_child)) + ' Guests' + ', ' + total_pet_c + ' Pet');
        }else{
            $('#txtguests-sub').val(Math.abs(Number(nc_d) + Number(nc_i) + Number(n_child)) + ' Guests' + ', ' + total_pet_c + ' Pets');
        }
        
    }else{
        $('#txtguests-sub').val(Math.abs(Number(nc_d) + Number(nc_i) + Number(n_child)) + ' Guests');
    }
   
    $('.total-children').html(n_child);
});


$(document).on('click', '.nav-bg .btn-minus-c', function() {
    //alert('it works!');
    var n_child = $('#txtchildren').val();
    var total_pet_c = $('#txtpets').val();
    //console.log(--n);
    if((n_child-1) == 0){
        $('.btn-minus-c').css("opacity","0.5");
    }else{
        $('.btn-minus-c').css("opacity","1");
    }
    if (n_child > 0) {
       
        $('#txtchildren').val(--n_child);
        //$('#txtguests').val(n);
        var nc_m_sub = $('#txtguests-sub').val();
        var split_guest_nc_m_sub = nc_m_sub.slice(0,2);
        var total_guest_type_nc_m_sub = Number(split_guest_nc_m_sub);
        if(total_pet_c != 0){
            if(total_pet_c == 1){
                $('#txtguests-sub').val(--total_guest_type_nc_m_sub + ' Guests' + ', ' + total_pet_c + ' Pet');
            }else{
                $('#txtguests-sub').val(--total_guest_type_nc_m_sub + ' Guests' + ', ' + total_pet_c + ' Pets');
            }
            
        }else{
            $('#txtguests-sub').val(--total_guest_type_nc_m_sub + ' Guests');
        }
        
        $('.total-children').html(n_child);
      } else {
          $('.btn-minus-c').css("opacity","0.5");
        //Otherwise do nothing
      }
});

$(document).on('click', '.nav-bg .btn-plus-infant', function() {
    //alert('it works!');
    var n_infant = $('#txtinfants').val();
    var total_pet_i = $('#txtpets').val();
    //console.log(++n);
    $('#txtinfants').val(++n_infant);
    var nf_d = $('#txtadults').val();
    var nf_c = $('#txtchildren').val();
    if(n_infant > 0){
        $('.btn-minus-infant').css("opacity","1");
    }
    if(total_pet_i != 0){
        if(total_pet_i == 1){
            $('#txtguests-sub').val(Math.abs(Number(nf_d) + Number(nf_c) + Number(n_infant)) + ' Guests' + ', ' + total_pet_i + ' Pet');
        }else{
            $('#txtguests-sub').val(Math.abs(Number(nf_d) + Number(nf_c) + Number(n_infant)) + ' Guests' + ', ' + total_pet_i + ' Pets');
        }
        
    }
    else{
        $('#txtguests-sub').val(Math.abs(Number(nf_d) + Number(nf_c) + Number(n_infant)) + ' Guests');
    }
    
    $('.total-infant').html(n_infant);
});


$(document).on('click', '.nav-bg .btn-minus-infant', function() {
    //alert('it works!');
    var n_infant = $('#txtinfants').val();
    var total_pet_i = $('#txtpets').val();
    //console.log(--n);
    if((n_infant-1) == 0){
        $('.btn-minus-infant').css("opacity","0.5");
    }else{
        $('.btn-minus-infant').css("opacity","1");
    }
    if (n_infant > 0) {
        
        $('#txtinfants').val(--n_infant);
        //$('#txtguests').val(n);
        var nf_g_sub = $('#txtguests-sub').val();
        var split_guest_nf_g_sub = nf_g_sub.slice(0,2);
        var total_guest_type_nf_g_sub = Number(split_guest_nf_g_sub);
        if(total_pet_i != 0){
            if(total_pet_i == 1){
                $('#txtguests-sub').val(--total_guest_type_nf_g_sub + ' Guests' + ', ' + total_pet_i + ' Pet');
            }else{
                $('#txtguests-sub').val(--total_guest_type_nf_g_sub + ' Guests' + ', ' + total_pet_i + ' Pets');
            }
            
        }
        else{
            $('#txtguests-sub').val(--total_guest_type_nf_g_sub + ' Guests');
        }
        
        $('.total-infant').html(n_infant);
      } else {
        $('.btn-minus-infant').css("opacity","0.5");
      }
});

$(document).on('click', '.nav-bg .btn-plus-pet', function() {
    //alert('it works!');
    var n_pet = $('#txtpets').val();
    //console.log(++n);
    var n_infant = $('#txtinfants').val();
    var nf_c = $('#txtchildren').val();
    $('#txtpets').val(++n_pet);
    if(n_pet > 0){
        $('.btn-minus-pet').css("opacity","1");
    }
    var np_d = $('#txtadults').val();
    // var nf_c = $('#txtchildren').val();
    var nf_pet_sub = $('#txtguests-sub').val();
    var split_guest_pet_sub = nf_pet_sub.slice(0,2);
    var total_guest_type_pet_sub = Number(split_guest_pet_sub);
    if(n_pet == 1){
        if(np_d == 2 & n_infant == "" & nf_c == ""){
            $('#txtguests-sub').val(np_d + " Guests" + ', ' + n_pet + ' Pet');
        }else{
            $('#txtguests-sub').val(total_guest_type_pet_sub + " Guests" + ', ' + n_pet + ' Pet');
        }
        
    }else{
        $('#txtguests-sub').val(total_guest_type_pet_sub + " Guests" + ', ' + n_pet + ' Pets');
    }
    
    $('.total-pet').html(n_pet);
});

$(document).on('click', '.nav-bg .btn-minus-pet', function() {
    //alert('it works!');
    var n_pet = $('#txtpets').val();
    //console.log(--n);
    if((n_pet-1) == 0){
        $('.btn-minus-pet').css("opacity","0.5");
    }else{
        $('.btn-minus-pet').css("opacity","1");
    }
    if (n_pet > 0) {
       
        $('#txtpets').val(--n_pet);
        //$('#txtguests').val(n);
        // var nf_g = $('#txtguests').val();
        // $('#txtguests').val(--nf_g);
        var nf_pet_m_sub = $('#txtguests-sub').val();
        var split_guest_pet_m_sub = nf_pet_m_sub.slice(0,2);
        var total_guest_type_pet_m_sub = Number(split_guest_pet_m_sub);
        if(Number(n_pet) != 0){
            if(Number(n_pet) == 1){
                $('#txtguests-sub').val(total_guest_type_pet_m_sub + " Guests" + ', ' + n_pet + ' Pet');
            }else{
                $('#txtguests-sub').val(total_guest_type_pet_m_sub + " Guests" + ', ' + n_pet + ' Pets');
            }
            
        }else{
            $('#txtguests-sub').val(total_guest_type_pet_m_sub + " Guests");
        }
        
        $('.total-pet').html(n_pet);
      } else {
        $('.btn-minus-pet').css("opacity","0.5");
      }
});

//calculator total guests in search nav-bg-fix 

$(document).on('click', '.nav-bg-fix .btn-plus-a', function() {
    //alert('it works!');
    var n = $('#txtadults').val();
    var total_pet = $('#txtpets').val();
    var total_guest_p_sub = $('#txtguests-sub').val();
    var total_child_p = $('#txtchildren').val();
    var split_guest_sub = total_guest_p_sub.slice(0,2);
    var total_guest_type_p_sub = Number(split_guest_sub);
    //console.log(++n);
    $('#txtadults').val(++n);
    //$('#txtguests-sub').val(n + ' Guests');
    $('.total-adult').html(n);
    if(n < 2){
        $('#txtguests-sub').val(n + ' Guest');
    }else{
        $('#txtguests-sub').val(n + ' Guests');
    }
    if(n > 0){
        $('.btn-minus-a').css("opacity","1");
    }
    if (total_pet != 0){
        if(total_pet==1){
            $('#txtguests-sub').val(++total_guest_type_p_sub + ' Guests' + ', ' + total_pet + ' Pet');
        }else{
            $('#txtguests-sub').val(++total_guest_type_p_sub + ' Guests' + ', ' + total_pet + ' Pets');
        }
            
        }else{
            if(total_guest_type_p_sub > 0 & total_child_p > 0 & n > 0){
                $('#txtguests-sub').val(++total_guest_type_p_sub + ' Guests');
            } 
    }
    
});

$(document).on('click', '.nav-bg-fix .btn-minus-a', function() {
    //alert('it works!');
    var n = $('#txtadults').val();
    var total_pet = $('#txtpets').val();
    var total_guest_m_sub = $('#txtguests-sub').val();
    var total_child_m = $('#txtchildren').val();
    var split_guest_m_sub = total_guest_m_sub.slice(0,2);
    var total_guest_type_m_sub = Number(split_guest_m_sub);
    //console.log(--n);
    if((n-1) == 0){
        $('.btn-minus-a').css("opacity","0.5");
    }else{
        $('.btn-minus-a').css("opacity","1");
    }
    if(n < 2){
        $('#txtguests-sub').val(n + ' Guest');
    }else{
        $('#txtguests-sub').val(n + ' Guests');
    }
    if (n > 0) {
        $('#txtadults').val(--n);
        
        //$('#txtguests-sub').val(n + ' Guests');
        $('.total-adult').html(n);
        if (total_pet != 0){
            if(total_pet == 1){
                     $('#txtguests-sub').val(--total_guest_type_m_sub + ' Guests' + ', ' + total_pet + ' Pet');
                }else{
                    $('#txtguests-sub').val(--total_guest_type_m_sub + ' Guests' + ', ' + total_pet + ' Pets');
                }
                    
            }else{
                    if(total_guest_type_m_sub > 0){
                        $('#txtguests-sub').val(--total_guest_type_m_sub + ' Guests');
                    }
            }
      } else {
          $('.btn-minus-a').css("opacity","0.5");
        //Otherwise do nothing
      }
     
    
});


$(document).on('click', '.nav-bg-fix .btn-plus-c', function() {
    //alert('it works!');
    var n_child = $('#txtchildren').val();
    var total_pet_c = $('#txtpets').val();
    //console.log(++n);
    $('#txtchildren').val(++n_child);
    var nc_d = $('#txtadults').val();
    var nc_i = $('#txtinfants').val();
    if(n_child > 0){
        $('.btn-minus-c').css("opacity","1");
    }
    if(total_pet_c != 0){
        if(total_pet_c == 1){
            $('#txtguests-sub').val(Math.abs(Number(nc_d) + Number(nc_i) + Number(n_child)) + ' Guests' + ', ' + total_pet_c + ' Pet');
        }else{
            $('#txtguests-sub').val(Math.abs(Number(nc_d) + Number(nc_i) + Number(n_child)) + ' Guests' + ', ' + total_pet_c + ' Pets');
        }
        
    }else{
        $('#txtguests-sub').val(Math.abs(Number(nc_d) + Number(nc_i) + Number(n_child)) + ' Guests');
    }
   
    $('.total-children').html(n_child);
});


$(document).on('click', '.nav-bg-fix .btn-minus-c', function() {
    //alert('it works!');
    var n_child = $('#txtchildren').val();
    var total_pet_c = $('#txtpets').val();
    if((n_child-1) == 0){
        $('.btn-minus-c').css("opacity","0.5");
    }else{
        $('.btn-minus-c').css("opacity","1");
    }
    //console.log(--n);
    if (n_child > 0) {
        
        $('#txtchildren').val(--n_child);
        //$('#txtguests').val(n);
        var nc_m_sub = $('#txtguests-sub').val();
        var split_guest_nc_m_sub = nc_m_sub.slice(0,2);
        var total_guest_type_nc_m_sub = Number(split_guest_nc_m_sub);
        if(total_pet_c != 0){
            if(total_pet_c){
                $('#txtguests-sub').val(--total_guest_type_nc_m_sub + ' Guests' + ', ' + total_pet_c + ' Pet');
            }else{
                $('#txtguests-sub').val(--total_guest_type_nc_m_sub + ' Guests' + ', ' + total_pet_c + ' Pets');
            }
            
        }else{
            $('#txtguests-sub').val(--total_guest_type_nc_m_sub + ' Guests');
        }
        
        $('.total-children').html(n_child);
      } else {
          $('.btn-minus-c').css("opacity","0.5");
        //Otherwise do nothing
      }
});

$(document).on('click', '.nav-bg-fix .btn-plus-infant', function() {
    //alert('it works!');
    var n_infant = $('#txtinfants').val();
    var total_pet_i = $('#txtpets').val();
    //console.log(++n);
    $('#txtinfants').val(++n_infant);
    var nf_d = $('#txtadults').val();
    var nf_c = $('#txtchildren').val();
    if(n_infant > 0){
        $('.btn-minus-infant').css("opacity","1");
    }
    if(total_pet_i != 0){
        if(total_pet_i){
            $('#txtguests-sub').val(Math.abs(Number(nf_d) + Number(nf_c) + Number(n_infant)) + ' Guests' + ', ' + total_pet_i + ' Pet');
        }else{
            $('#txtguests-sub').val(Math.abs(Number(nf_d) + Number(nf_c) + Number(n_infant)) + ' Guests' + ', ' + total_pet_i + ' Pets');
        }
        
    }
    else{
        $('#txtguests-sub').val(Math.abs(Number(nf_d) + Number(nf_c) + Number(n_infant)) + ' Guests');
    }
    
    $('.total-infant').html(n_infant);
});


$(document).on('click', '.nav-bg-fix .btn-minus-infant', function() {
    //alert('it works!');
    var n_infant = $('#txtinfants').val();
    var total_pet_i = $('#txtpets').val();
    //console.log(--n);
    if((n_infant-1) == 0){
        $('.btn-minus-infant').css("opacity","0.5");
    }else{
        $('.btn-minus-infant').css("opacity","1");
    }
    if (n_infant > 0) {
        
        $('#txtinfants').val(--n_infant);
        //$('#txtguests').val(n);
        var nf_g_sub = $('#txtguests-sub').val();
        var split_guest_nf_g_sub = nf_g_sub.slice(0,2);
        var total_guest_type_nf_g_sub = Number(split_guest_nf_g_sub);
        if(total_pet_i != 0){
            if(total_pet_i == 1){
                $('#txtguests-sub').val(--total_guest_type_nf_g_sub + ' Guests' + ', ' + total_pet_i + ' Pet');
            }else{
                $('#txtguests-sub').val(--total_guest_type_nf_g_sub + ' Guests' + ', ' + total_pet_i + ' Pets');
            }
            
        }
        else{
            $('#txtguests-sub').val(--total_guest_type_nf_g_sub + ' Guests');
        }
        
        $('.total-infant').html(n_infant);
      } else {
        $('.btn-minus-infant').css("opacity","0.5");
      }
});

$(document).on('click', '.nav-bg-fix .btn-plus-pet', function() {
    //alert('it works!');
    var n_pet = $('#txtpets').val();
    //console.log(++n);
    var n_infant = $('#txtinfants').val();
    var nf_c = $('#txtchildren').val();
    $('#txtpets').val(++n_pet);
    if(n_pet > 0){
        $('.btn-minus-pet').css("opacity","1");
    }
    var np_d = $('#txtadults').val();
    // var nf_c = $('#txtchildren').val();
    var nf_pet_sub = $('#txtguests-sub').val();
    var split_guest_pet_sub = nf_pet_sub.slice(0,2);
    var total_guest_type_pet_sub = Number(split_guest_pet_sub);
    if(n_pet == 1){
        if(np_d == 2 & n_infant == "" & nf_c == ""){
            $('#txtguests-sub').val(np_d + " Guests" + ', ' + n_pet + ' Pet');
        }else{
            $('#txtguests-sub').val(total_guest_type_pet_sub + " Guests" + ', ' + n_pet + ' Pet');
        }
        
    }else{
        $('#txtguests-sub').val(total_guest_type_pet_sub + " Guests" + ', ' + n_pet + ' Pets');
    }
    
    $('.total-pet').html(n_pet);
});


$(document).on('click', '.nav-bg-fix .btn-minus-pet', function() {
    //alert('it works!');
    var n_pet = $('#txtpets').val();
    //console.log(--n);
    if((n_pet-1) == 0){
        $('.btn-minus-pet').css("opacity","0.5");
    }else{
        $('.btn-minus-pet').css("opacity","1");
    }
    if (n_pet > 0) {
       
        $('#txtpets').val(--n_pet);
        
        //$('#txtguests').val(n);
        // var nf_g = $('#txtguests').val();
        // $('#txtguests').val(--nf_g);
        var nf_pet_m_sub = $('#txtguests-sub').val();
        var split_guest_pet_m_sub = nf_pet_m_sub.slice(0,2);
        var total_guest_type_pet_m_sub = Number(split_guest_pet_m_sub);
        if(Number(n_pet) != 0){
            if(Number(n_pet) == 1){
                $('#txtguests-sub').val(total_guest_type_pet_m_sub + " Guests" + ', ' + n_pet + ' Pet');
            }else{
                $('#txtguests-sub').val(total_guest_type_pet_m_sub + " Guests" + ', ' + n_pet + ' Pets');
            }
            
        }else{
            $('#txtguests-sub').val(total_guest_type_pet_m_sub + " Guests");
        }
        
        $('.total-pet').html(n_pet);
      } else {
        $('.btn-minus-pet').css("opacity","0.5");
      }
});

//calculator total guests in search hero block
$(document).on('click', '.hero-block .btn-plus-a', function() {
    //alert('it works!');
    var n = $('#txtadults').val();
    var total_pet = $('#txtpets').val();
    var total_guest_p = $('#txtguests').val();
    var total_child_p = $('#txtchildren').val();
    var split_guest = total_guest_p.slice(0,2);
    var total_guest_type_p = Number(split_guest);
    //console.log(++n);
    $('#txtadults').val(++n);
    //$('#txtguests').val(n + ' Guests');
    $('.total-adult').html(n);
    if(n < 2){
        $('#txtguests').val(n + ' Guest');
    }else{
        $('#txtguests').val(n + ' Guests');
    }
    if(n > 0){
        $('.btn-minus-a').css("opacity","1");
    }
    if (total_pet != 0){
        if(total_pet == 1){
        
            $('#txtguests').val(++total_guest_type_p + ' Guests' + ', ' + total_pet + ' Pet');
        }else{
            $('#txtguests').val(++total_guest_type_p + ' Guests' + ', ' + total_pet + ' Pets');
        }
            
    }else{
            if(total_guest_type_p < 2){
                $('#txtguests').val(++total_guest_type_p + ' Guest');
            }
            if(total_guest_type_p > 1 & total_child_p > 1 & n > 1){
                $('#txtguests').val(++total_guest_type_p + ' Guests');
            } 
    }
    
});


// $(document).on('click', '.hero-block .btn-minus-a', function() {
//     //alert('it works!');
//     var n = $('#txtadults').val();
//     var total_pet = $('#txtpets').val();
//     var total_guest_m = $('#txtguests').val();
//     var total_child_m = $('#txtchildren').val();
//     var total_infant = $('#txtinfants').val();
//     var split_guest_m = total_guest_m.slice(0,2);
//     var total_guest_type_m = Number(split_guest_m);
//     if((n-1) == 0){
//         console.log(n-1);
//         $('.btn-minus-a').css("opacity","0.8");
//         $('.btn-minus-a').prop("disabled",true);
//     }else{
//         $('.btn-minus-a').css("opacity","1");
//     }
//     if((n-1) < 2){
//         $('#txtguests').val(n + ' Guest');
//     }else{
//         $('#txtguests').val(n + ' Guests');
//     }
//     if (n > 0) {
//         $('#txtadults').val(--n);
//         //$('#txtguests').val(n + ' Guests');
//         $('.total-adult').html(n);
//         if (total_pet != 0){
//             if(total_pet == 1){
//                 if(n < 2 & total_child_m == "" & total_infant == ""){
//                     $('#txtguests').val(--total_guest_type_m + ' Guest' + ', ' + total_pet + ' Pet');
//                 }else{
//                     $('#txtguests').val(--total_guest_type_m + ' Guests' + ', ' + total_pet + ' Pet');
//                 }
               
//             }else{
//                 if(n < 2 & total_child_m == "" & total_infant == ""){
//                     $('#txtguests').val(--total_guest_type_m + ' Guest' + ', ' + total_pet + ' Pets');
//                 }else{
//                     $('#txtguests').val(--total_guest_type_m + ' Guests' + ', ' + total_pet + ' Pets');
//                 }
                
//             }
                
//         }else{
//             if(total_guest_type_m > 0){
//                 if(n < 2  & total_child_m == "" & total_infant == ""){
//                     $('#txtguests').val(--total_guest_type_m + ' Guest');
//                 }else{
//                     $('#txtguests').val(--total_guest_type_m + ' Guests');
//                 }
                
//             }
//         }
//   } else {
//      $('.btn-minus-a').css("opacity","0.5");
//     //Otherwise do nothing
//   }

    
// });


$(document).on('click', '.hero-block .btn-minus-a', function() {
    //alert('it works!');
    var n = $('#txtadults').val();
    var total_pet = $('#txtpets').val();
    var total_guest_m = $('#txtguests').val();
    var total_child_m = $('#txtchildren').val();
    var total_infant = $('#txtinfants').val();
    var split_guest_m = total_guest_m.slice(0,2);
    var total_guest_type_m = Number(split_guest_m);
    if((n-1) == 0){
        $('.btn-minus-a').css("opacity","0.5");
    }else{
        $('.btn-minus-a').css("opacity","1");
    }
    
    if (n > 0) {
        $('#txtadults').val(--n);
        $('#txtguests').val(n + ' Guests');
        $('.total-adult').html(n);
        if (total_pet != 0){
            if(total_pet == 1){
                    
                    if(n == 1 & total_child_m == "" & total_infant == ""){
                        $('#txtguests').val(--total_guest_type_m + ' Guest' + ', ' + total_pet + ' Pet');
                    }else{
                        $('#txtguests').val(--total_guest_type_m + ' Guests' + ', ' + total_pet + ' Pet');
                    }
                   
                }else{
                    if(n == 1 & total_child_m == "" & total_infant == ""){
                        $('#txtguests').val(--total_guest_type_m + ' Guest' + ', ' + total_pet + ' Pets');
                    }else{
                        $('#txtguests').val(--total_guest_type_m + ' Guests' + ', ' + total_pet + ' Pets');
                    }
                    
                }
                    
            }else{
                if(total_guest_type_m > 0){
                    console.log(n);
                    if(n == 1 & total_child_m == "" & total_infant == ""){
                        $('#txtguests').val(--total_guest_type_m + ' Guest');
                    }else{
                        $('#txtguests').val(--total_guest_type_m + ' Guests');
                    }
                    
                }
            }
      } else {
         $('.btn-minus-a').css("opacity","0.5");
        //Otherwise do nothing
      }

    
});


$(document).on('click', '.hero-block .btn-plus-c', function() {
    //alert('it works!');
    var n_child = $('#txtchildren').val();
    var total_pet_c = $('#txtpets').val();
    //console.log(++n);
    $('#txtchildren').val(++n_child);
    var nc_d = $('#txtadults').val();
    var nc_i = $('#txtinfants').val();
    
    if(n_child > 0){
        $('.btn-minus-c').css("opacity","1");
    }
    var total_c = Math.abs(Number(nc_d) + Number(nc_i) + Number(n_child));
    var text_c = '';
    if (total_c < 2) {
        text_c = total_c + ' Guest';
    }else{
        text_c = total_c + ' Guests';
    }
    if(total_pet_c != 0){
        if(total_pet_c == 1){
            $('#txtguests').val(text_c + ', ' + total_pet_c + ' Pet');
            }else{
                $('#txtguests').val(text_c + ', ' + total_pet_c + ' Pets');
        }
    }
    else{
        $('#txtguests').val(Math.abs(Number(nc_d) + Number(nc_i) + Number(n_child)) + ' Guests');
    }
   
    $('.total-children').html(n_child);
});


$(document).on('click', '.hero-block .btn-minus-c', function() {
    //alert('it works!');
    var n_child = $('#txtchildren').val();
    var total_pet_c = $('#txtpets').val();
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
        console.log(total_guest_type_nc_m);
        if(total_pet_c != 0){
            if(total_pet_c == 1 ){
                $('#txtguests').val(--total_guest_type_nc_m + ' Guests' + ', ' + total_pet_c + ' Pet');
            }else{
                $('#txtguests').val(--total_guest_type_nc_m + ' Guests' + ', ' + total_pet_c + ' Pets');
            }
            
        }else{
            $('#txtguests').val(--total_guest_type_nc_m + ' Guests');
        }
        
        $('.total-children').html(n_child);
      } else {
          $('.btn-minus-c').css("opacity","0.5");
        //Otherwise do nothing
      }
});

$(document).on('click', '.hero-block .btn-plus-infant', function() {
    //alert('it works!');
    var n_infant = $('#txtinfants').val();
    var total_pet_i = $('#txtpets').val();
    //console.log(++n);
    $('#txtinfants').val(++n_infant);
    var nf_d = $('#txtadults').val();
    var nf_c = $('#txtchildren').val();
    
    if(n_infant > 0){
        $('.btn-minus-infant').css("opacity","1");
    }
    if(total_pet_i != 0){
        if (total_pet_i == 1){
            $('#txtguests').val(Math.abs(Number(nf_d) + Number(nf_c) + Number(n_infant)) + ' Guests' + ', ' + total_pet_i + ' Pet');
        }else{
            $('#txtguests').val(Math.abs(Number(nf_d) + Number(nf_c) + Number(n_infant)) + ' Guests' + ', ' + total_pet_i + ' Pets');
        }
        
    }
    else{
        $('#txtguests').val(Math.abs(Number(nf_d) + Number(nf_c) + Number(n_infant)) + ' Guests');
    }
    
    $('.total-infant').html(n_infant);
});


$(document).on('click', '.hero-block .btn-minus-infant', function() {
    //alert('it works!');
    var n_infant = $('#txtinfants').val();
    var total_pet_i = $('#txtpets').val();
    //console.log(--n);
    if((n_infant-1) == 0){
        $('.btn-minus-infant').css("opacity","0.5");
    }else{
        $('.btn-minus-infant').css("opacity","1");
    }
    if (n_infant > 0) {
        
        $('#txtinfants').val(--n_infant);
        //$('#txtguests').val(n);
        var nf_g = $('#txtguests').val();
        var split_guest_nf_g = nf_g.slice(0,2);
        var total_guest_type_nf_g = Number(split_guest_nf_g);
        if(total_pet_i != 0){
            if (total_pet_i == 1){
                $('#txtguests').val(--total_guest_type_nf_g + ' Guests' + ', ' + total_pet_i + ' Pet');
            }else{
                $('#txtguests').val(--total_guest_type_nf_g + ' Guests' + ', ' + total_pet_i + ' Pets');
            }
            
        }
        else{
            $('#txtguests').val(--total_guest_type_nf_g + ' Guests');
        }

        $('.total-infant').html(n_infant);
      } else {
        //Otherwise do nothing
        $('.btn-minus-infant').css("opacity","0.5");
      }
});

$(document).on('click', '.hero-block .btn-plus-pet', function() {
    //alert('it works!');
    var n_pet = $('#txtpets').val();
    var n_infant = $('#txtinfants').val();
    var nf_c = $('#txtchildren').val();
    //console.log(++n);
    $('#txtpets').val(++n_pet);
    var np_d = $('#txtadults').val();
    // var nf_c = $('#txtchildren').val();
    if(n_pet > 0){
        $('.btn-minus-pet').css("opacity","1");
    }
    var nf_pet = $('#txtguests').val();
    var split_guest_pet = nf_pet.slice(0,2);
    var total_guest_type_pet = Number(split_guest_pet);
    if(Number(n_pet) == 1){
        if(np_d == 2 & n_infant == "" & nf_c == ""){
            $('#txtguests').val(np_d + " Guests" + ', ' + n_pet + ' Pet');
        }else{
            $('#txtguests').val(total_guest_type_pet + " Guests" + ', ' + n_pet + ' Pet');
        }
        
    }else{
        $('#txtguests').val(total_guest_type_pet + " Guests" + ', ' + n_pet + ' Pets');
    }
    
    $('.total-pet').html(n_pet);
});


$(document).on('click', '.hero-block .btn-minus-pet', function() {
    //alert('it works!');
    var n_pet = $('#txtpets').val();
    //console.log(--n);
    if((n_pet-1) == 0){
        $('.btn-minus-pet').css("opacity","0.5");
    }else{
        $('.btn-minus-pet').css("opacity","1");
    }
    if (n_pet > 0) {
        
        $('#txtpets').val(--n_pet);
        
        //$('#txtguests').val(n);
        // var nf_g = $('#txtguests').val();
        // $('#txtguests').val(--nf_g);
        var nf_pet_m = $('#txtguests').val();
        var split_guest_pet_m = nf_pet_m.slice(0,2);
        var total_guest_type_pet_m = Number(split_guest_pet_m);
        if(Number(n_pet) != 0){
            if(Number(n_pet) == 1){
                $('#txtguests').val(total_guest_type_pet_m + " Guests" + ', ' + n_pet + ' Pet');
            }else{
                $('#txtguests').val(total_guest_type_pet_m + " Guests" + ', ' + n_pet + ' Pets');
            }
            
        }else{
            $('#txtguests').val(total_guest_type_pet_m + " Guests");
        }
        
        $('.total-pet').html(n_pet);
      } else {
         $('.btn-minus-pet').css("opacity","0.5");
        //Otherwise do nothing
      }
});

function toggleSearch() {
  $('.search-bar').slideToggle("fast");
  $(".opacity-search-bar-nav-bg").css({"display":"block", "width":"100%"});
  $('.search-bar-main').slideToggle("fast");
  $("[rel=comments]").not(this).popover('hide');
}


/* Set the width of the side navigation to 250px */
function openNav() {
  document.getElementById("mySidenav").style.width = "387px";
  $(".body_main_side_tab").css({"display":"block", "width":"100%"});
  var x = screen.width;
  if(x <= 576){
    document.getElementById("mySidenav").style.width = "90%";
  }
  
}

/* Set the width of the side navigation to 0 */
function closeNav() {
  document.getElementById("mySidenav").style.width = "0";
  $(".body_main_side_tab").css("display","none");
}

// Detect Scroll
$(window).scroll(function () {
  $(document).scrollTop() > 10 ? $(".nav-bg").addClass("bgHeader") : $(".nav-bg").removeClass("bgHeader");
  //$(document).scrollTop() > 2 ? $('.search-bar').hide() : $('.search-bar').show();
  console.log('scroll');
});

// Pop-up on info icon
/*$(function () {
  $('.btn-popup').popover({
    trigger: 'hover',
    container: 'body',
    placement:'top',
    html: true
  })
})

$(function () {
  $('.fa-exclamation-circle').popover({
    trigger: 'hover',
    container: 'body',
    placement:'top',
    html: true
  })
})*/

// Pop-up on guest textbox
/*$(function () {
  $('.txtguests').popover({
    container: '.nav-bg, .nav-bg-fix',
    placement:'bottom',
    html: true
  })
})*/

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
  nav: true,
  autoplayTimeout: 10000
});


/*$(function() {
  $('input[name="txtcal"]').daterangepicker({
    opens: 'left'
  }, function(start, end, label) {
    console.log("A new date selection was made: " + start.format('YYYY-MM-DD') + ' to ' + end.format('YYYY-MM-DD'));
  });
});*/

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
                    $(".drp-buttons").html('<div style="font-family: Open Sans; font-style: normal; font-weight: 600; font-size: 14px; line-height: 19px; position: relative; left: -57px; top: 5px; color: #323A45;">'+ picker.startDate.format('ddd DD MMM YYYY') +' - '+picker.endDate.format('ddd DD MMM YYYY') +'<span style="opacity: 0.5;"> ('+ diff_days +' night)</span></div>');
                }else{
                    $(".drp-buttons").html('<div style="font-family: Open Sans; font-style: normal; font-weight: 600; font-size: 14px; line-height: 19px; position: relative; left: -57px; top: 5px; color: #323A45;">'+ picker.startDate.format('ddd DD MMM YYYY') +' - '+picker.endDate.format('ddd DD MMM YYYY') +'<span style="opacity: 0.5;"> ('+ diff_days +' nights)</span></div>');
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
                    $(".drp-buttons").html('<div style="font-family: Open Sans; font-style: normal; font-weight: 600; font-size: 14px; line-height: 19px; position: relative; left: -57px; top: 5px; color: #323A45;">'+ picker.startDate.format('ddd DD MMM YYYY') +' - '+picker.endDate.format('ddd DD MMM YYYY') +'<span style="opacity: 0.5;"> ('+ diff_days +' night)</span></div>');
                }else{
                    $(".drp-buttons").html('<div style="font-family: Open Sans; font-style: normal; font-weight: 600; font-size: 14px; line-height: 19px; position: relative; left: -57px; top: 5px; color: #323A45;">'+ picker.startDate.format('ddd DD MMM YYYY') +' - '+picker.endDate.format('ddd DD MMM YYYY') +'<span style="opacity: 0.5;"> ('+ diff_days +' nights)</span></div>');
                }     
    });

  $('input[name="txtcal-search-block"]').on('apply.daterangepicker', function(ev, picker) {
      $(this).val(picker.startDate.format('DD/MM/YYYY') + ' - ' + picker.endDate.format('DD/MM/YYYY'));
  });

  $('input[name="txtcal-search-block"]').on('cancel.daterangepicker', function(ev, picker) {
      $(this).val('');
  });

});


// $(function() {
//   //var j = jQuery; //Just a variable for using jQuery without conflicts
//   var addInput = '#txtguests'; //This is the id of the input you are changing
//   var n = 2; //n is equal to 1
  
//   //Set default value to n (n = 1)
//   $('#txtguests').val(n);

//   //On click add 1 to n
//   $('.btn-plus').on('click', function(){
//     //$(addInput).val(++n);
//     console.log(n);
//   });

//   $('.btn-minus').on('click', function(){
//     //If n is bigger or equal to 1 subtract 1 from n
//     if (n > 1) {
//       $('#txtguests').val(--n);
//     } else {
//       //Otherwise do nothing
//     }
//   });
// });


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


$(document).on('click', '.btn-plus-beds', function() {
    var n = $('#txtbeds').val();
    $('#txtbeds').val(++n);
    $('.total-beds').html(n);
});


$(document).on('click', '.btn-minus-beds', function() {
    var n = $('#txtbeds').val();
    if (n > 1) {
        $('#txtbeds').val(--n);
        $('.total-beds').html(n)
      } else {
        //Otherwise do nothing
      }
});

$(document).on('click', '.btn-plus-bedrooms', function() {
    var n = $('#txtbedrooms').val();
    $('#txtbedrooms').val(++n);
    $('.total-bedrooms').html(n);
});


$(document).on('click', '.btn-minus-bedrooms', function() {
    var n = $('#txtbedrooms').val();
    if (n > 1) {
        $('#txtbedrooms').val(--n);
        $('.total-bedrooms').html(n)
      } else {
        //Otherwise do nothing
      }
});

$(document).on('click', '.btn-plus-bathrooms', function() {
    var n = $('#txtbathrooms').val();
    $('#txtbathrooms').val(++n);
    $('.total-bathrooms').html(n);
});


$(document).on('click', '.btn-minus-bathrooms', function() {
    var n = $('#txtbathrooms').val();
    if (n > 1) {
        $('#txtbathrooms').val(--n);
        $('.total-bathrooms').html(n)
      } else {
        //Otherwise do nothing
      }
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
        $('#search-localtion').removeClass('display-none')
        $('#search-results').addClass('display-none') 
    }
});
$(document).on('click', '#btn-menu', function() {
    if (!$('#search-localtion').hasClass('display-none')) {
        $('#search-localtion').addClass('display-none')
        $('#search-results').removeClass('display-none') 
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

    // get value in location search nav-bg-fix
    $(document).on('click', '#location-list #li_a1', function(){
          $("#txtsearch").val($(this).text());
          var data_search_val =  $("#txtsearch").val();
          
          if(data_search_val != ""){
            $(".popover").hide();
            $('input[name="txtcal-search-block"]').focus();
            
          }
    });
  
    $(document).on('click', '#location-list #li_a2', function(){
          $("#txtsearch").val($(this).text());
          var data_search_val =  $("#txtsearch").val();
          
          if(data_search_val != ""){
            $(".popover").hide();
            $('input[name="txtcal-search-block"]').focus();
           
          }
    });
     $(document).on('click', '#location-list #li_a3', function(){
          $("#txtsearch").val($(this).text());
          var data_search_val =  $("#txtsearch").val();
          
          if(data_search_val != ""){
            $(".popover").hide();
            $('input[name="txtcal-search-block"]').focus();
            
          }
    });
     $(document).on('click', '#location-list #li_a4', function(){
          $("#txtsearch").val($(this).text());
          var data_search_val =  $("#txtsearch").val();
          
          if(data_search_val != ""){
            $(".popover").hide();
            $('input[name="txtcal-search-block"]').focus();
           
          }
    });
     $(document).on('click', '#location-list #li_a5', function(){
          $("#txtsearch").val($(this).text());
          var data_search_val =  $("#txtsearch").val();
          
          if(data_search_val != ""){
            $(".popover").hide();
            $('input[name="txtcal-search-block"]').focus();
           
          }
    });
     $(document).on('click', '#location-list #li_a6', function(){
          $("#txtsearch").val($(this).text());
          var data_search_val =  $("#txtsearch").val();
          
          if(data_search_val != ""){
            $(".popover").hide();
            $('input[name="txtcal-search-block"]').focus();
           
          }
    });
     $(document).on('click', '#location-list #li_a7', function(){
          $("#txtsearch").val($(this).text());
          var data_search_val =  $("#txtsearch").val();
          
          if(data_search_val != ""){
            $(".popover").hide();
            $('input[name="txtcal-search-block"]').focus();
           
            
          }
    });
     $(document).on('click', '#location-list #li_a8', function(){
          $("#txtsearch").val($(this).text());
          var data_search_val =  $("#txtsearch").val();
          
          if(data_search_val != ""){
            $(".popover").hide();
            $('input[name="txtcal-search-block"]').focus();
           
          }
    });
     $(document).on('click', '#location-list #li_a9', function(){
          $("#txtsearch").val($(this).text());
          var data_search_val =  $("#txtsearch").val();
          
          if(data_search_val != ""){
            $(".popover").hide();
            $('input[name="txtcal-search-block"]').focus();
          
          }
    });
    $(document).on('click', '#location-list #li_a10', function(){
          $("#txtsearch").val($(this).text());
          var data_search_val =  $("#txtsearch").val();
          
          if(data_search_val != ""){
            $(".popover").hide();
            $('input[name="txtcal-search-block"]').focus();
            
          }
    });
     $(document).on('click', '#location-list #li_a11', function(){
          $("#txtsearch").val($(this).text());
          var data_search_val =  $("#txtsearch").val();
          
          if(data_search_val != ""){
            $(".popover").hide();
            $('input[name="txtcal-search-block"]').focus();
           
          }
    });
     $(document).on('click', '#location-list #li_a12', function(){
          $("#txtsearch").val($(this).text());
          var data_search_val =  $("#txtsearch").val();
          
          if(data_search_val != ""){
            $(".popover").hide();
            $('input[name="txtcal-search-block"]').focus();
           
          }
    });
    
     $(document).on('click', '#location-list #li_a13', function(){
          $("#txtsearch").val($(this).text());
          var data_search_val =  $("#txtsearch").val();
          
          if(data_search_val != ""){
            $(".popover").hide();
            $('input[name="txtcal-search-block"]').focus();
           
          }
    });
     $(document).on('click', '#location-list #li_a14', function(){
          $("#txtsearch").val($(this).text());
          var data_search_val =  $("#txtsearch").val();
          
          if(data_search_val != ""){
            $(".popover").hide();
            $('input[name="txtcal-search-block"]').focus();
           
          }
    });

//get value location search nav bg

$(document).on('click', '.nav-bg #location-list #li_a1', function(){
          $("#txtsearch").val($(this).text());
          var data_search_sub_val =  $("#txtsearch").val();
          
          if(data_search_sub_val != ""){
            
            $(".popover").hide();
            $('input[name="txtcal-search-block"]').focus();
           
          }
    });
    $(document).on('click', '.nav-bg #location-list #li_a2', function(){
          $("#txtsearch").val($(this).text());
          var data_search_sub_val =  $("#txtsearch").val();
          
          if(data_search_sub_val != ""){
            $(".popover").hide();
            $('input[name="txtcal-search-block"]').focus();
           
          }
    });
    $(document).on('click', '.nav-bg #location-list #li_a3', function(){
          $("#txtsearch").val($(this).text());
          var data_search_sub_val =  $("#txtsearch").val();
          
          if(data_search_sub_val != ""){
            $(".popover").hide();
            $('input[name="txtcal-search-block"]').focus();
           
          }
    });
    $(document).on('click', '.nav-bg #location-list #li_a4', function(){
          $("#txtsearch").val($(this).text());
          var data_search_sub_val =  $("#txtsearch").val();
          
          if(data_search_sub_val != ""){
            $(".popover").hide();
            $('input[name="txtcal-search-block"]').focus();
           
          }
    });
    $(document).on('click', '.nav-bg #location-list #li_a5', function(){
          $("#txtsearch").val($(this).text());
          var data_search_sub_val =  $("#txtsearch").val();
          
          if(data_search_sub_val != ""){
            $(".popover").hide();
            $('input[name="txtcal-search-block"]').focus();
           
          }
    });
    $(document).on('click', '.nav-bg #location-list #li_a6', function(){
          $("#txtsearch").val($(this).text());
          var data_search_sub_val =  $("#txtsearch").val();
          
          if(data_search_sub_val != ""){
            $(".popover").hide();
            $('input[name="txtcal-search-block"]').focus();
          
          }
    });
    $(document).on('click', '.nav-bg #location-list #li_a7', function(){
          $("#txtsearch").val($(this).text());
          var data_search_sub_val =  $("#txtsearch").val();
          
          if(data_search_sub_val != ""){
            $(".popover").hide();
            $('input[name="txtcal-search-block"]').focus();
          
          }
    });
    $(document).on('click', '.nav-bg #location-list #li_a8', function(){
          $("#txtsearch").val($(this).text());
          var data_search_sub_val =  $("#txtsearch").val();
          
          if(data_search_sub_val != ""){
            $(".popover").hide();
            $('input[name="txtcal-search-block"]').focus();
           
          }
    });
    $(document).on('click', '.nav-bg #location-list #li_a9', function(){
          $("#txtsearch").val($(this).text());
          var data_search_sub_val =  $("#txtsearch").val();
          
          if(data_search_sub_val != ""){
            $(".popover").hide();
            $('input[name="txtcal-search-block"]').focus();
           
          }
    });
    $(document).on('click', '.nav-bg #location-list #li_a10', function(){
          $("#txtsearch").val($(this).text());
          var data_search_sub_val =  $("#txtsearch").val();
          
          if(data_search_sub_val != ""){
            $(".popover").hide();
            $('input[name="txtcal-search-block"]').focus();
           
          }
    });
    $(document).on('click', '.nav-bg #location-list #li_a11', function(){
          $("#txtsearch").val($(this).text());
          var data_search_sub_val =  $("#txtsearch").val();
          
          if(data_search_sub_val != ""){
            $(".popover").hide();
            $('input[name="txtcal-search-block"]').focus();
           
          }
    });
    $(document).on('click', '.nav-bg #location-list #li_a12', function(){
          $("#txtsearch").val($(this).text());
          var data_search_sub_val =  $("#txtsearch").val();
          
          if(data_search_sub_val != ""){
            $(".popover").hide();
            $('input[name="txtcal-search-block"]').focus();
            
          }
    });
    $(document).on('click', '.nav-bg #location-list #li_a13', function(){
          $("#txtsearch").val($(this).text());
          var data_search_sub_val =  $("#txtsearch").val();
          
          if(data_search_sub_val != ""){
            $(".popover").hide();
            $('input[name="txtcal-search-block"]').focus();
           
          }
    });
    $(document).on('click', '.nav-bg #location-list #li_a14', function(){
          $("#txtsearch").val($(this).text());
          var data_search_sub_val =  $("#txtsearch").val();
          
          if(data_search_sub_val != ""){
            $(".popover").hide();
            $('input[name="txtcal-search-block"]').focus();
            
          }
    });

//get value location search hero block
$(document).on('click', '.hero-block #location-list #li_a1', function(){
          $(".txtsearch").val($(this).text());
          var data_search_val =  $(".txtsearch").val();
          
          if(data_search_val != ""){
            $(".popover").hide();
            $('input[name="txtcal"]').focus();
          
          }
    });
  
    $(document).on('click', '.hero-block #location-list #li_a2', function(){
          $(".txtsearch").val($(this).text());
          var data_search_val =  $(".txtsearch").val();
          
          if(data_search_val != ""){
            $(".popover").hide();
            $('input[name="txtcal"]').focus();
           
          }
    });
     $(document).on('click', '.hero-block #location-list #li_a3', function(){
          $(".txtsearch").val($(this).text());
          var data_search_val =  $(".txtsearch").val();
          
          if(data_search_val != ""){
            $(".popover").hide();
            $('input[name="txtcal"]').focus();
          
          }
    });
     $(document).on('click', '.hero-block #location-list #li_a4', function(){
          $(".txtsearch").val($(this).text());
          var data_search_val =  $(".txtsearch").val();
          
          if(data_search_val != ""){
            $(".popover").hide();
            $('input[name="txtcal"]').focus();
           
          }
    });
     $(document).on('click', '.hero-block #location-list #li_a5', function(){
          $(".txtsearch").val($(this).text());
          var data_search_val =  $(".txtsearch").val();
          
          if(data_search_val != ""){
            $(".popover").hide();
            $('input[name="txtcal"]').focus();
           
          }
    });
     $(document).on('click', '.hero-block #location-list #li_a6', function(){
          $(".txtsearch").val($(this).text());
          var data_search_val =  $(".txtsearch").val();
          
          if(data_search_val != ""){
            $(".popover").hide();
            $('input[name="txtcal"]').focus();
           
          }
    });
     $(document).on('click', '.hero-block #location-list #li_a7', function(){
          $(".txtsearch").val($(this).text());
          var data_search_val =  $(".txtsearch").val();
          
          if(data_search_val != ""){
            $(".popover").hide();
            $('input[name="txtcal"]').focus();
           
          }
    });
     $(document).on('click', '.hero-block #location-list #li_a8', function(){
          $(".txtsearch").val($(this).text());
          var data_search_val =  $(".txtsearch").val();
          
          if(data_search_val != ""){
            $(".popover").hide();
            $('input[name="txtcal"]').focus();
           
          }
    });
     $(document).on('click', '.hero-block #location-list #li_a9', function(){
          $(".txtsearch").val($(this).text());
          var data_search_val =  $(".txtsearch").val();
          
          if(data_search_val != ""){
            $(".popover").hide();
            $('input[name="txtcal"]').focus();
          
          }
    });
    $(document).on('click', '.hero-block #location-list #li_a10', function(){
          $(".txtsearch").val($(this).text());
          var data_search_val =  $(".txtsearch").val();
          
          if(data_search_val != ""){
            $(".popover").hide();
            $('input[name="txtcal"]').focus();
           
          }
    });
     $(document).on('click', '.hero-block #location-list #li_a11', function(){
          $(".txtsearch").val($(this).text());
          var data_search_val =  $(".txtsearch").val();
          
          if(data_search_val != ""){
            $(".popover").hide();
            $('input[name="txtcal"]').focus();
           
          }
    });
     $(document).on('click', '.hero-block #location-list #li_a12', function(){
          $(".txtsearch").val($(this).text());
          var data_search_val =  $(".txtsearch").val();
          
          if(data_search_val != ""){
            $(".popover").hide();
            $('input[name="txtcal"]').focus();
          
          }
    });
    $(document).on('click', '.hero-block #location-list #li_a13', function(){
          $(".txtsearch").val($(this).text());
          var data_search_val =  $(".txtsearch").val();
          
          if(data_search_val != ""){
            $(".popover").hide();
            $('input[name="txtcal"]').focus();
          
          }
    });
    $(document).on('click', '.hero-block #location-list #li_a14', function(){
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
