<?php
if ($_SESSION['connected'] && $_SESSION['admin'] == 1) { // on vérifie si une session existe et si elle est admin.
?>

<!doctype html>
<html lang="fr">
	<head>
	    <meta charset="utf-8" />
	    <title>Modèles Vivants : <?php echo $pageTitle ?></title>
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
						<img class="feather" src="./Public/img/feather07.png" alt="logo_MV" />		         
			        </div>
			    </div>
			</div>
		</div>

<!-- SIDEBAR -->
		<div class="container-fluid sidebarContainer">
			<div class="row sidebarRow">
				<div id="sidebar" class="col-md-4">

	<!-- INTRODUCTION -->
				<div id="researchSidebar">
					<form action="index.php?action=research" method="Post">
						<input type="text" name="keywords" placeholder="Rechercher"/>
						<button type="submit" name="submit" class="buttonStyle" value="Rechercher"><i class='fas fa-search'></i></button>
					</form>
				</div>

	            <div class="subButtonsStyle sbsTogglerSidebar">
	                <h4>Gestion administrateur</h4>
	                <i class="fas fa-bars"></i>
	            </div>
	            <div class="fsContentSidebar">
					<div id="titleSidebar">
			            <a href="index.php">
			            	<h1 id="title">Gestion administrateur</h1>
			        	</a>
			        	
				        <a href="index.php"><img class="logo" src="./Public/img/lecture.png" alt="logo_MV" /></a>
				    </div>
			    </div>

	<!-- MENU -->
				<div class="subButtonsStyle sbsTogglerSidebar">
	                <h4>Menu</h4>
	                <i class="fas fa-bars"></i>
	            </div>
	            <div class="fsContentSidebar">
			        <div class="menu">
						<div id="menuLinks">
							<nav>
								<ul>
									<li><a href="index.php?action=tutos">Tutos, partage d'expériences</a></li>
									<li><a href="index.php?action=marketplace">Les indispensables</a></li>
									<li><a href="index.php?action=advertisements">Petites annonces</a></li>
									<li><a href="index.php?action=friends">Le coin des copains</a></li>
									<li><a href="index.php?action=contact">Contact<i class="fas fa-paper-plane"></i></a></li>
								</ul>
							</nav>
						</div>
					</div>
				</div>

	<!-- DECONNEXION AND ADMINISTRATION OF ADMIN ACCOUNT -->			
					<div id="disconnection">
						<h2>Déconnexion</h2>
					    <a href="index.php?action=modifyAccount" class="subButtonsStyle">Gestion du compte</a>
					    <a href="index.php?action=logout" class="subButtonsStyle">Déconnexion</a>
					</div>

	<!-- FOOTER -->
					<div class="pushFooter"></div>

                    <div class="footer footerSidebar">
						<p>Site créé par Lucie Kojadinovic - 2018</p>
					</div>
				</div>

<!-- CONTENT -->
				<div id="contentDiv" class="col-md">

					<?php require('./View/common/notifications.php'); ?>

					<div id="content">
				        <?php echo $content ?>
				    </div>

					<div class="pushFooter"></div>

					<img class="feather" alt="feather_pic" src="./Public/img/feather03.png" />

					<div id="footerContent">
				    	<a href="https://www.amazon.fr/"><i class="fab fa-amazon"></i></a>
				    	<a href="https://discordapp.com/"><i class="fab fa-discord"></i></a>
				    	<a href="https://www.linkedin.com/in/kaldir/"><i class="fab fa-linkedin-in"></i></a>
				    	<a href="https://www.deviantart.com/"><i class="fab fa-deviantart"></i></a>
					</div>

					<div class="footer footerResponsive">
						<p>Site créé par Lucie Kojadinovic - 2018</p>
					</div>					
				</div>
			</div>
		</div>

<!-- SCRIPTS -->
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
	<script src="https://use.fontawesome.com/releases/v5.0.7/js/all.js"></script>
	<script src="./Public/js/slider.js"></script>
	<script src="./Public/js/script.js"></script>
	<script src="./Public/js/tinymce/tinymce.min.js"></script>
	<script>tinymce.init({ selector:'.formattingTinyMce' });</script>
	<script src="./Public/js/tinymce/jquery.tinymce.min.js"></script>
	<script>$("p:empty").remove();</script> <!-- permet d'enlever les <p> vides générés par tinyMCE -->
		
	</body>
</html>

<?php
}
?>