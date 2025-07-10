(function ($) {
	/**
	 * initializeBlock
	 *
	 * Adds custom JavaScript to the block HTML.
	 *
	 * @date    15/4/19
	 * @since   1.0.0
	 *
	 * @param   object $block The block jQuery element.
	 * @param   object attributes The block attributes (only available when editing).
	 * @return  void
	 */
	var initializeBlock = function () {
		const select = document.getElementById("language-select");
		if (select) {
			select.addEventListener("change", function () {
				const lang = select.value;
				console.log("lang:", lang);
				let url = `${ResourcesAjax.ajax_url}?action=filter_resources&lang=${lang}&topic="Spot+the+Signs"`;
				if (lang === "all") {
					url = `${ResourcesAjax.ajax_url}?action=filter_resources&topic="Spot+the+Signs"`;
				}

				fetch(
					`${ResourcesAjax.ajax_url}?action=filter_resources&lang=${lang}&topic="Spot+the+Signs"`
				)
					.then((response) => response.text())
					.then((html) => {
						document.querySelector(".post-block").innerHTML = html;
					});
			});
		}
	};

	// Initialize each block on page load (front end).
	$(document).ready(function () {
		$(".resources-block").each(function () {
			initializeBlock($(this));
		});
	});

	// Initialize dynamic block preview (editor).
	if (window.acf) {
		window.acf.addAction(
			"render_block_preview/type=resources-block",
			initializeBlock
		);
	}
})(jQuery);
