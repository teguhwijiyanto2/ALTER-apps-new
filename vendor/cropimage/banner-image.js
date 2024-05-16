$(document).ready(function () {
  $('#banner-profile').on('click', function () {
    const url = $(this).css('background-image');
    var src = url.replace(/(url\(|\)|"|')/g, '');

    $('#modal-view-banner').addClass('d-flex');
    $('#modal-view-banner').find('img').attr('src', src);
  });

  $('#close-view-banner').click(function () {
    $('#modal-view-banner').removeClass('d-flex');
  });

  $('#delete-banner').click(function () {
    $('#banner-profile').css(
      'background-image',
      `url(${'https://www.eclosio.ong/wp-content/uploads/2018/08/default.png'})`
    );
    $('#modal-view-banner').find('img').attr('src', '');
    $('#modal-view-banner').removeClass('d-flex');
  });

  var cropper;

  $('#input-banner').on('change', function (e) {
    var input = e.target;
    console.log('input', input.files[0]);
    var reader = new FileReader();

    reader.onload = function () {
      if (cropper) {
        cropper.destroy();
      }
      $('#modal-preview-input-banner').addClass('d-flex');
      $('#preview-input-banner').attr('src', reader.result);

      // Initialize Cropper.js
      cropper = new Cropper($('#preview-input-banner')[0], {
        aspectRatio: 16 / 9, // Set the aspect ratio as needed
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

  $(document).on('click', '#applyCropBanner', function () {
    if (cropper) {
      // Get the cropped data as a base64-encoded string
      var croppedDataUrl = cropper.getCroppedCanvas().toDataURL();
      cropper.getCroppedCanvas().toBlob(function (blob) {
        // console.log(blob);
        const date = new Date().getTime();
        const file = new File([blob], `banner-${date}.png`, {
          type: 'image/png',
        });
        const dt = new DataTransfer();
        dt.items.add(file);
        $('#input-banner').prop('files', dt.files);
      });

      // Create a new image element with the cropped data
      $('#modal-view-banner').find('img').attr('src', croppedDataUrl);
      $('#modal-preview-input-banner').removeClass('d-flex');
      $('#banner-profile').css('background-image', `url(${croppedDataUrl})`);
    }
  });

  $(document).on('click', '#cancelCropBanner', function () {
    $('#modal-preview-input-banner').removeClass('d-flex');
    $('#modal-view-banner').find('img').attr('src', '');
    $('#preview-input-banner').attr('src', '');
  });
});
