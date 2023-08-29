<?php
    ini_set('display_errors', 0);
    error_reporting(E_ALL);
    require_once '../_config/config.php';
    require_once '../_config/conx.php';
    require_once '../_config/data.php';

    header("Cache-Control: no-cache, no-store, must-revalidate");

    // Variável para controlar o redirecionamento
    $redirecionar = false;

    // Verifica se a variável de sessão "numLogin" está definida
    if (isset($_SESSION["numLogin"])) {
        // Valida e filtra o parâmetro "num"
        $n1 = filter_input(INPUT_GET, "num", FILTER_SANITIZE_STRING);
        $n2 = $_SESSION["numLogin"];

        if ($n1 !== $n2) {
            $redirecionar = true;
        }
    }

    // Redirecionamento se necessário
    if ($redirecionar) {
        // Verifica se as variáveis de sessão estão definidas antes de usá-las nos parâmetros
        if (isset($_SESSION['numLogin']) && isset($_SESSION['username'])) {
            // Escapa as variáveis de saída para prevenir XSS
            $numLogin = htmlspecialchars($_SESSION['numLogin'], ENT_QUOTES, 'UTF-8');
            $username = htmlspecialchars($_SESSION['username'], ENT_QUOTES, 'UTF-8');
            
            $redirectUrl = "$url/noticias/noticia-em-destaque.php?num=$numLogin&id=$username";
            header("Location: $redirectUrl");
            exit();
        }
    }
?>

<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $titulo ?> - Noticias Destaques</title>
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


    <main class="container-fluid page-body-wrapper d-flex flex-column" style="padding-top: 50px;">
        <!--CONTEUDO -->
        <section class='conteudo'>
            <div class='container'>
                <div class='anuncio-principal'>
                    <?php 
                        $id = $_GET['id'];

                        $sql = "SELECT * FROM tb_noticias WHERE id={$id}";
                        
                        $result = mysqli_query($conn, $sql);

                        if($exibe = mysqli_fetch_array($result)){

                            echo "<div class='descricao-vaga'>
                                    <div class='titulo-vaga'>";
                                        echo "<h1>Noticías</h1>";
                                        echo "<div class='clear'></div>
                                    </div>

                                    <div class='detalhe-noticias'>
                                        <div class='conteudo-noticia-img'>
                                            <h3>".$exibe['titulo']."</h3>
                                            <div class='data-icone1'>
                                            <svg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 16 16' width='13' height='13'><path fill-rule='evenodd' d='M1.643 3.143L.427 1.927A.25.25 0 000 2.104V5.75c0 .138.112.25.25.25h3.646a.25.25 0 00.177-.427L2.715 4.215a6.5 6.5 0 11-1.18 4.458.75.75 0 10-1.493.154 8.001 8.001 0 101.6-5.684zM7.75 4a.75.75 0 01.75.75v2.992l2.028.812a.75.75 0 01-.557 1.392l-2.5-1A.75.75 0 017 8.25v-3.5A.75.75 0 017.75 4z'></path></svg>
                                                <p>Data da publicação: ".date('d/m/Y', strtotime($exibe['data_p']))."</p>
                                            </div>
                                            <img src='".$exibe['capa']."'>                                            
                                        </div>

                                        <div class='desc-noticia'>
                                            <p>".$exibe['conteudo']."</p>
                                        </div>
                                    </div>
                            </div><!--FIM DA DIV BREVE-VAGA -->";
                        }
                    ?>                 
                </div>    
                <!-- CONTEUDO LATERAL -->
            </div><!-- FIM DA DIV CONTRAINER-->
        </section>
    </main>


    <?php 
        require_once dirname(__DIR__) . "/_layout/rodape.php";
        require_once dirname(__DIR__) . '/_layout/scriptFooter.php';
    ?>
</body>

</html>