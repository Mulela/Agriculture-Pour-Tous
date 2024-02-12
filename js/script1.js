// Vérifier que le champ 'nom' n'est pas vide
function checkNom() {
  var nom = document.querySelector("input[name='nom']").value;

  if (nom === "") {
    document.querySelector("input[name='nom']").classList.add("error");
    return false;
  } else {
    document.querySelector("input[name='nom']").classList.remove("error");
    return true;
  }
}

// Vérifier que le champ 'email' est valide
function checkEmail() {
  var email = document.querySelector("input[name='email']").value;

  var regex = /^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-z]{2,6}$/;

  if (!regex.test(email)) {
    document.querySelector("input[name='email']").classList.add("error");
    return false;
  } else {
    document.querySelector("input[name='email']").classList.remove("error");
    return true;
  }
}

// Vérifier que le champ 'numero' est valide
function checkNumero() {
  var numero = document.querySelector("input[name='numero']").value;

  var regex = /^[0-9]{10}$/;

  if (!regex.test(numero)) {
    document.querySelector("input[name='numero']").classList.add("error");
    return false;
  } else {
    document.querySelector("input[name='numero']").classList.remove("error");
    return true;
  }
}

// Vérifier que le champ 'adresse' n'est pas vide
function checkAdresse() {
  var adresse = document.querySelector("input[name='adresse']").value;

  if (adresse === "") {
    document.querySelector("input[name='adresse']").classList.add("error");
    return false;
  } else {
    document.querySelector("input[name='adresse']").classList.remove("error");
    return true;
  }
}

// Vérifier que le champ 'message' n'est pas vide
function checkMessage() {
  var message = document.querySelector("textarea[name='message']").value;

  if (message === "") {
    document.querySelector("textarea[name='message']").classList.add("error");
    return false;
  } else {
    document.querySelector("textarea[name='message']").classList.remove("error");
    return true;
  }
}

// Vérifier les données du formulaire avant l'envoi
document.querySelector("form").addEventListener("submit", function() {
  if (!checkNom() || !checkEmail() || !checkNumero() || !checkAdresse() || !checkMessage()) {
    alert("Veuillez remplir tous les champs du formulaire correctement.");
    return false;
  }
});
