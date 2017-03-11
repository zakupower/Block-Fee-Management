/* Responsive Menu */
$('#dl-menu').dlmenu({
    animationClasses: {
        classin: 'dl-animate-in-5',
        classout: 'dl-animate-out-5'
    }
});
/* Responsive Menu */

/* Flex Slider (Testimonial Customers) */
jQuery('.testi-slider.flexslider').flexslider({
    animation: "fade",
    slideshow: true,
    slideshowSpeed: 5000,
});
jQuery('.next-slider').click(function () {
    jQuery('.flexslider.pf-carousel').flexslider("next");
});
jQuery('.prev-slider').click(function () {
    jQuery('.flexslider.pf-carousel').flexslider("prev");
});
/* Flex Slider (Testimonial Customers) */

/* Search */
$(document).ready(function () {
    jQuery('#search-btn').click(function () {
        if ($("#search-input").is(":hidden")) {
            $("#search-btn").addClass("search-active");
            $("#search-input").fadeIn(100);
            $("#s-input").focus();
        } else {
            $("#search-btn").removeClass("search-active");
            $("#search-input").fadeOut(100);
        }
        return false;
    });
});
/* Search */

/* Tabs */
jQuery('.shortcode_tabs').each(function (index) {
    var i = 1;
    jQuery('.shortcode_tab_item_title').each(function (
        index) {
        jQuery(this).addClass('it' + i);
        jQuery(this).attr('whatopen', 'body' + i);
        jQuery(this).addClass('head' + i);
        jQuery(this).parents('.shortcode_tabs').find(
            '.all_heads_cont').append(this);
        i++;
    });
    var i = 1;
    jQuery('.shortcode_tab_item_body').each(function (
        index) {
        jQuery(this).addClass('body' + i);
        jQuery(this).addClass('it' + i);
        jQuery(this).parents('.shortcode_tabs').find(
            '.all_body_cont').append(this);
        i++;
    });
});
jQuery('.shortcode_tabs .all_body_cont div:first-child')
    .addClass('active');
jQuery(
    '.shortcode_tabs .all_heads_cont div:first-child').addClass(
    'active');

jQuery('.shortcode_tab_item_title').click(function () {
    jQuery(this).parents('.shortcode_tabs').find(
        '.shortcode_tab_item_body').removeClass('active');
    jQuery(this).parents('.shortcode_tabs').find(
        '.shortcode_tab_item_title').removeClass('active');
    var whatopen = jQuery(this).attr('data-open');
    jQuery(this).parents('.shortcode_tabs').find('.' +
        whatopen).addClass('active');
    jQuery(this).addClass('active');
});
/* Tabs */

/* Tooltip  */
jQuery(function ($) {
    $('.tooltip_s').tooltip()
});
/* Tooltip  */

/* Animation */
$(window).scroll(function () {
    $(".animated-area").each(function () {
        if ($(window).height() + $(window).scrollTop() -
            $(this).offset().top > 0) {
            $(this).trigger("animate-it");
        }
    });
});
$(".animated-area").on("animate-it", function () {
    var cf = $(this);
    cf.find(".animated").each(function () {
        $(this).css("-webkit-animation-duration",
            "0.9s");
        $(this).css("-moz-animation-duration", "0.9s");
        $(this).css("-ms-animation-duration", "0.9s");
        $(this).css("animation-duration", "0.9s");
        $(this).css("-webkit-animation-delay", $(this).attr(
            "data-animation-delay"));
        $(this).css("-moz-animation-delay", $(this).attr(
            "data-animation-delay"));
        $(this).css("-ms-animation-delay", $(this).attr(
            "data-animation-delay"));
        $(this).css("animation-delay", $(this).attr(
            "data-animation-delay"));
        $(this).addClass($(this).attr("data-animation"));
    });
});
/* Animation */

/* Testimonials */
$(window).load(function(){
    $("#tr1").testimonialrotator({
        settings_slideshowTime:3
    });
});
/* Testimonials */














