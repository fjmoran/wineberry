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
	
	$update_query = "update ".$_POST['table']." set ".$activo."=".$_POST[$activo]." where ".$id."=".$_POST[$id];
	
	if ((isset($_POST['debug'])) or (isset($_GET['debug']))) 
	{ 
	echo $update_query."<br>\n";
	}
	
	if ($mysqli->query($update_query) === TRUE) {
    	echo $update_query." successfully done.<br>\n";
	}else {
		echo $update_query." Failed!<br>\n";
	}
	if (isset($_POST['debug'])) { echo "TEST"; }
?>

<script src="../recursos/jquery/jquery-1.10.2.min.js"></script>    
<script src="../recursos/bootstrap3/js/bootstrap.min.js"></script>
<script type="text/javascript">
<?php echo	"parent.$('#cuerpo').load('".$URL."');"; ?>
parent.$('#act_desact').modal('hide');
parent.$('body').removeClass('modal-open');
parent.$('.modal-backdrop').remove();

</script>
