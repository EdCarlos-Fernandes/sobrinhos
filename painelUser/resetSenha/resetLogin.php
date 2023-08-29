<?php 
    ini_set('display_errors', 1);
    error_reporting(E_ALL);
    require_once '../../_config/config.php';
    require_once "../../_config/conx.php";
    require_once '../../_config/data.php';

    header("Cache-Control: no-cache, no-store, must-revalidate");

    $redirecionar = false;

    if(isset($_SESSION["numLogin"])){
        // Escapa as variáveis de saída para prevenir XSS
        $numLogin = htmlspecialchars($_SESSION['numLogin'], ENT_QUOTES, 'UTF-8');
        $username = htmlspecialchars($_SESSION['username'], ENT_QUOTES, 'UTF-8');

        // Obter dados do formulário
        if(isset($_POST['f_submit'])){
            $newPasswr = trim($_POST['f_passw']); // Nova senha não filtrada
            $passward = trim($_POST['f_passw_res']); // Confirmação de senha não filtrada
            $email = trim(filter_var($_POST['f_email_user'], FILTER_VALIDATE_EMAIL)); 

            if($newPasswr != $passward){
                Header("Location: $linkSite/painelUser/resetSenha/resetLogin.php?num=$numLogin&id=$username&errorS=errorS");
                exit();
            }else{
                // Hash da nova senha
                $hashedPassword = password_hash($newPasswr, PASSWORD_BCRYPT);

                $sql = "SELECT * FROM tb_usuario WHERE email_user = ?";
                $stmt = mysqli_prepare($conn, $sql);
                mysqli_stmt_bind_param($stmt, "s", $email);
                mysqli_stmt_execute($stmt);
                $result = mysqli_stmt_get_result($stmt);
                $reslt = mysqli_num_rows($result);

                if($reslt >= 1){
                    $updateSql = "UPDATE tb_usuario SET password_user = ? WHERE email_user = ?";
                    $updateStmt = mysqli_prepare($conn, $updateSql);
                    mysqli_stmt_bind_param($updateStmt, "ss", $hashedPassword, $email);
                    mysqli_stmt_execute($updateStmt);
                    $updatedRows = mysqli_stmt_affected_rows($updateStmt);

                    if($updatedRows >= 1){
                        Header("Location: $linkSite/painelUser/resetSenha/resetLogin.php?num=$numLogin&id=$username&errorY=errorY");
                        exit();
                    }else{
                        Header("Location: $linkSite/painelUser/resetSenha/resetLogin.php?num=$numLogin&id=$username&errorU=errorU");
                        exit();
                    }

                    mysqli_stmt_close($updateStmt);
                }else{
                    Header("Location: $linkSite/painelUser/resetSenha/resetLogin.php?num=$numLogin&id=$username&errorE=errorEmail");
                    exit();
                }

                mysqli_stmt_close($stmt);
            }
        }
        
    } else if(!isset($_SESSION["numLogin"])){
        header("Location: $url/index.php");
        exit();
    }
?>

<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $titulo ?> - Alterar senha</title>
    <?php 
        require_once dirname(dirname(__DIR__)) . '/_layout/head.php';
    ?>
</head>

<body>
    <header style="background-color: #000;">
        <?php 
            require_once dirname(dirname(__DIR__)) . '/_layout/cabecalho.php';
        ?>
    </header>


    <main class="container-fluid page-body-wrapper d-flex flex-column" style="padding-top: 50px;">
        <section class='conteudo'>
            <div class='container'>
                <div class='anuncio-principal'>
                    
                    <h2>Redefinir Senha: </h2>
                        
                        <div class='formulario form-cadastro-login'>
                            <form action='resetLogin.php' method='post'>
                                <label for='id_user'>Nova Senha:</label>
                                <input type='text' name='f_passw' id='id_user' required='required'>

                                <label for='id_nomeE'>Comfirmar Senha:</label>
                                <input type='text' name='f_passw_res' id='id_nomE' required='required'>
                                    
                                <label for='id_email_user'>Esse é seu Email:</label>
                                <input type='email' name='f_email_user' id='id_email_user' required='required' value="<?php echo $_SESSION['email']; ?>" readonly>

                                <input type='submit' name='f_submit' value='Enviar'> 
                                <a class="btn-voltar" href="login_g.php"> Voltar Login</a>
                            </form>
                        </div>
                </div>
            </div>
        </section>
    </main>


    <?php 
        require_once dirname(dirname(__DIR__)) . "/_layout/rodape.php";
        require_once dirname(dirname(__DIR__)) . '/_layout/scriptFooter.php';
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
        if(isset($_GET['errorY']) == 'errorY'){
            echo "<script src='https://unpkg.com/sweetalert/dist/sweetalert.min.js'></script>
            <script>
            swal('Alteração realizada com sucesso!', 'sucesso!', 'success');
            </script>";
        }
    ?>
</body>

</html>