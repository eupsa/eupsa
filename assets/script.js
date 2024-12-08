$(document).ready(function () {
  $("#contact-form").submit(function (e) {
    e.preventDefault();

    var formData = $(this).serialize();

    $("#loadingOverlay").show();
    $("#submitButton").prop("disabled", true);
    $("#loadingIcon").show();
    $("#buttonText").text("Enviando...");

    $.ajax({
      url: "assets/contato.php",
      type: "POST",
      data: formData,
      success: function (response) {
        var data = JSON.parse(response);

        $("#loadingOverlay").hide();
        $("#loadingIcon").hide();
        $("#submitButton").prop("disabled", false);
        $("#buttonText").text("Enviar Mensagem");

        alert(data.message);
      },
      error: function () {
        $("#loadingOverlay").hide();
        $("#loadingIcon").hide();
        $("#submitButton").prop("disabled", false);
        $("#buttonText").text("Enviar Mensagem");

        alert("Ocorreu um erro, tente novamente.");
      },
    });
  });
});
