
	function setMaxDivHeight(){
		var maxHeight = 0;
		$('.event-thumbnail').each(function(i){
		    if(this.offsetHeight > maxHeight){
		    	console.log("longueur"+this.offsetHeight);
		      	maxHeight = this.offsetHeight;
		      	console.log("max"+maxHeight);
		    }
	  	});
	  	console.log("final max"+maxHeight);
	 	//$('.listing-events').height(maxHeight);
		//$('.add.event-thumbnail').css("line-height",maxHeight+"px");
	}	
