$(function() {
  
  var time = 300;

	function activate(el,the_class){
	  setTimeout(function() {
	  	$(el).addClass(the_class);
	  	if (the_class = '.csstransitions aside') {
	  		$(el).removeClass('hide');
	  	};
	  }, time);
	  time = time*1.6;
	}
  
  activate('.csstransitions body','active');
  activate('.main article','active');
  activate('.footer-container','up');
  activate('.csstransitions aside','show');


  $('.main aside').on('mouseenter touchstart', function(){
  	$('.main article').removeClass('active');
  	$(this).addClass('active');
  });

   $('.main article').on('mouseenter touchstart', function(){
  	$(this).addClass('active');
  	$('.main aside').removeClass('active');
  });

});
