$(function(){
	jQuery('.product-image')
		.fluidbox({
			stackIndex: 9000
		})
		.on('openstart.fluidbox', function() {

			$(this).parents('.bx-viewport:first')
					.css({
						'overflow' : 'visible'
					});

			if ( typeof window.productslider != 'undefined' ) {
				window.productslider.stopAuto();
			}
		})
		.on('closeend.fluidbox', function() {
			$(this).parents('.bx-viewport:first')
					.css({
						'overflow' : 'hidden'
					});
			
			if ( typeof window.productslider != 'undefined' ) {
				window.productslider.startAuto();
			}
		});
});