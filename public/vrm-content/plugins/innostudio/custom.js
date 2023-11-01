jQuery3(document).ready(function() {
    
    // enable fileuploader plugin
    jQuery3('.innostudio-upload').fileuploader({
        addMore: true,
        fileMaxSize: 2,
        maxSize: 5,
        extensions: ['jpg','jpeg','png'],
        thumbnails: {
            box: '<div class="fileuploader-items">' +
                    '<ul class="fileuploader-items-list"></ul>' +
                '</div>',

            onItemShow: function(item) {
                // add sorter button to the item html
                item.html.find('.fileuploader-action-remove').before('<a class="fileuploader-action fileuploader-action-sort" title="Sort"><i></i></a>');
            }
        },
        item: '<li class="fileuploader-item">' +
           '<div class="columns">' +
               '<div class="column-thumbnail">${image}<span class="fileuploader-action-popup"></span></div>' +
               '<div class="column-title">' +
                   '<div title="${name}">${name}</div>' +
                   '<span>${size2}</span>' +
               '</div>' +
               '<div class="column-actions">' +
                   '<button class="fileuploader-action fileuploader-action-remove" title="${captions.remove}"><i class="fileuploader-icon-remove"></i></a>' +
               '</div>' +
           '</div>' +
           '<div class="progress-bar2">${progressBar}<span></span></div>' +
        '</li>',
        canvasImage: true,
        sorter: {
            selectorExclude: null,
            placeholder: null,
            scrollContainer: window,
            onSort: function(list, listEl, parentEl, newInputEl, inputEl) {
                // onSort callback
            }
        },
        editor: {
            // editor cropper
            cropper: {
                // cropper ratio
                // example: null
                // example: '1:1'
                // example: '16:9'
                // you can also write your own
                ratio: null,

                // cropper minWidth in pixels
                // size is adjusted with the image natural width
                minWidth: null,

                // cropper minHeight in pixels
                // size is adjusted with the image natural height
                minHeight: null,

                // show cropper grid
                showGrid: true
            },

            // editor on save quality (0 - 100)
            // only for client-side resizing
            quality: null,

            // editor on save maxWidth in pixels
            // only for client-side resizing
            maxWidth: null,

            // editor on save maxHeight in pixels
            // only for client-size resizing
            maxHeight: null,

            // Callback fired after saving the image in editor
            onSave: function(blobOrDataUrl, item, listEl, parentEl, newInputEl, inputEl) {
                // callback will go here
            }
        }
    });
});         

