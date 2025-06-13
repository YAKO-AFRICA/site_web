<!doctype html>
<html lang="en-US" dir="ltr" data-navigation-type="default" data-navbar-horizontal-shape="default">

<!-- Added by HTTrack --><meta http-equiv="content-type" content="text/html;charset=utf-8" /><!-- /Added by HTTrack -->
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Admin || YAKO Africa Assurances </title>

    <link rel="apple-touch-icon" sizes="180x180" href="{{ asset('assets_admin/img/favicons/apple-touch-icon.pn')}}">
    <link rel="icon" type="image/png" sizes="16x16" href="{{ asset('assets/img/images/favicon_yako.png')}}">
    <link rel="shortcut icon" type="image/x-icon" href="{{ asset('assets/img/images/favicon_yako.png')}}">
    <link rel="manifest" href="{{ asset('assets_admin/img/favicons/manifest.json')}}">
    <meta name="theme-color" content="#ffffff">
    <script src="{{ asset('vendors/simplebar/simplebar.min.js')}}"></script>
    <script src="{{ asset('assets_admin/js/config.js')}}"></script>
  <!-- DataTables CSS -->

  
    <!-- ===============================================-->
    <!--    Stylesheets-->
    <!-- ===============================================-->   
    <link href="{{ asset('assets/vendors/dropzone/dropzone.css')}}" rel="stylesheet">
    <link href="{{ asset('assets/vendors/choices/choices.min.css')}}" rel="stylesheet">
    <link href="{{ asset('assets/vendors/flatpickr/flatpickr.min.css')}}" rel="stylesheet">

    <link rel="preconnect" href="{{ asset('../../../fonts.googleapis.com/index.html')}}">
    <link rel="preconnect" href="{{ asset('../../../fonts.gstatic.com/index.html')}}" crossorigin="">
    <link href="../../../fonts.googleapis.com/css275fb.css?family=Nunito+Sans:wght@300;400;600;700;800;900&amp;display=swap" rel="stylesheet">
    <link href="{{ asset('assets/vendors/simplebar/simplebar.min.css')}}" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" crossorigin="anonymous">
    <link href="https://cdn.datatables.net/v/dt/jszip-3.10.1/dt-2.1.7/b-3.1.2/b-html5-3.1.2/b-print-3.1.2/datatables.min.css" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('unicons.iconscout.com/release/v4.0.8/css/line.css')}}">
    <link href="{{ asset('assets_admin/css/theme-rtl.css')}}" type="text/css" rel="stylesheet" id="style-rtl">
    <link href="{{ asset('assets_admin/css/theme.min.css')}}" type="text/css" rel="stylesheet" id="style-default">
    <link href="{{ asset('assets_admin/css/user-rtl.min.css')}}" type="text/css" rel="stylesheet" id="user-style-rtl">
    <link href="{{ asset('assets_admin/css/user.min.css')}}" type="text/css" rel="stylesheet" id="user-style-default">
    <script>
      var phoenixIsRTL = window.config.config.phoenixIsRTL;
      if (phoenixIsRTL) {
        var linkDefault = document.getElementById('style-default');
        var userLinkDefault = document.getElementById('user-style-default');
        linkDefault.setAttribute('disabled', true);
        userLinkDefault.setAttribute('disabled', true);
        document.querySelector('html').setAttribute('dir', 'rtl');
      } else {
        var linkRTL = document.getElementById('style-rtl');
        var userLinkRTL = document.getElementById('user-style-rtl');
        linkRTL.setAttribute('disabled', true);
        userLinkRTL.setAttribute('disabled', true);
      }
    </script>
    <link href="{{ asset('vendors/leaflet/leaflet.css')}}" rel="stylesheet">
    <link href="{{ asset('vendors/leaflet.markercluster/MarkerCluster.css')}}" rel="stylesheet">
    <link href="{{ asset('vendors/leaflet.markercluster/MarkerCluster.Default.css')}}" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('assets/css/animate.min.css')}}">
    <link rel="stylesheet" href="{{ asset('assets/css/magnific-popup.css')}}">
    <link rel="stylesheet" href="{{ asset('assets/css/fontawesome-all.min.css')}}">
    <link rel="stylesheet" href="{{ asset('assets/css/flaticon.css')}}">
    <link rel="stylesheet" href="{{ asset('assets/css/odometer.css')}}">
    <link rel="stylesheet" href="{{ asset('assets/css/swiper-bundle.css')}}">
    <link rel="stylesheet" href="{{ asset('assets/css/aos.css')}}">
    <link rel="stylesheet" href="{{ asset('assets/css/default.css')}}">
    <link rel="stylesheet" href="{{ asset('assets/css/main.css')}}">
    <link rel="stylesheet" href="{{ asset('assets/css/style.css')}}">
    <link href="https://cdn.quilljs.com/1.3.6/quill.snow.css" rel="stylesheet">
</head>

<body>
  <div id="preloader">
    <div id="loader" class="loader">
        <div class="loader-container">
            <div class="loader-icon"><img src="{{ asset('assets/img/logo/Logo_yako.png')}}" alt="Preloader"></div>
        </div>
    </div>
</div>
    <main class="main" id="top">
    @include('admins.layouts.header') 
    <div class="content wrapper">
        @yield('content-admin')
          <!-- brand-area -->
    
        <!-- footer-area -->
        @include('admins.layouts.footer')
        <!-- footer-area-end -->
    </div> 
    </main> 
    <!--    JavaScripts-->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    {{-- <!-- ===============================================-->
    <script src="{{ asset('vendors/popper/popper.min.js')}}"></script>
    <script src="{{ asset('vendors/bootstrap/bootstrap.min.js')}}"></script> --}}
    <script src="{{ asset('assets/vendors/anchorjs/anchor.min.js')}}"></script>
    <script src="{{ asset('assets/vendors/is/is.min.js')}}"></script>
    <script src="{{ asset('assets/vendors/fontawesome/all.min.js')}}"></script>
    <script src="{{ asset('assets/vendors/lodash/lodash.min.js')}}"></script>
    <script src="{{ asset('assets/vendors/list.js/list.min.js')}}"></script>
    <script src="{{ asset('assets/vendors/feather-icons/feather.min.js')}}"></script>
    <script src="{{ asset('assets/vendors/dayjs/dayjs.min.js')}}"></script>
    <script src="{{ asset('assets/vendors/dropzone/dropzone-min.js')}}"></script>
    <script src="{{ asset('assets/vendors/choices/choices.min.js')}}"></script>
    <script src="{{ asset('assets/vendors/flatpickr/flatpickr.min.js')}}"></script>

    <script src="{{ asset('assets/vendors/list.js/list.min.js')}}"></script>
    <script src="{{ asset('assets/vendors/feather-icons/feather.min.js')}}"></script>
    <script src="{{ asset('assets/vendors/dayjs/dayjs.min.js')}}"></script>
    <script src="{{ asset('assets/vendors/echarts/echarts.min.js')}}"></script>
    {{-- <script src="{{ asset('assets_admin/js/phoenix.js')}}"></script> --}}
    
    <link href="https://cdn.jsdelivr.net/npm/quill@2.0.2/dist/quill.snow.css" rel="stylesheet" />
    <link
    rel="stylesheet"
    href="https://cdnjs.cloudflare.com/ajax/libs/highlight.js/11.9.0/styles/atom-one-dark.min.css"
    />
    
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/katex@0.16.9/dist/katex.min.css" />
    
    <script src="{{ asset('assets_admin/js/phoenix.js')}}"></script>
    <script src="{{ asset('assets_admin/js/crm-dashboard.js')}}"></script>
    <script src="{{ asset('assets/vendors/echarts/echarts.min.js')}}"></script>
    <script src="{{ asset('assets_admin/js/ecommerce-dashboard.js')}}"></script>
    
    {{-- <script src="https://code.jquery.com/jquery-3.7.0.min.js"></script> --}}
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
  
    <!-- jQuery -->
    <!-- DataTables JS -->
    <script src="https://cdn.datatables.net/v/dt/jszip-3.10.1/dt-2.1.7/b-3.1.2/b-html5-3.1.2/b-print-3.1.2/datatables.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.2.7/pdfmake.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.2.7/vfs_fonts.js"></script>
    <!-- Intégration de TinyMCE -->
{{-- <script src="https://cdn.tiny.cloud/1/e4q046jo98cfguf7vaznxbg6xd76cu5k0jo48gj1lmgev6ns/tinymce/5/tinymce.min.js" referrerpolicy="origin"></script> --}}
{{-- <script src="https://cdn.tiny.cloud/1/kg2a972ahr2168hldgqbpvjf40zbz0qvm85m5tc2ptonejxs/tinymce/7/tinymce.min.js" referrerpolicy="origin"></script> --}}
<script src="https://cdnjs.cloudflare.com/ajax/libs/highlight.js/11.9.0/highlight.min.js"></script>
{{-- <script src="https://cdn.jsdelivr.net/npm/quill@2.0.2/dist/quill.js"></script> --}}
<script src="https://cdn.tiny.cloud/1/pfjd5f3rf5sx7e99t8p7wi1x9yz3phproft7hk92nakivoru/tinymce/7/tinymce.min.js" referrerpolicy="origin"></script>

<script>
  tinymce.init({
  selector: 'textarea.tinymce-editor',
  height: 300,
  plugins: [
    'advlist', 'autolink', 'lists', 'link', 'image', 'charmap', 'preview',
    'anchor', 'searchreplace', 'visualblocks', 'code', 'fullscreen',
    'insertdatetime', 'media', 'table', 'help', 'wordcount', 'image', 'media', 'code'
  ],
  toolbar: 'undo redo | blocks | ' +
  'bold italic backcolor | alignleft aligncenter ' +
  'alignright alignjustify | bullist numlist outdent indent | ' +
  'image media link | removeformat | help',
  content_style: 'body { font-family:Helvetica,Arial,sans-serif; font-size:16px }',
  image_title: true,
  automatic_uploads: true,
  file_picker_types: 'image media',
  
  // Permet le téléchargement depuis le PC
  file_picker_callback: function(callback, value, meta) {
    var input = document.createElement('input');
    input.setAttribute('type', 'file');
    
    // Autoriser les types d'images et de vidéos
    if (meta.filetype === 'image') {
      input.setAttribute('accept', 'image/*');
    } else if (meta.filetype === 'media') {
      input.setAttribute('accept', 'video/*');
    }
    
    input.onchange = function() {
      var file = this.files[0];
      
      // Télécharger l'image ou la vidéo ici
      var reader = new FileReader();
      reader.onload = function () {
        var id = 'blobid' + (new Date()).getTime();
        var blobCache = tinymce.activeEditor.editorUpload.blobCache;
        var base64 = reader.result.split(',')[1];
        var blobInfo = blobCache.create(id, file, base64);
        blobCache.add(blobInfo);

        // Appeler le callback pour insérer le fichier
        callback(blobInfo.blobUri(), { title: file.name });
      };
      reader.readAsDataURL(file);
    };
    
    input.click();
  }
});
</script>

<script>
  document.addEventListener("DOMContentLoaded", function() {
      var datepicker = document.getElementById("todaydatepicker");

      if (datepicker) {
          var today = new Date();
          
          // Formatage manuel de la date
          var months = ["janv.", "févr.", "mars", "avr.", "mai", "juin", "juil.", "août", "sept.", "oct.", "nov.", "déc."];
          var formattedDate = today.getDate() + " " + months[today.getMonth()] + ", " + today.getFullYear();

          datepicker.value = formattedDate; // Remplissage manuel du champ

          flatpickr("#todaydatepicker", {
              dateFormat: "d M, Y",
              disableMobile: true,
              defaultDate: today
          });
      }
  });
</script>
{{-- <script>
  // Sélectionner toutes les zones de saisie avec la classe 'editor-container'
  var editors = document.querySelectorAll('.editor-container');

  // Créer un objet pour stocker les instances de Quill
  var quills = {};

  // Initialiser Quill pour chaque zone de saisie
  editors.forEach(function(editor, index) {
    var quillId = 'quill-' + index; // Créer un identifiant unique pour chaque éditeur
    quills[quillId] = new Quill(editor, {
      theme: 'snow',
      modules: {
        toolbar: [
          // Dropdowns pour la taille du texte, les en-têtes et les polices
          [{ 'font': [] }],
          [{ 'size': ['small', false, 'large', 'huge'] }],  // Taille du texte
          [{ 'header': [1, 2, 3, 4, 5, 6, false] }],  // En-têtes

          // Options de mise en forme (gras, italique, souligné, barré)
          ['bold', 'italic', 'underline', 'strike'],

          // Gestion des couleurs de texte et de fond
          [{ 'color': [] }, { 'background': [] }],  // Couleurs

          // Listes, indentation, et alignements
          [{ 'list': 'ordered' }, { 'list': 'bullet' }],
          [{ 'indent': '-1' }, { 'indent': '+1' }],  // Indentation
          [{ 'align': [] }],  // Alignement du texte

          // Citation et bloc de code
          ['blockquote', 'code-block'],

          // Insertion de liens, images et vidéos
          ['link', 'image', 'video'],

          // Nettoyage des formats
          ['clean']  // Supprimer les formats
        ]
      },
      placeholder: 'Écrivez quelque chose...',
    });
  });

  // Sauvegarder le contenu de chaque éditeur Quill dans son champ caché lors de l'envoi du formulaire
  document.querySelector('form').onsubmit = function() {
    editors.forEach(function(editor, index) {
      var quillId = 'quill-' + index;
      var hiddenInput = document.getElementById('hidden-description-' + (index + 1)); // Trouver le champ caché correspondant
      hiddenInput.value = quills[quillId].root.innerHTML; // Enregistrer le contenu HTML
    });
  };
</script> --}}


<script>
  new DataTable('#example', {
      layout: {
          topStart: {
              buttons: ['copy', 'csv', 'excel', 'pdf', 'print']
          }
      }
  });
</script>

{{-- <script>
  $(document).ready(function() {
      $('#example').DataTable({
          dom: '<"top"lfB>rt<"bottom"ip><"clear">',
          buttons: ['copy', 'csv', 'excel', 'pdf', 'print'],
          pageLength: 25, // Nombre par défaut
          lengthMenu: [ [10, 25, 50, 100], [10, 25, 50, 100] ],
          language: {
              lengthMenu: 'Show <select>'+
                          '<option value="10">10</option>'+
                          '<option value="25">25</option>'+
                          '<option value="50">50</option>'+
                          '<option value="100">100</option>'+
                          '</select> entries',
              search: "Search:" // Pour correspondre à la zone de recherche
          }
      });
  });
</script> --}}
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="{{ asset('assets_admin/js/script.js')}}"></script>

    <script src="{{ asset('assets/js/jquery.magnific-popup.min.js')}}"></script>
    <script src="{{ asset('assets/js/jquery.odometer.min.js')}}"></script>
    <script src="{{ asset('assets/js/jquery.appear.js')}}"></script>
    <script src="{{ asset('assets/js/gsap.js')}}"></script>
    <script src="{{ asset('assets/js/ScrollTrigger.js')}}"></script>
    <script src="{{ asset('assets/js/SplitText.js')}}"></script>
    <script src="{{ asset('assets/js/gsap-animation.js')}}"></script>
    <script src="{{ asset('assets/js/jquery.parallaxScroll.min.js')}}"></script>
    <script src="{{ asset('assets/js/swiper-bundle.js')}}"></script>
    <script src="{{ asset('assets/js/ajax-form.js')}}"></script>
    <script src="{{ asset('assets/js/wow.min.js')}}"></script>
    <script src="{{ asset('assets/js/aos.js')}}"></script>
    <script src="{{ asset('assets/js/main.js')}}"></script>
    
    
   
    <script>
        function rangeSlide(value) {
            document.getElementById('rangeValue').innerHTML = value;
        }
    </script>
    <script>
        var navbarTopShape = window.config.config.phoenixNavbarTopShape;
        var navbarPosition = window.config.config.phoenixNavbarPosition;
        var body = document.querySelector('body');
        var navbarDefault = document.querySelector('#navbarDefault');
        var navbarTop = document.querySelector('#navbarTop');
        var topNavSlim = document.querySelector('#topNavSlim');
        var navbarTopSlim = document.querySelector('#navbarTopSlim');
        var navbarCombo = document.querySelector('#navbarCombo');
        var navbarComboSlim = document.querySelector('#navbarComboSlim');
        var dualNav = document.querySelector('#dualNav');
  
        var documentElement = document.documentElement;
        var navbarVertical = document.querySelector('.navbar-vertical');
  
        if (navbarPosition === 'dual-nav') {
          topNavSlim?.remove();
          navbarTop?.remove();
          navbarTopSlim?.remove();
          navbarCombo?.remove();
          navbarComboSlim?.remove();
          navbarDefault?.remove();
          navbarVertical?.remove();
          dualNav.removeAttribute('style');
          document.documentElement.setAttribute('data-navigation-type', 'dual');
  
        } else if (navbarTopShape === 'slim' && navbarPosition === 'vertical') {
          navbarDefault?.remove();
          navbarTop?.remove();
          navbarTopSlim?.remove();
          navbarCombo?.remove();
          navbarComboSlim?.remove();
          topNavSlim.style.display = 'block';
          navbarVertical.style.display = 'inline-block';
          document.documentElement.setAttribute('data-navbar-horizontal-shape', 'slim');
  
        } else if (navbarTopShape === 'slim' && navbarPosition === 'horizontal') {
          navbarDefault?.remove();
          navbarVertical?.remove();
          navbarTop?.remove();
          topNavSlim?.remove();
          navbarCombo?.remove();
          navbarComboSlim?.remove();
          dualNav?.remove();
          navbarTopSlim.removeAttribute('style');
          document.documentElement.setAttribute('data-navbar-horizontal-shape', 'slim');
        } else if (navbarTopShape === 'slim' && navbarPosition === 'combo') {
          navbarDefault?.remove();
          navbarTop?.remove();
          topNavSlim?.remove();
          navbarCombo?.remove();
          navbarTopSlim?.remove();
          dualNav?.remove();
          navbarComboSlim.removeAttribute('style');
          navbarVertical.removeAttribute('style');
          document.documentElement.setAttribute('data-navbar-horizontal-shape', 'slim');
        } else if (navbarTopShape === 'default' && navbarPosition === 'horizontal') {
          navbarDefault?.remove();
          topNavSlim?.remove();
          navbarVertical?.remove();
          navbarTopSlim?.remove();
          navbarCombo?.remove();
          navbarComboSlim?.remove();
          dualNav?.remove();
          navbarTop.removeAttribute('style');
          document.documentElement.setAttribute('data-navigation-type', 'horizontal');
        } else if (navbarTopShape === 'default' && navbarPosition === 'combo') {
          topNavSlim?.remove();
          navbarTop?.remove();
          navbarTopSlim?.remove();
          navbarDefault?.remove();
          navbarComboSlim?.remove();
          dualNav?.remove();
          navbarCombo.removeAttribute('style');
          navbarVertical.removeAttribute('style');
          document.documentElement.setAttribute('data-navigation-type', 'combo');
        } else {
          topNavSlim?.remove();
          navbarTop?.remove();
          navbarTopSlim?.remove();
          navbarCombo?.remove();
          navbarComboSlim?.remove();
          dualNav?.remove();
          navbarDefault.removeAttribute('style');
          navbarVertical.removeAttribute('style');
        }
  
        var navbarTopStyle = window.config.config.phoenixNavbarTopStyle;
        var navbarTop = document.querySelector('.navbar-top');
        if (navbarTopStyle === 'darker') {
          navbarTop.setAttribute('data-navbar-appearance', 'darker');
        }
  
        var navbarVerticalStyle = window.config.config.phoenixNavbarVerticalStyle;
        var navbarVertical = document.querySelector('.navbar-vertical');
        if (navbarVerticalStyle === 'darker') {
          navbarVertical.setAttribute('data-navbar-appearance', 'darker');
        }
      </script>
      


</body>

<!-- Mirrored from apexa-html-demo.vercel.app/index-8 by HTTrack Website Copier/3.x [XR&CO'2014], Mon, 05 Aug 2024 17:43:47 GMT -->
</html>