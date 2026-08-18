(function ($) {

    /**
     * initializeDraggableCards
     *
     * Lets the card track be dragged horizontally with a mouse (touch
     * already scrolls natively) and wires up the prev/next arrows.
     *
     * @date    18/8/26
     * @since   1.0.0
     *
     * @param   object $block The block jQuery element.
     * @return  void
     */
    var initializeDraggableCards = function ($block) {

        var $track = $block.find('.draggable-cards-block__track').first();
        var track = $track[0];

        if (!track) {
            return;
        }

        var isDown = false;
        var dragged = false;
        var startX = 0;
        var startScrollLeft = 0;

        var cardGap = function () {
            return parseInt($track.css('gap'), 10) || 0;
        };

        var cardWidth = function () {
            var $card = $track.children().first();
            return $card.length ? $card.outerWidth() + cardGap() : 300;
        };

        track.addEventListener('mousedown', function (e) {
            isDown = true;
            dragged = false;
            startX = e.pageX;
            startScrollLeft = track.scrollLeft;
            $track.addClass('draggable-cards-block__track--dragging');
        });

        ['mouseleave', 'mouseup'].forEach(function (evt) {
            track.addEventListener(evt, function () {
                isDown = false;
                $track.removeClass('draggable-cards-block__track--dragging');
            });
        });

        track.addEventListener('mousemove', function (e) {
            if (!isDown) {
                return;
            }
            var walk = e.pageX - startX;
            if (Math.abs(walk) > 5) {
                dragged = true;
            }
            e.preventDefault();
            track.scrollLeft = startScrollLeft - walk;
        });

        // Stop a dragged card's link from firing a click on release.
        track.addEventListener('click', function (e) {
            if (dragged) {
                e.preventDefault();
                e.stopPropagation();
            }
        }, true);

        $block.find('.draggable-cards-block__arrow--prev').on('click', function () {
            track.scrollBy({ left: -cardWidth(), behavior: 'smooth' });
        });

        $block.find('.draggable-cards-block__arrow--next').on('click', function () {
            track.scrollBy({ left: cardWidth(), behavior: 'smooth' });
        });
    };

    // Initialize each block on page load (front end).
    $(document).ready(function () {
        $('.draggable-cards-block').each(function () {
            initializeDraggableCards($(this));
        });
    });

    // Initialize dynamic block preview (editor).
    if (window.acf) {
        window.acf.addAction('render_block_preview/type=draggable-cards', initializeDraggableCards);
    }

})(jQuery);
