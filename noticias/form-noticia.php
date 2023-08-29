<?php 
    require_once '../_config/conx.php';
    require_once '../_config/data.php';
	
    if(isset($_POST['f_submit'])){

        $titulo = $_POST['f_titulo'];
        $conteudo = $_POST['f_conteudo'];

        $dir = '../_imgs/noticias';

        if(isset($_POST['f_capa']['name']))

            $arquivo = $_FILES['f_capa']['name'];

            $ex=strtolower(substr($_FILES['f_capa']['name'],-4));

            if($ex === '.jpeg' || $ex === '.jpg' || $ex === '.png' || $ex === '.gif'){
            
                $novo_nome=uniqid().$ex;
                $novo_arquivo = $dir.'/'.$novo_nome;

                move_uploaded_file($_FILES['f_capa']['tmp_name'],$dir.'/'.$novo_nome);

                $sql = "insert into tb_noticias(titulo, conteudo, capa) values('{$titulo}', '{$conteudo}', '{$novo_arquivo}')";

                mysqli_query($conn, $sql);

                $linhas = mysqli_affected_rows($conn);

                if($linhas >= 1){

                    Header("Location: noticias.php");
                
                }else{
                    echo "Dados não cadastrados, favor tentar novamente!";
                }
            }else{
                echo "
                <script>
                    alert('Extenção não valida!');
                </script>";
            }
    }   
?>

<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $titulo ?> - Nova noticia</title>
    <?php 
        require_once dirname(__DIR__) . '/_layout/head.php';
    ?>
</head>

<body>
    <header style="background-color: #000;">
        <?php 
            require_once '../_layout/cabecalho.php';
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
                            <input type='text' name='f_titulo' id='id_titulo'>

                            <label for='id_conteudo'>Contéudo*</label>
                            <textarea name='f_conteudo' id='id_conteudo' cols="15" rows="15"
                                required='required'></textarea>

                            <label for='id_capa'>Foto de Capa*</label>
                            <input type='file' name='f_capa' id='id_capa' required='required'>

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