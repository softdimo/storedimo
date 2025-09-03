document.addEventListener("DOMContentLoaded", function () {
    /**
     * Inicializa el plugin intlTelInput en un input específico
     * @param {string} selector - Selector CSS del input (ej: "#celular")
     */
    window.initIntlPhone = function (selector) {
        const input = document.querySelector(selector);

        if (!input) return;

        const iti = window.intlTelInput(input, {
            initialCountry: "co",
            preferredCountries: ["co", "us", "mx", "es"],
            separateDialCode: true,
            utilsScript: "/js/utils.js", // ojo: asegúrate que existe en public/js
        });

        // Longitudes por país (ISO2 -> [min, max])
        const phoneLengths = {
            co: [10, 10], // Colombia
            us: [10, 10], // USA
            mx: [10, 10], // México
            es: [9, 9],   // España
        };

        function setInputLength(countryCode) {
            const lengths = phoneLengths[countryCode] || [7, 15]; // default
            input.setAttribute("minlength", lengths[0]);
            input.setAttribute("maxlength", lengths[1]);
        }

        // Inicializar con el país actual
        setInputLength(iti.getSelectedCountryData().iso2);

        // Cuando cambie el país
        input.addEventListener("countrychange", function () {
            const countryCode = iti.getSelectedCountryData().iso2;
            setInputLength(countryCode);
            input.value = ""; // opcional: limpiar
        });

        // Antes de enviar el formulario -> guardamos en formato internacional
        if (input.form) {
            input.form.addEventListener("submit", function () {
                input.value = iti.getNumber();

                /* const n = iti.getNumber(intlTelInputUtils.numberFormat.NATIONAL);
            input.value = n.replace(/\D/g, ''); */
            });
        }
    };
});

