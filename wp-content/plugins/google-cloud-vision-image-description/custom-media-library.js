jQuery(document).ready(function($) {
   // button
   var updateDescriptionsButton = $('<button>', {
       id: 'update-image-descriptions-button',
       class: 'button',
       text: 'Update Image Descriptions'
   });

   // insert button
   $('#wp-media-grid').prepend(updateDescriptionsButton);


   updateDescriptionsButton.on('click', function() {

       var selectedImageIds = [];
       $('.attachment.selected').each(function() {
           selectedImageIds.push($(this).data('id'));
       });

       // init postdata
       var postData = {
           image_ids: selectedImageIds
       };

       // ajax call
       if (selectedImageIds.length > 0) {
           $.ajax({
               type: 'POST',
               url: 'https://kourentzes.com/konstantinos/wp-content/plugins/google-cloud-vision-image-description/image-descriptor.php', 
               data: postData, 
               success: function(response) {
                   alert('Image descriptions updated successfully for selected images.');
               },
               error: function(jqXHR, textStatus, errorThrown) {
                   var errorMessage = 'Error updating image descriptions for selected images.\n\n';

                   errorMessage += 'Selected Image IDs: ' + selectedImageIds.join(', ') + '\n\n';
                   errorMessage += 'JSON Body:\n' + JSON.stringify(postData, null, 2) + '\n\n';

                   if (jqXHR.responseText) {
                       errorMessage += 'Server Response: ' + jqXHR.responseText;
                   }

                   alert(errorMessage);
               }
           });
       } else {
           alert('No images selected. Please select images to update descriptions.');
       }
   });
});
