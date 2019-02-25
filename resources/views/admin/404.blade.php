<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<link href="https://fonts.googleapis.com/css?family=Montserrat" rel="stylesheet">
	<style>
		body  {
			overflow-x: hidden;
			padding: 0px;
			margin :0px;
			box-sizing: border-box;
		}

		body > .not_found_page {
			width : 100vw;
			height : 80vh;
			background :url({{ URL::asset('images/404.png')  }});
			background-size: cover;
		}

		body > .text {
			font-family: 'Montserrat', sans-serif;
			font-weight : bold;
			font-size: 3vw;
			text-align: center;
			height : 20vh;
			width : 100vw;
			background :#f7f7f7;
			color : #2a2a2a;
		}
	</style>
</head>
<body>
<div class="not_found_page"></div>
<div class="text">PAGE NOT FOUND!</div>
</body>
</html>
