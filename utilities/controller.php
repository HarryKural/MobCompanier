<?php

  // start our session to avoid headers issue
  session_start();

  /* ACTION HANDLER */
  // attach PHP ActiveRecord
  require_once $_SERVER['DOCUMENT_ROOT'] . '/COMP-1006/Project02/config.php';

  /* VIEWS */
  // index
  function mobile_seeder () {
    return get_included_file_contents( 'views/mobile_seeder.php' );
  }


  /* PROCESSES */
  function mobile_seeder_process () {
    // verify there is a file and it's a CSV
    if ( $_FILES['csv']['error'] !== 0 || !preg_match( "/csv/i", $_FILES['csv']['type'] ) ) {
      $_SESSION['fail'][] = "You must upload a valid CSV (comma-separated values) file.";
      header( 'Location: index.php?action=mobile_seeder' );
      exit;
    }

    // convert the file into an associative array
    $csv = build_csv_array( file( $_FILES['csv']['tmp_name'] ) );

    /* populate the database */
    foreach ( $csv as $row ) {
      // check if the company exists
      if ( Company::exists( ['name' => $row['company']] ) ) {
        $company_id = Company::find( 'first', ['name' => $row['company']] )->id;
      } else {
        $company_id = Company::create( ['name' => $row['company']] )->id;
      }

      // check if the mobile exists
      if ( !Mobile::exists( ['name' => $row['mobile'], 'company_id' => $company_id] ) ) {
        Mobile::create( ['name' => $row['mobile'], 'company_id' => $company_id, 'price' => $row['price']] );
      }
    }

    header( 'Location: ../companies/index.php?action=index' );
    exit;
  }

  function build_csv_array ( $csv ) {
    // get the rows
    $rows = array_map( 'str_getcsv', $csv );

    // get the header row
    $header = array_shift( $rows );

    // build the CSV associative array
    $csv = [];
    foreach ( $rows as $row ) {
      $csv[] = array_combine( $header, $row );
    }

    return $csv;
  }


  /* Authentication Block */
  request_is_authenticated( $_REQUEST, [] );

  // action handler for REQUEST
  $yield = action_handler( ['mobile_seeder', 'mobile_seeder_process'], $_REQUEST );
