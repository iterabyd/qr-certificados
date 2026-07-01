<link href="https://unpkg.com/gridjs/dist/theme/mermaid.min.css" rel="stylesheet" />
<script src="https://unpkg.com/gridjs/dist/gridjs.umd.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<script>const BASE_URL = '<?= BASE_URL ?>';</script>
<script src="<?= BASE_URL ?>/assets/js/app.js?v=<?= time(); ?>"></script>
<script src="<?= BASE_URL ?>/assets/js/modal.js?v=<?= time(); ?>"></script>
<script src="<?= BASE_URL ?>/assets/js/sidebar.js?v=<?= time(); ?>"></script>

<script src="<?= BASE_URL ?>/public/js/personas/personas.service.js"></script>
<script src="<?= BASE_URL ?>/public/js/personas/personas.grid.js"></script>
<script src="<?= BASE_URL ?>/public/js/personas/personas.form.js"></script>
<script src="<?= BASE_URL ?>/public/js/personas/personas.validation.js"></script>
<script src="<?= BASE_URL ?>/public/js/personas/personas.js"></script>

<?php if(isset($jsModulo)): ?>
    <script src="<?= BASE_URL ?>/assets/js/<?= $jsModulo ?>/<?= $jsModulo ?>.js"></script>
<?php endif; ?>

</div> <!-- cierra #mainContent (abierto en sidebar.php) -->

</div> <!-- cierra .flex.min-h-screen.relative (abierto en header.php) -->

</body>
</html>
