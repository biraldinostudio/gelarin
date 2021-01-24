
(function($){
"use strict";

$('#side-menu').metisMenu();


//Loads the correct sidebar on window load,
//collapses the sidebar on window resize.
// Sets the min-height of #page-wrapper to window size
$(function() {
    $(window).bind("load resize", function() {
        var topOffset = 50;
        var width = (this.window.innerWidth > 0) ? this.window.innerWidth : this.screen.width;
        if (width < 768) {
            $('div.navbar-collapse').addClass('collapse');
            topOffset = 100; // 2-row-menu
        } else {
            $('div.navbar-collapse').removeClass('collapse');
        }

        var height = ((this.window.innerHeight > 0) ? this.window.innerHeight : this.screen.height) - 1;
        height = height - topOffset;
        if (height < 1) height = 1;
        if (height > topOffset) {
            $("#page-wrapper").css("min-height", (height) + "px");
        }
    });

    var url = window.location;
    // var element = $('ul.nav a').filter(function() {
    //     return this.href == url;
    // }).addClass('active').parent().parent().addClass('in').parent();
    var element = $('ul.nav a').filter(function() {
        return this.href == url;
    }).addClass('active').parent();

    while (true) {
        if (element.is('li')) {
            element = element.parent().addClass('in').parent();
        } else {
            break;
        }
    }
	
	// Menu Toggle
		$("#menu-toggle").on('click', function(e) {
		e.preventDefault();
		$("#wrapper").toggleClass("active");

	});
	
	// Right Sidebar Toggle
	$("#right-sidebar-toggle").on('click', function(e) {
		e.preventDefault();
		$("#sidebar-wrapper").toggleClass("active");
	});
	
	// Right SidebarClose
	$("#right-close-sidebar-toggle").on('click', function(e) {
		e.preventDefault();
		$("#sidebar-wrapper").removeClass("active");
	});
	  
	//Side Scroll
	$(function(){
		$('#side-scroll').slimScroll({
			height: '100%'
		});
	});
		
	// Scroll Box
	$(function(){
		$('#scroll-box').slimScroll({
			height: '300px'
		});
	});
		
	//Loader
	$(".fakeLoader").fakeLoader({
		timeToHide:1200,
		bgColor:"#0f66e8",
		spinner:"spinner2"
	});
	
	// Date picker
	$(function() {
      $('[data-toggle="datepicker"]').datepicker({
        autoHide: true,
        zIndex: 2048,
      });
    });
	
	// About Company
	ClassicEditor
	.create( document.querySelector( '#about-company' ) )
	.catch( error => {
		console.error( error );
	} );
	
	// Career
	ClassicEditor
	.create( document.querySelector( '#career' ) )
	.catch( error => {
		console.error( error );
	} );
	
	// Resume Text
	ClassicEditor
	.create( document.querySelector( '#resume-text' ) )
	.catch( error => {
		console.error( error );
	} );
		
		
	$('[data-toggle="tooltip"]').tooltip();
			
	/*-----Add field Script------*/
	$('.extra-field-box').each(function() {
	var $wrapp = $('.multi-box', this);
	$(".add-field", $(this)).on('click', function() {
		$('.dublicat-box:first-child', $wrapp).clone(true).appendTo($wrapp).find('input').val('').focus();
	});
	$('.dublicat-box .remove-field', $wrapp).on('click', function() {
		if ($('.dublicat-box', $wrapp).length > 1)
			$(this).parent('.dublicat-box').remove();
		});
	});
	
	// Chantting Js
	$(".messages").animate({ scrollTop: $(document).height() }, "fast");

		$("#profile-img").click(function() {
			$("#status-options").toggleClass("active");
		});

		$(".expand-button").click(function() {
		  $("#profile").toggleClass("expanded");
			$("#contacts").toggleClass("expanded");
		});

		$("#status-options ul li").click(function() {
			$("#profile-img").removeClass();
			$("#status-online").removeClass("active");
			$("#status-away").removeClass("active");
			$("#status-busy").removeClass("active");
			$("#status-offline").removeClass("active");
			$(this).addClass("active");
			
			if($("#status-online").hasClass("active")) {
				$("#profile-img").addClass("online");
			} else if ($("#status-away").hasClass("active")) {
				$("#profile-img").addClass("away");
			} else if ($("#status-busy").hasClass("active")) {
				$("#profile-img").addClass("busy");
			} else if ($("#status-offline").hasClass("active")) {
				$("#profile-img").addClass("offline");
			} else {
				$("#profile-img").removeClass();
			};
			
			$("#status-options").removeClass("active");
		});

		function newMessage() {
			message = $(".message-input input").val();
			if($.trim(message) == '') {
				return false;
			}
			$('<li class="sent"><img src="http://emilcarlsson.se/assets/mikeross.png" alt="" /><p>' + message + '</p></li>').appendTo($('.messages ul'));
			$('.message-input input').val(null);
			$('.contact.active .preview').html('<span>You: </span>' + message);
			$(".messages").animate({ scrollTop: $(document).height() }, "fast");
		};

		$('.submit').click(function() {
		  newMessage();
		});

		$(window).on('keydown', function(e) {
		  if (e.which == 13) {
			newMessage();
			return false;
		  }
		});
		
	// Skills
	$(".multiple-skill").select2({
		placeholder: "Choose Skills"
	});
		
		
});
})(jQuery);