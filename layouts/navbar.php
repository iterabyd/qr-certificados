<header class="header-app shadow px-4 md:px-6 py-4 flex items-center justify-between gap-2">

    <div class="flex items-center gap-3 md:gap-4 min-w-0">

        <button id="mobileMenu" class="text-2xl md:hidden text-title shrink-0">
            <i class="fa-solid fa-bars"></i>
        </button>

        <h2 class="text-lg md:text-2xl font-semibold text-title truncate">
            <?= $tituloPagina ?>
        </h2>

    </div>

    <div class="flex items-center gap-2 md:gap-3 shrink-0">

        <i class="fa-solid fa-user-circle text-2xl"></i>

        <span class="hidden sm:block truncate max-w-[140px] md:max-w-none">
            <?= $_SESSION['usuario']; ?>
        </span>

    </div>

</header>
