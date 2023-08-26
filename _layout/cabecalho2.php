    <!--Navbar blue-->
    <nav class="navbar navbar-expand-lg navbar-dark">
        <div class="d-flex justify-content-around flex-wrap" style="width: 50%;">
            <div class='logo' id='topo'>
                <?php
                    if(!isset($_SESSION['numLogin'])){
                        echo "<a href='$linkSite/index.php'><img class='logo--imagem' src='$linkSite/_imgs/logo-02.png' alt='Logo $nomeSite' title='Logo $nomeSite'/></a>";

                    }else{
                        echo "<a href='$linkSite/index.php?num=".$_SESSION['numLogin']."&id=".$_SESSION['username']."'><img class='logo--imagem' src='$linkSite/_imgs/logo-02.png' alt='$nomeSite' title='Logo $nomeSite'/></a>";
                    }
                ?>
            </div>
            <div class="form-inline">
                <?php 
                    if(!isset($_SESSION['numLogin'])){
                        
                        echo "<form action='$linkSite/paginas/pesquisa.php' method='get' name='form_pesquisar' style='width: 100%;'>
                                <div class='box_pesquisa d-flex align-items-center justify-content-end'>
                                    <input class='form-control' type='text' name='f_name' placeholder='Busque vagas pelo nome' required='required' style='margin: 0 !important;height: auto !important;'>
                                </div>
                                </form>";
                    }else{

                        echo "<form action='$linkSite/paginas/pesquisa.php?num=".$_SESSION['numLogin']."' method='POST' name='form_pesquisar' style='width: 100%'>
                                <div class='box_pesquisa d-flex align-items-center justify-content-end'>
                                    <input class='form-control' type='text' name='f_name' placeholder='Busque vagas pelo nome' required='required' style='margin: 0 !important;height: auto !important;'>
                                </div>
                            </form>";

                    }
                ?>
            </div>
        </div>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav">
                <?php
                    if(!isset($_SESSION['numLogin'])){
                    
                        echo "<li class='nav-item'><a class='nav-link d-flex flex-column align-items-center justify-content-center' href='$linkSite/index.php' title='Inicio'><img class='icone' src='$linkSite/_imgs/icone/inicio.png' alt='inicio'/>Inicio</a></li>
                            <li class='nav-item'><a class='nav-link d-flex flex-column align-items-center justify-content-center' href='$linkSite/paginas/sobre.php' title='Sobre'><!--<span class='badge badge-danger'>11</span>--><img class='icone' src='$linkSite/_imgs/icone/sobre.png' alt='sobre'/>Sobre</a></li>
                            <li class='nav-item'><a class='nav-link d-flex flex-column align-items-center justify-content-center' href='$linkSite/paginas/contato.php' title='Contato'><!--<span class='badge badge-warning'>11</span>--><img class='icone' src='$linkSite/_imgs/icone/contato.png' alt='contato'/>Contato</a></li>";
                    }else{

                        echo "<li class='nav-item'><a class='nav-link d-flex flex-column align-items-center justify-content-center' href='$linkSite/index.php?num=".$_SESSION['numLogin']."&id=".$_SESSION['username']."' title='Inicio'><img class='icone' src='$linkSite/_imgs/icone/inicio.png' alt='inicio'/>Inicio</a></li>
                        <li class='position-fixed anunciar'><a href='$linkSite/anunciar/anunciar.php?num=".$_SESSION['numLogin']."&id=".$_SESSION['username']."' title='Anunciar'><img src='$linkSite/_imgs/icone/anunciar.png' alt='anunciar'/></a></li>
                        <li class='nav-item'><a class='nav-link d-flex flex-column align-items-center justify-content-center' href='$linkSite/paginas/sobre.php?num=".$_SESSION['numLogin']."&id=".$_SESSION['username']."' title='Sobre'><img class='icone' src='$linkSite/_imgs/icone/sobre.png' alt='sobre'/>Sobre</a></li>
                        <li class='nav-item'><a class='nav-link d-flex flex-column align-items-center justify-content-center' href='$linkSite/paginas/contato.php?num=".$_SESSION['numLogin']."&id=".$_SESSION['username']."' title='Contato'><img class='icone' src='$linkSite/_imgs/icone/contato.png' alt='contato'/>Contato</a></li>";
                    }
                ?>
            </ul>
            <ul class="navbar-nav ml-auto nav-flex-icons justify-content-end">
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" id="navbarDropdownMenuLink" data-toggle="dropdown"
                        aria-haspopup="true" aria-expanded="false"><i class="fa fa-user"></i>
                    </a>
                    <div class="dropdown-menu dropdown-menu-right dropdown-unique" aria-labelledby="navbarDropdownMenuLink" style="left: -120px;padding: 0 !important;">
                        <ul class="navbar-nav d-flex flex-column">
                            <?php
                                if(!isset($_SESSION['numLogin'])){
                                    echo "
                                    <li class='botaoLog'><a style='width: 100%;' href='$linkSite/login/login_g.php?sucess=dados' title='login'>Login</a></li>";
                                
                                }else{
                                    echo "
                                    <li class='botaoLog'><a style='width: 100%;' href='$linkSite/painelUser/dashboard.php?num=".$_SESSION['numLogin']."&id=".$_SESSION['username']."' title='Perfil do usuario'>Perfil</a></li>
                                    <li class='botaoLog'><a style='width: 100%;' href='$linkSite/source/logOut.php?token=".md5(session_id())."' title='Sair'>Sair</a></li>";

                                }
                            ?>
                        </ul>
                    </div>
                </li>
            </ul>
        </div>
    </nav>
    <!--/.Navbar blue-->

    <section class='sub--menu'>
        <ul class='cabecalho--submenu--ul sub--menu--ul d-flex justify-content-around flex-wrap'>
            <?php
                if(!isset($_SESSION['numLogin'])){
                //se não esxistir
                    $arquivo = substr($_SERVER['SCRIPT_NAME'], 28);
                    if($arquivo === "vagas.php"){
                        echo "<li class='estilo-item'><a href='$linkSite/vagas/vagas.php'>VAGAS</a></li>";
                    }else{
                        echo "<li><a href='$linkSite/vagas/vagas.php'>VAGAS</a></li>";
                    }

                    if($arquivo === "estagio.php"){
                        echo "<li class='estilo-item'><a href='$linkSite/vagas/estagio.php'>ESTAGIO</a></li>";
                    }else{
                        echo "<li><a href='$linkSite/vagas/estagio.php'>ESTAGIO</a></li>";
                    }

                    if($arquivo === "nivelsuperior.php"){
                        echo "<li class='estilo-item'><a href='$linkSite/vagas/nivelsuperior.php'>NIVEL SUPERIOR</a></li>";
                    }else{
                        echo "<li><a href='$linkSite/vagas/nivelsuperior.php'>NIVEL SUPERIOR</a></li>";
                    }

                    if($arquivo === "noticias.php"){
                        echo "<li class='estilo-item'><a href='$linkSite/noticias/noticias.php'>NOTÍCIAS</a></li>";
                    }else{
                        echo "<li><a href='$linkSite/noticias/noticias.php'>NOTÍCIAS</a></li>";

                    }
                    if($arquivo === "apCurriculo.php"){
                        echo "<li class='estilo-item'><a href='$linkSite/apCurriculo.php'>CURRÍCULO</a></li>";
                    }else{
                        echo "<li><a href='$linkSite/apCurriculo.php'>CURRÍCULO</a></li>";
                    }
                /**/
                }else{

                //se existir
                    
                    $arquivo = substr($_SERVER['SCRIPT_NAME'], 28);
                    
                    if($arquivo === "vagas.php"){
                        echo "<li class='estilo-item'><a href='$linkSite/vagas/vagas.php'>VAGAS</a></li>";
                    }else{
                        echo "<li><a href='$linkSite/vagas/vagas.php?num=".$_SESSION['numLogin']."&id=".$_SESSION['username']."'>VAGAS</a></li>";
                    }

                    if($arquivo === "estagio.php"){
                        echo "<li class='estilo-item'><a href='$linkSite/vagas/estagio.php'>ESTAGIO</a></li>";
                    }else{
                        echo "<li><a href='$linkSite/vagas/estagio.php?num=".$_SESSION['numLogin']."&id=".$_SESSION['username']."'>ESTAGIO</a></li>";
                    }

                    if($arquivo === "nivelsuperior.php"){
                        echo "<li class='estilo-item'><a href='$linkSite/vagas/nivelsuperior.php'>NIVEL SUPERIOR</a></li>";
                    }else{
                        echo "<li><a href='$linkSite/vagas/nivelsuperior.php?num=".$_SESSION['numLogin']."&id=".$_SESSION['username']."'>NIVEL SUPERIOR</a></li>";
                    }

                    if($arquivo === "noticias.php"){
                        echo "<li class='estilo-item'><a href='$linkSite/noticias/noticias.php'>NOTÍCIAS</a></li>";
                    }else{
                        echo "<li><a href='$linkSite/noticias/noticias.php?num=".$_SESSION['numLogin']."&id=".$_SESSION['username']."'>NOTÍCIAS</a></li>";

                    }

                    if($arquivo === "apCurriculo.php"){
                        echo "<li class='estilo-item'><a href='$linkSite/apCurriculo.php'>CURRÍCULO</a></li>";
                    }else{
                        echo "<li><a href='$linkSite/apCurriculo.php?num=".$_SESSION['numLogin']."&id=".$_SESSION['username']."'>CURRÍCULO</a></li>";
                    }

                    //if($arquivo === "anunciar.php"){
                    //    echo "<li class='estilo-item'><a href='anunciar.php?num=".$_SESSION['numLogin']."'>ANUNCIAR</a></li>";
                    //}else{
                    //    echo "<li><a href='anunciar.php?num=".$_SESSION['numLogin']."&id=".$_SESSION['username']."'>ANUNCIAR</a></li>";
                    //}
                }
            
            ?>
        </ul>
    </section>


    <!-- partial -->
    <script src='https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js'></script>
    <script src='https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.11.0/umd/popper.min.js'></script>
    <script src='https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta/js/bootstrap.min.js'></script>
    <script src='https://cdnjs.cloudflare.com/ajax/libs/mdbootstrap/4.4.1/js/mdb.min.js'></script>