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
if (isset($success)) {
?>
    <div class="alert alert-success" role="alert">
        <strong><?php echo $success; ?></strong>
    </div>
<?php
}
?>