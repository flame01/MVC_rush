<?php
/*
** EPITECH PROJECT, 2020:
** MVC_Rush_PHP
**
** User.php
** File description:
**  File in charge of manage a User class instance
**
*/
namespace App\Models;


class User {
  private $user_id; // @type integer
  private $username; // @type string
  private $password; // @type string
  private $passwordConfirmation; // @type string
  private $email; // @type string
  private $group_id; // @type integer
  private $is_banned; // @type integer
  private $is_activated; // @type integer
  private $creation_date; // @type string
  private $last_modification; // @type string

  public function setUserId(string $user_id): self {
    $this->user_id = $user_id;
    return $this;
  }

  public function setUsername(string $username): self {
    $this->username = $username;
    return $this;
  }

  public function setPassword(string $password): self {
    $this->password = $password;
    return $this;
  }

  public function setPasswordConfirmation(string $passwordConfirmation): self {
    $this->passwordConfirmation = $passwordConfirmation;
    return $this;
  }

  public function setEmail(string $email): self {
    $this->email = $email;
    return $this;
  }

  public function setGroupId(string $group_id): self {
    $this->group_id = $group_id;
    return $this;
  }

  public function setIsBanned(string $is_banned): self {
    $this->is_banned = $is_banned;
    return $this;
  }

  public function setIsActivated(string $is_activated): self {
    $this->is_activated = $is_activated;
    return $this;
  }

  public function setCreationDate(string $creation_date): self {
    $this->creation_date = $creation_date;
    return $this;
  }

  public function setLastModification(string $last_modification): self {
    $this->last_modification = $last_modification;
    return $this;
  }

  public function getUserId(): ?int {
    return $this->user_id;
  }

  public function getUsername(): ?string {
    return $this->username;
  }

  public function getPassword(): ?string {
    return $this->password;
  }

  public function getEmail(): ?string {
    return $this->email;
  }

  public function getGroupId(): ?int {
    return $this->group_id;
  }

  public function getIsBanned(): ?int {
    return $this->is_banned;
  }

  public function getIsActivated(): ?int {
    return $this->is_banned;
  }

  public function getCreationDate(): ?string {
    return $this->creation_date;
  }

  public function getLastModification(): ?string {
    return $this->last_modification;
  }

  /**
   * Validate the User model data.
   *
   * @return string - Error message if the model data is invalid, else empty string.
   */
  public function validate(): string {
    $err = '';

    if (empty($this->username) || strlen($this->username) < 3 || strlen($this->username) > 10) {
      $err = $err . "Username field must have between 3 and 10 characters.<br>";
    }
    if(empty($this->email)){
      $err = $err . "Email field must be filled.<br>";
    }elseif (preg_match('#^[a-zA-Z0-9]+@[a-zA-Z]{2,}\.[a-z]{2,4}$#', $this->email) != 1) {
      $err = $err . "Wrong format for email field.<br>";
    }
   
    if (empty($this->password) || empty($this->passwordConfirmation)) {
      $err = $err . "Both password fields must be filled.<br>";
      
    }elseif($this->password !== $this->passwordConfirmation) {
        $err = $err . "Both password fields must coincide.<br>";

      }elseif (strlen($this->password) < 1 || strlen($this->password) > 20) {
          $err = $err . "Password must have between 8 and 20 characters.<br>";
      }   

    if (!empty($err)) {
      throw new \Exception($err);
    }

    return $err;
  }




  

}
