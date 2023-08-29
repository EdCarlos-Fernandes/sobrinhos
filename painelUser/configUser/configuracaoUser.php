<?php 
    ini_set('display_errors', 1);
    error_reporting(E_ALL);
    include('../../_config/config.php');
    include('../../_config/conx.php');
    include('../../_config/data.php');

    if(isset($_SESSION["numLogin"])){
        // Escapa as variáveis de saída para prevenir XSS
        $numLogin = htmlspecialchars($_SESSION['numLogin'], ENT_QUOTES, 'UTF-8');
        $username = htmlspecialchars($_SESSION['username'], ENT_QUOTES, 'UTF-8');

        if(isset($_POST['f_submit'])){
            $dir = '../../_imgs/users';

            if(isset($_FILES['f_perfil'])){
                $arquivo = $_FILES['f_perfil']['name'];
                $ex = strtolower(substr($arquivo, -4));

                if($ex === '.jpg'){
                    $nomeUsuario = $_SESSION['userid'];
                    $novo_nome = $nomeUsuario . $ex;
                    $idUsuario = $_SESSION['userid'];
                    $usuarioFolder = $dir . '/' . $idUsuario . '/perfil';

                    if (!file_exists($usuarioFolder)) {
                        if (mkdir($usuarioFolder, 0755, true)) {
                            // Pasta criada com sucesso
                        } else {
                            echo "Erro ao criar a pasta do usuário!";
                            exit();
                        }
                    }

                    $novo_arquivo = $usuarioFolder . '/' . $novo_nome;

                    if (move_uploaded_file($_FILES['f_perfil']['tmp_name'], $novo_arquivo)) {
                        // Arquivo movido com sucesso
                    } else {
                        echo "Erro ao mover a imagem para a pasta do usuário!";
                        exit();
                    }

                    $imagemRelativa = $dir . '/' . $idUsuario . '/perfil/' . $novo_nome;

                    $sql = "UPDATE tb_usuario SET img_perfil = '{$imagemRelativa}' WHERE id = $idUsuario LIMIT 1";
                    
                    mysqli_query($conn, $sql);
                    
                    $linhas = mysqli_affected_rows($conn);
                        
                    if ($linhas >= 1) {
                        
                    } else {
                        header("Location: configuracaoUser.php?num=$numLogin&id=$username&sucess=success");
                        exit();
                    }
                    
                } else {
                    header("Location: configuracaoUser.php?num=$numLogin&id=$username&sucess=error");
                    exit();
                }
            }
        }
    } else {
        header("Location: $linkSite/index.php");
        exit();
    }
?>

<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $titulo ?> - Configurações do usuário</title>
    <?php 
        include('../../_layout/head.php');
    ?>
    <style>
        #imagem-preview {
            margin-top: 10px;
            max-width: 300px;
            max-height: 300px;
        }

        #imagem-preview img {
            max-width: 100%;
            max-height: 100%;
            border: 1px solid #ccc;
        }
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
            include('../../_layout/cabecalho.php');
        ?>
    </header>

    <main class="container-fluid page-body-wrapper d-flex flex-column" style="padding-top: 50px;">
        <section class='conteudo' style="padding-top: 200px;">
            <div class='container'>
                <div class='anuncio-principal'>
                    <div class='formulario'>
                        <div id='imagem-preview'></div>
                        <form action='configuracaoUser.php' method='post' enctype='multipart/form-data'>
                            <label for='id_perfil'>Foto de perfil*</label>
                            <input type='file' name='f_perfil' id='id_perfil' required='required' onchange='previewImage(this)'>
                            <input type='submit' name='f_submit' value='Enviar'>
                        </form>
                    </div>
                </div>
            </div>
        </section>
    </main>



    <?php 
        include('../../_layout/rodape.php');
        include('../../_layout//scriptFooter.php');
    ?>

    <?php
        $mensagemScript = '';
        
        if (isset($_GET['sucess'])) {
            if ($_GET['sucess'] === 'config') {
                $mensagemScript = "
                <script src='//cdn.jsdelivr.net/npm/sweetalert2@11'></script>
                <script>
                Swal.fire({
                    position: 'center',
                    icon: 'info',
                    title: 'Faça suas configurações',
                    showConfirmButton: false,
                    timer: 1500
                });
                </script>
                ";
            } else if ($_GET['sucess'] === 'success') {
                $mensagemScript = "
                <script src='//cdn.jsdelivr.net/npm/sweetalert2@11'></script>
                <script>
                Swal.fire({
                    position: 'center',
                    icon: 'success',
                    title: 'Imagem salva com sucesso!',
                    showConfirmButton: true,
                    timer: 9999
                });
                </script>
                ";
            } else if ($_GET['sucess'] === 'error') {
                $mensagemScript = "
                <script src='//cdn.jsdelivr.net/npm/sweetalert2@11'></script>
                <script>
                Swal.fire({
                    position: 'center',
                    icon: 'error',
                    title: 'Extensão inválida! Utilize apenas .jpg',
                    showConfirmButton: true,
                    timer: 9999
                });
                </script>
                ";
            }
        }
        
        echo $mensagemScript;
    ?>

    
    <script>
        function previewImage(input) {
            var imagemPreview = document.getElementById('imagem-preview');
            imagemPreview.innerHTML = '';
    
            if (input.files && input.files[0]) {
                var reader = new FileReader();
    
                reader.onload = function(e) {
                    var img = document.createElement('img');
                    img.src = e.target.result;
                    imagemPreview.appendChild(img);
                };
    
                reader.readAsDataURL(input.files[0]);
            }
        }
    </script>
</body>
</html>
