jQuery(function($) { 
	"use strict";
	$(".zo-counter-wraper .zo-counter").each(
		function() {
			"use strict";
			var options = {
				useEasing : false,
				useGrouping : false,
				separator : ',',
				decimal : '.'
			}
			var digit = $(this).attr("data-digit");
			var prefix = $(this).attr("data-prefix");
			var suffix = $(this).attr("data-suffix");
			var grouping = $(this).attr("data-grouping");
			var separator = $(this).attr("data-separator");
			var decimal = $(this).attr("data-decimal");
			if (prefix != undefined) {
				options.prefix = prefix;
			}
			if (suffix != undefined) {
				options.suffix = suffix;
			}
			console.log(grouping);
			if (grouping != undefined) {
				grouping = grouping == "false" ? false : grouping;
				grouping = grouping == "true" ? true : grouping;
				options.useGrouping = grouping;
			}
			if (separator != undefined) {
				options.separator = separator;
			}
			if (decimal != undefined) {
				options.decimal = decimal;
			}
			var random = 0;
			if ($(this).attr("data-type") == 'random') {
				var random = Math.floor(Math.random() * digit * 2);
			}
			$(this).waypoint(
				function() {
					var count = new countUp($(this).attr("id"), random,
							digit, 0, 0, options);
					count.start();
				}, {
					offset : '95%',
					triggerOnce : true
				});
		});
});
