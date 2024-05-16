$(document).ready(function () {
  $("#avatar-circle").on("click", function () {
    const src = $(this).attr("src");
    $("#modal-view-avatar").addClass("d-flex");
    $("#modal-view-avatar").find("img").attr("src", src);
  });

  $("#close-view-avatar").click(function () {
    $("#modal-view-avatar").removeClass("d-flex");
  });

  $("#delete-avatar").click(function () {
    console.log("ce");
    $("#avatar-circle").attr(
      "src",
      "https://cdn.pixabay.com/photo/2015/10/05/22/37/blank-profile-picture-973460_960_720.png"
    );
    $("#modal-view-avatar").find("img").attr("src", "");
    $("#modal-view-avatar").removeClass("d-flex");
  });

  var cropper;

  $("#input-avatar").on("change", function (e) {
    var input = e.target;
    var reader = new FileReader();

    reader.onload = function () {
      if (cropper) {
        cropper.destroy();
      }
      $("#modal-preview-input-avatar").addClass("d-flex");
      $("#preview-input-avatar").attr("src", reader.result);

      // Initialize Cropper.js
      cropper = new Cropper($("#preview-input-avatar")[0], {
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

  $(document).on("click", "#applyCropProfile", function () {
    if (cropper) {
      // Get the cropped data as a base64-encoded string
      var croppedDataUrl = cropper.getCroppedCanvas().toDataURL();
      cropper.getCroppedCanvas().toBlob(function (blob) {
        // console.log(blob);
        const date = new Date().getTime();
        const file = new File([blob], `avatar-${date}.png`, {
          type: "image/png",
        });
        const dt = new DataTransfer();
        dt.items.add(file);
        $("#input-avatar").prop("files", dt.files);
      });

      // Create a new image element with the cropped data
      $("#modal-view-avatar").find("img").attr("src", croppedDataUrl);
      $("#modal-preview-input-avatar").removeClass("d-flex");
      $("#avatar-circle").attr("src", croppedDataUrl);
    }
  });

  $(document).on("click", "#cancelCropProfile", function () {
    $("#modal-preview-input-avatar").removeClass("d-flex");
    $("#modal-view-avatar").find("img").attr("src", "");
    $("#preview-input-avatar").attr("src", "");
  });
  // setInterval(function () {
  //   var input = $('#input-avatar').prop('files');
  //   console.log(input);
  // }, 3000);
});
