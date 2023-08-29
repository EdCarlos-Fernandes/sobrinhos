<?php 
include('../_config/conx.php');
include('../_config/data.php');

if(isset($_POST['f_submit'])){
    $email = $_POST['f_email_user'];
    $password = $_POST['f_senha'];

    // Preparar a consulta com declarações preparadas
    $sql = "SELECT * FROM tb_usuario WHERE email_user = ?";
    $stmt = mysqli_prepare($conn, $sql);
    mysqli_stmt_bind_param($stmt, "s", $email);
    mysqli_stmt_execute($stmt);
    $queryResult = mysqli_stmt_get_result($stmt);

    if($queryResult->num_rows === 0){//Verifica se a consulta obteve resultado
        Header("Location: $linkSite/login/login_g.php?sucess=warning");
        exit();
    }else{
        $user = mysqli_fetch_assoc($queryResult);

        // Verificar a senha usando password_verify
        if(password_verify($password, $user['password_user'])){
            $chave1 = "abcdefghijklmnopqrstuvxwz";
            $chave2 = "ABCDEFGHIJLKMNOPQSRTUVXYZ";
            $chave3 = "0123456789";
            $chave = str_shuffle($chave1.$chave2.$chave3);

            $tam = strlen($chave);
            $num = "";

            $qtde = rand(20, 50);

            for($i = 0; $i < $qtde; $i++){
                $pos = rand(0, $tam);
                $num .= substr($chave, $pos, 1);
            }

            session_start();
            $_SESSION['numLogin'] = $num;
            $_SESSION['email'] = $email;
            $_SESSION['userid'] = $user['id'];
            $_SESSION['username'] = $user['nome_user'];
            $_SESSION['acesso'] = $user['acesso'];
            $_SESSION['img_perfil'] = $user['img_perfil'];

            mysqli_stmt_close($stmt);
            mysqli_close($conn);

            header("Location: $linkSite/painelUser/dashboard.php?num=$num&id=$user[nome_user]");
            exit();
        } else {
            mysqli_stmt_close($stmt);
            mysqli_close($conn);

            Header("Location: $linkSite/login/login_g.php?sucess=warning");
            exit();
        }
    }
}
?>


<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $titulo ?> - Login</title>
    <?php 
        include('../_layout/head.php');
    ?>
    <style>
        .swal2-title {
            color: black !important;
        }
        .swal2-success-ring {
            border: .25em solid rgb(165, 220, 134) !important;
        }
    </style>
</head>

<body>
    <header style="background-color: #000;">
        <?php 
            include('../_layout/cabecalho.php');
        ?>
    </header>


    <main class="container-fluid page-body-wrapper d-flex flex-column" style="padding-top: 50px;">
        <section class='conteudo' style="padding-top: 200px;">
            
            <div class='container'>
            
                <div class='anuncio-principal'>
                    
                    <h2>Faça seu Login</h2>
                        
                        <div class='formulario form-login'>
                            <form action='login_g.php' method='post'>
                                <label for='id_email_user'>Email:</label>
                                <input type='email' name='f_email_user'  id='id_email_user' required='required'>
                                <label for='id_senha'>Senha:</label>
                                <input type='password' name='f_senha' id='id_senha' required='required'>
                                <div class="login_links">
                                    <p><a href="cadastroLogin.php">Cadastrar-se</a></p>
                                    <p><a href="forgot-password.php">Esqueceu a senha?</a></p>
                                </div>    
                                
                                <input type='submit' name='f_submit' value='Logar'> 
                            </form>
                        </div>
                </div>
            </div>
        </section>
    </main>


    <?php 
        include('../_layout/rodape.php');
        include('../_layout/scriptFooter.php');
    ?>

    <?php
        if($_GET['sucess'] === 'accept'){
            echo "
            <script src='//cdn.jsdelivr.net/npm/sweetalert2@11'></script>
            <script>
            Swal.fire({
                position: 'center',
                icon: 'success',
                title: 'Usuário cadastrado com sucesso!',
                showConfirmButton: true,
                timer: 1500
            })
            </script>
            ";
        }else if($_GET['sucess'] === 'warning'){
            echo "
            <script src='//cdn.jsdelivr.net/npm/sweetalert2@11'></script>
            <script>
            
            Swal.fire({
                position: 'center',
                icon: 'error',
                title: 'Email ou senha incorreto, tente novamente!',
                showConfirmButton: true,
                timer: 1500
            })
            </script>
            ";
        }else if($_GET['sucess'] === 'acceptRet'){
            echo "
            <script src='//cdn.jsdelivr.net/npm/sweetalert2@11'></script>
            <script>
            Swal.fire({
                position: 'center',
                icon: 'success',
                title: 'Senha Refefinida com Sucesso!',
                showConfirmButton: false,
                timer: 1500
            })
            </script>
            ";
        }else if($_GET['sucess'] == 'dados'){
            echo "
            <script src='//cdn.jsdelivr.net/npm/sweetalert2@11'></script>
            <script>
            Swal.fire({
                position: 'center',
                icon: 'info',
                title: 'Digite seu E-mail e Senha',
                showConfirmButton: true,
                timer: 9999
            })
            </script>
            ";
        }
    ?>
</body>

</html>