<form class="row g-3" id="frm-editar-persona">
    <div class="col-6">
        <label for="ci" class="form-label required">CI</label>
        <input type="hidden" name="id_persona" value="<?= $persona->id_persona ?>">
        <input type="text" class="form-control form-control-solid form-control-sm" id="ci" name="ci" value="<?= $persona->ci ?>" required />
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
        <input type="text" class="form-control form-control-solid form-control-sm" id="nombre" name="nombre" value="<?= $persona->nombre ?>" placeholder="nombres..." required>
    </div>
    <div class="col-4">
        <label for="paterno" class="form-label">Paterno</label>
        <input type="text" class="form-control form-control-solid form-control-sm" id="paterno" name="paterno" value="<?= $persona->paterno ?>" placeholder="paterno" />
    </div>
    <div class="col-4">
        <label for="materno" class="form-label">Materno</label>
        <input type="text" class="form-control form-control-solid form-control-sm" id="materno" name="materno" value="<?= $persona->materno ?>" placeholder="materno" />
    </div>

    <div class="col-4">
        <label for="fecha_nacimiento" class="form-label required">Fecha Nacimiento</label>
        <input type="date" class="form-control form-control-solid form-control-sm" id="fecha_nacimiento" value="<?= $persona->fecha_nacimiento ?>" name="fecha_nacimiento" required>
    </div>
    <div class="col-4">
        <label for="celular" class="form-label required">Celular</label>
        <input type="number" class="form-control form-control-solid form-control-sm" id="celular" name="celular" value="<?= $persona->celular ?>" required />
    </div>

    <div class="col-4">
        <label for="rol" class="form-label required">Rol</label>
        <select class="form-select form-select-solid form-select-sm" id="rol" name="rol" required>
            <option value="">-- seleccione --</option>
            <?php foreach ($grupos as $grupo) : ?>
                <option <?= ($grupo->id_grupo) == $id_grupo_persona->id_grupo ? 'selected' : ''; ?> value="<?= $grupo->id_grupo ?>"><?= $grupo->nombre_grupo ?></option>
            <?php endforeach; ?>
        </select>
    </div>

    <div class="col-10">
        <label for="correo_electronico" class="form-label required">Correo Electrónico</label>
        <input type="email" class="form-control form-control-solid form-control-sm" id="correo_electronico" name="correo_electronico" value="<?= $persona->correo_electronico ?>" required />
    </div>
    <div class="col-2">
        <label for="genero" class="form-label required">Género</label>
        <select class="form-select form-select-solid form-select-sm" id="genero" name="genero" required>
            <option value="">-- seleccione --</option>
            <option <?= ($persona->genero) == 'M' ? 'selected' : ''; ?> value="M">M</option>
            <option <?= ($persona->genero) == 'F' ? 'selected' : ''; ?> value="F">F</option>

        </select>
    </div>


    <div class="col-12">
        <label for="direccion" class="form-label">Dirección</label>
        <textarea class="form-control form-control-solid form-control-sm" name="direccion" id="direccion"><?= $persona->direccion ?></textarea>
    </div>
    <div class="col-12">
        <button type="button" class="btn btn-secondary btn-sm" data-bs-dismiss="modal">Cerrar</button>
        <button type="submit" class="btn btn-primary btn-sm">
            <i class="ki-duotone ki-message-add">
                <span class="path1"></span>
                <span class="path2"></span>
                <span class="path3"></span>
            </i>
            Editar Persona
        </button>
    </div>
</form>