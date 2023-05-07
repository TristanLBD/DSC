function searchShortcut() {
    var input, filter, container, racourci, titreRacourci, i;
    input = document.getElementById("myInput");
    filter = input.value.toLowerCase();

    container = document.getElementById("racourci-container");
    racourci = document.getElementById("racourci-container").getElementsByClassName("racourci");
    totalOfRaccourcis = racourci.length;
    for(i = 0; i < racourci.length; i++) {
        titreRacourci = racourci[i].getElementsByClassName("racourci-title")[0];
        if(titreRacourci.innerHTML.toLowerCase().indexOf(filter)>-1){
            racourci[i].style.display ='';
        } else {
            racourci[i].style.display ='none';
            totalOfRaccourcis--;
        }

        if(totalOfRaccourcis == 0) {
            document.getElementById("noresult").style.display = "";
        } else {
            document.getElementById("noresult").style.display = "none";
        }
    }
}

function actualiserPhoto(element,img) {
    // var image = document.getElementById(img);
    var fReader = new FileReader();
    fReader.readAsDataURL(element.files[0]);
    fReader.onloadend = function(event) {
        var imgToChange = document.getElementById(img);
        imgToChange.src = event.target.result;
    }
}

function triggerClick(id) {
    document.querySelector(id).click();
}

function passwordCheck(password, targetColor) {
    //! Element HTML a changer de couleur selon la validité ou non du mot de passe
    // var passwordInput = document.getElementById(targetColor);
    var textColorInput = document.getElementById(targetColor);
    // var textColorInput = passwordInput;
    //! Récupération de la donnée entrée par l'utilisateur
    text = password.value;
    nb_points = 10;
    nb_caractere = password.value.length;
    points_nbcarac = 0;
    points_complexite = 0;

    //! Vérification de la longueur du mot de passe
    if (nb_caractere >= 12) { points_nbcarac = 1; }
    //! Vérification des lettres minuscules
    if (text.match(/[a-z]/)) { points_complexite = points_complexite + 1; }
    //! Vérification des lettres majuscules
    if (text.match(/[A-Z]/)) { points_complexite = points_complexite + 2; }
    //! Vérification des chiffres
    if (text.match(/[0-9]/)) { points_complexite = points_complexite + 3; }
    //! Vérification des caractères spéciaux
    if (text.match(/\W/)) { points_complexite = points_complexite + 4; }

    resultat = points_nbcarac * points_complexite;

    if(resultat <= 4) { textColorInput.style.color = "red"; } 
    else if (resultat >4 && resultat < 6) { textColorInput.style.color = "orange"; } 
    else if (resultat > 8) { textColorInput.style.color = "green"; }
}

function checkPasswordEquality(firstPasswordInput, secondPasswordInput) {
    if (document.getElementById(firstPasswordInput).value == document.getElementById(secondPasswordInput).value) {
        document.getElementById(firstPasswordInput).style.color = "green";
    } else {
        document.getElementById(firstPasswordInput).style.color = "red";
    }
}

function transformToUpperCaseOnInput(element) {
    element.value = element.value.toUpperCase();
}   

(function() {
    "use strict"
    window.addEventListener("load", function() {
    var form = document.getElementById("form")
    form.addEventListener("submit", function(event) {
        if (form.checkValidity() == false) {
        event.preventDefault()
        event.stopPropagation()
        }
        form.classList.add("was-validated")
    }, false)
    }, false)

}())