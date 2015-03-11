<?php
	error_reporting(E_ALL);
	
	require_once("CreaConnv2.php");
	require_once("auth.php");

	$pos = strpos($_POST['table'],".") + 1;
	$tabla = substr($_POST['table'],$pos);
	$activo = "activo".$tabla;
	$id = "id".$tabla;
	
	$callerURL = pathinfo($_POST['callerURL']);
	
	$directorioURL = str_replace("/".$ini_array['basedir']."/","",$callerURL['dirname']);
	
	$URL = $directorioURL."/".$callerURL['basename'];
	
	$delete_query = "delete from ".$_POST['table']." where ".$id."=".$_POST[$id];
	
	if ((isset($_POST['debug'])) or (isset($_GET['debug']))) 
	{ 
	echo $delete_query."<br>\n";
	}
	
	if ($mysqli->query($delete_query) === TRUE) {
    	echo $delete_query." successfully done.<br>\n";
	}else {
		echo $delete_query." Failed!<br>\n";
	}
?>

<script src="../recursos/jquery/jquery-1.10.2.min.js"></script>    
<script src="../recursos/bootstrap3/js/bootstrap.min.js"></script>
<script type="text/javascript">
<?php echo	"parent.$('#cuerpo').load('".$URL."');"; ?>
parent.$('#act_desact').modal('hide');
parent.$('body').removeClass('modal-open');
parent.$('.modal-backdrop').remove();

</script>
