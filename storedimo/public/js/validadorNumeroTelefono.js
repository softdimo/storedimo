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
