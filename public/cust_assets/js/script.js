// document.addEventListener('DOMContentLoaded', function() {
//     const loginInput = document.getElementById('login');
//     const btnModifier = document.getElementById('btn-modifier');
//     const btnMettreAJour = document.getElementById('btn-mettre-a-jour');

//     // Événement pour le bouton "Modifier"
//     btnModifier.addEventListener('click', function() {
//         const login = loginInput.value;
//         document.getElementById('modifier-login').value = login; // Passer le login
//         console.log("Modifier le client avec le login :", login); // Juste pour déboguer
//         // Vous pouvez ajouter ici la logique pour traiter le clic sur le bouton "Modifier"
//     });

//     // Événement pour le bouton "Mettre à jour"
//     btnMettreAJour.addEventListener('click', function() {
//         // const login = loginInput.value;
//         sessionStorage.setItem('login', loginInput.value);
//        let login = sessionStorage.getItem('login');
//         document.getElementById('update-login').value = login; // Passer le login
//         console.log("Mettre à jour le client avec le login :", login); // Juste pour déboguer
//         // Vous pouvez ajouter ici la logique pour traiter le clic sur le bouton "Mettre à jour"
//     });
// });
document.addEventListener('DOMContentLoaded', function() {
    const loginInput = document.getElementById('login');
    const btnModifier = document.getElementById('btn-modifier');
    const btnMettreAJour = document.getElementById('btn-mettre-a-jour');

    if (btnModifier) {
        btnModifier.addEventListener('click', function() {
            const login = loginInput.value.trim();
            const inputModifier = document.getElementById('modifier-login');

            if (inputModifier) {
                inputModifier.value = login; // Assigner le login
            }
            console.log("Modifier le client avec le login :", login);
        });
    }

    if (btnMettreAJour) {
        btnMettreAJour.addEventListener('click', function() {
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


document.addEventListener('DOMContentLoaded', function() {
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
    // function validateTelFields() {
    //     const telValue = telPaiementField.value.trim();
    //     const confirmTelValue = confirmTelPaiementField.value.trim();

    //     let isValid = true;

    //     // Vérifier que les deux champs ne sont pas vides
    //     if (!telValue || !confirmTelValue) {
    //         isValid = false;
    //     }

    //     // Vérifier que les deux valeurs correspondent
    //     if (telValue !== confirmTelValue) {
    //         isValid = false;
    //         telPaiementField.classList.add('is-invalid');
    //         confirmTelPaiementField.classList.add('is-invalid');
    //     } else {
    //         telPaiementField.classList.remove('is-invalid');
    //         confirmTelPaiementField.classList.remove('is-invalid');
    //     }

    //     // Vérifier le format du numéro (exemple : 10 chiffres)
    //     const phoneRegex = /^[0-9]{10}$/; // Modifier selon le format attendu
    //     if (!phoneRegex.test(telValue)) {
    //         isValid = false;
    //         telPaiementField.classList.add('is-invalid');
    //     } else {
    //         telPaiementField.classList.remove('is-invalid');
    //     }

    //     return isValid;
    // }

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

    // Fonction pour valider les champs de téléphone
    // function validateTelFields() {
    //     const telValue = telPaiementField.value.trim();
    //     const confirmTelValue = confirmTelPaiementField.value.trim();

    //     let isValid = true;

    //     // Vérifier que les deux champs ne sont pas vides
    //     if (!telValue || !confirmTelValue) {
    //         isValid = false;
    //     }

    //     // Vérifier que les deux valeurs correspondent
    //     if (telValue !== confirmTelValue) {
    //         isValid = false;
    //         telPaiementField.classList.add('is-invalid');
    //         confirmTelPaiementField.classList.add('is-invalid');
    //     } else {
    //         telPaiementField.classList.remove('is-invalid');
    //         confirmTelPaiementField.classList.remove('is-invalid');
    //     }

    //     // Vérifier le format du numéro (exemple : 10 chiffres)
    //     const phoneRegex = /^[0-9]{10}$/; // Modifier selon le format attendu
    //     if (!phoneRegex.test(telValue)) {
    //         isValid = false;
    //         telPaiementField.classList.add('is-invalid');
    //     } else {
    //         telPaiementField.classList.remove('is-invalid');
    //     }

    //     return isValid;
    // }

    // Fonction pour valider les champs de password et confirmer password
    // function validatePassword() {
    //     const passwordValue = passwordInput.value.trim();
    //     const confirmPasswordValue = confirmPasswordInput.value.trim();
    //     let isValid = true;

    //     if (!passwordValue || !confirmPasswordValue) {
    //         isValid = false;
    //         passwordInput.classList.add('is-invalid');
    //         confirmPasswordInput.classList.add('is-invalid');
    //         alert("Veuillez remplir les champs de password et confirmer password.");
    //     }

    //     if (passwordValue !== confirmPasswordValue) {
    //         isValid = false;
    //         passwordInput.classList.add('is-invalid');
    //         confirmPasswordInput.classList.add('is-invalid');
    //         alert("Les mots de passe ne correspondent pas.");
    //     }

    //     return isValid;
    // }

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


document.addEventListener('DOMContentLoaded', function() {
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
        input.addEventListener('change', function() {
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
        input.addEventListener('blur', function() {
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
                    }else{
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
                    body: JSON.stringify({ TelPaiement: phoneNumber }),
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
        }else if (firstTwoDigits == '01') {
            try {
                const response = await fetch('/api/send-otpByInfobipAPI', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                    },
                    body: JSON.stringify({ TelPaiement: phoneNumber }),
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
        if(telPaiementField.value != null && telPaiementField.value != ''){
            phoneNumber = telPaiementField.value.trim();
        }else{
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
                if (input.value.length == 0 || input.value == null || input.value == undefined || input.value == " "){
                    input.classList.add('is-invalid');
                    input.classList.remove('is-valid');
                }else{
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
            input.addEventListener('change', function() {
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
            msgError.text(`Selon les termes du contrat, le montant souhaité doit être inférieur ou égal à ${moitieCapitalFormate} FCFA.`).show();
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
                alert(`Selon les termes du contrat, le montant souhaité doit être supérieur à 0 et inferieur ou égal à ${moitieCapitalFormate} FCFA.`);
                msgError.text(`Selon les termes du contrat, le montant souhaité doit être supérieur à 0 et inferieur ou égal à ${moitieCapitalFormate} FCFA.`).show();
                // ajouter une bordure rouge si le montant souhaité est invalide
                montantSouhaiteField.classList.add('is-invalid');
                montantSouhaiteField.classList.remove('is-valid');
                return; // Arrêter si le montant souhaité n'est pas valide
            }

    
            // // Vérification et envoi de l'OTP
            // if (currentContainer.contains(telPaiementField)) {
            //     const phoneNumber = telPaiementField.value.trim();
            //     // si tous les champs required ne sont pas renseignés bloqué l'envoi de l'OTP
            //    if (!validateStep(currentContainer)) {
            //         return;
            //    }else{
            //     const otpSent = await sendOtp(phoneNumber);
        
            //     if (!otpSent) {
            //         return; // Arrêter si l'OTP n'a pas pu être envoyé
            //     }
            //    };
                
            // }
            // Vérification et envoi de l'OTP
            if (currentContainer.contains(telPaiementField) && !telPaiementSection.classList.contains('d-none')) {
                const phoneNumber = telPaiementField.value.trim();
                // si tous les champs required ne sont pas renseignés bloqué l'envoi de l'OTP
               if (!validateStep(currentContainer)) {
                    return;
               }else{
                const otpSent = await sendOtp(phoneNumber);
        
                if (!otpSent) {
                    return; // Arrêter si l'OTP n'a pas pu être envoyé
                }
               };
                
            }else{
                const phoneNumber = telOtpField.value.trim();
                console.log('phoneNumber = ', phoneNumber);
                // si tous les champs required ne sont pas renseignés bloqué l'envoi de l'OTP
               if (!validateStep(currentContainer)) {
                    return;
               }else{
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
    
    $(document).ready(function() {
        // Déclencher l'événement "change" sur le champ de sélection pour le premier contrat
        $('#single-select-field').trigger('change');
    });
    $(document).on('change', '#single-select-field', function() {
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
                success: function(response) {
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
                            $("#Prime").text(Prime+' FCFA');
                            $("#DateEffet").text(details[0].DateEffetReel);
                            $("#DateFinAdhesion").text(details[0].FinAdhesion);

                            $("#detailContratModalLabel").text('Information sur le contrat ' + details[0].IdProposition );
                            
                            DetailContratBtn.style.display = 'block';
                        } else {
                            console.error('Aucun détail trouvé pour ce contrat.');
                        }
                    } else {
                        alert('Erreur : ' + response.message);
                    }
                },
                error: function(xhr) {
                    console.error(xhr.responseText);
                    alert('Erreur lors de la récupération des informations du contrat.');
                },
                complete: function() {
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
    // const submitdrvButtons = document.querySelectorAll('.submitdrv-btn'); // Boutons "Next"
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
                    }else{
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
                    body: JSON.stringify({ TelPaiement: phoneNumber }),
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
        }else if (firstTwoDigits == '01') {
            try {
                const response = await fetch('/api/send-otpByInfobipAPI', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                    },
                    body: JSON.stringify({ TelPaiement: phoneNumber }),
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
        if(telPaiementField.value != null && telPaiementField.value != ''){
            phoneNumber = telPaiementField.value.trim();
        }else{
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
                if (input.value.length == 0 || input.value == null || input.value == undefined || input.value == " "){
                    input.classList.add('is-invalid');
                    input.classList.remove('is-valid');
                }else{
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
            input.addEventListener('change', function() {
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

    if(montantSouhaiteField.value.trim() !== "") {
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
               }else{
                const otpSent = await sendOtp(phoneNumber);
        
                if (!otpSent) {
                    return; // Arrêter si l'OTP n'a pas pu être envoyé
                }
               };
                
            }else{
                const phoneNumber = telOtpField.value.trim();
                console.log('phoneNumber = ', phoneNumber);
                // si tous les champs required ne sont pas renseignés bloqué l'envoi de l'OTP
               if (!validateStep(currentContainer)) {
                    return;
               }else{
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
    
    $(document).ready(function() {
        // Déclencher l'événement "change" sur le champ de sélection pour le premier contrat
        $('#single-select-field').trigger('change');
    });
    $(document).on('change', '#single-select-field', function() {
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
                success: function(response) {
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
                            $("#Prime").text(Prime+' FCFA');
                            $("#DateEffet").text(details[0].DateEffetReel);
                            $("#DateFinAdhesion").text(details[0].FinAdhesion);

                            $("#detailContratModalLabel").text('Information sur le contrat ' + details[0].IdProposition );
                            
                            DetailContratBtn.style.display = 'block';
                        } else {
                            console.error('Aucun détail trouvé pour ce contrat.');
                        }
                    } else {
                        alert('Erreur : ' + response.message);
                    }
                },
                error: function(xhr) {
                    console.error(xhr.responseText);
                    alert('Erreur lors de la récupération des informations du contrat.');
                },
                complete: function() {
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
    // selectLieuRDV.addEventListener('change', function() {
    //   if (this.value !== '') {
    //     inputDateRDV.disabled = false;
    //     selectOptionsRdv.disabled = false;
    //   } else {
    //     inputDateRDV.disabled = true;
    //     selectOptionsRdv.disabled = true;
    //   }
    // });

   
    $(document).ready(function() { 
        var availableOptions = []; // Un tableau pour stocker les options de RDV disponibles
        var availableOptions = []; // Tableau pour stocker les options de RDV disponibles
       
        $('#idTblBureau').on('change', function() {
            var id = $(this).val();
            if (spinner) {
                spinner.style.display = 'block';
            }
            $.ajax({
                type: 'GET',
                url: '/espace-client/rdv/optionDate/' + id,
                dataType: 'json',
                success: function(data) {
                    if (data.status === 'success' && data.data.length > 0) {
                        var jmax = '';
                        var lieu = '';
                        var jours = [];
                        availableOptions = []; // Réinitialiser les options disponibles
                        // Boucle à travers les données reçues
                        $.each(data.data, function(index, villeReseau) {
                            lieu = villeReseau.libelleVilleBureau || 'Lieu inconnu'; // Récupérer le nom du lieu
                            $.each(villeReseau.option_rdv, function(index, optionRdv) {
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
                error: function(xhr, status, error) {
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

        $('#daterdv').on('change', function() {
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
                var availableForDate = availableOptions.filter(function(option) {
                    return option.codelieu == idTblBureau && parseInt(option.codejour) === dateObj.getDay();
                });

                if (availableForDate.length > 0) {
                    // Si des options sont disponibles pour la date et le lieu
                    $.each(availableForDate, function(index, option) {
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
                            success: function(data) {
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
                            error: function(xhr, status, error) {
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

$(document).ready(function() {
    // Déclencher l'événement "change" sur le champ de sélection pour le premier contrat
    $('#idcontrat').trigger('change');
});

$(document).on('change', '#idcontrat', function() {
    var idcontrat = $(this).val(); // Récupérer l'ID du contrat sélectionné
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
                _token: '{{ csrf_token() }}'  // Le token CSRF pour sécuriser la requête
            },
            dataType: 'json', // Assurez-vous que la réponse attendue est en JSON
            success: function(response) {
                if (response.status === 'success') {
                    var details = response.data.details;
                    var TotalPrime = parseInt(details[0].TotalPrime);
                    if (details && details.length > 0) {
                        const MonContrat = parseInt(details[0].IdProposition);
                        $("#adherent").text(details[0].nomSous + ' ' + details[0].PrenomSous);
                        $("#idProposition").text(details[0].IdProposition);
                        $("#CodeProposition").text(details[0].CodeProposition);
                        $("#CodepropositionForm").text(details[0].CodepropositionForm);
                        $("#CodeConseiller").text(details[0].CodeConseiller + ' - ' + details[0].NomAgent);
                        $("#produit").text(details[0].produit);
                        $("#totalPrime").text(TotalPrime+' FCFA');
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
                        var CapitalSouscrit = parseInt(details[0].CapitalSouscrit);
                        $("#Capital").val(CapitalSouscrit);
                        $("#CapitalSouscrit").text(CapitalSouscrit + ' FCFA');
                        $("#DureeCotisationAns").text(details[0].DureeCotisationAns+' ans');
                        $("#TotalPrime").text(TotalPrime + ' FCFA /mois');
                        $("#NbreEncaissment").text(details[0].NbreEncaissment);
                        $("#NbreImpayes").text(details[0].NbreImpayes);
                        
                    } else {
                        console.error('Aucun détail trouvé pour ce contrat.');
                    }
                } else {
                    alert('Erreur : ' + response.message);
                }
            },
            error: function(xhr) {
                console.error(xhr.responseText);
                alert('Erreur lors de la récupération des informations du contrat.');
            },
            complete: function() {
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
        console.log("Choix réinitialisé, boutons masqués.");
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
        if(telPaiementField.value != null && telPaiementField.value != ''){
            phone = telPaiementField.value.trim();
        }else{
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
        if(telPaiementField.value != null && telPaiementField.value != ''){
            phone = telPaiementField.value.trim();
        }else{
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
        navigator.permissions.query({ name: 'geolocation' }).then(function (result) {
            if (result.state === 'denied') {
                alert("Veuillez activer la localisation pour continuer.");
            } else {
                map.locate({ setView: true, maxZoom: 16 });
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

// recupere les prestations
document.addEventListener('DOMContentLoaded', function () {
    const selectContrat = document.getElementById('idcontratPrest');
    const tablePrestation = document.getElementById('example3'); // Table complète
    const tablePrestationBody = tablePrestation.querySelector('tbody');
    const getPrestationsUrl = "/api/getPrestations";
    let dataTableInstance = null;
    

    const formatDate = (dateString) => {
        if (!dateString) return '-';
        const date = new Date(dateString);
        return date.toLocaleDateString('fr-FR', { day: '2-digit', month: '2-digit', year: 'numeric', hour: '2-digit', minute: '2-digit', second: '2-digit' });
    };

    const clearTable = () => {
        if (dataTableInstance) {
            dataTableInstance.destroy(); // Détruire DataTables
            dataTableInstance = null;
        }
        tablePrestationBody.innerHTML = ''; // Nettoyer le contenu du tableau
        const modalContainer = document.getElementById('modalContainer');
        if (modalContainer) modalContainer.remove(); // Supprimer les anciennes modales
    };

    const createModal = (prestation) => {
        const modalId = `exampleModal${prestation.code}`;
        return `
            <div class="modal fade" id="${modalId}" tabindex="-1" aria-labelledby="${modalId}Label" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="${modalId}Label">Détails de la prestation</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Fermer"></button>
                        </div>
                        <div class="modal-body">
                            <div class="card radius-10">
                                <div class="card-header">
                                </div>
                                <div class="card-body bg-light-success rounded">
                                    <div class="align-items-center">
                                        <div class="flex-grow-1 ms-3 my-4" style="text-align: justify">
                                            ${prestation.msgClient || 'Aucune information disponible.'}
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn-prime" data-bs-dismiss="modal">Fermer</button>
                        </div>
                    </div>
                </div>
            </div>
        `;
    };

    selectContrat.addEventListener('change', function () {
        const idcontrat = selectContrat.value;
        const spinner = document.getElementById('spinner');
        if (spinner) {
            spinner.style.display = 'block';
        }

        if (idcontrat === 'Veuillez sélectionner un contrat') {
            clearTable();
            tablePrestationBody.innerHTML = `
                <tr>
                    <td colspan="9" class="text-center">Veuillez sélectionner un contrat pour voir les prestations.</td>
                </tr>`;
            return;
        }

        fetch(getPrestationsUrl, {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
            },
            body: JSON.stringify({ idcontratPrest: idcontrat }),
            
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
                    const prestations = data.data;

                    if (prestations.length > 0) {
                        const modalContainer = document.createElement('div');
                        modalContainer.setAttribute('id', 'modalContainer');
                        document.body.appendChild(modalContainer);

                        tablePrestationBody.innerHTML = prestations.map(prestation => {
                            const modalHtml = createModal(prestation);
                            let editPrestationUrl = `/espace-client/prestation/${prestation.etape == 3 ? 'modifier-apres-rejet' : 'edit'}/${prestation.code}`;

                            modalContainer.innerHTML += modalHtml;

                            return `
                                <tr>
                                    <td>${prestation.code || '-'}</td>
                                    <td>${prestation.idcontrat || '-'}</td>
                                    <td>${prestation.typeprestation || '-'}</td>
                                    
                                    <td>
                                        ${prestation.etape == 0 ? 
                                            '<div class="badge rounded-pill text-info bg-light-info p-2 text-uppercase px-3"><i class="bx bxs-circle me-1"></i>En attente de transmission</div>' :
                                        prestation.etape == 1 ? 
                                            '<div class="badge rounded-pill text-primary bg-light-primary p-2 text-uppercase px-3"><i class="bx bxs-circle me-1"></i>transmis pour traitement</div>' :
                                        prestation.etape == 2 ? 
                                            '<div class="badge rounded-pill text-success bg-light-success p-2 text-uppercase px-3"><i class="bx bxs-circle me-1"></i>Demande acceptée</div>' :
                                        prestation.etape == 3 ? 
                                            '<div class="badge rounded-pill text-danger bg-light-danger p-2 text-uppercase px-3"><i class="bx bxs-circle me-1"></i>Demande rejetée</div>' :
                                            '-'}
                                    </td>
                                    <td>${formatDate(prestation.created_at) || '-'}</td>
                                    <td>
                                        <div class="d-flex order-actions">
                                            ${prestation.montantSouhaite != null && prestation.montantSouhaite != '' ? 
                                                `<a href="/espace-client/details-prestation/${prestation.code}" class="ms-2 border"><i class='bx bxs-show'></i></a>
                                                <a href="${editPrestationUrl}" class="ms-3 border ${ prestation.etape != 0 && prestation.etape != 3 ? 'disabled-link' : '' }" 
                                                        data-bs-toggle="tooltip" data-bs-placement="top" 
                                                        title="${ prestation.etape != 0 && prestation.etape != 3 ? 'Impossible de modifier la demande une fois transmise' : '' }">
                                                         <i class='bx bxs-edit'></i>
                                                </a>
                                                <a href="javascript:;" class="deleteConfirmation border ms-3 ${ prestation.etape != 0 && prestation.etape != 3 ? 'disabled-link' : '' }" data-uuid="${prestation.code}"
                                                        data-type="confirmation_redirect" data-placement="top"
                                                        data-token="{{ csrf_token() }}" data-bs-toggle="tooltip" data-bs-placement="top" 
                                                        title="${ prestation.etape != 0 && prestation.etape != 3 ? 'Impossible de supprimer la demande une fois transmise' : '' }"
                                                        data-url="/espace-client/prestation/destroy/${prestation.code}"
                                                        data-title="Vous êtes sur le point de supprimer ${prestation.code}"
                                                        data-id="${prestation.code}" data-param="0"
                                                        data-route="/espace-client/prestation/destroy/${prestation.code}" ><i
                                                            class='bx bxs-trash' style="cursor: pointer"></i>
                                                    </a>
                                                ` :
                                                `<a href="javascript:void(0)" data-bs-toggle="modal" data-bs-target="#exampleModal${prestation.code}" class="ms-2 border"><i class='bx bxs-show'></i></a>
                                                <a href="${editPrestationUrl}" class="ms-3 border ${ prestation.etape != 0 ? 'disabled-link' : '' }" 
                                                        data-bs-toggle="tooltip" data-bs-placement="top" 
                                                        title="${ prestation.etape != 0 ? 'Impossible de modifier la demande une fois transmise' : '' }">
                                                         <i class='bx bxs-edit'></i>
                                                </a>
                                                <a href="javascript:;" class="deleteConfirmation border ms-3 ${ prestation.etape != 0 ? 'disabled-link' : '' }" data-uuid="${prestation.code}"
                                                        data-type="confirmation_redirect" data-placement="top"
                                                        data-token="{{ csrf_token() }}" data-bs-toggle="tooltip" data-bs-placement="top" 
                                                        title="${ prestation.etape != 0 ? 'Impossible de supprimer la demande une fois transmise' : '' }"
                                                        data-url="/espace-client/prestation/destroy/${prestation.code}"
                                                        data-title="Vous êtes sur le point de supprimer ${prestation.code}"
                                                        data-id="${prestation.code}" data-param="0"
                                                        data-route="/espace-client/prestation/destroy/${prestation.code}" ><i
                                                            class='bx bxs-trash' style="cursor: pointer"></i>
                                                    </a>
                                                `
                                            }
                                        </div>
                                    </td>
                                </tr>
                            `;
                        }).join('');

                        // Initialiser DataTables après l'ajout des lignes
                        dataTableInstance = $(tablePrestation).DataTable({
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
                        tablePrestationBody.innerHTML = `
                            <tr>
                                <td colspan="9" class="text-center">Aucune prestation trouvée pour ce contrat.</td>
                            </tr>`;
                    }
                } else {
                    tablePrestationBody.innerHTML = `
                        <tr>
                            <td colspan="9" class="text-center text-danger">Une erreur est survenue : ${data.message}</td>
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
                tablePrestationBody.innerHTML = `
                    <tr>
                        <td colspan="9" class="text-center text-danger">Une erreur est survenue lors de la récupération des données.</td>
                    </tr>`;
            });
    });
});


// recupere les rdv
document.addEventListener('DOMContentLoaded', function () {
    const selectContrat = document.getElementById('idcontratRdv');
    const tableRdv = document.getElementById('example3'); // Table complète
    const tableRdvBody = tableRdv.querySelector('tbody');
    const getRdvUrl = "/api/getRdv";
    let dataTableInstance = null;

    const formatDate = (dateString) => {
        if (!dateString) return '-';
        const date = new Date(dateString);
        return date.toLocaleDateString('fr-FR', { day: '2-digit', month: '2-digit', year: 'numeric' });
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
            body: JSON.stringify({ idcontratPrest: idcontrat }),
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
                                <td>${rdv.ville.libelleVilleBureau || '-'}</td>
                                <td>${rdv.daterdv || '-'}</td>
                                <td>${rdv.tel || '-'}</td>
                                <td>${rdv.email || '-'}</td>
                                <td>
                                    ${rdv.etat == '0' ? 
                                        '<div class="badge rounded-pill text-danger bg-light-danger p-2 text-uppercase px-3"><i class="bx bxs-circle me-1"></i>RDV non accepté</div>' :
                                    rdv.etat == '1' ? 
                                        '<div class="badge rounded-pill text-info bg-light-info p-2 text-uppercase px-3"><i class="bx bxs-circle me-1"></i>En attente d\'acceptation</div>' :
                                    rdv.etat == '2' ? 
                                        '<div class="badge rounded-pill text-success bg-light-success p-2 text-uppercase px-3"><i class="bx bxs-circle me-1"></i>RDV accepté</div>' :
                                        '<div class="badge rounded-pill text-success bg-light-success p-2 text-uppercase px-3"><i class="bx bxs-circle me-1"></i>Traitement Terminé</div>'
                                    }
                                </td>
                                <td>${rdv.dateajou || '-'}</td>
                            </tr>`).join('');
                            // Initialiser DataTables après l'ajout des lignes
                        dataTableInstance = $(tableRdv).DataTable({
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
                                <td colspan="9" class="text-center">Aucun rdv pris pour ce contrat.</td>
                            </tr>`;
                    }

                } else {
                    tableRdvBody.innerHTML = `
                        <tr>
                            <td colspan="9" class="text-center text-danger">Aucun rdv pris pour ce contrat</td>
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


// Fin upload doc

// Debut OTP input 
// document.addEventListener('DOMContentLoaded', function() {
//     const otpInputs = document.querySelectorAll('.otp-input');

//     otpInputs.forEach((input, index) => {
//         input.addEventListener('input', () => {
//             if (input.value.length === 1 && index < otpInputs.length - 1) {
//                 otpInputs[index + 1].focus();
//             }
//         });

//         input.addEventListener('keydown', (e) => {
//             if (e.key === 'Backspace' && index > 0 && input.value === '') {
//                 otpInputs[index - 1].focus();
//             }
//         });
//     });
//     // document.querySelector('.resend-otp-link').addEventListener('click', function(event) {
//     //     event.preventDefault(); // Empêche le comportement par défaut du lien
//     //     alert('Un nouveau code OTP a été envoyé sur votre numéro de paiement.');
//     //     // Ajoutez ici la logique pour envoyer une requête au serveur pour renvoyer l'OTP
//     // });
// });

// Fin OTP input

// Debut RIB input 

// document.addEventListener('DOMContentLoaded', function () {
//     const ribInputs = document.querySelectorAll('.rib-input');

//     ribInputs.forEach((input, index) => {
//         input.addEventListener('input', function () {
//             // Filtrer uniquement les lettres et chiffres
//             this.value = this.value.replace(/[^a-zA-Z0-9]/g, '');

//             // Passer au champ suivant si un caractère est saisi
//             if (this.value.length === 1 && index < ribInputs.length - 1) {
//                 ribInputs[index + 1].focus();
//             }

//         });

//         input.addEventListener('keydown', function (e) {
//             // Gérer la suppression et revenir au champ précédent
//             if (e.key === 'Backspace' && this.value === '' && index > 0) {
//                 ribInputs[index - 1].focus();
//             }
//         });
//     });
// });
document.addEventListener('DOMContentLoaded', function() {
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
    ribInputs.forEach((input, index) => {
        input.addEventListener('input', function (event) {
            this.value = this.value.replace(/[^a-zA-Z0-9]/g, ''); // Autoriser uniquement lettres et chiffres
            handleInput(ribInputs, event, index);
        });

        input.addEventListener('keydown', (event) => handleKeyDown(ribInputs, event, index));
        input.addEventListener('paste', handlePaste);
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
            const typePrestation = formulaire.querySelector('[name="typeprestation"]')?.value || '';
            const idContrat = formulaire.querySelector('[name="idcontrat"]')?.value || '';
            const montantSouhaite = formulaire.querySelector('[name="montantSouhaite"]')?.value || '';

            // Récupération des boutons radio sélectionnés
            const moyenPaiement = formulaire.querySelector('[name="moyenPaiement"]:checked')?.value || '';
            const operateur = formulaire.querySelector('[name="Operateur"]:checked')?.value || '';
            const sexe = formulaire.querySelector('[name="sexe"]')?.value || '';

            const telPaiement = formulaire.querySelector('[name="TelPaiement"]')?.value || '';
            const iban = formulaire.querySelector('[name="IBAN"]')?.value || '';

            const nom = formulaire.querySelector('[name="nom"]')?.value || '';
            const prenom = formulaire.querySelector('[name="prenom"]')?.value || '';
            const dateNaissance = formulaire.querySelector('[name="datenaissance"]')?.value || '';
            const cel = formulaire.querySelector('[name="cel"]')?.value || '';
            const email = formulaire.querySelector('[name="email"]')?.value || '';
            const lieuResidence = formulaire.querySelector('[name="lieuresidence"]')?.value || '';

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

