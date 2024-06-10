<?php 

namespace App\Model;

use Core\Model\Model;

class User extends Model
{
  public string $email;
  public string $password;
  public string $firstname;
  public string $lastname;
  public string $phone;
  public ?string $address;
  public ?string $zip_code;
  public ?string $city;
  public ?string $country;
  public bool $is_admin;
  public bool $is_active;
}