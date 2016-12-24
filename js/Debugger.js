function Debugger() {
  var self = this;
  __init();

  function __init() {
    $('body').prepend('\
<div id="debugger">\
  <div class="progress progress-striped">\
    <div class="row">\
      <a data-lightbox="/debug/menu" id="debug-menu-link">\
        <div class="progress-bar progress-bar-info col-md-12 col-lg-12" role="progressbar">\
          Sandbox Mode\
          <span class="glyphicon glyphicon-tasks debug-menu-btn pull-right"></span>\
          <span class="debug-menu-title"> Click to show the developer menu</span>\
        </div>\
      </a>\
    </div>\
  </div>\
</div>\
    ');
    $('body').addClass('debugger');

    $('#debug-menu-link').each(function() {
      var lightbox = new Lightbox($(this).data('lightbox'), $(this));
    });

    $('#debugger').hover(
      function() {
        // in
        $(this).find('.progress').animate({height:'30px'}, 100);
        $(this).find('.progress-bar').animate({paddingTop:'5px',paddingBottom:'5px'}, 100);
        $(this).find('.debug-menu-btn').animate({right:'240px'}, 100);
        $(this).find('.debug-menu-title').fadeIn(100);
      }, function() {
      // out
        $(this).find('.progress').animate({height:'20px'}, 100);
        $(this).find('.progress-bar').animate({paddingTop:'0px',paddingBottom:'0px'}, 100);
        $(this).find('.debug-menu-btn').animate({right:'-10px'}, 100);
        $(this).find('.debug-menu-title').fadeOut(100);
      }
    );

    $('#debugger').click(function() {
      console.debug('Opening debugging menu...');

    });
  }

  self.close = function(){
    $('#debugger').remove();
    $('body').removeClass('debugger');
  }
}