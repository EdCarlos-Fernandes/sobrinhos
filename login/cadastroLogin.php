<?php
    ini_set('display_errors', 0);
    error_reporting(E_ALL);
    require_once '../_config/config.php';
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
            
            $redirectUrl = "$url/login/cadastroLogin.php?num=$numLogin&id=$username";
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
    <title><?php echo $titulo ?> - Cadastrar</title>
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
                <div class='anuncio-principal'>
                    
                    <h2>Faça seu Cadastro</h2>
                        
                        <div class='formulario form-cadastro-login'>
                            <form action='<?php echo $linkSite ?>/source/cadastroLoginExc.php' method='post'>
                                <label for='id_user'>Nome:</label>
                                <input type='text' name='f_user' id='id_user' required='required'>
                                <label for='id_sobreNome'>Sobrenome:</label>
                                <input type='text' name='f_sobreNome' id='id_sobreNome' required='required'>
                                <label for='id_nomeE'>Senha:</label>
                                <input type='text' name='f_passwrd' id='id_nomE' required='required'>
                                <label for='id_email_user'>Email:</label>
                                <input type='email' name='f_email_user'  id='id_email_user' required='required'>

                                <input type='submit' name='f_submit' value='Enviar'> 
                                <a class="btn-voltar" href="login_g.php"> Voltar Login</a>
                            </form>
                        </div>
                </div>
            </div>
        </section>
    </main>


    <?php 
        require_once dirname(__DIR__) . "/_layout/rodape.php";
        require_once dirname(__DIR__) . '/_layout/scriptFooter.php';
    ?>


    <?php
        if(isset($_GET['sucess']) == 'error'){
            echo "<script src='https://unpkg.com/sweetalert/dist/sweetalert.min.js'></script>
            <script>
            swal('Error', 'O email já existe, favor tente novamente!', 'error');
            </script>";
        }

        if(isset($_GET['errorU']) == 'errorU'){
            echo "<script src='https://unpkg.com/sweetalert/dist/sweetalert.min.js'></script>
            <script>
            swal('Error', 'Não foi possível resetar senha!', 'error');
            </script>";
        }
    ?>
</body>

</html>