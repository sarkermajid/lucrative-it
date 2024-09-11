// Sidebar and Header menu
$(document).on("click","nav.side-menu a.close",function(){
	$("nav.side-menu").removeClass("go-visible");
	$("nav.side-menu").addClass("go-left");
	$(".mobile-menu-left-overlay").fadeOut();
});
$(document).on("click",".mobile-menu-left-overlay",function(){
	$("nav.side-menu").removeClass("go-visible");
	$("nav.side-menu").addClass("go-left");
	$(this).fadeOut();
});
$(document).on("click",".navbar-option .navbar-toggle",function(){
	$("nav.side-menu").addClass("go-visible");
	$(".mobile-menu-left-overlay").fadeIn();
});

// Disappear the div when clicking outside of targeted area
$(document).mouseup(function (e)
{
    var container = $(".navbar-header ul");
    if (!container.is(e.target) // if the target of the click isn't the container...
        && container.has(e.target).length === 0) // ... nor a descendant of the container
    {
        $(".navbar-header").removeClass("go-visible dropdown-menu");
        $(".fly-menu a.fly-closer").removeClass('active');
        $(".fly-menu a.fly-opener").removeClass('not-active');
        $(".fly-menu a.fly-closer").addClass('not-active');
        $(".fly-menu a.fly-opener").addClass('active');
    }
});
$(document).on("click",".fly-menu a.fly-opener",function(){
	$(".navbar-header").addClass("go-visible dropdown-menu");
	$(this).removeClass('active');
	$(this).addClass('not-active');
	$('.fly-closer').addClass('active');
	$('.fly-closer').removeClass('not-active');
});
$(document).on("click",".fly-menu a.fly-closer",function(){
	$(".navbar-header.go-visible").removeClass("go-visible dropdown-menu");
	$(this).removeClass('active');
	$(this).addClass('not-active');
	$('.fly-opener').addClass('active');
	$('.fly-opener').removeClass('not-active');
});


$(document).on("click",".dropdown.notification-icon a",function(){
  $(this).parents('.notification-icon').find('.bubble').addClass('hidden');
});

$(document).ready(function() {
                   $('.resume-panel-group').on('shown.bs.collapse', function () {
                 var panel = $(this).find('.in');
                 
                 $('html, body').animate({
                       scrollTop: panel.offset().top -80
                 }, 800);
               });
            });