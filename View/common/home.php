<?php $title = 'MV - Page d\'accueil';
ob_start(); ?>

<h3 class="contentTitle">Bienvenue !</h3>

<div class="container-fluid homeContainer">
	<div class="row homeRow">
		<div class="homeBlocks col-md-4" id="homeIntro">
			<p>Modèle débutant, confirmé, en devenir ? Artiste ? Curieux ? Vous trouverez dans les différentes rubriques de quoi étancher votre soif.</p>
			<img src="./Public/img/feather10.png" alt="featherHome_img" />
		</div>

		<div class="homeBlocks col-md-4" id="homeTutos">
			<a href="index.php?action=tutos">Tutos, partage d'expériences</a>
			<p>Contient des anecdotes, vécues personnellements par des modèles et des artistes, recueillis par le biais de ce site ou lors de discussions de comptoir, quand les gens se relâchent et confient avec humour les plus cocasses situations.</p>
		</div>
		
		<div class="homeBlocks col-md-4" id="homeMarket">	
			<a href="index.php?action=marketplace">Achat de matériel</a>
			<p>Vous trouverez des idées et suggestions d'outils pouvant améliorer le confort du modèle, le mettre en valeur et récupérer.</p>
		</div>
		
		<div class="homeBlocks col-md-4" id="homeAds">	
			<a href="index.php?action=advertisements">Petites annonces</a>
			<p>Vous permet de poster ce que vous souhaitez, de la proposition de pose à la recherche de modèle, en passant par la vente de matériel ou d'oeuvres.</p>
		</div>

		<div class="homeBlocks col-md-4" id="homeFriends">	
			<a href="index.php?action=friends">Le coin des copains</a>
			<p>Comme son nom l'indique, regroupe les sites des artistes qui ont contribués à enjoliver ce site.</p>
		</div>

		<div class="homeBlocks col-md-4" id="homeContact">	
			<a href="index.php?action=contact">Contact <i class="fas fa-paper-plane"></i></a>
			<p>Vous êtes vivement encouragés à utiliser ce formulaire pour transmettre vos histoires afin qu'elles soient publiées !</p>
		</div>
	</div>
</div>

<div id="homeImg">
	<img src="./Public/img/home.png" alt="home_img" />
</div>	

<?php $content = ob_get_clean(); ?>