function start_loader(){
	$('body').prepend('<div id="preloader"><div class="loader-holder img" style="display: flex; justify-content: center; align-items: center;"><img src="./dist/img/loading.gif" alt="Preloader Image" title="Loading..."></div></div>')
  //  $('body').append('<div id="preloader"><div class="loader-holder"><div></div><div></div><div></div><div></div>')
}
function end_loader(){
	 $('#preloader').fadeOut('fast', function() {
        $(this).remove();
      })
}