$(document).ready(function(){
	// alert('home');
	
	function updCntdStockMin(){
		$.post(
		baseurl + "chome/getInsStockMin",
		function(data){
			var obj = $.parseJSON(data);
			var c = 0;
			$.each(obj, function(index, el) {
				c++;
			});
			$('#hTotalStockMin').html(c);		
		}
		);
	};
	setInterval(updCntdStockMin,5000);

});