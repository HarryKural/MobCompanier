<?php

  // start our session to avoid headers issue
  session_start();

  /* ACTION HANDLER */
  // attach PHP ActiveRecord
  require_once $_SERVER['DOCUMENT_ROOT'] . '/COMP-1006/Project02/config.php';

  /* VIEWS */
  // create
  function create () {
    $companies = Company::all();
    return get_included_file_contents( 'views/create.php', ['companies' => $companies] );
  }


  // edit
  function edit ( $get ) {
    if ( !isset( $get['id'] ) || !Mobile::exists( $get['id'] ) ) {
      $_SESSION['fail'] = 'You must choose a mobile to edit.';
      header( 'Location: ../companies/index.php?action=index' );
      exit;
    }

    $mobile = Mobile::find( $get['id'] );
    $companies = Company::all();
    return get_included_file_contents( 'views/edit.php', ['companies' => $companies, 'mobile' => $mobile] );
  }


  /* PROCESSES */
  // add
  function add ( $post ) {
    // create the new mobile
    $mobile = New Mobile;

    // assign the values
    $mobile->name = $post['name'];
    $mobile->price = $post['price'];
    $mobile->company_id = $post['company_id'];

    // process the image
    $mobile->file = $_FILES['image'];

    // save the image
    $mobile->save();

    // redirect with an error if the mobile is invalid
    if ( $mobile->is_invalid() ) {
      $_SESSION['fail'][] = $mobile->errors->full_messages();
      $_SESSION['fail'][] = 'The mobile could not be created.';

      header( 'Location: index.php?action=create' );
      exit;
    }

    // redirect with a success if mobile was saved
    $_SESSION['success'] = 'Mobile was created successfully.';
    header( 'Location: ../companies/index.php?action=show&id=' . $mobile->company->id );
    exit;
  }


  // update
  function update ( $post ) {
    // redirect if the id wasn't passed or the mobile does not exist
    if ( !isset( $post['id'] ) || !Mobile::exists( $post['id'] ) ) {
      $_SESSION['fail'] = 'You must choose a mobile to edit.';
      header( 'Location: ../companies/index.php?action=index' );
      exit;
    }

    // find the mobile
    $mobile = Mobile::find( $post['id'] );

    // assign the values to mobile
    $mobile->name = $post['name'];
    $mobile->price = $post['price'];
    $mobile->company_id = $post['company_id'];

    // process the image
    if ( !empty( $post['current_image'] ) ) $mobile->image = $post['current_image'];
    $mobile->file = $_FILES['image'];

    // save the mobile
    $mobile->save();

    // if there are validation errors, redirect with an error message
    if ( $mobile->is_invalid() ) {
      $_SESSION['fail'][] = $mobile->error->full_messages();
      $_SESSION['fail'][] = 'The mobile could not be updated.';

      header( 'Location: index.php?action=edit&id=' . $mobile->id );
      exit;
    }

    // redirect with a success message
    $_SESSION['success'] = 'Mobile was updated successfully.';
    header( 'Location: ../companies/index.php?action=show&id=' . $mobile->company->id );
    exit;
  }


  // delete
  function delete ( $post ) {
    if ( !isset( $post['id'] ) || !Mobile::exists( $post['id'] ) ) {
      $_SESSION['fail'] = 'You must choose a mobile to edit.';
      header( 'Location: ../companies/index.php?action=index' );
      exit;
    }

    $mobile = Mobile::find( $post['id'] );
    $company = $mobile->company;
    $mobile->delete();

    $_SESSION['success'] = 'The mobile was deleted successfully.';
    header( 'Location: ../companies/index.php?action=show&id=' . $company->id );
  }


  /* Authentication Block */
  request_is_authenticated( $_REQUEST, [] );

  // action handler for REQUEST
  $yield = action_handler( ['add', 'update', 'delete', 'create', 'edit'], $_REQUEST );
