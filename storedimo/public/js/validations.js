// Función para validar número de teléfono
function initPhoneValidation(inputSelector, errorSelector) {
    $(document).on("blur", inputSelector, function() {
        const value = $(this).val().trim();
        const errorMsg = $(errorSelector);

        console.log('Valor ingresado:', value);

        errorMsg.text("").addClass("d-none");

        if (!value) return;

        if (!/^\d*$/.test(value)) {
            errorMsg.text("Solo se permiten números.").removeClass("d-none");
        } else if (!value.startsWith("60")) {
            errorMsg.text("El número debe iniciar con 60.").removeClass("d-none");
        } else if (value.length < 7 || value.length > 10) {
            errorMsg.text("El número debe tener entre 7 y 10 dígitos.").removeClass("d-none");
        }

        if (!errorMsg.hasClass("d-none")) {
            setTimeout(() => {
                errorMsg.addClass("d-none");
                $(this).val(""); //Se limpia el campo del teléfono cuando hay error
            }, 4000);
        }
    });
}



// Función para validar NIT
function initNitValidation(inputSelector, errorSelector) {
    // Validación en tiempo real (solo números y máximo 9 caracteres)
    $(document).on("input", inputSelector, function() {
        let value = $(this).val();

        // Eliminar todo lo que no sea número
        value = value.replace(/\D/g, "");

        // Limitar a 9 caracteres
        if (value.length > 9) {
            value = value.substring(0, 9);
        }

        $(this).val(value);
    });

    // Validación al salir del campo
    $(document).on("blur", inputSelector, function() {
        const value = $(this).val().trim();
        const errorMsg = $(errorSelector);

        console.log('NIT ingresado:', value);

        errorMsg.text("").addClass("d-none");

        if (!value) return;

        if (value.length !== 9) {
            errorMsg.text("El NIT debe tener exactamente 9 dígitos.").removeClass("d-none");

            setTimeout(() => {
                errorMsg.addClass("d-none");
                $(this).val(""); // limpiar el campo
            }, 4000);
        }
    });
}

