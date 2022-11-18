<!doctype html>
<html lang="en" dir="ltr">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>CHL-Transport</title>

    <!-- Favicon -->
    <link rel="shortcut icon" href="../../assets/images/favicon.ico" />

    <!-- Library / Plugin Css Build -->
    <link rel="stylesheet" href="../../assets/css/core/libs.min.css" />


    <!-- Hope Ui Design System Css -->
    <link rel="stylesheet" href="../../assets/css/hope-ui.min.css?v=1.2.0" />

    <!-- Custom Css -->
    <link rel="stylesheet" href="../../assets/css/custom.min.css?v=1.2.0" />

    <!-- Dark Css -->
    <link rel="stylesheet" href="../../assets/css/dark.min.css" />

    <!-- Customizer Css -->
    <link rel="stylesheet" href="../../assets/css/customizer.min.css" />

    <!-- RTL Css -->
    <link rel="stylesheet" href="../../assets/css/rtl.min.css" />

    <style>
        body {
            font-family: Arial;
        }

        /* Style the tab */
        .tab {
            overflow: hidden;
            border: 1px solid #ccc;
            background-color: #f1f1f1;
        }

        /* Style the buttons inside the tab */
        .tab button {
            background-color: inherit;
            float: left;
            border: none;
            outline: none;
            cursor: pointer;
            padding: 14px 16px;
            transition: 0.3s;
            font-size: 17px;
        }

        /* Change background color of buttons on hover */
        .tab button:hover {
            background-color: #ddd;
        }

        /* Create an active/current tablink class */
        .tab button.active {
            background-color: #ccc;
        }

        /* Style the tab content */
        .tabcontent {
            display: none;
            padding: 6px 12px;
            border: 0px solid #ccc;
            border-top: none;
        }
    </style>





</head>

<body class="  ">
    <!-- loader Start -->
    <div id="loading">
        <div class="loader simple-loader">
            <div class="loader-body"></div>
        </div>
    </div>
    <!-- loader END -->
    <?php
    $host = "localhost";
    $username = "root";
    $password = "";
    $dbname = "chl_uat";

    //ต่อ database
    $conn = mysqli_connect($host, $username, $password, $dbname);
    //กำหรดให้ data base อ่านภาษาไทยได้
    mysqli_query($conn, 'set names utf8');
    ?>
    <aside class="sidebar sidebar-default navs-rounded-all ">
        <div class="sidebar-header d-flex align-items-center justify-content-start">
            <a href="../dashboard/main.php" class="navbar-brand">
                <!--Logo start-->
                <svg width="30" class="" viewBox="0 0 30 30" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <rect x="-0.757324" y="19.2427" width="28" height="4" rx="2" transform="rotate(-45 -0.757324 19.2427)" fill="currentColor" />
                    <rect x="7.72803" y="27.728" width="28" height="4" rx="2" transform="rotate(-45 7.72803 27.728)" fill="currentColor" />
                    <rect x="10.5366" y="16.3945" width="16" height="4" rx="2" transform="rotate(45 10.5366 16.3945)" fill="currentColor" />
                    <rect x="10.5562" y="-0.556152" width="28" height="4" rx="2" transform="rotate(45 10.5562 -0.556152)" fill="currentColor" />
                </svg>
                <!--logo End-->
                <h4 class="logo-title"></h4>
            </a>
            <div class="sidebar-toggle" data-toggle="sidebar" data-active="true">
                <i class="icon">
                    <svg width="20" height="20" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M4.25 12.2744L19.25 12.2744" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>
                        <path d="M10.2998 18.2988L4.2498 12.2748L10.2998 6.24976" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>
                    </svg>
                </i>
            </div>
        </div>
        <div class="sidebar-body pt-0 data-scrollbar">
            <div class="sidebar-list">
                <!-- Sidebar Menu Start -->

                <!-- Sidebar Menu End -->
            </div>
        </div>
        <div class="sidebar-footer"></div>
    </aside>

    <main class="main-content">
        <div class="position-relative iq-banner">
            <!--Nav Start-->
            <nav class="nav navbar navbar-expand-lg navbar-light iq-navbar">
                <div class="container-fluid navbar-inner">
                    <a href="../../dashboard/main.php" class="navbar-brand">
                        <!--Logo start-->
                        <svg width="30" class="text-primary" viewBox="0 0 30 30" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <rect x="-0.757324" y="19.2427" width="28" height="4" rx="2" transform="rotate(-45 -0.757324 19.2427)" fill="currentColor" />
                            <rect x="7.72803" y="27.728" width="28" height="4" rx="2" transform="rotate(-45 7.72803 27.728)" fill="currentColor" />
                            <rect x="10.5366" y="16.3945" width="16" height="4" rx="2" transform="rotate(45 10.5366 16.3945)" fill="currentColor" />
                            <rect x="10.5562" y="-0.556152" width="28" height="4" rx="2" transform="rotate(45 10.5562 -0.556152)" fill="currentColor" />
                        </svg>
                        <!--logo End-->
                        <h4 class="logo-title">Hope UI</h4>
                    </a>
                    <div class="sidebar-toggle" data-toggle="sidebar" data-active="true">
                        <i class="icon">
                            <svg width="20px" height="20px" viewBox="0 0 24 24">
                                <path fill="currentColor" d="M4,11V13H16L10.5,18.5L11.92,19.92L19.84,12L11.92,4.08L10.5,5.5L16,11H4Z" />
                            </svg>
                        </i>
                    </div>
                    <div class="input-group search-input">
                        <span class="input-group-text" id="search-input">
                            <svg width="18" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <circle cx="11.7669" cy="11.7666" r="8.98856" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></circle>
                                <path d="M18.0186 18.4851L21.5426 22" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>
                            </svg>
                        </span>
                        <input type="search" class="form-control" placeholder="Search...">
                    </div>
                    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                        <span class="navbar-toggler-icon">
                            <span class="mt-2 navbar-toggler-bar bar1"></span>
                            <span class="navbar-toggler-bar bar2"></span>
                            <span class="navbar-toggler-bar bar3"></span>
                        </span>
                    </button>
                    <div class="collapse navbar-collapse" id="navbarSupportedContent">
                        <ul class="mb-2 navbar-nav ms-auto align-items-center navbar-list mb-lg-0">
                            <li class="nav-item dropdown">
                                <a href="#" class="search-toggle nav-link" id="dropdownMenuButton2" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    <img src="../../assets/images/Flag/flag001.png" class="img-fluid rounded-circle" alt="user" style="height: 30px; min-width: 30px; width: 30px;">
                                    <span class="bg-primary"></span>
                                </a>
                                <div class="p-0 sub-drop dropdown-menu dropdown-menu-end" aria-labelledby="dropdownMenuButton2">
                                    <div class="m-0 border-0 shadow-none card">
                                        <div class="p-0 ">
                                            <ul class="p-0 list-group list-group-flush">
                                                <li class="iq-sub-card list-group-item"><a class="p-0" href="#"><img src="../../assets/images/Flag/flag-03.png" alt="img-flaf" class="img-fluid me-2" style="width: 15px;height: 15px;min-width: 15px;" />Spanish</a></li>
                                                <li class="iq-sub-card list-group-item"><a class="p-0" href="#"><img src="../../assets/images/Flag/flag-04.png" alt="img-flaf" class="img-fluid me-2" style="width: 15px;height: 15px;min-width: 15px;" />Italian</a></li>
                                                <li class="iq-sub-card list-group-item"><a class="p-0" href="#"><img src="../../assets/images/Flag/flag-02.png" alt="img-flaf" class="img-fluid me-2" style="width: 15px;height: 15px;min-width: 15px;" />French</a></li>
                                                <li class="iq-sub-card list-group-item"><a class="p-0" href="#"><img src="../../assets/images/Flag/flag-05.png" alt="img-flaf" class="img-fluid me-2" style="width: 15px;height: 15px;min-width: 15px;" />German</a></li>
                                                <li class="iq-sub-card list-group-item"><a class="p-0" href="#"><img src="../../assets/images/Flag/flag-06.png" alt="img-flaf" class="img-fluid me-2" style="width: 15px;height: 15px;min-width: 15px;" />Japanese</a></li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            </li>
                            <li class="nav-item dropdown">
                                <a href="#" class="nav-link" id="notification-drop" data-bs-toggle="dropdown">
                                    <svg width="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                        <path d="M19.7695 11.6453C19.039 10.7923 18.7071 10.0531 18.7071 8.79716V8.37013C18.7071 6.73354 18.3304 5.67907 17.5115 4.62459C16.2493 2.98699 14.1244 2 12.0442 2H11.9558C9.91935 2 7.86106 2.94167 6.577 4.5128C5.71333 5.58842 5.29293 6.68822 5.29293 8.37013V8.79716C5.29293 10.0531 4.98284 10.7923 4.23049 11.6453C3.67691 12.2738 3.5 13.0815 3.5 13.9557C3.5 14.8309 3.78723 15.6598 4.36367 16.3336C5.11602 17.1413 6.17846 17.6569 7.26375 17.7466C8.83505 17.9258 10.4063 17.9933 12.0005 17.9933C13.5937 17.9933 15.165 17.8805 16.7372 17.7466C17.8215 17.6569 18.884 17.1413 19.6363 16.3336C20.2118 15.6598 20.5 14.8309 20.5 13.9557C20.5 13.0815 20.3231 12.2738 19.7695 11.6453Z" fill="currentColor"></path>
                                        <path opacity="0.4" d="M14.0088 19.2283C13.5088 19.1215 10.4627 19.1215 9.96275 19.2283C9.53539 19.327 9.07324 19.5566 9.07324 20.0602C9.09809 20.5406 9.37935 20.9646 9.76895 21.2335L9.76795 21.2345C10.2718 21.6273 10.8632 21.877 11.4824 21.9667C11.8123 22.012 12.1482 22.01 12.4901 21.9667C13.1083 21.877 13.6997 21.6273 14.2036 21.2345L14.2026 21.2335C14.5922 20.9646 14.8734 20.5406 14.8983 20.0602C14.8983 19.5566 14.4361 19.327 14.0088 19.2283Z" fill="currentColor"></path>
                                    </svg>
                                    <span class="bg-danger dots"></span>
                                </a>
                                <div class="p-0 sub-drop dropdown-menu dropdown-menu-end" aria-labelledby="notification-drop">
                                    <div class="m-0 shadow-none card">
                                        <div class="py-3 card-header d-flex justify-content-between bg-primary">
                                            <div class="header-title">
                                                <h5 class="mb-0 text-white">All Notifications</h5>
                                            </div>
                                        </div>
                                        <div class="p-0 card-body">
                                            <a href="#" class="iq-sub-card">
                                                <div class="d-flex align-items-center">
                                                    <img class="p-1 avatar-40 rounded-pill bg-soft-primary" src="../../assets/images/shapes/01.png" alt="">
                                                    <div class="ms-3 w-100">
                                                        <h6 class="mb-0 ">Emma Watson Bni</h6>
                                                        <div class="d-flex justify-content-between align-items-center">
                                                            <p class="mb-0">95 MB</p>
                                                            <small class="float-end font-size-12">Just Now</small>
                                                        </div>
                                                    </div>
                                                </div>
                                            </a>
                                            <a href="#" class="iq-sub-card">
                                                <div class="d-flex align-items-center">
                                                    <div class="">
                                                        <img class="p-1 avatar-40 rounded-pill bg-soft-primary" src="../../assets/images/shapes/02.png" alt="">
                                                    </div>
                                                    <div class="ms-3 w-100">
                                                        <h6 class="mb-0 ">New customer is join</h6>
                                                        <div class="d-flex justify-content-between align-items-center">
                                                            <p class="mb-0">Cyst Bni</p>
                                                            <small class="float-end font-size-12">5 days ago</small>
                                                        </div>
                                                    </div>
                                                </div>
                                            </a>
                                            <a href="#" class="iq-sub-card">
                                                <div class="d-flex align-items-center">
                                                    <img class="p-1 avatar-40 rounded-pill bg-soft-primary" src="../../assets/images/shapes/03.png" alt="">
                                                    <div class="ms-3 w-100">
                                                        <h6 class="mb-0 ">Two customer is left</h6>
                                                        <div class="d-flex justify-content-between align-items-center">
                                                            <p class="mb-0">Cyst Bni</p>
                                                            <small class="float-end font-size-12">2 days ago</small>
                                                        </div>
                                                    </div>
                                                </div>
                                            </a>
                                            <a href="#" class="iq-sub-card">
                                                <div class="d-flex align-items-center">
                                                    <img class="p-1 avatar-40 rounded-pill bg-soft-primary" src="../../assets/images/shapes/04.png" alt="">
                                                    <div class="w-100 ms-3">
                                                        <h6 class="mb-0 ">New Mail from Fenny</h6>
                                                        <div class="d-flex justify-content-between align-items-center">
                                                            <p class="mb-0">Cyst Bni</p>
                                                            <small class="float-end font-size-12">3 days ago</small>
                                                        </div>
                                                    </div>
                                                </div>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </li>
                            <li class="nav-item dropdown">
                                <a href="#" class="nav-link" id="mail-drop" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    <svg width="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                        <path opacity="0.4" d="M22 15.94C22 18.73 19.76 20.99 16.97 21H16.96H7.05C4.27 21 2 18.75 2 15.96V15.95C2 15.95 2.006 11.524 2.014 9.298C2.015 8.88 2.495 8.646 2.822 8.906C5.198 10.791 9.447 14.228 9.5 14.273C10.21 14.842 11.11 15.163 12.03 15.163C12.95 15.163 13.85 14.842 14.56 14.262C14.613 14.227 18.767 10.893 21.179 8.977C21.507 8.716 21.989 8.95 21.99 9.367C22 11.576 22 15.94 22 15.94Z" fill="currentColor"></path>
                                        <path d="M21.4759 5.67351C20.6099 4.04151 18.9059 2.99951 17.0299 2.99951H7.04988C5.17388 2.99951 3.46988 4.04151 2.60388 5.67351C2.40988 6.03851 2.50188 6.49351 2.82488 6.75151L10.2499 12.6905C10.7699 13.1105 11.3999 13.3195 12.0299 13.3195C12.0339 13.3195 12.0369 13.3195 12.0399 13.3195C12.0429 13.3195 12.0469 13.3195 12.0499 13.3195C12.6799 13.3195 13.3099 13.1105 13.8299 12.6905L21.2549 6.75151C21.5779 6.49351 21.6699 6.03851 21.4759 5.67351Z" fill="currentColor"></path>
                                    </svg>
                                    <span class="bg-primary count-mail"></span>
                                </a>
                                <div class="p-0 sub-drop dropdown-menu dropdown-menu-end" aria-labelledby="mail-drop">
                                    <div class="m-0 shadow-none card">
                                        <div class="py-3 card-header d-flex justify-content-between bg-primary">
                                            <div class="header-title">
                                                <h5 class="mb-0 text-white">All Message</h5>
                                            </div>
                                        </div>
                                        <div class="p-0 card-body ">
                                            <a href="#" class="iq-sub-card">
                                                <div class="d-flex align-items-center">
                                                    <div class="">
                                                        <img class="p-1 avatar-40 rounded-pill bg-soft-primary" src="../../assets/images/shapes/01.png" alt="">
                                                    </div>
                                                    <div class="ms-3">
                                                        <h6 class="mb-0 ">Bni Emma Watson</h6>
                                                        <small class="float-start font-size-12">13 Jun</small>
                                                    </div>
                                                </div>
                                            </a>
                                            <a href="#" class="iq-sub-card">
                                                <div class="d-flex align-items-center">
                                                    <div class="">
                                                        <img class="p-1 avatar-40 rounded-pill bg-soft-primary" src="../../assets/images/shapes/02.png" alt="">
                                                    </div>
                                                    <div class="ms-3">
                                                        <h6 class="mb-0 ">Lorem Ipsum Watson</h6>
                                                        <small class="float-start font-size-12">20 Apr</small>
                                                    </div>
                                                </div>
                                            </a>
                                            <a href="#" class="iq-sub-card">
                                                <div class="d-flex align-items-center">
                                                    <div class="">
                                                        <img class="p-1 avatar-40 rounded-pill bg-soft-primary" src="../../assets/images/shapes/03.png" alt="">
                                                    </div>
                                                    <div class="ms-3">
                                                        <h6 class="mb-0 ">Why do we use it?</h6>
                                                        <small class="float-start font-size-12">30 Jun</small>
                                                    </div>
                                                </div>
                                            </a>
                                            <a href="#" class="iq-sub-card">
                                                <div class="d-flex align-items-center">
                                                    <div class="">
                                                        <img class="p-1 avatar-40 rounded-pill bg-soft-primary" src="../../assets/images/shapes/04.png" alt="">
                                                    </div>
                                                    <div class="ms-3">
                                                        <h6 class="mb-0 ">Variations Passages</h6>
                                                        <small class="float-start font-size-12">12 Sep</small>
                                                    </div>
                                                </div>
                                            </a>
                                            <a href="#" class="iq-sub-card">
                                                <div class="d-flex align-items-center">
                                                    <div class="">
                                                        <img class="p-1 avatar-40 rounded-pill bg-soft-primary" src="../../assets/images/shapes/05.png" alt="">
                                                    </div>
                                                    <div class="ms-3">
                                                        <h6 class="mb-0 ">Lorem Ipsum generators</h6>
                                                        <small class="float-start font-size-12">5 Dec</small>
                                                    </div>
                                                </div>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </li>
                            <li class="nav-item dropdown">
                                <a class="py-0 nav-link d-flex align-items-center" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                    <img src="../../assets/images/avatars/01.png" alt="User-Profile" class="theme-color-default-img img-fluid avatar avatar-50 avatar-rounded">
                                    <img src="../../assets/images/avatars/avtar_1.png" alt="User-Profile" class="theme-color-purple-img img-fluid avatar avatar-50 avatar-rounded">
                                    <img src="../../assets/images/avatars/avtar_2.png" alt="User-Profile" class="theme-color-blue-img img-fluid avatar avatar-50 avatar-rounded">
                                    <img src="../../assets/images/avatars/avtar_4.png" alt="User-Profile" class="theme-color-green-img img-fluid avatar avatar-50 avatar-rounded">
                                    <img src="../../assets/images/avatars/avtar_5.png" alt="User-Profile" class="theme-color-yellow-img img-fluid avatar avatar-50 avatar-rounded">
                                    <img src="../../assets/images/avatars/avtar_3.png" alt="User-Profile" class="theme-color-pink-img img-fluid avatar avatar-50 avatar-rounded">
                                    <div class="caption ms-3 d-none d-md-block ">
                                        <h6 class="mb-0 caption-title">Austin Robertson</h6>
                                        <p class="mb-0 caption-sub-title">Marketing Administrator</p>
                                    </div>
                                </a>
                                <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                                    <li><a class="dropdown-item" href="../../dashboard/app/user-profile.html">Profile</a></li>
                                    <li><a class="dropdown-item" href="../../dashboard/app/user-privacy-setting.html">Privacy Setting</a></li>
                                    <li>
                                        <hr class="dropdown-divider">
                                    </li>
                                    <li><a class="dropdown-item" href="../../dashboard/auth/sign-in.html">Logout</a></li>
                                </ul>
                            </li>
                        </ul>
                    </div>
                </div>
            </nav> <!-- Nav Header Component Start -->
            <div class="iq-navbar-header" style="height: 215px;">
                <div class="container-fluid iq-container">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="flex-wrap d-flex justify-content-between align-items-center">
                                <div>
                                    <h1>Transport</h1>
                                    <p></p>
                                    <div>
                                        <button class="btn btn-outline-dark rounded-pill" onclick="openCity(event, 'Booking_transport')" id="defaultOpen">Booking Transport</button>
                                        <button class="btn btn-outline-dark rounded-pill" onclick="openCity(event, 'driver')">Driver & Container</button>
                                        <button class="btn btn-outline-dark rounded-pill" onclick="openCity(event, 'tracking')">Tracking</button>
                                        <button class="btn btn-outline-dark rounded-pill" onclick="openCity(event, 'booking')">Booking</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="iq-header-img">
                    <img src="../../assets/images/dashboard/top-header.png" alt="header" class="theme-color-default-img img-fluid w-100 h-100 animated-scaleX">
                    <img src="../../assets/images/dashboard/top-header1.png" alt="header" class="theme-color-purple-img img-fluid w-100 h-100 animated-scaleX">
                    <img src="../../assets/images/dashboard/top-header2.png" alt="header" class="theme-color-blue-img img-fluid w-100 h-100 animated-scaleX">
                    <img src="../../assets/images/dashboard/top-header3.png" alt="header" class="theme-color-green-img img-fluid w-100 h-100 animated-scaleX">
                    <img src="../../assets/images/dashboard/top-header4.png" alt="header" class="theme-color-yellow-img img-fluid w-100 h-100 animated-scaleX">
                    <img src="../../assets/images/dashboard/top-header5.png" alt="header" class="theme-color-pink-img img-fluid w-100 h-100 animated-scaleX">
                </div>
            </div> <!-- Nav Header Component End -->
            <!--Nav End-->
        </div>
        </div>



        <div id="Booking_transport" class="tabcontent">
            <div class="conatiner-fluid content-inner mt-n5 py-0">
                <div>
                    <div class="row">
                        <div class="col-sm-12 col-lg-12">
                            <div class="card">
                                <div class="card-header d-flex justify-content-between">
                                    <div class="header-title">
                                        <h4 class="card-title">Booking Transport</h4>
                                    </div>
                                </div>
                                <div class="card-body">
                                    <div class="form-group row">
                                        <label class="control-label col-sm-3 align-self-center mb-0" for="pwd2">Container Quantity:</label>
                                        <div class="col-sm-9">
                                            <div class="row">
                                                <div class="col">
                                                    <input type="text" class="form-control" placeholder="">
                                                </div>
                                                <label class="control-label col-sm-2 align-self-center mb-0" for="pwd2">Pallet :</label>
                                                <div class="col">
                                                    <input type="text" class="form-control" placeholder="">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-12 col-lg-12">
                                <div class="card">
                                    <div class="card-header d-flex justify-content-between">
                                        <div class="header-title">
                                            <h4 class="card-title">Booking Transport Detail</h4>
                                        </div>
                                    </div>
                                    <div class="card-body">
                                        <div class="form-group row">
                                            <label class="control-label col-sm-3 align-self-center mb-0" for="email1">Supplier:</label>
                                            <div class="col-sm-9">
                                                <select class="form-select form-select-sm mb-3 shadow-none">
                                                    <?php
                                                    $transport_sup_select = "SELECT * FROM transport_sup";
                                                    $result_transport_sup = mysqli_query($conn, $transport_sup_select);
                                                    ?>
                                                    <option selected="">Please select shipper</option>
                                                    <?php
                                                    while ($result_transport_sup_total = mysqli_fetch_assoc($result_transport_sup)) {
                                                    ?>
                                                        <option value="<?php $result_transport_sup_total['ID'] ?>"><?php echo $result_transport_sup_total['transport_sup_name'] ?></option>
                                                    <?php
                                                    }
                                                    ?>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label class="control-label col-sm-3 align-self-center mb-0" for="pwd2">Pickup Empty Container Address:</label>
                                            <div class="col-sm-9">
                                                <div class="row">
                                                    <div class="col">
                                                        <input type="text" class="form-control" placeholder="">
                                                    </div>
                                                    <label class="control-label col-sm-2 align-self-center mb-0" for="pwd2">Remark :</label>
                                                    <div class="col">
                                                        <input type="text" class="form-control" placeholder="">
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label class="control-label col-sm-3 align-self-center mb-0" for="pwd2">Pickup Container Address:</label>
                                            <div class="col-sm-9">
                                                <div class="row">
                                                    <div class="col">
                                                        <input type="text" class="form-control" placeholder="">
                                                    </div>
                                                    <label class="control-label col-sm-2 align-self-center mb-0" for="pwd2">Remark :</label>
                                                    <div class="col">
                                                        <input type="text" class="form-control" placeholder="">
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label class="control-label col-sm-3 align-self-center mb-0" for="pwd2">Drop off Container Address:</label>
                                            <div class="col-sm-9">
                                                <div class="row">
                                                    <div class="col">
                                                        <input type="text" class="form-control" placeholder="">
                                                    </div>
                                                    <label class="control-label col-sm-2 align-self-center mb-0" for="pwd2">Remark :</label>
                                                    <div class="col">
                                                        <input type="text" class="form-control" placeholder="">
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label class="control-label col-sm-3 align-self-center mb-0" for="pwd2">Drop off Empty Containe Address:</label>
                                            <div class="col-sm-9">
                                                <div class="row">
                                                    <div class="col">
                                                        <input type="text" class="form-control" placeholder="">
                                                    </div>
                                                    <label class="control-label col-sm-2 align-self-center mb-0" for="pwd2">Remark :</label>
                                                    <div class="col">
                                                        <input type="text" class="form-control" placeholder="">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <label class="control-label col-sm-3 align-self-center mb-0" for="pwd2">Budget:</label>
                                                <div class="col-sm-9">
                                                    <input type="input" class="form-control form-control-sm" id="pwd2" placeholder="">
                                                </div>
                                            </div>
                                        </div>
                                        <button class="btn btn-primary rounded-pill ">
                                            <span class="btn-inner">
                                                <svg width="32" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                    <path d="M12.0001 8.32739V15.6537" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>
                                                    <path d="M15.6668 11.9904H8.3335" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>
                                                    <path fill-rule="evenodd" clip-rule="evenodd" d="M16.6857 2H7.31429C4.04762 2 2 4.31208 2 7.58516V16.4148C2 19.6879 4.0381 22 7.31429 22H16.6857C19.9619 22 22 19.6879 22 16.4148V7.58516C22 4.31208 19.9619 2 16.6857 2Z" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>
                                                </svg>
                                            </span>
                                            Save
                                        </button>
                                        <button class="btn btn-success rounded-pill ">
                                            <span class="btn-inner">
                                                <svg width="32" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                    <path d="M12.0001 8.32739V15.6537" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>
                                                    <path d="M15.6668 11.9904H8.3335" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>
                                                    <path fill-rule="evenodd" clip-rule="evenodd" d="M16.6857 2H7.31429C4.04762 2 2 4.31208 2 7.58516V16.4148C2 19.6879 4.0381 22 7.31429 22H16.6857C19.9619 22 22 19.6879 22 16.4148V7.58516C22 4.31208 19.9619 2 16.6857 2Z" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>
                                                </svg>
                                            </span>
                                            Sent to line group
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-sm-12 col-lg-12">
                            <div class="card">
                                <div class="card-header d-flex justify-content-between">
                                    <div class="header-title">
                                        <h4 class="card-title">Confirm status</h4>
                                    </div>
                                </div>
                                <div class="card-body">
                                    <div class="form-group row">
                                        <label class="control-label col-sm-3 align-self-center mb-0" for="pwd2">Sent Request Line :</label>
                                        <div class="col-sm-9">
                                            <input type="input" class="form-control form-control-sm" id="pwd2" placeholder="" readonly>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="control-label col-sm-3 align-self-center mb-0" for="pwd2">Supplier Confirm :</label>
                                        <div class="col-sm-9">
                                            <input type="input" class="form-control form-control-sm" id="pwd2" placeholder="" readonly>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        </div>



        <div id="driver" class="tabcontent">
            <div class="conatiner-fluid content-inner mt-n5 py-0">
                <div>
                    <div class="row">
                        <div class="col-sm-12 col-lg-12">
                            <div class="card">
                                <div class="card-header d-flex justify-content-between">
                                    <div class="header-title">
                                        <h4 class="card-title">Driver</h4>
                                    </div>
                                </div>
                                <div class="card-body">
                                    <div class="form-group row">
                                        <label class="control-label col-sm-3 align-self-center mb-0" for="pwd2">Driver name:</label>
                                        <div class="col-sm-9">
                                            <div class="row">
                                                <div class="col">
                                                    <input type="text" class="form-control" placeholder="" readonly>
                                                </div>
                                                <label class="control-label col-sm-2 align-self-center mb-0" for="pwd2">Phone Number :</label>
                                                <div class="col">
                                                    <input type="text" class="form-control" placeholder="" readonly>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="control-label col-sm-3 align-self-center mb-0" for="pwd2">Container number:</label>
                                        <div class="col-sm-9">
                                            <input type="input" class="form-control form-control-sm" id="pwd2" placeholder="" readonly>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="control-label col-sm-3 align-self-center mb-0" for="pwd2">Seal number:</label>
                                        <div class="col-sm-9">
                                            <input type="input" class="form-control form-control-sm" id="pwd2" placeholder="" readonly>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div id="tracking" class="tabcontent">
            <h3>Tokyo</h3>
            <p>Tokyo is the capital of Japan.</p>
        </div>

        <div id="booking" class="tabcontent">
            <div class="conatiner-fluid content-inner mt-n5 py-0">
                <div>
                    <div class="row">
                        <div class="col-sm-12 col-lg-12">
                            <div class="card">
                                <div class="card-header d-flex justify-content-between">
                                    <div class="header-title">
                                        <h4 class="card-title">Booking Detail</h4>
                                    </div>
                                </div>
                                <div class="card-body">
                                    <div class="form-group row">
                                        <label class="control-label col-sm-3 align-self-center mb-0" for="pwd2">Job number:</label>
                                        <div class="col-sm-9">
                                            <input type="input" class="form-control form-control-sm" id="pwd2" placeholder="" readonly>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="control-label col-sm-3 align-self-center mb-0" for="pwd2">Booking number:</label>
                                        <div class="col-sm-9">
                                            <input type="input" class="form-control form-control-sm" id="pwd2" placeholder="" readonly>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="control-label col-sm-3 align-self-center mb-0" for="email1">Shipper:</label>
                                        <div class="col-sm-9">
                                            <select class="form-select form-select-sm mb-3 shadow-none" >

                                                <?php
                                                $shipper_select = "SELECT * FROM carrier";
                                                $result_shipper = mysqli_query($conn, $shipper_select);
                                                ?>

                                                <option selected="">Please select shipper</option>
                                                <?php
                                                while ($result_shipper_total = mysqli_fetch_assoc($result_shipper)) {
                                                ?>
                                                    <option value="<?php $result_shipper_total['ID'] ?>"><?php echo $result_shipper_total['carrier_name'] ?></option>
                                                <?php
                                                }
                                                ?>
                                            </select>

                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <label class="control-label col-sm-3 align-self-center mb-0" for="pwd2">Shipment Terms</label>
                                        <div class="col-sm-9">
                                            <select class="form-select form-select-sm mb-3 shadow-none">
                                                <?php
                                                $shipment_select = "SELECT * FROM shipment_term";
                                                $result_shipment = mysqli_query($conn, $shipment_select);
                                                ?>
                                                <option selected="">Please select shipment term</option>
                                                <?php
                                                while ($result_shipment_total = mysqli_fetch_assoc($result_shipment)) {
                                                ?>
                                                    <option value="<?php $result_shipment_total['ID'] ?>"><?php echo $result_shipment_total['st_name'] ?></option>
                                                <?php
                                                }
                                                ?>

                                            </select>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="control-label col-sm-3 align-self-center mb-0" for="pwd2">Remark</label>
                                        <div class="col-sm-9">
                                            <input type="input" class="form-control form-control-sm" id="pwd2" placeholder="">
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="control-label col-sm-3 align-self-center mb-0" for="email1">Carrier:</label>
                                        <div class="col-sm-9">
                                            <select class="form-select form-select-sm mb-3 shadow-none">
                                                <?php
                                                $carrier_select = "SELECT * FROM carrier";
                                                $result_carrier = mysqli_query($conn, $carrier_select);
                                                ?>
                                                <option selected="">Please select carrier</option>
                                                <?php
                                                while ($result_carrier_total = mysqli_fetch_assoc($result_carrier)) {
                                                ?>
                                                    <option value="<?php $result_carrier_total['ID'] ?>"><?php echo $result_carrier_total['carrier_name'] ?></option>
                                                <?php
                                                }
                                                ?>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="control-label col-sm-3 align-self-center mb-0" for="email1">Port of Receipt</label>
                                        <div class="col-sm-9">
                                            <select class="form-select form-select-sm mb-3 shadow-none">
                                                <?php
                                                $area_select = "SELECT * FROM area";
                                                $result_area = mysqli_query($conn, $area_select);
                                                ?>
                                                <option selected="">Please select Port of Receipt</option>
                                                <?php
                                                while ($result_area_total = mysqli_fetch_assoc($result_area)) {
                                                ?>
                                                    <option value="<?php $result_area_total['ID'] ?>"><?php echo $result_area_total['location_name'] . " ," . $result_area_total['Provice'] . " ," . $result_area_total['Country'] ?></option>
                                                <?php
                                                }
                                                ?>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="control-label col-sm-3 align-self-center mb-0" for="email1">Port of Loading</label>
                                        <div class="col-sm-9">
                                            <select class="form-select form-select-sm mb-3 shadow-none">
                                                <?php
                                                $area_select = "SELECT * FROM area";
                                                $result_area = mysqli_query($conn, $area_select);
                                                ?>
                                                <option selected="">Please select ort of Loading</option>
                                                <?php
                                                while ($result_area_total = mysqli_fetch_assoc($result_area)) {
                                                ?>
                                                    <option value="<?php $result_area_total['ID'] ?>"><?php echo $result_area_total['location_name'] . " ," . $result_area_total['Provice'] . " ," . $result_area_total['Country'] ?></option>
                                                <?php
                                                }
                                                ?>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="control-label col-sm-3 align-self-center mb-0" for="email1">T/S Port</label>
                                        <div class="col-sm-9">
                                            <select class="form-select form-select-sm mb-3 shadow-none">
                                                <?php
                                                $area_select = "SELECT * FROM area";
                                                $result_area = mysqli_query($conn, $area_select);
                                                ?>
                                                <option selected="">Please select T/S Port</option>
                                                <?php
                                                while ($result_area_total = mysqli_fetch_assoc($result_area)) {
                                                ?>
                                                    <option value="<?php $result_area_total['ID'] ?>"><?php echo $result_area_total['location_name'] . " ," . $result_area_total['Provice'] . " ," . $result_area_total['Country'] ?></option>
                                                <?php
                                                }
                                                ?>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="control-label col-sm-3 align-self-center mb-0" for="email1">Port of Delivery</label>
                                        <div class="col-sm-9">
                                            <select class="form-select form-select-sm mb-3 shadow-none">
                                                <?php
                                                $area_select = "SELECT * FROM area";
                                                $result_area = mysqli_query($conn, $area_select);
                                                ?>
                                                <option selected="">Please select Port of Delivery</option>
                                                <?php
                                                while ($result_area_total = mysqli_fetch_assoc($result_area)) {
                                                ?>
                                                    <option value="<?php $result_area_total['ID'] ?>"><?php echo $result_area_total['location_name'] . " ," . $result_area_total['Provice'] . " ," . $result_area_total['Country'] ?></option>
                                                <?php
                                                }
                                                ?>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="control-label col-sm-3  align-self-center mb-0" for="pwd2">Mother Vessel:</label>
                                        <div class="col-sm-9">
                                            <div class="row">
                                                <div class="col">
                                                    <input type="text" class="form-control" placeholder="">
                                                </div>
                                                <label class="control-label col-sm-1 align-self-center mb-0" for="pwd2">Voy No. :</label>
                                                <div class="col">
                                                    <input type="text" class="form-control" placeholder="">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="control-label col-sm-3 align-self-center mb-0" for="pwd2">Feeder Vessel:</label>
                                        <div class="col-sm-9">
                                            <div class="row">
                                                <div class="col">
                                                    <input type="text" class="form-control" placeholder="">
                                                </div>
                                                <label class="control-label col-sm-1 align-self-center mb-0" for="pwd2">Voy No. :</label>
                                                <div class="col">
                                                    <input type="text" class="form-control" placeholder="">
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <label class="control-label col-sm-3 align-self-center mb-0" for="pwd2">Voy No.:</label>
                                        <div class="col-sm-9">
                                            <input type="input" class="form-control form-control-sm" id="pwd2" placeholder="">
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="control-label col-sm-3 align-self-center mb-0" for="pwd2">ETD:</label>
                                        <div class="col-sm-9">
                                            <input type="date" class="form-control form-control-sm" id="pwd2" value="2019-12-18">
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="control-label col-sm-3 align-self-center mb-0" for="pwd2">ETA:</label>
                                        <div class="col-sm-9">
                                            <input type="date" class="form-control form-control-sm" id="pwd2" value="2019-12-18">
                                        </div>
                                    </div>

                                </div>
                            </div>

                            <div class="card">
                                <div class="card-header d-flex justify-content-between">
                                    <h4 class="card-title">Container</h4>
                                </div>

                                <div class="card-body">
                                    <div class="row">
                                        <div class="form-group row">
                                            <div class="table-responsive mt-4">
                                                <table id="basic-table" class="table table-striped mb-0" role="grid">
                                                    <thead>
                                                        <tr>
                                                            <th>Container type</th>
                                                            <th>Container Quantity</th>
                                                            <th>Single CNT Weight</th>
                                                            <th>SOC</th>
                                                            <th>OW</th>
                                                            <th>Action</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        <tr>
                                                            <td><select class="form-select form-select-sm shadow-none">
                                                                    <?php
                                                                    $Container_type_select = "SELECT * FROM container_type";
                                                                    $result_Container_type = mysqli_query($conn, $Container_type_select);
                                                                    ?>
                                                                    <option selected="">Please select container type</option>
                                                                    <?php
                                                                    while ($result_Container_type_total = mysqli_fetch_assoc($result_Container_type)) {
                                                                    ?>
                                                                        <option value="<?php $result_Container_type_total['container_type_number'] ?>"><?php echo $result_Container_type_total['container_type_name'] ?></option>
                                                                    <?php
                                                                    }
                                                                    ?>
                                                                </select></td>
                                                            <td><input type="input" class="form-control form-control-sm" id="pwd2" placeholder=""></td>
                                                            <td><input type="input" class="form-control form-control-sm" id="pwd2" placeholder=""></td>
                                                            <td><input class="form-check-input" type="checkbox" value="" id="flexCheckDefault"></td>
                                                            <td><input class="form-check-input" type="checkbox" value="" id="flexCheckDefault"></td>
                                                            <td><svg width="32" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                                    <path opacity="0.4" d="M19.643 9.48851C19.643 9.5565 19.11 16.2973 18.8056 19.1342C18.615 20.8751 17.4927 21.9311 15.8092 21.9611C14.5157 21.9901 13.2494 22.0001 12.0036 22.0001C10.6809 22.0001 9.38741 21.9901 8.13185 21.9611C6.50477 21.9221 5.38147 20.8451 5.20057 19.1342C4.88741 16.2873 4.36418 9.5565 4.35445 9.48851C4.34473 9.28351 4.41086 9.08852 4.54507 8.93053C4.67734 8.78453 4.86796 8.69653 5.06831 8.69653H18.9388C19.1382 8.69653 19.3191 8.78453 19.4621 8.93053C19.5953 9.08852 19.6624 9.28351 19.643 9.48851Z" fill="currentColor"></path>
                                                                    <path d="M21 5.97686C21 5.56588 20.6761 5.24389 20.2871 5.24389H17.3714C16.7781 5.24389 16.2627 4.8219 16.1304 4.22692L15.967 3.49795C15.7385 2.61698 14.9498 2 14.0647 2H9.93624C9.0415 2 8.26054 2.61698 8.02323 3.54595L7.87054 4.22792C7.7373 4.8219 7.22185 5.24389 6.62957 5.24389H3.71385C3.32386 5.24389 3 5.56588 3 5.97686V6.35685C3 6.75783 3.32386 7.08982 3.71385 7.08982H20.2871C20.6761 7.08982 21 6.75783 21 6.35685V5.97686Z" fill="currentColor"></path>
                                                                </svg>
                                                            </td>
                                                        </tr>
                                                    </tbody>
                                                </table>
                                            </div>

                                            <button type="submit" class="btn btn-link btn-soft-light rounded-pill">add new</button>

                                            <p></p>
                                            <label class="control-label col-sm-3 align-self-center mb-0" for="pwd2">CY:</label>
                                            <div class="col-sm-9">
                                                <input type="date" class="form-control form-control-sm" id="pwd2" value="2019-12-18">
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label class="control-label col-sm-3 align-self-center mb-0" for="pwd2">RTN:</label>
                                            <div class="col-sm-9">
                                                <input type="date" class="form-control form-control-sm" id="pwd2" value="2019-12-18">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="card">
                                <div class="card-header d-flex justify-content-between">
                                    <h4 class="card-title">Container Information</h4>
                                </div>
                                <div class="card-body">
                                    <div class="row">

                                        <div class="form-group row">
                                            <label class="control-label col-sm-3 align-self-center mb-0" for="pwd2">Cargo description</label>
                                            <div class="col-sm-9">
                                                <input type="input" class="form-control form-control-sm" id="pwd2" placeholder="">
                                            </div>
                                        </div>

                                        <div class="form-group row">
                                            <label class="control-label col-sm-3 align-self-center mb-0" for="email1">H.S.Code:</label>
                                            <div class="col-sm-9">
                                                <select class="form-select form-select-sm mb-3 shadow-none">
                                                    <?php
                                                    $hs_select = "SELECT * FROM hs_code";
                                                    $result_hs = mysqli_query($conn, $hs_select);
                                                    ?>
                                                    <option selected="">Please select H.S Code</option>
                                                    <?php
                                                    while ($result_hs_total = mysqli_fetch_assoc($result_hs)) {
                                                    ?>
                                                        <option value="<?php $result_hs_total['ID'] ?>"><?php echo "" . $result_hs_total['hs_code'] . " " . $result_hs_total['hs_decription'] ?></option>
                                                    <?php
                                                    }
                                                    ?>
                                                </select>
                                            </div>
                                        </div>

                                        <div class="form-group row">
                                            <label class="control-label col-sm-3 align-self-center mb-0" for="email1">Cargo Type:</label>
                                            <div class="col-sm-9">
                                                <select class="form-select form-select-sm mb-3 shadow-none">

                                                    <?php
                                                    $cargo_type_select = "SELECT * FROM cargo_type";
                                                    $result_cargo_type = mysqli_query($conn, $cargo_type_select);
                                                    ?>

                                                    <option selected="">Please select cargo type</option>
                                                    <?php
                                                    while ($result_cargo_type_total = mysqli_fetch_assoc($result_cargo_type)) {
                                                    ?>
                                                        <option value="<?php $result_cargo_type_total['cargo_type_number'] ?>"><?php echo $result_cargo_type_total['cargo_type_name'] ?></option>
                                                    <?php
                                                    }
                                                    ?>
                                                </select>
                                            </div>
                                        </div>




                                        <div class="form-group row">
                                            <label class="control-label col-sm-3 align-self-center mb-0" for="pwd2">Quantity:</label>
                                            <div class="col-sm-9">
                                                <div class="input-group">
                                                    <input type="text" class="form-control" aria-describedby="basic-addon2">
                                                    <span class="input-group-text" id="basic-addon2">Package</span>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label class="control-label col-sm-3 align-self-center mb-0" for="pwd2">G.W:</label>
                                            <div class="col-sm-9">
                                                <div class="input-group">
                                                    <input type="text" class="form-control" aria-describedby="basic-addon2">
                                                    <span class="input-group-text" id="basic-addon2">KGS</span>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label class="control-label col-sm-3 align-self-center mb-0" for="pwd2">Volume:</label>
                                            <div class="col-sm-9">
                                                <div class="input-group">
                                                    <input type="text" class="form-control" aria-describedby="basic-addon2">
                                                    <span class="input-group-text" id="basic-addon2">M3</span>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label class="control-label col-sm-3 align-self-center mb-0" for="pwd2">Marks:</label>
                                            <div class="col-sm-9">
                                                <input type="input" class="form-control form-control-sm" id="pwd2" placeholder="">
                                            </div>
                                        </div>
                                        <button class="btn btn-primary rounded-pill ">
                                            <span class="btn-inner">
                                                <svg width="32" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                    <path d="M12.0001 8.32739V15.6537" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>
                                                    <path d="M15.6668 11.9904H8.3335" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>
                                                    <path fill-rule="evenodd" clip-rule="evenodd" d="M16.6857 2H7.31429C4.04762 2 2 4.31208 2 7.58516V16.4148C2 19.6879 4.0381 22 7.31429 22H16.6857C19.9619 22 22 19.6879 22 16.4148V7.58516C22 4.31208 19.9619 2 16.6857 2Z" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>
                                                </svg>
                                            </span>
                                            Save
                                        </button>

                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>













                    <!-- Library Bundle Script -->
                    <script src="../../assets/js/core/libs.min.js"></script>

                    <!-- External Library Bundle Script -->
                    <script src="../../assets/js/core/external.min.js"></script>

                    <!-- Widgetchart Script -->
                    <script src="../../assets/js/charts/widgetcharts.js"></script>

                    <!-- mapchart Script -->
                    <script src="../../assets/js/charts/vectore-chart.js"></script>
                    <script src="../../assets/js/charts/dashboard.js"></script>

                    <!-- fslightbox Script -->
                    <script src="../../assets/js/plugins/fslightbox.js"></script>

                    <!-- Settings Script -->
                    <script src="../../assets/js/plugins/setting.js"></script>

                    <!-- Slider-tab Script -->
                    <script src="../../assets/js/plugins/slider-tabs.js"></script>

                    <!-- Form Wizard Script -->
                    <script src="../../assets/js/plugins/form-wizard.js"></script>

                    <!-- AOS Animation Plugin-->

                    <!-- App Script -->
                    <script src="../../assets/js/hope-ui.js" defer></script>


                    <script>
                        function openCity(evt, cityName) {
                            var i, tabcontent, tablinks;
                            tabcontent = document.getElementsByClassName("tabcontent");
                            for (i = 0; i < tabcontent.length; i++) {
                                tabcontent[i].style.display = "none";
                            }
                            tablinks = document.getElementsByClassName("tablinks");
                            for (i = 0; i < tablinks.length; i++) {
                                tablinks[i].className = tablinks[i].className.replace(" active", "");
                            }
                            document.getElementById(cityName).style.display = "block";
                            evt.currentTarget.className += " active";
                        }

                        // Get the element with id="defaultOpen" and click on it
                        document.getElementById("defaultOpen").click();
                    </script>
</body>

</html>