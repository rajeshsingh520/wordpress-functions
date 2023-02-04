/**
 * v1.0.0
 */
(function ($) {
    'use strict';

    function quickSaveButton() {
        this.init = function () {
            this.addButton();
            this.onClick();
        }

        this.addButton = function () {

            if (jQuery('form[action="options.php"]').length == 1) {
                var button = jQuery('<button id="pisol-quick-save" class="button">Save settings</button>').css({
                    'position': 'fixed',
                    'top': '50%',
                    'right': '20px',
                    'z-index': '100000000000',
                    'background': '#ee6443',
                    'color': '#ffffff',
                    'border-color': '#FFFFFF'
                });
                jQuery('body').append(button);
            }
        }

        this.onClick = function () {
            jQuery(document).on('click', '#pisol-quick-save', function (e) {
                e.preventDefault();
                jQuery('form[action="options.php"]').trigger('submit');
                jQuery(this).text('Saving....');
            });
        }

    }

    jQuery(function ($) {
        var quickSaveButtonObj = new quickSaveButton();
        quickSaveButtonObj.init();
    });

})(jQuery);