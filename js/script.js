$(document).ready(function () {
  // =============================================
  //   Form login Register Tab Switch
  // =============================================

  $('.tab__item').click(function () {
    $('.tab__item').removeClass('active');
    $(this).addClass('active');
    const selectedForm = $(this).data('form');
    showForm(selectedForm);
  });

  function showForm(tab) {
    switch (tab) {
      case 'email':
        $(`#form-email`).show();
        $(`#form-phone`).hide();
        return;
      case 'phone':
        $(`#form-email`).hide();
        $(`#form-phone`).show();
        return;
      default:
        return;
    }
  }

  showForm('email');

  // =============================================
  //   TAB USER PROFILE
  //   user-profile.html
  // =============================================
});
