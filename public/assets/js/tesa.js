$(document).ready(function () {

    // Función para mostrar el modal //
    window.parametrosModal = function (
        idModal,
        titulo,
        tamano,
        onEscape,
        backdrop
    ) {
        const modal$ = $(idModal);

        modal$.find('.modal-title').html(titulo);

        modal$.find('.modal-dialog').removeClass('modal-lg modal-xl modal-sm');
        modal$.find('.modal-dialog').addClass(tamano);

        modal$.modal({
            backdrop,
            keyboard: onEscape,
        });

        modal$.modal('show');
    };

    // Swal
    window.showBasicSwal = function (message, icon = 'success', buttonText = 'Ok', confirmButtonClass = 'btn btn-primary') {
        Swal.fire({
            html: message,
            icon: icon,
            buttonsStyling: false,
            confirmButtonText: buttonText,
            customClass: {
                confirmButton: confirmButtonClass
            }
        });
    };
});