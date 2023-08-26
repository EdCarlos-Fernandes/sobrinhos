<footer class="footer d-flex justify-content-around position-relative flex-wrap">
    <div class='footer--side1' style="width: 50%;">
        <div class="menu--content d-flex justify-content-around" style="width: 100%;">
            <nav class="menu--footer d-flex flex-column">
                <h1 class="menu--footer--h1">Menu</h1>
                <div class="divisoria"></div>
                <ul class="menu--footer--ul">
                    <?php 

                    if(!isset($_SESSION['numLogin'])){

                        echo "<li><a href='$linkSite/index.php'>HOME</a></li>
                            <li><a href='$linkSite/paginas/sobre.php'>SOBRE</a></li>
                            <li><a href='$linkSite/paginas/contato.php'>CONTATO</a></li>";
                        
                    }else{

                        echo "<li><a href='$linkSite/index.php?num=".$_SESSION['numLogin']."&id=".$_SESSION['username']."'>HOME</a></li>
                            <li><a href='$linkSite/anunciar/anunciar.php?num=".$_SESSION['numLogin']."&id=".$_SESSION['username']."'>ANUNCIAR</a></li>
                            <li><a href='$linkSite/paginas/sobre.php?num=".$_SESSION['numLogin']."&id=".$_SESSION['username']."'>SOBRE</a></li>
                            <li><a href='$linkSite/paginas/contato.php?num=".$_SESSION['numLogin']."&id=".$_SESSION['username']."'>CONTATO</a></li>";
                    }

                    ?>
                </ul>
            </nav>

            <nav class='submenu-footer d-flex flex-column'>
                <h1 class="menu--footer--h1">Categorias</h1>
                <div class="divisoria"></div>
                <ul class="menu--footer--ul">
                    <?php
                    if(!isset($_SESSION['numLogin'])){
                        
                        echo "<li><a href='$linkSite/vagas/vagas.php'>VAGAS</a></li>
                            <li><a href='$linkSite/vagas/estagio.php'>ESTÁGIO</a></li>
                            <li><a href='$linkSite/noticias/noticias.php'>NOTÍCIAS</a></li>
                            <li><a href='$linkSite/vagas/nivelsuperior.php'>NIVEL SUPERIOR</a></li>";
                    }else{

                        echo "<li><a href='$linkSite/vagas/vagas.php?num=".$_SESSION['numLogin']."&id=".$_SESSION['username']."'>VAGAS</a></li>
                            <li><a href='$linkSite/vagas/estagio.php?num=".$_SESSION['numLogin']."&id=".$_SESSION['username']."'>ESTÁGIO</a></li>
                            <li><a href='$linkSite/noticias/noticias.php?num=".$_SESSION['numLogin']."&id=".$_SESSION['username']."'>NOTÍCIAS</a></li>
                            <li><a href='$linkSite/vagas/nivelsuperior.php?num=".$_SESSION['numLogin']."&id=".$_SESSION['username']."'>NIVEL SUPERIOR</a></li>
                            <li><a href='$linkSite/anunciar/anunciar.php?num=".$_SESSION['numLogin']."&id=".$_SESSION['username']."'>ANUNCIAR</a></li>";
                    }
                    ?>

                </ul>
            </nav>
        </div>
    </div>

    <div class='footer-logo d-flex align-items-center'>
        <div class="img-footer">
            <?php
            if(!isset($_SESSION['numLogin'])){

                echo "<a href='$linkSite/index'><img src='$linkSite/_imgs/logo-02.png' alt='$nomeSite' title='Logo $nomeSite' style='width: 300px;'></a>";

            }else{
                
                echo "<a href='$linkSite/index?num=".$_SESSION['numLogin']."&id=".$_SESSION['username']."'><img src='$linkSite/_imgs/logo-02.png' alt='$nomeSite' title='Logo $nomeSite' style='width: 300px;'/></a>";
            }
            
            ?>
        </div>
    </div>
</footer>

<div class="ultimo-footer d-flex justify-content-center p-2">
    <p style="margin: 0 !important;">&copy; 2023 - Todos os direitos autorais reservados a <b><?php echo $nomeSite; ?></b></p>
</div>
