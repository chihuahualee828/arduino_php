(function main(){
	var video = document.getElementById("video"),
		vendorURL = window.URL || window.webkitURL;
	
	if(navigator.mediaDevices.getUserMedia){
		navigator.mediaDevices.getUserMedia({video: true})
		.then(function(stream){
			video.srcObject = stream;
		}).catch(function(error){
			console.log("something went wrong!!")
			
		});
		
	}
	
})();