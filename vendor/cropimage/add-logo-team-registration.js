$(document).ready(function () {
  $('#img-team').on('click', function () {
    const src = $(this).attr('src');
    $('#modal-view-logo').addClass('d-flex');
    $('#modal-view-logo').find('img').attr('src', src);
  });

  $('#close-view-logo').click(function () {
    $('#modal-view-logo').removeClass('d-flex');
  });

  $('#delete-logo').click(function () {
    console.log('deleted');
    $('#img-team').attr('src', '../../assets/ilustration/ilus__plus.png');
    $('#modal-view-logo').find('img').attr('src', '');
    $('#modal-view-logo').removeClass('d-flex');
    $('.thumb-text-team').text('Add team Logo');
  });

  var cropper;

  $('#input-logo').on('change', function (e) {
    var input = e.target;
    var reader = new FileReader();

    reader.onload = function () {
      if (cropper) {
        cropper.destroy();
      }
      $('#modal-preview-input-logo').addClass('d-flex');
      $('#preview-input-logo').attr('src', reader.result);

      // Initialize Cropper.js
      cropper = new Cropper($('#preview-input-logo')[0], {
        aspectRatio: 1, // Set the aspect ratio as needed
        crop: function (e) {
          // Output the cropped area coordinates
          console.log(e.detail.x);
          console.log(e.detail.y);
          console.log(e.detail.width);
          console.log(e.detail.height);
        },
      });
    };

    // Read the selected file as Data URL
    reader.readAsDataURL(input.files[0]);
  });

  $(document).on('click', '#applyCropProfile', function () {
    if (cropper) {
      // Get the cropped data as a base64-encoded string
      var croppedDataUrl = cropper.getCroppedCanvas().toDataURL();
      cropper.getCroppedCanvas().toBlob(function (blob) {
        // console.log(blob);
        const date = new Date().getTime();
        const file = new File([blob], `thumb-tour-${date}.png`, {
          type: 'image/png',
        });
        const dt = new DataTransfer();
        dt.items.add(file);
        $('#input-logo').prop('files', dt.files);
        $('.thumb-text-team').text(dt.files[0].name);
      });

      // Create a new image element with the cropped data
      $('#modal-view-logo').find('img').attr('src', croppedDataUrl);
      $('#modal-preview-input-logo').removeClass('d-flex');
      $('#img-team').attr('src', croppedDataUrl);
    }
  });

  $(document).on('click', '#cancelCropProfile', function () {
    $('#modal-preview-input-logo').removeClass('d-flex');
    $('#modal-view-logo').find('img').attr('src', '');
    $('#preview-input-logo').attr('src', '');
  });
});
