(function($) {
    'use strict';

    var ImagesHandler = function () {};

    ImagesHandler.prototype = {
        init: function () {
            this.$body = $('body');
            this.$mainContainer = this.$body.find('.admin-right');
            this.$imageContainer = this.$mainContainer.find('.image-container');
            this.$deleteButton = this.$imageContainer.find('.delete-image');
            this.$deleteImageFlag = this.$imageContainer.find('input[name="delete_image"]');
            this.image_upload = $('#uploaded_photo').val();
            this.image_thumbnail = $('#uploaded_photo').val();

            this.bindEvents();
        },
        displayImageToBeUploaded: function (id) {
            // Doesn't work in IE9 and below because they don't
            // have the HTML5 File API.
            var self = this,
                input = document.getElementById(id),
                imagePreview = document.getElementById('userfile-image-preview'),
                file_type = this.$mainContainer.find('#userfile-image-preview').val();

            console.log(file_type);

            if (input.files && input.files[0] && file_type !== undefined) {
                var reader = new FileReader();

                reader.onload = function (e) {
                    imagePreview.src = e.target.result;

                    if (self.$deleteButton !== undefined) {
                        self.$deleteButton.show();
                    }


                    if (self.$imageContainer !== undefined) {
                        self.$imageContainer.removeClass('hidden');
                    }

                    if (self.$deleteImageFlag !== undefined) {
                        self.$deleteImageFlag.val(0);
                    }
                };

                reader.readAsDataURL(input.files[0]);
            }
        },
        deleteImage: function () {
            var $image = this.$imageContainer.find('img');

            $image.attr('src', '');
            this.$deleteButton.hide();
            this.$deleteImageFlag.val(1);
        },
        bindEvents: function () {
            var self = this;

            this.$mainContainer.on('change', '#userfile', function () {
                self.displayImageToBeUploaded('userfile');
            });

            this.$mainContainer.on('click', '.delete-image', function () {
                self.deleteImage();
            });
        }
    };

    window.imagesHandler = new ImagesHandler();
})(jQuery);

jQuery(function () {
    'use strict';

    imagesHandler.init();
});