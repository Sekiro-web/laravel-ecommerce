$(document).ready(function () {
    $('#CategoryTable').DataTable();
});

// Delete dialog
const dialog = document.querySelector('#delete-dialog');
const dialogAction = document.querySelector('#delete-link');
const deleteRouteTemplate = "{{ route('deleteCategory', ':id') }}";

function showDeleteDialog(itemId) {
    dialogAction.href = deleteRouteTemplate.replace(':id', itemId);
    dialog.showModal();
}

function closeDialog() {
    dialog.close();
}

$(document).ready(function () {

    $(document).on('click', '[data-target="#ImagesModal"]', function () {
        const button = $(this);
        const name = button.data('name');
        const imagesData = button.data('images');

        let images = [];
        if (Array.isArray(imagesData)) {
            images = imagesData;
        } else if (imagesData && typeof imagesData === 'object') {
            images = [imagesData];
        }

        // Update modal
        $('#imagesModalLabel').text('Images for ' + (name || 'Category'));

        // Build Carousel
        let carouselHtml = '';
        if (images.length) {
            images.forEach((image, index) => {
                carouselHtml += `
        <img src="${image.url}" class="d-block w-100" alt="${image.alt || 'Category Image'}">`
            });

        } else {
            carouselHtml = '<div class="alert alert-info">No images available</div>';
        }

        $('#modal-items').html(carouselHtml);
    });

});