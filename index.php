<?php
//PDO em ação!
$pdo = new PDO ( "mysql:host=us-cdbr-east-04.cleardb.com;dbname=heroku_3acb595e064fe48", "bd5233fd978702", "57345e20");

if(!$pdo){
   die('Erro ao criar a conexão');
}

function getTopInidonio($pdo){
    $ranking = array();
    try {
       if($pdo){
            // Com o objeto PDO instanciado
            // preparo uma query a ser executada
            $stmt = $pdo->prepare("SELECT nome, COUNT(*) as qtd, uf_pessoa FROM `ceis` GROUP BY cnpj_cpf ORDER BY qtd desc LIMIT 3");
            
            // Executa query
            $stmt->execute();

            // lembra do mysql_fetch_array?
            //PDO:: FETCH_OBJ: retorna um objeto anônimo com nomes de propriedades que
            //correspondem aos nomes das colunas retornadas no seu conjunto de resultados
            //Ou seja o objeto "anônimo" possui os atributos resultantes de sua query
            while($obj = $stmt->fetch(PDO::FETCH_OBJ )){         
                $ranking[] = $obj;
            }
       }       
    // tratamento da exeção
    } catch ( PDOException $e ) {
        echo $e->getMessage();
    }    
    return $ranking;
}

$ranking = getTopInidonio($pdo);

$tipo_sancao = array();
$orgao = array();

function getTipoSancao($pdo){
        
    if(!$pdo){
        die('Erro ao criar a conexão!');
    }
    else{
        $stmt = $pdo->prepare("SELECT DISTINCT tipo_sancao FROM ceis order by tipo_sancao");
        $stmt->execute();

        while($obj = $stmt->fetch(PDO::FETCH_OBJ )){         
            $tipo_sancao[] = $obj;
        }
    }

    return $tipo_sancao;
}

function getOrgao($pdo){

    if(!$pdo){
       die('Erro ao criar a conexão!');
    }
    else{
        $stmt = $pdo->prepare("SELECT DISTINCT orgao FROM ceis order by orgao");
        $stmt->execute();

        while($obj = $stmt->fetch(PDO::FETCH_OBJ )){         
            $orgao[] = $obj;
        }
    }
    return $orgao;
}

$tipo_sancao= getTipoSancao($pdo);
$orgao= getOrgao($pdo);

if(isSet($_GET['busca'])){

    $busca = $_GET['busca'];
    $nome = $busca['nome'];
    $cnpj = $busca['cnpj'];
    $resultado = array();
    $limite = isSet($_GET['l']) ? $_GET['l'] : 100;

    try {
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
    <link rel="stylesheet" href="css/mobilemenu.css">
    <link rel="stylesheet" href="http//cdn.oesmith.co.uk/morris-0.4.3.min.css">
    <link rel="icon" href="images/favicon.ico" type="image/x-icon">
    <link rel="shortcut icon" href="images/favicon.ico" type="image/x-icon" />
    <script src="//ajax.googleapis.com/ajax/libs/jquery/1.9.0/jquery.min.js"></script>
    <script type="text/javascript" src="js/jquery.dataTables.js"></script>
    <script type="text/javascript" src="js/bootstrap.js"></script>
    <script type="text/javascript" src="js/jquery.session.js"></script>
    <script type="text/javascript" src="js/parallax.js"></script>
    <script type="text/javascript" src="js/jquery.flexslider.js"></script>
    <script type="text/javascript" src="js/message-form.js"></script>
    <script type="text/javascript" src="js/script.js"></script>
    <script src="//cdnjs.cloudflare.com/ajax/libs/raphael/2.1.0/raphael-min.js"></script>
    <script src="http//cdn.oesmith.co.uk/morris-0.4.3.min.js"></script>
	  <script type="text/javascript">

    overflow = true;

    $(document).ready(function() {

         $('#lbl_busca').click(function() { 
          if(overflow){
            $('#collapseOne').css("overflow","initial");
            overflow=false;
          }else{
            
            $('#collapseOne').css("overflow","auto");
            overflow=true;
          }
         });   
    });

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
                                            <a id="lbl_busca" class="accordion-toggle" data-toggle="collapse" data-parent="#accordion2" href="#collapseOne" style="color:gray;
                                            text-decoration: underline;  font-size:15px;">
                                                Busca Avançada
                                            </a>
                                        </div>
                                         <div id="collapseOne" class="accordion-body collapse" style="overflow:auto">
                                            <div class="accordion-inner">
                                                <label>Tipo:</label>
                                                <label class="checkbox"><input type="checkbox" name="ck_juridica" id="ck_juridica" value="ck_juridica"  checked >Jurídica </label>
                                                <label class="checkbox"><input type="checkbox" name="inputWalls" id="inputWalls" value="fisica" checked  style="padding-left:30px;">Física</label>


                                                <div class="btn-group" style="padding-left:30px;">
                                                    <ul class="avancada">
                                                        <li>
                                                            <div class="btn-group ">
                                                                  <button type="button" class="btn btn-default" style="width:90px;">UF</button>
                                                                  <button id="dd_uf" type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown">
                                                                    <span class="caret"></span>
                                                                    <span class="sr-only"></span>
                                                                  </button>
                                                                  <ul class="dropdown-menu">

                                                                     <li></li>
                                                                     <li>AC</li>
                                                                     <li>AL</li>
                                                                     <li>AM</li>
                                                                     <li>AP</li>
                                                                     <li>BA</li>
                                                                     <li>CE</li>
                                                                     <li>DF</li>
                                                                     <li>ES</li>
                                                                     <li>GO</li>
                                                                     <li>MA</li>
                                                                     <li>MG</li>
                                                                     <li>MS</li>
                                                                     <li>MT</li>
                                                                     <li>PA</li>
                                                                     <li>PB</li>
                                                                     <li>PE</li>
                                                                     <li>PI</li>
                                                                     <li>PR</li>
                                                                     <li>RJ</li>
                                                                     <li>RN</li>
                                                                     <li>RO</li>
                                                                     <li>RR</li>
                                                                     <li>RS</li>
                                                                     <li>SC</li>
                                                                     <li>SE</li>
                                                                     <li>SP</li>
                                                                     <li>TO</li>

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
                                                                    <li></li>
                                                                   
                                                                    <?php

                                                                    foreach ($orgao as $key => $obj){                                                                   
                                                                       
                                                                       echo "<li>".utf8_encode($obj->orgao)."</li>";
                                                                                                                                              
                                                                    }

                                                                    ?>
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
                                                                     <li></li>
                                                                   
                                                                    <?php

                                                                    foreach ($tipo_sancao as $key => $obj){                                                                   
                                                                       
                                                                       echo "<li>".utf8_encode($obj->tipo_sancao)."</li>";
                                                                                                                                              
                                                                    }

                                                                    ?>
                                                                    
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
                                    </thead>
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

            <div id="myfirstchart" style="height: 250px;"></div>

            <div class="row_1">
                <div class="container" id="graphs">
                    <h3 class="border">Dados</h3>
                    <div class="row">
                        <article class="span8">                            
                      
                        <div id="graph"></div>
                          </article>
                        <script type="text/javascript">
                        // Use Morris.Bar
                        Morris.Bar({
                          element: 'graph',
                          data: [
                            {x: '2011 Q1', y: 25},
                            {x: '2011 Q2', y: 1},
                            {x: '2011 Q3', y: 2},
                            {x: '2011 Q4', y: 3},
                            {x: '2012 Q1', y: 4},
                            {x: '2012 Q2', y: 5},
                            {x: '2012 Q3', y: 6},
                            {x: '2012 Q4', y: 7},
                            {x: '2013 Q1', y: 8}
                          ],
                          xkey: 'x',
                          ykeys: ['y'],
                          labels: ['Y'],
                          barColors: function (row, series, type) {
                            this.ymax = 15;
                            if (type === 'bar') {
                              var red = Math.ceil(255 * row.y / this.ymax);
                              return 'rgb(' + red + ',0,0)';
                            }
                            else {
                              return '#000';
                            }
                          }
                        });
                        </script>                       
                    </div>
                    <div class="row">
                        <article class="span8">
                            <div id="graph2"></div>
                        </article>
                        <script type="type/javascript">
                        Morris.Donut({
                          element: 'graph2',
                          data: [
                            {value: 70, label: 'foo'},
                            {value: 15, label: 'bar'},
                            {value: 10, label: 'baz'},
                            {value: 5, label: 'A really really long label'}
                          ],
                          formatter: function (x) { return x + "%"}
                        }).on('click', function(i, row){
                          console.log(i, row);
                        });
                        </script>
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
                                <?php
                                foreach ($ranking as $key => $obj){
                                ?>
                                <section class="span3 gallery_item gallery_item_<?=($key+1)?>">
                                    <figure class="">                           
                                        <img src="images/gallery_item_bg <?=($key%2 + 1)?>.png" alt="">
                                        <figcaption>                   
                                            <p><strong><?=($key+1)?> - </strong><?=$obj->nome?></p>
                                            <h2><?=$obj->uf_pessoa?></h2>
                                            <h2><?=$obj->qtd?></h2>
                                        </figcaption>
                                    </figure>
                                </section>  
                                <?php  
                                }
                                ?>
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

  new Morris.Donut({
    // ID of the element in which to draw the chart.
    element: 'myfirstchart',
    // Chart data records -- each entry in this array corresponds to a point on
    // the chart.
    data: [
      { label: '2008', value: 20 },
      { label: '2009', value: 10 },
      { label: '2010', value: 5 },
      { label: '2011', value: 5 },
      { label: '2012', value: 20 }
    ],
    // // The name of the data record attribute that contains x-values.
    // xkey: 'year',
    // // A list of names of data record attributes that contain y-values.
    // ykeys: ['value'],
    // // Labels for the ykeys -- will be displayed when you hover over the
    // // chart.
    // labels: ['Value']
  }); 

</script>
</body>
</html>