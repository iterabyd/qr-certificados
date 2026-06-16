<aside id="sidebar" class="sidebar h-screen w-64 text-white transition-all duration-300 shadow-xl">


<!-- Logo -->
<div class="logo-container flex items-center justify-between h-16 px-4 border-b border-white/10">

    <div class="flex items-center gap-3">

        <i class="fa-solid fa-shield-halved text-2xl text-yellow-400"></i>

        <span id="logoText" class="text-lg font-semibold">
            Sistema QR
        </span>

    </div>

    <button id="toggleSidebar" class="sidebar-toggle text-white">
        <i class="fa-solid fa-bars"></i>
    </button>

</div>
<!-- Menú -->
<nav class="mt-4 px-3">

    <a href="/qr-certificados/views/dashboard/index.php" class="menu-item">
        <i class="fa-solid fa-chart-line w-5"></i>
        <span class="menu-text">Dashboard</span>
    </a>

    <a href="/qr-certificados/views/roles/index.php" class="menu-item">
        <i class="fa-solid fa-user-shield w-5"></i>
        <span class="menu-text">Roles</span>
    </a>

    <a href="/qr-certificados/views/usuarios/index.php" class="menu-item">
        <i class="fa-solid fa-users w-5"></i>
        <span class="menu-text">Usuarios</span>
    </a>

    <a href="/qr-certificados/views/personas/index.php" class="menu-item">
        <i class="fa-solid fa-id-card w-5"></i>
        <span class="menu-text">Personas</span>
    </a>

    <a href="/qr-certificados/views/certificaciones/index.php" class="menu-item">
        <i class="fa-solid fa-certificate w-5"></i>
        <span class="menu-text">Certificaciones</span>
    </a>

    <a href="/qr-certificados/actions/logout.php" class="menu-item text-red-300 hover:text-red-100">
        <i class="fa-solid fa-right-from-bracket w-5"></i>
        <span class="menu-text">Cerrar sesión</span>
    </a>

</nav>

</aside>
