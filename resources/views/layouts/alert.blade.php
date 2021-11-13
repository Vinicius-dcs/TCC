<!-- Alert -->
@if (isset($_SESSION['mensagem']) && isset($_SESSION['tipoAlert']))
    <div class="alert alert-<?php echo $_SESSION['tipoAlert']; ?> alert-dismissible fade show text-center" role="alert">
        <?php echo $_SESSION['mensagem']; ?>
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
@endif
<?php unset($_SESSION['mensagem']); ?>
<?php unset($_SESSION['tipoAlert']); ?>
