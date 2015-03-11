<script type="text/javascript">
      
      <?php
        require_once ("CreaConnv2.php");

        if (!defined('ENT_SUBSTITUTE')) {
          define('ENT_SUBSTITUTE', 8);
        }
        
        $select = "select nombrelabel as id, desplieguelabel as valor, classlabel as class from Label";

        $rs = $mysqli->query($select);
        if (!$rs) {
          echo "Falló al ejecutar la consulta: (". $mysqli->errno .") ". $mysqli->error;
        }else {
          $retorno = "var labels = {";
          $indice = 0;
          while ($label = $rs->fetch_assoc()){
            
            if ($indice > 0) { $retorno .= ",";}
            $retorno .= $label['id']." : '".htmlentities($label['valor'],ENT_SUBSTITUTE,'UTF-8')."'";
            $indice ++;
          }
          
          $retorno .= "};\n";
          $rs->free();

          echo $retorno;
        }
      ?>

      for (var elem in labels){
        //alert(elem + " value " + labels[elem]);
        //var cadena = new RegExp(elem, '');
       
        //alert("ANtes de Jquery");
        $.each( $('[id~='+ elem +']'),function () {
          //alert( $(this).text() );
          $(this).text(labels[elem]);
          //alert($(this).text());
        });
        //document.body.innerHTML = document.body.innerHTML.replace(cadena, labels[elem]);
      }

</script>