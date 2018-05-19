<?php
  
  class Company extends ActiveRecord\Model {

    // associations/relationships
    static $has_many = array( 'mobiles' );

    /* Sanitizations */
    // setter
    public function set_name ( $name ) {
      $this->assign_attribute( 'name', filter_var( $name, FILTER_SANITIZE_STRING ) );
    }

    // setter
    public function set_founded ( $founded ) {
       $this->assign_attribute( 'founded', filter_var( $founded, FILTER_SANITIZE_STRING ) );
    }

    // setter
    public function set_website ( $website ) {
        $this->assign_attribute( 'website', filter_var( $website, FILTER_SANITIZE_STRING ) );
    }

    // getter
    public function get_name () {
      return htmlentities( $this->read_attribute( 'name' ) );
    }

      // getter
    public function get_founded () {
      return htmlentities( $this->read_attribute( 'founded' ) );
    }

    // getter
    public function get_website () {
      return htmlentities( $this->read_attribute( 'website' ) );
    }

    /* Validations */
    static $validates_presence_of = array(
      array( 'name', 'message' => 'must be present.' ),
      array( 'founded', 'message' => 'must be present.' ),
      array( 'website', 'message' => 'must be present.' )
    );

    static $validates_size_of = array(
      array( 'name', 'maximum' => 100, 'too_long' => 'is way too long.' )
    );

    static $validates_uniqueness_of = array(
      array( 'name', 'message' => 'already exists.' ),
      array( 'website', 'message' => 'already exists.' )
    );

  }
