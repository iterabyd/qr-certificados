<header class="header-app shadow px-6 py-4 flex items-center justify-between">

    <div class="flex items-center gap-4">

        <button id="toggleSidebar" class="text-xl text-title hover:text-[var(--color-dorado)]">
            <i class="fa-solid fa-bars"></i>
        </button>

        <h2 class="text-2xl font-semibold text-title">
            <?= $tituloPagina ?>
        </h2>

    </div>

    <div class="flex items-center gap-3">

        <i class="fa-solid fa-user-circle text-2xl"></i>

        <span>
            <?= $_SESSION['usuario']; ?>
        </span>

    </div>

</header>