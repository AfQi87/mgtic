$(document).ready(function() {
    $("#myModal").on('hidden.bs.modal', function (e) {
      $("#myModal iframe").attr("src", $("#myModal iframe").attr("src"));
    });
    // the body of this function is in assets/js/now-ui-kit.js
    nowuiKit.initSliders();
  });

  function scrollPresentation() {

    if ($('.section-presentation').length != 0) {
      $("html, body").animate({
        scrollTop: $('.section-presentation').offset().top
      }, 100);
    }
  }

  function scrollProfile() {

    if ($('.section-profile').length != 0) {
      $("html, body").animate({
        scrollTop: $('.section-profile').offset().top
      }, 100);
    }
  }

  function scrollCurriculum() {

    if ($('.section-curriculum').length != 0) {
      $("html, body").animate({
        scrollTop: $('.section-curriculum').offset().top
      }, 100);
    }
  }


  function scrollRequirements() {

    if ($('.section-requirements').length != 0) {
      $("html, body").animate({
        scrollTop: $('.section-requirements').offset().top
      }, 100);
    }
  }

  function scrollInscriptions() {

    if ($('.section-inscriptions').length != 0) {
      $("html, body").animate({
        scrollTop: $('.section-inscriptions').offset().top
      }, 100);
    }
  }

  function scrollRequirementsGrade() {

    if ($('.section-requirements-grade').length != 0) {
      $("html, body").animate({
        scrollTop: $('.section-requirements-grade').offset().top
      }, 100);
    }
  }


 

  function scrollTeachers() {

    if ($('.section-teachers').length != 0) {
      $("html, body").animate({
        scrollTop: $('.section-teachers').offset().top
      }, 100);
    }
  }

  function scrollToDownload() {

    if ($('.section-download').length != 0) {
      $("html, body").animate({
        scrollTop: $('.section-download').offset().top
      }, 100);
    }
  }