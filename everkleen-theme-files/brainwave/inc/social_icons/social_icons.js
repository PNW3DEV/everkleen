/* global redux_change, wp */

jQuery(document).ready(function () {

    jQuery('.redux-social_icons-remove').live('click', function () {
        redux_change(jQuery(this));
        jQuery(this).parent().siblings().find('input[type="text"]').val('');
        jQuery(this).parent().siblings().find('textarea').val('');
        jQuery(this).parent().siblings().find('input[type="hidden"]').val('');

        var footerLinksCount = jQuery(this).parents('.redux-social_icons-accordion-group').length;

        if (footerLinksCount >= 1) {
            jQuery(this).parents('.redux-social_icons-accordion-group:first').slideUp('medium', function () {
                jQuery(this).remove();
            });
        } else {
            jQuery(this).parents('.redux-social_icons-accordion-group:first').find('.remove-image').click();
            jQuery(this).parents('.redux-container-social_icons:first').find('.redux-social_icons-accordion-group:last').find('.redux-social_icons-header').text("New Slide");
        }
    });

    jQuery('.redux-social_icons-add').click(function () {


        var oldSlide = jQuery(this).prev().find('.redux-social_icons-accordion-group:last');
        //oldSlide.find('select').select2('destroy');

        var newSlide = oldSlide.clone(true);

        //oldSlide.find('select').select2();

        var footerLinksCount = jQuery(newSlide).find('input[type="text"]').attr("name").match(/[0-9]+(?!.*[0-9])/);
        var footerLinksCount1 = footerLinksCount*1 + 1;

        jQuery(newSlide).find('input[type="text"],  input[type="hidden"], textarea, select').each(function(){

            if(typeof jQuery(this).attr("name") !== 'undefined') {
                jQuery(this).attr("name", jQuery(this).attr("name").replace(/[0-9]+(?!.*[0-9])/, footerLinksCount1) );
            }

            if(typeof jQuery(this).attr("id") !== 'undefined') {
                jQuery(this).attr("id", jQuery(this).attr("id").replace(/[0-9]+(?!.*[0-9])/, footerLinksCount1) );
            }
            jQuery(this).val('');
            if (jQuery(this).hasClass('social_icons-sort')){
                jQuery(this).val(footerLinksCount1);
            }
        });

        newSlide.find('input[type="checkbox"]').removeAttr('checked');

        newSlide.find('h3').text('').append('<span class="redux-social_icons-header">New Contact Info</span><span class="ui-accordion-header-icon ui-icon ui-icon-plus"></span>');
        jQuery(this).prev().append(newSlide);

        //newSlide.find('select').select2();
        //jQuery.redux.select3();
    });

    jQuery('.social_icons-title').keyup(function(event) {
        var newTitle = event.target.value;
        jQuery(this).parents().eq(3).find('.redux-social_icons-header').text(newTitle);
    });

    jQuery(function () {
        jQuery(".redux-social_icons-accordion")
            .accordion({
                header: "> div > fieldset > h3",
                collapsible: true,
                active: false,
                heightStyle: "content",
                icons: { "header": "ui-icon-plus", "activeHeader": "ui-icon-minus" }
            })
            .sortable({
                axis: "y",
                handle: "h3",
                connectWith: ".redux-social_icons-accordion",
                start: function(e, ui) {
                    ui.placeholder.height(ui.item.height());
                    ui.placeholder.width(ui.item.width());
                },
                placeholder: "ui-state-highlight",
                stop: function (event, ui) {
                    // IE doesn't register the blur when sorting
                    // so trigger focusout handlers to remove .ui-state-focus
                    ui.item.children("h3").triggerHandler("focusout");
                    var inputs = jQuery('input.social_icons-sort');
                    inputs.each(function(idx) {
                        jQuery(this).val(idx);
                    });
                }
            });
    });




});
