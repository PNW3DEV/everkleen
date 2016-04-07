var $ = jQuery;

$(document).ready(function($){
  "use strict";

  // Creative Header
  $( "#creative_sortable" ).sortable({
      stop: function() {
          addToInput('creative_header_images', 'creative_sortable');
      }
  });

  $('.preview-creative').on('click', '.close', function() {
      $(this).closest('li').remove();
      addToInput('creative_header_images', 'creative_sortable');
  });

  if ( wp.media ) {
      var creative_uploader = wp.media.frames.file_frame = wp.media({
          title: 'Select the image',
          multiple: true,
          button: {
              text: 'Add selected images'
          },
          library: {
              type: 'image'
          }
      });

      creative_uploader.on('select', function() {
          var image = creative_uploader.state().get('selection').toArray();
          $.each(image, function( index, value ) {
            var item_edit = $('#upload_img_creative').closest('.upload');
            addImage(value.toJSON().id, value.toJSON().url, item_edit, 'creative_sortable');
          });
          addToInput('creative_header_images', 'creative_sortable');
      });

      $('#upload_img_creative').click(function() {
          creative_uploader.open();
          return false;
      });
  }

    // Carousel
    $( "#sortable" ).sortable({
        stop: function() {
            addToInput('list-of-images', 'sortable');
        }
    });

    $('.preview-img-container').on('click', '.close', function() {
        $(this).closest('li').remove();
        addToInput('list-of-images', 'sortable');
    });

    if ( wp.media ) {
        var uploader = wp.media.frames.file_frame = wp.media({
            title: 'Select the image',
            multiple: true,
            button: {
                text: 'Add selected images'
            },
            library: {
                type: 'image'
            }
        });

        uploader.on('select', function() {
            var image = uploader.state().get('selection').toArray();
            $.each(image, function( index, value ) {
              var item_edit = $('#upload_img').closest('.upload');
              addImage(value.toJSON().id, value.toJSON().url, item_edit, 'sortable');
            });
            addToInput('list-of-images', 'sortable');
        });

        $('#upload_img').click(function() {
            uploader.open();
            return false;
        });
    }


    // Section BG
    $( "#sortable_bg" ).sortable({
        stop: function() {
            addToInput('list-of-bg-images', 'sortable_bg');
        }
    });

    $('.preview-bg-img-container').on('click', '.close', function() {
        $(this).closest('li').remove();
        addToInput('list-of-bg-images', 'sortable_bg');
    });

    $('.preview-bg-img-container').on('click', '.bw-pin', function() {
      $(this).closest( 'li' ).find('img').attr('data-fixed', "true");
      $(this).removeClass('bw-pin');
      $(this).addClass('bw-pinned');
      addToInput('list-of-bg-images', 'sortable_bg');
    });
    $('.preview-bg-img-container').on('click', '.bw-pinned', function() {
      $(this).closest('li').find('img').attr('data-fixed', "false");
      $(this).removeClass('bw-pinned');
      $(this).addClass('bw-pin');
      addToInput('list-of-bg-images', 'sortable_bg');
    });

    if ( wp.media ) {
        var bg_uploader = wp.media.frames.file_frame = wp.media({
            title: 'Select the image',
            multiple: true,
            button: {
                text: 'Add selected images'
            },
            library: {
                type: 'image'
            }
        });

        bg_uploader.on('select', function() {
            var image = bg_uploader.state().get('selection').toArray();
            $.each(image, function( index, value ) {
                var item_edit = $('#upload_section_bg').closest('.upload');
                addImage(value.toJSON().id, value.toJSON().url, item_edit, 'sortable_bg');
            });
            addToInput('list-of-bg-images', 'sortable_bg');
        });

        $('#upload_section_bg').click(function() {
            bg_uploader.open();
            return false;
        });
    }

    // Export Subscribers From DB
    $('body').on( 'click', '#btn-export', function ( e ) {
        e.preventDefault();
        export_callback();
        window.open( $('#btn-export').attr('href'), '_blank' );
    } );

    // Remove Subscriber From DB
    $('body').on( 'click', '.remove-subscriber', function ( e ) {
        var s_id = $(this).parent().find('span').attr('id').substr(1);

        $.post( ajaxurl, {
            action: 'bw_remove_subscriber',
            id: s_id,
            async: false,
        },
        function( msg ) {
        });

        $(this).parent().remove();
    } );

    // Section background columns options
    $('#section_bg_col').change( function() {
      var col = $(this).val();
      $('#sortable_bg li').each( function() {
        var empty = false;
        if ( $(this).hasClass('empty') ) {
          empty = true;
        }
        $(this).removeClass();
        $(this).addClass('ui-sortable-handle col' + col );
        if ( empty ) {
          $(this).addClass('empty');
        }
      });
      $( '#sortable_bg').removeClass();
      $( '#sortable_bg').addClass('ui-sortable show'+ (12/col) );
      addToInput('list-of-bg-images', 'sortable_bg');
    });

    // Add empty to backgrounds
    $('#add_empty_bg').click( function() {
      var col = $('#section_bg_col').val();
      $('#sortable_bg').prepend('<li class="empty col'+ col +'"><i class="close fa fa-times"></i></li>');
      addToInput('list-of-bg-images', 'sortable_bg');
    });

    //Preloaders
    var active_preloader = $('#spinner_predefined').val();
    $('.spinner_overlay[data-name="'+active_preloader+'"]').addClass('active');

    $('body').on('click', '.spinner_overlay', function() {
      $('#spinner_predefined').val( $(this).attr('data-name'));
      $('.spinner_overlay[data-name="'+active_preloader+'"]').removeClass('active');
      active_preloader = $('#spinner_predefined').val();
      $('.spinner_overlay[data-name="'+active_preloader+'"]').addClass('active');
    });
});

function export_callback () {
    $.post( ajaxurl, {
        action: 'bw_export_list',
        async: false,
    },
    function( msg ) {
    });
}

function addImage(id, url, item, sortable_id) {
    $('#' + sortable_id, item).append('<li><i class="close fa fa-times"></i><img data-id="' + id + '" src="' + url + '"></li>');
}

function addToInput(input_id, sortable_id) {
    var images = {};
    $('#' + sortable_id + ' img, #' + sortable_id + ' .empty').each(function(index) {
        if ( typeof( $(this).attr('src') ) !== 'undefined' ) {
          images[index] = {
              id: $(this).data('id'),
              url: $(this).attr('src'),
              fixed: $(this).attr('data-fixed'),
          };
        } else {
          images[index] = {
            empty: true,
          }
        }
    });
    $( '#' + input_id ).val( JSON.stringify(images) );
}
