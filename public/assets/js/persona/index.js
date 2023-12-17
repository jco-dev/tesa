$(document).ready(function () {

    let listadoPersonas = $('#tbl-listado-personal').DataTable({
        responsive: true,
        processing: true,
        select: false,
        serverSide: true,
        ajax: {
            url: 'listado-personas-ajax',
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

    }).on('click', 'button.btn-editar', (event) => {
        let id = $(event.target).data('id');
        $.ajax({
            url: 'editar-persona',
            type: 'POST',
            data: {
                id: id
            },
            success: function (data) {
                if (data.vista) {
                    $('#modal .modal-body').html(data.vista);
                    parametrosModal("#modal", "Editar Persona", "modal-lg", false, 'static');

                    $('#frm-editar-persona').on('submit',
                        function (e) {
                            e.preventDefault();
                            let datos = $(this).serialize();
                            $.ajax({
                                url: 'actualizar-persona',
                                type: 'POST',
                                data: datos,
                                success: function (data) {
                                    if (data.exito) {
                                        $('#modal').modal('hide');
                                        $('#frm-editar-persona').trigger('reset');
                                        listadoPersonas.ajax.reload(null, false);
                                        showBasicSwal(data.msg, 'success', 'Aceptar', 'btn btn-success');
                                    }

                                    if (data.validacion) {
                                        $('#frm-editar-persona input, #frm-editar-persona select').removeClass('is-invalid');

                                        let errorList = '<ul>';
                                        for (let [key, value] of Object.entries(data.validacion)) {
                                            $(`#${key}`).addClass('is-invalid');
                                            errorList += `<li>${value}</li>`;
                                        }
                                        errorList += '</ul>';

                                        showBasicSwal(data.msg, 'warning', 'Ok', 'btn btn-warning');
                                    }

                                    if (data.exito == false) {
                                        $('#modal').modal('hide');
                                        $('#frm-editar-persona').trigger('reset');
                                        showBasicSwal(data.msg, 'error', 'Ok', 'btn btn-danger');

                                    }
                                }
                            });
                        });
                }
            }
        });
    });

    $('.btn-agregar-persona').on('click', function () {
        $.post('crear-persona', function (data) {
            if (data.vista) {
                $('#modal .modal-body').html(data.vista);
                parametrosModal("#modal", "Agregar Persona", "modal-lg", false, 'static');

                $('#ci').on('change', function () {
                    let ci = $(this).val();
                    $.ajax({
                        url: 'verificar-ci',
                        type: 'POST',
                        data: {
                            ci: ci
                        },
                        success: function (data) {
                            if (data.exito) {
                                $('#ci').val('');
                                $('#ci').focus();
                                $('#frm-registro-persona').trigger('reset');
                                showBasicSwal(data.msg, 'warning', 'Ok', 'btn btn-warning');
                            }
                        }
                    });
                });

                $('#frm-registro-persona').on('submit', function (e) {
                    e.preventDefault();
                    let datos = $(this).serialize();
                    $.ajax({
                        url: 'registro-persona',
                        type: 'POST',
                        data: datos,
                        success: function (data) {
                            if (data.exito) {
                                $('#modal').modal('hide');
                                $('#frm-registro-persona').trigger('reset');
                                listadoPersonas.ajax.reload(null, false);
                                showBasicSwal(data.msg, 'success', 'Ok', 'btn btn-success');
                               
                            }

                            if (data.validacion) {
                                $('#frm-registro-persona input, #frm-registro-persona select').removeClass('is-invalid');

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
                                $('#frm-registro-persona').trigger('reset');
                                showBasicSwal(data.msg, 'error', 'Ok', 'btn btn-danger');
                            }
                        }
                    });
                });

            }
        });
    });
});