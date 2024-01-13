$(document).ready(function() {
    $("#formularioVale").on("submit", function(event) {
        event.preventDefault(); 

        var datosFormulario = $(this).serialize(); 

        $.ajax({
            type: "POST",
            url: "tuArchivoPHP.php", 
            data: datosFormulario,
            success: function(response) {
              
                alert("Vale generado con éxito");
            },
            error: function(xhr, status, error) {
              
                alert("Ocurrió un error al generar el vale");
            }
        });
    });
});
