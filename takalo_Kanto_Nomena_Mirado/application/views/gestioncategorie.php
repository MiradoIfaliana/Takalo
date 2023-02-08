<?php
defined('BASEPATH') OR exit('No direct script access allowed');
//$this->load->library('session');
?><!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<title>presentation</title>

	<style type="text/css">
	</style>
</head>
<body>

<div id="container">
	<h1>Bienvenu Admin <?php echo $_SESSION['connected']['nom']; ?></h1>
</div>

</body>
</html>