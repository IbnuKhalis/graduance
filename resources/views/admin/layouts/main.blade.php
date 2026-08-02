<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Dashboard - Graduation Graduated</title>
    <link rel="shortcut icon" type="image/svg+xml" href="/assets/img/favicon.svg" />
    <link rel="icon" type="image/svg+xml" href="/assets/img/favicon.svg" />
    <link rel="stylesheet" href="/admin/assets/css/styles.min.css" />
    <link rel="stylesheet" href="/assets/css/style.css" />
    <meta name="csrf-token" content="{{ csrf_token() }}" />


    <!-- Jquery -->
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"
        integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>

    <!-- Select2 -->
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />

    <!-- Datatable CSS -->
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/jquery.dataTables.min.css">

    <!-- Tabler Icons CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@tabler/icons-webfont@latest/tabler-icons.min.css">

    <!-- Bootstrap Icon -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">

    <!-- Ck Editor -->
    <script src="https://cdn.ckeditor.com/ckeditor5/39.0.2/classic/ckeditor.js"></script>

    <!-- Appex -->
    <script src="/admin/assets/libs/apexcharts/dist/apexcharts.min.js"></script>
    @stack('scripts')
</head>

<body>
    <div class="page-wrapper" id="main-wrapper" data-layout="vertical" data-navbarbg="skin6" data-sidebartype="full"
        data-sidebar-position="fixed" data-header-position="fixed">
        @include('admin.partials.sidebar')
        <div class="body-wrapper">
            @include('admin.partials.header')
            <div class="container-fluid d-flex flex-column" style="min-height: calc(100vh - 70px);">
                <div class="flex-grow-1">
                    @yield('content')
                </div>
                @include('admin.partials.footer')
            </div>
        </div>
    </div>
    <script src="/admin/assets/libs/jquery/dist/jquery.min.js"></script>
    <script src="/admin/assets/libs/bootstrap/dist/js/bootstrap.bundle.min.js"></script>
    <script type="text/javascript" src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
    <script src="/admin/assets/js/sidebarmenu.js"></script>
    <script src="/admin/assets/js/app.min.js"></script>
    <script src="/admin/assets/libs/simplebar/dist/simplebar.js"></script>
    <script src="/admin/assets/js/dashboard.js"></script>
    <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
    @include('sweetalert::alert')
    <script>
        $(".swal-confirm").click(function(e) {
            e.preventDefault();
            var form = $(this).attr('data-form');
            Swal.fire({
                title: 'Delete this data ?',
                text: "You will not be able to restore deleted data !",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#d33',
                cancelButtonColor: '#3085d6',
                confirmButtonText: 'Yes, Delete!',
                cancelButtonText: 'Cancel'
            }).then((result) => {
                if (result.isConfirmed) {
                    $('#' + form).submit();
                }
            })
        });
    </script>

</body>

</html>
