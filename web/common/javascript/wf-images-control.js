// 图像控件初始化js
$.fn.hilight = function(options) {
  var defaults = {
    foreground: 'red',
    background: 'yellow'
  };
  // Extend our default options with those provided.
  var opts = $.extend(defaults, options);
	alert($(this).html());
  // Our plugin implementation code goes here.
};
