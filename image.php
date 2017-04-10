<?php
	session_start();
	if (isset($_SESSION['image']) && $_SESSION['image'] == 1)
	{
		include "ressource/connect.php";
		$req = $bdd->query("SELECT * FROM image WHERE id != '" . $_SESSION['id'] . "' ORDER BY RAND() LIMIT 1");
        $image = $req->fetch();
        $req->closeCursor();
		$path = "ressource/image/" . $image['id'] . "." . $image['format'];
		if ($image['format'] == 'png')
			header("Content-type:image/png");
        else if ($image['format'] == 'gif')
			header("Content-type:image/gif");
		else
			header("Content-type:image/jpeg");
        readfile($path); 
		$delete = 0;
		if ($delete)
		{
			unlink($path);
			$req = $bdd->query("DELETE FROM image WHERE id = '" . $image['id'] . "'");
			$req->closeCursor();
		}
		$_SESSION['image'] = 0;
	}
	else
	{
	    header('HTTP/1.0 404 Not Found');
		exit;
	}
?>