(function($){
	function go_to() {
		$( document ).on('wp-theme-update-success', function(){
			window.location.href = rella_redirect.url;
		})
	}
    $(document).ready(function() {
    	go_to();
    });
})(jQuery);
