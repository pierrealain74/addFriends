        /* Script to verify form before sending */
        function validateForm() {
            // Récupérer les valeurs des champs
            var firstname = document.forms[0]["firstname"].value;
            var lastname = document.forms[0]["lastname"].value;
            var email = document.forms[0]["email"].value;
            var description = document.forms[0]["description"].value;
            var age = document.forms[0]["age"].value;
    
            // Vérifier si les champs ne sont pas vides
            if (firstname.trim() === "" || lastname.trim() === "" || email.trim() === "" || description.trim() === "" || age.trim() === "") {
                alert("Tous les champs doivent être remplis.");
                //document.getElementById("result").innerHTML = "<div class='alert alert-danger'>Tous les champs doivent être remplis</div>";
                return false;
            }
    
            // Vérifier la longueur des champs
            if (firstname.length < 2 || firstname.length > 50 || lastname.length < 2 || lastname.length > 50) {
                alert("Les prénoms et noms doivent contenir entre 2 et 50 caractères.");
                return false;
            }
    
            if (description.length < 2 || description.length > 350) {
                alert("La description doit contenir entre 2 et 350 caractères.");
                return false;
            }
    
            // Vérifier le format de la date de naissance
            //var datePattern = /^\d{2}\/\d{2}\/\d{4}$/; pour le format dd/mm/yyyy
            var datePattern = /^\d{4}\/\d{2}\/\d{2}$/; //pour le format yyyy/mm/dd
            if (!datePattern.test(age)) {
                alert("Le format de la date de naissance doit être 'aaaa/mm/jj'.");
                return false;
            }
    
            // Vérifier le format de l'email
            var emailPattern = /^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$/;
            if (!emailPattern.test(email)) {
                alert("Veuillez saisir une adresse e-mail valide.");
                return false;
            }
    
            return true; // Soumission du formulaire si la validation réussit
        }