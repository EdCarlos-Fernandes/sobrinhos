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
                <!--FIM DA DIV ANUNCIAR VAGAS-->
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