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
    <link rel="stylesheet" href="<?php echo $linkSite ?>/paginas/css/style.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.8.1/font/bootstrap-icons.css">
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
    <div class="hero overlay inner-page">
        <img src="<?php echo $linkSite ?>/paginas/images/blob.png" alt="" class="img-fluid blob">
        <div class="container">
            <div class="row align-items-center justify-content-center text-center pt-5">
                <div class="col-lg-6">
                    <h1 class="heading text-white mb-3">Sobre nós</h1>
                </div>
            </div>
        </div>
    </div>

    <div class="section sec-halfs py-0">
        <div class="half-content d-lg-flex align-items-stretch">
            <div class="img" style="background-image: url('<?php echo $linkSite ?>/paginas/images/img-1.jpg')">

            </div>
            <div class="text">
                <h2 class="heading mb-3">Navegando Rumo ao Sucesso com a Equipe <?php echo $titulo ?></h2>
                <p class="mb-5">Seja bem-vindo à plataforma que está revolucionando a forma como você conquista
                    oportunidades profissionais! Aqui na Equipe <?php echo $titulo ?>, nosso compromisso é conectar você
                    a um mar de possibilidades.</p>
                <p><a href="#" class="btn botao py-2" style="color: #17a7a8 !important;">Saiba mais</a></p>
            </div>
        </div>

        <div class="half-content d-lg-flex align-items-stretch">
            <div class="img order-md-2"
                style="background-image: url('<?php echo $linkSite ?>/paginas/images/img-3.jpg')">

            </div>
            <div class="text">
                <h2 class="heading mb-3">Alcançando Novas Alturas com a Equipe <?php echo $titulo ?></h2>
                <p class="mb-5">Na nossa jornada conjunta rumo ao sucesso, não há limites para o que você pode alcançar!
                    Na Equipe <?php echo $titulo ?>, estamos empenhados em impulsionar suas ambições. Através da nossa
                    plataforma, você não apenas conquista oportunidades profissionais, mas também amplia seus
                    horizontes.</p>
                <p><a href="#" class="btn botao py-2" style="color: #17a7a8 !important;">Saiba mais</a></p>
            </div>
        </div>
    </div>

    <div class="section sec-features">
        <div class="container">
            <div class="row g-5">
                <div class="col-12 col-sm-6 col-md-6 col-lg-4">
                    <div class="feature d-flex">
                        <img class='icone' src='<?php echo $linkSite ?>/_imgs/icone/money.png' alt='inicio'
                            style="width: 70px;height: 70px;margin-right: 20px;" />
                        <div>
                            <h3>Construa seu Caminho Financeiro</h3>
                            <p>Descubra um mundo de possibilidades financeiras conosco. Aqui na Equipe
                                <?php echo $titulo ?>, acreditamos no poder de construir uma base sólida para o seu
                                futuro econômico.</p>
                        </div>
                    </div>
                </div>
                <div class="col-12 col-sm-6 col-md-6 col-lg-4">
                    <div class="feature d-flex">
                        <img class='icone' src='<?php echo $linkSite ?>/_imgs/icone/tempo.png' alt='inicio'
                            style="width: 70px;height: 70px;margin-right: 20px;" />
                        <div>
                            <h3>Investindo no Amanhã</h3>
                            <p>Prepare-se para um futuro próspero investindo nas oportunidades certas. Na Equipe
                                <?php echo $titulo ?>, acreditamos que cada investimento é uma semente plantada para
                                colher resultados promissores.</p>
                        </div>
                    </div>
                </div>
                <div class="col-12 col-sm-6 col-md-6 col-lg-4">
                    <div class="feature d-flex">
                        <img class='icone' src='<?php echo $linkSite ?>/_imgs/icone/porcento.png' alt='inicio'
                            style="width: 70px;height: 70px;margin-right: 20px;" />
                        <div>
                            <h3>Construindo Futuros Responsáveis</h3>
                            <p>Na Equipe <?php echo $titulo ?>, acreditamos que a busca por empregos deve ser guiada por
                                uma consciência que vai além do presente. Somos mais do que um site de oportunidades
                                profissionais; somos defensores de carreiras sustentáveis.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <br />
        <hr />
        <div class="container">
            <div class="row mb-5">
                <div>
                    <h2 class="heading" style="color: aliceBlue;">Nosso Time</h2>
                    <p style="color: aliceBlue;">Por enquanto, sou o único membro da equipe, mas estamos abertos ao
                        apoio de outros programadores interessados em se juntar a nós. Iniciamos nossas atividades em
                        2023 com o propósito de criar um site que auxilie as pessoas a encontrar oportunidades para
                        ingressar no mercado de trabalho, visando proporcionar uma melhor qualidade de vida e contribuir
                        para a economia do Brasil. Caso tenha interesse em ser um colaborador entre em contato conosco
                        na página de <a href='<?php echo $linkSite ?>/paginas/contato.php' target="_blank"
                            style="color: #17a7a8;">CONTATO</a>.</p>
                </div>
            </div>

            <div class="row">
                <div class="col-lg-4 mb-4 text-center">
                    <img src="<?php echo $linkSite ?>/_imgs/users/1689685044093.jpg" alt="Image"
                        class="img-fluid w-50 rounded-circle mb-3">
                    <h5 class="text-black">Ed Fernandes</h5>
                    <p style="color: aliceBlue;">Olá pode me chamar de Ed, um programador front-end com conhecimentos em
                        HTML, CSS e JavaScript. Também estou estudando Bootstrap, Angular e SQL Server para aprimorar
                        minhas habilidades.</p>
                </div>
            </div>
        </div>
    </div>


    <div class="section">
        <div class="container">
            <div class="row justify-content-between">
                <div class="col-lg-7 mb-4 mb-lg-0">
                    <img src="images/img-3.jpg" alt="Image" class="img-fluid rounded
                        ">
                </div>
                <div class="col-lg-4 ps-lg-2">
                    <div class="mb-5">
                        <h2 class="text-black h4">Nossos Serviços</h2>
                        <p>As vagas que disponibilizamos são fornecidas diretamente pelos contratantes. Nós, da equipe
                            <?php echo $titulo ?>, oferecemos a plataforma como meio de divulgação dessas oportunidades,
                            sem qualquer vínculo direto conosco. Empregadores de diversas áreas podem anunciar suas
                            vagas no nosso site. Além disso, oferecemos artigos sobre COMO ELABORAR SEU CURRÍCULO de
                            maneira eficaz, visando aumentar as chances de seleção para entrevistas.</p>
                    </div>
                    <div class="d-flex mb-3 service-alt">
                        <div>
                            <span class="bi-wallet-fill me-4"></span>
                        </div>
                        <div>
                            <h3>Conexões Profissionais</h3>
                            <p>Na Equipe <?php echo $titulo ?>, estamos aqui para fazer as conexões que moldam o seu
                                futuro. As oportunidades que você encontra em nossa plataforma são diretamente
                                provenientes dos contratantes, oferecendo uma via direta para o emprego dos seus sonhos.
                            </p>
                        </div>
                    </div>

                    <div class="d-flex mb-3 service-alt">
                        <div>
                            <span class="bi-pie-chart-fill me-4"></span>
                        </div>
                        <div>
                            <h3>Alcance Seu Potencial</h3>
                            <p>Nossos artigos especializados visam aumentar suas chances de ser selecionado para
                                entrevistas, permitindo que você alcance seu pleno potencial profissional. </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    </main>


    <?php 
        require_once dirname(__DIR__) . "/_layout/rodape.php";
        require_once dirname(__DIR__) . '/_layout/scriptFooter.php';
    ?>
</body>

</html>