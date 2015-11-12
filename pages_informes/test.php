<?php
include_once "../recursos/zhi/CreaConnv2.php";
?>


<div class="col-md-11">
	<h2>Test switch on/off</h2>
    </br>
    <label>
      <input onchange="this.setAttribute('disabled', 'true');$('#salida').load('recursos/zhi/test_insert.php')" type="checkbox" name="rf-switch-2"> &nbsp Ampolleta prendida
    </label>
<div id="salida">
</div>
</div><!-- col-md-11 -->

<script type="text/javascript"> 
	$("input[type=checkbox]").switchButton({
	})
</script>
