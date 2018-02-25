<!doctype html>
<html lang="fr">
	<head>
	    <meta charset="utf-8" />
	    <title><?php echo $title ?></title>
	   	<meta name="description" content="Un site dédié aux modèles vivants." />
	    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" />
		<link href="https://fonts.googleapis.com/css?family=Merienda+One" rel="stylesheet">
	    <link rel="stylesheet" href="./Public/css/style.css" type="text/css" />
	    <meta name="viewport" content="initial-scale=1.0" />
	    <link rel="icon" type="image/png" href="./Public/img/favicon.png" />
	</head>

<!-- HEADER -->
	<body>
		<div class="container-fluid headerContainer">
			<div class="row headerRow">
				<div id="header" class="col-md">
					<div id="titleBlog">
			            <a href="index.php"><h1>MODELES VIVANTS</h1></a>
			        </div>
			    </div>
			</div>
		</div>

<!-- SIDEBAR -->
		<div class="container-fluid sidebarContainer">
			<div class="row sidebarRow">
				<div id="sidebar" class="col-md-4">

	<!-- INTRODUCTION -->
					<div id="titleSidebar">
			            <a href="index.php">
			            	<h1 id="title">Modèles vivants</h1>
			        	</a>

			        	<div id="introduction">
			        		<div>
					        	<a href="index.php">
					        		<img class="logo" src="./Public/img/logo.png" alt="logo_MV" />
					        	</a>
					        </div>

					        <div id="textIntro">
					        	<p>Bienvenue sur ce site dédié aux modèles vivants, qui s'adresse aux modèles, aux artistes et aux curieux.<br />
			                	J'y parlerais de ce métier original via des anecdotes vécues et rapportées, mais aussi des bonnes pratiques à avoir.</p>
			                </div>
					    </div>
			        </div>

	<!-- MENU -->
			        <div class="menu">
						<div id="menuLinks">
							<nav>
								<ul>
									<li><a href="index.php?action=tutos">Tutos, partage d'expériences</a></li>
									<li><a href="index.php?action=marketplace">Achat de matériel</a></li>
									<li><a href="index.php?action=advertisements">Petites annonces</a></li>
									<li><a href="index.php?action=friends">Le coin des copains</a></li>
									<li><a href="index.php?action=contact">Contact<i class="fas fa-paper-plane"></i></a></li>
								</ul>
							</nav>
						</div>
					</div>

	<!-- CONNEXION -->
					
					<div id="connexion">
						<h2>Connexion</h2>
					    <form action="index.php?action=login" method="post" class="connexion">
					        <label for="email">Email</label><br />
					        <input type="email" id="email" name="email" required /><br />
					        <label for="password">Mot de passe</label><br />
					        <input type="password" class="password" name="password" required /><br />
					        <input type="submit" name="connexion" class="buttonStyle" value="Connexion" />
					    </form>				    

  						<a href="index.php?action=createAccount" class="" id="createAccount">Pas encore de compte ?</a><br />

					    <a href="index.php?action=recoverPassword" class="" id="recoverPassword">Mot de passe oublié ?</a>
					</div>

	<!-- FOOTER -->
					<div class="pushFooter"></div>            

                    <div id="footerSidebar">
						<p>Site créé par Lucie Kojadinovic - 2018</p>
					</div>
				</div>

<!-- CONTENT -->
				<div id="contentDiv" class="col-md">
					<div id="content">
				        <?php echo $content ?>
				    </div>

					<div class="pushFooter"></div>         
					
					<div id="footerContent">
				    	<a href="https://www.amazon.fr/"><i class="fab fa-amazon"></i></a>
				    	<a href="https://discordapp.com/"><i class="fab fa-discord"></i></a>
				    	<a href="https://www.linkedin.com/in/kaldir/"><i class="fab fa-linkedin-in"></i></a>
				    	<a href="https://www.deviantart.com/"><i class="fab fa-deviantart"></i></a>
					</div>
				</div>
			</div>

<!-- SCRIPTS -->
	<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"></script><script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
	<script defer src="https://use.fontawesome.com/releases/v5.0.6/js/all.js"></script>
	<script defer src="/static/fontawesome/fa-v4-shim.js"></script>
	<script src="public/js/tinymce/tinymce.min.js"></script>
	<script>tinymce.init({ selector:'textarea' });</script>
	<script src="public/js/tinymce/jquery.tinymce.min.js"></script>
	<script>$("p:empty").remove();</script> <!-- permet d'enlever les <p> vides générés par tinyMCE -->

<!-- DISPLAY MODAL IF SIGNALISED COMMENT -->
<!--
	<?php
	if (!empty($signalised)) {
	?>
	    <script> $('#modalSignal').modal('show'); </script>
	<?php
	}
	?>
-->
	</body>
</html>
