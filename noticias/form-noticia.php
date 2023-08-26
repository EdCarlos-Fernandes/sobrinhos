<?php 
    ini_set('display_errors', 1);
    error_reporting(E_ALL);
    require_once '../_config/config.php';
    require_once '../_config/data.php';
    require_once '../_config/conx.php';

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


    date_default_timezone_set('America/Sao_Paulo');

    if(isset($_POST['f_submit'])){

        $titulo = $_POST['f_titulo'];
        $conteudo = $_POST['f_conteudo'];

        $dir = "$linkSite/_imgs/noticias";

        if(isset($_FILES['f_capa']['name'])) {

            $arquivo = $_FILES['f_capa']['name'];

            $ex = strtolower(substr($_FILES['f_capa']['name'], -4));

            if($ex === '.jpeg' || $ex === '.jpg' || $ex === '.png' || $ex === '.gif'){
            
                $novo_nome = uniqid() . $ex;
                $novo_arquivo = $dir . '/' . $novo_nome;

                if(move_uploaded_file($_FILES['f_capa']['tmp_name'], $novo_arquivo)) {

                    $data_postagem = date('Y-m-d H:i:s'); // Obtém a data e hora atuais

                    $sql = "INSERT INTO tb_noticias (titulo, conteudo, data_p, capa) VALUES (?, ?, ?, ?)";
                    $stmt = mysqli_prepare($conn, $sql);

                    mysqli_stmt_bind_param($stmt, 'ssss', $titulo, $conteudo, $data_postagem, $novo_arquivo);

                    if(mysqli_stmt_execute($stmt)){
                        Header("Location: $linkSite/noticias/noticias.php");
                    } else {
                        echo "Dados não cadastrados, favor tentar novamente!";
                    }

                    mysqli_stmt_close($stmt);
                } else {
                    echo "Erro ao fazer o upload da imagem.";
                }
            } else {
                echo "<script>
                        alert('Extensão não válida!')
                    </script>";
            }
        }
    }   
?>
<?php 
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
                    
                    <h2>Postar Notícia</h2>

                        <div class='formulario'>
                            <form action='form-noticia.php' method='post' enctype='multipart/form-data'>
                                <label for='id_titulo'>Titulo*</label>
                                <input type='text' name='f_titulo' id='id_titulo' >
                                <label for='id_conteudo'>Contéudo*</label>
                                <textarea name='f_conteudo' id='id_conteudo' cols="15" rows="15" required='required'></textarea>
                                <label for='id_capa'>Foto de Capa*</label>
                                <input type='file' name='f_capa'  id='id_capa' required='required'>    
                                <input type='submit' name='f_submit' value='Enviar'> 
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
</body>

</html>