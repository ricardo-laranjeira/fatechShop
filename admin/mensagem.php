<?php
    if (isset($_SESSION['mensagem'])){
?>

<div class="alert alert-warning alert-dismissible fade show" role="alert">
    <?=  $_SESSION['mensagem'] ?>
    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Coose"></button>
</div>

<?php
    session_unset();
    session_destroy();
    }
?>