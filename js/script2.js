function envoyerFormulaire(event) {
  event.preventDefault(); // Empêche la soumission normale du formulaire

  // Afficher le chargement
  $("#loading").show();

  // Récupérer les données du formulaire
  var formData = $("#formulaireContact").serializeArray();
  $.ajax({
    type: "POST",
    url: "http://localhost/AgriEskny/php/formulaire.php",
    data: formData,
    dataType: "json",
    success: function (response) {
      console.log(response.success);
      if (response.success) {
        swal({
          title: "E-mail envoyé !",
          text: "Votre e-mail a été envoyé avec succès.",
          icon: "success",
          button: "OK",
        }).then((value) => {
          if (value) {
            // Rediriger l'utilisateur après la confirmation
            window.location.href = "http://localhost/AgriEskny/";
          }
        });
      } else {
        swal({
          title: "Erreur",
          text:
            response.error ||
            "Une erreur s'est produite lors de l'envoi de l'e-mail, veuillez réessayer.",
          icon: "error",
          button: "OK",
        });
      }
    },
    error: function (xhr, status, error) {
      swal({
        title: "Erreur",
        text: "Une erreur s'est produite lors de l'envoi de l'e-mail, veuillez réessayer.",
        icon: "error",
        button: "OK",
      });
    },
    complete: function () {
      // Masquer le spinner de chargement une fois que la requête AJAX est complète
      $("#loading").hide();
    },
  });
}
