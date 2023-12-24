<form class="row g-3" id="frm-registro-categoria">
    <div class="col-12">
        <label for="ci" class="form-label required">Nombre Categoría</label>
        <input type="text" class="form-control form-control-solid form-control-sm" id="categoria" name="categoria" placeholder="Ingresar categoría" required />
    </div>

    <div class="col-12">
        <label for="descripcion" class="form-label required">Descripción Categoría</label>
        <textarea name="descripcion" id="descripcion" class="form-control form-control-solid form-control-sm" rows="3" placeholder="Ingrese descripción a la categoría" ></textarea>
    </div>
    
    <div class="col-12 text-end">
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