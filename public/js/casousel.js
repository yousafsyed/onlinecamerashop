(function ( $ ) {
	$.fn.casrousel =function(){
  		var currentItemId = this.attr('id');

		var step = 4;
		var current = 0;
		var maximum = $("#"+currentItemId+' ul li').size();
		var visible = 4;
		var speed = 200;
		var liSize = 255;
		var carousel_height = 300;
		var ulSize = (liSize) * maximum;
		var divSize = (liSize) * visible -20;

		$("#"+currentItemId+" ul").css('list-style','none').css('padding','0');
		$("#"+currentItemId+' .btnprev').css('position', 'absolute').css('top', '50%').css('z-index', '23');
		$("#"+currentItemId+' .btnnext').css('position', 'absolute').css('top', '50%').css('z-index', '23').css('left','97%');

	

		$("#"+currentItemId+' ul').css("width", ulSize+"px").css("left", -(current * liSize)).css("position", "absolute");

		$("#"+currentItemId).css("width", divSize+"px").css("height", carousel_height+"px").css("visibility", "visible").css("overflow", "hidden").css("position", "relative");

		$("#"+currentItemId+' .btnnext').click(function() {
			if(current + step < 0 || current + step > maximum - visible) {return; }
			else {
				current = current + step;
				$("#"+currentItemId+' ul').animate({left: -(liSize * current)}, speed, null);
			}
			return false;
		});

		$("#"+currentItemId+' .btnprev').click(function() {
			if(current - step < 0 || current - step > maximum - visible) {return; }
			else {
				current = current - step;
				$("#"+currentItemId+' ul').animate({left: -(liSize * current)}, speed, null);
			}
			return false;
		});
	}
}( jQuery ));