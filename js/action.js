// affects all views

var scripts = document.getElementsByTagName('script'), thisScript = scripts[scripts.length-1], queryString = thisScript.src.replace(/^[^\?]+\??/,''), qs = parseQueryString(queryString);
$.ajaxSetup({ cache:true });


// View assignment

if(qs['view']!==null) {switch(qs['view']) {
	case 'index':
		perfectInput();
		addComment();
		homeSubmit();
		break;
	case 'detail':
		$.getScript('js/jquery.countdown.min.js?v=1', function() {
			$('#countDown').countdown({
				until: plusCount,
				expiryUrl: window.document.location.pathname
			});
		});
		if ( navigator.mimeTypes["application/x-shockwave-flash"] ) {
			$.getScript('js/ZeroClipboard.js?v=1', function() {
				zeroClipboard();
			});
		}
		break;			
	default:
}}


// Index view functions

function addComment() {
	$('#add-comment').click(function() {
		var commentElem = document.createElement('textarea');
		var addElem = $(this);
		addElem.after(commentElem).remove();
		$(commentElem)
			.attr({
				id:'comments',
				name:'comments'
			})
			.focus()
			.parent().removeClass('comment-text')
		return false;
	});
	var canvas = document.getElementById('add-comment-arrow');
	if (canvas.getContext) {
		var ctx = canvas.getContext("2d");
		ctx.fillStyle = "#dadada";
		ctx.beginPath();
		ctx.arc(10,10,9,0,Math.PI*2,true);
		ctx.fill();
		ctx.fillStyle = "#ffffff";
		ctx.beginPath();
		ctx.moveTo(5,7);
		ctx.lineTo(10,15);
		ctx.lineTo(15,7);
		ctx.fill();
		ctx.strokeStyle = "#dadada";
		ctx.beginPath();
		ctx.moveTo(140,10);
		ctx.lineTo(230,10);
		ctx.lineTo(237,16);
		ctx.lineTo(244,10);
		ctx.lineTo(263,10);
		ctx.stroke();
	}
	else {
		$('#add-comment').addClass('no-canvas');
	}
}

function homeSubmit() {
	var expirTarget = $('#exHour'); // default
	$('form#create table button').bind('click focus', function() {
		expirTarget = this;
	});
		
	$('form#create').submit(function(){
		var pElem = $('form#create input#password');
		var uElem = $('form#create input#username');
		if ( pElem.val() === 'password' && pElem.hasClass('no-input') ) {
			pElem.addClass('validation-error');
			return false;
		}
		var submitButtonId = $(expirTarget).attr('id');
		var hiddenInput = $('form#create input#expiration');
		switch(submitButtonId) {
			case 'exHour':
				hiddenInput.val('1');
				break;
			case 'exDay':
				hiddenInput.val('2');
				break;
			case 'exWeek':
				hiddenInput.val('3');
				break;
		}
		if ( uElem.val() === 'username' && uElem.hasClass('no-input') ) uElem.val('');
		return true;
	});
}

function perfectInput() {
	$('form#create .input-wrap input').each(function() {
		var input = $(this);
		input
			.focus(function() {
				input.removeClass('no-input validation-error');
				if (this.value === this.defaultValue) this.value = '';
			})
			.blur(function() {
				if (this.value === '') {
					this.value = this.defaultValue;
					input.addClass('no-input');
				}
			})
	});
}


// Details view functions

function zeroClipboard() {
	ZeroClipboard.setMoviePath('js/ZeroClipboard.swf');
	$(".copy").each(function() {
		var clip = new ZeroClipboard.Client();
		var clipEl = $(this);
		clip.glue(clipEl[0]);
		clip.setText(clipEl.text());
		clip.addEventListener('complete', function() {
			$('body').append("<div id='copied'>Copied</div>")
			var cpElem = $('#copied');
			cpElem.show();
			setTimeout(function() { cpElem.remove() }, 250);
		});
	});
}


// Other functions

function parseQueryString(query) {
   var params = new Object ();
   if ( ! query ) return params; // return empty object
   var pairs = query.split(/[;&]/);
   for ( var i = 0; i < pairs.length; i++ ) {
      var KeyVal = pairs[i].split('=');
      if ( ! KeyVal || KeyVal.length != 2 ) continue;
      var key = unescape( KeyVal[0] );
      var val = unescape( KeyVal[1] );
      val = val.replace(/\+/g, ' ');
      params[key] = val;
   }
   return params;
}