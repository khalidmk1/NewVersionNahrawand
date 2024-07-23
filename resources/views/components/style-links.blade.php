<!-- Google Font: Source Sans Pro -->
<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">

<link rel="stylesheet" href="https://unpkg.com/swiper/swiper-bundle.min.css" />

<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/selectize@0.12.6/dist/css/selectize.default.css">

<!-- Tempusdominus Bootstrap 4 -->
<link rel="stylesheet" href="{{ asset('plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css') }}">


<!-- Font Awesome Icons -->
<link rel="stylesheet" href="{{ asset('plugins/fontawesome-free/css/all.min.css') }}">
<!-- overlayScrollbars -->
<link rel="stylesheet" href="{{ asset('plugins/overlayScrollbars/css/OverlayScrollbars.min.css') }}">
<!-- icheck bootstrap -->
<link rel="stylesheet" href="{{ asset('plugins/icheck-bootstrap/icheck-bootstrap.min.css') }}">
<!-- Theme style -->
<link rel="stylesheet" href="{{ asset('dist/css/adminlte.min.css') }}">



<!-- DataTables -->
<link rel="stylesheet" href="{{ asset('plugins/datatables-bs4/css/dataTables.bootstrap4.min.css') }}">
<link rel="stylesheet" href="{{ asset('plugins/datatables-responsive/css/responsive.bootstrap4.min.css') }}">
<link rel="stylesheet" href="{{ asset('plugins/datatables-buttons/css/buttons.bootstrap4.min.css') }}">

<!-- Select2 -->
<link rel="stylesheet" href="{{ asset('plugins/select2/css/select2.min.css') }}">
<link rel="stylesheet" href="{{ asset('plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css') }}">
<!-- Daterange picker -->
<link rel="stylesheet" href="{{ asset('plugins/daterangepicker/daterangepicker.css') }}">

<!-- summernote -->
<link rel="stylesheet" href="{{ asset('plugins/summernote/summernote-bs4.min.css') }}">





<style>
    /* slider */
    .swiper {
        width: 100%;
    }

    .card-event {
        background: #fff;
        border-radius: 20px;
        margin: 20px 0;
        box-shadow: 0 5px 10px rgba(0, 0, 0, 0.1);

    }

    .slider-image {
        background-position: center center !important;
        background-repeat: no-repeat !important;
        background-size: cover !important;
        position: relative !important;
        width: 272px;
        margin-right: 30px;
        height: 275px !important;
    }

    .text-slider {
        background: #0006;
        text-align: center;
        padding: 5px;
        border-bottom-left-radius: 19px;
        bottom: -241px;
        position: relative;
        border-bottom-right-radius: 19px;
    }

    .image-wrapper{
        margin-bottom: 6px;
        align-items: center;
        gap: 2px;
    }

    .image-wrapper .trash-icon{
        cursor: pointer;
        position: absolute;
        top: 0;
    }


    .image-wrapper img {
        width: 25%;
        height: auto;
    }

    .input-containe .form-control {
        margin-top: 10px
    }

    .trash-icon-update{
        position: absolute;
        cursor: pointer;
        color: red;
        right: 13px;
        top: 9px;
    }

    #additional-images-wrapper img{
        width: 29%;
        display: flex
    }


    .image-wrapper-palce img {
        width: 100%;
        height: 49%;
        margin-right: 10px;
    }

    .image-wrapper-palce .trash-icon {
        cursor: pointer;
        color: red;
        position: absolute;
        top: 0;
        left: -11px;
    }

    

    .image-wrapper-images .trash-icon {
        position: absolute;
        cursor: pointer;
        color: red;
        right: 0px;
        top: -10px;
    }

    .additional-images-wrapper {
        margin-top: 10px;
    }

    .additional-image-wrapper img {
        width: 100px;
        height: auto;
    }

    .additional-trash-icon {
        position: relative;
        top: -35px;
        right: 10px;
        cursor: pointer;
        background-color: white;
        border-radius: 50%;
        padding: 5px;
    }

    .select2-container--default .select2-selection--multiple .select2-selection__rendered li:first-child.select2-search.select2-search--inline .select2-search__field {
        color: black !important;
    }

    .dark-mode .select2-container .select2-search--inline .select2-search__field {
        color: black !important;
    }


    .notification-icon {
        z-index: 100000;
    }

    .select2-container--default .select2-selection--single {
        height: 37px !important;
    }

    .bootstrap-tagsinput {
        border: #ffffffc6 solid 1px;
        padding: 4px;
        border-radius: 3px;

    }

    .image-with-text {
        position: relative;
        display: inline-block;
        margin-bottom: 10px;
        /* Adjust as needed */
    }

    .image-text {
        position: absolute;
        bottom: 0;
        left: 0;
        width: 100%;
        background-color: rgba(0, 0, 0, 0.5);
        /* Semi-transparent background */
        color: white;
        padding: 5px;
        text-align: center;
    }

    .pagination {
        display: flex !important;
    }

    .bootstrap-tagsinput:first-child {
        border: none,

    }

    .bootstrap-tagsinput .tag {
        background: rgb(163, 159, 154);
        padding: 4px;
        font-size: 14px;
    }

    .select2-container--default .select2-selection--multiple .select2-selection__rendered li {
        color: black
    }

    .pagination {
        display: inline-block;
    }

    .pagination a {
        color: black;
        float: left;
        padding: 8px 16px;
        text-decoration: none;
    }

    .pagination a.active {
        background-color: #4CAF50;
        color: white;
    }

    .pagination a:hover:not(.active) {
        background-color: #ddd;
    }
</style>
