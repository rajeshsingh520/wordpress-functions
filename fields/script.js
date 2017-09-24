jQuery(document).ready(function ($) {
 
   $(document).on("click", ".upload_image_button", function (e) {
      e.preventDefault();
      var $button = $(this);
 
 
      // Create the media frame.
      var file_frame = wp.media.frames.file_frame = wp.media({
         title: 'Select or upload image',
         library: { // remove these to show all
            type: 'image' // specific mime
         },
         button: {
            text: 'Select'
         },
         multiple: false  // Set to true to allow multiple files to be selected
      });
 
      // When an image is selected, run a callback.
      file_frame.on('select', function () {
         // We set multiple to false so only get one image from the uploader
 
         var attachment = file_frame.state().get('selection').first().toJSON();
 
         $button.siblings('input').val(attachment.url);
        
         
         $button.siblings('img').attr("src",attachment.url);
 
      });
 
      // Finally, open the modal
      file_frame.open();
   });

   $(document).on('click','.remove_image_button',function(e){
        e.preventDefault();
        var $button = $(this);
        $button.siblings('input').val("");
        $button.siblings('img').attr("src","");
   });

});

jQuery(document).ready(function($) {
    $('.my-color-picker').wpColorPicker();   
});

jQuery(document).ajaxComplete(function() {
    jQuery('.my-color-picker').wpColorPicker();
});  