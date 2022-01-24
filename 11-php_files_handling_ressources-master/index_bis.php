<?php include('inc/head.php'); ?>

<?php 
if (isset($_POST["contenu"])){
	$file = fopen($fichier,"w");
	fwrite($file, $_POST["contenu"]);
	fclose($file); 
}	

if (isset($_POST["delete"])) {
	if (is_dir($_POST["delete"])) {
		// On vérifie s'il y a des fichiers à l'intérieur
		$a = $_POST["delete"] . "/";
		$dir = scandir($a);
		if (count($dir)>2) {
			echo "Veuillez supprimer tous les fichiers dans le dossier avant de le supprimer. <br><br>";
		}
		rmdir($_POST["delete"]);
	} else {
		echo "file";
		unlink($_POST["delete"]);
	}
}
?>

<?php 
$path = "files";
$contenu_lisible = false;

if (isset($_GET["f"])) {
	$fichier = $path . $_GET["f"];
	$extension = pathinfo($fichier);
	$extension = $extension['extension'];
	
	if (is_dir($fichier)) {
		$path = $fichier . "/";
	
	} elseif ($extension === "txt" or $extension === "html") {
		$contenu = file_get_contents($fichier);
		$contenu_lisible = true;
	
	} else {
		echo "Contenu non lisible <br><br>";
		// On remonte d'un cran dans le chemin des dossiers
		$path = explode("/", $fichier);
		$path = array_filter($path);
		$path = array_values($path); 
		unset($path[count($path)-1]);
		$path = implode("/", $path);
	}
}

$dir = opendir($path . "/");

while($file = readdir($dir)) {
	if ($file!="." and $file!="..") {
		echo "<a href=\"?f=" . $_GET["f"] . "/" . $file . "\">";
		echo $file;
		echo "</a>  ";
	}
}


if ($contenu_lisible === true) {
	echo "<form method=\"POST\" action=\"index_bis	.php\"><br>";
   echo "<textarea name=\"contenu\" style=\"width:100%;height:200px;\">" . $contenu . "</textarea><br>";
   echo "<input type=\"hidden\" name=\"file\" value=\"" . $fichier . "\"/><br>";
   echo "<input type=\"submit\" value=\"Envoyer\"/><br>";
	echo "</form>";
}

?>

<form method="POST" action="index_bis.php">
   <input type="hidden" name="delete" value="<?php echo $fichier;?>"/>
   <input type="submit" value="Supprimer le fichier"/>
	</form>



<?php include('inc/foot.php'); ?>
