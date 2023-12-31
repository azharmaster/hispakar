<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimal-ui">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="description" content="Admindek Bootstrap admin template made using Bootstrap 4 and it has huge amount of ready made feature, UI components, pages which completely fulfills any dashboard needs.">
<meta name="keywords" content="flat ui, admin Admin , Responsive, Landing, Bootstrap, App, Template, Mobile, iOS, Android, apple, creative app">
<meta name="author" content="colorlib">

<link rel="icon" href="{{ asset('files/assets/images/pakar.png') }}">
<link href="{{ asset('css-2?family=Open+Sans:300,400,600,700,800') }}" rel="stylesheet">
<link href="{{ asset('css-3?family=Quicksand:500,700') }}" rel="stylesheet">

<link rel="stylesheet" type="text/css" href="{{ asset('files/bower_components/bootstrap/css/bootstrap.min-1.css') }}">

<link rel="stylesheet" href="{{ asset('files/assets/pages/waves/css/waves.min-1.css') }}" type="text/css" media="all">

<link rel="stylesheet" type="text/css" href="{{ asset('files/assets/icon/feather/css/feather-1.css') }}">
<link rel="stylesheet" type="text/css" href="{{ asset('files/bower_components/sweetalert/css/sweetalert-1.css') }}">
<link rel="stylesheet" type="text/css" href="{{ asset('files/assets/css/component-1.css') }}">
<link rel="stylesheet" type="text/css" href="{{ asset('files/assets/icon/themify-icons/themify-icons-1.css') }}">

<link rel="stylesheet" type="text/css" href="{{ asset('files/assets/css/font-awesome-n.min-1.css') }}">

<link rel="stylesheet" type="text/css" href="{{ asset('files/assets/icon/icofont/css/icofont-1.css') }}">
<link rel="stylesheet" href="{{ asset('files/bower_components/chartist/css/chartist-1.css') }}" type="text/css" media="all">

<link rel="stylesheet" type="text/css" href="{{ asset('files/assets/css/style-1.css') }}">
<link rel="stylesheet" type="text/css" href="{{ asset('files/assets/css/widget-1.css') }}">

<!-- Data tables -->
<link rel="stylesheet" type="text/css" href="{{ asset('files/bower_components/datatables.net-bs4/css/dataTables.bootstrap4.min-1.css') }}">
<link rel="stylesheet" type="text/css" href="{{ asset('files/assets/pages/data-table/css/buttons.dataTables.min-1.css') }}">
<link rel="stylesheet" type="text/css" href="{{ asset('files/bower_components/datatables.net-responsive-bs4/css/responsive.bootstrap4.min-1.css') }}">

<!-- font awesome -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" />
<link rel="stylesheet" type="text/css" href="{{ asset('files/assets/css/style-1.css') }}">
<link rel="stylesheet" type="text/css" href="{{ asset('files/assets/css/pages-1.css') }}">
<link rel="stylesheet" type="text/css" href="{{ asset('files/assets/css/print.css') }}">

<!-- added style -->
<style>
    /* Responsive table */
    #dataTable1 td {
        white-space: normal;
        word-wrap: break-word;
    }

    td {
        white-space: normal;
        word-wrap: break-word;
    }

    /* new color*/
    .btn-primary2 {
        background-color: #007BFF;
        color: white;
        border-color: #007BFF;
    }

    .btn-primary2:hover {
        background-color: #0069D9;
        color: white;
        border-color: #0069D9;
    }

    /* card outline */
    .custom-thinner-outline {
        border-width: 1px; 
        border-color: #007BFF;
    }
    
    /* profile pic */
    .parent-container2 {
        width: 140px;
        height: 140px;
        border: 2px solid rgb(233, 231, 231);
        border-radius: 50%; 
    }

    .parent-container {
        width: 30px;
        height: 30px;
        margin-top: -3px;
    }

    .pic-holder {
        width: 100%;
        height: 100%;
        border-radius: 50%;
        overflow: hidden;
        background-size: cover;
        background-position: center;
        background-repeat: no-repeat;
        box-shadow: 0 2px 4px rgba(0, 0, 0, 0.2);
    }
    /* ./profile pic */

    /* dashboard card style*/
    .card-b-primary {
        border-bottom: 2px solid #abcbee; /* Blue color */  
    }
    .card-b-danger {
        border-bottom: 2px solid rgb(242, 173, 183); /* Red color */  
    }
    .card-b-success {
        border-bottom: 2px solid #9de2d4; /* Green color */  
    }
    .card-b-info {
        border-bottom: 2px solid #99d7df; /* Turquoise color */  
    }
    /* END - dashboard card style*/

    /* admin style */
    .data-label {
      font-size: 15px;
    }
    .data-badge {
      font-size: 12px;
      padding: 4px 8px;
      border-radius: 10px;
    }
    .weight-badge {
      background-color: #007bff;
      color: #fff;
    }
    .height-badge {
      background-color: #28a745;
      color: #fff;
    }
    .bpm-badge {
      font-family:Arial, Helvetica, sans-serif;

      color: #fff;
    }
    .sp-badge {
      color: #fff;
      font-family:Arial, Helvetica, sans-serif;
    }
    .sptext-badge {
      color: #20c997;
    }
    .stress-badge {
      color: #fff;    
      font-family:Arial, Helvetica, sans-serif;

    }
    .stresstext-badge {
      color: #4979a9;
    }
    .blood-badge {
      background-color: #dc3545;
      color: #fff;
    }
    @media (min-width: 768px) {
      .table-container {
        display: grid;
        grid-template-columns: repeat(2, 1fr);
        grid-gap: 20px;
      }
    }
    /* END - admin style */

    /* Text align */
    .center {
        text-align: center;
    }
    .left {
        text-align: left;
    }
    .right {
        text-align: right;
    }

    /* from nurse dashboard */
    .btn-custom-font-size {
      font-size: 14px; /* Adjust the font size as per your requirement */
    }
  
    .name-cell {
      max-width: 150px; /* Adjust the value based on how much width you want to allow */
      white-space: nowrap;
      overflow: hidden;
      text-overflow: ellipsis;
      padding: 5px; /* Adjust as needed */
    
    }

    .profile-info {
      display: flex;
      align-items: center;
    }

    .profile-info img {
      width: 40px; /* Adjust the image size as needed */
      height: 40px;
      border-radius: 50%;
      object-fit: cover;
      margin-right: 10px; /* Adjust as needed */
    }

    .profile-info span {
      flex: 1; /* Allow the name to take up remaining space in the flex container */
    }
    /* END - from nurse dashboard */
</style>