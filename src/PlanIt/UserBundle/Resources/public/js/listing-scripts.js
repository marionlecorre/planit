$(function () {
	function getMaxDivHeight(){
	  var maxHeight = 0;
	  $('.event-thumbnail').each(function(i){
	    if(this.offsetHeight > maxHeight)
	      maxHeight = this.offsetHeight;
	  });
	  return maxHeight;
	}
	$('.listing-events').height(getMaxDivHeight());
	$('.add.event-thumbnail').css("line-height",getMaxDivHeight()+"px");
});