jQuery(document).ready(function($){

  // replase mobile catchphrase and description
  $('.has_mobile_word').each(function() {
    var mobile_word =  $(this).data("label");
    $(this).append('<span class="mobile">' + mobile_word + '</span>');
  });

  // mega menu campaign list animation
  $('.megamenu_campaign_list .menu_area a').hover(function() {
    $(this).parent().siblings().removeClass('active')
    $(this).parent().addClass('active');
    var $content_id = "." + $(this).attr('class');
    $(".megamenu_campaign_list .post_list").hide();
    $($content_id).show();
    return false;
  });


  // mega menu basic animation
  $('[data-megamenu]').each(function() {

    var mega_menu_button = $(this);
    var sub_menu_wrap =  "#" + $(this).data("megamenu");
    var hide_sub_menu_timer;
    var hide_sub_menu_interval = function() {
      if (hide_sub_menu_timer) {
        clearInterval(hide_sub_menu_timer);
        hide_sub_menu_timer = null;
      }
      hide_sub_menu_timer = setInterval(function() {
        if (!$(mega_menu_button).is(':hover') && !$(sub_menu_wrap).is(':hover')) {
          $(sub_menu_wrap).stop().css('z-index','100').hide();
          clearInterval(hide_sub_menu_timer);
          hide_sub_menu_timer = null;
        }
      }, 20);
    };

    mega_menu_button.hover(
     function(){
       if (hide_sub_menu_timer) {
         clearInterval(hide_sub_menu_timer);
         hide_sub_menu_timer = null;
       }
       if ($('html').hasClass('pc')) {
         $(this).parent().addClass('active_button');
         $(this).parent().find("ul").addClass('megamenu_child_menu');
         $(sub_menu_wrap).stop().css('z-index','200').show();
       }
     },
     function(){
       if ($('html').hasClass('pc')) {
         $(this).parent().removeClass('active_button');
         $(this).parent().find("ul").removeClass('megamenu_child_menu');
         hide_sub_menu_interval();
       }
     }
    );

    $(sub_menu_wrap).hover(
     function(){
      $(mega_menu_button).parent().addClass('active_button');
     },
     function(){
      $(mega_menu_button).parent().removeClass('active_button');
     }
    );


    $('#header').on('mouseout', sub_menu_wrap, function(){
     if ($('html').hasClass('pc')) {
       hide_sub_menu_interval();
     }
    });

  }); // end mega menu

  $("a").bind("focus",function(){if(this.blur)this.blur();});
  $("a.target_blank").attr("target","_blank");

  //return top button
  var return_top_button = $('#return_top');
  $('a',return_top_button).click(function() {
    var myHref= $(this).attr("href");
    var myPos = $(myHref).offset().top;
    $("html,body").animate({scrollTop : myPos}, 1000, 'easeOutExpo');
    return false;
  });
  return_top_button.removeClass('active');
  var footer_button = $('#footer_button');
  $(window).scroll(function () {
    if ($(this).scrollTop() > 100) {
      if( footer_button.length ) {
        footer_button.addClass('active');
      }
      return_top_button.addClass('active');
    } else {
      if( footer_button.length ) {
        footer_button.removeClass('active');
      }
      return_top_button.removeClass('active');
    }
  });

  //fixed footer content
  var fixedFooter = $('#fixed_footer_content');
  fixedFooter.removeClass('active');
  $(window).scroll(function () {
    if ($(this).scrollTop() > 330) {
      fixedFooter.addClass('active');
    } else {
      fixedFooter.removeClass('active');
    }
  });
  $('#fixed_footer_content .close').click(function() {
    $("#fixed_footer_content").hide();
    return false;
  });

  //category widget
  $(".tcd_category_list li:has(ul)").addClass('parent_menu');
  $(".tcd_category_list li.parent_menu > a").parent().prepend("<span class='child_menu_button'></span>");
  $(".tcd_category_list li .child_menu_button").on('click',function() {
     if($(this).parent().hasClass("open")) {
       $(this).parent().removeClass("active");
       $(this).parent().removeClass("open");
       $(this).parent().find('>ul:not(:animated)').slideUp("fast");
       return false;
     } else {
       $(this).parent().addClass("active");
       $(this).parent().addClass("open");
       $(this).parent().find('>ul:not(:animated)').slideDown("fast");
       return false;
     };
  });

  //custom drop menu widget
  $(".tcdw_custom_drop_menu li:has(ul)").addClass('parent_menu');
  $(".tcdw_custom_drop_menu li").hover(function(){
     $(">ul:not(:animated)",this).slideDown("fast");
     $(this).addClass("active");
  }, function(){
     $(">ul",this).slideUp("fast");
     $(this).removeClass("active");
  });

  //archive list widget
  if ($('.p-dropdown').length) {
    $('.p-dropdown__title').click(function() {
      $(this).toggleClass('is-active');
      $('+ .p-dropdown__list:not(:animated)', this).slideToggle();
    });
  }

  //search widget
  $('.widget_search #searchsubmit').wrap('<div class="submit_button"></div>');
  $('.google_search #searchsubmit').wrap('<div class="submit_button"></div>');

  // comment button
  $("#comment_tab li").click(function() {
    $("#comment_tab li").removeClass('active');
    $(this).addClass("active");
    $(".tab_contents").hide();
    var selected_tab = $(this).find("a").attr("href");
    $(selected_tab).fadeIn();
    return false;
  });


// responsive ------------------------------------------------------------------------
var mql = window.matchMedia('screen and (min-width: 1251px)');
function checkBreakPoint(mql) {

 if(mql.matches){ //PC

   $("html").removeClass("mobile");
   $("html").addClass("pc");

   if($("#mobile_menu #global_menu").length){
     $("#mobile_menu #global_menu").remove();
   }

   $("#menu_button").css("display","none");

   $("#global_menu").show();

   if($("#global_menu > ul").length){
     var parent_menu_pos = $("#global_menu > ul").offset();
   }else{
     var parent_menu_pos = 0;
   }
   parent_menu_position_length = parent_menu_pos.left + 1182;
   parent_menu_position_length2 = parent_menu_pos.left + 962;
   var child_menu_pos = '';
   var child_menu_position_length = '';

   $('a.megamenu_button').parent().addClass('megamenu_parent');

   $("#global_menu li:not(.megamenu_parent)").hover(function(){
     $(">ul:not(:animated)",this).slideDown("fast");
     $(this).addClass("active");
     child_menu_pos = $(">ul",this).offset();
     if(child_menu_pos) {
       child_menu_position_length = child_menu_pos.left + 220;
       if(child_menu_position_length > parent_menu_position_length){
         $(this).addClass("type2");
       }
       if(child_menu_position_length > parent_menu_position_length2){
         $('li.menu-item-has-children',this).addClass("type2");
       }
     }
   }, function(){
     $(">ul",this).slideUp("fast");
     $(this).removeClass("active");
   });

 } else { //smart phone

   $("html").removeClass("pc");
   $("html").addClass("mobile");

   $("#header").removeClass("animate");
   $("#header").removeClass("animate2");

   var global_menu = $('#global_menu');

   if(!$("#mobile_menu #global_menu").length){
     global_menu.clone().prependTo("#mobile_menu");
   }

   // perfect scroll
   if ($('#mobile_menu').length) {
     if(! $(body).hasClass('mobile_device') ) {
       const ps = new PerfectScrollbar('#mobile_menu', {
         wheelSpeed: 2,
         suppressScrollX: true
       });
     };
   };

   if (global_menu.css('display') == 'block') {
     global_menu.removeAttr('style');
   }
   if (global_menu.css('display') == 'block') {
     $("ul",global_menu).removeAttr('style');
   }
   global_menu.off('hover');

   $("#global_menu .child_menu_button").remove();
   $('#global_menu li > ul').parent().prepend("<span class='child_menu_button'><span class='icon'></span></span>");
   $("#global_menu .child_menu_button").on('click',function() {
     if($(this).parent().hasClass("open")) {
       $(this).parent().removeClass("open");
       $(this).parent().find('>ul:not(:animated)').slideUp("fast");
       return false;
     } else {
       $(this).parent().addClass("open");
       $(this).parent().find('>ul:not(:animated)').slideDown("fast");
       return false;
     };
   });

   var menu_button = $('#menu_button');

   menu_button.off();
   menu_button.removeAttr('style');
   menu_button.toggleClass("active",false);

  // open drawer menu
   menu_button.on('click', function(e) {

      e.preventDefault();
      e.stopPropagation();
      $('html').toggleClass('open_menu');

      // fix position for ios
      var topPosition = $(window).scrollTop();
      $('body').css({'position':'fixed','top': - topPosition});

      $('#container').one('click', function(e){
        if($('html').hasClass('open_menu')){
          $('html').removeClass('open_menu');

          // clear fix position for ios
          $('body').css({'position':'','top': ''});
          $(window).scrollTop(topPosition);

          return false;
        };
      });

   });

   // perfect scroll
   if ($('#archive_campaign_category_list').length) {
     if(! $(body).hasClass('mobile_device') ) {
       const ps = new PerfectScrollbar('#archive_campaign_category_list', {
         wheelSpeed: 2,
         suppressScrollY: true
       });
     };
   };

 };
};
mql.addListener(checkBreakPoint);
checkBreakPoint(mql);


});