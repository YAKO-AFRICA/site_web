$(".wrapper").on('click', '.deleteConfirmation', function () {
    var type = $(this).data('type');
    var title = $(this).data('title');
    var message = $(this).data('message');
    var id = $(this).data('id');
    var uuid = $(this).data('uuid');
    var token = $(this).data('token');
    var url = $(this).data('url');
    var urlback = $(this).data('urlback');
    var param = $(this).data('param');
    var param2 = $(this).data('param2');
    var param3 = $(this).data('param3');
    showConfirm_submit(id, uuid, token, url, title, message, param, param2, param3, urlback);
});

function notifier(type, message) {
    Lobibox.notify(type, {
		pauseDelayOnHover: true,
		size: 'mini',
		rounded: true,
		delayIndicator: true,
		continueDelayOnInactiveTab: false,
		position: 'top right',
		msg: message
	});
}

function showConfirm_submit(id, uuid, token, url, title, message, param, param2, param3, urlback) {
    Swal.fire({
            title: title,
            text: message,
            icon: "warning",
            buttons: true,
            dangerMode: true,

            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Oui, continuer !',
            cancelButtonText: 'Annuler',
            confirmButtonClass: 'btn btn-warning',
            cancelButtonClass: 'btn btn-danger ml-1',
        })
        .then((result) => {
            if (result.value) {
                $.ajax({
                    url: url,
                    type: "POST",
                    data: {
                        id: id,
                        uuid: uuid,
                        _token: token,
                        param: param,
                        param2: param2,
                        urlback: urlback
                    },
                    dataType: "json",

                    beforeSend: function () { // if form submit
                        Swal.fire({
                            title: "En cours de traitement...",
                            text: "Patientez un instant",
                            imageUrl: "/assets/img/images/loading.gif",
                            showConfirmButton: false,
                            allowOutsideClick: false
                        });
                    },
                    success: function (data) {
                        if (data.type === "success") { //if formData forme is very good
                            // Swal.fire(data.message, {
                            //     icon: "success"
                            // });
                            // window.location.href =data.urlback;
                            sendSuccess(data.title, data.message, data.urlback);

                        } 
                        // else {
                        //     Swal.fire(data.message, {});
                        // }
                    },
                    error: function (data) {
                        if (data.type === "error") { // if error occured
                            SendError(data.title, data.message, data.urlback);
                            // Swal.fire(data.message, {});
                        }
                    }
                });
            } else if (result.dismiss === Swal.DismissReason.cancel) {
                /*Swal.fire({
                    title: 'Cancelled',
                    text: 'Your imaginary file is safe :)',
                    type: 'error',
                    confirmButtonClass: 'btn btn-success',
                })*/
            }

        });
}


function loading() {
    Swal.fire({
        // title: "En cours de traitement...",
        text: "Traitement en cours",
        imageUrl: "/assets/img/images/loading.gif",
        imageWidth: 50,
        imageHeight: 50,
        showConfirmButton: false,
        allowOutsideClick: true
    });
}

//debut fonction sendSuccess
function sendSuccess(title, message, urlback = '') { // retour en cas de success d'envoi de formulaire
    if (urlback != '') {
        if (urlback == 'back') {
            //Si url de retour exist
            Swal.fire({
                icon: 'success',
                //title: title,
                text: message,
                showConfirmButton: false,
                timer: 3000
            });
            setTimeout(() => {
                location.reload();
            }, 2000);
        } else {
            //Si url de retour exist
            Swal.fire({
                icon: 'success',
                //title: title,
                text: message,
                showConfirmButton: false,
                timer: 2000
            });
            setTimeout(() => {
                window.location.href = urlback;
            }, 2000);
        }
    } else {
        //Si url de retour exist pas dans le retour du formulaire
        Swal.fire({
            icon: 'success',
            //title: title,
            text: message,
            showConfirmButton: true,
            // timer: 2000
        })
        $('.sendForm')[0].reset();
    }
}

function SendError(title, messageError, urlback='') { //fonction pour envoi de formulaire chargement loading
    if (urlback != '') {
        if (urlback == 'back') {
            //Si url de retour exist
            Swal.fire({
                icon: 'error',
                //title: title,
                text: messageError,
                showConfirmButton: false,
                timer: 3000
            });
            setTimeout(() => {
                location.reload();
            }, 4000);
        } else {
            //Si url de retour exist
            Swal.fire({
                icon: 'error',
                //title: title,
                text: messageError,
                showConfirmButton: false,
                timer: 3000
            });
            setTimeout(() => {
                window.location.href = urlback;
            }, 3000);
        }
    } else {
        //Si url de retour exist pas dans le retour du formulaire
        Swal.fire({
            icon: 'error',
            title: title,
            text: messageError,
            confirmButtonText: 'FERMER'
            // showConfirmButton: true,
            // timer: 3000
        })
    }
    
} //fin de la focntion SendError


$(".wrapper").on('submit', '.submitForm', function (e) {
    e.preventDefault();
    var action = $(this).attr('action');
    var formData = new FormData(this);

    $.ajax({
        url: action,
        type: 'POST',
        data: formData,
        async: false,
        dataType: 'json',
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        beforeSend: function () { // if form submit
            loading();
        },
        success: function (data) {
            if (data.type == "success") { //if formData forme is very good
                sendSuccess(data.title, data.message, data.urlback);
            } else {
                SendError(data.title, data.message, data.urlback);
            }
        },
        error: function (data) {
            if (data.type == "error") { // if error occured
                SendError("messageError");
            }
        },
        cache: false,
        contentType: false,
        processData: false
    });
});

// $(".wrapper").on('submit', '.submitForm', function (e) {
//     e.preventDefault();
    
//     var action = $(this).attr('action');
//     var addPrestationUrl = document.getElementById('js-variables').dataset.addPrestationUrl;

//     // Normalisation des URL pour éviter les différences liées aux slashes finaux
//     action = action.replace(/\/$/, '');
//     addPrestationUrl = addPrestationUrl.replace(/\/$/, '');

//     console.log("Action URL:", action);
//     console.log("Route URL:", addPrestationUrl);
//     var formData = new FormData(this);
//     if (action == addPrestationUrl) {
//         const form = this;
//             const submitButton = form.querySelector('button[type="submit"]');
//             if (submitButton.disabled) return; // Empêche une soumission multiple
    
//             submitButton.disabled = true; // Désactive le bouton pour éviter les soumissions multiples
    
//             // Crée un nouvel onglet immédiatement pour éviter le blocage
//             const newTab = window.open('about:blank', '_blank');
//         $.ajax({
//             url: action,
//             type: 'POST',
//             data: formData,
//             async: false,
//             dataType: 'json',
//             headers: {
//                 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
//             },
//             beforeSend: function () { // if form submit
//                 loading();
//             },
//             success: function (data) {
//                 if (data.type == "success" && data.pdf_url) { //if formData forme is very good
//                     // ouvre le pdf dans le nouvel onglet
//                     newTab.location.href = data.pdf_url;
//                     sendSuccess(
//                         data.title, 
//                         data.message, 
//                         data.urlback);
//                     // sendSuccess(data.title, data.message, data.urlback);
//                 } else {
//                     SendError(data.title, data.message);
//                     // Ferme le nouvel onglet en cas d'erreur
//                     newTab.close();
//                 }
//             },
//             error: function (data) {
//                 if (data.type == "error") { // if error occured
//                     SendError("messageError");
//                     // Ferme le nouvel onglet en cas d'erreur
//                     newTab.close();
//                 }
//             },
//             complete: function () {
//                 submitButton.disabled = false; // Réactive le bouton après le traitement
//             },
//             cache: false,
//             contentType: false,
//             processData: false
//         }); 
//     }else{
//     $.ajax({
//         url: action,
//         type: 'POST',
//         data: formData,
//         async: false,
//         dataType: 'json',
//         headers: {
//             'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
//         },
//         beforeSend: function () { // if form submit
//             loading();
//         },
//         success: function (data) {
//             if (data.type == "success") { //if formData forme is very good
//                 sendSuccess(data.title, data.message, data.urlback);
//             } else {
//                 SendError(data.title, data.message);
//             }
//         },
//         error: function (data) {
//             if (data.type == "error") { // if error occured
//                 SendError("messageError");
//             }
//         },
//         cache: false,
//         contentType: false,
//         processData: false
//     });
//     }
// });
