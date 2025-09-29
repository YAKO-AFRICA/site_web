<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <!--favicon-->
    <link rel="icon" href="{{ asset('assets/img/images/favicon_yako.png') }}" type="image/png" />
    <!--plugins-->
    <link href="{{ asset('cust_assets/plugins/vectormap/jquery-jvectormap-2.0.2.css') }}" rel="stylesheet" />
    <link href="{{ asset('cust_assets/plugins/simplebar/css/simplebar.css') }}" rel="stylesheet" />
    <link href="{{ asset('cust_assets/plugins/fancy-file-uploader/fancy_fileupload.css') }}" rel="stylesheet" />
    <link href="{{ asset('cust_assets/plugins/Drag-And-Drop/dist/imageuploadify.min.css') }}" rel="stylesheet" />
    <link href="{{ asset('https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css') }}" rel="stylesheet" />
    <link href="{{ asset('cust_assets/plugins/perfect-scrollbar/css/perfect-scrollbar.css') }}" rel="stylesheet" />
    <link href="{{ asset('cust_assets/plugins/metismenu/css/metisMenu.min.css') }}" rel="stylesheet" />

    <link href="{{ asset('cust_assets/plugins/datatable/css/dataTables.bootstrap5.min.css') }}" rel="stylesheet" />
    <!-- loader-->
    <link href="{{ asset('cust_assets/plugins/bs-stepper/css/bs-stepper.css') }}" rel="stylesheet" />
    <!-- loader-->
    <link href="cust_assets/css/pace.min.css" rel="stylesheet" />
    <script src="cust_assets/js/pace.min.js"></script>
    <!-- Bootstrap CSS -->
    <link href="{{ asset('cust_assets/css/bootstrap.min.css') }}" rel="stylesheet">
    <link href="{{ asset('cust_assets/css/bootstrap-extended.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" />
    <link rel="stylesheet"
        href="https://cdn.jsdelivr.net/npm/select2-bootstrap-5-theme@1.3.0/dist/select2-bootstrap-5-theme.min.css" />
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('assets/css/swiper-bundle.css') }}">
    {{-- <link href="https://cdn.quilljs.com/1.3.6/quill.snow.css" rel="stylesheet"> --}}
    <link href="{{ asset('cust_assets/css/app.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/css/style.css') }}" rel="stylesheet">
    <link href="{{ asset('cust_assets/css/icons.css') }}" rel="stylesheet">
    <!-- Theme Style CSS -->
    <link rel="stylesheet" href="{{ asset('cust_assets/css/dark-theme.css') }}" />
    <link rel="stylesheet" href="{{ asset('cust_assets/css/semi-dark.css') }}" />
    <link rel="stylesheet" href="{{ asset('cust_assets/css/header-colors.css') }}" />
    <link rel="stylesheet" href="{{ asset('assets/css/main.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/style.css') }}">
    <title>Espace Client || Yako Africa Assurances Vie</title>
    <style>
        .input-wrapper input:disabled {
            background-color: #f0f0f0;
            /* ou la couleur souhaitée */
            cursor: not-allowed;
        }
    </style>
</head>

<body>
    <div id="preloader">
        <div id="loader" class="loader">
            <div class="loader-container">
                <div class="loader-icon"><img src="{{ asset('assets/img/logo/Logo_yako.png') }}" alt="Preloader"></div>
            </div>
        </div>
    </div>
    <!--wrapper-->
    <div class="wrapper">
        @include('users.espace_client.layouts.sidebar')

        <div class="page-wrapper">
            <div class="page-content">
                <!--content-->
                @yield('content')

            </div>

        </div>

        <!--start overlay-->
        <div class="overlay toggle-icon"></div>
        <!--end overlay-->
        <!--Start Back To Top Button-->
        <a href="javaScript:;" class="back-to-top"><i class='bx bxs-up-arrow-alt'></i></a>
        <!--End Back To Top Button-->
        <footer class="page-footer">
            <p class="mb-0">Copyright Ⓒ - 2024 YAKO Africa Tous droits réservés.</p>
        </footer>
    </div>
    <!-- Bootstrap JS -->
    <script src="{{ asset('cust_assets/js/bootstrap.bundle.min.js') }}"></script>
    <!--plugins-->
    <script src="{{ asset('cust_assets/js/jquery.min.js') }}"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="{{ asset('assets_admin/js/script.js') }}"></script>
    {{-- <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js" integrity="sha512-v2CJ7UaYy4JwqLDIrZUI/4hqeoQieOmAZNXBeQyjo21dadnwR+8ZaIJVT8EE2iyI61OV8e6M8PP2/4hpQINQ/g==" crossorigin="anonymous" referrerpolicy="no-referrer"></script> --}}
    <script src="{{ asset('cust_assets/plugins/simplebar/js/simplebar.min.js') }}"></script>
    <script src="{{ asset('cust_assets/plugins/metismenu/js/metisMenu.min.js') }}"></script>
    <script src="{{ asset('cust_assets/plugins/fancy-file-uploader/jquery.ui.widget.js') }}"></script>
    <script src="{{ asset('cust_assets/plugins/fancy-file-uploader/jquery.fileupload.js') }}"></script>
    <script src="{{ asset('cust_assets/plugins/fancy-file-uploader/jquery.iframe-transport.js') }}"></script>
    <script src="{{ asset('cust_assets/plugins/fancy-file-uploader/jquery.fancy-fileupload.js') }}"></script>
    <script src="{{ asset('cust_assets/plugins/Drag-And-Drop/dist/imageuploadify.min.js') }}"></script>
    <script src="{{ asset('https://cdn.jsdelivr.net/npm/flatpickr') }}"></script>
    <script src="{{ asset('cust_assets/plugins/perfect-scrollbar/js/perfect-scrollbar.js') }}"></script>

    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    <script src="{{ asset('cust_assets/plugins/select2/js/select2-custom.js') }}"></script>
    <script src="{{ asset('cust_assets/plugins/vectormap/jquery-jvectormap-2.0.2.min.js') }}"></script>
    <script src="{{ asset('cust_assets/plugins/vectormap/jquery-jvectormap-world-mill-en.js') }}"></script>
    <script src="{{ asset('cust_assets/plugins/chartjs/js/chart.js') }}"></script>
    <script src="{{ asset('cust_assets/js/index.js') }}"></script>

    <script src="{{ asset('cust_assets/plugins/bs-stepper/js/bs-stepper.min.js') }}"></script>
    <script src="{{ asset('cust_assets/plugins/bs-stepper/js/main.js') }}"></script>

    <script src="{{ asset('cust_assets/plugins/datatable/js/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('cust_assets/plugins/datatable/js/dataTables.bootstrap5.min.js') }}"></script>


    <script src="https://cdn.tiny.cloud/1/pfjd5f3rf5sx7e99t8p7wi1x9yz3phproft7hk92nakivoru/tinymce/7/tinymce.min.js" referrerpolicy="origin"></script>

    <script>
        tinymce.init({
            selector: 'textarea.tinymce-editor',
            height: 400,
            language: 'fr_FR', // Interface en français
            plugins: [
                'advlist autolink lists link image charmap preview anchor',
                'searchreplace visualblocks code fullscreen',
                'insertdatetime media table emoticons wordcount help',
                'export pagebreak codesample'
            ],
            toolbar: 'undo redo | formatselect | ' +
                'bold italic underline strikethrough forecolor backcolor | ' +
                'alignleft aligncenter alignright alignjustify | ' +
                'bullist numlist outdent indent | link image media emoticons | ' +
                'table codesample export | removeformat | fullscreen preview help',

            menubar: 'file edit view insert format tools table help',

            // Style par défaut du contenu
            content_style: 'body { font-family:Helvetica,Arial,sans-serif; font-size:16px; line-height:1.6 }',

            image_title: true,
            automatic_uploads: true,
            file_picker_types: 'image media',

            // Gestion des uploads (images & vidéos)
            file_picker_callback: function(callback, value, meta) {
                var input = document.createElement('input');
                input.setAttribute('type', 'file');

                if (meta.filetype === 'image') {
                    input.setAttribute('accept', 'image/*');
                } else if (meta.filetype === 'media') {
                    input.setAttribute('accept', 'video/*');
                }

                input.onchange = function() {
                    var file = this.files[0];
                    var reader = new FileReader();
                    reader.onload = function() {
                        var id = 'blobid' + (new Date()).getTime();
                        var blobCache = tinymce.activeEditor.editorUpload.blobCache;
                        var base64 = reader.result.split(',')[1];
                        var blobInfo = blobCache.create(id, file, base64);
                        blobCache.add(blobInfo);
                        callback(blobInfo.blobUri(), {
                            title: file.name
                        });
                    };
                    reader.readAsDataURL(file);
                };
                input.click();
            },

            // Options supplémentaires
            table_default_attributes: {
                border: '1'
            },
            table_default_styles: {
                'border-collapse': 'collapse',
                'width': '100%'
            },
            codesample_languages: [{
                    text: 'HTML/XML',
                    value: 'markup'
                },
                {
                    text: 'JavaScript',
                    value: 'javascript'
                },
                {
                    text: 'CSS',
                    value: 'css'
                },
                {
                    text: 'PHP',
                    value: 'php'
                },
                {
                    text: 'Python',
                    value: 'python'
                },
                {
                    text: 'Java',
                    value: 'java'
                },
                {
                    text: 'C#',
                    value: 'csharp'
                }
            ]
        });
    </script>

    <script>
        var quill = new Quill('.editor', {
            theme: 'snow'
        });
    </script>
    <script>
        $(document).ready(function() {


            var table = $('#example2').DataTable({
                lengthChange: true,
                buttons: ['copy', 'excel', 'pdf', 'print'],
                language: {
                    search: "Recherche :",
                },
            });

            table.buttons().container()
                .appendTo('#example2_wrapper .col-md-6:eq(0)');
        });
    </script>
    <!--app JS-->
    <script src="{{ asset('cust_assets/js/script.js') }}"></script>
    <script src="{{ asset('cust_assets/js/app.js') }}"></script>
    <script src="{{ asset('assets/js/main.js') }}"></script>
    <script>
        new PerfectScrollbar(".app-container")
    </script>



    <script>
        $(".datepicker").flatpickr({
            altFormat: "F j, Y",
            dateFormat: "d-m-Y",
            maxDate: "today",
            allowInput: false, // Désactive la modification manuelle
            clickOpens: true // Assurez-vous que le calendrier s'ouvre toujours au clic
        });

        $(".time-picker").flatpickr({
            enableTime: true,
            noCalendar: true,
            dateFormat: "Y-m-d H:i",
        });

        $(".date-time").flatpickr({
            enableTime: true,
            dateFormat: "Y-m-d H:i",
        });

        $(".date-format").flatpickr({
            // altInput: true, // Affiche un champ alternatif lisible par l'utilisateur
            altFormat: "j F, Y", // Format alternatif en français (ex: 10 décembre, 2024)
            dateFormat: "d-m-Y", // Format réel de la date envoyée (10-12-2024)
            minDate: "today", // La date minimale est aujourd'hui
            // locale: "fr" // Définit la langue en français
        });

        $(".date-range").flatpickr({
            mode: "range",
            altInput: true,
            altFormat: "F j, Y",
            dateFormat: "Y-m-d",
        });

        $(".date-inline").flatpickr({
            inline: true,
            altInput: true,
            altFormat: "F j, Y",
            dateFormat: "Y-m-d",
        });
    </script>

    <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js" defer></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            let isJobRunning = false;

            function executeCronJob() {
                if (!isJobRunning) {
                    isJobRunning = true;
                    axios.post("{{ route('etatCotisation.clearFolder') }}", {}, {
                            headers: {
                                'X-CSRF-TOKEN': '{{ csrf_token() }}',
                                'Accept': 'application/json',
                                'Content-Type': 'application/json',
                            },
                        })
                        .then(response => {
                            console.log(' ');
                            // console.log(response.data.message);

                        })
                        .catch(error => {
                            console.error("Erreur lors de l'exécution du cron :", error);
                        })
                        .finally(() => {
                            isJobRunning = false;
                        });
                } else {
                    console.log("La tâche cron est déjà en cours.");
                }
            }

            // Exécuter toutes les 60 secondes (1 minute)
            setInterval(executeCronJob, 60000);
        });
    </script>




    <script>
        const noCopy = document.querySelector('.no-copy');
        const noCut = document.querySelector('.no-cut');
        const noPaste = document.querySelector('.no-paste');

        noCopy.addEventListener('copy', function(event) {
            event.preventDefault();
            swal.fire({
                icon: 'error',
                title: 'Oops...',
                text: 'La copie de ce champ est désactivée.',
                showConfirmButton: false,
                timer: 1500
            })

        });

        noCut.addEventListener('cut', function(e) {
            e.preventDefault();
            swal.fire({
                icon: 'error',
                title: 'Oops...',
                text: 'La coupe de ce champ est désactivée.',
                showConfirmButton: false,
                timer: 1500
            })
        });

        noPaste.addEventListener('paste', function(e) {
            e.preventDefault();
            swal.fire({
                icon: 'error',
                title: 'Oops...',
                text: 'La coller de ce champ est désactivée.',
                showConfirmButton: false,
                timer: 1500
            })
        });
    </script>
</body>

</html>
