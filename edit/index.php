<!DOCTYPE html>
<html>
<head>
	<title>edit and delete</title>
</head>
<body>

<h3>cours page :</h3>

<table border="1">
	<tr>
		<th>ID</th>
		<th>Title</th>
		<th>Category</th>
		<th>status</th>
		<th>author</th>
		<th>Delete</th>
		<th>Edit</th>
	</tr>
	<?php 
	$bdd = new PDO('mysql:host=localhost;dbname=kompus', 'root', '');
	$query = $bdd->query("SELECT * FROM cours");
	while($donnees = $query->fetch()){ ?>
	
	<tr>
		<td><?= $donnees['id']; ?></td>
		<td><?= $donnees['title']; ?></td>
		<td><?= $donnees['category']; ?></td>
		<td><?= $donnees['status']; ?></td>
		<td><?= $donnees['author']; ?></td>
		<td><a href="index.php?supprimer=<?= $donnees['id']; ?>">delete</a></td>
		<td><a href="index.php?edit=<?= $donnees['id']; ?>">edite</a></td>


	</tr>
	<?php } ?>
</table>

<?php 
	
	if (isset($_GET['supprimer']) AND !empty($_GET['supprimer'])) {
		$supprimer = (int) $_GET['supprimer'];
		$delete = $bdd->prepare("DELETE FROM cours WHERE id = ? ");
		$delete->execute(array($supprimer));
	}

 ?>

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

		<br><br>
		<br><br>
		<h2>update the title :</h2>
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