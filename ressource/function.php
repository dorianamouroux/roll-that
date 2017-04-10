<?php

	function exist_image($hash)
	{
		global $bdd;

		$query = "SELECT COUNT(*) FROM image WHERE hash='" . $hash . "'";
		$res = $bdd->query($query);
		if (!$res)
			return (0);
		if ($res->fetchColumn() > 0)
			return (1);
		else
			return (0);
	}

    function get_nb_picture()
    {
        global $bdd;

		$query = "SELECT id FROM image ORDER BY id DESC LIMIT 1";
		$res = $bdd->query($query);
        $nb_image = $res->fetch();
        $res->closeCursor();
        return ($nb_image['id']);
    }

    function check_format($files)
    {
        $format_allowed = array('jpg', 'jpeg', 'png', 'JPG', 'gif');
        $format_upload = strtolower(substr(strrchr($files['image']['name'], '.'), 1));
        if (!in_array($format_upload, $format_allowed))
            return (0);
		return (1);
        $mime_allowed = array('image/gif', 'image/png', 'image/jpg', 'image/jpeg', 'image/pjpeg', 'image/x-png');
        $size = @getimagesize($files['tmp_name']);
//        echo ($size['mime']);
        print_r($files);
        exit();
        if (in_array($size['mime'], $mime_allowed))
            return (0);
        return (1);
    }

?>