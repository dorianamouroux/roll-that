<?php
	session_start();
	$_SESSION['ok'] = 0;
    include "ressource/connect.php";
    include "ressource/function.php";
    $nb_picture = get_nb_picture();
?>

<!DOCTYPE html>
<html>
	<head>
		<title>Roll That</title>
		<link rel="stylesheet" type="text/css" href="asset/css/design.css" />
		<link rel="stylesheet" type="text/css" href="asset/css/fa.css" />
		<link rel="icon" type="image/png" href="asset/image/favicon.png" />

		<meta http-equiv="content-type" content="text/html; charset=utf-8" />
		<meta name="keywords" content="image fun random aleatoire upload rire humour tequilol lol haha">
		<meta name="category" content="fun">
		<meta name="robots" content="index, nofollow">
		<meta name="Description" content="Envoyez une image, recevez une image qui sera ensuite supprimée">
		<meta name="author" lang="fr" content="Dorian AMOUROUX">
	</head>
	<body>
		<div id="error" class="error">
			<p id="error_message"></p>
			<a onclick="close_error()" class="close_error">Ok</a>
		</div>
		<img src="asset/image/logo.png" class="logo" />
		<div class="how_it_work">
			<div class="work1" onclick="dumb_user()">
				<i class="fa fa-cloud-upload"></i>
				1 - Upload picture
			</div>
			<div class="work2">
				<i class="fa fa-cloud-download"></i>
				2 - Get one back
			</div>
			<div class="work3">
				<i class="fa fa-trash"></i>
				3 - The picture you get is removed
			</div>
		</div>
		<div class="double_square">
			<form id="upload" method="post" action="upload.php" enctype="multipart/form-data">
				<div class="progress" id="progress"></div>
				<div class="box_upload" id="box_upload">
					<label id="text_upload" class="text_upload" for="input_image">CLICK HERE</label>
					<input class="input_image" type="file" name="image" id="input_image" />
				</div>
			</form>
			<p class="right"><i class="fa fa-arrow-right"></i></p>
			<p class="down"><i class="fa fa-arrow-down"></i></p>
			<div class="square_download">
				<div id="result_img" class="result_img"></div>
				<p id="placeholder_result">?</p>
			</div>
		</div>
		<p class="useless_link">
			<a href="legale.html">Mentions légales</a>
            <p><?php echo ($nb_picture + 800); ?> uploaded pictures</p>
		</p>
		<script type="text/javascript" src="asset/js/jquery.js"></script>
		<script type="text/javascript" src="asset/js/truc.js"></script>
		<script type="text/javascript" src="asset/js/jquery.fileupload.js"></script>
		<script type="text/javascript" src="asset/js/upload.js"></script>
	</body>
</html>