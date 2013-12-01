<?php

if(isSet($_GET['busca'])){

    $busca = $_GET['busca'];
    $nome = $busca['nome'];
    $cnpj = $busca['cnpj'];
    $resultado = array();
    $limite = isSet($_GET['l']) ? $_GET['l'] : 100;

    try {
        //PDO em ação!
        $pdo = new PDO ( "mysql:host=localhost;dbname=checar_empresa", "root", "123");
        if(!$pdo){
           die('Erro ao criar a conexão');
       }
       else{

            // Com o objeto PDO instanciado
            // preparo uma query a ser executada
            if(empty($nome) && empty($cnpj)){
                $stmt = $pdo->prepare("SELECT * FROM ceis LIMIT ".$limite);
            }
            else{
                $nome = "%".$nome .= "%";
                $stmt = $pdo->prepare("SELECT * FROM ceis WHERE nome like %:nome% OR cnpj = :cnpj LIMIT ".$limite);
                $stmt->bindParam(":nome", $nome , PDO::PARAM_STR);
                $stmt->bindParam(":cnpj", $cnpj , PDO::PARAM_STR);
            }
            // Executa query
            $stmt->execute();

            // lembra do mysql_fetch_array?
            //PDO:: FETCH_OBJ: retorna um objeto anônimo com nomes de propriedades que
            //correspondem aos nomes das colunas retornadas no seu conjunto de resultados
            //Ou seja o objeto "anônimo" possui os atributos resultantes de sua query
            while($obj = $stmt->fetch(PDO::FETCH_OBJ )){         
                $resultado[] = $obj;
            }
            // fecho o banco
            $pdo = null;
       }     
        
    // tratamento da exeção
    } catch ( PDOException $e ) {
        echo $e->getMessage();
    }
    
}
?>

<!DOCTYPE HTML>
<html lang="en-us">
<head>
    <title>ChecarEmpresa</title>
  	<meta charset="utf-8">
    <meta name="description" content="4everyone">
    <meta name="keywords" content="4everyone">
    <meta name="author" content="4everyone">
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>	
    <link rel="stylesheet" href="css/bootstrap.css">
    <link rel="stylesheet" href="css/bootstrap-responsive.css">
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="css/mobilemenu.css">
	<link rel="icon" href="images/favicon.ico" type="image/x-icon">
	<link rel="shortcut icon" href="images/favicon.ico" type="image/x-icon" />
	<script type="text/javascript" src="js/jquery-latest.js"></script>
    <script type="text/javascript" src="js/jquery.dataTables.js"></script>
    <script type="text/javascript" src="js/bootstrap.js"></script>
    <script type="text/javascript" src="js/jquery.session.js"></script>
    <script type="text/javascript" src="js/parallax.js"></script>
    <script type="text/javascript" src="js/jquery.flexslider.js"></script>
    <script type="text/javascript" src="js/message-form.js"></script>
    <script type="text/javascript" src="js/script.js"></script>
	<script type="text/javascript">
		$(window).scroll(function () {
			if (jQuery(this).scrollTop() > 550) {
				jQuery('header').addClass('scrolled');
			} else {
				jQuery('header').removeClass('scrolled');
			}
			$('.flexslider').flexslider({
				animation: "fade",
				animationSpeed: 500,
				smoothHeight: true,
				animationLoop: true,
				touch: true,
				directionNav: false
			});
		});
    </script>
</head>
	<body>
		<div class="header_top_wrap">
        	<h1>ChecarEmpresa</h1>
            <!-- <div class="container"><div class="slogan">Serve, ainda, como ferramenta de transparência para a sociedade em geral.<br>noncommercial needs!</div></div> -->
		</div>

		<header class="home_page">
			<div class="container">
            	<div class="row">
                    <div class="span12">
                        <a class="logo" href="index.php">ChecarEmpresa</a>
                        <button class="nav-button">menu</button>
                        <ul class="menu">
                            <li><a class="home" href="#home">Inicio</a></li>
                            <li><a class="search" href="#search">Buscar</a></li>
                            <li><a class="graphs" href="#graphs">Gráficos</a></li>                            
                            <li><a class="about" href="#about">Sobre</a></li>
                          
                        </ul>
                    </div>
                </div>
			</div><!--/container-->
		</header>		
		<div class="container-fill">
			<div class="row_1" id="search">
                <div class="container">
                    <h3 class="border">Busca</h3>
                    <div class="row">
                        <form class="form-inline" action="index.php" method="get" >
                        <article id="busca" class="span12">
                            <div class="form-group span6">
                                <label for="nome" class="span3">Nome, Razão social ou Nome fantasia</label>
                                <input id="nome" name="busca[nome]" class="form-control" type="text">
                            </div>
                            <div class="form-group span4">
                                <label for="cnpj" class="">CNPJ/CPF</label>
                                <input id="cnpj" name="busca[cnpj]" class="form-control" type="text">
                            </div>
                            <div class="form-group span1">
                                <input type="submit" value="Filtrar" class="btn btn_1">
                            </div>

                            <div class="form-group span11">
                               <div class="accordion" id="accordion2">
                                    <div class="accordion-group" style="border:0;padding-left:15px;">
                                        <div class="accordion-heading">
                                            <a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion2" href="#collapseOne" style="color:gray;
                                            text-decoration: underline;  font-size:15px;">
                                                Busca Avançada
                                            </a>
                                        </div>
                                         <div id="collapseOne" class="accordion-body collapse" style="overflow:auto">
                                            <div class="accordion-inner">
                                                <label>Tipo:</label>
                                                <label class="checkbox"><input type="checkbox" name="inputWalls" id="inputWalls" value="juridica" checked>Jurídica </label>
                                                <label class="checkbox"><input type="checkbox" name="inputWalls" id="inputWalls" value="fisica" checked  style="padding-left:30px;">Física</label>


                                                <div class="btn-group" style="padding-left:30px;">
                                                    <ul>
                                                        <li>
                                                            <div class="btn-group ">
                                                                  <button type="button" class="btn btn-default" style="width:90px;">UF</button>
                                                                  <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown">
                                                                    <span class="caret"></span>
                                                                    <span class="sr-only"></span>
                                                                  </button>
                                                                  <ul class="dropdown-menu">
                                                                    <!-- Dropdown menu links -->
                                                                  </ul>
                                                                </div>
                                                        </li>
                                                        <li>
                                                            <div class="btn-group ">
                                                                  <button type="button" class="btn btn-default" style="width:130px;">Orgão</button>
                                                                  <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown">
                                                                    <span class="caret"></span>
                                                                    <span class="sr-only"></span>
                                                                  </button>
                                                                  <ul class="dropdown-menu">
                                                                    <!-- Dropdown menu links -->
                                                                  </ul>
                                                                </div>
                                                        </li>
                                                        <li>
                                                            <div class="btn-group ">
                                                                  <button type="button" class="btn btn-default" style="width:130px;">Motivo</button>
                                                                  <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown">
                                                                    <span class="caret"></span>
                                                                    <span class="sr-only"></span>
                                                                  </button>
                                                                  <ul class="dropdown-menu">
                                                                    <!-- Dropdown menu links -->
                                                                  </ul>
                                                                </div>
                                                        </li>

                                              </ul>
                                                </div>
                                            
                                            </div>

                                             <div class="accordion-inner" style="border-top:0" >
                                                
                                                              <div class="clear-margim span3">
                                                                    <label for="data_inicio" class="">Data Ínicio</label>
                                                                    <input id="data_inicio" name="data_inicio" class="form-control" type="text" style="width:150px;">
                                                              </div>
                                                       
                                                              <div class="clear-margim span3">
                                                                    <label for="data_fim" class="">Data Fim</label>
                                                                    <input id="data_fim" name="data_fim" class="form-control" type="text" style="width:150px;">
                                                              </div>
                                                              <div class="clear-margim span4">
                                                                    <label for="num_processo" class="">N° Processo</label>
                                                                    <input id="num_processo" name="num_processo" class="form-control" type="text" style="width:230px;">
                                                              </div>                                                        

                                                </div>                                        

                                            
                                                                                            
                                          </div>
                                        </div>
                                    </div>
                    </div>



                        </article>
                        <article id="resultado">
                            <?php if(isSet($_GET['busca'])){ ?>
                                <div class="table-responsive span12">
                                  <table id="table_resultado" class="table table-striped">
                                    <thead>
                                    <tr role="row">
                                        <th>#</th>
                                        <th>Nome</th>
                                        <th>CNPJ/CPF</th>
                                        <th>Tipo de Sanção</th>
                                        <th>Data de inicio da Sanção</th>
                                        <th>Data de fim da Sanção</th>
                                        <th>Orgão Sancionador</th>
                                        <th>Origem da Informação</th>
                                        <th>Data da Informação</th>
                                    <tr>
                                    </thread>
                                    <tbody>
                                        <?php if(empty($resultado)){
                                            echo "<tr><td colspan='100'>Sem resultado.</td></tr>";
                                        }else{
                                            foreach ($resultado as $key => $obj){
                                               echo "<tr>";
                                               echo "<td>".($key+1)."</td>";
                                               echo "<td>".$obj->nome."</td>";
                                               echo "<td>".$obj->cnpj_cpf."</td>";
                                               echo "<td>".utf8_encode($obj->tipo_sancao)."</td>";
                                               echo "<td>".utf8_encode($obj->data_inicio)."</td>";
                                               echo "<td>".utf8_encode($obj->data_fim)."</td>";
                                               echo "<td>".utf8_encode($obj->orgao)."</td>";
                                               echo "<td>".utf8_encode($obj->origem_informacao)."</td>";
                                               echo "<td>".utf8_encode($obj->data_informacao)."</td>";
                                               echo "</tr>";
                                            }
                                        }?>
                                    </tbody>
                                  </table>
                                  <?php
                                  echo "<a href='index.php?busca[nome]=".$busca['nome']."&busca[cnpj]=".$busca['cnpj']."&l=".($limite+100)."' class='btn btn_1 right'>MAIS</a>
                                    </div>";
                                    ?>
                            <?php } ?>
                        </article>
                        </form>
                    </div>
                </div>
            </div>
            <div class="row_1">
                <div class="container" id="graphs">
                    <h3 class="border">What We Do</h3>
                    <div class="row">
                        <article class="span4 box_1">
                            <div class="icon_bg"><img src="images/icon-1.png" alt=""></div>
                            <h6><a href="#">Strategy</a></h6>
                            <p>Lorem ipsum dolor sit ametet<br>uer adipiscing elit, sed diam nonummy nibh euismod tincidu.</p>
                            <a href="#" class="btn btn_1">read more</a>
                        </article>
                        <article class="span4 box_1">
                            <div class="icon_bg"><img src="images/icon-2.png" alt=""></div>
                            <h6><a href="#">user experience</a></h6>
                            <p>Lorem ipsum dolor sit ametet<br>uer adipiscing elit, sed diam nonummy nibh euismod tincidu.</p>
                            <a href="#" class="btn btn_1">read more</a>
                        </article>
                        <article class="span4 box_1">
                            <div class="icon_bg"><img src="images/icon-3.png" alt=""></div>
                            <h6><a href="#">design</a></h6>
                            <p>Lorem ipsum dolor sit ametet<br>uer adipiscing elit, sed diam nonummy nibh euismod tincidu.</p>
                            <a href="#" class="btn btn_1">read more</a>
                        </article>
                    </div>
                    <div class="row">
                        <article class="span4 box_1">
                            <div class="icon_bg"><img src="images/icon-4.png" alt=""></div>
                            <h6><a href="#">development</a></h6>
                            <p>Lorem ipsum dolor sit ametet<br>uer adipiscing elit, sed diam nonummy nibh euismod tincidu.</p>
                            <a href="#" class="btn btn_1">read more</a>
                        </article>
                        <article class="span4 box_1">
                            <div class="icon_bg"><img src="images/icon-5.png" alt=""></div>
                            <h6><a href="#">Wordpress</a></h6>
                            <p>Lorem ipsum dolor sit ametet<br>uer adipiscing elit, sed diam nonummy nibh euismod tincidu.</p>
                            <a href="#" class="btn btn_1">read more</a>
                        </article>
                        <article class="span4 box_1">
                            <div class="icon_bg"><img src="images/icon-6.png" alt=""></div>
                            <h6><a href="#">ceo</a></h6>
                            <p>Lorem ipsum dolor sit ametet<br>uer adipiscing elit, sed diam nonummy nibh euismod tincidu.</p>
                            <a href="#" class="btn btn_1">read more</a>
                        </article>
                    </div>
                </div>
            </div>
            <div class="row_1" >
                 <div id="contact">
                <div class="map_wrapper" >
                    <div class="row_1" id="work">
                        <div class="container" id="work">
                            <h3 class="border">Top Inidônios</h3>
                            
                                <div class="row gallery_wrapper">
                                    <section class="span3 gallery_item gallery_item_1">
                                        <figure class="">                                            
                                            <img src="images/gallery_item_bg 1.png" alt="">
                                            <figcaption>                                                
                                                <p><strong>1&ordm; - </strong>Wordpress Theme Front-End Development</p>
                                                <h2>BA</h2>
                                                <h2>20<span>%</span></h2>
                                            </figcaption>
                                        </figure>
                                    </section>
                                    <section class="span3 gallery_item gallery_item_2">
                                        <figure class="">
                                            <img src="images/gallery_item_bg 2.png" alt="">
                                            <figcaption>                                                
                                                <p><strong>2&ordm; - </strong>Wordpress Theme Front-End Development</p>
                                                <h2>SP</h2>
                                                <h2>20<span>%</span></h2>
                                            </figcaption>
                                        </figure>
                                    </section>
                                    <section class="span3 gallery_item gallery_item_3">
                                        <figure class="">

                                            <img src="images/gallery_item_bg 1.png" alt="">

                                            <figcaption>
                                                <p><strong>3&ordm; - </strong>Wordpress Theme Front-End Development</p>
                                                <h2>RJ</h2>
                                                <h2>60<span>%</span></h2>
                                               
                                            </figcaption>
                                        </figure>
                                    </section>
                                </div>
                                </div>
                            </div>
                        </div>
                    </div>
            </div>
            
            <div id="about">
            	<div class="map_wrapper">
                    <div class="container">
                        <h3 class="border">Send Us a Message</h3>
                        <div class="row">
                            <section class="span3">
                            	<div class="indent1">
                                	<h6>postal address</h6>
                                    <h5><span>Ground Floor 49 Cheltenham Place Brighton</span></h5>
                                    <h5 class="color_1">Monday - Thursday 5:30AM - 10PM</h5>
                                    <h5 class="color_1">T - 123.456.7890<br>F - 123.789.3456</h5>
                                    <h6><a href="mailto:@oursitemail.com">@oursitemail.com</a></h6>
                                </div>
                            </section>
                            <section class="span9">
                            	<div class="indent2">
                                	<h6>Do you have a cool idea? Drop us a line or two.</h6>
                                    <form id="message_form">
                                        <div class="success"></div>
                                        <fieldset>
                                            <div class="row">
                                                <div class="span3">
                                                    <label class="name">
                                                        <input type="text" value="Your Name">
                                                    </label>
                                                    <label class="email">
                                                        <input type="text" value="Email">
                                                    </label>
                                                    <label class="notRequired">
                                                        <input type="text" value="Website">
                                                    </label>
                                                </div>
                                                <div class="span4">
                                                    <label class="message">
                                                        <textarea>Message</textarea>
                                                    </label>
                                                    <a class="btn btn_1" data-type="submit">Send Message</a>
                                                </div>
                                            </div>
                                        </fieldset>
                                    </form>
                                </div>
                            </section>

                        </div>
                    </div>
                </div>
            </div>
            <footer>
                <div class="container">
                    <div class="row">
                        <div class="span12 text-center">
                            &copy; 2013
                        </div>
                    </div>
                </div>
            </footer>
		</div><!--/container-fill-->
<script type="text/javascript">
	$(window).load(function(){
		$('#message_form').forms({
			ownerEmail:'test@test.test'
		});
	})
</script>
</body>
</html>