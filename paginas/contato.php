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
            
            $redirectUrl = "$url/paginas/contato.php?num=$numLogin&id=$username";
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
    <title><?php echo $titulo ?> - CONTATO</title>
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
        <!--CONTEUDO PRINCIPAL -->
        <section class='conteudo' style="padding-top: 200px;">
            <div class='container'>
                <div class='anuncio-principal'>                    
                    <div class='formulario-contato'>
                        <div class='mensagem'>
                        <p>Para entrar em contato com nossa equipe da <b><?php echo $titulo ?></b> basta nos enviar um E-mail preenchendo o formulário abaixo com seu nome, E-email, assunto e a mensagem. Responderemos em até 48horas no máximo, aceitamos sujeitões, elogios, reportar erros, dúvidas ou qualquer tipo de assunto realcionado a emprego, vagas ou ao site</p>
                        <p>Nós da <b><?php echo $titulo ?></b> estamos aqui para ajudar a população a conseguir um emprego e manter a econômia do Brasil</p>
                        </div>

                        <form  action='<?php echo $linkSite ?>/_config/email.php' class='formulario-contato1' method='post'>
                            <label for='id_nome'>Nome*</label>
                                <input type='text' name='f_nome' id='id_nome' required='required'>
                            <label for='id_email'>E-mail*</label>
                                <input type='email' name='f_email' id='id_email' required='required'>
                            <label>Assunto: </label>    
                            <select class='select-contato' name='f_assunto' required='required'>
                                <option value='' selected disabled></option>
                                <option value='Anuncio' >Anuncios</option>
                                <option value='Reportar Erro' >Reportar erros</option>
                                <option value='Outros' >Outros</option>
                            </select>    
                            <label for='if_mensagem'>Mensagem*</label>
                                <textarea name='f_mensagem' id='id_mensagem' rows='6' column='65' required='required'></textarea>
                            <input type='submit' name='f_submit' value='Enviar'> 
                        </form>
                    </div>
                </div>
            </div>
        </section>
    </main>


    <?php 
        require_once dirname(__DIR__) . "/_layout/rodape.php";
        require_once dirname(__DIR__) . '/_layout/scriptFooter.php';
    ?>
</body>

</html>