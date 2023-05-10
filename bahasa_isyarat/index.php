<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Document</title>
    </head>
    <body>
        
        <div>History Message Count : <div id="mytext1" style="display:inline;"></div></div>
        <div>Latest Message : <div id="mytext2" style="display:inline;"></div></div>
    </body>

    <script type="text/javascript">
            let nowLength = 0;
            let lastLength = 0;
			function AjaxFunction(){
				var httpxml = new XMLHttpRequest();
				function stateck() {
					if(httpxml.readyState == 4){
                        var response = JSON.parse(httpxml.responseText);
                        nowLength = response.length;
                        if(nowLength != lastLength){
                            document.getElementById("mytext1").innerHTML=response.length;
                            document.getElementById("mytext2").innerHTML=response[parseInt(response.length)-1]['text'];
                        }
                        lastLength = nowLength;
					}
				}
				httpxml.onreadystatechange = stateck;
				httpxml.open("GET", "api.php", true);
				httpxml.send(null);
			}

			setInterval(function() {
				AjaxFunction();
			}, 100);
	</script>
</html>