
$(document).ready(function() {

	// =================================
	// General
	// =================================

	// Alerts
	// **********************************	
	$('.alert .close').on('click', function() {
		$(this).parents('.alert').first().slideUp('fast', function(){
				$(this).fadeOut('slow');
		});
	});

	// Lightbox
	// **********************************	

	var $trigger = $('#trigger-lightbox');
	var $parent = $('#trigger-lightbox').parents('li.mini-cart-status').first();
	var $lightbox = $('.lightbox');
	var $lightbox_h = $('.lightbox').outerHeight();
	//var $nav_h = $('.navbar').outerHeight();

	function openlightbox() {
		$($parent).addClass("open");
		$("body").animate({ "padding-top": $lightbox_h + 73   });
		$($lightbox).slideDown('normal', function() {
			$(this).clearQueue();
		});
	}
	function closelightbox() {
		$("body").animate({ "padding-top": 73 });
		$($lightbox).slideUp('normal', function(){
			$(this).clearQueue();
			$($parent).removeClass("open");
		});
	}

	var timeoutId;
	$($trigger).hover(function () {
			if(!timeoutId) {
				timeoutId = window.setTimeout(function() {
					timeoutId = null;
					openlightbox();
				}, 500);
			}
		},
		function () {
			if(timeoutId) {
				window.clearTimeout(timeoutId);
				timeoutId = null;
			}
			else {
				//
			}
		}
	);
	$($lightbox).mouseenter(function() {
		//
	}).mouseleave(function() {
		setTimeout(closelightbox, 1500);
	});


	// =================================
	// Home
	// =================================

	// Chosen Select
	// **********************************	
	$(".chzn-select").chosen();

	// Dropdown menu with Forms
	// **********************************	
	$('.dropdown-menu').on('click', function(e){
        if( $(this).hasClass('dropdown-menu-form') )  {
            if(!$(this).hasClass('simple')){
            e.stopPropagation();
            }
        }
	});


	// Hero Image
	// **********************************
	$('.hero').anystretch($heroImg);


	// Ultimas Carreras
	// **********************************
	$("#latests-events-slider").touchCarousel({
		itemsPerMove: 4,
		scrollbar: false,
		loopItems: false,
		snapToItems: true,
		pagingNavControls: true,
		pagingNav: true
	});

	// =================================
	// Carreras
	// =================================


	// Filter Search Typeahead
	// **********************************
	/*var dataEvents = ['Alabama', 'Alaska', 'American Samoa', 'Arizona', 'Arkansas', 'California', 'Colorado', 'Connecticut'];
	$('.events-search-filter.typeahead').typeahead({
		source: dataEvents,
		items: 15
	});*/


	// Ayudas de Click en Carreras
	// ************************************
	/*
	$(".events .event").addClass('link').on("click", function(){
		var $link = $(this).find('a').first().attr('href');
		window.location = $link;
	});
	*/

	// Tooltips de Agregar a Mis Carreras
	// ************************************
    if ($('.events .add-event a').size()) {
        $('.events .add-event a').tooltip({
            placement: 'bottom',
            trigger: 'hover'
        });
    }


	// Notificaciones de agregado al carrito
	// ***************************************
	/*$('#quick-view .add-to-cart').on("click", function(e){
		$('#added-to-cart.notifications').fadeIn('fast').delay(1200).fadeOut('fast');
		e.preventDefault();
	});*/
	$('.add-event a').on("click", function(e){
		$('#added-to-events.notifications').fadeIn('fast').delay(1200).fadeOut('fast');
		$(this).tooltip('hide');
		e.preventDefault();
	});


	// =================================
	// Carrito
	// =================================

	$('.discount-code .add-discount').on("click", function(e){
		$('#applied-discount.notifications').fadeIn('fast').delay(1200).fadeOut('fast');
		e.preventDefault();
	});

	$('.cart .delete-photo').tooltip({
		placement: 'top',
		trigger: 'hover'
	});


	// =================================
	// Perfil
	// =================================

	// Ayudas en Perfil - Historial
	// ************************************
	$('.orders .help').popover({
		placement: 'top',
		trigger: 'hover'
	});


}); // Document Ready 