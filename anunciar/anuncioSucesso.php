<?php
    ini_set('display_errors', 0);
    error_reporting(E_ALL);

    require_once '../_config/config.php';
    require_once '../_config/data.php';


    header("Cache-Control: no-cache, no-store, must-revalidate");


    $redirecionar = false;

    // Verificar se a variável de sessão "numLogin" está definida
    if (isset($_SESSION["numLogin"])) {
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
            
            // Evitar possíveis ataques de redirecionamento
            $redirectUrl = "$url/anunciar/anuncioSucesso.php?num=$numLogin&id=$username";
            $validatedUrl = filter_var($redirectUrl, FILTER_VALIDATE_URL);

            if ($validatedUrl !== false) {
                header("Location: $validatedUrl");
                exit();
            } else {
                // Tratar o redirecionamento inválido
                echo "Redirecionamento inválido.";
            }
        }
    }
?>


<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $titulo ?> - Sucesso</title>
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