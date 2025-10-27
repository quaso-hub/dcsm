<!DOCTYPE html>
<html lang="en">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description"
        content="Cuba admin is super flexible, powerful, clean &amp; modern responsive bootstrap 5 admin template with unlimited possibilities.">
    <meta name="keywords"
        content="admin template, Cuba admin template, dashboard template, flat admin template, responsive admin template, web app">
    <meta name="author" content="pixelstrap">
    <link rel="icon" href="{{ asset('assets/images/favicon.png') }}" type="image/x-icon">
    <link rel="shortcut icon" href="{{ asset('assets/images/favicon.png') }}" type="image/x-icon">
    <title>AJOFOOD - ADMIN</title>
    <!-- Google font-->
    <link href="https://fonts.googleapis.com/css?family=Rubik:400,400i,500,500i,700,700i&amp;display=swap"
        rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Roboto:300,300i,400,400i,500,500i,700,700i,900&amp;display=swap"
        rel="stylesheet">

    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">


    @include('admin.layouts.css')
    @yield('style')
    <style>
        .animated-logo {
            transition: all 0.3s ease;
        }

        .animated-logo:hover {
            transform: scale(1.05);
        }

        .logo-icon {
            transition: transform 0.3s ease;
        }

        .animated-logo:hover .logo-icon {
            transform: rotate(-5deg) scale(1.1);
        }


        .sidebar-link i {
            transition: transform 0.2s ease;
        }

        .sidebar-link:hover i {
            transform: scale(1.1);
        }


        .sidebar-icon {
            transition: color 0.3s ease, transform 0.3s ease;
            color: #6c757d;
        }

        .dark .sidebar-icon {
            color: #dcdcdc;
        }

        .sidebar-link:hover .sidebar-icon {
            transform: scale(1.1);
            color: #6366f1;
        }

        .toggle-icon {
            font-size: 1.4rem;
            cursor: pointer;
            transition: transform 0.3s ease, color 0.3s ease;
            color: #6c757d;
        }

        .toggle-icon:hover {
            transform: rotate(90deg);
            color: #0d6efd;
        }

        .dark .toggle-icon {
            color: #ccc;
        }


        .sidebar-link i.fa-credit-card {
            color: var(--theme-color, #6c757d);
            transition: color 0.3s ease;
        }

        body.dark-only .sidebar-link i.fa-credit-card {
            color: #e0e0ff;
        }

        body.light-only .sidebar-link i.fa-credit-card {
            color: #5c5c5c;
        }


        #basic-1 {
            width: 100%;
            border-radius: 12px;
            overflow: hidden;
            transition: all 0.3s ease-in-out;
        }

        #basic-1 th,
        #basic-1 td {
            padding: 14px 16px !important;
            vertical-align: middle;
        }

        #basic-1 thead th {
            font-weight: 600;
            font-size: 0.95rem;
            border-bottom: 1px solid transparent;
            background-color: #f5f5f5;
            color: #212529;
            transition: all 0.2s;
        }

        #basic-1 tbody tr {
            transition: background-color 0.2s ease-in-out;
        }

        #basic-1 tbody tr:hover {
            background-color: rgba(0, 0, 0, 0.03);
        }

        .table-responsive {
            overflow-x: auto;
            scrollbar-width: none;
            -ms-overflow-style: none;
        }

        .table-responsive::-webkit-scrollbar {
            display: none;
        }

        .dataTables_wrapper .dataTables_paginate .paginate_button {
            background: none !important;
            border: none !important;
            box-shadow: none !important;
            padding: 6px 12px;
            margin: 0 3px;
            border-radius: 6px;
            color: inherit;
            font-weight: 500;
            transition: background 0.2s ease, color 0.2s ease;
        }

        .dataTables_wrapper .dataTables_paginate .paginate_button.current {
            background-color: #6366f1 !important;
            color: white !important;
        }

        .dataTables_wrapper .dataTables_paginate .paginate_button:hover:not(.current) {
            background-color: rgba(0, 0, 0, 0.05) !important;
            color: #000 !important;
        }

        body.dark-only .dataTables_wrapper .dataTables_paginate .paginate_button {
            color: #ccc !important;
        }

        body.dark-only .dataTables_wrapper .dataTables_paginate .paginate_button.current {
            background-color: #7c3aed !important;
            color: white !important;
        }

        body.dark-only .dataTables_wrapper .dataTables_paginate .paginate_button:hover:not(.current) {
            background-color: rgba(255, 255, 255, 0.08) !important;
            color: white !important;
        }


        body.dark-only #basic-1 thead th {
            background-color: #2a2e39;
            color: #f1f1f1;
        }

        body.dark-only #basic-1 tbody tr:hover {
            background-color: rgba(255, 255, 255, 0.05);
        }

        table.dataTable {
            border-collapse: separate !important;
            border-spacing: 0;
        }

        table.dataTable.no-footer {
            border-bottom: none !important;
        }

        table.dataTable thead th,
        table.dataTable thead td {
            border-bottom: none !important;
        }

        #basic-1 tbody tr {
            animation: fadein 0.3s ease-in-out;
        }

        @keyframes fadein {
            from {
                opacity: 0;
                transform: translateY(5px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        table.dataTable {
            border-collapse: separate !important;
            border-spacing: 0 8px !important;
        }

        /* Header Table*/
        /* table.dataTable thead th {
            white-space: normal !important;
            vertical-align: middle !important;
            text-align: center !important;
            padding: 12px 8px !important;
            font-weight: 600;
            word-break: break-word;
            line-height: 1.3;
            max-width: 140px;
        } */


        body.dark-only table.dataTable tbody td {
            background-color: #2a2e37 !important;
            color: #fff;
        }

        body.dark-only table.dataTable tbody tr:hover td {
            background-color: #3b4049 !important;
        }

        body.dark-only table.dataTable thead th {
            color: #e0e0e0 !important;
        }

        table.dataTable thead th.sorting::before,
        table.dataTable thead th.sorting_asc::before,
        table.dataTable thead th.sorting_desc::before {
            display: none !important;
            content: none !important;
        }

        table.dataTable thead th {
            position: relative;
            vertical-align: middle;
            white-space: nowrap;
            padding-right: 20px;
        }

        table.dataTable thead th.sorting_asc::after {
            content: "\2191";
        }

        table.dataTable thead th.sorting_desc::after {
            content: "\2193";
        }

        table.dataTable thead th.sorting::after,
        table.dataTable thead th.sorting_asc::after,
        table.dataTable thead th.sorting_desc::after {
            position: absolute;
            right: 8px;
            top: 50%;
            transform: translateY(-50%);
            font-size: 12px;
            color: #999;
            opacity: 0.6;
            pointer-events: none;
        }


        /* Global SweetAlert2 override */
        body.dark-only .swal2-popup {
            background: #2a2e37 !important;
            color: #fff !important;
        }

        body.dark-only .swal2-title {
            color: #fff !important;
        }

        body.dark-only .swal2-content {
            color: #ddd !important;
        }

        body.dark-only .swal2-confirm {
            background-color: #7c3aed !important;
            color: #fff !important;
        }

        body.dark-only .swal2-cancel {
            background-color: #444 !important;
            color: #fff !important;
        }

        body:not(.dark-only) .swal2-popup {
            background: #fff !important;
            color: #000 !important;
        }

        body:not(.dark-only) .swal2-title,
        body:not(.dark-only) .swal2-content {
            color: #212529 !important;
        }

        body:not(.dark-only) .swal2-confirm {
            background-color: #6366f1 !important;
            color: #fff !important;
        }

        body:not(.dark-only) .swal2-cancel {
            background-color: #e0e0e0 !important;
            color: #000 !important;
        }

        .modal-backdrop.show {
            opacity: 0.4;
            z-index: 1040;
        }

        body.modal-open {
            overflow: hidden !important;
        }


        /* hide all scrollbar */
        ::-webkit-scrollbar {
            display: none;
        }

        body {
            scrollbar-width: none;
            -ms-overflow-style: none;
        }

        html,
        body {
            overflow-y: scroll;
        }
    </style>
</head>
{{-- @dd(Route::current()->getName()); --}}

<body
    @if (Route::current()->getName() == 'index') onload="startTime()" @elseif (Route::current()->getName() == 'button-builder') class="button-builder" @endif>
    <div class="loader-wrapper">
        <div class="loader-index"><span></span></div>
        <svg>
            <defs></defs>
            <filter id="goo">
                <fegaussianblur in="SourceGraphic" stddeviation="11" result="blur"></fegaussianblur>
                <fecolormatrix in="blur" values="1 0 0 0 0  0 1 0 0 0  0 0 1 0 0  0 0 0 19 -9" result="goo">
                </fecolormatrix>
            </filter>
        </svg>
    </div>
    <!-- tap on top starts-->
    <div class="tap-top"><i data-feather="chevrons-up"></i></div>
    <!-- tap on tap ends-->
    <!-- page-wrapper Start-->
    <div class="page-wrapper compact-wrapper" id="pageWrapper">
        <!-- Page Header Start-->
        @include('admin.layouts.header')
        <!-- Page Header Ends  -->
        <!-- Page Body Start-->
        <div class="page-body-wrapper">
            <!-- Page Sidebar Start-->
            @include('admin.layouts.sidebar')
            <!-- Page Sidebar Ends-->
            <div class="page-body">
                <div class="container-fluid">
                    <div class="page-title">
                        <div class="row">
                            <div class="col-6">
                                @yield('breadcrumb-title')
                            </div>
                            <div class="col-6">
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item"><a href="{{ route('dashboard.index') }}">
                                            <svg class="stroke-icon">
                                                <use href="{{ asset('assets/svg/icon-sprite.svg#stroke-home') }}"></use>
                                            </svg></a></li>
                                    </li>
                                    @yield('breadcrumb-items')
                                </ol>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Container-fluid starts-->
                @yield('content')
                <!-- Container-fluid Ends-->
            </div>
            <!-- footer start-->
            @include('admin.layouts.footer')

        </div>
    </div>
    <!-- latest jquery-->
    @include('admin.layouts.script')
    <!-- Plugin used-->

    {{-- <script type="text/javascript">
      if ($(".page-wrapper").hasClass("horizontal-wrapper")) {
            $(".according-menu.other" ).css( "display", "none" );
            $(".sidebar-submenu" ).css( "display", "block" );
      }
    </script> --}}
</body>

</html>
