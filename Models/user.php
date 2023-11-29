<?php

class user{

    private $id;
    private $name;
    private $password;
    private $role;
    private $email;
    private $phone;


  function set_id($id)
  {
    $this->id = $id;
  }

  function set_name($name)
  {
    $this->name = $name;
  }

  function set_email($email)
  {
    $this->email = $email;
  }

  function set_password($password)
  {
    $this->password = $password;
  }

  function set_role($role)
  {
    $this->role = $role;
  }

  function set_phone($phone)
  {
    $this->phone = $phone;
  }

  function get_id()
  {
    return $this->id;
  }

  function get_name()
  {
    return $this->name;
  }

  function get_email()
  {
    return $this->email;
  }

  function get_password()
  {
    return $this->password;
  }

  function getrole()
  {
    return $this->role;
  }

  function get_phone()
  {
    return $this->phone;
  }

}

?>