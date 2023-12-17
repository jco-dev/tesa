<?= $this->extend('base') ?>

<?= $this->section('css') ?>
<link href="<?= base_url('assets/plugins/custom/datatables/datatables.bundle.css') ?>" rel="stylesheet" type="text/css" />
<?= $this->endSection() ?>

<?= $this->section('content') ?>
<div class="d-flex flex-column flex-column-fluid">
    <div id="kt_app_toolbar" class="app-toolbar py-3 py-lg-6">
        <div id="kt_app_toolbar_container" class="app-container container-xxl d-flex flex-stack">
            <div class="page-title d-flex flex-column justify-content-center flex-wrap me-3">
                <h3 class="page-heading d-flex text-gray-900 fw-bold fs-3 flex-column justify-content-center my-0">Listado de Personal</h3>
            </div>

            <div class="d-flex align-items-center gap-2 gap-lg-3">

                <button class="btn btn-sm fw-bold btn-primary btn-agregar-persona">
                    <i class="ki-duotone ki-plus-square">
                        <span class="path1"></span>
                        <span class="path2"></span>
                        <span class="path3"></span>
                    </i>
                    Registrar Persona
                </button>
            </div>
        </div>
    </div>

    <div id="kt_app_content" class="app-content flex-column-fluid">
        <div id="kt_app_content_container" class="app-container ">
            <div class="card">
                <div class="card-body px-3">
                    <table id="tbl-listado-personal" class="table table-striped table-row-bordered gy-5 gs-7 border">
                        <thead>
                            <tr class="fw-bold fs-6 text-gray-800 px-7">
                                <th>#</th>
                                <th>C.I.</th>
                                <th>Nombres</th>
                                <th>Nacimiento</th>
                                <th>Celular</th>
                                <th>Correo</th>
                                <th>Estado</th>
                                <th>Acciones</th>
                            </tr>
                        </thead>
                        <tbody></tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
<?= $this->endSection() ?>

<?= $this->section('js') ?>
<script src="<?= base_url('assets/plugins/custom/datatables/datatables.bundle.js') ?>"></script>
<script src="<?= base_url('assets/js/persona/index.js') ?>"></script>
<?= $this->endSection() ?>