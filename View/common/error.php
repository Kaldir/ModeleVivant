<?php $title = 'MV - erreur';
ob_start(); ?>

<h3 class="contentTitle">Erreur !</h3>

<?php
if (isset($errors)) {
    foreach ($errors as $error) {
    ?>
    <div class="alert alert-danger" role="alert">
        <strong>Erreur ! </strong><?php echo $error; ?>
    </div>
    <?php
    }
}
?>

<?php $content = ob_get_clean(); ?>