<?php $pageTitle = 'Bienvenue !';
ob_start(); ?>

<div class="container">
	<div class="row justify-content-center">
		<div id="slideshow" class="slideshow col-md">
<?php
foreach ($posts as $post) {
?>
                <div class="postBlocks slider col-md">
                    <strong class="titleForm"><?php echo htmlspecialchars($post['title']); ?></strong>
                    <p class="smallInfosText">publié le <?php echo htmlspecialchars($post['creation_date_fr']); ?></p>                    
                    <p><?php echo $this->getExcerpt($post['content']); ?></p>

                    <a href="index.php?action=displayOnePost&amp;id_post=<?php echo htmlspecialchars($post['id']); ?>">Lire la suite...</a>
                </div>
<?php
}
?>
		</div>
	</div>
</div>

<div class="container-fluid homeContainer">
	<div class="row homeRow">

		<div class="homeBlocks col-md-4" id="homeIntro">
			<p>Modèle débutant, confirmé, en devenir ? Artiste ? Curieux ? Vous trouverez pleins d'infos dans les différentes rubriques.</p>
			<img src="./Public/img/feather10.png" class="feather" alt="featherHome_img" />
		</div>

		<div class="homeBlocks col-md-4">
			<div class="subButtonsStyle sbsTogglerResponsive">
				<strong>Tutos, partage d'expériences</strong>
			</div>
            <div class="formStyle fsContentResponsive homeStyle">
				<p>Contient des anecdotes, vécues personnellements par des modèles et des artistes, recueillis par le biais de ce site ou lors de séances.</p>
				<div class="homeLink">
					<a href="index.php?action=posts" class="buttonStyle"><i class="fas fa-arrow-right"></i></a>
				</div>
			</div>
		</div>
		
		<div class="homeBlocks col-md-4">	
			<div class="subButtonsStyle sbsTogglerResponsive">
				<strong>Les indispensables</strong>
			</div>
			<div class="formStyle fsContentResponsive homeStyle">
				<p>Des idées et suggestions d'outils qui s'adressent autant aux artistes qu'aux modèles, permettant d'améliorer le confort, de mettre en valeur et de récupérer.</p>
				<div class="homeLink">
					<a href="index.php?action=marketplace" class="buttonStyle"><i class="fas fa-arrow-right"></i></a>
				</div>
			</div>
		</div>
		
		<div class="homeBlocks col-md-4">	
			<div class="subButtonsStyle sbsTogglerResponsive">
				<strong>Petites annonces</strong>
			</div>
			<div class="formStyle fsContentResponsive homeStyle">
				<p>Vous permet de poster par catégorie, que ce soit des propositions de pose, une recherche de modèle ou encore pour la diffusion un événement.</p>
				<div class="homeLink">
					<a href="index.php?action=advertisements" class="buttonStyle"><i class="fas fa-arrow-right"></i></a>
				</div>
			</div>
		</div>

		<div class="homeBlocks col-md-4">	
			<div class="subButtonsStyle sbsTogglerResponsive">
				<strong>Le coin des copains</strong>
			</div>
			<div class="formStyle fsContentResponsive homeStyle">
				<p>Sites d'artistes variés, ayant pour certains contribués à enjoliver ce site.</p>
				<div class="homeLink">
					<a href="index.php?action=friends" class="buttonStyle"><i class="fas fa-arrow-right"></i></a>
				</div>
			</div>
		</div>

		<div class="homeBlocks col-md-4">	
			<div class="subButtonsStyle sbsTogglerResponsive">
				<strong>Contact</strong>
			</div>
			<div class="formStyle fsContentResponsive homeStyle">
				<p>Vous êtes vivement encouragés à utiliser ce formulaire pour transmettre vos histoires afin qu'elles soient publiées !</p>
				<div class="homeLink">
					<a href="index.php?action=contact" class="buttonStyle"><i class="fas fa-arrow-right"></i></a>
				</div>
			</div>
		</div>
	</div>
</div>

<div id="homeImg">
	<img src="./Public/img/home.png" alt="home_img" />
</div>	

<?php $content = ob_get_clean(); ?>