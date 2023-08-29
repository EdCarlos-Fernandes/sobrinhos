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
            
            $redirectUrl = "$url/painelUser/dashboard.php?num=$numLogin&id=$username";
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
  <title><?php echo $titulo ?> Admin</title>
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


  <main class="container-fluid page-body-wrapper">


    <div class="main-panel">
      <div class="content-wrapper">
        <!-- Primeira seção -->
        <div class="row">
          <div class="col-xl-3 col-sm-6 grid-margin stretch-card">
            <div class="card">
              <div class="card-body">
                <div class="row">
                  <div class="col-9">
                    <div class="d-flex align-items-center align-self-start">
                      <h3 class="mb-0">8</h3>
                      <p class="text-success ml-2 mb-0 font-weight-medium">+11%</p>
                    </div>
                  </div>
                  <div class="col-3">
                    <div class="icon icon-box-success">
                      <span class="mdi mdi-arrow-top-right icon-item"></span>
                    </div>
                  </div>
                </div>
                <h6 class="text-muted font-weight-normal">Candidaturas esse mês</h6>
              </div>
            </div>
          </div>

          <div class="col-xl-3 col-sm-6 grid-margin stretch-card">
            <div class="card">
              <div class="card-body">
                <div class="row">
                  <div class="col-9">
                    <div class="d-flex align-items-center align-self-start">
                      <h3 class="mb-0">5</h3>
                      <p class="text-success ml-2 mb-0 font-weight-medium">+3.5%</p>
                    </div>
                  </div>
                  <div class="col-3">
                    <div class="icon icon-box-success ">
                      <span class="mdi mdi-arrow-top-right icon-item"></span>
                    </div>
                  </div>
                </div>
                <h6 class="text-muted font-weight-normal">Visitas ao seu perfil Hoje</h6>
              </div>
            </div>
          </div>

          <div class="col-xl-3 col-sm-6 grid-margin stretch-card">
            <div class="card">
              <div class="card-body">
                <div class="row">
                  <div class="col-9">
                    <div class="d-flex align-items-center align-self-start">
                      <h3 class="mb-0">16</h3>
                      <p class="text-danger ml-2 mb-0 font-weight-medium">-2.4%</p>
                    </div>
                  </div>
                  <div class="col-3">
                    <div class="icon icon-box-danger">
                      <span class="mdi mdi-arrow-bottom-left icon-item"></span>
                    </div>
                  </div>
                </div>
                <h6 class="text-muted font-weight-normal">Visitas Mensais</h6>
              </div>
            </div>
          </div>
          
          <div class="col-xl-3 col-sm-6 grid-margin stretch-card">
            <div class="card">
              <div class="card-body">
                <div class="row">
                  <div class="col-9">
                    <div class="d-flex align-items-center align-self-start">
                    <div class="icon icon-box-success ">
                      <h3 class="mb-0">23</h3>
                      <!-- <span class="mdi mdi-arrow-top-right icon-item"></span> -->
                    </div>
                      <!-- <p class="text-success ml-2 mb-0 font-weight-medium">+3.5%</p> -->
                    </div>
                  </div>
                  <div class="col-3">
                  </div>
                </div>
                <h6 class="text-muted font-weight-normal">Artigos publicados</h6>
              </div>
            </div>
          </div>
        </div>
        <!-- Fim primeira seção -->



        <!-- Segunda seção -->
        <div class="row">
          <!-- portifolio slide -->
          <div class="col-md-6 col-xl-4 grid-margin stretch-card">
            <div class="card">
              <div class="card-body">
                <h4 class="card-title">Portfólio Pessoal</h4>
                <div class="owl-carousel owl-theme full-width owl-carousel-dash portfolio-carousel"
                  id="owl-carousel-basic">
                  <div class="item">
                    <img src="<?php echo $linkSite ?>/_layout/assets/images/dashboard/Rectangle.jpg" alt="">
                  </div>
                  <div class="item">
                    <img src="<?php echo $linkSite ?>/_layout/assets/images/dashboard/Img_5.jpg" alt="">
                  </div>
                  <div class="item">
                    <img src="<?php echo $linkSite ?>/_layout/assets/images/dashboard/img_6.jpg" alt="">
                  </div>
                </div>
                <div class="d-flex py-4">
                  <div class="preview-list w-100">
                    <div class="preview-item p-0">
                      <div class="preview-thumbnail">
                        <img src="<?php echo $linkSite ?>/_layout/assets/images/faces/face12.jpg" class="rounded-circle" alt="">
                      </div>
                      <div class="preview-item-content d-flex flex-grow">
                        <div class="flex-grow">
                          <div class="d-flex d-md-block d-xl-flex justify-content-between">
                            <h6 class="preview-subject">Fulano de Tal</h6>
                            <p class="text-muted text-small">4 Horas atrás</p>
                          </div>
                          <p class="text-muted">Muito bom mesmo, parabéns.</p>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
                <p class="text-muted">8/20 projetos publicados. </p>
                <div class="progress progress-md portfolio-progress">
                  <div class="progress-bar bg-success" role="progressbar" style="width: 40%" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100">8/20</div>
                </div>
              </div>
            </div>
          </div>
          <!-- Fim portifolio slide -->


          <!-- Grafico -->
          <div class="col-md-6 col-xl-4 grid-margin stretch-card">
            <div class="card">
              <div class="card-body">
                <h4 class="card-title">Histórico de atividade</h4>
                <canvas id="transaction-history" class="transaction-chart"></canvas>
                <div class="bg-gray-dark d-flex d-md-block d-xl-flex flex-row py-3 px-4 px-md-3 px-xl-4 rounded mt-3">
                  <div class="text-md-center text-xl-left">
                    <h6 class="mb-1">Ùltima Visita</h6>
                    <p class="text-muted mb-0">20 Out 2023, 09:12AM</p>
                  </div>
                  <div class="align-self-center flex-grow text-right text-md-center text-xl-right py-md-2 py-xl-0">
                    <img class="img-xs rounded-circle " src="<?php echo $linkSite ?>/_imgs/users/1628281762182.jpg" alt="">
                  </div>
                </div>
                <div class="bg-gray-dark d-flex d-md-block d-xl-flex flex-row py-3 px-4 px-md-3 px-xl-4 rounded mt-3">
                  <div class="text-md-center text-xl-left">
                    <h6 class="mb-1">Seu último artigo publicado</h6>
                    <p class="text-muted mb-0">21 Out 2023, 13:12PM</p>
                  </div>
                  <div class="align-self-center flex-grow text-right text-md-center text-xl-right py-md-2 py-xl-0">
                    <a class="font-weight-bold mb-0 ver" style="color: #17a7a8;">Ver...</a>
                    <style>
                      .ver {
                        cursor: pointer;
                      }
                    </style>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <!-- Fim grafico -->

          
          <!-- Mensagens -->
          <div class="col-md-6 col-xl-4 grid-margin stretch-card">
            <div class="card">
              <div class="card-body">
                <div class="d-flex flex-row justify-content-between">
                  <h4 class="card-title">Mensagens</h4>
                  <p class="text-muted mb-1 small">Ver todas</p>
                </div>
                <div class="preview-list">
                  <div class="preview-item border-bottom">
                    <div class="preview-thumbnail">
                      <img src="<?php echo $linkSite ?>/_layout/assets/images/faces/face6.jpg" alt="image" class="rounded-circle" />
                    </div>
                    <div class="preview-item-content d-flex flex-grow">
                      <div class="flex-grow">
                        <div class="d-flex d-md-block d-xl-flex justify-content-between">
                          <h6 class="preview-subject">Leonardo</h6>
                          <p class="text-muted text-small">20 Out 2023</p>
                        </div>
                        <p class="text-muted">Fala corno.</p>
                      </div>
                    </div>
                  </div>
                  <div class="preview-item border-bottom">
                    <div class="preview-thumbnail">
                      <img src="<?php echo $linkSite ?>/_layout/assets/images/faces/face8.jpg" alt="image" class="rounded-circle" />
                    </div>
                    <div class="preview-item-content d-flex flex-grow">
                      <div class="flex-grow">
                        <div class="d-flex d-md-block d-xl-flex justify-content-between">
                          <h6 class="preview-subject">Lumena Mills</h6>
                          <p class="text-muted text-small">21 Out 2023</p>
                        </div>
                        <p class="text-muted">Olá, está muito ocupado essa semana?</p>
                      </div>
                    </div>
                  </div>
                  <div class="preview-item border-bottom">
                    <div class="preview-thumbnail">
                      <img src="<?php echo $linkSite ?>/_layout/assets/images/faces/face9.jpg" alt="image" class="rounded-circle" />
                    </div>
                    <div class="preview-item-content d-flex flex-grow">
                      <div class="flex-grow">
                        <div class="d-flex d-md-block d-xl-flex justify-content-between">
                          <h6 class="preview-subject">Eliete Kelly</h6>
                          <p class="text-muted text-small">21 Out 2023/p>
                        </div>
                        <p class="text-muted">Por favor envia o link daquela vaga novamente?</p>
                      </div>
                    </div>
                  </div>
                  <div class="preview-item border-bottom">
                    <div class="preview-thumbnail">
                      <img src="<?php echo $linkSite ?>/_layout/assets/images/faces/face11.jpg" alt="image" class="rounded-circle" />
                    </div>
                    <div class="preview-item-content d-flex flex-grow">
                      <div class="flex-grow">
                        <div class="d-flex d-md-block d-xl-flex justify-content-between">
                          <h6 class="preview-subject">Hermione May</h6>
                          <p class="text-muted text-small">20 Out 2023</p>
                        </div>
                        <p class="text-muted">Obrigado pela dica.</p>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <!-- Fim mensagens -->

          
          <!-- publicações -->
          <div class="col-md-6 col-xl-8 grid-margin stretch-card">
            <div class="card">
              <div class="card-body">
                <div class="d-flex flex-row justify-content-between">
                  <h4 class="card-title mb-1">Projetos pessoais</h4>
                  <a class="text-muted mb-1 ver">Ver todos</a>
                </div>

                <div class="row">
                  <div class="col-12">
                    <div class="preview-list">
                      <div class="preview-item border-bottom">
                        <div class="preview-thumbnail">
                          <div class="preview-icon bg-primary">
                            <i class="mdi mdi-file-document"></i>
                          </div>
                        </div>
                        <div class="preview-item-content d-sm-flex flex-grow">
                          <div class="flex-grow">
                            <h6 class="preview-subject">Admin dashboard</h6>
                            <p class="text-muted mb-0">Maquete de aplicativo web</p>
                          </div>
                          <div class="mr-auto text-sm-right pt-2 pt-sm-0">
                            <p class="text-muted">15 minutos atrás</p>
                            <p class="text-muted mb-0">HTML, CSS, Bootstrap</p>
                          </div>
                        </div>
                      </div>

                      <div class="preview-item border-bottom">
                        <div class="preview-thumbnail">
                          <div class="preview-icon bg-success">
                            <i class="mdi mdi-cloud-download"></i>
                          </div>
                        </div>
                        <div class="preview-item-content d-sm-flex flex-grow">
                          <div class="flex-grow">
                            <h6 class="preview-subject">Desenvolvimento Wordpress</h6>
                            <p class="text-muted mb-0">Carregar novo blablabla</p>
                          </div>
                          <div class="mr-auto text-sm-right pt-2 pt-sm-0">
                            <p class="text-muted">1 hora atrás</p>
                            <p class="text-muted mb-0">HTML, CSS, Bootstrap, JavaScript</p>
                          </div>
                        </div>
                      </div>

                      <div class="preview-item border-bottom">
                        <div class="preview-thumbnail">
                          <div class="preview-icon bg-info">
                            <i class="mdi mdi-clock"></i>
                          </div>
                        </div>
                        <div class="preview-item-content d-sm-flex flex-grow">
                          <div class="flex-grow">
                            <h6 class="preview-subject">Projeto para reunião</h6>
                            <p class="text-muted mb-0">Projeto para reunioes blablabla</p>
                          </div>
                          <div class="mr-auto text-sm-right pt-2 pt-sm-0">
                            <p class="text-muted">2 semanas atrás</p>
                            <p class="text-muted mb-0">Bootstrap, JavaScript, Typescript, Angular</p>
                          </div>
                        </div>
                      </div>
                      <div class="preview-item border-bottom">
                        <div class="preview-thumbnail">
                          <div class="preview-icon bg-danger">
                            <i class="mdi mdi-email-open"></i>
                          </div>
                        </div>
                        <div class="preview-item-content d-sm-flex flex-grow">
                          <div class="flex-grow">
                            <h6 class="preview-subject">Correio de transmissão</h6>
                            <p class="text-muted mb-0">blablabla bla bla</p>
                          </div>
                          <div class="mr-auto text-sm-right pt-2 pt-sm-0">
                            <p class="text-muted">1 mes atrás</p>
                            <p class="text-muted mb-0">React Native</p>
                          </div>
                        </div>
                      </div>
                      <div class="preview-item">
                        <div class="preview-thumbnail">
                          <div class="preview-icon bg-warning">
                            <i class="mdi mdi-chart-pie"></i>
                          </div>
                        </div>
                        <div class="preview-item-content d-sm-flex flex-grow">
                          <div class="flex-grow">
                            <h6 class="preview-subject">Design UX</h6>
                            <p class="text-muted mb-0">Planejamento de novos aplicativos</p>
                          </div>
                          <div class="mr-auto text-sm-right pt-2 pt-sm-0">
                            <p class="text-muted">1 ano atrás</p>
                            <p class="text-muted mb-0">Photoshop, Adobe-illustrator</p>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <!-- Fim publicações -->

          
          <!-- Lista -->
          <div class="col-md-12 col-xl-4 grid-margin stretch-card">
            <div class="card">
              <div class="card-body">
                <h4 class="card-title">Lista de lembretes</h4>
                <div class="add-items d-flex">
                  <input type="text" class="form-control todo-list-input" placeholder="Inserir Lembrete..">
                  <button class="add btn btn-primary todo-list-add-btn">Adicionar</button>
                </div>
                <div class="list-wrapper">
                  <ul class="d-flex flex-column-reverse text-white todo-list todo-list-custom">
                    <li class="completed">
                    <li>
                      <div class="form-check form-check-primary">
                        <label class="form-check-label">
                          <input class="checkbox" type="checkbox">Intrevista com Bradesco 25/08/2023 14:00PM</label>
                      </div>
                      <i class="remove mdi mdi-close-box"></i>
                    </li>
                    <li>
                      <div class="form-check form-check-primary">
                        <label class="form-check-label">
                          <input class="checkbox" type="checkbox">Intrevista com Serasa 25/08/2023 14:00PM</label>
                      </div>
                      <i class="remove mdi mdi-close-box"></i>
                    </li>
                  </ul>
                </div>
              </div>
            </div>
          </div>
          <!-- Fim lista -->
        </div>
        <!-- Fim segunda seção -->



        <!-- Terceira seção
        <div class="row">
          <div class="col-sm-4 grid-margin">
            <div class="card">
              <div class="card-body">
                <h5>Revenue</h5>
                <div class="row">
                  <div class="col-8 col-sm-12 col-xl-8 my-auto">
                    <div class="d-flex d-sm-block d-md-flex align-items-center">
                      <h2 class="mb-0">$32123</h2>
                      <p class="text-success ml-2 mb-0 font-weight-medium">+3.5%</p>
                    </div>
                    <h6 class="text-muted font-weight-normal">11.38% Since last month</h6>
                  </div>
                  <div class="col-4 col-sm-12 col-xl-4 text-center text-xl-right">
                    <i class="icon-lg mdi mdi-codepen text-primary ml-auto"></i>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <div class="col-sm-4 grid-margin">
            <div class="card">
              <div class="card-body">
                <h5>Sales</h5>
                <div class="row">
                  <div class="col-8 col-sm-12 col-xl-8 my-auto">
                    <div class="d-flex d-sm-block d-md-flex align-items-center">
                      <h2 class="mb-0">$45850</h2>
                      <p class="text-success ml-2 mb-0 font-weight-medium">+8.3%</p>
                    </div>
                    <h6 class="text-muted font-weight-normal"> 9.61% Since last month</h6>
                  </div>
                  <div class="col-4 col-sm-12 col-xl-4 text-center text-xl-right">
                    <i class="icon-lg mdi mdi-wallet-travel text-danger ml-auto"></i>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <div class="col-sm-4 grid-margin">
            <div class="card">
              <div class="card-body">
                <h5>Purchase</h5>
                <div class="row">
                  <div class="col-8 col-sm-12 col-xl-8 my-auto">
                    <div class="d-flex d-sm-block d-md-flex align-items-center">
                      <h2 class="mb-0">$2039</h2>
                      <p class="text-danger ml-2 mb-0 font-weight-medium">-2.1% </p>
                    </div>
                    <h6 class="text-muted font-weight-normal">2.27% Since last month</h6>
                  </div>
                  <div class="col-4 col-sm-12 col-xl-4 text-center text-xl-right">
                    <i class="icon-lg mdi mdi-monitor text-success ml-auto"></i>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
        Fim terceira seção -->



        <!-- Quarta seção -->
        <div class="row ">
          <div class="col-12 grid-margin">
            <div class="card">
              <div class="card-body">
                <h4 class="card-title">Meus artigos Públicados</h4>
                <div class="table-responsive">
                  <table class="table">
                    <thead>
                      <tr>
                        <th>
                          <div class="form-check form-check-muted m-0">
                            <label class="form-check-label">
                              <input type="checkbox" class="form-check-input">
                            </label>
                          </div>
                        </th>
                        <th> Titulo </th>
                        <th> Horário </th>
                        <th> Públicação data </th>
                        <th> Status da Públicação </th>
                      </tr>
                    </thead>
                    <tbody>
                      <tr>
                        <td>
                          <div class="form-check form-check-muted m-0">
                            <label class="form-check-label">
                              <input type="checkbox" class="form-check-input">
                            </label>
                          </div>
                        </td>
                        <td> exemplo 1 </td>
                        <td> 13:00 PM </td>
                        <td> 04 Out 2023 </td>
                        <td>
                          <div class="badge badge-outline-success">Aprovado</div>
                        </td>
                      </tr>
                      <tr>
                        <td>
                          <div class="form-check form-check-muted m-0">
                            <label class="form-check-label">
                              <input type="checkbox" class="form-check-input">
                            </label>
                          </div>
                        </td>
                        <td> exemplo 2 </td>
                        <td> 16:00 PM </td>
                        <td> 12 Out 2023 </td>
                        <td>
                          <div class="badge badge-outline-warning">Pendente</div>
                        </td>
                      </tr>
                      <tr>
                        <td>
                          <div class="form-check form-check-muted m-0">
                            <label class="form-check-label">
                              <input type="checkbox" class="form-check-input">
                            </label>
                          </div>
                        </td>
                        <td> exemplo 3 </td>
                        <td> 09:00 AM </td>
                        <td> 20 Out 2023 </td>
                        <td>
                          <div class="badge badge-outline-danger">Rejeitado</div>
                        </td>
                      </tr>
                      <tr>
                        <td>
                          <div class="form-check form-check-muted m-0">
                            <label class="form-check-label">
                              <input type="checkbox" class="form-check-input">
                            </label>
                          </div>
                        </td>
                        <td> exemplo 2 </td>
                        <td> 22:00 PM </td>
                        <td> 21 Out 2023 </td>
                        <td>
                          <div class="badge badge-outline-success">Aprovado</div>
                        </td>
                      </tr>
                      <tr>
                        <td>
                          <div class="form-check form-check-muted m-0">
                            <label class="form-check-label">
                              <input type="checkbox" class="form-check-input">
                            </label>
                          </div>
                        </td>
                        <td> exemplo 2 </td>
                        <td> 10:00 AM </td>
                        <td> 22 Out 2023 </td>
                        <td>
                          <div class="badge badge-outline-success">Aprovado</div>
                        </td>
                      </tr>
                    </tbody>
                  </table>
                </div>
              </div>
            </div>
          </div>

          
        </div>
        <!-- Fim quarta seção -->
      </div>
    </div>
  </main>



  <?php 
      require_once dirname(__DIR__) . "/_layout/rodape.php";
      require_once dirname(__DIR__) . '/_layout/scriptFooter.php';
    ?>
</body>

</html>