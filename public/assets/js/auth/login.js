$(document).ready(function() {
    $('#frm-login').submit(function(e) {
        e.preventDefault();
        e.stopImmediatePropagation();
        let button = $(this).find('[type="submit"]');
        button.prop('disabled', true);

        let data = $(this).serialize();
        $.ajax({
            url: 'login',
            type: 'POST',
            data: data,
            success: function(res) {
                button.prop('disabled', false);
                if (res.validacion) {
                    $('#frm-login input').removeClass('is-invalid');

                    let errorList = '<ul>';
                    for (let [key, value] of Object.entries(res.validacion)) {
                        $(`#${key}`).addClass('is-invalid');
                        errorList += `<li>${value}</li>`;
                    }
                    errorList += '</ul>';
                    Swal.fire({
                        icon: 'warning',
                        title: 'Error de validación',
                        html: errorList,
                        confirmButtonText: 'Ok',
                        confirmButtonClass: 'btn btn-warning'
                    });
                }

                if(res.exito == false){
                    $('#frm-login').trigger('reset');
                    Swal.fire({
                        icon: 'error',
                        title: 'Error',
                        text: res.mensaje,
                        confirmButtonText: 'Ok',
                        confirmButtonClass: 'btn btn-danger'
                    });
                }

                
            }
        });
    });
});