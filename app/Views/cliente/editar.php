<form class="row g-3" id="frm-editar-cliente">
    <div class="col-6">
        <label for="ci" class="form-label required">CI</label>
        <input type="hidden" name="id_persona" value="<?= $persona->id_persona ?>">
        <input type="text" class="form-control form-control-solid form-control-sm" value="<?= $persona->ci ?>" id="ci" name="ci" placeholder="C.I." required />
    </div>
    <div class="col-6">
        <label for="expedido" class="form-label required">Expedido</label>
        <select class="form-select form-select-solid form-select-sm" id="expedido" name="expedido" required>
            <option value="">-- seleccione --</option>
            <option <?= ($persona->expedido) == 'LP' ? 'selected' : ''; ?> value="LP">LP</option>
            <option <?= ($persona->expedido) == 'CB' ? 'selected' : ''; ?> value="CB">CB</option>
            <option <?= ($persona->expedido) == 'SC' ? 'selected' : ''; ?> value="SC">SC</option>
            <option <?= ($persona->expedido) == 'OR' ? 'selected' : ''; ?> value="OR">OR</option>
            <option <?= ($persona->expedido) == 'PT' ? 'selected' : ''; ?> value="PT">PT</option>
            <option <?= ($persona->expedido) == 'TJ' ? 'selected' : ''; ?> value="TJ">TJ</option>
            <option <?= ($persona->expedido) == 'CH' ? 'selected' : ''; ?> value="CH">CH</option>
            <option <?= ($persona->expedido) == 'BN' ? 'selected' : ''; ?> value="BN">BN</option>
            <option <?= ($persona->expedido) == 'PD' ? 'selected' : ''; ?> value="PD">PD</option>
            <option <?= ($persona->expedido) == 'QR' ? 'selected' : ''; ?> value="QR">QR</option>
        </select>
    </div>

    <div class="col-4">
        <label for="nombre" class="form-label required">Nombres</label>
        <input type="text" class="form-control form-control-solid form-control-sm" value="<?= $persona->nombre ?>" id="nombre" name="nombre" placeholder="nombres..." required>
    </div>
    <div class="col-4">
        <label for="paterno" class="form-label">Paterno</label>
        <input type="text" class="form-control form-control-solid form-control-sm" value="<?= $persona->paterno ?>" id="paterno" name="paterno" placeholder="paterno" />
    </div>
    <div class="col-4">
        <label for="materno" class="form-label">Materno</label>
        <input type="text" class="form-control form-control-solid form-control-sm" value="<?= $persona->materno ?>" id="materno" name="materno" placeholder="materno" />
    </div>

    <div class="col-4">
        <label for="fecha_nacimiento" class="form-label required">Fecha Nacimiento</label>
        <input type="date" class="form-control form-control-solid form-control-sm" id="fecha_nacimiento" value="<?= $persona->fecha_nacimiento?>" name="fecha_nacimiento" required>
    </div>
    <div class="col-4">
        <label for="celular" class="form-label required">Celular</label>
        <input type="number" class="form-control form-control-solid form-control-sm" value="<?= $persona->celular?>" id="celular" name="celular" required />
    </div>

    <div class="col-4">
        <label for="genero" class="form-label required">Género</label>
        <select class="form-select form-select-solid form-select-sm" id="genero" name="genero" required>
            <option value="">-- seleccione --</option>
            <option <?= ($persona->genero) == 'M' ? 'selected' : ''; ?> value="M">M</option>
            <option <?= ($persona->genero) == 'F' ? 'selected' : ''; ?> value="F">F</option>
        </select>
    </div>

    <div class="col-6">
        <label for="correo_electronico" class="form-label required">Correo Electrónico</label>
        <input type="email" class="form-control form-control-solid form-control-sm" value="<?= $persona->correo_electronico?>" id="correo_electronico" name="correo_electronico" required />
    </div>

    <div class="col-6">
        <label for="direccion" class="form-label">Dirección</label>
        <textarea class="form-control form-control-solid form-control-sm" rows="1" name="direccion" id="direccion"><?= $persona->direccion?></textarea>
    </div>

    <div class="col-12">
        <label for="id_municipio" class="form-label required">Ciudad de residencia</label>
        <select class="form-select form-select-solid form-select-sm" id="id_municipio" name="id_municipio" data-control="select2" data-placeholder="seleccione" data-dropdown-parent="#modal" data-allow-clear="true" required>
            <option></option>
            <?php foreach ($municipios as $municipio) : ?>
                <option <?= ($municipio->id_municipio== $cliente->id_municipio) ? 'selected' : ''; ?> value="<?= $municipio->id_municipio ?>"><?= $municipio->municipio ?></option>
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
            Editar
        </button>
    </div>
</form>