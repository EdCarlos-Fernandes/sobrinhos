<?php 
require_once '../_config/config.php';
require_once '../_config/conx.php';
require_once '../_config/data.php';


// Verificar se o usuário está autenticado
if (!isset($_SESSION["numLogin"])) {
    header("Location: $linkSite/index.php");
    exit();
}

// Verificar se o número de autenticação corresponde ao da sessão
if (isset($_GET["num"])) {
    $n1 = $_GET["num"];
} elseif (isset($_POST["num"])) {
    $n1 = $_POST["num"];
}

$n2 = $_SESSION["numLogin"];

if ($n1 !== $n2) {
    header("Location: $linkSite/anunciar/anunciar.php");
    exit();
}

if (isset($_POST['f_submit'])) {
    $numLogin = htmlspecialchars($_SESSION['numLogin'], ENT_QUOTES, 'UTF-8');
    // Validar e filtrar os dados de entrada
    $nomeV = trim(ucwords(strtolower($_POST['f_nomeV'])));
    $empresa = empty($_POST['f_nomeE']) ? "Não Informado" : ucfirst(strtolower($_POST['f_nomeE']));
    $quantidade = intval($_POST['qtdV']);
    $local = trim(ucfirst(strtolower($_POST['f_local'])));
    $carga = empty($_POST['f_carga']) ? "Não Informado" : $_POST['f_carga'];
    $salarioB = empty($_POST['f_salarioB']) ? "Não Informado" : $_POST['f_salarioB'];
    $tipoV = $_POST['f_tipoV'];
    $requisitos = empty($_POST['f_req']) ? "Não Informado" : ucfirst(strtolower($_POST['f_req']));
    $descricao = trim(ucfirst(strtolower($_POST['f_desc'])));
    $periodo = $_POST['f_periodo'];
    $email = trim($_POST['f_email']);

    // Usar declarações preparadas para evitar injeção SQL
    $sql = "INSERT INTO tb_cadastro(nome_V, nome_E, qtd_V, local_T, carga_H, salario_B, tipo_V, requisitos, descricao, periodo_V, email, data_C) VALUES(?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, NOW())";
    $stmt = mysqli_prepare($conn, $sql);
    mysqli_stmt_bind_param($stmt, "ssissssssss", $nomeV, $empresa, $quantidade, $local, $carga, $salarioB, $tipoV, $requisitos, $descricao, $periodo, $email);
    
    if (mysqli_stmt_execute($stmt)) {
        // Redirecionar para página de sucesso
        header('Location: anuncioSucesso.php?num=' . $numLogin);
        exit();
    } else {
        // Tratar erros de inserção
        echo "<p class='mensagemEmail'>Erro ao salvar os dados!</p>";
    }

    // Fechar declaração e conexão
    mysqli_stmt_close($stmt);
    mysqli_close($conn);
}
?>

<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $titulo ?> - Anúnciar</title>
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
        <section class='conteudo'>
            
            <div class='container'>
            
                <div class='anuncio-principal'>
                    
                    <h2>Anunciar Vaga</h2>

                        <div class='text-alert'>
                            <p>Anuncie sua vaga de emprego no maior portal de emprego do Brasil. Aqui você poderá anunciar sua vaga preenchendo o formulário a baixo com as informações da vaga como, nome da vaga, tipo, carga horária, email, período etc.</p>
                            <p>Nós da <i><?php echo $titulo ?></i> deixamos claro que não temos nenhum vínculo contratual com o empregador e não nos responsabilizamos pelo candidato. Nosso proposito é apenas a divulgação da vaga, disponibilizando-a para o máximo possível de pessoas.</p>
                            <p><b>Campos em * são obrigatórios</p>
                        </div><!--FIM DA DIV TEXT-ALERT -->  
                        
                        <div class='formulario'>
                            <form action='anunciar.php?num=<?php echo $_SESSION['numLogin'] ?>' method='post' class='formAnuncio'>
                                
                                <label for='id_nomeV'>Nome Vaga*</label><input type='text' name='f_nomeV' id='id_nomV' placeholder='Ex: Auxiliar de Cozinha, Repositor' required='required'>

                                <label for='id_nomeE'>Empresa</label><input type='text' name='f_nomeE' id='id_nomE' placeholder='Ex: <?php echo $titulo ?> Empregos'>
                                
                                <label>Quantidade de Vagas*</label><input type='number' name='qtdV' min='1' max='999' required='required'>
                                
                                <label for='id_local'>Local de Trabalho*</label><input type='text' name='f_local' id='id_local' placeholder='Cidade' required='required'>
                                
                                <label for='id_carga'>Carga Horária</label><input type='text' name='f_carga' id='id_carga' placeholder='Ex: 12x36 / 8:00 as 18:00 Segunda a Sexta'>
                                
                                <label for='id_salarioB'>Salário e Benefícios</label><input type='text' name='f_salarioB' id='id_salarioB' placeholder='Ex: 1200 VT + VA'>
                                
                                <label for='id_tipoV'>Tipo de Vaga*:</label>
                                <select name='f_tipoV' id='id_tipoV' required='required'>
                                    <option value='' selected disabled></option>
                                    <option value='Emprego'>Emprego CLT</option>
                                    <option value='Estagio'>Estágio</option>
                                    <option value='Nivel_superior'>Nível Superior</option>
                                    <option value='Diaria'>Diaria</option>
                                </select>

                                <label for='id_req'>Requisitos da Vaga:</label>
                                <textarea name='f_req' id='id_req' rows='6' cols='55'></textarea>
                                
                                <label for='id_desc'>Descrição da Vaga*:</label>
                                <textarea name='f_desc' id='id_desc' rows='6' cols='55' required='required'></textarea>

                                <label for='id_periodo'>Periodo da vaga*</label>
                                <input type='text' value="05/08/2020" name='f_periodo' id='id_periodo' placeholder='Ex: 19/02/2020' min="10" max="10" required='required'>
                                
                                <label for='id_email'>Email*</label>
                                <input type='email' name='f_email'  id='id_email' placeholder='Ex: exemplo@gmail.com' required='required'>    
                                
                                <div class='checkmensag'> 
                                    <input type='checkbox' id='id_checkbox' required='required'><label for='id_checkbox'>Eu concordo que não tenho vinculo e autorizo a divulgação dos dados da vaga no Site <strong><?php echo $titulo ?></strong></label>
                                </div>

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


    <script type='text/javascript' src='<?php echo $linkSite?>/_js/jquery-3.5.1.min.js'></script>
    <script type="text/javascript">
        //Transformar as entradas do formulario em minúsculas
        $(function(){
            $('.formAnuncio > input').change(function(){
                $(this).val($(this).val().toLowerCase());
            });
        });
    </script>

    <script>
        $(document).ready(function(){
            
            $('.menu-mobile').on("click",function(){
                $('.menuMobileBox').slideDown(500);
                $('.menuMobileBox').addClass("visible");
            });

            //Abrir categoria
            $(".abreCat").click(function(){
                $(".subMenuMobile").slideToggle(500, function(){
                    $(".menuMobileBox li:nth-of-type(5)").css("padding-bottom","0px");

                        var icone = $(".abreCat").parent().get();
                        $(icone).attr("class", "icon-menu4"); 
                        if(!$(".subMenuMobile").is(":visible")){
                    
                    var icone = $(".abreCat").parent().get();
                    $(icone).attr("class", "icon-menu3"); 
                    console.log($(this));
                }
                
                });
                    
            });
            $(".menuMobileBox li:nth-of-type(5)").css("padding","30px 20px");
        });
    </script>
</body>

</html>