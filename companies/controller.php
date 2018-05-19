<?php

  // start our session to avoid headers issue
  session_start();

  /* ACTION HANDLER */
  // attach PHP ActiveRecord
  require_once $_SERVER['DOCUMENT_ROOT'] . '/COMP-1006/Project02/config.php';

  /* VIEWS */
  // index
  function index () {
    $companies = Company::all();
    return get_included_file_contents( 'views/index.php', ['companies' => $companies] );
  }


  // show
  function show ( $get ) {
    // redirect user if here accidentally
    if ( !isset( $get['id'] ) || !Company::exists( $get['id'] ) ) {
      $_SESSION['fail'] = "You must select a company.";
      header( 'Location: index.php?action=index' );
      exit;
    }

    $company = Company::find( $get['id'] );
    return get_included_file_contents( 'views/show.php', ['company' => $company] );
  }


  // create
  function create () {
    return get_included_file_contents( 'views/create.php' );
  }


  // edit
  function edit ( $get ) {
   if ( !isset( $get['id'] ) || !Company::exists( $get['id'] ) ) {
      $_SESSION['fail'] = "You must select a company.";
      header( 'Location: index.php?action=index' );
      exit;
    }

    $company = Company::find( 'first', $get['id'] );
    return get_included_file_contents( 'views/edit.php', ['company' => $company] );
  }


  /* PROCESSES */
  // add
  function add ( $post ) {
    // create a new record
    $company = new Company;

    // assign the values
    $company->name = $post['name'];

    // assign the values
    $company->founded = $post['founded'];

    // assign the values
    $company->website = $post['website'];

    // when we save, we apply our assigned properties and write them to the database
    $company->save();

    // redirect if there is an error
    if ( $company->is_invalid() ) {
      // set the fail messages
      $_SESSION['fail'][] = $company->errors->full_messages();
      $_SESSION['fail'][] = 'The company could not be created.';

      // redirect
      header( 'Location: index.php?action=create' );
      exit;
    }

    // set the success message
    $_SESSION['success'] = 'Company was created successfully.';
    header( 'Location: index.php?action=index' );
    exit;
  }


  // update
  function update ( $post ) {
    // redirect user if here accidentally
    if ( !isset( $post['id'] ) || !Company::exists( $post['id'] ) ) {
      $_SESSION['fail'] = "You must select a company.";
      header( 'Location: index.php?action=index' );
      exit;
    }

    // get existing record
    $company = Company::find( $post['id'] );

    // assign the values
    $company->name = $post['name'];

    // assign the values
    $company->founded = $post['founded'];

    // assign the values
    $company->website = $post['website'];

    // when we save, we apply our assigned properties and write them to the database
    $company->save();

    // redirect if there is an error
    if ( $company->is_invalid() ) {
      // set the fail messages
      $_SESSION['fail'][] = $company->errors->full_messages();
      $_SESSION['fail'][] = 'The company could not be updated.';

      // redirect
      header( 'Location: index.php?action=edit&id=' . $company->id );
      exit;
    }

    // set the success message
    $_SESSION['success'] = 'Company was updated successfully.';
    header( 'Location: index.php?action=index' );
    exit;
  }


  // delete
  function delete ( $post ) {
    // redirect user if here accidentally
    if ( !isset( $post['id'] ) || !Company::exists( $post['id'] ) ) {
      $_SESSION['fail'] = "You must select a company.";
      header( 'Location: index.php?action=index' );
      exit;
    }

    // delete the record
    $company = Company::find( $post['id'] );
    $company->delete();

    $_SESSION['success'] = 'The company was deleted successfully.';
    header( 'Location: index.php?action=index' );
    exit;
  }


  /* Authentication Block */
  request_is_authenticated( $_REQUEST, ['index', 'show'] );

  // action handler for REQUEST
  $yield = action_handler( ['add', 'update', 'delete', 'index', 'show', 'create', 'edit'], $_REQUEST );
