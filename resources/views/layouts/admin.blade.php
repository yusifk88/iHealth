<!DOCTYPE html>
<html lang="en">
<head>
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta content='width=device-width, initial-scale=1.0, shrink-to-fit=no' name='viewport' />
    <link rel="icon" href="/assets/img/icon.ico" type="image/x-icon"/>
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>
    <!-- Fonts and icons -->
    <script src="/assets/js/plugin/webfont/webfont.min.js"></script>
    <script>
        WebFont.load({
            google: {"families":["Lato:300,400,700,900"]},
            custom: {"families":["Flaticon", "Font Awesome 5 Solid", "Font Awesome 5 Regular", "Font Awesome 5 Brands", "simple-line-icons"], urls: ['../assets/css/fonts.min.css']},
            active: function() {
                sessionStorage.fonts = true;
            }
        });
    </script>

    <!-- CSS Files -->
    <link rel="stylesheet" href="/assets/css/bootstrap.min.css">
    <link rel="stylesheet" href="/assets/css/atlantis.min.css">

    <!-- CSS Just for demo purpose, don't include it in your project -->
    <link rel="stylesheet" href="/assets/css/demo.css">
</head>
<body>
<div class="wrapper">
    <div class="main-header">
        <!-- Logo Header -->
        <div class="logo-header" data-background-color="white">

            <a href="/"  class="navbar-brand ">

                iHealth Admin
            </a>
            <button class="navbar-toggler sidenav-toggler ml-auto" type="button" data-toggle="collapse" data-target="collapse" aria-expanded="false" aria-label="Toggle navigation">
					<span class="navbar-toggler-icon">
						<i class="icon-menu"></i>
					</span>
            </button>
            <button class="topbar-toggler more"><i class="icon-options-vertical"></i></button>
            <div class="nav-toggle">
                <button class="btn btn-toggle toggle-sidebar">
                    <i class="icon-menu"></i>
                </button>
            </div>
        </div>
        <!-- End Logo Header -->

        <!-- Navbar Header -->
        <nav class="navbar navbar-header navbar-expand-lg" data-background-color="white">

            <div class="container-fluid">

                <ul class="navbar-nav topbar-nav ml-md-auto align-items-center">


                    <li class="nav-item dropdown hidden-caret">
                        <a class="dropdown-toggle profile-pic" data-toggle="dropdown" href="#" aria-expanded="false">
                            <div class="avatar-sm">
                                <img src="/assets/img/profile.jpg" alt="..." class="avatar-img rounded-circle">
                            </div>
                        </a>
                        <ul class="dropdown-menu dropdown-user animated fadeIn">
                            <div class="dropdown-user-scroll scrollbar-outer">
                                <li>
                                    <div class="user-box">
                                        <div class="avatar-lg"><img src="/assets/img/profile.jpg" alt="image profile" class="avatar-img rounded"></div>
                                        <div class="u-text">
                                            <h4>Hizrian</h4>
                                            <p class="text-muted">hello@example.com</p><a href="profile.html" class="btn btn-xs btn-secondary btn-sm">View Profile</a>
                                        </div>
                                    </div>
                                </li>
                                <li>
                                    <div class="dropdown-divider"></div>
                                    <a class="dropdown-item" href="#">My Profile</a>
                                    <a class="dropdown-item" href="#">My Balance</a>
                                    <a class="dropdown-item" href="#">Inbox</a>
                                    <div class="dropdown-divider"></div>
                                    <a class="dropdown-item" href="#">Account Setting</a>
                                    <div class="dropdown-divider"></div>
                                    <a class="dropdown-item" href="#">Logout</a>
                                </li>
                            </div>
                        </ul>
                    </li>
                </ul>
            </div>
        </nav>
        <!-- End Navbar -->
    </div>

    <!-- Sidebar -->
    <div class="sidebar sidebar-style-2">
        <div class="sidebar-wrapper scrollbar scrollbar-inner">
            <div class="sidebar-content">

                <ul class="nav nav-primary">
                    <li class="mx-4 mt-2">
                        <a href="/" class="btn btn-primary btn-block"><span class="btn-label mr-2"> <i class="fa fa-cubes"></i> </span>Dashboard</a>
                    </li>

                    <li class="nav-item">
                        <a data-toggle="collapse" href="#base">
                            <i class="fas fa-users"></i>
                            <p>Staff</p>
                            <span class="caret"></span>
                        </a>
                        <div class="collapse" id="base">
                            <ul class="nav nav-collapse">
                                <li>
                                    <a href="/createstaff">
                                        <span class="sub-item">New Staff</span>
                                    </a>

                                    <a href="/stafflist">
                                        <span class="sub-item">View Staff</span>
                                    </a>
                                </li>

                            </ul>
                        </div>
                    </li>
                    <li class="nav-item">
                        <a data-toggle="collapse" href="#sidebarLayouts">
                            <i class="fas fa-home"></i>
                            <p>Wards</p>
                            <span class="caret"></span>
                        </a>
                        <div class="collapse" id="sidebarLayouts">
                            <ul class="nav nav-collapse">
                                <li>
                                    <a href="/createward">
                                        <span class="sub-item">New Ward</span>
                                    </a>
                                </li>

                                <li>
                                    <a href="/wards">
                                        <span class="sub-item">View Wards</span>
                                    </a>
                                </li>

                            </ul>
                        </div>
                    </li>

                    <li class="nav-item">
                        <a data-toggle="collapse" href="#tables">
                            <i class="fas fa-table"></i>
                            <p>Reports</p>
                            <span class="caret"></span>
                        </a>
                        <div class="collapse" id="tables">
                            <ul class="nav nav-collapse">
                                <li>
                                    <a href="/records">
                                        <span class="sub-item">Patients</span>
                                    </a>
                                </li>
                                <li>
                                    <a href="/attendance">
                                        <span class="sub-item">Attendance</span>
                                    </a>
                                </li>

                                <li>
                                    <a href="tables/datatables.html">
                                        <span class="sub-item">Dispensary</span>
                                    </a>
                                </li>

                                <li>
                                    <a href="tables/datatables.html">
                                        <span class="sub-item">Dispensary</span>
                                    </a>
                                </li>

                            </ul>
                        </div>
                    </li>


                </ul>
            </div>
        </div>
    </div>
    <!-- End Sidebar -->

    <div class="main-panel pt-5">
        <div class="content pt-5">

            <div class="col-md-8 mx-auto">
                @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif


                    @if (session()->has('success'))
                    <div class="alert alert-success">
                        <ul>
                                <li>

                                    {{ session()->get('success') }}
                                </li>

                        </ul>
                    </div>
                @endif

            </div>

            @yield('content')


        </div>
        <footer class="footer">
            <div class="container-fluid">

                <div class="copyright ml-auto">
                    2020, made with <i class="fa fa-heart heart text-danger"></i> by <a target="_blank" href="https://www.twitter.com/@oryusif">Yusif KD</a>
                </div>
            </div>
        </footer>
    </div>


</div>
<!--   Core JS Files   -->
<script src="/assets/js/core/jquery.3.2.1.min.js"></script>
<script src="/assets/js/core/popper.min.js"></script>
<script src="/assets/js/core/bootstrap.min.js"></script>

<!-- jQuery UI -->
<script src="/assets/js/plugin/jquery-ui-1.12.1.custom/jquery-ui.min.js"></script>
<script src="/assets/js/plugin/jquery-ui-touch-punch/jquery.ui.touch-punch.min.js"></script>

<!-- jQuery Scrollbar -->
<script src="/assets/js/plugin/jquery-scrollbar/jquery.scrollbar.min.js"></script>


<!-- Chart JS -->
<script src="/assets/js/plugin/chart.js/chart.min.js"></script>

<!-- jQuery Sparkline -->
<script src="/assets/js/plugin/jquery.sparkline/jquery.sparkline.min.js"></script>

<!-- Chart Circle -->
<script src="/assets/js/plugin/chart-circle/circles.min.js"></script>

<!-- Datatables -->
<script src="/assets/js/plugin/datatables/datatables.min.js"></script>

<!-- Bootstrap Notify -->
<script src="/assets/js/plugin/bootstrap-notify/bootstrap-notify.min.js"></script>

<!-- jQuery Vector Maps -->
<script src="/assets/js/plugin/jqvmap/jquery.vmap.min.js"></script>
<script src="/assets/js/plugin/jqvmap/maps/jquery.vmap.world.js"></script>

<!-- Sweet Alert -->
<script src="/assets/js/plugin/sweetalert/sweetalert.min.js"></script>
<script src="/assets/js/plugin/datatables/datatables.min.js"></script>


<!-- Atlantis JS -->
<script src="/assets/js/atlantis.min.js"></script>

<!-- Atlantis DEMO methods, don't include it in your project! -->
<script src="/assets/js/setting-demo.js"></script>
<script src="/assets/js/demo.js"></script>
<script>
    $(document).ready(function () {


        $('#staff_table').DataTable({
            "pageLength": 5,
            initComplete: function () {
                this.api().columns().every(function () {
                    var column = this;
                    var select = $('<select class="form-control"><option value=""></option></select>')
                        .appendTo($(column.footer()).empty())
                        .on('change', function () {
                            var val = $.fn.dataTable.util.escapeRegex(
                                $(this).val()
                            );

                            column
                                .search(val ? '^' + val + '$' : '', true, false)
                                .draw();
                        });

                    column.data().unique().sort().each(function (d, j) {
                        select.append('<option value="' + d + '">' + d + '</option>')
                    });
                });
            }
        });

        <?php
            if(isset($patient_1)){
            ?>

        var ctx = document.getElementById('statisticsChart').getContext('2d');

        var statisticsChart = new Chart(ctx, {
            type: 'bar',
            data: {
                labels: ["Jan", "Feb", "Mar", "Apr", "May", "Jun", "Jul", "Aug", "Sep", "Oct", "Nov", "Dec"],
                datasets: [ {
                    label: "Patients",
                    borderColor: '#33CE35',
                    pointBackgroundColor: '#33CE35',
                    pointRadius: 0,
                    backgroundColor: '#33CE35',
                    legendColor: '#33CE35',
                    fill: true,
                    borderWidth: 0,
                    data: [<?=$patient_1?>, <?=$patient_2?>, <?=$patient_3?>, <?=$patient_4?>, <?=$patient_5?>, <?=$patient_6?>, <?=$patient_7?>, <?=$patient_8?>, <?=$patient_9?>, <?=$patient_10?>, <?=$patient_11?>, <?=$patient_12?>]
                }, {
                    label: "Attendance",
                    borderColor: 'rgba(23, 175, 120, 0.6)',
                    pointBackgroundColor: 'rgba(23, 175, 120, 0.6)',
                    pointRadius: 2,
                    backgroundColor: 'rgba(253, 175, 75, 0.4)',
                    legendColor: 'rgba(23, 175, 120, 0.6)',
                    fill: true,
                    borderWidth: 0,
                    data: [<?=$attend_1?>, <?=$attend_2?>, <?=$attend_3?>, <?=$attend_4?>, <?=$attend_5?>, <?=$attend_6?>, <?=$attend_7?>, <?=$attend_8?>, <?=$attend_9?>, <?=$attend_10?>, <?=$attend_11?>, <?=$attend_12?>]
                }, ]
            },
    });

        <?php
        }
        ?>
    });
</script>

</body>
</html>
