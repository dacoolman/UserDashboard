$(document).ready( function(){
	function deselect(e) {
    $('.pop').slideFadeToggle(function() {
      e.removeClass('selected');
    });    
  }

  $(function() {
    $('.btn.waves-effect.waves-light.red.dynamic').on('click', function() {
      if($(this).hasClass('selected')) {
        deselect($(this));               
      }
      else {
        $(this).addClass('selected');
        $('.pop').slideFadeToggle();
      }
      return false;
    });

    $('.close').on('click', function() {
      deselect($('#.btn.waves-effect.waves-light.red.dynamic'));
      return false;
    });
  });

  $.fn.slideFadeToggle = function(easing, callback) {
    return this.animate({ opacity: 'toggle', height: 'toggle' }, 'fast', easing, callback);
  };
});