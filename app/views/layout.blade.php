<!doctype html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Laravel Quickstart</title>
	<style>
		@import url(//fonts.googleapis.com/css?family=Lato:700);

		body {
			margin:0;
			font-family:'Lato', sans-serif;
			text-align:center;
			color: #999;
		}

		.welcome {
			width: 300px;
			height: 200px;
			position: absolute;
			left: 50%;
			top: 50%;
			margin-left: -150px;
			margin-top: -100px;
		}

		a, a:visited {
			text-decoration:none;
		}

		a.edit-button {
			font-weight: normal;
			font-size: .8em;
			color: #FFFFFF;
			background: #ccddee;
			border-radius: 9px;
			display: inline-block;
			height: 16px;
			width: 36px;
			text-align: center;
			margin: 0 0 0 30px;
		}

		h1 {
			font-size: 32px;
			margin: 16px 0 0 0;
		}
	</style>
</head>
<body>
	@include("header");

	@yield('content');
</body>
</html>
