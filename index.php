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
                            <li><a class="about" href="#about">Sobre</a></li>
                            <li><a class="work" href="#work">Work</a></li>                            
                            <li><a class="contact" href="#contact">Contato</a></li>
                        </ul>
                    </div>
                </div>
			</div><!--/container-->
		</header>		
		<div class="container-fill">
			<div class="row_1" id="about">
                <div class="container">
                    <h3 class="border">Busca</h3>
                    <div class="row">
                        <form class="form-inline">
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
                                <input type="submit" value="Filtrar" class="btn btn-default">
                            </div>
                        </article>
                        <article id="resultado" class="span12">
                            
                        </article>
                        </form>
                    </div>
                </div>
            </div>
            <div class="row_1">
                <div class="container">
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
            <div class="row_1" id="work">
                <div class="container">
                    <h3 class="border">Selected Work</h3>
                    <div class="row">
                        <article class="span8 offset2 text-center">
                            <p>Here is a selection of some works we're craftes over the last few months<br>Click the button below, If you would like to see more.</p>
                            <div><a href="#" class="btn btn_1">see more of our Works</a></div>
                        </article>
                    </div>
                    <div class="row gallery_wrapper">
                    	<section class="span3 gallery_item gallery_item_1">
                        	<figure class="">
                            	<img src="images/gallery_img_1.png" alt="">
                                <figcaption>
                                	<p>Wordpress Theme Front-End Development</p>
                                    <h6>website</h6>
                                    <h6><a href="#">Read details</a></h6>
                                </figcaption>
                            </figure>
                        </section>
                    	<section class="span3 gallery_item gallery_item_2">
                        	<figure class="">
                            	<img src="images/gallery_img_2.png" alt="">
                                <figcaption>
                                	<p>Wordpress Theme Front-End Development</p>
                                    <h6>website</h6>
                                    <h6><a href="#">Read details</a></h6>
                                </figcaption>
                            </figure>
                        </section>
                    	<section class="span3 gallery_item gallery_item_3">
                        	<figure class="">
                            	<img src="images/gallery_img_3.png" alt="">
                                <figcaption>
                                	<p>Wordpress Theme Front-End Development</p>
                                    <h6>website</h6>
                                    <h6><a href="#">Read details</a></h6>
                                </figcaption>
                            </figure>
                        </section>
                    	<section class="span3 gallery_item gallery_item_4">
                        	<figure class="">
                            	<img src="images/gallery_img_4.png" alt="">
                                <figcaption>
                                	<p>Wordpress Theme Front-End Development</p>
                                    <h6>website</h6>
                                    <h6><a href="#">Read details</a></h6>
                                </figcaption>
                            </figure>
                        </section>
                    	<section class="span3 gallery_item gallery_item_5">
                        	<figure class="">
                            	<img src="images/gallery_img_5.png" alt="">
                                <figcaption>
                                	<p>Wordpress Theme Front-End Development</p>
                                    <h6>website</h6>
                                    <h6><a href="#">Read details</a></h6>
                                </figcaption>
                            </figure>
                        </section>
                    	<section class="span3 gallery_item gallery_item_6">
                        	<figure class="">
                            	<img src="images/gallery_img_6.png" alt="">
                                <figcaption>
                                	<p>Wordpress Theme Front-End Development</p>
                                    <h6>website</h6>
                                    <h6><a href="#">Read details</a></h6>
                                </figcaption>
                            </figure>
                        </section>
                    	<section class="span3 gallery_item gallery_item_7">
                        	<figure class="">
                            	<img src="images/gallery_img_7.png" alt="">
                                <figcaption>
                                	<p>Wordpress Theme Front-End Development</p>
                                    <h6>website</h6>
                                    <h6><a href="#">Read details</a></h6>
                                </figcaption>
                            </figure>
                        </section>
                    	<section class="span3 gallery_item gallery_item_8">
                        	<figure class="">
                            	<img src="images/gallery_img_8.png" alt="">
                                <figcaption>
                                	<p>Wordpress Theme Front-End Development</p>
                                    <h6>website</h6>
                                    <h6><a href="#">Read details</a></h6>
                                </figcaption>
                            </figure>
                        </section>
                    	<section class="span3 gallery_item gallery_item_9">
                        	<figure class="">
                            	<img src="images/gallery_img_9.png" alt="">
                                <figcaption>
                                	<p>Wordpress Theme Front-End Development</p>
                                    <h6>website</h6>
                                    <h6><a href="#">Read details</a></h6>
                                </figcaption>
                            </figure>
                        </section>
                    	<section class="span3 gallery_item gallery_item_10">
                        	<figure class="">
                            	<img src="images/gallery_img_10.png" alt="">
                                <figcaption>
                                	<p>Wordpress Theme Front-End Development</p>
                                    <h6>website</h6>
                                    <h6><a href="#">Read details</a></h6>
                                </figcaption>
                            </figure>
                        </section>
                    </div>
                </div>
            </div>
            <div class="row_1">
                <div class="container">
                    <h3 class="border">Meet Our Team</h3>
                    <div class="row">
                        <article class="span10 offset1">
                            <p class="text-center">Before starting any project we always make sure to get to know our clients first. We not only want to learn what it is you're looking for , but also why.</p>
                        </article>
                    </div>
                    <div class="row">
                        <article class="span3">
                            <figure class="figure">
                                <img src="images/img-1.jpg" alt="">
                                <figcaption>
                                    <h5><a href="#">Tom Smith</a></h5>
                                    <h6>Founder</h6>
                                    <div class="wrapper">
                                        <ul class="soc_list">
                                            <li><a href="#"><img src="images/soc-icon-1.png" alt=""></a></li>
                                            <li><a href="#"><img src="images/soc-icon-2.png" alt=""></a></li>
                                            <li><a href="#"><img src="images/soc-icon-3.png" alt=""></a></li>
                                            <li><a href="#"><img src="images/soc-icon-4.png" alt=""></a></li>
                                            <li><a href="#"><img src="images/soc-icon-5.png" alt=""></a></li>
                                            <li><a href="#"><img src="images/soc-icon-6.png" alt=""></a></li>
                                        </ul>
                                    </div>
                                    <h6><a href="#">@tomsmith</a></h6>
                                </figcaption>
                            </figure>
                        </article>
                        <article class="span3">
                            <figure class="figure">
                                <img src="images/img-2.jpg" alt="">
                                <figcaption>
                                    <h5><a href="#">Sam Peterson</a></h5>
                                    <h6>developer</h6>
                                    <div class="wrapper">
                                        <ul class="soc_list">
                                            <li><a href="#"><img src="images/soc-icon-1.png" alt=""></a></li>
                                            <li><a href="#"><img src="images/soc-icon-2.png" alt=""></a></li>
                                            <li><a href="#"><img src="images/soc-icon-3.png" alt=""></a></li>
                                            <li><a href="#"><img src="images/soc-icon-4.png" alt=""></a></li>
                                            <li><a href="#"><img src="images/soc-icon-5.png" alt=""></a></li>
                                            <li><a href="#"><img src="images/soc-icon-6.png" alt=""></a></li>
                                        </ul>
                                    </div>
                                    <h6><a href="#">@sampeterson</a></h6>
                                </figcaption>
                            </figure>
                        </article>
                        <article class="span3">
                            <figure class="figure">
                                <img src="images/img-3.jpg" alt="">
                                <figcaption>
                                    <h5><a href="#">Andy W. Braun</a></h5>
                                    <h6>designer</h6>
                                    <div class="wrapper">
                                        <ul class="soc_list">
                                            <li><a href="#"><img src="images/soc-icon-1.png" alt=""></a></li>
                                            <li><a href="#"><img src="images/soc-icon-2.png" alt=""></a></li>
                                            <li><a href="#"><img src="images/soc-icon-3.png" alt=""></a></li>
                                            <li><a href="#"><img src="images/soc-icon-4.png" alt=""></a></li>
                                            <li><a href="#"><img src="images/soc-icon-5.png" alt=""></a></li>
                                            <li><a href="#"><img src="images/soc-icon-6.png" alt=""></a></li>
                                        </ul>
                                    </div>
                                    <h6><a href="#">@andywbraun</a></h6>
                                </figcaption>
                            </figure>
                        </article>
                        <article class="span3">
                            <figure class="figure">
                                <img src="images/img-4.jpg" alt="">
                                <figcaption>
                                    <h5><a href="#">Sarah Smith</a></h5>
                                    <h6>clients support</h6>
                                    <div class="wrapper">
                                        <ul class="soc_list">
                                            <li><a href="#"><img src="images/soc-icon-1.png" alt=""></a></li>
                                            <li><a href="#"><img src="images/soc-icon-2.png" alt=""></a></li>
                                            <li><a href="#"><img src="images/soc-icon-3.png" alt=""></a></li>
                                            <li><a href="#"><img src="images/soc-icon-4.png" alt=""></a></li>
                                            <li><a href="#"><img src="images/soc-icon-5.png" alt=""></a></li>
                                            <li><a href="#"><img src="images/soc-icon-6.png" alt=""></a></li>
                                        </ul>
                                    </div>
                                    <h6><a href="#">@sarahsmith</a></h6>
                                </figcaption>
                            </figure>
                        </article>
                    </div>
                </div>
            </div>
            <div class="row_1">
                <div class="container">
                    <h3 class="border">What Our Clients Say</h3>
                    <div class="row">
                        <article class="span12">
                            <div class="slider-wrapper">
                                <div class="flexslider">
                                    <ul class="slides">
                                        <li>
                                        	<h6><a href="#">allan Pete</a> <span>, usa</span></h6>
                                        	<p>"Lorem ipsum dolor sit ametet<br>uer adipiscing elit, sed diam nonummy nibh euismod tincidu. nt ut laordolore magna aliquam."</p>
                                        </li>
                                        <li>
                                        	<h6><a href="#">Sam Peterson</a> <span>, usa</span></h6>
                                        	<p>"Ut wisi enim ad minim veniam, quis nostrud exerci tation ullam corper suscipit lobortis nisl ut. Ut wisi enim ad minim veniam, quis nostrud exerci tation ullam corper suscipit lobortis nisl ut."</p>
                                        </li>
                                        <li>
                                        	<h6><a href="#">Sarah Smith</a> <span>, usa</span></h6>
                                        	<p>"Sed diam nonummy nibh euismod tincidu. nt ut laordolore magna aliquam. Lorem ipsum dolor sit ametet<br>uer adipiscing elit"</p>
                                        </li>
                                    </ul>
                                </div><!--/flexslider-->
                            </div><!--/slider-wrapper-home-->		
                        </article>
                    </div>
                </div>
            </div>
            <div class="row_1">
                <div class="container">
                    <h3 class="border">The Blog</h3>
                    <div class="row">
                        <article class="span12">
                            <p class="text-center">If you want to read more of our posts. <a href="blog.htm" class="btn btn_1">click here</a></p>
                        </article>
                        <section class="span3">
                            <div class="blog_post_preview blog_post_preview_bg">
                                <h6><time datetime="2013-01-01" class="time">august 28,2012</time></h6>
                                <h5><a href="blog_post.htm">Lorem ipsum dolor sit amet, consectetuer adipiscing!</a></h5>
                                <p>Elit, sed diam nonummy nibh euismod tincidunt ut laoreet dolore magna aliquam...</p>
                                <a href="blog_post.htm" class="btn btn_1">view post</a>
                            </div>
                        </section>
                        <section class="span3">
                            <div class="blog_post_preview blog_post_preview_bg_no">
                                <h6><time datetime="2013-01-01" class="time">august 28,2012</time></h6>
                                <figure class="">
                                    <img src="images/img-5.jpg" alt="">
                                </figure>
                                <h5><a href="blog_post.htm">Ipsum dolorsit ame consectetu.</a></h5>
                                <p>Elit, sed diam nonummy nibh euismod tincidunt ut laoreet dolore magna aliquam...</p>
                                <a href="blog_post.htm" class="btn btn_1">view post</a>
                            </div>
                        </section>
                        <section class="span3">
                            <div class="blog_post_preview blog_post_preview_bg">
                                <h6><time datetime="2013-01-01" class="time">august 28,2012</time></h6>
                                <figure class="">
                                    <img src="images/img-6.jpg" alt="">
                                </figure>
                                <h5><a href="blog_post.htm">Ipsum dolor sit amet, consectetuer adipiscing  elit, sed diam nonum.</a></h5>
                                <p>Elit, sed diam nonummy nibh euismod tincidunt ut laoreet dolore.</p>
                                <a href="blog_post.htm" class="btn btn_1">view post</a>
                            </div>
                        </section>
                        <section class="span3">
                            <div class="blog_post_preview blog_post_preview_bg_no">
                                <h6><time datetime="2013-01-01" class="time">august 28,2012</time></h6>
                                <h5><a href="blog_post.htm">Lorem ipsum dolor sit amet, consectetuer adipiscing!</a></h5>
                                <p>Elit, sed diam nonummy nibh euismod tincidunt ut laoreet dolore magna aliquam...</p>
                                <a href="blog_post.htm" class="btn btn_1">view post</a>
                            </div>
                        </section>
                    </div>
                </div>
            </div>
            <div class="row_1">
                <div class="container">
                    <h3 class="border">Stay In Touch</h3>
                    <div class="row">
                    	<ul class="soc_list_2">
                        	<li class="span2 offset1"><div><a href="#"><img src="images/soc-icon-7.png" alt=""></a></div></li>
                        	<li class="span2"><div><a href="#"><img src="images/soc-icon-8.png" alt=""></a></div></li>
                        	<li class="span2"><div><a href="#"><img src="images/soc-icon-9.png" alt=""></a></div></li>
                        	<li class="span2"><div><a href="#"><img src="images/soc-icon-10.png" alt=""></a></div></li>
                        	<li class="span2"><div><a href="#"><img src="images/soc-icon-11.png" alt=""></a></div></li>
                        </ul>
                    </div>
                </div>
            </div>
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
            <footer>
                <div class="container">
                    <div class="row">
                        <div class="span12 text-center">
                            &copy; 2013 Yashma Themes &nbsp; | &nbsp; all Rights Reserved
                        </div>
                    </div>
                </div>
            </footer>
		</div><!--/container-fill-->
<script type="text/javascript">
	$(window).load(function(){
		$('#message_form').forms({
			ownerEmail:'test@test.test'
		})
	})
</script>
</body>
</html>