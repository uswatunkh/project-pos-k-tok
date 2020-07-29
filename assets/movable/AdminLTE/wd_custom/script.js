/**
 * @author wd
 * @version 1 
 * license - GPL version 3 or any later version <http://www.gnu.org/licenses/gpl-3.0.txt>
 */
(function (b) {
	b(function (e) {
		var g = e("<div></div>"),
			d = function () {
				
				e(".wd-box-action").each(function (i, j) {
					
					var m = e(j).prev("span.wd-box-helper").get(0);
					if (!m) {
						return
					}
					var n = e(m).visible();
					
					if (n) {
						g.remove();
						e(j).css("padding-left", "0");
						e(j).removeClass("form-actions-fixed")
					} else {
						if (!e(j).hasClass("form-actions-fixed")) {
							var f = e(j).offset().left,
								k = e(j).css("height");
							g.css("height", k);
							e(j).after(g);
							e(j).addClass("form-actions-fixed");
							e(j).css("padding-left", f + "px")
						}
					}
				})
			};
		e(window).on("scroll", function () {
			d.call()
		});
		window.setTimeout(d, 500);
		
	});
})(jQuery);