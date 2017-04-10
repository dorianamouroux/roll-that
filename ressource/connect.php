<?php

	try
	{
		$bdd = new PDO('mysql:host=localhost;dbname=roll_that',
					   'root', '',
					   array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
							 PDO::ATTR_PERSISTENT => true));
	}
	catch (Exception $e)
	{
		exit('Erreur : ' . $e->getMessage());
	}

?>