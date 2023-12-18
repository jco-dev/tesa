<form class="row g-3" id="frm-editar-categoria">
    <div class="col-12">
        <label for="ci" class="form-label required">Nombre Categoría</label>
        <input type="hidden" name="id_categoria" value="<?= $categoria->id_categoria ?>">
        <input type="text" class="form-control form-control-solid form-control-sm" id="categoria" name="categoria" value="<?= $categoria->categoria ?>" placeholder="Ingresar categoría" required />
    </div>
    
    <div class="col-12 text-end">
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