<!doctype html>
<html>
	<head>
		<title>Ajax Time</title>
	</head>
	<body>
		<h1><a id="msg"></a></h1>
	</body>
	
	<script type="text/javascript">
			function AjaxFunction(){
				var httpxml = new XMLHttpRequest();
				function stateck() {
					if(httpxml.readyState == 4){
						document.getElementById("msg").innerHTML=httpxml.responseText;
					}
				}
				httpxml.onreadystatechange = stateck;
				httpxml.open("GET", "time.php", true);
				httpxml.send(null);
			}

			setInterval(function() {
				AjaxFunction();
			}, 1000);
	</script>
</html>
