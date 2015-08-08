	$(document).ready(function() {
		$("#markItUp").markItUp(mySettings);
		// make modules draggable
		dragProp = { handle:".handle", zIndex:100, opacity:0.9, scroll:1 };
		$('#colorPlugin').hide().draggable( dragProp );
		
		$('.close').click(function() {
			$(this).parent().parent().hide();
			return false;
		});
		$('.handle').click(function() {
			return false;
		});
		// accordion on modules
		$("#colorPlugin .module .slide:gt(0)").slideToggle();
		
		// init farbtastic plugin
		$('#picker').farbtastic('#color');	
		
		$(".module .colors a").eq(1).click(function() {
			acolor = $("#color").val();
			$.markItUp({ target:'#markItUp',replaceWith:function(h){
				$(h.textarea).css('color',acolor);
				},
			});
		return false;
		});
		
		$('.font').fontSelector({
			'hide_fallbacks' : true,
			'initial' : $('#markItUp').css('font-family'),
			'selected' : function(style) { $('#markItUp').css('font-family',style);},
			'fonts' : [
				'Arial,Arial,Helvetica,sans-serif',
				'Arial Black,Arial Black,Gadget,sans-serif',
				'Comic Sans MS,Comic Sans MS,cursive',
				'Courier New,Courier New,Courier,monospace',
				'Georgia,Georgia,serif',
				'Impact,Charcoal,sans-serif',
				'Lucida Console,Monaco,monospace',
				'Lucida Sans Unicode,Lucida Grande,sans-serif',
				'Palatino Linotype,Book Antiqua,Palatino,serif',
				'Tahoma,Geneva,sans-serif',
				'Times New Roman,Times,serif',
				'Trebuchet MS,Helvetica,sans-serif',
				'Verdana,Geneva,sans-serif',
				'Gill Sans,Geneva,sans-serif'
				]
		});
		
		$('#pattern-form').submit(function(){ //listen for submit event
			$('<input />').attr('type', 'hidden')
				.attr('name', 'Pattern[style]')
				.attr('value', $('#markItUp').attr('style') )
				.appendTo('#pattern-form');
		});

});
