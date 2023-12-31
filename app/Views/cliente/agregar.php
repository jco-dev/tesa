<form class="row g-3" id="frm-registro-cliente">
    <div class="col-6">
        <label for="ci" class="form-label required">CI</label>
        <input type="text" class="form-control form-control-solid form-control-sm" id="ci" name="ci" placeholder="C.I." required />
    </div>
    <div class="col-6">
        <label for="expedido" class="form-label required">Expedido</label>
        <select class="form-select form-select-solid form-select-sm" id="expedido" name="expedido" required>
            <option value="">-- seleccione --</option>
            <option value="LP">LP</option>
            <option value="CB">CB</option>
            <option value="SC">SC</option>
            <option value="OR">OR</option>
            <option value="PT">PT</option>
            <option value="TJ">TJ</option>
            <option value="CH">CH</option>
            <option value="BN">BN</option>
            <option value="PD">PD</option>
            <option value="QR">QR</option>
        </select>
    </div>

    <div class="col-4">
        <label for="nombre" class="form-label required">Nombres</label>
        <input type="text" class="form-control form-control-solid form-control-sm" id="nombre" name="nombre" placeholder="nombres..." required>
    </div>
    <div class="col-4">
        <label for="paterno" class="form-label">Paterno</label>
        <input type="text" class="form-control form-control-solid form-control-sm" id="paterno" name="paterno" placeholder="paterno" />
    </div>
    <div class="col-4">
        <label for="materno" class="form-label">Materno</label>
        <input type="text" class="form-control form-control-solid form-control-sm" id="materno" name="materno" placeholder="materno" />
    </div>

    <div class="col-4">
        <label for="fecha_nacimiento" class="form-label required">Fecha Nacimiento</label>
        <input type="date" class="form-control form-control-solid form-control-sm" id="fecha_nacimiento" name="fecha_nacimiento" required>
    </div>
    <div class="col-4">
        <label for="celular" class="form-label required">Celular</label>
        <input type="number" class="form-control form-control-solid form-control-sm" id="celular" name="celular" required />
    </div>

    <div class="col-4">
        <label for="genero" class="form-label required">Género</label>
        <select class="form-select form-select-solid form-select-sm" id="genero" name="genero" required>
            <option value="">-- seleccione --</option>
            <option value="M">M</option>
            <option value="F">F</option>
        </select>
    </div>

    <div class="col-6">
        <label for="correo_electronico" class="form-label required">Correo Electrónico</label>
        <input type="email" class="form-control form-control-solid form-control-sm" id="correo_electronico" name="correo_electronico" required />
    </div>

    <div class="col-6">
        <label for="direccion" class="form-label">Dirección</label>
        <textarea class="form-control form-control-solid form-control-sm" rows="1" name="direccion" id="direccion"></textarea>
    </div>

    <div class="col-12">
        <label for="id_municipio" class="form-label required">Ciudad de residencia</label>
        <select class="form-select form-select-solid form-select-sm" id="id_municipio" name="id_municipio" data-control="select2" data-placeholder="seleccione" data-dropdown-parent="#modal" data-allow-clear="true" required>
            <option></option>
            <?php foreach ($municipios as $municipio) : ?>
                <option value="<?= $municipio->id_municipio ?>"><?= $municipio->municipio ?></option>
            <?php endforeach; ?>
        </select>
    </div>

    <div class="col-12 text-end mt-5">
        <button type="button" class="btn btn-secondary btn-sm" data-bs-dismiss="modal">Cerrar</button>
        <button type="submit" class="btn btn-primary btn-sm">
            <i class="ki-duotone ki-message-add">
                <span class="path1"></span>
                <span class="path2"></span>
                <span class="path3"></span>
            </i>
            Guardar
        </button>
    </div>
</form>