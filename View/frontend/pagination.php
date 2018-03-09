<?php
if ($i == 1) { // si on affiche le premier numéro de la boucle, on ouvre le div "pagination".
?>
<div class="containerPagination">
	<div class="pagination">
		<p>Page(s) </p>
<?php
}
?>
		<div class='divNumber buttonStyle'> <!-- sera affiché à chaque passage de la boucle -->
			<span class='nb'>
				<a href='index.php?<?php echo $queryString; ?>'><?php echo $i; ?></a>
			</span>
		</div>
<?php
if ($i == $nbPages) { // si on arrive au bout de la boucle, on ferme le div.
?>
	</div>
</div>
<?php
}
?>