<?php
    ini_set('display_errors', 0); // Não exibir erros na saída
    error_reporting(E_ALL); // Reportar todos os tipos de erro

    require_once '../_config/config.php';
    require_once '../_config/conx.php';
    require_once '../_config/data.php';

    // Configuração do fuso horário
    date_default_timezone_set('America/Sao_Paulo');

    // Verificar se o ID foi fornecido via GET
    if (isset($_GET['id']) && is_numeric($_GET['id'])) {
        $id = intval($_GET['id']);
        
        // Verificar autenticação do usuário
        if (isset($_SESSION["numLogin"])) {
            $n1 = isset($_GET["num"]) ? $_GET["num"] : (isset($_POST["num"]) ? $_POST["num"] : null);
            $n2 = $_SESSION["numLogin"];
            
            if ($n1 !== $n2) {
                header("Location: $linkSite/anunciar/anuncio-vaga.php?id=$id");
                exit();
            }
        }

        // Recuperar informações do banco de dados
        $sql = "SELECT * FROM tb_cadastro WHERE id=?";
        $stmt = mysqli_prepare($conn, $sql);
        mysqli_stmt_bind_param($stmt, "i", $id);
        mysqli_stmt_execute($stmt);
        $result = mysqli_stmt_get_result($stmt);

        if ($result && mysqli_num_rows($result) > 0) {
            $exibe = mysqli_fetch_assoc($result);
        } else {
            // Tratar se o registro não for encontrado
            echo "<script>alert('O registro não foi encontrado.'); window.location.href = '$linkSite/index.php';</script>";
            exit();
        }
    } else {
        // Tratar caso o ID não seja válido
        echo "<script>alert('ID inválido.'); window.location.href = '$linkSite/index.php';</script>";
        exit();
    }
?>


<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $titulo ?> - Anúncio Vaga</title>
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
                    <?php 
                        $id = $_GET['id'];

                        $sql = "SELECT * FROM tb_cadastro WHERE id={$id}";
                        
                        $result = mysqli_query($conn, $sql);

                        if($exibe = mysqli_fetch_array($result)){

                            $exibeVaga = $exibe['nome_V'];

                            echo "<div class='descricao-vaga'>
                                    <div class='titulo-vaga'>";
                                        if(!isset($_SESSION['numLogin'])){
                                            echo "<a href='$linkSite/index.php'>Home</a>-<a href='$linkSite/vagas/vagas.php'>Vagas</a>-<a href='#'>".ucwords($exibe['nome_V'])."</a>
                                            <h3>Vagas para <span itemprop='name'>".ucwords($exibe['nome_V'])."</span></h3>";
                                            
                                        }else{
                                            echo "<a href='$linkSite/index.php?num=".$_SESSION['numLogin']."'>Home</a>-<a href='$linkSite/vagas/vagas.php?num=".$_SESSION['numLogin']."'>".ucwords(str_replace("_"," ",$exibe['tipo_V']))."</a>-<a href='#'>".ucwords($exibe['nome_V'])."</a>
                                            <h3>Vagas para ".ucwords($exibe['nome_V'])."</h3>";

                                        }

                                        echo "<div class='data-icone'>
                                        <svg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 16 16' width='13' height='13'><path fill-rule='evenodd' d='M1.643 3.143L.427 1.927A.25.25 0 000 2.104V5.75c0 .138.112.25.25.25h3.646a.25.25 0 00.177-.427L2.715 4.215a6.5 6.5 0 11-1.18 4.458.75.75 0 10-1.493.154 8.001 8.001 0 101.6-5.684zM7.75 4a.75.75 0 01.75.75v2.992l2.028.812a.75.75 0 01-.557 1.392l-2.5-1A.75.75 0 017 8.25v-3.5A.75.75 0 017.75 4z'></path></svg>
                                            <p>Data da publicação: ".date('d/m/Y', strtotime($exibe['data_C']))."</p>
                                        </div>
                                        
                                        <div class='tipo-icone'>
                                        <svg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 16 16' width='13' height='13'><path fill-rule='evenodd' d='M6.75 0A1.75 1.75 0 005 1.75V3H1.75A1.75 1.75 0 000 4.75v8.5C0 14.216.784 15 1.75 15h12.5A1.75 1.75 0 0016 13.25v-8.5A1.75 1.75 0 0014.25 3H11V1.75A1.75 1.75 0 009.25 0h-2.5zM9.5 3V1.75a.25.25 0 00-.25-.25h-2.5a.25.25 0 00-.25.25V3h3zM5 4.5H1.75a.25.25 0 00-.25.25V6a2 2 0 002 2h9a2 2 0 002-2V4.75a.25.25 0 00-.25-.25H5zm-1.5 5a3.484 3.484 0 01-2-.627v4.377c0 .138.112.25.25.25h12.5a.25.25 0 00.25-.25V8.873a3.484 3.484 0 01-2 .627h-9z'></path></svg>
                                            <p>Tipo de vaga: ".ucwords(str_replace("_"," ",$exibe['tipo_V']))."</p>
                                        </div>
                                    </div>

                                    <div class='detalhe-vaga'>
                                        <p><b>Empresa: </b><span class='dados'>".ucwords($exibe['nome_E'])."</span></p>
                                        <p><b>Quantidade de vagas: </b><span class='dados'> ".$exibe['qtd_V']."</span></p>
                                        <p><b>Localidade:</b> <span class='dados'>".ucwords($exibe['local_T'])."</span></p>
                                        <p><b>Carga Horária: </b> <span class='dados'>".$exibe['carga_H']."</span></p>
                                        <p><b>Sálario e Beneficios:</b><span class='dados'>".ucwords($exibe['salario_B'])."</span></p>
                                        <p><b>Tipo de Vaga: </b><span class='dados'>".str_replace("_"," ",$exibe['tipo_V'])."</span></p>
                                        <p class='requisitos'><b>Requisitos: </b><span class='dados'> ".$exibe['requisitos']."<span></p>
                                        <p class='desc'><b>Descrição:</b> <span class='dados'>".$exibe['descricao']."</span></p>
                                        
                                        <div class='candidatar'>
                                            <h3>Para se candidatar: </h3>

                                            <p>Para se candidatar a vaga você precisa está dentro dos requisitos exigidos informado a cima, e mandar email para <span>".$exibe['email']."</span> com assunto ''".$exibe['nome_V']."''.É imprescindével colocar no email ''Essa vaga foi divulgada pela $titulo com o intuito de me ajudar a entrar no mercado de Trabalho''.</p>

                                            <h4>A vaga se encerra em : ".$exibe['periodo_V']."</h4>

                                            <p>Nós da <b>$titulo</b> apenas divulgamos as vagas, não temos vinculo nenhum com o contratante, será de total responsabilidade do candidato a seguir no processo seletivo da vaga.</p>
                                        </div>
                                    </div>
                            </div><!--FIM DA DIV BREVE-VAGA -->";
                        }
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