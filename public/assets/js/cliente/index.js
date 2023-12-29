$(document).ready(function () {

    let listadoClientes = $('#tbl-listado-clientes').DataTable({
        responsive: true,
        processing: true,
        select: false,
        serverSide: true,
        ajax: {
            url: 'listado-clientes-ajax',
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
            ">",
        columnDefs: [
            {
                targets: 3,
                orderable: false,
                visible: false,
            },
        ]

    }).on('click', 'button.btn-editar', function () {
        let id = $(this).data('id');
        $.ajax({
            url: 'editar-cliente',
            type: 'POST',
            data: {
                id: id
            },
            success: function (data) {
                if (data.vista) {
                    $('#modal .modal-body').html(data.vista);
                    parametrosModal("#modal", "Editar Cliente", "modal-lg", false, 'static');
                    $('#id_municipio').select2();

                    $('#frm-editar-cliente').on('submit', function (e) {
                        e.preventDefault();
                        let datos = $(this).serialize();
                        $.ajax({
                            url: 'actualizar-cliente',
                            type: 'POST',
                            data: datos,
                            success: function (data) {
                                if (data.exito) {
                                    $('#modal').modal('hide');
                                    $('#frm-editar-cliente').trigger('reset');
                                    listadoClientes.ajax.reload(null, false);
                                    showBasicSwal(data.msg, 'success', 'Aceptar', 'btn btn-success');
                                }

                                if (data.validacion) {
                                    $('#frm-editar-cliente input, #frm-editar-cliente select').removeClass('is-invalid');

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
                                    $('#frm-editar-cliente').trigger('reset');
                                    showBasicSwal(data.msg, 'error', 'Ok', 'btn btn-danger');
                                }
                            }
                        });
                    });
                }
            }
        });
    }).on('click', 'button.btn-eliminar', function () {
        let id = $(this).data('id');
        let usuario = $(this).data('usuario');
        Swal.fire({
            title: `¿Está seguro de eliminar del registro del cliente: ${usuario}?`,
            text: "Esta acción no se puede revertir",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonText: 'Si, eliminar',
            cancelButtonText: 'No, cancelar',
            reverseButtons: true
        }).then((result) => {
            if (result.value) {
                $.ajax({
                    url: 'eliminar-cliente',
                    type: 'POST',
                    data: {
                        id: id
                    },
                    success: function (data) {
                        if (data.exito) {
                            listadoClientes.ajax.reload(null, false);
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

    $('.btn-agregar-cliente').on('click', function () {
        $.post('crear-cliente', function (data) {
            if (data.vista) {
                $('#modal .modal-body').html(data.vista);
                parametrosModal("#modal", "Agregar Cliente", "modal-lg", false, 'static');
                $('#id_municipio').select2();

                // $('#ci').on('change', function () {
                //     let ci = $(this).val();
                //     $.ajax({
                //         url: 'verificar-ci',
                //         type: 'POST',
                //         data: {
                //             ci: ci
                //         },
                //         success: function (data) {
                //             if (data.exito) {
                //                 $('#ci').val('');
                //                 $('#ci').focus();
                //                 $('#frm-registro-persona').trigger('reset');
                //                 showBasicSwal(data.msg, 'warning', 'Ok', 'btn btn-warning');
                //             }
                //         }
                //     });
                // });

                $('#frm-registro-cliente').on('submit', function (e) {
                    e.preventDefault();
                    let datos = $(this).serialize();
                    $.ajax({
                        url: 'registro-cliente',
                        type: 'POST',
                        data: datos,
                        success: function (data) {
                            if (data.exito) {
                                $('#modal').modal('hide');
                                $('#frm-registro-cliente').trigger('reset');
                                listadoClientes.ajax.reload(null, false);
                                showBasicSwal(data.msg, 'success', 'Ok', 'btn btn-success');

                            }

                            if (data.validacion) {
                                $('#frm-registro-cliente input, #frm-registro-cliente select').removeClass('is-invalid');

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
                                $('#frm-registro-cliente').trigger('reset');
                                showBasicSwal(data.msg, 'error', 'Ok', 'btn btn-danger');
                            }
                        }
                    });
                });

            }
        });
    });
});