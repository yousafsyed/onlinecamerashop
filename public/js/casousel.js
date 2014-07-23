(function ( $ ) {
	$.fn.casrousel =function(options){

        var settings = $.extend({
            // These are the defaults.
            current:0,
            step: 4,
            visible: 4,
            speed:200,
            liSize:235,
            margin: 20,
            carousel_height:300

        }, options );



  		var currentItemId = this.attr('id');
		var step = settings.step;
		var current = settings.current;
		var maximum = $("#"+currentItemId+' ul li').size();
		var visible = settings.visible;
		var speed = settings.speed;
		var liSize = settings.liSize + settings.margin;
		var carousel_height = settings.carousel_height;
		var ulSize = (liSize) * maximum;
		var divSize = (liSize) * visible -settings.margin;



		$("#"+currentItemId+" ul").css('list-style','none').css('padding','0');
		$("#"+currentItemId+' .btnprev').css('position', 'absolute').css('top', '50%').css('z-index', '23');
		$("#"+currentItemId+' .btnnext').css('position', 'absolute').css('top', '50%').css('z-index', '23').css('left','97%');

	

		$("#"+currentItemId+' ul').css("width", ulSize+"px").css("left", -(current * liSize)).css("position", "absolute");

		$("#"+currentItemId).css("width", divSize+"px").css("height", carousel_height+"px").css("visibility", "visible").css("overflow", "hidden").css("position", "relative");

		$("#"+currentItemId+' .btnnext').click(function() {

			if(current + step < 0 || (maximum)-(current+step) <= 0) {return; }
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


		// function
		function isFloat(n) {
		    return n === +n && n !== (n|0);
		}

		function isInteger(n) {
		    return n === +n && n === (n|0);
		}

	}
}( jQuery ));