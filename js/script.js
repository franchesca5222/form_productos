document.addEventListener("DOMContentLoaded", function() {
    const form = document.getElementById("productoForm");
    const errorMessagesDiv = document.getElementById("errorMessages");

    function showMessage(message, isSuccess = false) {
        errorMessagesDiv.style.display = 'block';
        errorMessagesDiv.style.backgroundColor = isSuccess ; 
        errorMessagesDiv.innerHTML = message;

        // Oculta el mensaje después de 5 segundos
        setTimeout(() => {
            errorMessagesDiv.style.display = 'none';
        }, 5000);
    }


    form.addEventListener("submit", function(event) {
        event.preventDefault(); 

        let isValid = true;
        let messages = [];

        // Validaciones
        const codigo = document.getElementById("codigo");
        const codigoPattern = /^[A-Za-z0-9]{5,15}$/;
        if (!codigoPattern.test(codigo.value)) {
            messages.push("El código debe tener entre 5 y 15 caracteres alfanuméricos.");
            isValid = false;
        }

        const nombre = document.getElementById("nombre");
        if (nombre.value.length < 2 || nombre.value.length > 50) {
            messages.push("El nombre debe tener entre 2 y 50 caracteres.");
            isValid = false;
        }

        const bodega = document.getElementById("bodega");
        if (bodega.value === "") {
            messages.push("Debe seleccionar una bodega.");
            isValid = false;
        }

        const sucursal = document.getElementById("sucursal");
        if (sucursal.value === "") {
            messages.push("Debe seleccionar una sucursal.");
            isValid = false;
        }

        const moneda = document.getElementById("moneda");
        if (moneda.value === "") {
            messages.push("Debe seleccionar una moneda.");
            isValid = false;
        }

        const precio = document.getElementById("precio");
        const precioPattern = /^\d+(\.\d{1,2})?$/;
        if (!precioPattern.test(precio.value) || parseFloat(precio.value) <= 0) {
            messages.push("El precio debe ser un número positivo con hasta dos decimales.");
            isValid = false;
        }

        const materiales = document.querySelectorAll("input[name='material[]']:checked");
        if (materiales.length < 2) {
            messages.push("Debe seleccionar al menos dos materiales.");
            isValid = false;
        }

        const descripcion = document.getElementById("descripcion");
        if (descripcion.value.length < 10 || descripcion.value.length > 1000) {
            messages.push("La descripción debe tener entre 10 y 1000 caracteres.");
            isValid = false;
        }

        // Mostrar mensajes de error o éxito 
        if (!isValid) {
            showMessage(messages.join("<br>"));
        } else {
           
            const formData = new FormData(form);

        
            fetch("/formulario/producto.php", {
                method: "POST",
                body: formData
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    showMessage(data.message, true); 
                } else {
                    showMessage(`Error: ${data.message}`);
                }
            })
            .catch(error => {
                showMessage("Ocurrió un error al enviar el formulario.");
            });
        }
    });
});



//mensaje de exito o  error
/*
function showMessage(message, isSuccess = false) {
    const errorMessages = document.getElementById('errorMessages');
    errorMessages.style.display = 'block';
    errorMessages.style.backgroundColor = isSuccess;
    errorMessages.textContent = message;
    
    // Oculta el mensaje después de 5 segundos
    setTimeout(() => {
        errorMessages.style.display = 'none';
    }, 5000);
}
*/

