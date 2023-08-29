<?php
    ini_set('display_errors', 0);
    error_reporting(E_ALL);
    require_once '../_config/config.php';
    require_once '../_config/data.php';

    header("Cache-Control: no-cache, no-store, must-revalidate");

    // Variável para controlar o redirecionamento
    $redirecionar = false;

    // Verifica se a variável de sessão "numLogin" está definida
    if (isset($_SESSION["numLogin"])) {
        // Valida e filtra o parâmetro "num"
        $n1 = filter_input(INPUT_GET, "num", FILTER_SANITIZE_STRING);
        $n2 = $_SESSION["numLogin"];

        if ($n1 !== $n2) {
            $redirecionar = true;
        }
    }

    // Redirecionamento se necessário
    if ($redirecionar) {
        // Verifica se as variáveis de sessão estão definidas antes de usá-las nos parâmetros
        if (isset($_SESSION['numLogin']) && isset($_SESSION['username'])) {
            // Escapa as variáveis de saída para prevenir XSS
            $numLogin = htmlspecialchars($_SESSION['numLogin'], ENT_QUOTES, 'UTF-8');
            $username = htmlspecialchars($_SESSION['username'], ENT_QUOTES, 'UTF-8');
            
            $redirectUrl = "$url/noticias/noticias.php?num=$numLogin&id=$username";
            header("Location: $redirectUrl");
            exit();
        }
    }
?>

<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $titulo ?> - Noticias</title>
    <?php 
        require_once dirname(__DIR__) . '/_layout/head.php';
    ?>
</head>

<body>
    <header style="background-color: #000;">
        <?php 
            require_once dirname(__DIR__) . '/_layout/cabecalho.php';
        ?>
    </header>


    <main class="container-fluid page-body-wrapper d-flex flex-column" style="padding-top: 50px;">
        <!--CONTEUDO -->
        <section class='conteudo'>

            <div class='container'>

                <div class='anuncio-principal'>
                    <!--BANER -->
                    <div class='banner-contato-2'>
                        <img src="_imgs/rascunho/baner-principal.png">
                    </div>

                    <h2>Noticias mais Recentes</h2>
                    <div class="wrap-title"></div>

                    <?php 
                    //INICIO PAGINAÇÃO E EXIBIÇÃO DOS ANUNCIOS
                    
                    require_once "../_config/conx.php";
                    require_once "../_function/functionTexto.php";
    
                    define('RANGE_PAGINAS', 1);
    
                    //Obtendo a pagina vinda da URL
                    $pagina_atual = filter_input(INPUT_GET, 'page', FILTER_SANITIZE_NUMBER_INT);
                    //Se tiver vazia seta o 1
                    $pagina = (!empty($pagina_atual)) ? $pagina_atual : 1;
                    //Quantidade de itens
                    $qtd_item = 5;
    
                    $inicio = ($pagina -1) * $qtd_item;
                    
                    $sql = "SELECT * FROM tb_noticias ORDER BY data_p DESC LIMIT $inicio, $qtd_item";
                    
                    $result = mysqli_query($conn, $sql);

                    while($exibe = mysqli_fetch_array($result)){

                        if(!isset($_SESSION['numLogin'])){
                            
                            echo "<div class='breve-vaga1'>";

                                echo "
                                <div class='img-vaga'>

                                    <a href='noticia-em-destaque.php?id=".$exibe['id']."'><img src=".$exibe['capa']."></a>

                                </div>
                                <div class='desc-vaga'>
                                    <h3 class='titulo_vaga'><a href='#'>".ucwords($exibe['titulo'])."</a></h3>
                                    <p><b>Data da postagem: </b>".date("d/m/Y", strtotime($exibe['data_p']))."</p>
                                    <p><b>Descrição:</b> ".reduzindoTexto($exibe['conteudo'])." ...</p>
                                    <p><a href='noticia-em-destaque.php?id=".$exibe['id']."'>Ver mais</a></p>
                                </div>
                                <div class='clear'></div>
                            </div><!--FIM DA DIV BREVE-VAGA -->";

                        }else{

                            echo "<div class='breve-vaga1'>";

                                echo "
                                <div class='img-vaga'>
                                    <a href='noticia-em-destaque.php?num=".$_SESSION['numLogin']."&id=".$exibe['id']."'><img src=".$exibe['capa']."></a>

                                </div>
                                <div class='desc-vaga'>
                                    <h3 class='titulo_vaga'><a href='#'>".ucwords($exibe['titulo'])."</a></h3>
                                    <p><b>Data da postagem: </b>".date("d/m/Y", strtotime($exibe['data_p']))."</p>
                                    <p><b>Descrição:</b> ".reduzindoTexto($exibe['conteudo'])." ...</p>
                                    <p><a href='noticia-em-destaque.php?num=".$_SESSION['numLogin']."&id=".$exibe['id']."'>Ver mais</a></p>
                                </div>
                                <div class='clear'></div>
                            </div><!--FIM DA DIV BREVE-VAGA -->";

                        }
                    }
                    echo "<div class='paginacao'>";
                    //Contando quantos resultados tem na tabela
                    $result_pg = "SELECT COUNT(id) AS num_result FROM tb_noticias";
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
                      
                         echo " <a class='$exibir_botao_inicio' href='noticias.php?page=$primeira_pagina' title='Primeira Página'>Primeira</a>    
                         <a class='$exibir_botao_inicio' href='noticias.php?page=$pag_ant' title='Página Anterior'>Anterior</a>";
                     }else{
                        
                         echo "<a class='$exibir_botao_inicio' href='noticias.php?num=".$_SESSION['numLogin']."&page=$primeira_pagina' title='Primeira Página'>Primeira</a>    
                         <a class='$exibir_botao_inicio' href='noticias.php?num=".$_SESSION['numLogin']."&page=$pag_ant' title='Página Anterior'>Anterior</a>";
                     }
 
                     /* Loop para montar a páginação central com os números */   
                     for ($i=$range_inicial; $i <= $range_final; $i++){
 
                         $destaque = ($i == $pagina) ? 'destaque' : ' ' ;  
                         
                         if(!isset($_SESSION['numLogin'])){
                        
                             echo "<a class='num_pg $destaque' href='noticias.php?page=$i'>$i</a>";
                         
                         }else{
     
                             echo "<a class='num_pg $destaque' href='noticias.php?num=".$_SESSION['numLogin']."&page=$i'>$i</a>";
                         }
  
                     }
 
                     if(!isset($_SESSION['numLogin'])){
                        
                         echo " <a class='$exibir_botao_final' href='noticias.php?page=$pag_prox' title='Próxima Página'>Próxima</a>    
                         <a class='$exibir_botao_final' href='noticias.php?page=$qtd_pg' title='Última Página'>Último</a>";
                     
                     }else{
 
                         echo " <a class='$exibir_botao_final' href='noticias.php?num=".$_SESSION['numLogin']."&page=$pag_prox' title='Próxima Página'>Próxima</a>    
                         <a class='$exibir_botao_final' href='noticias.php?num=".$_SESSION['numLogin']."&page=$qtd_pg' title='Última Página'>Último</a>";
                  
                     }
 
                    echo "</div>";
                    ?>

                </div>
            </div><!-- FIM DA DIV CONTRAINER-->
        </section>
    </main>


    <?php 
        require_once dirname(__DIR__) . "/_layout/rodape.php";
        require_once dirname(__DIR__) . '/_layout/scriptFooter.php';
    ?>
</body>

</html>