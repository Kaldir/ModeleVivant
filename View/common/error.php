<?php $title = 'MV - erreur';
ob_start(); ?>

<h3 class="contentTitle">Erreur !</h3>

<?php
if (isset($errors)) {
    foreach ($errors as $error) {
    ?>
    <div class="alert alert-danger" role="alert">
        <strong><?php echo $error; ?></strong>
    </div>
    <?php
    }
}
?>

<?php $content = ob_get_clean(); ?>