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
        <!--CONTEUDO -->
        <section class='conteudo' style="padding-top: 200px;">
            
            <div class='container'>
                <div class='anuncio-principal'>
                <?php 

                require_once dirname(__DIR__) . "/_function/functionTexto.php";
                require_once dirname(__DIR__) . "/_config/conx.php";

                    if(isset($_POST['f_name'])){

                        echo "<h2>Vagas de ".ucwords($_POST['f_name'])."</h2>";

                        $nome_pesq = $_POST['f_name'];

                    }else if($_GET['f_name']){
                        
                        echo "<h2>Vagas de ".ucwords($_GET['f_name'])."</h2>";
                        $nome_pesq = $_GET['f_name'];
                    }
                    
                    //Obtendo a pagina vinda da URL
                    $pagina_atual = filter_input(INPUT_GET, 'pagina', FILTER_SANITIZE_NUMBER_INT);
                    //Se tiver vazia seta o 1
                    $pagina = (!empty($pagina_atual)) ? $pagina_atual : 1;
                    //Quantidade de itens
                    $qtd_item = 5;
                    
                    $inicio = ($qtd_item * $pagina) - $qtd_item;
                    
                    //Sql para seleciona tudo da tabela tb-cadastro onde nome da vaga tenha a variavel ordernar por data 
                    $sql = "SELECT * FROM tb_cadastro WHERE nome_V LIKE '%$nome_pesq%' ORDER BY data_C DESC LIMIT $inicio, $qtd_item";

                    $result = mysqli_query($conn, $sql);
                    
                    $resultado = mysqli_affected_rows($conn);

                    if(empty($resultado)){

                        echo "<p class='alerta-mensagem'>Não existe vagas com nome '".ucwords($nome_pesq)."'</p>";
                    
                    }

                    while($exibe = mysqli_fetch_array($result)){

                        
                        if(!isset($_SESSION['numLogin'])){

                            echo "<div class='breve-vaga'>
                            
                            <div class='img-vaga'>
                            <a href='$linkSite/anunciar/anuncio-vaga.php?id=".$exibe['id']."'><img src='$linkSite/_imgs/rascunho/vagas-emprego.jpg'></a>
                            </div>

                            <div class='desc-vaga'>
                                <h3><a href='$linkSite/anunciar/anuncio-vaga.php?id=".$exibe['id']."'>".$exibe['nome_V']."</a></h3>
                                <p><b>Localidade:</b> ".$exibe['nome_E']."</p>
                                <p><b>Beneficios:</b>".$exibe['salario_B']."</p>
                                <p><b>Descrição:</b> ".reduzindoTexto($exibe['descricao'])."...</p>
                                <p><a href='$linkSite/anunciar/anuncio-vaga.php?id=".$exibe['id']."'>Ver mais...</a></p>
                            </div>
                            </div><!--FIM DA DIV BREVE-VAGA -->";

                        }else{

                            echo "<div class='breve-vaga'>
                            
                            <div class='img-vaga'>
                            <a href='anuncio-vaga.php?num=".$_SESSION['numLogin']."&id=".$exibe['id']."'><img src='$linkSite/_imgs/rascunho/vagas-emprego.jpg'></a>
                            </div>

                            <div class='desc-vaga'>
                                <h3><a href='$linkSite/anunciar/anuncio-vaga.php?num=".$_SESSION['numLogin']."&id=".$exibe['id']."'>".$exibe['nome_V']."</a></h3>
                                <p><b>Localidade:</b> ".$exibe['nome_E']."</p>
                                <p><b>Beneficios:</b>".$exibe['salario_B']."</p>
                                <p><b>Descrição:</b> ".reduzindoTexto($exibe['descricao'])."...</p>
                                <p><a href='$linkSite/anunciar/anuncio-vaga.php?num=".$_SESSION['numLogin']."&id=".$exibe['id']."'>Ver mais...</a></p>
                            </div>
                            </div><!--FIM DA DIV BREVE-VAGA -->";

                        }
                        

                    
                    }   
                    echo "<div class='paginacao'>";
                    //Contando quantos resultados tem na tabela
                    $result_pg = "SELECT COUNT(id) AS num_result FROM tb_cadastro WHERE tipo_V = 'Emprego'";
                    //Executando a query
                    $query = mysqli_query($conn, $result_pg);
                    //Transformando em array
                    $result = mysqli_fetch_assoc($query);

                    //Arredonadando a quantidade de paginas
                    $qtd_pg = ceil($result['num_result'] / $qtd_item);

                    if(!isset($_SESSION['numLogin'])){
                        echo "<a class='pri_pg' href='$linkSite/paginas/pesquisa.php?pagina=1'>Primeira</a>";
                    }else{
                        echo "<a class='pri_pg' href='$linkSite/paginas/pesquisa.php?num=".$_SESSION['numLogin']."&pagina=1'>Primeira</a>";
                    }
                    
                    for($i = 1; $i <= $qtd_item; $i++){
            
                        if($qtd_pg > 1){

                            if(!isset($_SESSION['numLogin'])){

                                echo "<a class='num_pg' href='$linkSite/paginas/pesquisa.php?pagina=$i'>$i</a>";

                            }else{

                                echo "<a class='num_pg' href='$linkSite/paginas/pesquisa.php?num=".$_SESSION['numLogin']."&pagina=$i'>$i</a>";

                            }
            
                        }
                    }
                    if(!isset($_SESSION['numLogin'])){
                        echo "<a class='ult_pg' href='$linkSite/paginas/pesquisa.php?pagina=$qtd_pg'>Último</a>";
                    }else{
                        echo "<a class='ult_pg' href='$linkSite/paginas/pesquisa.php?num=".$_SESSION['numLogin']."&pagina=$qtd_pg'>Último</a>";
                    }
                    
                    echo "</div>";
                ?>

                </div>
            </div>
            <!-- FIM DA DIV CONTRAINER-->
        </section>
    </main>


    <?php 
        require_once dirname(__DIR__) . "/_layout/rodape.php";
        require_once dirname(__DIR__) . '/_layout/scriptFooter.php';
    ?>
</body>

</html>