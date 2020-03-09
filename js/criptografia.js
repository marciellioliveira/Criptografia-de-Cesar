var httpRequest;

if (window.XMLHttpRequest) {

	httpRequest = new XMLHttpRequest();

} else if (window.ActiveXObject) {

	httpRequest = new ActiveXObject("Microsoft.XMLHTTP");
}

	if (httpRequest) {

		httpRequest.onreadystatechange = alertContents;
		httpRequest.open('GET', 'https://api.codenation.dev/v1/challenge/dev-ps/generate-data?token=ecf47bf31e28fdca8402fc73d50046cd87e9ab5d', true);
		httpRequest.send();

	} 

	function alertContents() {
		if (httpRequest.readyState === 4) {
			if (httpRequest.status === 200) {
				//alert(httpRequest.responseText);

				var documento = JSON.parse(httpRequest.responseText);

			} 
		}
	}


	


