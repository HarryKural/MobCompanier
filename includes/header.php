<?php

  if ( session_status() == PHP_SESSION_NONE ) session_start();

  $messages = [
    'success' => isset( $_SESSION['success'] ) ? $_SESSION['success'] : null,
    'fail' => isset( $_SESSION['fail'] ) ? $_SESSION['fail'] : null
  ];

  unset( $_SESSION['success'] );
  unset( $_SESSION['fail'] );

?>

<!DOCTYPE HTML>
<html lang="en">

  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no"/>
    <link type="text/css" rel="stylesheet" href="stylesheets/css.css" />
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1q8mTJOASx8j1Au+a5WDVnPi2lkFfwwEAa8hDDdjZlpLegxhjVME1fgjWPGmkzs7" crossorigin="anonymous">
    <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.6.2/css/font-awesome.min.css" rel="stylesheet" integrity="sha384-aNUYGqSUL9wG/vP7+cWZ5QOM4gsQou3sBfWRr/8S3R1Lv0rysEmnwsRKMbhiQX/O" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.6.4/css/bootstrap-datepicker.css">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <title><?= isset( $page_title ) ? $page_title : 'MoBCompanier' ?></title>
  </head>

  <body style="padding-top: 70px">
    <?php require_once $_SERVER['DOCUMENT_ROOT'] . '/COMP-1006/Project02/includes/notify.php' ?>
    <!-- nav -->
    <nav class="navbar navbar-inverse navbar navbar-fixed-top" role="navigation">
      <div class="container-fluid page-scroll">

        <!-- Logo -->
        <div class="navbar-header">
          <!-- Button for NavBar appears in smaller devices -->
          <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#mainNavBar">
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
          <a class="navbar-brand">MoBCompanier</a>
        </div>

        <!-- Menu Items -->
        <!-- Basic horizontal menu -->
        <div class="collapse navbar-collapse" id="mainNavBar">
          <ul class="nav navbar-nav">
            <li><a href="/COMP-1006/Project02/companies/?action=index">Companies</a></li>
            <?php if ( is_authenticated() ): ?>
              <li><a href="/COMP-1006/Project02/companies/?action=create"><span class="glyphicon glyphicon-plus-sign"></span> New Company</a></li>
              <li><a href="/COMP-1006/Project02/mobiles/?action=create"><span class="glyphicon glyphicon-plus-sign"></span> New Mobile</a></li>
              <li><a href="/COMP-1006/Project02/utilities/?action=mobile_seeder">Mobile Seeder</a></li>
              <li><a href="/COMP-1006/Project02/users/?action=index"><span class="glyphicon glyphicon-user"></span> Users</a></li>
              <li><a href="/COMP-1006/Project02/authentication/?action=logout"><i class="fa fa-sign-out">&nbsp;</i>Sign Out</a></li>
            <?php else: ?>
              <li><a href="/COMP-1006/Project02/authentication/?action=login"><i class="fa fa-sign-in">&nbsp;</i>Sign In</a></li>
              <li><a href="/COMP-1006/Project02/users/?action=create"><span class="glyphicon glyphicon-user"></span> New User</a></li>
            <?php endif ?>
          </ul>
        </div>
      </div>
    </nav>
