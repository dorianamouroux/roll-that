<?php
	if (!empty($_FILES))
	{
		session_start();
		if (!isset($_SESSION['ok']))
		{
			echo "Unknow error, try harder or later";
			exit();
		}
		if (isset($_SESSION['image']) && $_SESSION['image'] == 1)
		{
			echo "Unknow error, try harder or later";
			exit();
		}
		$nb_seconde = 4;
		if (isset($_SESSION['time']) && ((time() - $_SESSION['time']) < $nb_seconde))
		{
			echo "Slow down bro ... slow down";
			exit();	
		}
		$error = "";
		if ($_FILES['image']['error'] == UPLOAD_ERR_NO_FILE)
			$error = "Image manquante";
		else
		{
			include "ressource/function.php";
			if ($_FILES['image']['error'] == UPLOAD_ERR_INI_SIZE)
				$error = "Size of the picture is too laaaaarge";
			if ($_FILES['image']['error'] == UPLOAD_ERR_PARTIAL)
				$error = "Upload error, try harder or later";
            if (check_format($_FILES) == 0)
				$error = "Forbidden format (jpg/jpeg, png, gif only)";
        }
		if (empty($error))
		{
			$hash_image = hash_file('sha256', $_FILES['image']['tmp_name']);
			include "ressource/connect.php";
			if (exist_image($hash_image) == 0)
			{
                $format_upload = strtolower(substr(strrchr($_FILES['image']['name'], '.'), 1));
				$query = "INSERT INTO image VALUES('', :format, :hash)";
				$req = $bdd->prepare($query);
				$req->execute(array(
					'format' => $format_upload,
					'hash' => $hash_image
				));
				$id = $bdd->lastInsertId();
				$req->closeCursor();
				$name = "ressource/image/" . $id . '.' . $format_upload;
				if (move_uploaded_file($_FILES['image']['tmp_name'], $name))
				{
					$_SESSION['image'] = 1;
					$_SESSION['id'] = $id;
					$_SESSION['time'] = time();
					echo "ok";
				}
				else
				{
					$req = $bdd->query("DELETE FROM image WHERE id = '" . $id . "'");
					$req->closeCursor();
					echo "Unknow error, try harder or later";
				}
			}
			else
				echo "This picture already exists";
		}
		else
			echo $error;
	}
	else
		echo "Unknow error, try harder or later";
?>