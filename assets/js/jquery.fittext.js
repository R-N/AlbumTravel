/*global jQuery */
/*!
* FitText.js 1.2
*
* Copyright 2011, Dave Rupert http://daverupert.com
* Released under the WTFPL license
* http://sam.zoy.org/wtfpl/
*
* Date: Thu May 05 14:23:00 2011 -0600
*/

(function( $ ){

  $.fn.fitText = function( kompressor, options ) {

    // Setup options
    var compressor = kompressor || 1,
        settings = $.extend({
          'minFontSize' : Number.NEGATIVE_INFINITY,
          'maxFontSize' : Number.POSITIVE_INFINITY
        }, options);

    return this.each(function(){

      // Store the object
      var $this = $(this);

      // Resizer() resizes items based on the object width divided by the compressor * 10
      var resizer = function () {
        $this.css('font-size', Math.max(Math.min($this.width() / (compressor*10), parseFloat(settings.maxFontSize)), parseFloat(settings.minFontSize)));
		
		var bordermul = $this.width() / (compressor*100);
        if($this.css('border-top-width') != null)
			$this.css('border-top-width', bordermul);
        if($this.css('border-bottom-width') != null)
			$this.css('border-bottom-width', bordermul);
        if($this.css('border-left-width') != null)
			$this.css('border-left-width', bordermul);
        if($this.css('border-right-width') != null)
			$this.css('border-right-width', bordermul);
		if($this.css('text-shadow') && $this.css('text-shadow')!='none'){
			let shadows = $this.css('text-shadow').match(/(rgb\([^\)]+\) +[^p]+px +[^p]+px +[^p]+px\,? *)/g);
			let shadows1 = [];
			for(i=0; i <shadows.length; ++i){
				let shadow = shadows[i].match(/(rgb\([^\)]+\)) +(-?)[^p]+px +(-?)[^p]+px +(-?)[^p]+px\,? */g);
				
				let shadow1 = [];
				
				
				let y = 0 + 'px';
				let x = 0 + 'px';
				let blur = 0 + 'px';
				
				if(shadow[1]) y = shadow[1] + y;
				if(shadow[2]) x = shadow[2] + x;
				if(shadow[3]) blur = shadow[3] + blur;
				
				shadow1.push(shadow[0]);
				shadow1.push(y);
				shadow1.push(x);
				shadow1.push(blur);
				
				shadows1.push(shadow1.join(' '));
			}
			$this.css('text-shadow', shadows1.join(', '));
		}
      };

      // Call once to set.
      resizer();

      // Call on resize. Opera debounces their resize by default.
      $(window).on('resize.fittext orientationchange.fittext', resizer);

    });

  };

})( jQuery );
