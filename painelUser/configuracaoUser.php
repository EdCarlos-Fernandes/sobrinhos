<?php 
    ini_set('display_errors', 1);
    error_reporting(E_ALL);
    require_once '../_config/config.php';
    require_once '../_config/data.php';

    if(isset($_SESSION["numLogin"])){
        if(isset($_GET["num"])){
            $n1=$_GET["num"];
            
        }else if(isset($_POST["num"])){
            $n1=$_POST["num"];
        }
        
        $n2=$_SESSION["numLogin"];
        
        if($n1!=$n2){
            header("Location: $linkSite/index.php");
            exit();
        }
    }
?>

<!DOCTYPE html>
<html lang="pt-BR">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title><?php echo $titulo ?> Admin</title>
  <?php 
    require_once dirname(__DIR__) . '/_layout/head.php';
  ?>
</head>

<body>
  <header style="background-color: #000;">
    <?php 
      require_once dirname(__DIR__) . '/_layout/cabecalho.php';
    ?>
  </header>


  <main class="container-fluid page-body-wrapper">

  </main>



  <?php 
      require_once dirname(__DIR__) . "/_layout/rodape.php";
      require_once dirname(__DIR__) . '/_layout/scriptFooter.php';
    ?>
</body>

</html>