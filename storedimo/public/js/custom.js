document.addEventListener("DOMContentLoaded", function() {
    const input = document.querySelector("#celular");

    if (input) {
        const iti = window.intlTelInput(input, {
            initialCountry: "co",
            preferredCountries: ["co", "us", "mx", "es"],
            separateDialCode: true,
            utilsScript: "/js/utils.js",
        });

        // Definimos las longitudes por país (ISO2 -> [min, max])
        const phoneLengths = {
            co: [10, 10], // Colombia
            us: [10, 10], // Estados Unidos
            mx: [10, 10], // México
            es: [9, 9],   // España
        };

        // Función para aplicar restricciones según país
        function setInputLength(countryCode) {
            const lengths = phoneLengths[countryCode] || [7, 15]; // default
            input.setAttribute("minlength", lengths[0]);
            input.setAttribute("maxlength", lengths[1]);
        }

        // Inicializar con el país por defecto
        setInputLength(iti.getSelectedCountryData().iso2);

        // Escuchar cuando cambie el país
        input.addEventListener("countrychange", function() {
            const countryCode = iti.getSelectedCountryData().iso2;
            setInputLength(countryCode);
            input.value = ""; // opcional: limpiar cuando cambia de país
        });

        // Antes de enviar el formulario, guardamos en formato completo
        input.form.addEventListener("submit", function() {
            input.value = iti.getNumber();
        });
    }
});
