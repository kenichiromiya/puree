$(document).ready(function () {

	$(function() {
		$(window).bottom({proximity: 0.05});
		$(window).on('bottom', function() {
			var obj = $(this);
			if (!obj.data('loading')) {
				obj.data('loading', true);
				if (!obj.data('start')) {
					obj.data('start',$("#items").children().size());
				}
				$.ajax({
					url: "?start="+obj.data('start'),
					cache: false,
					success: function(html){
						$("#items").append(html);
						var state = $("#items").html();
						obj.data('start', obj.data('start')+12);
						obj.data('loading', false);
						history.replaceState(state, "", "");
					}
				});
			}
		});
		$(window).on('popstate', function(jqevent) {
			if(jqevent.originalEvent.state){
				$("#items").children().remove();
				$("#items").append(jqevent.originalEvent.state);
			}
		});
	});

});
