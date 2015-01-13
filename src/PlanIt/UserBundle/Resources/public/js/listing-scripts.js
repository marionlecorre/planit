
	function setMaxDivHeight(){
		var maxHeight = 0;
		$('.event-thumbnail').each(function(i){
		    if(this.offsetHeight > maxHeight){
		    	console.log("longueur"+this.offsetHeight);
		      	maxHeight = this.offsetHeight;
		      	console.log("max"+maxHeight);
		    }
	  	});
	}
