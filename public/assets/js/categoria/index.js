$(document).ready(function () {

    let listadoCategorias = $('#tbl-listado-categorias').DataTable({
        responsive: true,
        processing: true,
        select: false,
        serverSide: true,
        ajax: {
            url: 'listado-categorias-ajax',
            type: 'GET'
        },
        language: {
            url: 'assets/plugins/custom/datatables/lang/es.json'
        },
        dom:
            "<'row'" +
            "<'col-sm-6 d-flex align-items-center justify-conten-start'l>" +
            "<'col-sm-6 d-flex align-items-center justify-content-end'f>" +
            ">" +

            "<'table-responsive'tr>" +

            "<'row'" +
            "<'col-sm-12 col-md-5 d-flex align-items-center justify-content-center justify-content-md-start'i>" +
            "<'col-sm-12 col-md-7 d-flex align-items-center justify-content-center justify-content-md-end'p>" +
            ">"

    }).on('click', 'button.btn-editar', function() {
        let id = $(this).data('id');
        $.ajax({
            url: 'editar-categoria',
            type: 'POST',
            data: {
                id: id
            },
            success: function (data) {
                if (data.vista) {
                    $('#modal .modal-body').html(data.vista);
                    parametrosModal("#modal", "Editar Categoría", "modal-lg", false, 'static');

                    $('#frm-editar-categoria').on('submit', function (e) {
                        e.preventDefault();
                        let datos = $(this).serialize();
                        $.ajax({
                            url: 'actualizar-categoria',
                            type: 'POST',
                            data: datos,
                            success: function (data) {
                                if (data.exito) {
                                    $('#modal').modal('hide');
                                    $('#frm-editar-categoria').trigger('reset');
                                    listadoCategorias.ajax.reload(null, false);
                                    showBasicSwal(data.msg, 'success', 'Aceptar', 'btn btn-success');
                                }

                                if (data.validacion) {
                                    $('#frm-editar-categoria input').removeClass('is-invalid');

                                    let errorList = '<ul>';
                                    for (let [key, value] of Object.entries(data.validacion)) {
                                        $(`#${key}`).addClass('is-invalid');
                                        errorList += `<li>${value}</li>`;
                                    }
                                    errorList += '</ul>';

                                    showBasicSwal(data.msg, 'warning', 'Ok', 'btn btn-warning');
                                }

                                if (data.exito === false) {
                                    $('#modal').modal('hide');
                                    $('#frm-editar-categoria').trigger('reset');
                                    showBasicSwal(data.msg, 'error', 'Ok', 'btn btn-danger');

                                }
                            }
                        });
                    });
                }
            }
        });
    }).on('click', 'button.btn-eliminar', function() {
        let id = $(this).data('id');
        let categoria = $(this).data('categoria');
        Swal.fire({
            title: `¿Está seguro de eliminar la categoría: ${ categoria }?`,
            text: "La categoría será eliminada del sistema",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonText: 'Si, eliminar',
            cancelButtonText: 'No, cancelar',
            reverseButtons: true
        }).then((result) => {
            if (result.value) {
                $.ajax({
                    url: 'eliminar-categoria',
                    type: 'POST',
                    data: {
                        id: id
                    },
                    success: function (data) {
                        if (data.exito) {
                            listadoCategorias.ajax.reload(null, false);
                            showBasicSwal(data.msg, 'success', 'Aceptar', 'btn btn-success');
                        }
                        if (data.exito === false) {
                            showBasicSwal(data.msg, 'error', 'Ok', 'btn btn-danger');
                        }
                    }
                });
            }
        });
    }).on('click', 'button.btn-activar', function() {
        let id = $(this).data('id');
        let categoria = $(this).data('categoria');
        
        Swal.fire({
            title: `¿Está seguro de activar al categoría: ${ categoria }?`,
            text: "La categoría será activada en el sistema",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonText: 'Si',
            cancelButtonText: 'No',
            reverseButtons: true
        }).then((result) => {
            if (result.value) {
                $.ajax({
                    url: 'activar-categoria',
                    type: 'POST',
                    data: {
                        id: id
                    },
                    success: function (data) {
                        if (data.exito) {
                            listadoCategorias.ajax.reload(null, false);
                            showBasicSwal(data.msg, 'success', 'Aceptar', 'btn btn-success');
                        }
                        if (data.exito === false) {
                            showBasicSwal(data.msg, 'error', 'Ok', 'btn btn-danger');
                        }
                    }
                });
            }
        });
    });

    $('.btn-agregar-categoria').on('click', function () {
        $.post('crear-categoria', function (data) {
            if (data.vista) {
                $('#modal .modal-body').html(data.vista);
                parametrosModal("#modal", "Agregar Categoría", "modal-lg", false, 'static');

                $('#frm-registro-categoria').on('submit', function (e) {
                    e.preventDefault();
                    let datos = $(this).serialize();
                    $.ajax({
                        url: 'registro-categoria',
                        type: 'POST',
                        data: datos,
                        success: function (data) {
                            if (data.exito) {
                                $('#modal').modal('hide');
                                $('#frm-registro-categoria').trigger('reset');
                                listadoCategorias.ajax.reload(null, false);
                                showBasicSwal(data.msg, 'success', 'Ok', 'btn btn-success');

                            }

                            if (data.validacion) {
                                $('#frm-registro-categoria input').removeClass('is-invalid');

                                let errorList = '<ul>';
                                for (let [key, value] of Object.entries(data.validacion)) {
                                    $(`#${key}`).addClass('is-invalid');
                                    errorList += `<li>${value}</li>`;
                                }
                                errorList += '</ul>';
                                showBasicSwal(errorList, 'warning', 'Ok', 'btn btn-warning');
                            }

                            if (data.exito == false) {
                                $('#modal').modal('hide');
                                $('#frm-registro-categoria').trigger('reset');
                                showBasicSwal(data.msg, 'error', 'Ok', 'btn btn-danger');
                            }
                        }
                    });
                });

            }
        });
    });
});