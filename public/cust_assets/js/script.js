document.addEventListener('DOMContentLoaded', function () {
    const loginInput = document.getElementById('login');
    const btnModifier = document.getElementById('btn-modifier');
    const btnMettreAJour = document.getElementById('btn-mettre-a-jour');

    if (btnModifier) {
        btnModifier.addEventListener('click', function () {
            const login = loginInput.value.trim();
            const inputModifier = document.getElementById('modifier-login');

            if (inputModifier) {
                inputModifier.value = login; // Assigner le login
            }
            console.log("Modifier le client avec le login :", login);
        });
    }

    if (btnMettreAJour) {
        btnMettreAJour.addEventListener('click', function () {
            const login = loginInput.value.trim();
            const inputUpdate = document.getElementById('update-login');

            if (inputUpdate) {
                inputUpdate.value = login; // Assigner le login
            }
            console.log("Mettre à jour le client avec le login :", login);
        });
    }
    // if (btnMettreAJour) {
    //     btnMettreAJour.addEventListener('click', function() {
    //         const login = loginInput.value.trim();
    //         sessionStorage.setItem('login', login);

    //         const storedLogin = sessionStorage.getItem('login');
    //         const inputUpdate = document.getElementById('update-login');

    //         if (inputUpdate) {
    //             inputUpdate.value = storedLogin; // Assigner le login
    //         }
    //         console.log("Mettre à jour le client avec le login :", storedLogin);
    //     });
    // }
});


document.addEventListener('DOMContentLoaded', function () {
    const passwordInput = document.querySelector('input[name="password"]');
    const confirmPasswordInput = document.querySelector('input[name="confirmPassword"]');
    const submitButton = document.getElementById('submitButton'); // Assurez-vous que le bouton a cette classe
    const passwordMessage = document.getElementById('password-message'); // Élément pour le message de conformité

    // Fonction pour vérifier la conformité des mots de passe
    function validatePassword() {
        if (passwordInput.value === confirmPasswordInput.value && passwordInput.value.length > 0) {
            submitButton.disabled = false; // Activer le bouton si les mots de passe correspondent
            passwordMessage.style.display = 'none'; // Cacher le message de conformité
        } else {
            submitButton.disabled = true; // Désactiver le bouton si les mots de passe ne correspondent pas
            if (passwordInput.value.length === 0 || confirmPasswordInput.value.length === 0) {
                passwordMessage.style.display = 'none'; // Cacher si l'un des champs est vide
            } else {
                passwordMessage.textContent = "Les mots de passe ne correspondent pas."; // Mettre à jour le message
                passwordMessage.style.display = 'block'; // Afficher le message
            }
        }
    }

    // Écouter les événements sur les champs de mot de passe
    passwordInput.addEventListener('input', validatePassword);
    confirmPasswordInput.addEventListener('input', validatePassword);
});

document.addEventListener('DOMContentLoaded', function () {
    const steps = document.querySelectorAll('.stepRegister'); // Sélectionner toutes les étapes
    const nextButtons = document.querySelectorAll('.next-btn'); // Boutons "Next"
    const prevButtons = document.querySelectorAll('.prev-btn'); // Boutons "Prev"
    const passwordInput = document.querySelector('input[name="password"]');
    const confirmPasswordInput = document.querySelector('input[name="confirmPassword"]');

    function validateStep(step) {
        let isValid = true;
        const allFields = step.querySelectorAll('input, textarea, select'); // Tous les champs de l'étape
        allFields.forEach(field => {
            if (field.required && !field.value.trim()) {
                isValid = false;
                field.classList.add('is-invalid'); // Ajouter une classe pour indiquer une erreur
                field.classList.remove('is-valid'); // Retirer la classe valide
            } else {
                field.classList.remove('is-invalid'); // Retirer la classe d'erreur
                field.classList.add('is-valid'); // Ajouter une classe pour indiquer la validité
            }
        });

        return isValid;
    }

    // Fonction pour valider les champs de téléphone

    // Fonction pour valider les champs de password et confirmer password
    function validatePassword() {
        const passwordValue = passwordInput.value.trim();
        const confirmPasswordValue = confirmPasswordInput.value.trim();
        let isValid = true;

        if (!passwordValue || !confirmPasswordValue) {
            isValid = false;
            passwordInput.classList.add('is-invalid');
            confirmPasswordInput.classList.add('is-invalid');
            alert("Veuillez remplir les champs de password et confirmer password.");
        }

        if (passwordValue !== confirmPasswordValue) {
            isValid = false;
            passwordInput.classList.add('is-invalid');
            confirmPasswordInput.classList.add('is-invalid');
            alert("Les mots de passe ne correspondent pas.");
        }

        return isValid;
    }

    // Gestionnaire pour les boutons "Next"
    nextButtons.forEach(button => {
        button.addEventListener('click', function () {
            const currentContainer = this.closest('.stepRegister'); // Étape actuelle
            const nextStep = document.querySelector(`#${this.dataset.next}`); // Étape suivante

            // Vérifier si on est sur l'étape contenant les champs de password et confirmer password
            if (currentContainer.contains(passwordInput) || currentContainer.contains(confirmPasswordInput)) {
                if (!validatePassword()) {
                    alert("Veuillez vérifier que les mots de passe sont conformes.");
                    return; // Arrêter si les champs ne sont pas valides
                }
            }

            if (validateStep(currentContainer)) {
                // Si les champs sont valides, attendre 1 seconde avant de passer à l'étape suivante
                setTimeout(() => {
                    currentContainer.classList.add('d-none');
                    nextStep.classList.remove('d-none');
                }, 1000); // 1 seconde
            }
        });
    });
    // Gestionnaire pour les boutons "Prev"
    prevButtons.forEach(button => {
        button.addEventListener('click', function () {
            const currentContainer = this.closest('.stepRegister'); // Étape actuelle
            const prevStep = document.querySelector(`#${this.dataset.prev}`); // Étape précédente

            currentContainer.classList.add('d-none');
            prevStep.classList.remove('d-none');
        });
    });
});

document.addEventListener('DOMContentLoaded', function () {
    const steps = document.querySelectorAll('.stepRegisterAddContrat'); // Sélectionner toutes les étapes
    const nextButtons = document.querySelectorAll('.next-btn'); // Boutons "Next"
    const prevButtons = document.querySelectorAll('.prev-btn'); // Boutons "Prev"
    const contratInput = document.querySelector('input[name="contrat"]');
    const datenaissanceInput = document.querySelector('input[name="datenaissance"]');

    function validateStep(step) {
        let isValid = true;
        const allFields = step.querySelectorAll('input, textarea, select'); // Tous les champs de l'étape
        allFields.forEach(field => {
            if (field.required && !field.value.trim()) {
                isValid = false;
                field.classList.add('is-invalid'); // Ajouter une classe pour indiquer une erreur
                field.classList.remove('is-valid'); // Retirer la classe valide
            } else {
                field.classList.remove('is-invalid'); // Retirer la classe d'erreur
                field.classList.add('is-valid'); // Ajouter une classe pour indiquer la validité
            }
        });

        return isValid;
    }

    // Gestionnaire pour les boutons "Next"

    nextButtons.forEach(button => {
        button.addEventListener('click', function () {
            const currentContainer = this.closest('.stepRegisterAddContrat'); // Étape actuelle
            const nextStep = document.querySelector(`#${this.dataset.next}`); // Étape suivante

            // // Vérifier si on est sur l'étape contenant les champs de password et confirmer password
            // if (currentContainer.contains(contratInput) || currentContainer.contains(datenaissanceInput)) {
            //     if (!validatePassword()) {
            //         alert("Veuillez vérifier que les mots de passe sont conformes.");
            //         return; // Arrêter si les champs ne sont pas valides
            //     }
            // }

            // if (validateStep(currentContainer)) {
            // Si les champs sont valides, attendre 1 seconde avant de passer à l'étape suivante
            setTimeout(() => {
                currentContainer.classList.add('d-none');
                nextStep.classList.remove('d-none');
            }, 1000); // 1 seconde
            // }
        });
    });
    // Gestionnaire pour les boutons "Prev"
    prevButtons.forEach(button => {
        button.addEventListener('click', function () {
            const currentContainer = this.closest('.stepRegister'); // Étape actuelle
            const prevStep = document.querySelector(`#${this.dataset.prev}`); // Étape précédente

            currentContainer.classList.add('d-none');
            prevStep.classList.remove('d-none');
        });
    });
});

// Debut js perso prestation


document.addEventListener('DOMContentLoaded', function () {
    // Récupérer les éléments du DOM
    const operateurInputs = document.querySelectorAll('input[name="Operateur"]');
    const telPaiementInput = document.getElementById('TelPaiement');
    const confirmTelPaiementInput = document.getElementById('ConfirmTelPaiement');

    let selectedOperateur = ""; // Variable pour stocker l'opérateur sélectionné
    desactiverChamps();

    // Fonction pour activer ou désactiver les champs de telPaiement et confirmTelPaiement
    function activerChamps() {
        telPaiementInput.disabled = false;
        confirmTelPaiementInput.disabled = false;
    }

    function desactiverChamps() {
        telPaiementInput.disabled = true;
        confirmTelPaiementInput.disabled = true;
    }

    // Ajouter un écouteur pour chaque input radio
    operateurInputs.forEach(input => {
        input.addEventListener('change', function () {
            let prefix = "";
            selectedOperateur = this.value; // Mettre à jour l'opérateur sélectionné
            switch (this.value) {
                case "Orange_money":
                    prefix = "07";
                    break;
                case "MTN_money":
                    prefix = "05";
                    break;
                case "Moov_money":
                    prefix = "01";
                    break;
            }
            if (prefix) {
                activerChamps();
                telPaiementInput.value = prefix;
                confirmTelPaiementInput.value = prefix;
            }
        });
    });

    // Fonction pour vérifier le préfixe en fonction de l'opérateur
    const validatePrefix = (input) => {
        const value = input.value;
        let requiredPrefix = "";

        switch (selectedOperateur) {
            case "Orange_money":
                requiredPrefix = "07";
                break;
            case "MTN_money":
                requiredPrefix = "05";
                break;
            case "Moov_money":
                requiredPrefix = "01";
                break;
        }

        if (!value.startsWith(requiredPrefix)) {
            const message = `Le numéro saisi doit commencer par ${requiredPrefix} pour ${selectedOperateur.replace('_', ' ')}.`;
            alert(message);
            input.classList.add('is-invalid');
        } else {
            input.classList.remove('is-invalid');
        }
    };

    // Ajouter l'événement 'blur' pour valider le préfixe uniquement
    [telPaiementInput, confirmTelPaiementInput].forEach(input => {
        input.addEventListener('blur', function () {
            validatePrefix(this);
        });
    });
});


document.addEventListener('DOMContentLoaded', function () {
    const steps = document.querySelectorAll('.etaperdv'); // Sélectionner toutes les étapes
    const nextButtons = document.querySelectorAll('.next-btn'); // Boutons "Next"
    const submitdrvButtons = document.querySelectorAll('.submitdrv-btn'); // Boutons "Next"
    const prevButtons = document.querySelectorAll('.prev-btn'); // Boutons "Prev"
    // const telPaiementField = document.getElementById('TelPaiement');
    // const confirmTelPaiementField = document.getElementById('ConfirmTelPaiement');
    // Fonction pour valider les champs obligatoires dans une étape donnée
    function validateStep(step) {
        let isValid = true;
        const allFields = step.querySelectorAll('input, textarea, select'); // Tous les champs de l'étape
        allFields.forEach(field => {
            if (field.required && !field.value.trim()) {
                isValid = false;
                field.classList.add('is-invalid'); // Ajouter une classe pour indiquer une erreur
                field.classList.remove('is-valid'); // Retirer la classe valide
            } else {
                field.classList.remove('is-invalid'); // Retirer la classe d'erreur
                field.classList.add('is-valid'); // Ajouter une classe pour indiquer la validité
            }
        });

        return isValid;
    }


    // Gestionnaire pour les boutons "Next"
    nextButtons.forEach(button => {
        button.addEventListener('click', function () {
            const currentContainer = this.closest('.etaperdv'); // Étape actuelle
            const nextStep = document.querySelector(`#${this.dataset.next}`); // Étape suivante

            // // Vérifier si on est sur l'étape contenant les champs de téléphone
            // if (currentContainer.contains(telPaiementField)) {
            //     if (!validateTelFields()) {
            //         alert("Veuillez vérifier que les numéros de téléphone sont conformes.");
            //         return; // Arrêter si les champs ne sont pas valides
            //     }
            // }

            if (validateStep(currentContainer)) {
                // Si les champs sont valides, attendre 1 seconde avant de passer à l'étape suivante
                setTimeout(() => {
                    currentContainer.classList.add('d-none');
                    nextStep.classList.remove('d-none');
                }, 1000); // 1 seconde
            }
        });
    });
    submitdrvButtons.forEach(button => {
        button.addEventListener('click', function () {
            const currentContainer = this.closest('.etaperdv'); // Étape actuelle

            if (validateStep(currentContainer)) {
                // Si les champs sont valides, attendre 1 seconde avant de soumettre le formulair
                setTimeout(() => {
                    return;
                }, 500);
            }
        });
    });

    // Gestionnaire pour les boutons "Prev"
    prevButtons.forEach(button => {
        button.addEventListener('click', function () {
            const currentContainer = this.closest('.etaperdv'); // Étape actuelle
            const prevStep = document.querySelector(`#${this.dataset.prev}`); // Étape précédente

            currentContainer.classList.add('d-none');
            prevStep.classList.remove('d-none');
        });
    });
});



document.addEventListener('DOMContentLoaded', function () {
    const steps = document.querySelectorAll('.etape, .etapePrest'); // Sélectionner toutes les étapes
    const nextButtons = document.querySelectorAll('.next-btn'); // Boutons "Next"
    const submitdrvButtons = document.querySelectorAll('.submitdrv-btn'); // Boutons "Next"
    const prevButtons = document.querySelectorAll('.prev-btn'); // Boutons "Prev"
    const telPaiementField = document.getElementById('TelPaiement');
    const ibanPaiementField = document.getElementById('IBAN');
    let ibanField = document.querySelectorAll('.rib-input');
    const confirmTelPaiementField = document.getElementById('ConfirmTelPaiement');
    const otpContainer = document.getElementById('OTP');
    const resendOtpLink = document.querySelector('.resend-otp-link');
    const otpInputs = document.querySelectorAll('.otp-input');
    const otpTimer = document.createElement('div'); // Timer pour afficher le compte à rebours
    const montantSouhaite = document.getElementById('montantSouhaite');
    const ibanPaiementSection = document.getElementById('IBANPaiement');
    const telPaiementSection = document.getElementById('TelephonePaiement')

    const operateurInputs = document.querySelectorAll('input[name="Operateur"]');
    const telOtpField = document.getElementById('TelOtp');


    // Fonction pour valider les champs obligatoires dans une étape donnée
    function validateStep(step) {
        let isValid = true;
        const allFields = step.querySelectorAll('input, textarea, select'); // Tous les champs de l'étape

        allFields.forEach(field => {
            if (field.required && !field.value.trim()) {
                isValid = false;
                field.classList.add('is-invalid'); // Ajouter une classe pour indiquer une erreur
                field.classList.remove('is-valid'); // Retirer la classe valide
            } else {
                field.classList.remove('is-invalid'); // Retirer la classe d'erreur
                field.classList.add('is-valid'); // Ajouter une classe pour indiquer la validité
            }
        });

        return isValid;
    }

    // Fonction pour valider les champs de téléphone

    function validateIbanFields() {

        // const ibanPaiementField = document.getElementById('ibanPaiement');
        // const confirmIbanPaiementField = document.getElementById('confirmIbanPaiement');
        const ibanPaiementSection = document.getElementById('IBANPaiement');


        const ibanValue = ibanPaiementField.value.trim();

        // const confirmIbanValue = confirmIbanPaiementField.value.trim();

        let isValid = true;

        // Vérifier si la section n'est pas masquée
        if (!ibanPaiementSection.classList.contains('d-none')) {
            // Réinitialiser les classes d'erreur
            ibanField.forEach(input => {
                input.classList.remove('is-invalid');
            });
            // ibanPaiementField.classList.remove('is-invalid');
            // confirmIbanPaiementField.classList.remove('is-invalid');

            // Vérification : Les champs ne doivent pas être vides
            if (ibanValue.length == 0) {
                isValid = false;
                // ibanField.classList.add('is-invalid');
                ibanField.forEach(input => {
                    input.classList.add('is-invalid');
                    input.classList.remove('is-valid');
                });
                // ibanPaiementField.classList.add('is-invalid');
                // confirmIbanPaiementField.classList.add('is-invalid');
                alert("Veuillez saisir Obligatoirement un RIB.");
            }

            // Vérification : Les valeurs doivent correspondre
            else if (ibanValue.length !== 24) {
                isValid = false;
                ibanField.forEach(input => {
                    if (input.value.length == 0 || input.value == null || input.value == undefined || input.value == " ") {
                        input.classList.add('is-invalid');
                        input.classList.remove('is-valid');
                    } else {
                        input.classList.remove('is-invalid');
                        input.classList.add('is-valid');
                    }
                });
                // confirmIbanPaiementField.classList.add('is-invalid');
                alert("Le RIB doit contenir exactement 24 chiffres. Veuillez saisir tous les champs.");
            }

            // Si tout est valide, retirer les classes d'erreur
            if (isValid) {
                ibanField.forEach(input => {
                    input.classList.remove('is-invalid');
                    input.classList.add('is-valid');
                });
                // ibanPaiementField.classList.remove('is-invalid');
                // confirmIbanPaiementField.classList.remove('is-invalid');
            }
        }

        return isValid;
    }

    function validateTelFields() {
        const telValue = telPaiementField.value.trim();
        const confirmTelValue = confirmTelPaiementField.value.trim();
        const telPaiementSection = document.getElementById('TelephonePaiement');

        let isValid = true;

        // Vérifier si la section n'est pas masquée
        if (!telPaiementSection.classList.contains('d-none')) {
            // Vérifier si les champs ne sont pas vides
            if (!telValue || !confirmTelValue) {
                isValid = false;
                telPaiementField.classList.add('is-invalid');
                confirmTelPaiementField.classList.add('is-invalid');
            }
            // Vérifier si les valeurs correspondent
            else if (telValue !== confirmTelValue) {
                isValid = false;
                telPaiementField.classList.add('is-invalid');
                confirmTelPaiementField.classList.add('is-invalid');
            } else {
                // Tout est valide, retirer les classes d'erreur
                telPaiementField.classList.remove('is-invalid');
                confirmTelPaiementField.classList.remove('is-invalid');
            }

            // Vérifier le format du numéro (exemple : 10 chiffres)
            const phoneRegex = /^[0-9]{10}$/; // Modifier selon le format attendu
            if (!phoneRegex.test(telValue)) {
                isValid = false;
                telPaiementField.classList.add('is-invalid');
            } else {
                telPaiementField.classList.remove('is-invalid');
            }
        }
        return isValid;
    }

    // Fonction pour soumettre l'OTP
    async function sendOtp(phone) {
        let phoneNumber = '225' + phone;
        let firstTwoDigits = phone.substring(0, 2); // Extraire les deux premiers chiffres de phone

        if (firstTwoDigits == '07' || firstTwoDigits == '05') {
            try {
                const response = await fetch('/api/send-otpByOrangeAPI', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                    },
                    body: JSON.stringify({
                        TelPaiement: phoneNumber
                    }),
                });

                const result = await response.json();

                if (response.ok) {
                    alert(`Un message contenant un code de confirmation a été envoyé sur le numéro ${phoneNumber}.`);
                    startOtpTimer(); // Démarrer le décompte après l'envoi de l'OTP
                    return true;
                } else {
                    alert("Une erreur s'est produite lors de l'envoi du code de confirmation.");
                    // alert(result.error || "Une erreur s'est produite lors de l'envoi du code de confirmation.");
                    return false;
                }
            } catch (error) {
                alert("Une erreur s'est produite lors de l'envoi du code de confirmation.");
                console.error(error);
                return false;
            }
        } else if (firstTwoDigits == '01') {
            try {
                const response = await fetch('/api/send-otpByInfobipAPI', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                    },
                    body: JSON.stringify({
                        TelPaiement: phoneNumber
                    }),
                });

                const result = await response.json();

                if (response.ok) {
                    alert(`Un message contenant un code de confirmation a été envoyé sur le numéro ${phoneNumber}.`);
                    startOtpTimer(); // Démarrer le décompte après l'envoi de l'OTP
                    return true;
                } else {
                    alert(result.error || "Une erreur s'est produite lors de l'envoi du code de confirmation.");
                    return false;
                }
            } catch (error) {
                alert("Une erreur s'est produite lors de l'envoi du code de confirmation.");
                console.error(error);
                return false;
            }
        }
    }

    // Fonction pour démarrer le compte à rebours pour l'expiration de l'OTP
    let otpExpirationTime = 3 * 60; // 5 minutes en secondes
    let otpInterval;

    function startOtpTimer() {
        otpTimer.classList.add('otp-timer');
        otpContainer.appendChild(otpTimer); // Ajouter le timer à l'interface
        updateOtpTimer();

        otpInterval = setInterval(() => {
            otpExpirationTime--;
            updateOtpTimer();

            if (otpExpirationTime <= 0) {
                clearInterval(otpInterval);
                otpTimer.textContent = "Le code de confirmation a expiré.";
                resendOtpLink.classList.remove('d-none'); // Afficher le lien pour renvoyer l'OTP
            }
        }, 1000); // Met à jour chaque seconde
    }

    function updateOtpTimer() {
        const minutes = Math.floor(otpExpirationTime / 60);
        const seconds = otpExpirationTime % 60;
        otpTimer.textContent = `Temps restant: ${minutes}:${seconds < 10 ? '0' : ''}${seconds}`;
    }

    // Fonction pour renvoyer l'OTP
    resendOtpLink.addEventListener('click', async function () {
        otpExpirationTime = 3 * 60; // Réinitialiser le temps d'expiration
        clearInterval(otpInterval); // Arrêter l'ancien intervalle
        resendOtpLink.classList.add('d-none'); // Cacher le lien pendant l'envoi de l'OTP
        let phoneNumber = null;
        if (telPaiementField.value != null && telPaiementField.value != '') {
            phoneNumber = telPaiementField.value.trim();
        } else {
            phoneNumber = telOtpField.value.trim();
        }
        const otpSent = await sendOtp(phoneNumber);

        if (!otpSent) {
            return; // Arrêter si l'OTP n'a pas pu être envoyé
        }
        // else{
        //     startOtpTimer();
        //     alert(`Un message contenant un code de confirmation a été envoyé sur le numéro ${phoneNumber}.`);
        // }
    });

    const montantSouhaiteField = document.getElementById('montantSouhaite');
    const AutresInfos = document.getElementById('AutresInfos');
    const capitalField = document.getElementById('Capital');
    const TotalEncaissementField = document.getElementById("TotalEncaissement");
    const msgError = $('#msgerror');
    const msgSuccess = $('#msgesucces');
    const ibanMsgError = $('#ibanMsgError');
    const ibanMsgSuccess = $('#ibanMsgSuccess');
    const ibanConfirmMsgError = $('#ibanConfirmMsgError');
    const ibanConfirmMsgSuccess = $('#ibanConfirmMsgSuccess');
    const telMsgError = $('#telMsgError');
    const telMsgSuccess = $('#telMsgSuccess');
    const telConfirmMsgError = $('#telConfirmMsgError');
    const telConfirmMsgSuccess = $('#telConfirmMsgSuccess');
    const countError = $('#counterror');
    const countSuccess = $('#countesucces');
    const btnIbanPaiementSuivant = document.getElementById('btnIbanPaiementSuivant');
    const btnTelPaiementSuivant = document.getElementById('btnTelPaiementSuivant');
    const btnContratSuivant = document.getElementById('btnContratSuivant');

    btnContratSuivant.disabled = true;

    // Vérification des champs de IBAN si présents dans l'étape actuelle
    if (!ibanPaiementSection.classList.contains('d-none')) {
        // Réinitialisation des messages
        ibanMsgError.text("").hide();
        ibanMsgSuccess.text("").hide();
        btnIbanPaiementSuivant.disabled = true;

        // Fonction pour mettre à jour le champ IBAN
        function updateIBAN() {
            let ibanValue = "";
            ibanField.forEach(input => {
                ibanValue += input.value;
                if (input.value.length == 0 || input.value == null || input.value == undefined || input.value == " ") {
                    input.classList.add('is-invalid');
                    input.classList.remove('is-valid');
                } else {
                    input.classList.remove('is-invalid');
                    input.classList.add('is-valid');
                }
                ibanValue = ibanValue.replace(/[^a-zA-Z0-9]/g, '');
                if (ibanValue.length < 24 || ibanValue.length > 24) {
                    // ibanPaiementField.classList.add('is-invalid');
                    // ibanPaiementField.classList.remove('is-valid');
                    ibanMsgSuccess.text("").hide();
                    ibanMsgError.text("Le RIB doit contenir exactement 24 caractères. Veuillez saisir tous les champs.").show();
                    btnIbanPaiementSuivant.disabled = true;
                } else {
                    // ibanPaiementField.classList.remove('is-invalid');
                    // ibanPaiementField.classList.add('is-valid');
                    ibanMsgSuccess.text("Vous pouvez passer au suivant").show();
                    ibanMsgError.text("").hide();
                    btnIbanPaiementSuivant.disabled = false;
                }
            });
            ibanPaiementField.value = ibanValue;
        }

        // Écoute les changements dans chaque champ d'entrée
        ibanField.forEach(input => {
            input.addEventListener("input", updateIBAN);
        });

    }

    if (!telPaiementSection.classList.contains('d-none')) {
        btnTelPaiementSuivant.disabled = true;
        let selectedOperateur = ""; // Variable pour stocker l'opérateur sélectionné

        // Ajouter un écouteur pour chaque input radio
        operateurInputs.forEach(input => {
            input.addEventListener('change', function () {
                let prefix = "";
                selectedOperateur = this.value; // Mettre à jour l'opérateur sélectionné
                switch (this.value) {
                    case "Orange_money":
                        prefix = "07";
                        break;
                    case "MTN_money":
                        prefix = "05";
                        break;
                    case "Moov_money":
                        prefix = "01";
                        break;
                }
                telPaiementField.addEventListener('input', function (e) {
                    const telValue = e.target.value.trim();
                    let firstTwoDigits = telValue.substring(0, 2); // Extraire les deux premiers chiffres de phone
                    // Réinitialisation des messages
                    telMsgError.text("").hide();
                    telMsgSuccess.text("").hide();

                    if (telValue.length != 10 || firstTwoDigits !== prefix) {
                        telPaiementField.classList.add('is-invalid');
                        telPaiementField.classList.remove('is-valid');
                        telMsgError.text("Le numéro de téléphone doit avoir 10 caractères et doit commencer par " + prefix + ".").show();
                        btnTelPaiementSuivant.disabled = true;
                    } else {
                        telPaiementField.classList.remove('is-invalid');
                        telPaiementField.classList.add('is-valid');
                        // telMsgSuccess.text("Le numéro de téléphone est valide.").show();
                        // btnTelPaiementSuivant.disabled = false;
                    }
                });

                confirmTelPaiementField.addEventListener('input', function (e) {
                    const confirmTel = e.target.value.trim();
                    const telValue = telPaiementField.value.trim();
                    telConfirmMsgError.text("").hide();
                    telConfirmMsgSuccess.text("").hide();

                    if (confirmTel !== telValue || confirmTel.length !== 10) {
                        confirmTelPaiementField.classList.add('is-invalid');
                        confirmTelPaiementField.classList.remove('is-valid');
                        telConfirmMsgError.text("Le numéro de téléphone de confirmation est ne correspond pas.").show();
                        btnTelPaiementSuivant.disabled = true;
                    } else {
                        confirmTelPaiementField.classList.remove('is-invalid');
                        confirmTelPaiementField.classList.add('is-valid');
                        telConfirmMsgSuccess.text("Le numéro de téléphone de confirmation est correct.").show();
                        btnTelPaiementSuivant.disabled = false;
                    }
                });

            });
        });
    }

    montantSouhaiteField.addEventListener('input', function (e) {
        let value = e.target.value.replace(/\s/g, '').replace(/[^0-9]/g, ''); // Supprime espaces et caractères non numériques

        if (value) {
            e.target.value = parseInt(value, 10).toLocaleString('fr-FR'); // Formate avec séparateurs de milliers
        } else {
            e.target.value = ""; // Champ vide si suppression complète
        }

        // Vérifier si le montant souhaité est valide
        const montantSouhaite = parseInt(value, 10) || 0; // Valeur saisie ou 0 si vide

        const capital = parseFloat(capitalField.value.replace(/\s/g, "")) || 0; // Supprimer les espaces avant conversion
        const TotalEncaissement =
            parseFloat(TotalEncaissementField.value.replace(/\s/g, "")) || 0; // Supprimer les espaces avant conversion
        // const moitieCapital = capital / 2;
        const moitieCapital = TotalEncaissement / 2;
        const moitieCapitalFormate = moitieCapital.toLocaleString("fr-FR");

        // Réinitialiser les messages d'erreur et de succès
        msgError.text("").hide();
        msgSuccess.text("").hide();
        countError.text("").hide();
        countSuccess.text("").hide();

        if (montantSouhaite > moitieCapital || montantSouhaite <= 0) {
            msgError.text(`Selon les termes du contrat, vous ne pouvez pas demander ce montant.`).show();
            // msgError.text(`Selon les termes du contrat, le montant souhaité doit être inférieur ou égal à ${moitieCapitalFormate} FCFA.`).show();
            montantSouhaiteField.classList.add('is-invalid');
            montantSouhaiteField.classList.remove('is-valid');
            // desactiver le bouton
            btnContratSuivant.disabled = true;
        } else if (montantSouhaiteField.value.trim() === "") {
            montantSouhaiteField.classList.remove('is-invalid');
            montantSouhaiteField.classList.remove('is-valid');
            // desactiver le bouton
            btnContratSuivant.disabled = true;
        } else if (montantSouhaite <= moitieCapital && montantSouhaite > 0) {
            msgSuccess.text(`Le montant définitif sera calculé en fonction de la situation du contrat.`).show();
            montantSouhaiteField.classList.remove('is-invalid');
            montantSouhaiteField.classList.add('is-valid');
            // activer le bouton
            btnContratSuivant.disabled = false;
        }
    });

    montantSouhaiteField.addEventListener("blur", function (e) {
        if (e.target.value.trim() !== "") {
            e.target.value = parseInt(e.target.value.replace(/\s/g, ''), 10).toLocaleString('fr-FR');
        }
    });
    AutresInfos.addEventListener('input', function () {
        const charLimit = 400; // Limite en caractères
        // Compter le nombre de mots
        const wordCount = AutresInfos.value.trim().split(/\s+/).filter(word => word.length > 0).length;

        $('#totalMot').text(wordCount + ' mots saisis');

        const AutresInfosValue = AutresInfos.value;
        const charCount = AutresInfosValue.length; // Compter les caractères
        const remainingChars = charLimit - charCount; // Calculer les caractères restants

        // Mettre à jour le compteur des caractères restants
        $('#totalChar').text(remainingChars >= 0 ? remainingChars + ' caractères restants :' : 0 + ' caractères restants :');
        // Réinitialiser les messages
        countSuccess.text('').hide();
        countError.text('').hide();

        if (charCount === 0) {
            // Pas de texte
            AutresInfos.classList.remove('is-valid', 'is-invalid');
        } else if (charCount <= charLimit) {
            // Nombre de caractères valide
            AutresInfos.classList.add('is-valid');
            AutresInfos.classList.remove('is-invalid');
            countSuccess.text(`La zone de saisie contient ${charCount} caractères.`).show();
        } else {
            // Bloquer l'entrée de texte si la limite est atteinte
            const truncatedText = AutresInfosValue.substring(0, charLimit); // Tronquer le texte à la limite
            AutresInfos.value = truncatedText;
            AutresInfos.classList.add('is-invalid');
            AutresInfos.classList.remove('is-valid');
            countError.text(`Nombre de caractères maximum atteint (${charLimit}). La saisie est bloquée.`).show();
        }
    });

    nextButtons.forEach(button => {
        button.addEventListener('click', async function () {
            const currentContainer = this.closest('.etape, .etapePrest'); // Étape actuelle
            const nextStep = document.querySelector(`#${this.dataset.next}`); // Étape suivante

            // Vérification des champs de téléphone si présents dans l'étape actuelle
            if (currentContainer.contains(telPaiementField)) {
                if (!validateTelFields()) {
                    alert("Veuillez vérifier que les numéros de téléphone sont conformes.");
                    return; // Arrêter si les champs de téléphone ne sont pas valides
                }
            }

            // Vérification des champs de IBAN si présents dans l'étape actuelle
            if (currentContainer.contains(ibanPaiementField)) {
                const ibanValue = ibanPaiementField.value.trim();
                if (!validateIbanFields()) {
                    alert("Veuillez vérifier que les IBAN sont conformes.");
                    return; // Arrêter si les champs de IBAN ne sont pas valides
                }
            }

            // Vérification du montant souhaité par rapport au capital
            const montantSouhaite = parseFloat(montantSouhaiteField.value) || 0;
            const capital = parseFloat(capitalField.value) || 0;
            const TotalEncaissement = parseFloat(TotalEncaissementField.value.replace(/\s/g, "")) || 0; // Supprimer les espaces avant conversion
            const moitieCapital = TotalEncaissement / 2;
            const moitieCapitalFormate = moitieCapital.toLocaleString('fr-FR');

            if (montantSouhaite > moitieCapital || montantSouhaite <= 0) {
                alert(`Selon les termes du contrat, vous ne pouvez pas demander ce montant.`);
                // alert(`Selon les termes du contrat, le montant souhaité doit être supérieur à 0 et inferieur ou égal à ${moitieCapitalFormate} FCFA.`);
                msgError.text(`Selon les termes du contrat, vous ne pouvez pas demander ce montant.`).show();
                // ajouter une bordure rouge si le montant souhaité est invalide
                montantSouhaiteField.classList.add('is-invalid');
                montantSouhaiteField.classList.remove('is-valid');
                return; // Arrêter si le montant souhaité n'est pas valide
            }

            // Vérification et envoi de l'OTP
            if (currentContainer.contains(telPaiementField) && !telPaiementSection.classList.contains('d-none')) {
                const phoneNumber = telPaiementField.value.trim();
                // si tous les champs required ne sont pas renseignés bloqué l'envoi de l'OTP
                if (!validateStep(currentContainer)) {
                    return;
                } else {
                    const otpSent = await sendOtp(phoneNumber);

                    if (!otpSent) {
                        return; // Arrêter si l'OTP n'a pas pu être envoyé
                    }
                };

            } else {
                const phoneNumber = telOtpField.value.trim();
                console.log('phoneNumber = ', phoneNumber);
                // si tous les champs required ne sont pas renseignés bloqué l'envoi de l'OTP
                if (!validateStep(currentContainer)) {
                    return;
                } else {
                    const otpSent = await sendOtp(phoneNumber);

                    if (!otpSent) {
                        return; // Arrêter si l'OTP n'a pas pu être envoyé
                    }
                };
            }

            // Vérification de validation des champs pour l'étape actuelle
            if (validateStep(currentContainer)) {
                // Attendre 1 seconde avant de passer à l'étape suivante si tout est valide
                setTimeout(() => {
                    currentContainer.classList.add('d-none'); // Cacher l'étape actuelle
                    nextStep.classList.remove('d-none'); // Afficher l'étape suivante
                }, 1000); // 1 seconde
            }
        });
    });

    // Gestionnaire pour les boutons "Prev"
    prevButtons.forEach(button => {
        button.addEventListener('click', function () {
            const currentContainer = this.closest('.etape, .etapePrest'); // Étape actuelle
            const prevStep = document.querySelector(`#${this.dataset.prev}`); // Étape précédente

            currentContainer.classList.add('d-none');
            prevStep.classList.remove('d-none');
        });
    });
    // Intégration de la gestion du changement pour récupérer les détails du contrat

    $(document).ready(function () {
        // Déclencher l'événement "change" sur le champ de sélection pour le premier contrat
        $('#single-select-field').trigger('change');
    });
    $(document).on('change', '#single-select-field', function () {
        const idcontrat = $(this).val(); // Récupérer l'ID du contrat sélectionné
        const spinner = document.getElementById('spinner'); // Spinner pour l'indicateur de chargement
        const DetailContratBtn = document.getElementById('DetailContratBtn'); // Spinner pour l'indicateur de chargement
        // $("#detailContratModalLabel").text('Selectionnez un contrat pour voir ses details');
        // Désactiver le champ et afficher le spinner
        montantSouhaiteField.disabled = true;
        spinner.style.display = 'block';
        DetailContratBtn.style.display = 'none';
        if (idcontrat) {
            $.ajax({
                url: '/api/fetch-contract-details', // Route Laravel
                type: 'POST',
                data: {
                    idcontrat: idcontrat,
                    _token: '{{ csrf_token() }}' // Le token CSRF pour sécuriser la requête
                },
                dataType: 'json', // Assurez-vous que la réponse attendue est en JSON
                success: function (response) {
                    if (response.status === 'success') {
                        const details = response.data.details;
                        // console.log(response.data);
                        if (details && details.length > 0) {
                            // console.log(details);
                            const CapitalSouscrit = parseInt(details[0].CapitalSouscrit);
                            var Prime = parseInt(details[0].TotalPrime);
                            const CapitalFormate = CapitalSouscrit.toLocaleString('fr-FR');
                            // var DureeCotisationAns = parseInt(details[0].DureeCotisationAns);
                            $("#Capital").val(CapitalSouscrit);
                            // $("#CapitalTotal").text('Capital souscrit : ' + CapitalFormate + ' FCFA');
                            $("#Produit").text(
                                "Produit : " + details[0].produit
                            );
                            $("#adher").text(details[0].nomSous + ' ' + details[0].PrenomSous);
                            $("#idProp").text(details[0].IdProposition);
                            $("#CodeProp").text(details[0].CodeProposition);
                            $("#Codeprop").text(details[0].CodepropositionForm);
                            $("#CodeCons").text(details[0].CodeConseiller + ' - ' + details[0].NomAgent);
                            $("#produitSous").text(details[0].produit);
                            $("#Prime").text(Prime + ' FCFA');
                            $("#DateEffet").text(details[0].DateEffetReel);
                            $("#DateFinAdhesion").text(details[0].FinAdhesion);

                            $("#detailContratModalLabel").text('Information sur le contrat ' + details[0].IdProposition);

                            DetailContratBtn.style.display = 'block';
                        } else {
                            console.error('Aucun détail trouvé pour ce contrat.');
                        }
                    } else {
                        alert('Erreur : ' + response.message);
                    }
                },
                error: function (xhr) {
                    console.error(xhr.responseText);
                    alert('Erreur lors de la récupération des informations du contrat.');
                },
                complete: function () {
                    // Masquer le spinner et activer le champ après la récupération des données
                    spinner.style.display = 'none';
                    montantSouhaiteField.disabled = false;
                    DetailContratBtn.style.display = 'block';
                }
            });
        } else {
            // Si aucun contrat sélectionné, masquer le spinner et désactiver le champ
            spinner.style.display = 'none';
            montantSouhaiteField.disabled = true;
            DetailContratBtn.style.display = 'none';

        }
    });

});

document.addEventListener('DOMContentLoaded', function () {
    const steps = document.querySelectorAll('.etapeEdit, .etapeEditPrest'); // Sélectionner toutes les étapes
    const nextButtons = document.querySelectorAll('.next-btn'); // Boutons "Next"
    const prevButtons = document.querySelectorAll('.prev-btn'); // Boutons "Prev"
    const telPaiementField = document.getElementById('TelPaiement');
    const ibanPaiementField = document.getElementById('IBAN');
    let ibanField = document.querySelectorAll('.rib-input');
    const confirmTelPaiementField = document.getElementById('ConfirmTelPaiement');
    const otpContainer = document.getElementById('OTP-edit');
    const resendOtpLink = document.querySelector('.resend-otp-link-edit');
    const otpInputs = document.querySelectorAll('.otp-input');
    const otpTimer = document.createElement('div'); // Timer pour afficher le compte à rebours
    const montantSouhaite = document.getElementById('montantSouhaite');
    const ibanPaiementSection = document.getElementById('IBANPaiement');
    const telPaiementSection = document.getElementById('TelephonePaiement')

    const operateurInputs = document.querySelectorAll('input[name="Operateur"]');
    const telOtpField = document.getElementById('TelOtp');


    // Fonction pour valider les champs obligatoires dans une étape donnée
    function validateStep(step) {
        let isValid = true;
        const allFields = step.querySelectorAll('input, textarea, select'); // Tous les champs de l'étape

        allFields.forEach(field => {
            if (field.required && !field.value.trim()) {
                isValid = false;
                field.classList.add('is-invalid'); // Ajouter une classe pour indiquer une erreur
                field.classList.remove('is-valid'); // Retirer la classe valide
            } else {
                field.classList.remove('is-invalid'); // Retirer la classe d'erreur
                field.classList.add('is-valid'); // Ajouter une classe pour indiquer la validité
            }
        });

        return isValid;
    }

    // Fonction pour valider les champs de téléphone

    function validateIbanFields() {

        const ibanPaiementSection = document.getElementById('IBANPaiement');


        const ibanValue = ibanPaiementField.value.trim();

        let isValid = true;

        // Vérifier si la section n'est pas masquée
        if (!ibanPaiementSection.classList.contains('d-none')) {
            // Réinitialiser les classes d'erreur
            ibanField.forEach(input => {
                input.classList.remove('is-invalid');
            });

            // Vérification : Les champs ne doivent pas être vides
            if (ibanValue.length == 0) {
                isValid = false;
                ibanField.forEach(input => {
                    input.classList.add('is-invalid');
                    input.classList.remove('is-valid');
                });
                alert("Veuillez saisir Obligatoirement un RIB.");
            }

            // Vérification : Les valeurs doivent correspondre
            else if (ibanValue.length !== 24) {
                isValid = false;
                ibanField.forEach(input => {
                    if (input.value.length == 0 || input.value == null || input.value == undefined || input.value == " ") {
                        input.classList.add('is-invalid');
                        input.classList.remove('is-valid');
                    } else {
                        input.classList.remove('is-invalid');
                        input.classList.add('is-valid');
                    }
                });
                alert("Le RIB doit contenir exactement 24 chiffres. Veuillez saisir tous les champs.");
            }

            // Si tout est valide, retirer les classes d'erreur
            if (isValid) {
                ibanField.forEach(input => {
                    input.classList.remove('is-invalid');
                    input.classList.add('is-valid');
                });
            }
        }

        return isValid;
    }

    function validateTelFields() {
        const telValue = telPaiementField.value.trim();
        const confirmTelValue = confirmTelPaiementField.value.trim();
        const telPaiementSection = document.getElementById('TelephonePaiement');

        let isValid = true;

        // Vérifier si la section n'est pas masquée
        if (!telPaiementSection.classList.contains('d-none')) {
            // Vérifier si les champs ne sont pas vides
            if (!telValue || !confirmTelValue) {
                isValid = false;
                telPaiementField.classList.add('is-invalid');
                confirmTelPaiementField.classList.add('is-invalid');
            }
            // Vérifier si les valeurs correspondent
            else if (telValue !== confirmTelValue) {
                isValid = false;
                telPaiementField.classList.add('is-invalid');
                confirmTelPaiementField.classList.add('is-invalid');
            } else {
                // Tout est valide, retirer les classes d'erreur
                telPaiementField.classList.remove('is-invalid');
                confirmTelPaiementField.classList.remove('is-invalid');
            }

            // Vérifier le format du numéro (exemple : 10 chiffres)
            const phoneRegex = /^[0-9]{10}$/; // Modifier selon le format attendu
            if (!phoneRegex.test(telValue)) {
                isValid = false;
                telPaiementField.classList.add('is-invalid');
            } else {
                telPaiementField.classList.remove('is-invalid');
            }
        }
        return isValid;
    }

    // Fonction pour soumettre l'OTP
    async function sendOtp(phone) {
        let phoneNumber = '225' + phone;
        let firstTwoDigits = phone.substring(0, 2); // Extraire les deux premiers chiffres de phone

        if (firstTwoDigits == '07' || firstTwoDigits == '05') {
            try {
                const response = await fetch('/api/send-otpByOrangeAPI', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                    },
                    body: JSON.stringify({
                        TelPaiement: phoneNumber
                    }),
                });

                const result = await response.json();

                if (response.ok) {
                    alert(`Un message contenant un code de confirmation a été envoyé sur le numéro ${phoneNumber}.`);
                    startOtpTimer(); // Démarrer le décompte après l'envoi de l'OTP
                    return true;
                } else {
                    alert("Une erreur s'est produite lors de l'envoi du code de confirmation.");
                    // alert(result.error || "Une erreur s'est produite lors de l'envoi du code de confirmation.");
                    return false;
                }
            } catch (error) {
                alert("Une erreur s'est produite lors de l'envoi du code de confirmation.");
                console.error(error);
                return false;
            }
        } else if (firstTwoDigits == '01') {
            try {
                const response = await fetch('/api/send-otpByInfobipAPI', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                    },
                    body: JSON.stringify({
                        TelPaiement: phoneNumber
                    }),
                });

                const result = await response.json();

                if (response.ok) {
                    alert(`Un message contenant un code de confirmation a été envoyé sur le numéro ${phoneNumber}.`);
                    startOtpTimer(); // Démarrer le décompte après l'envoi de l'OTP
                    return true;
                } else {
                    alert(result.error || "Une erreur s'est produite lors de l'envoi du code de confirmation.");
                    return false;
                }
            } catch (error) {
                alert("Une erreur s'est produite lors de l'envoi du code de confirmation.");
                console.error(error);
                return false;
            }
        }
    }

    // Fonction pour démarrer le compte à rebours pour l'expiration de l'OTP
    let otpExpirationTime = 3 * 60; // 5 minutes en secondes
    let otpInterval;

    function startOtpTimer() {
        otpTimer.classList.add('otp-timer-edit');
        otpContainer.appendChild(otpTimer); // Ajouter le timer à l'interface
        updateOtpTimer();

        otpInterval = setInterval(() => {
            otpExpirationTime--;
            updateOtpTimer();

            if (otpExpirationTime <= 0) {
                clearInterval(otpInterval);
                otpTimer.textContent = "Le code de confirmation a expiré.";
                resendOtpLink.classList.remove('d-none'); // Afficher le lien pour renvoyer l'OTP
            }
        }, 1000); // Met à jour chaque seconde
    }

    function updateOtpTimer() {
        const minutes = Math.floor(otpExpirationTime / 60);
        const seconds = otpExpirationTime % 60;
        otpTimer.textContent = `Temps restant: ${minutes}:${seconds < 10 ? '0' : ''}${seconds}`;
    }

    // Fonction pour renvoyer l'OTP
    resendOtpLink.addEventListener('click', async function () {
        otpExpirationTime = 3 * 60; // Réinitialiser le temps d'expiration
        clearInterval(otpInterval); // Arrêter l'ancien intervalle
        resendOtpLink.classList.add('d-none'); // Cacher le lien pendant l'envoi de l'OTP
        let phoneNumber = null;
        if (telPaiementField.value != null && telPaiementField.value != '') {
            phoneNumber = telPaiementField.value.trim();
        } else {
            phoneNumber = telOtpField.value.trim();
        }
        const otpSent = await sendOtp(phoneNumber);

        if (!otpSent) {
            return; // Arrêter si l'OTP n'a pas pu être envoyé
        }
        // else{
        //     startOtpTimer();
        //     alert(`Un message contenant un code de confirmation a été envoyé sur le numéro ${phoneNumber}.`);
        // }
    });

    const montantSouhaiteField = document.getElementById('montantSouhaite');
    const AutresInfos = document.getElementById('AutresInfos');
    const capitalField = document.getElementById('Capital');
    const TotalEncaissementField = document.getElementById("TotalEncaissement");
    const msgError = $('#msgerror');
    const msgSuccess = $('#msgesucces');
    const ibanMsgError = $('#ibanMsgError');
    const ibanMsgSuccess = $('#ibanMsgSuccess');
    const ibanConfirmMsgError = $('#ibanConfirmMsgError');
    const ibanConfirmMsgSuccess = $('#ibanConfirmMsgSuccess');
    const telMsgError = $('#telMsgError');
    const telMsgSuccess = $('#telMsgSuccess');
    const telConfirmMsgError = $('#telConfirmMsgError');
    const telConfirmMsgSuccess = $('#telConfirmMsgSuccess');
    const countError = $('#counterror');
    const countSuccess = $('#countesucces');
    const btnIbanPaiementSuivant = document.getElementById('btnIbanPaiementSuivant');
    const btnTelPaiementSuivant = document.getElementById('btnTelPaiementSuivant');
    const btnContratSuivant = document.getElementById('btnContratVersMDP');
    // const btnContratSuivant = document.getElementById('btnContratSuivant');

    btnContratSuivant.disabled = true;

    // Vérification des champs de IBAN si présents dans l'étape actuelle
    if (!ibanPaiementSection.classList.contains('d-none')) {
        // Réinitialisation des messages
        ibanMsgError.text("").hide();
        ibanMsgSuccess.text("").hide();
        btnIbanPaiementSuivant.disabled = true;

        // Fonction pour mettre à jour le champ IBAN
        function updateIBAN() {
            let ibanValue = "";
            ibanField.forEach(input => {
                ibanValue += input.value;
                if (input.value.length == 0 || input.value == null || input.value == undefined || input.value == " ") {
                    input.classList.add('is-invalid');
                    input.classList.remove('is-valid');
                } else {
                    input.classList.remove('is-invalid');
                    input.classList.add('is-valid');
                }
                ibanValue = ibanValue.replace(/[^a-zA-Z0-9]/g, '');
                if (ibanValue.length < 24 || ibanValue.length > 24) {
                    // ibanPaiementField.classList.add('is-invalid');
                    // ibanPaiementField.classList.remove('is-valid');
                    ibanMsgSuccess.text("").hide();
                    ibanMsgError.text("Le RIB doit contenir exactement 24 caractères. Veuillez saisir tous les champs.").show();
                    btnIbanPaiementSuivant.disabled = true;
                } else {
                    // ibanPaiementField.classList.remove('is-invalid');
                    // ibanPaiementField.classList.add('is-valid');
                    ibanMsgSuccess.text("Vous pouvez passer au suivant").show();
                    ibanMsgError.text("").hide();
                    btnIbanPaiementSuivant.disabled = false;
                }
            });
            ibanPaiementField.value = ibanValue;
        }

        // Écoute les changements dans chaque champ d'entrée
        ibanField.forEach(input => {
            input.addEventListener("input", updateIBAN);
        });

    }

    if (!telPaiementSection.classList.contains('d-none')) {
        btnTelPaiementSuivant.disabled = true;
        let selectedOperateur = ""; // Variable pour stocker l'opérateur sélectionné

        // Ajouter un écouteur pour chaque input radio
        operateurInputs.forEach(input => {
            input.addEventListener('change', function () {
                let prefix = "";
                selectedOperateur = this.value; // Mettre à jour l'opérateur sélectionné
                switch (this.value) {
                    case "Orange_money":
                        prefix = "07";
                        break;
                    case "MTN_money":
                        prefix = "05";
                        break;
                    case "Moov_money":
                        prefix = "01";
                        break;
                }
                telPaiementField.addEventListener('input', function (e) {
                    const telValue = e.target.value.trim();
                    let firstTwoDigits = telValue.substring(0, 2); // Extraire les deux premiers chiffres de phone
                    // Réinitialisation des messages
                    telMsgError.text("").hide();
                    telMsgSuccess.text("").hide();

                    if (telValue.length != 10 || firstTwoDigits !== prefix) {
                        telPaiementField.classList.add('is-invalid');
                        telPaiementField.classList.remove('is-valid');
                        telMsgError.text("Le numéro de téléphone doit avoir 10 caractères et doit commencer par " + prefix + ".").show();
                        btnTelPaiementSuivant.disabled = true;
                    } else {
                        telPaiementField.classList.remove('is-invalid');
                        telPaiementField.classList.add('is-valid');
                        telMsgSuccess.text("Le numéro de téléphone est valide.").show();
                        // btnTelPaiementSuivant.disabled = false;
                    }
                });

                confirmTelPaiementField.addEventListener('input', function (e) {
                    const confirmTel = e.target.value.trim();
                    const telValue = telPaiementField.value.trim();
                    telConfirmMsgError.text("").hide();
                    telConfirmMsgSuccess.text("").hide();

                    if (confirmTel !== telValue || confirmTel.length !== 10) {
                        confirmTelPaiementField.classList.add('is-invalid');
                        confirmTelPaiementField.classList.remove('is-valid');
                        telConfirmMsgError.text("Le numéro de téléphone de confirmation est ne correspond pas.").show();
                        btnTelPaiementSuivant.disabled = true;
                    } else {
                        confirmTelPaiementField.classList.remove('is-invalid');
                        confirmTelPaiementField.classList.add('is-valid');
                        telConfirmMsgSuccess.text("Le numéro de téléphone de confirmation est correct.").show();
                        btnTelPaiementSuivant.disabled = false;
                    }
                });

            });
        });
    }

    if (montantSouhaiteField.value.trim() !== "") {
        // activer le bouton
        btnContratSuivant.disabled = false;
    }

    AutresInfos.addEventListener('input', function () {
        const charLimit = 400; // Limite en caractères
        // Compter le nombre de mots
        const wordCount = AutresInfos.value.trim().split(/\s+/).filter(word => word.length > 0).length;

        $('#totalMot').text(wordCount + ' mots saisis');

        const AutresInfosValue = AutresInfos.value;
        const charCount = AutresInfosValue.length; // Compter les caractères
        const remainingChars = charLimit - charCount; // Calculer les caractères restants

        // Mettre à jour le compteur des caractères restants
        $('#totalChar').text(remainingChars >= 0 ? remainingChars + ' caractères restants :' : 0 + ' caractères restants :');
        // Réinitialiser les messages
        countSuccess.text('').hide();
        countError.text('').hide();

        if (charCount === 0) {
            // Pas de texte
            AutresInfos.classList.remove('is-valid', 'is-invalid');
        } else if (charCount <= charLimit) {
            // Nombre de caractères valide
            AutresInfos.classList.add('is-valid');
            AutresInfos.classList.remove('is-invalid');
            countSuccess.text(`La zone de saisie contient ${charCount} caractères.`).show();
        } else {
            // Bloquer l'entrée de texte si la limite est atteinte
            const truncatedText = AutresInfosValue.substring(0, charLimit); // Tronquer le texte à la limite
            AutresInfos.value = truncatedText;
            AutresInfos.classList.add('is-invalid');
            AutresInfos.classList.remove('is-valid');
            countError.text(`Nombre de caractères maximum atteint (${charLimit}). La saisie est bloquée.`).show();
        }
    });

    nextButtons.forEach(button => {
        button.addEventListener('click', async function () {
            const currentContainer = this.closest('.etapeEdit, .etapeEditPrest'); // Étape actuelle
            const nextStep = document.querySelector(`#${this.dataset.next}`); // Étape suivante

            // Vérification des champs de téléphone si présents dans l'étape actuelle
            if (currentContainer.contains(telPaiementField)) {
                if (!validateTelFields()) {
                    alert("Veuillez vérifier que les numéros de téléphone sont conformes.");
                    return; // Arrêter si les champs de téléphone ne sont pas valides
                }
            }

            // Vérification des champs de IBAN si présents dans l'étape actuelle
            if (currentContainer.contains(ibanPaiementField)) {
                const ibanValue = ibanPaiementField.value.trim();
                if (!validateIbanFields()) {
                    alert("Veuillez vérifier que les IBAN sont conformes.");
                    return; // Arrêter si les champs de IBAN ne sont pas valides
                }
            }


            // Vérification et envoi de l'OTP
            if (currentContainer.contains(telPaiementField) && !telPaiementSection.classList.contains('d-none')) {
                const phoneNumber = telPaiementField.value.trim();
                // si tous les champs required ne sont pas renseignés bloqué l'envoi de l'OTP
                if (!validateStep(currentContainer)) {
                    return;
                } else {
                    const otpSent = await sendOtp(phoneNumber);

                    if (!otpSent) {
                        return; // Arrêter si l'OTP n'a pas pu être envoyé
                    }
                };

            } else {
                const phoneNumber = telOtpField.value.trim();
                console.log('phoneNumber = ', phoneNumber);
                // si tous les champs required ne sont pas renseignés bloqué l'envoi de l'OTP
                if (!validateStep(currentContainer)) {
                    return;
                } else {
                    const otpSent = await sendOtp(phoneNumber);

                    if (!otpSent) {
                        return; // Arrêter si l'OTP n'a pas pu être envoyé
                    }
                };
            }

            // Vérification de validation des champs pour l'étape actuelle
            if (validateStep(currentContainer)) {
                // Attendre 1 seconde avant de passer à l'étape suivante si tout est valide
                setTimeout(() => {
                    currentContainer.classList.add('d-none'); // Cacher l'étape actuelle
                    nextStep.classList.remove('d-none'); // Afficher l'étape suivante
                }, 1000); // 1 seconde
            }
        });
    });

    // Gestionnaire pour les boutons "Prev"
    prevButtons.forEach(button => {
        button.addEventListener('click', function () {
            const currentContainer = this.closest('.etapeEdit, .etapeEditPrest'); // Étape actuelle
            const prevStep = document.querySelector(`#${this.dataset.prev}`); // Étape précédente

            currentContainer.classList.add('d-none');
            prevStep.classList.remove('d-none');
        });
    });
    // Intégration de la gestion du changement pour récupérer les détails du contrat

    $(document).ready(function () {
        // Déclencher l'événement "change" sur le champ de sélection pour le premier contrat
        $('#single-select-field').trigger('change');
    });
    $(document).on('change', '#single-select-field', function () {
        const idcontrat = $(this).val(); // Récupérer l'ID du contrat sélectionné
        const spinner = document.getElementById('spinner'); // Spinner pour l'indicateur de chargement
        const DetailContratBtn = document.getElementById('DetailContratBtn'); // Spinner pour l'indicateur de chargement
        // $("#detailContratModalLabel").text('Selectionnez un contrat pour voir ses details');
        // Désactiver le champ et afficher le spinner
        montantSouhaiteField.disabled = true;
        spinner.style.display = 'block';
        DetailContratBtn.style.display = 'none';
        if (idcontrat) {
            $.ajax({
                url: '/api/fetch-contract-details', // Route Laravel
                type: 'POST',
                data: {
                    idcontrat: idcontrat,
                    _token: '{{ csrf_token() }}' // Le token CSRF pour sécuriser la requête
                },
                dataType: 'json', // Assurez-vous que la réponse attendue est en JSON
                success: function (response) {
                    if (response.status === 'success') {
                        const details = response.data.details;
                        // console.log(response.data);
                        if (details && details.length > 0) {
                            // console.log(details);
                            const CapitalSouscrit = parseInt(details[0].CapitalSouscrit);
                            var Prime = parseInt(details[0].TotalPrime);
                            const CapitalFormate = CapitalSouscrit.toLocaleString('fr-FR');
                            // var DureeCotisationAns = parseInt(details[0].DureeCotisationAns);
                            $("#Capital").val(CapitalSouscrit);
                            // $("#CapitalTotal").text('Capital souscrit : ' + CapitalFormate + ' FCFA');
                            $("#Produit").text(
                                "Produit : " + details[0].produit
                            );
                            $("#adher").text(details[0].nomSous + ' ' + details[0].PrenomSous);
                            $("#idProp").text(details[0].IdProposition);
                            $("#CodeProp").text(details[0].CodeProposition);
                            $("#Codeprop").text(details[0].CodepropositionForm);
                            $("#CodeCons").text(details[0].CodeConseiller + ' - ' + details[0].NomAgent);
                            $("#produitSous").text(details[0].produit);
                            $("#Prime").text(Prime + ' FCFA');
                            $("#DateEffet").text(details[0].DateEffetReel);
                            $("#DateFinAdhesion").text(details[0].FinAdhesion);

                            $("#detailContratModalLabel").text('Information sur le contrat ' + details[0].IdProposition);

                            DetailContratBtn.style.display = 'block';
                        } else {
                            console.error('Aucun détail trouvé pour ce contrat.');
                        }
                    } else {
                        alert('Erreur : ' + response.message);
                    }
                },
                error: function (xhr) {
                    console.error(xhr.responseText);
                    alert('Erreur lors de la récupération des informations du contrat.');
                },
                complete: function () {
                    // Masquer le spinner et activer le champ après la récupération des données
                    spinner.style.display = 'none';
                    montantSouhaiteField.disabled = false;
                    DetailContratBtn.style.display = 'block';
                }
            });
        } else {
            // Si aucun contrat sélectionné, masquer le spinner et désactiver le champ
            spinner.style.display = 'none';
            montantSouhaiteField.disabled = true;
            DetailContratBtn.style.display = 'none';

        }
    });

});


document.addEventListener('DOMContentLoaded', function () {
    // const selectLieuRDV = document.getElementById('single-select-optgroup-field');
    const selectLieuRDV = document.getElementById('idTblBureau');
    const inputDateRDV = document.getElementById('daterdv');
    const selectOptionsRdv = document.getElementById('optionsRdv');
    const spinner = document.getElementById('spinner');
    const spinnerDaterdv = document.getElementById('spinnerDaterdv');

    inputDateRDV.disabled = true;

    $(document).ready(function () {
        var availableOptions = []; // Un tableau pour stocker les options de RDV disponibles
        var availableOptions = []; // Tableau pour stocker les options de RDV disponibles

        $('#idTblBureau').on('change', function () {
            var id = $(this).val();
            if (spinner) {
                spinner.style.display = 'block';
            }
            $.ajax({
                type: 'GET',
                url: '/espace-client/rdv/optionDate/' + id,
                dataType: 'json',
                success: function (data) {
                    if (data.status === 'success' && data.data.length > 0) {
                        var jmax = '';
                        var lieu = '';
                        var jours = [];
                        availableOptions = []; // Réinitialiser les options disponibles
                        // Boucle à travers les données reçues
                        $.each(data.data, function (index, villeReseau) {
                            lieu = villeReseau.libelleVilleBureau || 'Lieu inconnu'; // Récupérer le nom du lieu
                            $.each(villeReseau.option_rdv, function (index, optionRdv) {
                                // Sauvegarder les options dans un tableau
                                availableOptions.push({
                                    codejour: optionRdv.codejour,
                                    codelieu: optionRdv.codelieu,
                                    nbmax: optionRdv.nbmax
                                });

                                // Générer les options pour l'élément #optionsRdv
                                jmax += '<option value="' + optionRdv.nbmax + '">' + optionRdv.jour + '</option>';
                                jours.push(optionRdv.jour); // Ajouter le jour à la liste des jours disponibles
                            });
                        });

                        // Mettre à jour les champs HTML
                        $('#optionsRdv').html(jmax); // Liste des options
                        $('#lieurdv').text(lieu); // Nom du lieu
                        $('#jourRdv').text(jours.join(' - ')); // Liste des jours disponibles
                        inputDateRDV.disabled = false;
                        inputDateRDV.value = "";
                        $('#msgerror').text(''); // Ne pas afficher le message d'erreur
                        $('#msgesucces').text(''); // Ne pas afficher le message de succès
                        if (spinner) {
                            spinner.style.display = 'none';
                        }
                    } else {
                        alert('Aucune information disponible pour ce lieu de RDV.');
                        $('#lieurdv').text(''); // Réinitialiser le lieu
                        $('#jourRdv').text(''); // Réinitialiser les jours
                        if (spinner) {
                            spinner.style.display = 'none';
                        }
                    }
                },
                error: function (xhr, status, error) {
                    console.error('Erreur AJAX : ', xhr.responseText);
                    alert('Une erreur est survenue lors de la récupération des données.');
                    $('#lieurdv').text(''); // Réinitialiser le lieu
                    $('#jourRdv').text(''); // Réinitialiser les jours
                    if (spinner) {
                        spinner.style.display = 'none';
                    }
                }
            });
        });

        $('#daterdv').on('change', function () {
            var idTblBureau = $('#idTblBureau').val();
            var daterdv = $(this).val(); // Exemple : 10/12/2024
            // Réinitialiser les messages à chaque changement
            $('#msgerror').text('').hide(); // Masquer le message d'erreur
            $('#msgesucces').text('').hide(); // Masquer le message de succès
            if (spinnerDaterdv) {
                spinnerDaterdv.style.display = 'block';
            }

            if (daterdv) {
                // Conversion de la date au format JavaScript
                var parts = daterdv.split('-'); // Supposons que le format est d/m/Y
                var dateObj = new Date(parts[2], parts[1] - 1, parts[0]); // Année, mois (0-indexé), jour

                // Vérification si la date est un samedi (6) ou un dimanche (0)
                var day = dateObj.getDay();
                if (day === 0 || day === 6) {
                    alert("Les rendez-vous ne peuvent pas être pris le week-end ou les jours fériés. Veuillez sélectionner un jour en semaine.");
                    $('input[name="daterdv"]').val('');
                    $('#msgerror').text("Les rendez-vous ne peuvent pas être pris le week-end ou les jours fériés. Veuillez sélectionner un jour en semaine.").show();
                    return; // Arrête l'exécution
                }
            }

            if (idTblBureau && daterdv) {
                // Filtrage des options disponibles pour la date sélectionnée
                var availableForDate = availableOptions.filter(function (option) {
                    return option.codelieu == idTblBureau && parseInt(option.codejour) === dateObj.getDay();
                });

                if (availableForDate.length > 0) {
                    // Si des options sont disponibles pour la date et le lieu
                    $.each(availableForDate, function (index, option) {
                        var Nbmax = parseInt(option.nbmax);

                        // Vérification de la disponibilité des places
                        $.ajax({
                            type: 'GET',
                            url: '/espace-client/rdv/getRdv',
                            data: {
                                idTblBureau: idTblBureau,
                                daterdv: daterdv
                            },
                            dataType: 'json',
                            success: function (data) {
                                if (data.status === 'success') {
                                    var orderInsert = parseInt(data.data.orderInsert);
                                    if (orderInsert >= Nbmax) {
                                        alert("Plus de places disponibles à cette date.");
                                        $('input[name="daterdv"]').val('');
                                        $('#msgerror').text("Plus de places disponibles à cette date.").show();
                                        return;
                                    } else {
                                        var remainingSlots = Nbmax - orderInsert;
                                        $('#msgesucces').text('Il reste ' + remainingSlots + ' place(s) à cette date.').show();
                                    }
                                } else {
                                    $('#msgesucces').text('Il reste ' + Nbmax + ' place(s) à cette date.').show();
                                }
                                if (spinnerDaterdv) {
                                    spinnerDaterdv.style.display = 'none';
                                }
                            },
                            error: function (xhr, status, error) {
                                console.error('Erreur AJAX : ', xhr.responseText);
                                alert("Erreur lors de la vérification de la disponibilité.");
                                $('input[name="daterdv"]').val('');
                                if (spinnerDaterdv) {
                                    spinnerDaterdv.style.display = 'none';
                                }
                            }
                        });
                    });
                } else {
                    alert("Cette date n'est pas disponible pour ce lieu de RDV. Veuillez choisir une autre.");
                    $('input[name="daterdv"]').val('');
                    $('#msgerror').text("Cette date n'est pas disponible pour ce lieu de RDV. Veuillez choisir une autre.").show();
                    if (spinnerDaterdv) {
                        spinnerDaterdv.style.display = 'none';
                    }
                }
            }
        });
    });

});

document.addEventListener('DOMContentLoaded', function () {
    $(document).ready(function () {
        // Déclencher l'événement "change" sur le champ de sélection pour le premier contrat
        $('#idcontrat').trigger('change');
    });

    $(document).on('change', '#idcontrat', function () {
        const idcontrat = $(this).val(); // Récupérer l'ID du contrat sélectionné
        const spinner = document.getElementById('spinner'); // Spinner pour l'indicateur de chargement
        const DemandePrestBtn = document.getElementById('btn-demandePrest'); // Spinner pour l'indicateur de chargement
        spinner.style.display = 'block';
        DemandePrestBtn.style.display = 'none';
        // Vérifier si un contrat est sélectionné
        if (idcontrat) {
            $.ajax({
                url: '/api/fetch-contract-details', // Route Laravel
                type: 'POST',
                data: {
                    idcontrat: idcontrat,
                    _token: '{{ csrf_token() }}' // Le token CSRF pour sécuriser la requête
                },
                dataType: 'json', // Assurez-vous que la réponse attendue est en JSON
                success: function (response) {
                    if (response.status === 'success') {
                        var details = response.data.details;
                        var encaissement = response.data.enc;
                        console.log(response.data);
                        var TotalPrime = parseInt(details[0].TotalPrime);
                        if (details && details.length > 0) {
                            const MonContrat = parseInt(details[0].IdProposition);
                            $("#adherent").text(details[0].nomSous + ' ' + details[0].PrenomSous);
                            $("#idProposition").text(details[0].IdProposition);
                            $("#CodeProposition").text(details[0].CodeProposition);
                            $("#CodepropositionForm").text(details[0].CodepropositionForm);
                            $("#CodeConseiller").text(details[0].CodeConseiller + ' - ' + details[0].NomAgent);
                            $("#produit").text(details[0].produit);
                            $("#totalPrime").text(TotalPrime + ' FCFA');
                            $("#DateEffetReel").text(details[0].DateEffetReel);
                            $("#FinAdhesion").text(details[0].FinAdhesion);
                            $("#MonContrat").val(MonContrat);
                            $("#MonCodeProduit").val(details[0].codeProduit);
                            // Définir le statut
                            if (details[0].OnStdbyOff == 0) {
                                $("#status").text("Inconnu");
                            } else if (details[0].OnStdbyOff == 1) {
                                $("#status").text("En cours");
                            } else if (details[0].OnStdbyOff == 2) {
                                $("#status").text("En veille");
                            } else if (details[0].OnStdbyOff == 3) {
                                $("#status").text("Arrêté");
                            }

                            // D'autres propriétés de details[0]
                            let periodicite = '';
                            if (details[0].periodicite == 'M') {
                                periodicite = '/ Mois';
                            } else if (details[0].periodicite == 'T') {
                                periodicite = '/ Trimestre';
                            } else if (details[0].periodicite == 'S') {
                                periodicite = '/ Semestre';
                            } else if (details[0].periodicite == 'A') {
                                periodicite = '/ Année';
                            }else if (details[0].periodicite == 'U'){
                                periodicite = 'En versement unique';
                            }
                            var CapitalSouscrit = parseInt(details[0].CapitalSouscrit);
                            $("#Capital").val(CapitalSouscrit);
                            $("#CapitalSouscrit").text(CapitalSouscrit + ' FCFA');
                            $("#DureeCotisationAns").text(details[0].DureeCotisationAns + ' ans');
                            $("#TotalPrime").text(TotalPrime + ' FCFA ' + periodicite);
                            $("#NbreEncaissment").text(encaissement.confirmer.length);
                            $("#NbreImpayes").text(encaissement.nonRegle.length);

                        } else {
                            console.error('Aucun détail trouvé pour ce contrat.');
                        }
                    } else {
                        alert('Erreur : ' + response.message);
                    }
                },
                error: function (xhr) {
                    console.error(xhr.responseText);
                    alert('Erreur lors de la récupération des informations du contrat.');
                },
                complete: function () {
                    // Masquer le spinner et activer le champ après la récupération des données
                    spinner.style.display = 'none';
                    DemandePrestBtn.style.display = 'block';
                }
            });
        } else {
            alert('Veuillez sélectionner un contrat.');
            // Si aucun contrat sélectionné, masquer le spinner et désactiver le champ
            spinner.style.display = 'none';
            DemandePrestBtn.style.display = 'none';
        }
    });
});

document.addEventListener('DOMContentLoaded', function () {
    // Bouton pour passer à l'étape suivante
    document.querySelector('.next-step-btn').addEventListener('click', function (event) {
        event.preventDefault(); // Empêche l'action par défaut du bouton

        // Valider tous les champs de l'étape actuelle
        if (validateStep1()) {
            // Si les champs sont valides, attendre 2 secondes avant de passer à l'étape suivante
            setTimeout(() => {
                stepper1.next();
            }, 1000); // 1 seconde
        }
    });

    // Fonction pour valider tous les champs de l'étape
    function validateStep1() {
        const inputs = document.querySelectorAll('.etape input'); // Sélectionner tous les champs dans l'étape actuelle
        let isValid = true;

        inputs.forEach(input => {
            if (input.hasAttribute('required') && !input.value.trim()) {
                // Si le champ est requis et vide, afficher le message d'erreur et la bordure rouge
                input.classList.add('is-invalid');
                input.classList.remove('is-valid');
                isValid = false;
            } else {
                // Si le champ est valide (ou non requis mais rempli), ajouter une bordure verte
                input.classList.remove('is-invalid');
                input.classList.add('is-valid');
            }
        });

        return isValid;
    }
});

document.addEventListener('DOMContentLoaded', function () {
    // Bouton pour passer à l'étape suivante
    document.querySelector('.next-step-btnEdit').addEventListener('click', function (event) {
        event.preventDefault(); // Empêche l'action par défaut du bouton

        // Valider tous les champs de l'étape actuelle
        if (validateStep1()) {
            // Si les champs sont valides, attendre 2 secondes avant de passer à l'étape suivante
            setTimeout(() => {
                stepper1.next();
            }, 1000); // 1 seconde
        }
    });

    // Fonction pour valider tous les champs de l'étape
    function validateStep1() {
        const inputs = document.querySelectorAll('.etapeEdit input'); // Sélectionner tous les champs dans l'étape actuelle
        let isValid = true;

        inputs.forEach(input => {
            if (input.hasAttribute('required') && !input.value.trim()) {
                // Si le champ est requis et vide, afficher le message d'erreur et la bordure rouge
                input.classList.add('is-invalid');
                input.classList.remove('is-valid');
                isValid = false;
            } else {
                // Si le champ est valide (ou non requis mais rempli), ajouter une bordure verte
                input.classList.remove('is-invalid');
                input.classList.add('is-valid');
            }
        });

        return isValid;
    }
});

document.addEventListener('DOMContentLoaded', function () {
    // Sélectionner le lien "Supprimer mon choix"
    const clearChoiceLink = document.getElementById('clearChoise');

    // Boutons à masquer après réinitialisation
    const nextButtons = [
        // document.getElementById('next-stepper3'),
        document.getElementById('nextPhone')
    ];

    // Ajouter un gestionnaire d'événements au clic
    clearChoiceLink.addEventListener('click', function () {
        // Sélectionner tous les boutons radio avec le nom "Operateur"
        const Operateur = document.querySelectorAll('input[name="Operateur"]');
        const moyenPaiement = document.querySelectorAll('input[name="moyenPaiement"]');

        // Parcourir les boutons radio et les désélectionner
        Operateur.forEach(radio => {
            radio.checked = false;
        });
        moyenPaiement.forEach(radio => {
            radio.checked = false;
        });

        // Masquer les boutons concernés
        nextButtons.forEach(button => {
            button.style.display = 'none'; // Masquer le bouton
        });

        // Optionnel : Ajouter un effet visuel ou un message si nécessaire
        // console.log("Choix réinitialisé, boutons masqués.");
    });

    // Afficher les boutons si une option est sélectionnée
    const OperateurInputs = document.querySelectorAll('input[name="Operateur"]');
    OperateurInputs.forEach(input => {
        input.addEventListener('change', function () {
            // Vérifier si un opérateur est sélectionné
            const selected = Array.from(OperateurInputs).some(radio => radio.checked);

            // Afficher ou masquer les boutons en conséquence
            nextButtons.forEach(button => {
                button.style.display = selected ? 'inline-block' : 'none';
            });
        });
    });
});


document.addEventListener('DOMContentLoaded', function () {
    const ibanPaiementField = document.getElementById('IBAN');
    const confirmIbanPaiementField = document.getElementById('ConfirmIBAN');
    // Bouton pour passer à l'étape suivante
    document.querySelector('.next-step-btn1').addEventListener('click', function (event) {
        event.preventDefault(); // Empêche l'action par défaut du bouton
        const currentContainer = this.closest('.etape, .etapePrest'); // Étape actuelle
        // const ibanPaiementField = document.getElementById('IBAN');
        // const ibanPaiementSection = document.getElementById('IBANPaiement');

        // Valider les champs de l'étape actuelle
        // if (validateIBANFields()) {
        //     // Si les champs sont valides, attendre 1 seconde avant de passer à l'étape suivante
        //     setTimeout(() => {
        //         stepper1.next();
        //     }, 1000); // 1 seconde
        // }
        // Vérification des champs de IBAN si présents dans l'étape actuelle
        if (currentContainer.contains(ibanPaiementField)) {
            if (!validateIbanFields()) {
                alert("Veuillez vérifier que les IBAN sont conformes.");
                return; // Arrêter si les champs de IBAN ne sont pas valides
            }
        }

        if (validateFields()) {
            // Si les champs sont valides, attendre 1 seconde avant de passer à l'étape suivante
            setTimeout(() => {
                stepper1.next();
            }, 1000); // 1 seconde
        }
    });

    function validateFields() {
        const inputs = document.querySelectorAll('.etapePrest input,.etapePrest textarea, .etapePrest select'); // Sélectionner tous les champs dans l'étape actuelle
        let isValid = true;

        inputs.forEach(input => {
            if (input.hasAttribute('required') && !input.value.trim()) {
                // Si le champ est requis et vide, afficher le message d'erreur et la bordure rouge
                input.classList.add('is-invalid');
                input.classList.remove('is-valid');
                isValid = false;
            } else {
                // Si le champ est valide (ou non requis mais rempli), ajouter une bordure verte
                input.classList.remove('is-invalid');
                input.classList.add('is-valid');
            }
        });

        return isValid;
    }

    function validateIbanFields() {
        const ibanValue = ibanPaiementField.value.trim();
        const confirmIbanValue = confirmIbanPaiementField.value.trim();
        const ibanPaiementSection = document.getElementById('IBANPaiement');

        let isValid = true;

        // Vérifier si la section n'est pas masquée
        if (!ibanPaiementSection.classList.contains('d-none')) {
            // Vérification : Les champs ne doivent pas être vides
            if (!ibanValue || !confirmIbanValue) {
                isValid = false;
                ibanPaiementField.classList.add('is-invalid');
                confirmIbanPaiementField.classList.add('is-invalid');
                alert("Les champs IBAN ne peuvent pas être vides.");
            }
            // Vérification : Les valeurs doivent correspondre
            else if (ibanValue !== confirmIbanValue) {
                isValid = false;
                ibanPaiementField.classList.add('is-invalid');
                confirmIbanPaiementField.classList.add('is-invalid');
                alert("Les IBAN saisis ne correspondent pas.");
            } else {
                // Tout est valide, retirer les classes d'erreur
                ibanPaiementField.classList.remove('is-invalid');
                confirmIbanPaiementField.classList.remove('is-invalid');
            }
        }

        return isValid;
    }


});


document.addEventListener('DOMContentLoaded', function () {
    // Initialisation du timer
    // let otpTimer = document.getElementById('otp-timer');
    // let timeLeft = 5 * 60; // 5 minutes en secondes
    let otpInputs = document.querySelectorAll('.otp-input');
    // let resendOtpLink = document.querySelector('.resend-otp-link');
    let nextStepBtn = document.querySelector('.next-step-btn2');

    // Écouter les entrées OTP
    otpInputs.forEach((input, index) => {
        input.addEventListener('input', function () {
            if (this.value.length === this.maxLength) {
                // Passer à l'entrée suivante
                if (index < otpInputs.length - 1) {
                    otpInputs[index + 1].focus();
                }
            }
        });
    });

    // Fonction pour envoyer l'OTP au serveur avec la position GPS
    function sendOtpVerification() {
        let otp = Array.from(otpInputs).map(input => input.value).join('');
        let telPaiementField = document.getElementById('TelPaiement');
        let TelOtp = document.getElementById('TelOtp');
        let phone = null;
        if (telPaiementField.value != null && telPaiementField.value != '') {
            phone = telPaiementField.value.trim();
        } else {
            phone = TelOtp.value.trim();
        }
        let phoneNumber = '225' + phone;

        // Récupération de la position GPS
        if (navigator.geolocation) {
            navigator.geolocation.getCurrentPosition(
                (position) => {
                    const latitude = position.coords.latitude;
                    const longitude = position.coords.longitude;

                    fetch('/api/verify-otp', {
                            method: 'POST',
                            headers: {
                                'Content-Type': 'application/json',
                                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                            },
                            body: JSON.stringify({
                                TelPaiement: phoneNumber,
                                otp: otp,
                                latitude: latitude,
                                longitude: longitude
                            })
                        })
                        .then(response => response.json())
                        .then(data => {
                            if (data.message === 'Votre numéro de téléphone a été vérifié avec succès.') {
                                nextStepBtn.disabled = false;
                                otpInputs.forEach(input => {
                                    input.classList.remove('is-invalid');
                                    input.classList.add('is-valid');
                                });
                                alert('Votre numéro de téléphone a été vérifié avec succès.');

                                setTimeout(() => {
                                    stepper1.next();
                                }, 1000);
                            } else {
                                otpInputs.forEach(input => {
                                    input.classList.remove('is-valid');
                                    input.classList.add('is-invalid');
                                    input.value = '';
                                });
                                alert('Le code de vérification est invalide ou a expiré.');
                            }
                        })
                        .catch(error => {
                            console.error('Erreur lors de la vérification de l\'OTP:', error);
                        });
                },
                (error) => {
                    alert('La géolocalisation est requise pour continuer. Veuillez autoriser l\'accès.');
                    console.error('Erreur de géolocalisation:', error);
                }
            );
        } else {
            alert('Votre navigateur ne supporte pas la géolocalisation.');
        }
    }

    // Gestion du clic sur "Suivant" pour vérifier l'OTP
    nextStepBtn.addEventListener('click', function () {
        sendOtpVerification();
    });
});


document.addEventListener('DOMContentLoaded', function () {
    // Initialisation du timer
    // let otpTimer = document.getElementById('otp-timer');
    // let timeLeft = 5 * 60; // 5 minutes en secondes
    let otpInputs = document.querySelectorAll('.otp-input');
    // let resendOtpLink = document.querySelector('.resend-otp-link');
    let nextStepBtn = document.querySelector('.next-step-btnEdit2');

    // Écouter les entrées OTP
    otpInputs.forEach((input, index) => {
        input.addEventListener('input', function () {
            if (this.value.length === this.maxLength) {
                // Passer à l'entrée suivante
                if (index < otpInputs.length - 1) {
                    otpInputs[index + 1].focus();
                }
            }
        });
    });

    // Fonction pour envoyer l'OTP au serveur avec la position GPS
    function sendOtpVerification() {
        let otp = Array.from(otpInputs).map(input => input.value).join('');
        let telPaiementField = document.getElementById('TelPaiement');
        let TelOtp = document.getElementById('TelOtp');
        let phone = null;
        if (telPaiementField.value != null && telPaiementField.value != '') {
            phone = telPaiementField.value.trim();
        } else {
            phone = TelOtp.value.trim();
        }
        let phoneNumber = '225' + phone;

        // Récupération de la position GPS
        if (navigator.geolocation) {
            navigator.geolocation.getCurrentPosition(
                (position) => {
                    const latitude = position.coords.latitude;
                    const longitude = position.coords.longitude;

                    fetch('/api/verify-otp', {
                            method: 'POST',
                            headers: {
                                'Content-Type': 'application/json',
                                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                            },
                            body: JSON.stringify({
                                TelPaiement: phoneNumber,
                                otp: otp,
                                latitude: latitude,
                                longitude: longitude
                            })
                        })
                        .then(response => response.json())
                        .then(data => {
                            if (data.message === 'Votre numéro de téléphone a été vérifié avec succès.') {
                                nextStepBtn.disabled = false;
                                otpInputs.forEach(input => {
                                    input.classList.remove('is-invalid');
                                    input.classList.add('is-valid');
                                });
                                alert('Votre numéro de téléphone a été vérifié avec succès.');

                                setTimeout(() => {
                                    stepper1.next();
                                }, 1000);
                            } else {
                                otpInputs.forEach(input => {
                                    input.classList.remove('is-valid');
                                    input.classList.add('is-invalid');
                                    input.value = '';
                                });
                                alert('Le code de vérification est invalide ou a expiré.');
                            }
                        })
                        .catch(error => {
                            console.error('Erreur lors de la vérification de l\'OTP:', error);
                        });
                },
                (error) => {
                    alert('La géolocalisation est requise pour continuer. Veuillez autoriser l\'accès.');
                    console.error('Erreur de géolocalisation:', error);
                }
            );
        } else {
            alert('Votre navigateur ne supporte pas la géolocalisation.');
        }
    }

    // Gestion du clic sur "Suivant" pour vérifier l'OTP
    nextStepBtn.addEventListener('click', function () {
        sendOtpVerification();
    });
});


document.addEventListener('DOMContentLoaded', function () {
    if (location.protocol === 'https:') {
        navigator.permissions.query({
            name: 'geolocation'
        }).then(function (result) {
            if (result.state === 'denied') {
                alert("Veuillez activer la localisation pour continuer.");
            } else {
                map.locate({
                    setView: true,
                    maxZoom: 16
                });
            }
        });

        function onLocationFound(e) {
            var radius = e.accuracy / 2;

            L.marker(e.latlng).addTo(map)
                .bindPopup("Vous êtes ici, à " + Math.round(radius) + " mètres près.").openPopup();

            L.circle(e.latlng, radius).addTo(map);
        }

        function onLocationError(e) {
            alert("Impossible d'obtenir votre position : " + e.message);
        }

        map.on('locationfound', onLocationFound);
        map.on('locationerror', onLocationError);
    } else {
        console.log("Géolocalisation désactivée : utilisez HTTPS.");
    }
});

// marquage de certain champs comme requis
document.addEventListener('DOMContentLoaded', function () {
    const moyenPaiementInputs = document.querySelectorAll('input[name="moyenPaiement"]');
    const operateurSection = document.getElementById('Operateur');
    const telPaiementSection = document.getElementById('TelephonePaiement');
    const otpSection = document.querySelector('.otp-container');
    const ibanPaiementSection = document.getElementById('IBANPaiement');
    const nextBtn = document.querySelector('#nextPhone'); // Bouton "next" spécifique pour Mobile Money
    const operateurInputs = document.querySelectorAll('input[name="Operateur"]');

    moyenPaiementInputs.forEach(input => {
        input.addEventListener('change', function () {
            if (input.value === "Mobile_Money") {
                // Afficher les sections Mobile Money
                operateurSection.classList.remove('d-none');
                telPaiementSection.classList.remove('d-none');
                // otpSection.parentElement.classList.remove('d-none');
                ibanPaiementSection.classList.add('d-none'); // Cacher IBAN

                // Ajouter les attributs requis
                setRequired(['Operateur', 'TelPaiement', 'ConfirmTelPaiement', 'FicheID-file-uploa']);
                setRequired(['otp_1', 'otp_2', 'otp_3', 'otp_4', 'otp_5', 'otp_6']);
                removeRequired(['IBAN', 'ConfirmIBAN', 'RIB-file-uploa']);

                // Vérifier la sélection d'un opérateur
                toggleNextBtn();
            } else if (input.value === "Virement_Bancaire") {
                // Afficher la section IBAN
                ibanPaiementSection.classList.remove('d-none');
                operateurSection.classList.add('d-none'); // Cacher opérateur
                telPaiementSection.classList.add('d-none'); // Cacher téléphone
                // otpSection.parentElement.classList.remove('d-none'); // Cacher OTP

                // Ajouter les attributs requis
                setRequired(['IBAN', 'ConfirmIBAN', 'RIB-file-uploa']);
                removeRequired(['Operateur', 'TelPaiement', 'ConfirmTelPaiement', 'FicheID-file-uploa']);
                // removeRequired(['otp_1', 'otp_2', 'otp_3', 'otp_4', 'otp_5', 'otp_6']);
                setRequired(['otp_1', 'otp_2', 'otp_3', 'otp_4', 'otp_5', 'otp_6']);

                // Masquer le bouton "next" pour Mobile Money
                nextBtn.classList.add('d-none');
            }
        });
    });

    // Vérifier si un opérateur est sélectionné pour afficher/masquer le bouton
    operateurInputs.forEach(input => {
        input.addEventListener('change', toggleNextBtn);
    });

    function toggleNextBtn() {
        const isSelected = Array.from(operateurInputs).some(input => input.checked);
        if (isSelected) {
            nextBtn.classList.remove('d-none');
        } else {
            nextBtn.classList.add('d-none');
        }
    }

    // Fonctions pour gérer les champs requis
    function setRequired(fields) {
        fields.forEach(id => {
            const field = document.getElementById(id) || document.querySelector(`input[name="${id}"]`);
            if (field) field.setAttribute('required', true);
        });
    }

    function removeRequired(fields) {
        fields.forEach(id => {
            const field = document.getElementById(id) || document.querySelector(`input[name="${id}"]`);
            if (field) field.removeAttribute('required');
        });
    }
});

    // affichage des éléments en fonction du moyen de paiement coché
document.addEventListener('DOMContentLoaded', function () {
    const mobileMoneyCheckbox = document.getElementById('mobileMoney');
    const virementBancaireCheckbox = document.getElementById('virementBancaire');
    // IDs des éléments à afficher ou masquer
    const elementsMobileMoney = ['Operateur', 'Operateur-btn', 'TelephonePaiement', 'btn-TelephonePaiement', 'FicheIDNum', 'btnTelPaiementSuivant'];
    const elementsVirementBancaire = ['next-stepper4', 'IBANPaiement', 'btn-IBANPaiement', 'RIB-file', 'prev-btnPrest1', 'btnIbanPaiementSuivant'];

    function toggleElements() {
        // Vérifie les cases cochées
        const isMobileMoneyChecked = mobileMoneyCheckbox.checked;
        const isVirementBancaireChecked = virementBancaireCheckbox.checked;


        // Logique d'affichage et masquage
        if (isMobileMoneyChecked && isVirementBancaireChecked) {
            // Afficher les éléments pour les deux options
            showElements(elementsMobileMoney.concat(['IBANPaiement']));
            hideElements(['next-stepper4', 'btn-IBANPaiement']);
        } else if (isMobileMoneyChecked) {
            // Afficher uniquement pour Mobile Money
            showElements(elementsMobileMoney);
            hideElements(elementsVirementBancaire);
        } else if (isVirementBancaireChecked) {
            // Afficher uniquement pour Virement Bancaire
            showElements(elementsVirementBancaire);
            hideElements(elementsMobileMoney);
        } else {
            // Si aucune option n'est cochée, tout est masqué
            hideElements(elementsMobileMoney.concat(elementsVirementBancaire));
        }
    }

    // Fonction pour afficher des éléments
    function showElements(ids) {
        ids.forEach(id => {
            const element = document.getElementById(id);
            if (element) {
                element.classList.remove('d-none');
            }
        });
    }

    // Fonction pour masquer des éléments
    function hideElements(ids) {
        ids.forEach(id => {
            const element = document.getElementById(id);
            if (element) {
                element.classList.add('d-none');
            }
        });
    }

    // Ajoute les écouteurs d'événements
    mobileMoneyCheckbox.addEventListener('change', toggleElements);
    virementBancaireCheckbox.addEventListener('change', toggleElements);

    // Appelle la fonction une première fois pour gérer l'état initial
    toggleElements();
});


// Debut upload doc

document.addEventListener('DOMContentLoaded', function () {
    // Éléments DOM
    const selectContrat = document.getElementById('idcontratPrest');
    const tablePrestation = document.getElementById('example3');
    const tablePrestationBody = tablePrestation.querySelector('tbody');
    const spinner = document.getElementById('spinner');

    // URLs API
    const API = {
        getPrestations: "/api/getPrestations",
        getOldPrestations: "https://api.laloyalevie.com/oldweb/courrier-consultation-bis"
    };

    let dataTableInstance = null;
    const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');

    // Fonctions utilitaires
    const formatDate = (dateString) => {
        if (!dateString) return '-';
        try {
            const date = new Date(dateString);
            return date.toLocaleDateString('fr-FR', {
                day: '2-digit',
                month: '2-digit',
                year: 'numeric',
                hour: '2-digit',
                minute: '2-digit',
                second: '2-digit'
            });
        } catch (e) {
            console.error("Erreur de formatage de date", e);
            return dateString;
        }
    };

    const clearTable = () => {
        if (dataTableInstance) {
            dataTableInstance.destroy();
            dataTableInstance = null;
        }
        tablePrestationBody.innerHTML = '';

        const modalContainer = document.getElementById('modalContainer');
        if (modalContainer) modalContainer.remove();
    };

    const showSpinner = (show = true) => {
        if (spinner) spinner.style.display = show ? 'block' : 'none';
    };

    const showNoDataMessage = (message = "Aucune prestation trouvée pour ce contrat.") => {
        tablePrestationBody.innerHTML = `
            <tr>
                <td colspan="6" class="text-center">${message}</td>
            </tr>`;
    };

    const showError = (message) => {
        tablePrestationBody.innerHTML = `
            <tr>
                <td colspan="6" class="text-center text-danger">${message}</td>
            </tr>`;
    };

    const createModal = (prestation) => {
        const modalId = `exampleModal${prestation.code}`;
        const docPrestations = prestation.doc_prestation;
        // recuperer le path de docPrestations dont le type est "etatPrestation"
        const path = docPrestations.find(doc => doc.type === 'etatPrestation').path;
        const baseUrl = window.location.origin;
        const fullPath = `${baseUrl}/${path}`;
        return `
            <div class="modal fade" id="${modalId}" tabindex="-1" aria-labelledby="${modalId}Label" aria-hidden="true">
                <div class="modal-dialog modal-lg">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="${modalId}Label">Détails de la prestation</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Fermer"></button>
                        </div>
                        <div class="modal-body" style="width: 100%; height: 80vh">
                            <iframe src="${fullPath}" width="100%" height="100%" style="border: 1px solid #ddd;"></iframe>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn-prime" data-bs-dismiss="modal">Fermer</button>
                        </div>
                    </div>
                </div>
            </div>
        `;
    };

    const getStatusBadge = (etape) => {
        const etapeNum = typeof etape === 'string' ? parseInt(etape) : etape;

        switch (etapeNum) {
            case 0:
                return '<div class="badge rounded-pill text-info bg-light-info p-2 text-uppercase px-3"><i class="bx bxs-circle me-1"></i>En attente de transmission</div>';
            case 1:
                return '<div class="badge rounded-pill text-primary bg-light-primary p-2 text-uppercase px-3"><i class="bx bxs-circle me-1"></i>Transmis pour traitement</div>';
            case 2:
                return '<div class="badge rounded-pill text-success bg-light-success p-2 text-uppercase px-3"><i class="bx bxs-circle me-1"></i>Demande acceptée</div>';
            case 3:
                return '<div class="badge rounded-pill text-danger bg-light-danger p-2 text-uppercase px-3"><i class="bx bxs-circle me-1"></i>Demande rejetée</div>';
            default:
                return '<div class="badge rounded-pill text-secondary bg-light-secondary p-2 text-uppercase px-3"><i class="bx bxs-circle me-1"></i>Statut inconnu</div>';
        }
    };

    const getOldStatusBadge = (etat) => {
        const etatNum = typeof etat === 'string' ? parseInt(etat) : etat;

        switch (etatNum) {
            case 1:
                return '<div class="badge rounded-pill text-warning bg-light-warning p-2 text-uppercase px-3"><i class="bx bxs-circle me-1"></i>En attente de traitement</div>';
            case 2:
                return '<div class="badge rounded-pill text-primary bg-light-primary p-2 text-uppercase px-3"><i class="bx bxs-circle me-1"></i>En cours de traitement</div>';
            case 3:
                return '<div class="badge rounded-pill p-2 text-uppercase px-3" style="color: #076633; background-color: #07663387;"><i class="bx bxs-circle me-1"></i>Approbation</div>';
            case 4:
                return '<div class="badge rounded-pill p-2 text-uppercase px-3" style="color: #F9B233; background-color: #F9B23387;"><i class="bx bxs-circle me-1"></i>Paiement en cours</div>';
            case 5:
                return '<div class="badge rounded-pill p-2 text-uppercase px-3"><i class="bx bxs-circle me-1"></i>Paiement effectué</div>';
            case 6:
                return '<div class="badge rounded-pill text-secondary bg-light-secondary p-2 text-uppercase px-3" style="color: #444444; background-color: #44444487;"><i class="bx bxs-circle me-1"></i>Archivé</div>';
            default:
                return '<div class="badge rounded-pill text-secondary bg-light-secondary p-2 text-uppercase px-3"><i class="bx bxs-circle me-1"></i>Statut inconnu</div>';
        }
    };

    const renderCombinedPrestations = (newPrestations, oldPrestations) => {
        const modalContainer = document.getElementById('modalContainer') || document.createElement('div');
        modalContainer.setAttribute('id', 'modalContainer');
        document.body.appendChild(modalContainer);
        modalContainer.innerHTML = '';

        let allRows = [];
        let hasData = false;

        // Nouvelles prestations
        if (newPrestations && newPrestations.length > 0) {
            hasData = true;
            newPrestations.forEach(prestation => {
                const modalHtml = createModal(prestation);
                modalContainer.innerHTML += modalHtml;

                const isEditable = prestation.etape == 0 || prestation.etape == 3;
                const editPrestationUrl = `/espace-client/prestation/${prestation.etape == 3 ? 'modifier-apres-rejet' : 'edit'}/${prestation.code}`;
                const hasMontant = prestation.montantSouhaite != null && prestation.montantSouhaite !== '';
                const isNotPrestationAutre = prestation.prestationlibelle != 'Autre';

                allRows.push(`
                    <tr class="new-prestation">
                        <td>${prestation.code || '-'}</td>
                        <td>${prestation.idcontrat || '-'}</td>
                        <td>${prestation.typeprestation || '-'}</td>
                        <td>${getStatusBadge(prestation.etape)}</td>
                        <td>${formatDate(prestation.created_at)}</td>
                        <td>
                            <div class="d-flex order-actions">
                               
                                <a href="/espace-client/details-prestation/${prestation.code}" class="ms-2 border"><i class='bx bxs-show'></i></a>
                                <a href="${editPrestationUrl}" class="ms-3 border ${isEditable && isNotPrestationAutre ? '' : 'disabled-link'}" 
                                    title="${isEditable && isNotPrestationAutre ? '' : 'Impossible de modifier la demande une fois transmise'}">
                                    <i class='bx bxs-edit'></i>
                                </a>
                                
                                <a href="javascript:;" class="deleteConfirmation border ms-3 ${isEditable ? '' : 'disabled-link'}"
                                    data-type="confirmation_redirect" data-placement="top"
                                    data-token="${csrfToken}" data-bs-toggle="tooltip" data-bs-placement="top" 
                                    title="${ prestation.etape != 0 ? 'Impossible de supprimer la demande une fois transmise' : '' }"
                                    data-url="/espace-client/prestation/destroy/${prestation.code}"
                                    data-title="Vous êtes sur le point de supprimer la prestation ${prestation.code}"
                                    data-id="${prestation.code}" data-param="0"
                                    data-route="/espace-client/prestation/destroy/${prestation.code}" ><i
                                        class='bx bxs-trash' style="cursor: pointer"></i>
                                </a>
                            </div>
                        </td>
                    </tr>
                `);
            });
        }

        // ${isPrestationAutre 
        //     ? `<a href="/espace-client/details-prestation/${prestation.code}" class="ms-2 border"><i class='bx bxs-show'></i></a>`
        //     : `<a href="javascript:void(0)" data-bs-toggle="modal" data-bs-target="#exampleModal${prestation.code}" class="ms-2 border"><i class='bx bxs-show'></i></a>`
        // }
        // Anciennes prestations
        if (oldPrestations && oldPrestations.length > 0) {
            hasData = true;
            oldPrestations.forEach(prestation => {
                allRows.push(`
                    <tr class="old-prestation">
                        <td>${prestation.CodeCourrier || '-'}</td>
                        <td>${prestation.IdProposition || '-'}</td>
                        <td>${prestation.MonLibelle || '-'}</td>
                        <td>${getOldStatusBadge(prestation.Etat)}</td>
                        <td>${prestation.SaisieLe || '-'}</td>
                        <td>
                            <div class="d-flex order-actions">
                                <a href="/espace-client/details-prestation/${prestation.CodeCourrier}" class="ms-2 border disabled-link">
                                    <i class='bx bxs-show'></i>
                                </a>
                                <a href="javascript:void(0)" class="ms-3 border disabled-link">
                                    <i class='bx bxs-edit'></i>
                                </a>
                                <a href="javascript:void(0)" class="border ms-3 disabled-link">
                                    <i class='bx bxs-trash'></i>
                                </a>
                            </div>
                        </td>
                    </tr>
                `);
            });
        }

        if (!hasData) {
            showNoDataMessage();
            return;
        }

        tablePrestationBody.innerHTML = allRows.join('');

        // Initialiser DataTables
        dataTableInstance = $(tablePrestation).DataTable({
            order: [],
            lengthChange: true,
            language: {
                search: "Recherche :",
                lengthMenu: "Afficher _MENU_ lignes",
                zeroRecords: "Aucun enregistrement trouvé",
                info: "Affichage de _START_ à _END_ sur _TOTAL_ enregistrements",
                infoEmpty: "Aucun enregistrement disponible",
                infoFiltered: "(filtré à partir de _MAX_ enregistrements)",
                paginate: {
                    first: "Premier",
                    last: "Dernier",
                    next: "Suivant",
                    previous: "Précédent",
                },
            },
            createdRow: function (row, data, dataIndex) {
                if ($(row).hasClass('old-prestation')) {
                    $(row).css('background-color', 'rgba(0,0,0,0.02)');
                }
            }
        });
    };



    // Événements
    const fetchPrestations = async (idcontrat) => {
        try {
            showSpinner();
            clearTable();

            if (!idcontrat || idcontrat === 'Veuillez sélectionner un contrat') {
                showNoDataMessage("Veuillez sélectionner un contrat pour voir les prestations.");
                return;
            }

            let newPrestations = [];
            let oldPrestations = [];
            let hasCriticalError = false;

            // Gestion de l'API principale (nouvelles prestations)
            try {
                const newPrestationsResponse = await fetch(API.getPrestations, {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': csrfToken,
                    },
                    body: JSON.stringify({
                        idcontratPrest: idcontrat
                    }),
                });

                if (newPrestationsResponse.ok) {
                    const newPrestationsData = await newPrestationsResponse.json();
                    if (newPrestationsData.status === 'success') {
                        newPrestations = newPrestationsData.data || [];
                        console.log(newPrestations);
                    } else {
                        console.error('Réponse API nouvelles prestations inattendue:', newPrestationsData);
                        hasCriticalError = true;
                    }
                } else {
                    console.error('Erreur API nouvelles prestations:', newPrestationsResponse.status);
                    hasCriticalError = true;
                }
            } catch (e) {
                console.error('Erreur API nouvelles prestations:', e);
                hasCriticalError = true;
            }

            // Gestion de l'API ancienne (tolérante aux erreurs)
            try {
                const oldPrestationsResponse = await fetch(API.getOldPrestations, {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                    },
                    body: JSON.stringify({
                        idContrat: idcontrat
                    }),
                });

                if (oldPrestationsResponse.ok) {
                    const oldPrestationsData = await oldPrestationsResponse.json();
                    if (oldPrestationsData.error === false) {
                        oldPrestations = oldPrestationsData.mesCourrier || [];
                    } else {
                        console.log('API ancienne prestations:', oldPrestationsData.message || 'Réponse inattendue (non critique)');
                    }
                } else {
                    console.log(`API ancienne prestations: ${oldPrestationsResponse.status} (erreur non critique)`);
                }
            } catch (e) {
                console.log('Erreur non critique API ancienne prestations:', e.message);
            }

            // Décision d'affichage
            if (hasCriticalError) {
                showError('Une erreur technique est survenue lors de la récupération des données.');
            } else if (newPrestations.length === 0 && oldPrestations.length === 0) {
                showNoDataMessage("Aucune prestation trouvée pour ce contrat.");
            } else {
                renderCombinedPrestations(newPrestations, oldPrestations);
            }

        } catch (error) {
            console.error('Erreur inattendue:', error);
            showError('Une erreur inattendue est survenue.');
        } finally {
            showSpinner(false);
        }
    };

    selectContrat.addEventListener('change', function () {
        fetchPrestations(this.value);
    });

    // Initialisation
    if (selectContrat.value) {
        fetchPrestations(selectContrat.value);
    }
});

document.addEventListener('DOMContentLoaded', function () {
    const selectContrat = document.getElementById('idcontratRdv');
    const tableRdv = document.getElementById('example3'); // Table complète
    const tableRdvBody = tableRdv.querySelector('tbody');
    const getRdvUrl = "/api/getRdv";
    let dataTableInstance = null;

    const formatDate = (dateString) => {
        if (!dateString) return '-';
        const date = new Date(dateString);
        return date.toLocaleDateString('fr-FR', {
            day: '2-digit',
            month: '2-digit',
            year: 'numeric'
        });
    };

    const clearTable = () => {
        if (dataTableInstance) {
            dataTableInstance.destroy(); // Détruire DataTables
            dataTableInstance = null;
        }
        tableRdvBody.innerHTML = ''; // Nettoyer le contenu du tableau
    };

    selectContrat.addEventListener('change', function () {
        const idcontrat = selectContrat.value;
        const spinner = document.getElementById('spinner');
        if (spinner) {
            spinner.style.display = 'block';
        }

        if (idcontrat === 'Veuillez sélectionner un contrat') {
            clearTable();
            tableRdvBody.innerHTML = `
                <tr>
                    <td colspan="9" class="text-center">Veuillez sélectionner un contrat pour voir les rdv.</td>
                </tr>`;
            return;
        }

        fetch(getRdvUrl, {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                },
                body: JSON.stringify({
                    idcontratPrest: idcontrat
                }),
            })
            .then(response => {
                if (!response.ok) {
                    throw new Error('Erreur lors de la récupération des données');
                }
                return response.json();
            })
            .then(data => {
                clearTable(); // Toujours nettoyer la table avant de réinitialiser
                if (data.status === 'success') {
                    const rdvs = data.data;
                    if (rdvs.length > 0) {
                        tableRdvBody.innerHTML = rdvs.map(rdv => `
                            <tr>
                                <td>${rdv.codedmd || '-'}</td>
                                <td>${rdv.titre || '-'}</td>
                                <td>${rdv.police || '-'}</td>
                                <td>${rdv.motifrdv || '-'}</td>
                                <td>${rdv.ville?.libelleVilleBureau || '-'}</td>
                                <td>${rdv.daterdv || '-'}</td>
                                <td>${rdv.villeEffective?.libelleVilleBureau !=null ? rdv.villeEffective?.libelleVilleBureau : rdv.ville?.libelleVilleBureau || '-'}</td>
                                <td>${rdv.daterdveff !=null ? formatDate(rdv.daterdveff) : rdv.daterdv || '-'}</td>
                                <td>
                                    ${rdv.etat == '0' ? 
                                        `<div class="badge rounded-pill text-danger bg-light-danger p-2 text-uppercase px-3">
                                            <i class="bx bxs-circle me-1"></i>RDV non accepté
                                        </div>` :
                                    rdv.etat == '1' ? 
                                        `<div class="badge rounded-pill text-info bg-light-info p-2 text-uppercase px-3">
                                            <i class="bx bxs-circle me-1"></i>En attente d'acceptation
                                        </div>` :
                                    rdv.etat == '2' ? 
                                        `<div class="badge rounded-pill text-primary bg-light-primary p-2 text-uppercase px-3">
                                            <i class="bx bxs-circle me-1"></i>RDV accepté et transmis au gestionnaire
                                        </div>` :
                                    rdv.etat == '3' ? 
                                        `<div class="d-flex flex-column align-items-center justify-content-between">
                                            <div class="badge rounded-pill text-success bg-light-success p-2 mb-2 text-uppercase px-3" style="height: 45%;">
                                                <i class="bx bxs-circle me-1"></i>Traitement Terminé
                                            </div>
                                            <div class="badge rounded-pill text-white bg-secondary text-wrap text-center p-2 px-3" style="height: 45%;">
                                                ${rdv.libelleTraitement || '-'}
                                            </div>
                                        </div>` :
                                        `<div class="badge rounded-pill text-success bg-light-success p-2 text-uppercase px-3">
                                            <i class="bx bxs-circle me-1"></i>Traitement Terminé
                                        </div>`
                                    }
                                </td>
                                <td>${rdv.dateajou || '-'}</td>
                            </tr>
                        `).join('');
                        // Initialiser DataTables après l'ajout des lignes
                        dataTableInstance = $(tableRdv).DataTable({
                            order: [],
                            lengthChange: true,
                            language: {
                                search: "Recherche :",
                                lengthMenu: "Afficher _MENU_ lignes",
                                zeroRecords: "Aucun enregistrement trouvé",
                                info: "Affichage de _START_ à _END_ sur _TOTAL_ enregistrements",
                                infoEmpty: "Aucun enregistrement disponible",
                                infoFiltered: "(filtré à partir de _MAX_ enregistrements)",
                                paginate: {
                                    first: "Premier",
                                    last: "Dernier",
                                    next: "Suivant",
                                    previous: "Précédent",
                                },
                            },
                        });
                    } else {
                        tableRdvBody.innerHTML = `
                            <tr>
                                <td colspan="10" class="text-center">Aucun rdv pris pour ce contrat.</td>
                            </tr>`;
                    }

                } else {
                    tableRdvBody.innerHTML = `
                        <tr>
                            <td colspan="10" class="text-center text-danger">Aucun rdv pris pour ce contrat</td>
                        </tr>`;
                }

                if (spinner) {
                    spinner.style.display = 'none';
                }
            })
            .catch(error => {
                console.error('Error:', error);
                clearTable();
                if (spinner) {
                    spinner.style.display = 'none';
                }
                tableRdvBody.innerHTML = `
                    <tr>
                        <td colspan="9" class="text-center text-danger">Aucun rdv pris pour ce contrat</td>
                    </tr>`;
            });
    });
});






$('#Police-file-upload').FancyFileUpload({
    params: {
        action: 'fileuploader'
    },
    // maxfilesize: 1000000
});
$('#bulletin-file-upload').FancyFileUpload({
    params: {
        action: 'fileuploader'
    },
    // maxfilesize: 1000000
});
$('#RIB-file-upload').FancyFileUpload({
    params: {
        action: 'fileuploader'
    },
    // maxfilesize: 1000000
});
$('#CNIrecto-file-upload').FancyFileUpload({
    params: {
        action: 'fileuploader'
    },
    // maxfilesize: 1000000
});
$('#CNIverso-file-upload').FancyFileUpload({
    params: {
        action: 'fileuploader'
    },
    // maxfilesize: 1000000
});
$('#FicheID-file-upload').FancyFileUpload({
    params: {
        action: 'fileuploader'
    },
    // maxfilesize: 1000000
});
$('#AttestationPerte-file-upload').FancyFileUpload({
    params: {
        action: 'fileuploader'
    },
    // maxfilesize: 1000000
});


document.addEventListener('DOMContentLoaded', function () {
    const otpInputs = document.querySelectorAll('.otp-input');
    const ribInputs = document.querySelectorAll('.rib-input');

    function handleInput(inputArray, event, index) {
        const input = event.target;
        const nextInput = inputArray[index + 1];
        const prevInput = inputArray[index - 1];

        // Empêcher les entrées multiples (ex: copier-coller)
        if (input.value.length > 1) {
            input.value = input.value.charAt(0);
        }

        // Passage automatique au champ suivant
        if (input.value.length === 1 && nextInput) {
            nextInput.focus();
        }
    }

    function handleKeyDown(inputArray, event, index) {
        const input = event.target;
        const prevInput = inputArray[index - 1];
        const nextInput = inputArray[index + 1];

        // Gestion du retour arrière (Backspace)
        if (event.key === 'Backspace' && input.value === '' && prevInput) {
            prevInput.focus();
        }

        // Permettre la navigation avec les flèches gauche et droite
        if (event.key === 'ArrowLeft' && prevInput) {
            prevInput.focus();
        } else if (event.key === 'ArrowRight' && nextInput) {
            nextInput.focus();
        }
    }

    function handlePaste(event) {
        event.preventDefault(); // Empêcher le collage multiple
    }

    // Gestion des OTP inputs
    otpInputs.forEach((input, index) => {
        input.addEventListener('input', (event) => handleInput(otpInputs, event, index));
        input.addEventListener('keydown', (event) => handleKeyDown(otpInputs, event, index));
        input.addEventListener('paste', handlePaste);
    });

    // Gestion des RIB inputs (avec validation)
    // ribInputs.forEach((input, index) => {
    //     input.addEventListener('input', function (event) {
    //         this.value = this.value.replace(/[^a-zA-Z0-9]/g, ''); // Autoriser uniquement chiffres
    //         handleInput(ribInputs, event, index);
    //     });

    //     input.addEventListener('keydown', (event) => handleKeyDown(ribInputs, event, index));
    //     input.addEventListener('paste', handlePaste);
    // });

    // Gestion des RIB inputs (chiffres uniquement)
    ribInputs.forEach((input, index) => {

        // Filtrage après saisie
        input.addEventListener('input', function (event) {
            this.value = this.value.replace(/\D/g, ''); // \D = tout sauf chiffre
            handleInput(ribInputs, event, index);
        });

        // Blocage des touches non numériques
        input.addEventListener('keydown', function (event) {
            const allowedKeys = [
                'Backspace', 'Delete', 'ArrowLeft', 'ArrowRight', 'Tab'
            ];

            if (!/[0-9]/.test(event.key) && !allowedKeys.includes(event.key)) {
                event.preventDefault();
            }

            handleKeyDown(ribInputs, event, index);
        });

        input.addEventListener('paste', function (event) {
            event.preventDefault(); // empêcher collage
        });
    });

});


document.addEventListener('DOMContentLoaded', function () {
    const formulaire = document.querySelector('#monFormulaire');

    if (!formulaire) {
        console.error("Le formulaire avec l'ID 'monFormulaire' est introuvable.");
        return;
    }

    formulaire.addEventListener('input', mettreAJourResume);
    formulaire.addEventListener('change', mettreAJourResume);

    function mettreAJourResume() {
        try {
            // Récupération des valeurs des champs
            const typePrestation = formulaire.querySelector('[name="typeprestation"]') ?.value || '';
            const idContrat = formulaire.querySelector('[name="idcontrat"]') ?.value || '';
            const montantSouhaite = formulaire.querySelector('[name="montantSouhaite"]') ?.value || '';

            // Récupération des boutons radio sélectionnés
            const moyenPaiement = formulaire.querySelector('[name="moyenPaiement"]:checked') ?.value || '';
            const operateur = formulaire.querySelector('[name="Operateur"]:checked') ?.value || '';
            const sexe = formulaire.querySelector('[name="sexe"]') ?.value || '';

            const telPaiement = formulaire.querySelector('[name="TelPaiement"]') ?.value || '';
            const iban = formulaire.querySelector('[name="IBAN"]') ?.value || '';

            const nom = formulaire.querySelector('[name="nom"]') ?.value || '';
            const prenom = formulaire.querySelector('[name="prenom"]') ?.value || '';
            const dateNaissance = formulaire.querySelector('[name="datenaissance"]') ?.value || '';
            const cel = formulaire.querySelector('[name="cel"]') ?.value || '';
            const email = formulaire.querySelector('[name="email"]') ?.value || '';
            const lieuResidence = formulaire.querySelector('[name="lieuresidence"]') ?.value || '';

            // Mise à jour du résumé
            document.getElementById('TelOtp').value = cel;
            document.getElementById('Prestation').textContent = typePrestation;
            document.getElementById('Contrat').textContent = idContrat;
            document.getElementById('montant').textContent = montantSouhaite + ' FCFA';

            const moyenPaiementText = moyenPaiement === 'Virement_Bancaire' ? 'Virement Bancaire' : 'Mobile Money';
            document.getElementById('moyenPmt').textContent = moyenPaiementText;

            // Mise à jour du résumé pour le moyen de paiement Mobile Money
            const telPaiementSection = document.getElementById('TelephonePaiement');
            const ibanPaiementSection = document.getElementById('IBANPaiement');

            if (ibanPaiementSection.classList.contains('d-none') && moyenPaiement === 'Mobile_Money') {
                const operateurText = operateur === 'Orange_money' ? 'Orange Money' :
                    operateur === 'MTN_money' ? 'MTN Money' :
                    operateur === 'Moov_money' ? 'Moov Money' : '';
                document.getElementById('Opera').textContent = operateurText;
                document.getElementById('TelPmt').textContent = telPaiement;
                document.getElementById('NIBAN').textContent = '';
            } else if (telPaiementSection.classList.contains('d-none') && moyenPaiement === 'Virement_Bancaire') {
                document.getElementById('NIBAN').textContent = iban;
                document.getElementById('Opera').textContent = '';
                document.getElementById('TelPmt').textContent = '';


            }

            document.getElementById('nomSous').textContent = nom;
            document.getElementById('prenomSous').textContent = prenom;
            document.getElementById('datenaissanceSous').textContent = dateNaissance;
            document.getElementById('sexeSous').textContent = sexe;
            document.getElementById('celSous').textContent = cel;
            document.getElementById('emailSous').textContent = email;
            document.getElementById('lieuresidenceSous').textContent = lieuResidence;
        } catch (error) {
            console.error("Erreur lors de la mise à jour du résumé :", error);
        }
    }
});

// Fin js perso prestation



// Debut js perso Sinistre

document.addEventListener('DOMContentLoaded', function () {

    // check contrat details
    const form = document.getElementById('checkContratForSinistre');
    const spinner = document.getElementById('spinner');
    const assureTable = document.getElementById('assureTable');
    const assureBlock = document.querySelector('.assure-table');

    form.addEventListener('submit', function (e) {
        e.preventDefault();
        spinner.classList.remove('d-none');

        const formData = new FormData(form);
        

        fetch("/api/check-contrat", {
                method: 'POST',
                headers: {
                    'X-CSRF-TOKEN': document.querySelector('input[name="_token"]').value
                },
                body: formData
            })
            .then(response => response.json())
            .then(data => {
                console.log(data);
                // ajouter data dans la session storage
                sessionStorage.setItem('Details', JSON.stringify(data));
                spinner.classList.add('d-none');

                Toastify({
                    text: data.message || "Une réponse inattendue a été reçue.",
                    duration: 7000,
                    gravity: "top",
                    position: "right",
                    backgroundColor: data.type === 'success' ? "#28a745" : "#dc3545",
                }).showToast();

                if (data.type === 'success') {
                    // fetchAssures();
                    assureTable.innerHTML = '';
                    if (data.length === 0) {
                        assureTable.innerHTML = `<tr><td colspan="7" class="text-center">Aucun assuré trouvé.</td></tr>`;
                    } else {
                        data.assures.forEach((assure) => {
                            assureTable.innerHTML += `
                            <tr>
                                <td>${assure.CodePersonne}</td>
                                <td>${assure.nomAssu}</td>
                                <td>${assure.PrenomAssu}</td>
                                <td>${assure.DateNaissanceAssu}</td>
                                <td>${assure.LieuNaissanceAssu}</td>
                                <td>${assure.CodeFiliation == 'LUIMM' ? 'Souscripteur' : assure.MonLibelle}</td>
                                <td>
                                    <form action="/sinistre/getContratAssures"  method="POST" class="submitForm">
                                        <input type="hidden" name="_token" value="${document.querySelector('meta[name="csrf-token"]').content}">
                                        <input type="hidden" name="IdProposition" value="${data.contratDetails.IdProposition}">
                                        <input type="hidden" name="CodeAssure" value="${assure.IdPropositionPartenaires}">
                                        <button type="submit" class="btn-prime btn-prime-two p-2">Déclarer un sinistre</button>
                                    </form>
                                    
                                </td>
                            </tr>`;
                        });
                        assureBlock.classList.remove('d-none');
                    }

                }
            })
            .catch(error => {
                spinner.classList.add('d-none');
                console.error('Erreur AJAX:', error);
                Toastify({
                    text: "Une erreur s'est produite lors de l'envoi.",
                    duration: 5000,
                    gravity: "top",
                    position: "right",
                    backgroundColor: "#e74c3c",
                }).showToast();
            });
    });

});

const documents = [
    {
      "idfichier": 1,
      "CodeDoc": "COND_PART",
      "libelleFichier": "Conditions particulières (Police) / bulletin d’adhésion ou déclaration de perte du contrat",
      "listDoc": [
        { "codeDoc": "COND_PART", "libelleDoc": "Conditions particulières (Police)" },
        { "codeDoc": "BULLETIN_ADHESION", "libelleDoc": "Bulletin d’adhésion" },
        { "codeDoc": "DECLARATION_PERTE", "libelleDoc": "Déclaration de perte du contrat (commissariat)" }
      ],
      "Deces": true,
      "Invalidite": true,
      "InvaliditeTotale": true,
      "InvaliditePartielle": true,
      "Accidentel": false,
      "CorpsConserveOui": false,
      "CorpsConserveNon": false,
      "InhumationEuLieu": false,
      "DecesSouscripteur": true,
      "MobileMoney_Paiement": false,
      "Virement_Bancaire": false,
      "EPARGNE": true,
      "OBSEQUE": true,
      "MIXTE": true,
      "Requis": [
        {
            "Deces": true,
            "Invalidite": true,
            "Accidentel": false,
            "CorpsConserveOui": false,
            "CorpsConserveNon": false,
            "InhumationEuLieu": false,
            "MobileMoney_Paiement": false,
            "Virement_Bancaire": false,
        }
      ]
    },
    {
      "idfichier": 2,
      "CodeDoc": "ID_ASSURE",
      "libelleFichier": `Pièces d'identification de l'assuré concerné (${assuree?.nomAssu ?? ''} ${assuree?.PrenomAssu ?? ''})`,
      "listDoc": [
        { "codeDoc": "CNI_ASSURE", "libelleDoc": `CNI de ${assuree?.nomAssu ?? ''} ${assuree?.PrenomAssu ?? ''}` },
        { "codeDoc": "CARTE_CONSULAIRE_ASSURE", "libelleDoc": `Carte consulaire de ${assuree?.nomAssu ?? ''} ${assuree?.PrenomAssu ?? ''}` },
        { "codeDoc": "CARTE_SEJOUR_ASSURE", "libelleDoc": `Carte de séjour de ${assuree?.nomAssu ?? ''} ${assuree?.PrenomAssu ?? ''}` },
        { "codeDoc": "EXTRAIT_NAISSANCE_ASSURE", "libelleDoc": `Extrait d’acte de naissance de ${assuree?.nomAssu ?? ''} ${assuree?.PrenomAssu ?? ''}` },
        { "codeDoc": "JUGEMENT_SUPPLETIF_ASSURE", "libelleDoc": `Jugement supplétif de ${assuree?.nomAssu ?? ''} ${assuree?.PrenomAssu ?? ''}` },
        { "codeDoc": "AUTRE_PIECE_ASSURE", "libelleDoc": `Autre pièce d'identification de ${assuree?.nomAssu ?? ''} ${assuree?.PrenomAssu ?? ''}` }
      ],
      "Deces": true,
      "Invalidite": true,
      "InvaliditeTotale": true,
      "InvaliditePartielle": true,
      "Accidentel": false,
      "CorpsConserveOui": false,
      "CorpsConserveNon": false,
      "InhumationEuLieu": false,
      "DecesSouscripteur": true,
      "MobileMoney_Paiement": false,
      "Virement_Bancaire": false,
      "EPARGNE": true,
      "OBSEQUE": true,
      "MIXTE": true,
      "Requis": [
        {
            "Deces": true,
            "Invalidite": true,
            "Accidentel": false,
            "CorpsConserveOui": false,
            "CorpsConserveNon": false,
            "InhumationEuLieu": false,
            "MobileMoney_Paiement": false,
            "Virement_Bancaire": false,
        }
      ]
    },
    {
      "idfichier": 3,
      "CodeDoc": "CERTIF_MED_DECES",
      "libelleFichier": "Certificat de décès délivré par un médecin",
      "listDoc": [
        { "codeDoc": "DOC_CERTIF_MED_DECES", "libelleDoc": "Certificat médical de décès" }
      ],
      "Deces": true,
      "Invalidite": false,
      "InvaliditeTotale": false,
      "InvaliditePartielle": false,
      "Accidentel": false,
      "InhumationEuLieu": false,
      "CorpsConserveOui": false,
      "CorpsConserveNon": false,
      "DecesSouscripteur": true,
      "MobileMoney_Paiement": false,
      "Virement_Bancaire": false,
      "EPARGNE": true,
      "OBSEQUE": true,
      "MIXTE": true,
      "Requis": [
        {
            "Deces": true,
            "Invalidite": false,
            "Accidentel": false,
            "CorpsConserveOui": false,
            "CorpsConserveNon": false,
            "InhumationEuLieu": false,
            "MobileMoney_Paiement": false,
            "Virement_Bancaire": false,
        }
      ]
    },
    {
      "idfichier": 4,
      "CodeDoc": "ACTE_DECES_MAIRIE",
      "libelleFichier": "Acte de décès délivré par une mairie",
      "listDoc": [
        { "codeDoc": "DOC_ACTE_DECES", "libelleDoc": "Acte de décès (mairie)" }
      ],
      "Deces": true,
      "Invalidite": false,
      "InvaliditeTotale": false,
      "InvaliditePartielle": false,
      "Accidentel": false,
      "InhumationEuLieu": false,
      "CorpsConserveOui": false,
      "CorpsConserveNon": false,
      "DecesSouscripteur": true,
      "MobileMoney_Paiement": false,
      "Virement_Bancaire": false,
      "EPARGNE": true,
      "OBSEQUE": true,
      "MIXTE": true,
      "Requis": [
        {
            "Deces": true,
            "Invalidite": false,
            "Accidentel": false,
            "InhumationEuLieu": false,
            "CorpsConserveOui": false,
            "CorpsConserveNon": false,
            "MobileMoney_Paiement": false,
            "Virement_Bancaire": false,
        }
      ]
    },
    {
      "idfichier": 5,
      "CodeDoc": "ID_BENEFICIAIRE",
      "libelleFichier": "Pièces d'identification du bénéficiaire",
      "listDoc": [
        { "codeDoc": "CNI_BENEF", "libelleDoc": "CNI du bénéficiaire" },
        { "codeDoc": "ATTEST_IDENTITE_BENEF", "libelleDoc": "Attestation d’identité du bénéficiaire" },
        { "codeDoc": "CARTE_CONSULAIRE_BENEF", "libelleDoc": "Carte consulaire du bénéficiaire" },
        { "codeDoc": "EXTRAIT_NAISSANCE_BENEF", "libelleDoc": "Extrait de naissance (si mineur) du bénéficiaire" },
        { "codeDoc": "AUTRE_PIECE_BENEF", "libelleDoc": "Autre pièce d'identification du bénéficiaire" }
      ],
      "Deces": true,
      "Invalidite": true,
      "InvaliditeTotale": true,
      "InvaliditePartielle": true,
      "Accidentel": false,
      "InhumationEuLieu": false,
      "DecesSouscripteur": true,
      "MobileMoney_Paiement": false,
      "Virement_Bancaire": false,
      "EPARGNE": true,
      "OBSEQUE": true,
      "MIXTE": true,
      "Requis": [
        {
            "Deces": true,
            "Invalidite": true,
            "Accidentel": false,
            "InhumationEuLieu": false,
            "MobileMoney_Paiement": false,
            "Virement_Bancaire": false,
        }
      ]
    },
    {
      "idfichier": 6,
      "CodeDoc": "CERTIF_GENRE_MORT",
      "libelleFichier": "Certificat de genre de mort délivré par un médecin",
      "listDoc": [
        { "codeDoc": "DOC_CERTIF_GENRE_MORT", "libelleDoc": "Certificat de genre de mort" }
      ],
      "Deces": true,
      "Invalidite": false,
      "InvaliditeTotale": false,
      "InvaliditePartielle": false,
      "Accidentel": false,
      "InhumationEuLieu": false,
      "CorpsConserveEuLieu": false,
      "DecesSouscripteur": true,
      "MobileMoney_Paiement": false,
      "Virement_Bancaire": false,
      "EPARGNE": true,
      "OBSEQUE": false,
      "MIXTE": true,
      "Requis": [
        {
            "Deces": true,
            "Invalidite": false,
            "Accidentel": false,
            "InhumationEuLieu": false,
            "CorpsConserveOui": false,
            "CorpsConserveNon": false,
            "MobileMoney_Paiement": false,
            "Virement_Bancaire": false,
        }
      ]
    },
    {
      "idfichier": 7,
      "CodeDoc": "FICHE_ENTREE_MORGUE",
      "libelleFichier": "Fiche d’entrée à la morgue",
      "listDoc": [
        { "codeDoc": "DOC_FICHE_ENTREE_MORGUE", "libelleDoc": "Fiche d’entrée à la morgue" }
      ],
      "Deces": true,
      "Invalidite": false,
      "InvaliditeTotale": false,
      "InvaliditePartielle": false,
      "Accidentel": false,
      "InhumationEuLieu": false,
      "CorpsConserveOui": true,
      "CorpsConserveNon": false,
      "DecesSouscripteur": true,
      "MobileMoney_Paiement": false,
      "Virement_Bancaire": false,
      "EPARGNE": true,
      "OBSEQUE": true,
      "MIXTE": true,
      "Requis": [
        {
            "Deces": true,
            "Invalidite": false,
            "Accidentel": false,
            "InhumationEuLieu": false,
            "CorpsConserveOui": true,
            "CorpsConserveNon": false,
            "MobileMoney_Paiement": false,
            "Virement_Bancaire": false,
        }
      ]
    },
    {
      "idfichier": 8,
      "CodeDoc": "FACTURE_MORGUE",
      "libelleFichier": "Facture normalisée de règlement de la morgue",
      "listDoc": [
        { "codeDoc": "DOC_FACTURE_MORGUE", "libelleDoc": "Facture de règlement de la morgue" }
      ],
      "Deces": true,
      "Invalidite": false,
      "InvaliditeTotale": false,
      "InvaliditePartielle": false,
      "Accidentel": false,
      "InhumationEuLieu": true,
      "CorpsConserveOui": false,
      "CorpsConserveNon": false,
      "DecesSouscripteur": true,
      "MobileMoney_Paiement": false,
      "Virement_Bancaire": false,
      "EPARGNE": true,
      "OBSEQUE": true,
      "MIXTE": true,
      "Requis": [
        {
            "Deces": true,
            "Invalidite": false,
            "Accidentel": false,
            "InhumationEuLieu": true,
            "CorpsConserveOui": false,
            "CorpsConserveNon": false,
            "MobileMoney_Paiement": false,
            "Virement_Bancaire": false,
        }
      ]
    },
    {
      "idfichier": 9,
      "CodeDoc": "PERMIS_INHUMATION",
      "libelleFichier": "Permis d’inhumer (si pas de conservation de corps)",
      "listDoc": [
        { "codeDoc": "DOC_PERMIS_INHUMATION", "libelleDoc": "Permis d’inhumer" }
      ],
      "Deces": true,
      "Invalidite": false,
      "InvaliditeTotale": false,
      "InvaliditePartielle": false,
      "Accidentel": false,
      "InhumationEuLieu": false,
      "CorpsConserveOui": false,
      "CorpsConserveNon": true,
      "DecesSouscripteur": true,
      "MobileMoney_Paiement": false,
      "Virement_Bancaire": false,
      "EPARGNE": true,
      "OBSEQUE": true,
      "MIXTE": true,
      "Requis": [
        {
            "Deces": true,
            "Invalidite": false,
            "Accidentel": false,
            "InhumationEuLieu": false,
            "CorpsConserveOui": false,
            "CorpsConserveNon": true,
            "MobileMoney_Paiement": false,
            "Virement_Bancaire": false,
        }
      ]
    },
    {
      "idfichier": 15,
      "CodeDoc": "RAPPORT_MED_INVALIDITE",
      "libelleFichier": "Rapport médical d’invalidité fourni par un médecin",
      "listDoc": [
        { "codeDoc": "DOC_RAPPORT_MED_INVALIDITE", "libelleDoc": "Rapport médical d’invalidité" }
      ],
      "Deces": false,
      "Invalidite": true,
      "InvaliditeTotale": true,
      "InvaliditePartielle": true,
      "Accidentel": false,
      "InhumationEuLieu": false,
      "DecesSouscripteur": false,
      "MobileMoney_Paiement": false,
      "Virement_Bancaire": false,
      "EPARGNE": false,
      "OBSEQUE": false,
      "MIXTE": false,
      "Requis": [
        {
            "Deces": false,
            "Invalidite": true,
            "Accidentel": false,
            "InhumationEuLieu": false,
            "MobileMoney_Paiement": false,
            "Virement_Bancaire": false,
        }
      ]
    },
    {
      "idfichier": 16,
      "CodeDoc": "PV_ACCIDENT",
      "libelleFichier": "Procès-verbal de l’accident (police ou gendarmerie)",
      "listDoc": [
        { "codeDoc": "DOC_PV_ACCIDENT", "libelleDoc": "Procès-verbal de l’accident" }
      ],
      "Deces": true,
      "Invalidite": false,
      "InvaliditeTotale": false,
      "InvaliditePartielle": false,
      "Accidentel": true,
      "InhumationEuLieu": false,
      "DecesSouscripteur": true,
      "MobileMoney_Paiement": false,
      "Virement_Bancaire": false,
      "EPARGNE": true,
      "OBSEQUE": true,
      "MIXTE": true,
      "Requis": [
        {
            "Deces": true,
            "Invalidite": false,
            "Accidentel": true,
            "InhumationEuLieu": false,
            "MobileMoney_Paiement": false,
            "Virement_Bancaire": false,
        }
      ]
    },
    {
        "idfichier": 17,
        "CodeDoc": "RIB",
        "libelleFichier": `Relevé d'identité bancaire (RIB) ${benefConserne}`,
        "listDoc": [
          { "codeDoc": "DOC_RIB", "libelleDoc": "Relevé d'identité bancaire" }
        ],
        "Deces": true,
        "Invalidite": true,
        "InvaliditeTotale": true,
        "InvaliditePartielle": true,
        "Accidentel": false,
        "InhumationEuLieu": false,
        "MobileMoney_Paiement": false,
        "Virement_Bancaire": true,
        "DecesSouscripteur": true,
        "EPARGNE": true,
        "OBSEQUE": true,
        "MIXTE": true,
        "Requis": [
          {
              "Deces": true,
              "Invalidite": true,
              "Accidentel": false,
              "InhumationEuLieu": false,
              "MobileMoney_Paiement": false,
              "Virement_Bancaire": true,
          }
        ]
    },
    {
        "idfichier": 18,
        "CodeDoc": "MobileMoney_Paiement",
        "libelleFichier": `Fiche d'identification du n° de paiement (${benefConserne}) avec le caché de l'opérateur téléphonique ou la capture d'écran de la vérification par la syntaxe`,
        "listDoc": [
        { "codeDoc": "DOC_MOBILE_MONEY_PAIEMENT", "libelleDoc": "Fiche d'identification du n° de paiement" }
        ],
        "Deces": true,
        "Invalidite": true,
        "InvaliditeTotale": true,
        "InvaliditePartielle": true,
        "Accidentel": false,
        "InhumationEuLieu": false,
        "MobileMoney_Paiement": true,
        "Virement_Bancaire": false,
        "DecesSouscripteur": true,
        "EPARGNE": true,
        "OBSEQUE": true,
        "MIXTE": true,
        "Requis": [
        {
            "Deces": true,
            "Invalidite": true,
            "Accidentel": false,
            "InhumationEuLieu": false,
            "MobileMoney_Paiement": true,
            "Virement_Bancaire": false,
        }
        ]
    }

    // {
    //     "idfichier": 14,
    //     "CodeDoc": "ACTE_MARIAGE",
    //     "libelleFichier": "Acte de mariage (si conjoint bénéficiaire)",
    //     "listDoc": [
    //       { "codeDoc": "DOC_ACTE_MARIAGE", "libelleDoc": "Acte de mariage" }
    //     ],
    //     "Deces": true,
    //     "Invalidite": false,
    //     "InvaliditeTotale": false,
    //     "InvaliditePartielle": false,
    //     "Accidentel": false,
    //     "InhumationEuLieu": false,
    //     "DecesSouscripteur": true,
    //     "MobileMoney_Paiement": false,
    //     "Virement_Bancaire": false,
    //     "EPARGNE": true,
    //     "OBSEQUE": true,
    //     "MIXTE": true,
    //     "Requis": [
    //       {
    //           "Deces": false,
    //           "Invalidite": false,
    //           "Accidentel": false,
    //           "InhumationEuLieu": false,
    //           "MobileMoney_Paiement": false,
    //           "Virement_Bancaire": false,
    //       }
    //     ]
    //   },

    // {
    //     "idfichier": 13,
    //     "CodeDoc": "PROCURATION",
    //     "libelleFichier": "Procuration légalisée (mairie) ou spéciale (tribunal)",
    //     "listDoc": [
    //       { "codeDoc": "PROCURATION_LEGALE", "libelleDoc": "Procuration légalisée (mairie)" },
    //       { "codeDoc": "PROCURATION_SPECIALE", "libelleDoc": "Procuration spéciale (tribunal)" }
    //     ],
    //     "Deces": true,
    //     "Invalidite": false,
    //     "InvaliditeTotale": false,
    //     "InvaliditePartielle": false,
    //     "Accidentel": false,
    //     "InhumationEuLieu": false,
    //     "DecesSouscripteur": true,
    //     "MobileMoney_Paiement": false,
    //     "Virement_Bancaire": false,
    //     "EPARGNE": true,
    //     "OBSEQUE": true,
    //     "MIXTE": true,
    //     "Requis": [
    //       {
    //           "Deces": true,
    //           "Invalidite": false,
    //           "Accidentel": false,
    //           "InhumationEuLieu": false,
    //           "MobileMoney_Paiement": false,
    //           "Virement_Bancaire": false,
    //       }
    //     ]
    //   },

    // {
    //     "idfichier": 11,
    //     "CodeDoc": "CERTIF_NON_APPEL",
    //     "libelleFichier": "Certificat de non appel à l’acte de notoriété (tribunal)",
    //     "listDoc": [
    //       { "codeDoc": "DOC_CERTIF_NON_APPEL", "libelleDoc": "Certificat de non appel" }
    //     ],
    //     "Deces": true,
    //     "Invalidite": false,
    //     "InvaliditeTotale": false,
    //     "InvaliditePartielle": false,
    //     "Accidentel": false,
    //     "InhumationEuLieu": false,
    //     "DecesSouscripteur": true,
    //     "MobileMoney_Paiement": false,
    //     "Virement_Bancaire": false,
    //     "EPARGNE": true,
    //     "OBSEQUE": true,
    //     "MIXTE": true,
    //     "Requis": [
    //       {
    //           "Deces": true,
    //           "Invalidite": false,
    //           "Accidentel": false,
    //           "InhumationEuLieu": false,
    //           "MobileMoney_Paiement": false,
    //           "Virement_Bancaire": false,
    //       }
    //     ]
    //   },

    // {
    //     "idfichier": 10,
    //     "CodeDoc": "ACTE_NOTORIETE",
    //     "libelleFichier": "Acte de notoriété (tribunal) si bénéficiaire(s) non désigné(s)",
    //     "listDoc": [
    //       { "codeDoc": "DOC_ACTE_NOTORIETE", "libelleDoc": "Acte de notoriété" }
    //     ],
    //     "Deces": true,
    //     "Invalidite": false,
    //     "InvaliditeTotale": false,
    //     "InvaliditePartielle": false,
    //     "Accidentel": false,
    //     "InhumationEuLieu": false,
    //     "DecesSouscripteur": true,
    //     "MobileMoney_Paiement": false,
    //     "Virement_Bancaire": false,
    //     "EPARGNE": true,
    //     "OBSEQUE": true,
    //     "MIXTE": true,
    //     "Requis": [
    //       {
    //           "Deces": false,
    //           "Invalidite": false,
    //           "Accidentel": false,
    //           "InhumationEuLieu": false,
    //           "MobileMoney_Paiement": false,
    //           "Virement_Bancaire": false,
    //       }
    //     ]
    //   },

    // {
    //     "idfichier": 12,
    //     "CodeDoc": "CERTIF_TUTELLE",
    //     "libelleFichier": "Certificat de tutelle ou administration légale (tribunal) si bénéficiaire(s) mineur(s) ou invalide",
    //     "listDoc": [
    //       { "codeDoc": "DOC_CERTIF_TUTELLE", "libelleDoc": "Certificat de tutelle ou administration légale" }
    //     ],
    //     "Deces": true,
    //     "Invalidite": true,
    //     "InvaliditeTotale": true,
    //     "InvaliditePartielle": true,
    //     "Accidentel": false,
    //     "InhumationEuLieu": false,
    //     "DecesSouscripteur": true,
    //     "MobileMoney_Paiement": false,
    //     "Virement_Bancaire": false,
    //     "EPARGNE": true,
    //     "OBSEQUE": true,
    //     "MIXTE": true,
    //     "Requis": [
    //       {
    //           "Deces": false,
    //           "Invalidite": false,
    //           "Accidentel": false,
    //           "InhumationEuLieu": false,
    //           "MobileMoney_Paiement": false,
    //           "Virement_Bancaire": false,
    //       }
    //     ]
    //   },
];
  
document.addEventListener('DOMContentLoaded', function () {
    // console.log('documents : ',documents)
    let form = document.getElementById("sinistreForm");
    // console.log('form : ',form)
    const docsListTable = document.getElementById('docsListTable');
    const contratDetails = sessionStorage.getItem('Details');
    const contratDetailsObj = JSON.parse(contratDetails);

    const msgCarrenceError = $('#msgCarrenceError');
    const msgCarrenceSuccess = $('#msgCarrenceSuccess');
    msgCarrenceError.text("").hide();
    msgCarrenceSuccess.text("").hide();

    // affichage des éléments en fonction de la nature du sinistre
    const natureSinistreDecesCheckbox = document.getElementById('natureDeces');
    const dateSinistre = document.getElementById('dateSinistre');
    const natureSinistreInvaliditeCheckbox = document.getElementById('natureInvalidite');
    const corpsConserveRadios = document.querySelectorAll('input[name="corpsConserve"]');
    const sinistreCentreHospitalierRadios = document.querySelectorAll('input[name="sinistreCentreHospitalier"]');
    const CodeFiliatioAssure = document.getElementById('CodeFiliatioAssure').value;
    const decesAccidentelRadios = document.querySelectorAll('input[name="decesAccidentel"]');
    const declarationTardiveRadios = document.querySelectorAll('input[name="declarationTardive"]');
    const natureSinistreRadios = document.querySelectorAll('input[name="natureSinistre"]');
    const paiementMethodRadios = form.querySelectorAll('input[name="moyenPaiement"]')
    // IDs des éléments à afficher ou masquer
    const elementsDeces = ['typeDecesBlock', 'corpsConserveBlock', 'montantBONBlock', 'dateLieuLeveeBlock', 'dateLieuInhumationBlock'];
    const elementsInvalidite = [];

    setRequired(['natureSinistre']);
    setRequired(['sinistreCentreHospitalier']);

    let DateEffetReel = new Date(contratDetailsObj.contratDetails.DateEffetReel);
    let DelaiCarrenceMois = parseInt(contratDetailsObj.contratDetails.DelaiCarrence);
    let typeContrat = contratDetailsObj.contratDetails.TypeContrat;
    // let CodeFiliation = contratDetailsObj.contratDetails.CodeFiliation;

    // Ajouter le delai de carrence en mois
    let DelaiCarrence = new Date(DateEffetReel);
    DelaiCarrence.setMonth(DelaiCarrence.getMonth() + DelaiCarrenceMois);
    
    // Affichage formaté
    let DateEffetReelFormat = DateEffetReel.toLocaleDateString('fr-FR');
    let DelaiCarrenceFormat = DelaiCarrence.toLocaleDateString('fr-FR');
   
    const codeProduitYAKO = ['YKE_2008','YKE_2018','YKS_2008','YKS_2018','YKF_2008','YKF_2018','YKR_2021'];
    dateSinistre.readOnly = true;

    const dateLeveeInput = document.getElementById('dateLevee');
    const dateInhumationInput = document.getElementById('dateInhumation');

    dateLeveeInput.addEventListener('input', function () {
        const selectedDate = this.value;
        dateInhumationInput.min = selectedDate;

        // Si une date d'inhumation est déjà sélectionnée mais est antérieure à la levée
        if (dateInhumationInput.value && dateInhumationInput.value < selectedDate) {
            dateInhumationInput.value = selectedDate;
        }
    });

    function toggleElements() {
        const isDecesChecked = natureSinistreDecesCheckbox.checked;
        const isInvaliditeChecked = natureSinistreInvaliditeCheckbox.checked;
    
        if (isDecesChecked) {
            showElements(elementsDeces);
            hideElements(elementsInvalidite);
            
            dateSinistre.readOnly = true;
            setRequired(['decesAccidentel', 'corpsConserve','dateSinistre', 'causeSinistre','dateLevee', 'lieuLevee', 'dateInhumation', 'lieuInhumation']);
            removeRequired([]);
            elementsInvalidite.forEach(id => clearChamps('#etapeSinistre3', `#${id} input, #${id} select, #${id} textarea`));
            clearChamps('#etapeSinistre3', `#dateSinistreBlock input`)
        } 
        else if (isInvaliditeChecked) {
            showElements(elementsInvalidite);
            hideElements(elementsDeces);
    
            dateSinistre.readOnly = false;
            setRequired(['dateSinistre','causeSinistre']);
            removeRequired(['decesAccidentel', 'corpsConserve', 'declarationTardive', 'lieuConservation', 'dateLevee', 'lieuLevee', 'dateInhumation', 'lieuInhumation']);
            elementsDeces.forEach(id => clearChamps('#etapeSinistre3', `#${id} input, #${id} select, #${id} textarea`));
            clearChamps('#etapeSinistre3', `#dateSinistreBlock input`)
        } 
        else {
            hideElements(elementsDeces.concat(elementsInvalidite));
            removeRequired(['decesAccidentel', 'corpsConserve', 'declarationTardive', 'dateSinistre', 'causeSinistre', 'lieuConservation', 'dateLevee', 'lieuLevee', 'dateInhumation', 'lieuInhumation']);
            elementsDeces.forEach(id => clearChamps('#etapeSinistre3', `#${id} input, #${id} select, #${id} textarea`));
            clearChamps('#etapeSinistre3', `#dateSinistreBlock input`)
            elementsInvalidite.forEach(id => clearChamps('#etapeSinistre3', `#${id} input, #${id} select, #${id} textarea`));
        }
    }
    

    // Validation unique sur la date du sinistre
    dateSinistre.addEventListener('input', function () {
        const dateSinistreValue = this.value;
        const selectedDate = new Date(dateSinistreValue);

        dateLeveeInput.min = dateSinistreValue;
        // Si une date de la levée est déjà sélectionnée mais est antérieure à la date du sinistre
        if (dateLeveeInput.value && dateLeveeInput.value < dateSinistreValue) {
            dateLeveeInput.value = dateSinistreValue;
        }
        if (isNaN(selectedDate)) {
            msgCarrenceError.text("Veuillez saisir une date.").show();
            msgCarrenceSuccess.text("").hide();
            return;
        }

        const isDecesChecked = natureSinistreDecesCheckbox.checked;
        let decesAccidentel = null;
        if(isDecesChecked){
            decesAccidentel = document.querySelector('input[name="decesAccidentel"]:checked')?.value;
        }
        let declarationTardive = null;
        if(isDecesChecked){
            declarationTardive = document.querySelector('input[name="declarationTardive"]:checked')?.value;
        }
        // Vérifie délai de carence uniquement pour décès non accidentel
        if (
            selectedDate < DelaiCarrence &&
            codeProduitYAKO.includes(contratDetailsObj.contratDetails.codeProduit) &&
            isDecesChecked &&
            decesAccidentel == 0
        ) {
            const btnSuivant = document.getElementById("next-PaiementStep");
            btnSuivant.disabled = true;
            msgCarrenceError.text('Le sinistre est survenu dans le délai de carence.').show();
            msgCarrenceSuccess.text('').hide();
        } else {
            const btnSuivant = document.getElementById("next-PaiementStep");
            btnSuivant.disabled = false;
            msgCarrenceError.text('').hide();
            msgCarrenceSuccess.text('La déclaration du sinistre est recevable.').show();
        }
    });

    // --- Définition des types de contrat ---
    // Contrats d'épargne (codes EPA et CAPI)
    const TypeContratEpagne = ['EPA', 'CAPI'];

    // Contrats obsèques (codes KDEC et KVIE)
    const TypeContratObseque = ['KDEC', 'KVIE'];
    function getToShowDocuments(natureSinistre, decesAccidentel, corpsConserve, declarationTardive, typeContrat, CodeFiliation, PaiementMethod) {
        // Réinitialiser l'affichage
        docsListTable.innerHTML = '';
        let documentsToShow = [...documents]; // copie
    
        // --- CAS 1 : SINISTRE = DÉCÈS ---
        if (natureSinistre == 'Deces') {
            documentsToShow = documentsToShow.filter(doc => doc.Deces);
            // console.log("Après filtre Deces :", documentsToShow);
        
            if (typeContrat == 'MIXTE') {
                documentsToShow = documentsToShow.filter(doc =>doc.Deces || doc.MIXTE);
                // console.log("Après filtre MIXTE :", documentsToShow);
            }
        
            if (TypeContratEpagne.includes(typeContrat)) {
                documentsToShow = documentsToShow.filter(doc => doc.EPARGNE || doc.Deces);
                // console.log("Après filtre EPARGNE :", documentsToShow);
            }
        
            if (TypeContratObseque.includes(typeContrat)) {
                documentsToShow = documentsToShow.filter(doc => doc.Deces && doc.OBSEQUE);
                // console.log("Après filtre OBSEQUE :", documentsToShow);
            }
        
            if (decesAccidentel == 1) {
                // garde les docs actuels ET ajoute ceux où Accidentel = true
                documentsToShow = [
                    ...documentsToShow,
                    ...documents.filter(doc => doc.Accidentel)
                ];
                // supprime les doublons (même idfichier)
                documentsToShow = documentsToShow.filter((doc, index, self) =>
                    index === self.findIndex(d => d.idfichier === doc.idfichier)
                );
                // console.log("Après filtre Accidentel = 1:", documentsToShow);
            } else if (decesAccidentel == 0) {
                // retire les documents où Accidentel = true
                documentsToShow = documentsToShow.filter(doc => !doc.Accidentel);
                // console.log("Après filtre Accidentel = 0:", documentsToShow);
            }

            
            if (corpsConserve == 1) {
                // garde les docs actuels ET ajoute ceux où CorpsConserveOui = true
                documentsToShow = [
                    ...documentsToShow,
                    ...documents.filter(doc => doc.CorpsConserveOui)
                ];
                documentsToShow = documentsToShow.filter((doc, index, self) =>
                    index === self.findIndex(d => d.idfichier === doc.idfichier)
                );
                 // retire les documents où CorpsConserveNon = true
                 documentsToShow = documentsToShow.filter(doc => !doc.CorpsConserveNon);
            } else if (corpsConserve == 0) {
                // retire les documents où CorpsConserveOui = true
                documentsToShow = documentsToShow.filter(doc => !doc.CorpsConserveOui);

                 // garde les docs actuels ET ajoute ceux où CorpsConserveNon = true
                 documentsToShow = [
                    ...documentsToShow,
                    ...documents.filter(doc => doc.CorpsConserveNon)
                ];
                documentsToShow = documentsToShow.filter((doc, index, self) =>
                    index === self.findIndex(d => d.idfichier === doc.idfichier)
                );
            }

            if (declarationTardive == 1) {
                // garde les docs actuels ET ajoute ceux où InhumationEuLieu = true
                documentsToShow = [
                    ...documentsToShow,
                    ...documents.filter(doc => doc.InhumationEuLieu)
                ];
                documentsToShow = documentsToShow.filter((doc, index, self) =>
                    index === self.findIndex(d => d.idfichier === doc.idfichier)
                );
                // console.log("Après filtre InhumationEuLieu = 1:", documentsToShow);
            } else if (declarationTardive == 0) {
                // retire les documents où InhumationEuLieu = true
                documentsToShow = documentsToShow.filter(doc => !doc.InhumationEuLieu);
                // console.log("Après filtre InhumationEuLieu = 0:", documentsToShow);
            }

            if (PaiementMethod == 'Mobile_Money') {
                // garde les docs actuels ET ajoute ceux où MobileMoney_Paiement = true
                documentsToShow = [
                    ...documentsToShow,
                    ...documents.filter(doc => doc.MobileMoney_Paiement)
                ];
                // supprime les doublons (même idfichier)
                documentsToShow = documentsToShow.filter((doc, index, self) =>
                    index === self.findIndex(d => d.idfichier === doc.idfichier)
                );
                // retire les documents où Virement_Bancaire = true
                documentsToShow = documentsToShow.filter(doc => !doc.Virement_Bancaire);
            } else if (PaiementMethod == 'Virement_Bancaire') {
                // garde les docs actuels ET ajoute ceux où Virement_Bancaire = true
                documentsToShow = [
                    ...documentsToShow,
                    ...documents.filter(doc => doc.Virement_Bancaire)
                ];
                // supprime les doublons (même idfichier)
                documentsToShow = documentsToShow.filter((doc, index, self) =>
                    index === self.findIndex(d => d.idfichier === doc.idfichier)
                );
                // retire les documents où MobileMoney_Paiement = true
                documentsToShow = documentsToShow.filter(doc => !doc.MobileMoney_Paiement);
            }
            // Cas combinés
            if (decesAccidentel == 1 && declarationTardive == 1) {
                // ajoute uniquement ceux qui ont Accidentel = true ET InhumationEuLieu = true
                documentsToShow = [
                    ...documentsToShow,
                    ...documents.filter(doc => doc.Accidentel && doc.InhumationEuLieu)
                ];
                documentsToShow = documentsToShow.filter((doc, index, self) =>
                    index === self.findIndex(d => d.idfichier === doc.idfichier)
                );
                // console.log("Après filtre Accidentel = 1 ET InhumationEuLieu = 1:", documentsToShow);
            }
            
            if (decesAccidentel == 0 && declarationTardive == 1) {
                // retire Accidentel mais ajoute InhumationEuLieu
                documentsToShow = documentsToShow.filter(doc => !doc.Accidentel);
                documentsToShow = [
                    ...documentsToShow,
                    ...documents.filter(doc => doc.InhumationEuLieu)
                ];
                documentsToShow = documentsToShow.filter((doc, index, self) =>
                    index === self.findIndex(d => d.idfichier === doc.idfichier)
                );
                // console.log("Après filtre Accidentel = 0 ET InhumationEuLieu = 1:", documentsToShow);
            }
            
            if (decesAccidentel == 1 && declarationTardive == 0) {
                // ajoute Accidentel mais retire InhumationEuLieu
                documentsToShow = [
                    ...documentsToShow,
                    ...documents.filter(doc => doc.Accidentel)
                ];
                documentsToShow = documentsToShow.filter(doc => !doc.InhumationEuLieu);
                documentsToShow = documentsToShow.filter((doc, index, self) =>
                    index === self.findIndex(d => d.idfichier === doc.idfichier)
                );
                // console.log("Après filtre Accidentel = 1 ET InhumationEuLieu = 0:", documentsToShow);
            }
            
            if (decesAccidentel == 0 && declarationTardive == 0) {
                // retire Accidentel et InhumationEuLieu
                documentsToShow = documentsToShow.filter(doc => !doc.Accidentel && !doc.InhumationEuLieu);
                // console.log("Après filtre Accidentel = 0 ET InhumationEuLieu = 0:", documentsToShow);
            }            
        }        
    
        // --- CAS 2 : SINISTRE = INVALIDITÉ ---
        else if (natureSinistre == 'Invalidite') {
            documentsToShow = documentsToShow.filter(doc => doc.Invalidite);
            // console.log("Après filtre Invalidite :", documentsToShow);

            if (PaiementMethod == 'Mobile_Money') {
                // garde les docs actuels ET ajoute ceux où MobileMoney_Paiement = true
                documentsToShow = [
                    ...documentsToShow,
                    ...documents.filter(doc => doc.MobileMoney_Paiement)
                ];
                // supprime les doublons (même idfichier)
                documentsToShow = documentsToShow.filter((doc, index, self) =>
                    index === self.findIndex(d => d.idfichier === doc.idfichier)
                );
                // retire les documents où Virement_Bancaire = true
                documentsToShow = documentsToShow.filter(doc => !doc.Virement_Bancaire);
            } else if (PaiementMethod == 'Virement_Bancaire') {
                // garde les docs actuels ET ajoute ceux où Virement_Bancaire = true
                documentsToShow = [
                    ...documentsToShow,
                    ...documents.filter(doc => doc.Virement_Bancaire)
                ];
                // supprime les doublons (même idfichier)
                documentsToShow = documentsToShow.filter((doc, index, self) =>
                    index === self.findIndex(d => d.idfichier === doc.idfichier)
                );
                // retire les documents où MobileMoney_Paiement = true
                documentsToShow = documentsToShow.filter(doc => !doc.MobileMoney_Paiement);
            }
        }
    
        if (documentsToShow.length > 0) {

            // 1) Générer le HTML
            documentsToShow.forEach((doc) => {
                const requis = Array.isArray(doc.Requis) ? doc.Requis[0] : doc.Requis;
                const isRequired = requis.Deces || requis.Invalidite || requis.Accidentel || requis.InhumationEuLieu;
            
                let row = '';
            
                // Si le document est pour chaque bénéficiaire
                if (doc.CodeDoc === 'ID_BENEFICIAIRE') {
                    row = beneficiaires.map((ben) => `
                        <tr data-docid="${doc.idfichier}_${ben.IdPropositionPartenaires}" data-row-required="${isRequired ? '1' : '0'}">
                            <td class="align-middle">
                                <div class="text-wrap">
                                    ${doc.libelleFichier} ${ben.PrenomAssu} ${ben.nomAssu} ${isRequired ? '<span class="star">*</span>' : ''}
                                </div>
                            </td>
            
                            <td>
                                <ul class="list-grou">
                                    ${doc.listDoc.length > 1
                                        ? `
                                            <label>Veuillez choisir le document en votre possession ${isRequired ? '<span class="star">*</span>' : ''}</label>
                                            ${doc.listDoc.map((d) => `
                                                <li class="list-group-ite">
                                                    <input type="radio"
                                                        id="${d.codeDoc}_${ben.IdPropositionPartenaires}"
                                                        name="docLibelle[${doc.idfichier}_${ben.IdPropositionPartenaires}]"
                                                        value="${d.libelleDoc} ${ben.PrenomAssu} ${ben.nomAssu}"
                                                        class="doc-radio"
                                                        data-target="libelle-${doc.idfichier}_${ben.IdPropositionPartenaires}">
                                                    <label for="${d.codeDoc}_${ben.IdPropositionPartenaires}">${d.libelleDoc}</label>
                                                </li>
                                            `).join('')}
                                        `
                                        : `
                                            <li class="list-group-ite">
                                                <input type="radio"
                                                    id="${doc.listDoc[0].codeDoc}_${ben.IdPropositionPartenaires}"
                                                    name="docLibelle[${doc.idfichier}_${ben.IdPropositionPartenaires}]"
                                                    value="${doc.listDoc[0].libelleDoc} ${ben.PrenomAssu} ${ben.nomAssu}"
                                                    class="doc-radio"
                                                    data-target="libelle-${doc.idfichier}_${ben.IdPropositionPartenaires}"
                                                    ${isRequired ? 'checked' : ''}>
                                                <label for="${doc.listDoc[0].codeDoc}_${ben.IdPropositionPartenaires}">${doc.listDoc[0].libelleDoc}</label>
                                            </li>
                                        `}
                                </ul>
                            </td>
            
                            <td class="align-middle text-center">
                                <div class="file-input d-flex align-items-center justify-content-center">
                                    <input type="hidden" id="libelle-${doc.idfichier}_${ben.IdPropositionPartenaires}" name="libelle[]" value="">
                                    <input type="file"
                                        id="file-${doc.idfichier}_${ben.IdPropositionPartenaires}"
                                        name="docFile[]"
                                        accept=".pdf,.png,.jpg,.jpeg"
                                        hidden
                                        data-file-required="${isRequired ? '1' : '0'}">
            
                                    <button type="button"
                                            class="btn-prime btn-prime-two p-2 addFileBtn"
                                            data-target="file-${doc.idfichier}_${ben.IdPropositionPartenaires}">
                                        <i class='bx bx-download fs-5'></i>
                                    </button>
                                </div>
                                <div class="file-preview-container mt-2 d-flex align-items-center justify-content-center">
                                    <span class="file-preview ms-2 text-muted small"></span>
                                </div>
                            </td>
                        </tr>
                    `).join('');
                } else {
                    // Document générique (non lié à un bénéficiaire spécifique)
                    row = `
                        <tr data-docid="${doc.idfichier}" data-row-required="${isRequired ? '1' : '0'}">
                            <td class="align-middle">
                                <div class="text-wrap">${doc.libelleFichier} ${isRequired ? '<span class="star">*</span>' : ''}</div>
                            </td>
            
                            <td>
                                <ul class="list-grou">
                                    ${doc.listDoc.length > 1
                                        ? `
                                            <label>Veuillez choisir le document en votre possession ${isRequired ? '<span class="star">*</span>' : ''}</label>
                                            ${doc.listDoc.map((d) => `
                                                <li class="list-group-ite">
                                                    <input type="radio"
                                                        id="${d.codeDoc}"
                                                        name="docLibelle[${doc.idfichier}]"
                                                        value="${d.libelleDoc}"
                                                        class="doc-radio"
                                                        data-target="libelle-${doc.idfichier}">
                                                    <label for="${d.codeDoc}">${d.libelleDoc}</label>
                                                </li>
                                            `).join('')}
                                        `
                                        : `
                                            <li class="list-group-ite">
                                                <input type="radio"
                                                    id="${doc.listDoc[0].codeDoc}"
                                                    name="docLibelle[${doc.idfichier}]"
                                                    value="${doc.listDoc[0].libelleDoc}"
                                                    class="doc-radio"
                                                    data-target="libelle-${doc.idfichier}"
                                                    ${isRequired ? 'checked' : ''}>
                                                <label for="${doc.listDoc[0].codeDoc}">${doc.listDoc[0].libelleDoc}</label>
                                            </li>
                                        `}
                                </ul>
                            </td>
            
                            <td class="align-middle text-center">
                                <div class="file-input d-flex align-items-center justify-content-center">
                                    <input type="hidden" id="libelle-${doc.idfichier}" name="libelle[]" value="">
                                    <input type="file"
                                        id="file-${doc.idfichier}"
                                        name="docFile[]"
                                        accept=".pdf,.png,.jpg,.jpeg"
                                        hidden
                                        data-file-required="${isRequired ? '1' : '0'}">
            
                                    <button type="button"
                                            class="btn-prime btn-prime-two p-2 addFileBtn"
                                            data-target="file-${doc.idfichier}">
                                        <i class='bx bx-download fs-5'></i>
                                    </button>
                                </div>
                                <div class="file-preview-container mt-2 d-flex align-items-center justify-content-center">
                                    <span class="file-preview ms-2 text-muted small"></span>
                                </div>
                            </td>
                        </tr>
                    `;
                }
            
                docsListTable.innerHTML += row;
            });

            // 2) Ouvrir le file dialog quand on clique sur le bouton (une seule fois par bouton)
            document.querySelectorAll(".addFileBtn").forEach(btn => {
                const inputId = btn.getAttribute("data-target");
                const fileInput = document.getElementById(inputId);
                if (!fileInput) return;
                // bouton ouvre la dialog
                btn.addEventListener("click", () => fileInput.click());
            });


            // Créer le modal une seule fois dans le DOM
            if (!document.getElementById("previewFileSinistreModal")) {
                const modal = document.createElement("div");
                modal.innerHTML = `
                    <div class="modal fade" id="previewFileSinistreModal" tabindex="-1">
                        <div class="modal-dialog modal-dialog-centered modal-lg">
                            <div class="modal-content">
                                <div class="modal-body text-center">
                                    <img id="previewImage" src="" class="img-fluid" alt="Aperçu">
                                    <iframe id="previewPDF" style="display:none;width:100%;height:500px;" frameborder="0"></iframe>
                                </div>
                            </div>
                        </div>
                    </div>
                `;
                document.body.appendChild(modal);
            }
            // 3) Mettre à jour l'aperçu du fichier (attaché une seule fois par input)
            document.querySelectorAll("input[type='file']").forEach(fileInput => {
                fileInput.addEventListener("change", function () {
                    // récupérer la div preview qui est sœur
                    const previewWrapper = this.closest("td").querySelector(".file-preview-container");
                    const previewContainer = previewWrapper.querySelector(".file-preview");
                    previewContainer.innerHTML = ""; // reset
            
                    if (this.files && this.files.length > 0) {
                        const file = this.files[0];
                        const fileURL = URL.createObjectURL(file);
            
                        if (file.type.startsWith("image/")) {
                            // Créer miniature image
                            const img = document.createElement("img");
                            img.src = fileURL;
                            img.style.width = "100px";
                            img.style.height = "100px";
                            img.style.border = "1px solid #ccc";
                            img.style.objectFit = "cover";
                            img.style.cursor = "pointer";
            
                            // clic pour ouvrir modal
                            img.addEventListener("click", function () {
                                document.getElementById("previewPDF").style.display = "none";
                                document.getElementById("previewImage").style.display = "block";
                                document.getElementById("previewImage").src = fileURL;
                                new bootstrap.Modal(document.getElementById("previewFileSinistreModal")).show();
                            });
            
                            previewContainer.appendChild(img);
            
                        } else if (file.type === "application/pdf") {
                            // Miniature PDF (icône)
                            const pdfIcon = document.createElement("div");
                            pdfIcon.textContent = "📄 PDF";
                            // pdfIcon.src = fileURL;
                            pdfIcon.style.width = "100px";
                            pdfIcon.style.height = "100px";
                            pdfIcon.style.border = "1px solid #ccc";
                            pdfIcon.style.display = "flex";
                            pdfIcon.style.alignItems = "center";
                            pdfIcon.style.justifyContent = "center";
                            pdfIcon.style.cursor = "pointer";
                            pdfIcon.style.background = "#f8f9fa";
            
                            pdfIcon.addEventListener("click", function () {
                                document.getElementById("previewImage").style.display = "none";
                                document.getElementById("previewPDF").style.display = "block";
                                document.getElementById("previewPDF").src = fileURL;
                                new bootstrap.Modal(document.getElementById("previewFileSinistreModal")).show();
                            });
            
                            previewContainer.appendChild(pdfIcon);
                        } else {
                            previewContainer.textContent = file.name;
                        }
                    }
                });
            });
            
            // 4) Synchroniser radio -> champ hidden libelle-...
            document.addEventListener("change", function (e) {
                if (e.target && e.target.classList && e.target.classList.contains("doc-radio")) {
                    const targetInputId = e.target.dataset.target;
                    const inputHidden = document.getElementById(targetInputId);
                    if (inputHidden) inputHidden.value = e.target.value;
                }
            });

            // 5) Initialiser les hidden avec la radio cochée au chargement
            document.querySelectorAll(".doc-radio").forEach(radio => {
                if (radio.checked) {
                    const hid = document.getElementById(radio.dataset.target);
                    if (hid) hid.value = radio.value;
                }
            });

            // 6) Validation personnalisée au submit (Swal)
            // dans create.blade.php

        } else {
            docsListTable.innerHTML = `
                <tr>
                    <td colspan="3" class="text-center">Aucun document requis</td>
                </tr>`;
        }
    }
    

     function showElements(ids) {
         ids.forEach(id => {
             const element = document.getElementById(id);
             if (element) {
                 element.classList.remove('d-none');
             }
         });
     }
 
     // Fonction pour masquer des éléments
     function hideElements(ids) {
         ids.forEach(id => {
             const element = document.getElementById(id);
             if (element) {
                 element.classList.add('d-none');
             }
         });
     }
 
     // Fonctions pour gérer les champs requis
     function setRequired(fields) {
         fields.forEach(id => {
             const field = document.getElementById(id) || document.querySelector(`input[name="${id}"]`);
             if (field) field.setAttribute('required', true);
         });
     }
 
     function removeRequired(fields) {
         fields.forEach(id => {
             const field = document.getElementById(id) || document.querySelector(`input[name="${id}"]`);
             if (field) field.removeAttribute('required');
         });
     }

     // Fonction pour vérifier une étape
    function verifierEtape(etapeId) {
        const etape = document.querySelector(etapeId);
        if (!etape) return;

        const btnSuivant = etape.querySelector(".next-step-btn");
        const champsRequis = etape.querySelectorAll("input[required], select[required], textarea[required]");
        let valide = true;

        champsRequis.forEach(champ => {
            if ((champ.type === "radio" || champ.type === "checkbox")) {
                // Vérifie si au moins une option du groupe est cochée
                const groupChecked = etape.querySelector(`input[name="${champ.name}"]:checked`);
                if (!groupChecked) {
                    valide = false;
                }
            } else if (!champ.value.trim()) {
                valide = false;
            }
        });

        // Affiche ou cache le bouton
        if (valide) {
            btnSuivant.classList.remove("d-none");
        } else {
            btnSuivant.classList.add("d-none");
        }
    }

    function clearChamps(etapeId, champsSelector) {
        const etape = document.querySelector(etapeId);
        if (!etape) return;
        const champs = etape.querySelectorAll(champsSelector);
        champs.forEach(champ => {
            if (champ.type === "radio" || champ.type === "checkbox") {
                champ.checked = false; // décoche systématiquement
            } else {
                champ.value = ""; // vide la valeur (input, textarea, select)
            }
        });
    }
    // Vérifie en live sur tous les champs d'une étape
    function activerSurveillance(etapeId) {
        const etape = document.querySelector(etapeId);
        if (!etape) return;

        const champs = etape.querySelectorAll("input, select, textarea");
        champs.forEach(champ => {
            champ.addEventListener("input", () => verifierEtape(etapeId));
            champ.addEventListener("change", () => verifierEtape(etapeId));
        });
    }

    function toggleDateSinistre() {
        // Vérifie si un radio est coché
        const checkedRadio = document.querySelector('input[name="decesAccidentel"]:checked');
        if (checkedRadio) {
            dateSinistre.readOnly = false; // un choix est fait → champ activé
        } else {
            dateSinistre.readOnly = true; // rien choisi → champ bloqué
        }
        dateSinistre.value = ''
        msgCarrenceError.text("Veuillez saisir une date").show();
        msgCarrenceSuccess.text("").hide();
    }

    function toggleCorpsConserve(){
        const corpsConserveChecked = document.querySelector('input[name="corpsConserve"]:checked')?.value || null;
        const lieuConservation = document.querySelector('input[name="lieuConservation"]');
        
        if (corpsConserveChecked == 1) {
            showElements(['declarationTardiveBlock', 'lieuConservationBlock']);
            setRequired(['declarationTardive', 'lieuConservation']);
            removeRequired([]);
        } else if (corpsConserveChecked == 0) {
            showElements(['declarationTardiveBlock']);
            hideElements(['lieuConservationBlock']);
            setRequired(['declarationTardive']);
            removeRequired(['lieuConservation']);
            lieuConservation.value = '';
        }
        else {
            hideElements(['declarationTardiveBlock', 'lieuConservationBlock']);
            removeRequired(['declarationTardive', 'lieuConservation']);
        }
    }
    function togglesinistreCentreHospitalier(){
        const sinistreCentreHospitalierChecked = document.querySelector('input[name="sinistreCentreHospitalier"]:checked')?.value || null;
        const centresMedicaux = document.querySelector('input[name="centresMedicaux"]');
        
        if (sinistreCentreHospitalierChecked == 1 || sinistreCentreHospitalierChecked == 0) {
            showElements(['centresMedicauxBlock']);
            setRequired(['centresMedicaux']);
            removeRequired([]);
            centresMedicaux.value = '';
        } else {
            hideElements(['centresMedicauxBlock']);
            removeRequired(['centresMedicaux']);
            centresMedicaux.value = '';
        }
    }

    function toggleDocuments() {
        const isDecesChecked = natureSinistreDecesCheckbox.checked;
        const isInvaliditeChecked = natureSinistreInvaliditeCheckbox.checked;
        const accidentelChecked = document.querySelector('input[name="decesAccidentel"]:checked')?.value ?? null;
        const declarationTardiveChecked = document.querySelector('input[name="declarationTardive"]:checked')?.value ?? null;
        const corpsConserveChecked = document.querySelector('input[name="corpsConserve"]:checked')?.value ?? null;
        const paiementMethodChecked = form.querySelector('input[name="moyenPaiement"]:checked')?.value ?? null;
        
        if (isDecesChecked) {
            getToShowDocuments("Deces", accidentelChecked, corpsConserveChecked, declarationTardiveChecked, typeContrat, CodeFiliatioAssure, paiementMethodChecked);
        } else if (isInvaliditeChecked) {
            getToShowDocuments("Invalidite", accidentelChecked, corpsConserveChecked, declarationTardiveChecked, typeContrat, CodeFiliatioAssure, paiementMethodChecked);
        } 
    }
 
     // Ajoute les écouteurs d'événements
    natureSinistreDecesCheckbox.addEventListener('change', () => {
        toggleElements();
        toggleDocuments();
        toggleCorpsConserve();
        togglesinistreCentreHospitalier();
    });
    natureSinistreInvaliditeCheckbox.addEventListener('change', () => {
        toggleElements();
        toggleDocuments();
        toggleCorpsConserve();
        togglesinistreCentreHospitalier();
    });
    
    decesAccidentelRadios.forEach(radio => {
        radio.addEventListener('change', toggleDateSinistre);
        radio.addEventListener('change', toggleDocuments);
        radio.addEventListener('change', () => verifierEtape("#etapeSinistre3"));
    });
    corpsConserveRadios.forEach(radio => {
        // radio.addEventListener('change', toggleElements);
        radio.addEventListener('change', toggleDocuments);
        radio.addEventListener('change', toggleCorpsConserve);
    });
    sinistreCentreHospitalierRadios.forEach(radio => {
        radio.addEventListener('change', togglesinistreCentreHospitalier);
    });
    paiementMethodRadios.forEach(radio => {
        radio.addEventListener('change', toggleDocuments);
    });
    declarationTardiveRadios.forEach(radio => {
        radio.addEventListener('change', toggleDocuments);
        radio.addEventListener('change', () => verifierEtape("#etapeSinistre3"));
    });


    

    if (form) {
        const moyenPaiementInputs = form.querySelectorAll('input[name="moyenPaiement"]');
        const operateurSection = form.querySelector('#Operateur');
         // console.log('form : ',form)
         const ibanPaiementSection     = form.querySelector('#IBANPaiement');
         const telPaiementSection      = form.querySelector('#TelephonePaiement');
         const telPaiementField        = form.querySelector('#TelPaiement');
        const ibanPaiementField       = form.querySelector('#IBAN');
        const ibanField               = form.querySelectorAll('.rib-input');
        const confirmTelPaiementField = form.querySelector('#ConfirmTelPaiement');
        const operateurInputs         = form.querySelectorAll('input[name="Operateur"]');

        // jQuery messages (doivent exister dans le HTML)
        const ibanMsgError       = form.querySelector('#ibanMsgError');
        const ibanMsgSuccess     = form.querySelector('#ibanMsgSuccess');
        const telMsgError        = form.querySelector('#telMsgError');
        const telMsgSuccess      = form.querySelector('#telMsgSuccess');
        const telConfirmMsgError = form.querySelector('#telConfirmMsgError');
        const telConfirmMsgSuccess = form.querySelector('#telConfirmMsgSuccess');
        const nextStepBtn        = form.querySelector('#nextStepBtn');
 
         // jQuery messages (doivent exister dans le HTML)
        // alert('form')

        function reinitIBAN() {
            // reinitiaser tous les champs
            ibanField.forEach(input => {
                input.value = "";
                input.classList.remove('is-invalid');
                input.classList.remove('is-valid');
            });
            ibanPaiementField.value = "";
            ibanMsgError.textContent = "";
            ibanMsgError.style.display = "none";
            ibanMsgSuccess.textContent = "";
            ibanMsgSuccess.style.display = "none";
            nextStepBtn.disabled = true;
        }
        function reinitTel() {
            // reinitialiser tous les champs
            telPaiementField.value = "";
            telPaiementField.disabled = true;
            telPaiementField.classList.remove('is-invalid');
            telPaiementField.classList.remove('is-valid');
            confirmTelPaiementField.value = "";
            confirmTelPaiementField.disabled = true;
            confirmTelPaiementField.classList.remove('is-invalid');
            confirmTelPaiementField.classList.remove('is-valid');
            telMsgError.textContent = "";
            telMsgError.style.display = "none";
            telMsgSuccess.textContent = "";
            telMsgSuccess.style.display = "none";
            telConfirmMsgError.textContent = "";
            telConfirmMsgError.style.display = "none";
            telConfirmMsgSuccess.textContent = "";
            telConfirmMsgSuccess.style.display = "none";
            operateurInputs.forEach(input => {
                input.checked = false;
            });
        }

        moyenPaiementInputs.forEach(input => {
            input.required = true;
            input.addEventListener('change', function () {
                // alert('input change')
                if (input.value === "Mobile_Money") {
                    // alert('Mobile_Money')
                    // Afficher les sections Mobile Money
                    operateurSection.classList.remove('d-none');
                    telPaiementSection.classList.remove('d-none');
                    ibanPaiementSection.classList.add('d-none'); // Cacher IBAN

                    // Ajouter les attributs requis
                    setRequired(['Operateur', 'TelPaiement', 'ConfirmTelPaiement']);
                    removeRequired(['IBAN']);
                    reinitIBAN();

                } else if (input.value === "Virement_Bancaire") {
                    // alert('Virement_Bancaire')
                    // Afficher la section IBAN
                    ibanPaiementSection.classList.remove('d-none');
                    operateurSection.classList.add('d-none'); // Cacher opérateur
                    telPaiementSection.classList.add('d-none'); // Cacher téléphone

                    // Ajouter les attributs requis
                    setRequired(['IBAN']);
                    removeRequired(['Operateur', 'TelPaiement', 'ConfirmTelPaiement']);
                    reinitTel();
                }
            });
        });
       
    
    }
    
     // Appelle la fonction une première fois pour gérer l'état initial
     toggleElements();
     toggleDateSinistre();
     toggleDocuments();
     toggleCorpsConserve();
     togglesinistreCentreHospitalier();
    //  updateIBAN();
     // Active la surveillance sur chaque étape
    activerSurveillance("#etapeSinistre1");
    activerSurveillance("#etapeSinistre2");
    activerSurveillance("#etapeSinistre3");
    activerSurveillance("#etapeSinistre4");
    activerSurveillance("#etapeSinistre5");

    // Vérifie au chargement
    verifierEtape("#etapeSinistre1");
    verifierEtape("#etapeSinistre2");
    verifierEtape("#etapeSinistre3");
    verifierEtape("#etapeSinistre4");
    verifierEtape("#etapeSinistre5");

});









