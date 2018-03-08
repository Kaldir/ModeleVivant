<?php
if ($this->hasErrors()) {
    foreach ($_SESSION['errors'] as $error) {
    ?>
        <div class="alert alert-danger" role="alert">
            <strong><?php echo $error; ?></strong>
        </div>                            
    <?php
    }
    unset($_SESSION['errors']); // unset détruit la variable
}
if ($this->hasSuccess()) {
    foreach ($_SESSION['success'] as $success) {
    ?>
        <div class="alert alert-success" role="alert">
            <strong><?php echo $success; ?></strong>
        </div>                            
    <?php
    }
    unset($_SESSION['success']); // unset détruit la variable
}
?>