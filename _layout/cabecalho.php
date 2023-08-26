<nav class="sidebar sidebar-offcanvas position-fixed" id="sidebar" style="background-color: #122f51;height: 100vh;">
    <div class="sidebar-brand-wrapper d-none d-lg-flex align-items-center justify-content-center fixed-top">
        <?php
            if(!isset($_SESSION['numLogin'])){
                echo "
                <a class='sidebar-brand brand-logo' href='$linkSite/index.php' title='$titulo'><img class='icone' src='$linkSite/_imgs/logo-01GA.png' alt='logo'/></a>
                <a class='sidebar-brand brand-logo-mini' href='$linkSite/index.php' title='$titulo'><img class='icone' src='$linkSite/_imgs/icone/icone-6.png' alt='logo inicio'/></a>";
            
            }else{
                echo "
                <a class='sidebar-brand brand-logo' href='$linkSite/index.php?num=".$_SESSION['numLogin']."&id=".$_SESSION['username']."' title='$titulo'><img class='icone' src='$linkSite/_imgs/logo-01GA.png' alt='logo'/></a>
                <a class='sidebar-brand brand-logo-mini' href='$linkSite/index.php?num=".$_SESSION['numLogin']."&id=".$_SESSION['username']."' title='$titulo'><img class='icone' src='$linkSite/_imgs/icone/icone-6.png' alt='logo inicio'/></a>";
            
            }
        ?>
    </div>

    <ul class="nav">
        <?php
            if(!isset($_SESSION['numLogin'])){
                echo "";
            
            }else{
                echo "
                <li class='nav-item profile'>
                    <div class='profile-desc'>
                        <div class='profile-pic'>
                            <div class='count-indicator'>
                                <img class='img-xs rounded-circle ' src='$linkSite/_imgs/users/1689685044093.jpg' alt=''>
                                <span class='count bg-success'></span>
                            </div>
                            
                            <div class='profile-name'>
                                <h5 class='mb-0 font-weight-normal'>$nomeUser</h5>
                                <span>Membro Premium</span>
                            </div>
                        </div>

                        <a href='#' id='profile-dropdown' data-toggle='dropdown'><i class='mdi mdi-dots-vertical'></i></a>

                        <div class='dropdown-menu dropdown-menu-right sidebar-dropdown preview-list' aria-labelledby='profile-dropdown'>
                            <a class='dropdown-item preview-item' href='$linkSite/painelUser/configuracaoUser.php?num={$_SESSION['numLogin']}&id={$_SESSION['username']}' title='$titulo'>
                                <div class='preview-thumbnail'>
                                    <div class='preview-icon bg-dark rounded-circle'>
                                        <i class='mdi mdi-settings text-primary'></i>
                                    </div>
                                </div>
                                <div class='preview-item-content'>
                                    <p class='preview-subject ellipsis mb-1 text-small'>Configurações</p>
                                </div>
                            </a>
                            <div class='dropdown-divider'></div>

                            <a href='#' class='dropdown-item preview-item'>
                                <div class='preview-thumbnail'>
                                    <div class='preview-icon bg-dark rounded-circle'>
                                        <i class='mdi mdi-onepassword  text-info'></i>
                                    </div>
                                </div>
                                <div class='preview-item-content'>
                                    <p class='preview-subject ellipsis mb-1 text-small'>Mudar senha</p>
                                </div>
                            </a>
                            <div class='dropdown-divider'></div>
                            
                            <a href='#' class='dropdown-item preview-item'>
                                <div class='preview-thumbnail'>
                                    <div class='preview-icon bg-dark rounded-circle'>
                                        <i class='mdi mdi-calendar-today text-success'></i>
                                    </div>
                                </div>
                                <div class='preview-item-content'>
                                    <p class='preview-subject ellipsis mb-1 text-small'>Lista pessoal</p>
                                </div>
                            </a>
                        </div>
                    </div>
                </li>";
            }
        ?>
        <li>
            <form class="nav-link mt-2 mt-md-0 d-lg-flex search form1" action="../paginas/pesquisa.php?num=srFbL6smAPHfQt9n5V5G0z1vlejo9vmKS" method="POST" name="form_pesquisar" style="width: 100%;">
                <input class="form-control" type="text" name="f_name" placeholder="Busque vagas pelo nome" required="required" style="margin: 0 !important;height: auto !important;">
            </form>
        </li>
        <li class="nav-item nav-category">
            <span class="nav-link">Navegação</span>
        </li>

        <li class="nav-item menu-items">
            <?php
                if(!isset($_SESSION['numLogin'])){
                    echo "
                    <a class='nav-link' href='$linkSite/index.php' title='$titulo'>
                        <span class='menu-icon'>
                            <i class='mdi mdi-home-outline'></i>
                        </span>
                        <span class='menu-title'>INICIO</span>
                    </a>";
                
                }else{
                    echo "
                    <a class='nav-link' href='$linkSite/index.php?num=".$_SESSION['numLogin']."&id=".$_SESSION['username']."' title='$titulo'>
                        <span class='menu-icon'>
                            <i class='mdi mdi-home-outline'></i>
                        </span>
                        <span class='menu-title'>INICIO</span>
                    </a>";
                
                }
            ?>
        </li>

        <li class="nav-item menu-items">
            <?php
                if(!isset($_SESSION['numLogin'])){
                    echo "
                    <a class='nav-link' href='$linkSite/paginas/sobre.php' title='$titulo'>
                        <span class='menu-icon'>
                            <i class='mdi mdi-home-outline'></i>
                        </span>
                        <span class='menu-title'>SOBRE NÓS</span>
                    </a>";
                
                }else{
                    echo "
                    <a class='nav-link' href='$linkSite/paginas/sobre.php?num=".$_SESSION['numLogin']."&id=".$_SESSION['username']."' title='$titulo'>
                        <span class='menu-icon'>
                            <i class='mdi mdi-home-outline'></i>
                        </span>
                        <span class='menu-title'>SOBRE NÓS</span>
                    </a>";
                
                }
            ?>
        </li>

        <li class="nav-item menu-items">
            <?php
                if(!isset($_SESSION['numLogin'])){
                    echo "
                    <a class='nav-link' href='$linkSite/paginas/contato.php' title='$titulo'>
                        <span class='menu-icon'>
                            <i class='mdi mdi-home-outline'></i>
                        </span>
                        <span class='menu-title'>CONTATO</span>
                    </a>";
                
                }else{
                    echo "
                    <a class='nav-link' href='$linkSite/paginas/contato.php?num=".$_SESSION['numLogin']."&id=".$_SESSION['username']."' title='$titulo'>
                        <span class='menu-icon'>
                            <i class='mdi mdi-home-outline'></i>
                        </span>
                        <span class='menu-title'>CONTATO</span>
                    </a>";
                
                }
            ?>
        </li>

        <br />
        <br />
        
        <?php
            if(!isset($_SESSION['numLogin'])){
                echo "";
            
            } else{
                echo "
                <li class='nav-item nav-category'>
                    <span class='nav-link'>Dashboard</span>
                </li>";
            
            }
        ?>
        
        <li class="nav-item menu-items">
            <?php
                if(!isset($_SESSION['numLogin'])){
                    echo "";
                
                } else{
                    echo "
                    <a class='nav-link' href='$linkSite/painelUser/dashboard.php?num=".$_SESSION['numLogin']."&id=".$_SESSION['username']."' title='$titulo'>
                        <span class='menu-icon'>
                            <i class='mdi mdi-home-account'></i>
                        </span>
                        <span class='menu-title'>Painel Principal</span>
                    </a>";
                
                }
            ?>
        </li>
    </ul>
</nav>






<nav class="navbar p-0 fixed-top d-flex flex-row">
    <div class="navbar-brand-wrapper d-flex d-lg-none align-items-center justify-content-center">
        <?php
            if(!isset($_SESSION['numLogin'])){
                echo "
                <a class='navbar-brand brand-logo-mini' href='$linkSite/index.php.php' title='Inicio'><img class='icone' src='$linkSite/_imgs/icone/icone-6.png' alt='logo mini'/></a>";
            
            }else{
                echo "
                <a class='navbar-brand brand-logo-mini' href='$linkSite/index.php?num=".$_SESSION['numLogin']."&id=".$_SESSION['username']."' title='Inicio'><img class='icone' src='$linkSite/_imgs/icone/icone-6.png' alt='logo mini'/></a>";
            
            }
        ?>
    </div>


    <div class="navbar-menu-wrapper flex-grow d-flex align-items-stretch">
        <button class="navbar-toggler navbar-toggler align-self-center" type="button" data-toggle="minimize" title="botao menu">
            <span class="mdi mdi-menu"></span>
        </button>


        <ul class="navbar-nav w-100">
            <li class="nav-item w-100">
                <?php 
                    if(!isset($_SESSION['numLogin'])){
                        
                        echo "<form class='nav-link mt-2 mt-md-0 d-none d-lg-flex search' action='$linkSite/paginas/pesquisa.php' method='get' name='form_pesquisar' style='width: 100%;'>
                                    <input class='form-control' type='text' name='f_name' placeholder='Busque vagas pelo nome' required='required' style='margin: 0 !important;height: auto !important;'>
                                </form>";
                    }else{

                        echo "<form class='nav-link mt-2 mt-md-0 d-none d-lg-flex search'  action='$linkSite/paginas/pesquisa.php?num=".$_SESSION['numLogin']."' method='POST' name='form_pesquisar' style='width: 100%'>
                                    <input class='form-control' type='text' name='f_name' placeholder='Busque vagas pelo nome' required='required' style='margin: 0 !important;height: auto !important;'>
                            </form>";

                    }
                ?>
            </li>
        </ul>


        <ul class="navbar-nav navbar-nav-right">
            <?php
                if(!isset($_SESSION['numLogin'])){
                    echo "";
                
                }else{
                    echo "
                    <li class='nav-item dropdown d-none d-lg-block'>
                    <a class='nav-link btn btn-success create-new-button' id='createbuttonDropdown'
                        data-toggle='dropdown' aria-expanded='false' href='#'>+ Criar Novo anúncio</a>
                    <div class='dropdown-menu dropdown-menu-right navbar-dropdown preview-list'
                        aria-labelledby='createbuttonDropdown'>
                        <h6 class='p-3 mb-0'>Nivel da vaga</h6>
                        <div class='dropdown-divider'></div>
                        <a class='dropdown-item preview-item'>
                            <div class='preview-thumbnail'>
                                <div class='preview-icon bg-dark rounded-circle'>
                                    <i class='mdi mdi-file-outline text-primary'></i>
                                </div>
                            </div>
                            <div class='preview-item-content'>
                                <p class='preview-subject ellipsis mb-1'>Estágio</p>
                            </div>
                        </a>
                        <div class='dropdown-divider'></div>
                        <a class='dropdown-item preview-item'>
                            <div class='preview-thumbnail'>
                                <div class='preview-icon bg-dark rounded-circle'>
                                    <i class='mdi mdi-web text-info'></i>
                                </div>
                            </div>
                            <div class='preview-item-content'>
                                <p class='preview-subject ellipsis mb-1'>Junior</p>
                            </div>
                        </a>
                        <div class='dropdown-divider'></div>
                        <a class='dropdown-item preview-item'>
                            <div class='preview-thumbnail'>
                                <div class='preview-icon bg-dark rounded-circle'>
                                    <i class='mdi mdi-layers text-warning'></i>
                                </div>
                            </div>
                            <div class='preview-item-content'>
                                <p class='preview-subject ellipsis mb-1'>Pleno</p>
                            </div>
                        </a>
                        <div class='dropdown-divider'></div>
                        <a class='dropdown-item preview-item'>
                            <div class='preview-thumbnail'>
                                <div class='preview-icon bg-dark rounded-circle'>
                                    <i class='mdi mdi-fire text-danger'></i>
                                </div>
                            </div>
                            <div class='preview-item-content'>
                                <p class='preview-subject ellipsis mb-1'>Senior</p>
                            </div>
                        </a>
                    </div>
                </li>
                
                <li class='nav-item dropdown border-left'>
                    <a class='nav-link count-indicator dropdown-toggle' id='messageDropdown' href='#'
                        data-toggle='dropdown' aria-expanded='false'>
                        <i class='mdi mdi-email'></i>
                        <span class='count bg-success'></span>
                    </a>
                    <div class='dropdown-menu dropdown-menu-right navbar-dropdown preview-list'
                        aria-labelledby='messageDropdown'>
                        <h6 class='p-3 mb-0'>Mensagens</h6>
                        <div class='dropdown-divider'></div>
                        <a class='dropdown-item preview-item'>
                            <div class='preview-thumbnail'>
                                <img src='$linkSite/_imgs/users/ibm.png' alt='image'
                                    class='rounded-circle profile-pic'>
                            </div>
                            <div class='preview-item-content'>
                                <p class='preview-subject ellipsis mb-1'>IBM enviou uma Mensagem</p>
                                <p class='text-muted mb-0'> 5 Minutos atrás </p>
                            </div>
                        </a>
                        <div class='dropdown-divider'></div>
                        <a class='dropdown-item preview-item'>
                            <div class='preview-thumbnail'>
                                <img src='$linkSite/_imgs/users/serasa.png' alt='image'
                                    class='rounded-circle profile-pic'>
                            </div>
                            <div class='preview-item-content'>
                                <p class='preview-subject ellipsis mb-1'>Serasa enviou uma Mensagem</p>
                                <p class='text-muted mb-0'> 15 Horas atrás </p>
                            </div>
                        </a>
                        <div class='dropdown-divider'></div>
                        <a class='dropdown-item preview-item'>
                            <div class='preview-thumbnail'>
                                <img src='$linkSite/_imgs/users/bradesco.png' alt='image'
                                    class='rounded-circle profile-pic'>
                            </div>
                            <div class='preview-item-content'>
                                <p class='preview-subject ellipsis mb-1'>Bradesco enviou uma Mensagem</p>
                                <p class='text-muted mb-0'> 2 Dias atrás </p>
                            </div>
                        </a>
                        <div class='dropdown-divider'></div>
                    </div>
                </li>
                
                <li class='nav-item dropdown border-left'>
                    <a class='nav-link count-indicator dropdown-toggle' id='notificationDropdown' href='#'
                        data-toggle='dropdown'>
                        <i class='mdi mdi-bell'></i>
                        <span class='count bg-danger'></span>
                    </a>
                    <div class='dropdown-menu dropdown-menu-right navbar-dropdown preview-list'
                        aria-labelledby='notificationDropdown'>
                        <h6 class='p-3 mb-0'>Notificações</h6>
                        <div class='dropdown-divider'></div>
                        <a class='dropdown-item preview-item'>
                            <div class='preview-thumbnail'>
                                <div class='preview-icon bg-dark rounded-circle'>
                                    <i class='mdi mdi-calendar text-success'></i>
                                </div>
                            </div>
                            <div class='preview-item-content'>
                                <p class='preview-subject mb-1'>Eventos</p>
                                <p class='text-muted ellipsis mb-0'> Nenhum evento hoje </p>
                            </div>
                        </a>
                        <div class='dropdown-divider'></div>
                        <a class='dropdown-item preview-item'>
                            <div class='preview-thumbnail'>
                                <div class='preview-icon bg-dark rounded-circle'>
                                    <i class='mdi mdi-account-search text-warning'><span class='badge'>5</span></i>
                                </div>
                            </div>
                            <div class='preview-item-content'>
                                <p class='preview-subject mb-1'>Vagas do dia</p>
                                <p class='text-muted ellipsis mb-0'> Vejas novas vagas diarias </p>
                            </div>
                        </a>
                        <div class='dropdown-divider'></div>
                        <a class='dropdown-item preview-item'>
                            <div class='preview-thumbnail'>
                                <div class='preview-icon bg-dark rounded-circle'>
                                    <i class='mdi mdi-settings text-danger'></i>
                                </div>
                            </div>
                            <div class='preview-item-content'>
                                <p class='preview-subject mb-1'>Configurações</p>
                                <p class='text-muted ellipsis mb-0'> Atualize suas notificações </p>
                            </div>
                        </a>
                        <div class='dropdown-divider'></div>
                    </div>
                </li>";

                }
            ?>

            <li class="nav-item dropdown">
                <a class="nav-link" id="profileDropdown" href="#" data-toggle="dropdown">
                    <div class="navbar-profile">
                        <?php
                            if(!isset($_SESSION['numLogin'])){
                                echo "
                                    <i class='mdi mdi-login'></i>";
                            
                            }else{
                                echo "
                                    <img class='img-xs rounded-circle' src='$linkSite/_imgs/users/1689685044093.jpg' alt=''>
                                    <p class='mb-0 d-none d-sm-block navbar-profile-name'>$nomeUser</p>";

                            }
                        ?>
                        <i class="mdi mdi-menu-down d-none d-sm-block"></i>
                    </div>
                </a>
                <div class="dropdown-menu dropdown-menu-right navbar-dropdown preview-list" aria-labelledby="profileDropdown">
                    <?php
                        if(!isset($_SESSION['numLogin'])){
                            echo "
                            <a class='dropdown-item preview-item' href='$linkSite/login/login_g.php?sucess=dados' title='Login'>
                                <div class='preview-thumbnail'>
                                    <div class='preview-icon bg-dark rounded-circle'>
                                        <i class='mdi mdi-login text-success'></i>
                                    </div>
                                </div>
                                <div class='preview-item-content'>
                                    <p class='preview-subject mb-1'>Login</p>
                                </div>
                            </a>";
                        
                        }else{
                            echo "
                            <a class='dropdown-item preview-item' href='$linkSite/source/logOut.php?token=".md5(session_id())."' title='Sair'>
                                <div class='preview-thumbnail'>
                                <div class='preview-icon bg-dark rounded-circle'>
                                    <i class='mdi mdi-logout text-danger'></i>
                                </div>
                                </div>
                                <div class='preview-item-content'>
                                <p class='preview-subject mb-1'>Sair</p>
                                </div>
                            </a>";

                        }
                    ?>
                    <div class="dropdown-divider"></div>
                </div>
            </li>
        </ul>
        <button class="navbar-toggler navbar-toggler-right d-lg-none align-self-center" type="button" data-toggle="offcanvas" title="botao menu">
            <span class="mdi mdi-format-line-spacing"></span>
        </button>
    </div>
</nav>