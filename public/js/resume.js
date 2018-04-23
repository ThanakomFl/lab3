(function($) {
  "use strict"; // Start of use strict

  // Smooth scrolling using jQuery easing
  $('a.js-scroll-trigger[href*="#"]:not([href="#"])').click(function() {
    if (location.pathname.replace(/^\//, '') == this.pathname.replace(/^\//, '') && location.hostname == this.hostname) {
      var target = $(this.hash);
      target = target.length ? target : $('[name=' + this.hash.slice(1) + ']');
      if (target.length) {
        $('html, body').animate({
          scrollTop: (target.offset().top)
        }, 1000, "easeInOutExpo");
        return false;
      }
    }
  });

  // Closes responsive menu when a scroll trigger link is clicked
  $('.js-scroll-trigger').click(function() {
    $('.navbar-collapse').collapse('hide');
  });

  // Activate scrollspy to add active class to navbar items on scroll
  $('body').scrollspy({
    target: '#sideNav'
  });

})(jQuery); // End of use strict


$(document).ready(function() {
  $('#datetimePicker').datetimepicker();

  $('#meetingForm').bootstrapValidator({
      feedbackIcons: {
          valid: 'glyphicon glyphicon-ok',
          invalid: 'glyphicon glyphicon-remove',
          validating: 'glyphicon glyphicon-refresh'
      },
      fields: {
          meeting: {
              validators: {
                  date: {
                      format: 'MM/DD/YYYY h:m A',
                      message: 'The value is not a valid date'
                  }
              }
          }
      }
  });

  $('#datetimePicker').on('dp.change dp.show', function(e) {
      $('#meetingForm').bootstrapValidator('revalidateField', 'meeting');
  });
});

$(document).ready(function() {
  $('#profileForm').bootstrapValidator({
      feedbackIcons: {
          valid: 'glyphicon glyphicon-ok',
          invalid: 'glyphicon glyphicon-remove',
          validating: 'glyphicon glyphicon-refresh'
      },
      fields: {
          birthday: {
              validators: {
                  date: {
                      format: 'YYYY/MM/DD',
                      message: 'The value is not a valid date'
                  }
              }
          }
      }
  });
});