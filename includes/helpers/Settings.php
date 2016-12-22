<?php
class JCG_Settings {
  public function __construct($id, $title, $cb, $page, $name) {
    $this->ID = $id;
    $this->name = $name;
    $this->page = $page;

    add_settings_section($id, $title, $cb, $page);
    $this->register();
  }

  public function register() {
    register_setting($this->ID, $this->name);
  }

  public function addField($id, $title, $cb) {
    add_settings_field( $id, $title, $cb, $this->page, $this->ID);
  }
}
