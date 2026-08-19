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

    /**
     * A card's "additional content" popup (the "+" button). Delegated on
     * the document, rather than bound during initializeDraggableCards,
     * since these live on the child "draggable-card" blocks, which can be
     * individually re-rendered in the block editor without the parent (and
     * its init function) running again.
     */
    var $modalTrigger = null;

    var openCardModal = function ($modal, $trigger) {
        $modalTrigger = $trigger;
        $modal.removeClass('draggable-card__modal--closed').attr('aria-hidden', 'false');
        document.body.style.overflow = 'hidden';
        $modal.find('.draggable-card__modal-close').focus();
    };

    var closeCardModal = function ($modal) {
        $modal.addClass('draggable-card__modal--closed').attr('aria-hidden', 'true');
        document.body.style.overflow = '';
        if ($modalTrigger && $modalTrigger.length) {
            $modalTrigger.focus();
        }
        $modalTrigger = null;
    };

    $(document).on('click', '.draggable-card__more', function () {
        var $modal = $('#' + $(this).attr('data-modal-target'));
        if ($modal.length) {
            openCardModal($modal, $(this));
        }
    });

    $(document).on('click', '[data-modal-close]', function () {
        var $modal = $(this).closest('.draggable-card__modal');
        if ($modal.length) {
            closeCardModal($modal);
        }
    });

    $(document).on('keydown', function (e) {
        if (e.key !== 'Escape' && e.keyCode !== 27) {
            return;
        }
        $('.draggable-card__modal').not('.draggable-card__modal--closed').each(function () {
            closeCardModal($(this));
        });
    });

})(jQuery);
