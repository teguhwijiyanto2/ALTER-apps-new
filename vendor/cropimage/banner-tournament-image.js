$(document).ready(function () {
  $("#banner-tournament").on("click", function () {
    const src = $(this).attr("src");
    $("#modal-view-banner").addClass("d-flex");
    $("#modal-view-banner").find("img").attr("src", src);
  });

  $("#close-view-banner").click(function () {
    $("#modal-view-banner").removeClass("d-flex");
  });

  $("#delete-banner").click(function () {
    console.log("deleted");
    $("#banner-tournament")
      .attr("src", "../../assets/ilustration/ilus__plus.png")
      .css({ width: "48px", height: "48px" });
    $("#modal-view-banner").find("img").attr("src", "");

    $("#modal-view-banner").removeClass("d-flex");
    $("#banner-text-tournament").text("Add Banner");
  });

  var cropper;

  $("#input-banner").on("change", function (e) {
    var input = e.target;
    var reader = new FileReader();

    reader.onload = function () {
      if (cropper) {
        cropper.destroy();
      }
      $("#modal-preview-input-banner").addClass("d-flex");
      $("#preview-input-banner").attr("src", reader.result);

      // Initialize Cropper.js
      cropper = new Cropper($("#preview-input-banner")[0], {
        aspectRatio: 21 / 9, // Set the aspect ratio as needed
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

  $(document).on("click", "#applyCropBanner", function () {
    if (cropper) {
      // Get the cropped data as a base64-encoded string
      var croppedDataUrl = cropper.getCroppedCanvas().toDataURL();
      cropper.getCroppedCanvas().toBlob(function (blob) {
        // console.log(blob);
        const date = new Date().getTime();
        const file = new File([blob], `banner-tour-${date}.png`, {
          type: "image/png",
        });
        const dt = new DataTransfer();
        dt.items.add(file);
        $("#input-banner").prop("files", dt.files);
      });

      // Create a new image element with the cropped data
      $("#modal-view-banner").find("img").attr("src", croppedDataUrl);
      $("#modal-preview-input-banner").removeClass("d-flex");
      $("#banner-tournament")
        .attr("src", croppedDataUrl)
        .css({ width: "100%", height: "200px" });
      $("#banner-text-tournament").text("");
    }
  });

  $(document).on("click", "#cancelCropBanner", function () {
    $("#modal-preview-input-banner").removeClass("d-flex");
    $("#modal-view-banner").find("img").attr("src", "");
    $("#preview-input-banner").attr("src", "");
  });
  // setInterval(function () {
  //   var input = $('#input-banner').prop('files');
  //   console.log(input);
  // }, 3000);
});
