<div class="app-navbar-item ms-1 ms-md-4" id="kt_header_user_menu_toggle">
    <div class="cursor-pointer symbol symbol-35px" data-kt-menu-trigger="{default: 'click', lg: 'hover'}" data-kt-menu-attach="parent" data-kt-menu-placement="bottom-end">
        <?php if($_SESSION['genero'] == 'M'): ?>
            <img src="<?= base_url('assets/media/avatars/300-3.jpg') ?>" class="rounded-3" alt="user" />
        <?php else: ?>
            <img src="<?= base_url('assets/media/avatars/300-2.jpg') ?>" class="rounded-3" alt="user" />
        <?php endif; ?>
    </div>
    <div class="menu menu-sub menu-sub-dropdown menu-column menu-rounded menu-gray-800 menu-state-bg menu-state-color fw-semibold py-4 fs-6 w-375px" data-kt-menu="true">
        <div class="menu-item px-3">
            <div class="menu-content d-flex align-items-center px-3">
                <div class="symbol symbol-50px me-5">
                    <?php if($_SESSION['genero'] == 'M'): ?>
                        <img src="<?= base_url('assets/media/avatars/300-3.jpg') ?>" class="rounded-3" alt="user" />
                    <?php else: ?>
                        <img src="<?= base_url('assets/media/avatars/300-2.jpg') ?>" class="rounded-3" alt="user" />
                    <?php endif; ?>
                </div>
                <div class="d-flex flex-column">
                    <div class="fw-bold d-flex align-items-center fs-5"><?= $_SESSION['nombre'] .' '. $_SESSION['paterno'] ?>
                        <span class="badge badge-light-success fw-bold fs-8 px-2 py-1 ms-2"><?= $_SESSION['grupos'] ?></span>
                    </div>
                    <a href="#" class="fw-semibold text-muted text-hover-primary fs-7"><?= $_SESSION['correo_electronico'] ?></a>
                </div>
            </div>
        </div>

        <div class="separator my-2"></div>

        <div class="menu-item px-5">
            <a href="#" class="menu-link px-5">Mi perfil </a>
        </div>

        <div class="separator my-2"></div>

        <div class="menu-item px-5" data-kt-menu-trigger="{default: 'click', lg: 'hover'}" data-kt-menu-placement="left-start" data-kt-menu-offset="-15px, 0">
            <a href="#" class="menu-link px-5">
                <span class="menu-title position-relative">Mode
                    <span class="ms-5 position-absolute translate-middle-y top-50 end-0">
                        <i class="ki-duotone ki-night-day theme-light-show fs-2">
                            <span class="path1"></span>
                            <span class="path2"></span>
                            <span class="path3"></span>
                            <span class="path4"></span>
                            <span class="path5"></span>
                            <span class="path6"></span>
                            <span class="path7"></span>
                            <span class="path8"></span>
                            <span class="path9"></span>
                            <span class="path10"></span>
                        </i>
                        <i class="ki-duotone ki-moon theme-dark-show fs-2">
                            <span class="path1"></span>
                            <span class="path2"></span>
                        </i>
                    </span>
                </span>
            </a>

            <div class="menu menu-sub menu-sub-dropdown menu-column menu-rounded menu-title-gray-700 menu-icon-gray-500 menu-active-bg menu-state-color fw-semibold py-4 fs-base w-150px" data-kt-menu="true" data-kt-element="theme-mode-menu">
                <div class="menu-item px-3 my-0">
                    <a href="#" class="menu-link px-3 py-2" data-kt-element="mode" data-kt-value="light">
                        <span class="menu-icon" data-kt-element="icon">
                            <i class="ki-duotone ki-night-day fs-2">
                                <span class="path1"></span>
                                <span class="path2"></span>
                                <span class="path3"></span>
                                <span class="path4"></span>
                                <span class="path5"></span>
                                <span class="path6"></span>
                                <span class="path7"></span>
                                <span class="path8"></span>
                                <span class="path9"></span>
                                <span class="path10"></span>
                            </i>
                        </span>
                        <span class="menu-title">Light</span>
                    </a>
                </div>

                <div class="menu-item px-3 my-0">
                    <a href="#" class="menu-link px-3 py-2" data-kt-element="mode" data-kt-value="dark">
                        <span class="menu-icon" data-kt-element="icon">
                            <i class="ki-duotone ki-moon fs-2">
                                <span class="path1"></span>
                                <span class="path2"></span>
                            </i>
                        </span>
                        <span class="menu-title">Dark</span>
                    </a>
                </div>

                <div class="menu-item px-3 my-0">
                    <a href="#" class="menu-link px-3 py-2" data-kt-element="mode" data-kt-value="system">
                        <span class="menu-icon" data-kt-element="icon">
                            <i class="ki-duotone ki-screen fs-2">
                                <span class="path1"></span>
                                <span class="path2"></span>
                                <span class="path3"></span>
                                <span class="path4"></span>
                            </i>
                        </span>
                        <span class="menu-title">System</span>
                    </a>
                </div>
            </div>
        </div>

        <div class="menu-item px-5">
            <a href="<?= base_url(route_to('cerrar-sesion')) ?>" class="menu-link px-5">Cerrar sesión</a>
        </div>
    </div>

</div>