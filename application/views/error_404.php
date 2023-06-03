<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?><!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<title>404 Page Not Found</title>
<style type="text/css">

::selection { background-color: #E13300; color: white; }
::-moz-selection { background-color: #E13300; color: white; }

body {
	background-color: #f9f9f9;
	margin: 40px;
	font: 13px/20px normal Helvetica, Arial, sans-serif;
	color: #4F5155;
}

a {
	color: #003399;
	background-color: transparent;
	font-weight: normal;
}

#container {
	margin: 10%;
        text-align:center;
}

h2 {
	margin: 20px 15px 12px 15px;
        font-family: Consolas, Monaco, Courier New, Courier, monospace;
}
</style>
</head>
<body>
	<div id="container">
            <img src="<?=base_url()?>assets/web/images/404-error.png">
            <h2>I think we're lost in space! go back to <a href='<?=base_url()?>'>Home</a></h2>
	</div>
</body>
</html>