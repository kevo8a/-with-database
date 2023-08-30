function validate_email() {
    const email=$("#email").val();
    $.ajax({
        type: "POST",
        url: "validate_email.php",
        data: { email: email },
        dataType: "json",
        success: function (data) {
            if (data.status==="error") {
                $("#message").html("").show();
                $("#message").html(data.message);
                $("#email").val("");
                setTimeout(function () {
                    $("#message").fadeOut(5000);
                }, 5000);
            } else if (data.status==="success") {
            }
        },
        error: function () {
            console.log("Ha ocurrido un error al validar el correo.");
        },
    });
}
