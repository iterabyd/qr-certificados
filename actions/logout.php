<?php

// Iniciar sesión
session_start();

// Destruir sesión
session_destroy();

// Regresar al login
header(
    'Location: ../views/auth/login.php'
);

exit;