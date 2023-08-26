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
                <div class='anuncio-principal'>
                    
                    <h2>Redefinir Senha: </h2>
                        
                        <div class='formulario form-cadastro-login'>
                            <form action='<?php echo $linkSite ?>/source/resetLoginExc.php' method='post'>
                                <label for='id_user'>Nova Senha:</label>
                                <input type='text' name='f_passw' id='id_user' required='required'>

                                <label for='id_nomeE'>Comfirmar Senha:</label>
                                <input type='text' name='f_passw_res' id='id_nomE' required='required'>
                                    
                                <label for='id_email_user'>Informe seu Email:</label>
                                <input type='email' name='f_email_user'  id='id_email_user' required='required'>

                                <input type='submit' name='f_submit' value='Enviar'> 
                                <a class="btn-voltar" href="login_g.php"> Voltar Login</a>
                            </form>
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

    <?php
        if(isset($_GET['errorS']) == 'errorS'){
            echo "<script src='https://unpkg.com/sweetalert/dist/sweetalert.min.js'></script>
            <script>
            swal('Error', 'As senhas são diferentes, favor tentar novamente!', 'error');
            </script>";
        }
        if(isset($_GET['errorE']) == 'errorEmail'){
            echo "<script src='https://unpkg.com/sweetalert/dist/sweetalert.min.js'></script>
            <script>
            swal('Error', 'O email informado não existe!', 'error');
            </script>";
        }
        if(isset($_GET['errorU']) == 'errorU'){
            echo "<script src='https://unpkg.com/sweetalert/dist/sweetalert.min.js'></script>
            <script>
            swal('Error', 'Usuário não existe favor tentar novamente!', 'error');
            </script>";
        }
    ?>
</body>

</html>