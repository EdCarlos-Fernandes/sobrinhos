<?php 
    require_once '../_config/conx.php';
    require_once '../_config/data.php';

    if(isset($_POST['f_submit'])){

        $email = $_POST['f_email_user'];
        $password = $_POST['f_senha'];
        $sql = "SELECT * FROM tb_usuario WHERE email_user = '$email' AND password_user = '$password'";
        $query = mysqli_query($conn, $sql);//Executa a query
        $res = mysqli_fetch_array($query);//Transforma as quary em um array

        if($res == 0){//Verifica se a query obteve resultado
            
            Header("Location: $linkSite/login/login_g.php?sucess=warning");
            exit();
            
        }else{

            $chave1 = "abcdefghijklmnopqrstuvxwz";
            $chave2 = "ABCDEFGHIJLKMNOPQSRTUVXYZ";
            $chave3 = "0123456789";
            $chave = str_shuffle($chave1.$chave2.$chave3);

            $tam = strlen($chave);
            $num = "";

            $qtde=rand(20, 50);

            for($i = 0; $i<$qtde; $i++){
                $pos = rand(0, $tam);
                $num.=substr($chave, $pos, 1);
            }
            
            session_start();
            $_SESSION['numLogin'] = $num;
            $_SESSION['email'] = $email;
            $_SESSION['username'] = $res['nome_user'];
            $_SESSION['acesso'] = $res['acesso'];
        
            // Redirecionamento com o nome de usuário após o número
            header("Location: $linkSite/index.php?num=$num&id=$res[nome_user]");
        }
    }
    mysqli_close($conn);
?>

<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $titulo ?> - INICIO</title>
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
            require_once dirname(__DIR__) . '/_layout/cabecalho.php';
            require_once dirname(__DIR__) . '/_layout/head.php';
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
                                    <p><a href="resetLogin.php">Esqueceu a senha?</a></p>
                                </div>    
                                
                                <input type='submit' name='f_submit' value='Logar'> 
                            </form>
                        </div>
                </div><!--FIM DA DIV ANUNCIAR VAGAS-->
            </div>
        </section>
    </main>


    <?php 
        require_once dirname(__DIR__) . "/_layout/rodape.php";
        require_once dirname(__DIR__) . '/_layout/scriptFooter.php';
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