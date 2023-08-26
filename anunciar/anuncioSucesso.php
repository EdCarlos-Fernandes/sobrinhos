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
            header("Location: $url/index.php");
            exit();
        }
    }
?>

<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $titulo ?> - INICIO</title>
</head>

<body>
    <header style="background-color: #000;">
        <?php 
            require_once dirname(__DIR__) . '/_layout/cabecalho.php';
            require_once dirname(__DIR__) . '/_layout/head.php';
        ?>
    </header>


    <main class="container-fluid page-body-wrapper d-flex flex-column" style="padding-top: 50px;">
        <section class='conteudo'>
            <div class='container'>
                <div class='anuncio-principal1 altura'>
                    <div class='img-sucesso'>
                        <img src="<?php echo $linkSite ?>/_imgs/icone/icone1.png">
                    </div>

                    <div class='mensagem-sucesso'>

                    <p>Obrigado por anunciar sua vaga de emprego na <b><?php echo $titulo ?></b>, estamos aqui para ajudar a população a entrarem no mercado de trabalho, e gerar economia para o Brasil.</p>
                    <p>Seu anuncio foi postado com sucesso para ver a postagem acesse esse <a href='<?php echo $linkSite ?>/recentes.php?num=<?php echo $_SESSION['numLogin'];?>'>Link</a> que redirecionará para a página da postagem.</p>
                        <div class="directionUser">
                            <?php

                            if(!isset($_SESSION['numLogin'])){
                                echo "<a href='$linkSite/index.php'>Pagina Inicial</a>";
                            }else{
                                echo "<a href='$linkSite/index.php?num=".$_SESSION['numLogin']."'>Pagina Inicial</a>";
                            }

                            if(isset($_SESSION['numLogin'])){                                   
                                echo "<a href='$linkSite/anunciar/anunciar.php?num=".$_SESSION['numLogin']."'>Incluir mais Anuncios</a>";
                            }
                            ?>
                        </div>
                    </div>
                </div>
                <!--FIM DA DIV ANUNCIAR VAGAS-->
            </div>
        </section>
    </main>


    <?php 
        require_once dirname(__DIR__) . "/_layout/rodape.php";
        require_once dirname(__DIR__) . '/_layout/scriptFooter.php';
    ?>
</body>

</html>