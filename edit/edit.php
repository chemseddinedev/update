<!DOCTYPE html>
<html>
<head>
	<title>edit</title>
</head>
<body>


<?php  
	$bdd = new PDO('mysql:host=localhost;dbname=kompus', 'root', '');
	
	if (isset($_GET['edit'])) { 

		$query = $bdd->query("SELECT * FROM cours WHERE id = '$_GET[edit]' ");
		while ($donnees = $query->fetch())  { ?>
		
		<?php  

		if (isset($_POST['newtitle']) AND !empty($_POST['newtitle'])) {
			echo $_POST['newtitle'];
			$newtitle = htmlspecialchars($_POST['newtitle']);
			$id = $_GET['id'];
      		$insertpseudo = $bdd->prepare("UPDATE cours SET title = ? WHERE id = ?");
      		$insertpseudo->execute(array($newtitle,$id));
		}


		?>


	<form method="post">
		<input type="text" name="newtitle" value="<?= $donnees['title'] ?>">
		<input type="submit" name="submit" value="update">

	</form>

	<?php
		}
		?>

	<?php
	}

?>

</body>
</html>