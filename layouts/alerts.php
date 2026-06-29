<?php

if (
    isset($_SESSION['alerta'])
) :

    $alerta = $_SESSION['alerta'];

    unset($_SESSION['alerta']);
?>

<script>

document.addEventListener('DOMContentLoaded', function () {

    Swal.fire({
        icon: '<?= $alerta["icon"] ?>',
        title: '<?= $alerta["title"] ?>',
        text: '<?= $alerta["text"] ?>',
        confirmButtonColor: '#C9A227'
    });

});

</script>

<?php endif; ?>