<?php 
    ini_set('display_errors', 1);
    error_reporting(E_ALL);
    require_once './_config/config.php';
    require_once './_config/data.php';

    if(isset($_SESSION["numLogin"])){
        if(isset($_GET["num"])){
            $n1=$_GET["num"];
            
        }else if(isset($_POST["num"])){
            $n1=$_POST["num"];
        }
        
        $n2=$_SESSION["numLogin"];
        
        if($n1!=$n2){
            header("Location: $linkSite/index.php");
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
    <?php 
        require_once __DIR__ . '/_layout/head.php';
    ?>
</head>

<body>
    <header style="background-color: #000;">
        <?php 
            require_once __DIR__ . '/_layout/cabecalho.php';
        ?>
    </header>


    <main class="container-fluid page-body-wrapper" style="padding-top: 50px;">
    <!--CONTEUDO -->
    <section class='conteudo'>
        <div class='container'>
            <div class='anuncio-principal'>
                <h2>Vagas Recentes</h2>
                <div class="wrap-title"></div>
                
                <?php 
                //INICIO PAGINAÇÃO E EXIBIÇÃO DOS ANUNCIOS
                require_once __DIR__ . "/_config/conx.php";
                require_once __DIR__ . "/_function/functionTexto.php";

                define('RANGE_PAGINAS', 1);

                //Obtendo a pagina vinda da URL
                $pagina_atual = filter_input(INPUT_GET, 'page', FILTER_SANITIZE_NUMBER_INT);
                //Se tiver vazia seta o 1
                $pagina = (!empty($pagina_atual)) ? $pagina_atual : 1;
                //Quantidade de itens
                $qtd_item = 7;

                $inicio = ($pagina -1) * $qtd_item;
                
                $sql = "SELECT * FROM tb_cadastro ORDER BY data_C DESC LIMIT {$inicio}, {$qtd_item}";
                
                $result = mysqli_query($conn, $sql);

                while($exibe = mysqli_fetch_array($result)){

                echo "<div class='breve-vaga'>";

                    if($exibe['tipo_V'] == 'Emprego'){

                        if(!isset($_SESSION['numLogin'])){
                                                            
                        echo "<div class='img-vaga'>
                                <a href='$url/anunciar/anuncio-vaga.php?id=".$exibe['id']."'><img src='$url/_imgs/rascunho/vagas-emprego.jpg'></a>
                                </div>";

                        }else{

                            echo "<div class='img-vaga'>
                                    <a href='$url/anunciar/anuncio-vaga.php?num=".$_SESSION['numLogin']."&id=".$exibe['id']."'><img src='$url/_imgs/rascunho/vagas-emprego.jpg'></a>
                                    </div>";

                        }
                    
                    }elseif($exibe['tipo_V'] == 'Estagio'){

                        if(!isset($_SESSION['numLogin'])){

                            echo "
                                <div class='img-vaga'>
                                    <a href='$url/anunciar/anuncio-vaga.php?id=".$exibe['id']."'><img src='$url/_imgs/rascunho/vagas-estagio01.jpg'></a>
                                </div>";

                        }else{

                            echo "
                                <div class='img-vaga'>
                                    <a href='$url/anunciar/anuncio-vaga.php?num=".$_SESSION['numLogin']."&id=".$exibe['id']."'><img src='$url/_imgs/rascunho/vagas-estagio01.jpg'></a>
                                </div>";
                        }
                        
                    }elseif($exibe['tipo_V'] == 'Nivel_superior'){

                        if(!isset($_SESSION['numLogin'])){                                   
                            echo "
                            <div class='img-vaga'>
                                <a href='$url/anunciar/anuncio-vaga.php?id=".$exibe['id']."'><img src='$url/_imgs/rascunho/superior.jpg'></a>
                            </div>";
                        }else{
                            echo "
                            <div class='img-vaga'>
                                <a href='$url/anunciar/anuncio-vaga.php?num=".$_SESSION['numLogin']."&id=".$exibe['id']."'><img src='$url/_imgs/rascunho/superior.jpg'></a>
                            </div>";
                        }
                        
                    }
                    elseif($exibe['tipo_V'] == 'Diaria'){

                        if(!isset($_SESSION['numLogin'])){

                            echo "
                                <div class='img-vaga'>
                                    <a href='$url/anunciar/anuncio-vaga.php?id=".$exibe['id']."'><img src='$url/_imgs/rascunho/vagas-emprego.jpg'></a>
                                </div>";

                        }else{
                            echo "
                                <div class='img-vaga'>
                                    <a href='$url/anunciar/anuncio-vaga.php?num=".$_SESSION['numLogin']."&id=".$exibe['id']."'><img src='$url/_imgs/rascunho/vagas-emprego.jpg'></a>
                                </div>";
                        }                                   
                    }
                    
                    if(!isset($_SESSION['numLogin'])){

                    echo "
                        <div class='desc-vaga'>
                            <h3 class='titulo_vaga'><a href='$url/anunciar/anuncio-vaga.php?id=".$exibe['id']."'>".ucwords($exibe['nome_V'])."</a></h3>
                            <p><b>Localidade:</b> ".ucwords($exibe['local_T'])."</p>
                            <p><b>Beneficios:</b>".ucwords($exibe['salario_B'])."</p>
                            <p><b>Data da postagem: </b>".date("d/m/Y", strtotime($exibe['data_C']))."</p>
                            <p><a href='$url/anunciar/anuncio-vaga.php?id=".$exibe['id']."'>Ver mais</a></p>

                        </div>";

                    }else{

                    echo "
                        <div class='desc-vaga'>
                            <h3 class='titulo_vaga'><a href='$url/anunciar/anuncio-vaga.php?num=".$_SESSION['numLogin']."&id=".$exibe['id']."'>".ucfirst($exibe['nome_V'])."</a></h3>
                            <p><b>Localidade:</b> ".ucwords($exibe['local_T'])."</p>
                            <p><b>Beneficios:</b>".ucwords($exibe['salario_B'])."</p>
                            <p><b>Data da postagem: </b>".date("d/m/Y", strtotime($exibe['data_C']))."</p>
                            <p><a href='$url/anunciar/anuncio-vaga.php?num=".$_SESSION['numLogin']."&id=".$exibe['id']."'>Ver mais</a></p>

                        </div>";
                    }
                    echo "</div>";
                    //FIM DA DIV BREVE-VAGA
                    }
                    echo "<div class='paginacao'>";
                    //Contando quantos resultados tem na tabela
                    $result_pg = "SELECT COUNT(id) AS num_result FROM tb_cadastro";
                    
                    //Executando a query
                    $query = mysqli_query($conn, $result_pg);

                    //Transformando em array
                    $result = mysqli_fetch_assoc($query);

                    /* Idêntifica a primeira página */  
                    $primeira_pagina = 1; 

                    //Arredonadando a quantidade de paginas
                    $qtd_pg = ceil($result['num_result'] / $qtd_item);


                    /*Cálcula qual será a página anterior em relação a página atual em exibição*/
                    $pag_ant = ($pagina > 1) ? $pagina -1 : 0;

                    /*Cálcula qual será a pŕoxima página em relação a página atual em exibição*/
                    $pag_prox = ($pagina < $qtd_pg) ? $pagina +1 : 0;

                    /* Cálcula qual será a página inicial do nosso range */    
                    $range_inicial = (($pagina - RANGE_PAGINAS) >= 1) ? $pagina - RANGE_PAGINAS : 1 ;   
                    
                    /* Cálcula qual será a página final do nosso range */    
                    $range_final = (($pagina + RANGE_PAGINAS) <= $qtd_pg ) ? $pagina + RANGE_PAGINAS : $qtd_pg;  

                     /* Verifica se vai exibir o botão "Primeiro" e "Pŕoximo" */   
                    $exibir_botao_inicio = ($range_inicial < $pagina) ? 'mostrar' : 'esconder'; 

                    /* Verifica se vai exibir o botão "Anterior" e "Último" */   
                    $exibir_botao_final = ($range_final > $pagina) ? 'mostrar' : 'esconder';  

                    if(!isset($_SESSION['numLogin'])){
                    
                        echo " <a class='$exibir_botao_inicio' href='$url/index.php?page=$primeira_pagina' title='Primeira Página'>Primeira</a>    
                        <a class='$exibir_botao_inicio' href='$url/index.php?page=$pag_ant' title='Página Anterior'>Anterior</a>";
                    }else{
                    
                        echo "<a class='$exibir_botao_inicio' href='$url/index.php?num=".$_SESSION['numLogin']."&page=$primeira_pagina' title='Primeira Página'>Primeira</a>    
                        <a class='$exibir_botao_inicio' href='$url/index.php?num=".$_SESSION['numLogin']."&page=$pag_ant' title='Página Anterior'>Anterior</a>";
                    }


                    //Realizar Looping
                    /* Loop para montar a páginação central com os números */   
                    for ($i=$range_inicial; $i <= $range_final; $i++){

                        $destaque = ($i == $pagina) ? 'destaque' : ' ' ;  
                        
                        if(!isset($_SESSION['numLogin'])){
                    
                            echo "<a class='num_pg $destaque' href='$url/index.php?page=$i'>$i</a>";
                        
                        }else{
    
                            echo "<a class='num_pg $destaque' href='$url/index.php?num=".$_SESSION['numLogin']."&page=$i'>$i</a>";
                        }

                    }

                    if(!isset($_SESSION['numLogin'])){
                    
                        echo " <a class='$exibir_botao_final' href='$url/index.php?page=$pag_prox' title='Próxima Página'>Próxima</a>    
                        <a class='$exibir_botao_final' href='$url/index.php?page=$qtd_pg' title='Última Página'>Último</a>";
                    
                    }else{

                        echo " <a class='$exibir_botao_final' href='$url/index.php?num=".$_SESSION['numLogin']."&page=$pag_prox' title='Próxima Página'>Próxima</a>    
                        <a class='$exibir_botao_final' href='$url/index.php?num=".$_SESSION['numLogin']."&page=$qtd_pg' title='Última Página'>Último</a>";

                    }

                    
                    echo "</div>";
                
                ?>
            </div>
        </div><!-- FIM DA DIV CONTRAINER-->
    </section>
    </main>


    <?php 
        require_once __DIR__ . "/_layout/rodape.php";
        require_once __DIR__ . '/_layout/scriptFooter.php';
    ?>
</body>

</html>