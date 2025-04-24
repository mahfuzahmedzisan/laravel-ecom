<?php

use App\Models\AuthBaseModel;
use Illuminate\Support\Facades\Auth;

function admin()
{
  return Auth::guard('admin')->user();
}

function user()
{
  return Auth::guard('web')->user();
}

function timeFormat($time)
{
  return date(('d M, Y H:i A'), strtotime($time));
}

function createrName($user)
{
  return $user->name ?? 'System';
}

function updaterName($user)
{
  return $user->name ?? 'Null';
}

function deleterName($user)
{
  return $user->name ?? 'Null';
}

function updatedDate($createdAt, $updatedAt)
{
  return $createdAt == $updatedAt ? "N/A" : timeFormat($updatedAt);
}


function storage_url($urlOrArray)
{
  $image = asset('default_img/no_img.jpg');
  if (is_array($urlOrArray) || is_object($urlOrArray)) {
    $result = '';
    $count = 0;
    $itemCount = count($urlOrArray);
    foreach ($urlOrArray as $index => $url) {

      $result .= $url ? asset('storage/' . $url) : $image;

      if ($count === $itemCount - 1) {
        $result .= '';
      } else {
        $result .= ', ';
      }
      $count++;
    }
    return $result;
  } else {
    return $urlOrArray ? asset('storage/' . $urlOrArray) : $image;
  }
}

function auth_storage_url($url, $gender = false)
{
  $image = asset('default_img/other.png');
  if ($gender == AuthBaseModel::GENDER_MALE) {
    $image = asset('default_img/male.jpeg');
  } elseif ($gender == AuthBaseModel::GENDER_FEMALE) {
    $image = asset('default_img/female.jpg');
  }
  return $url ? asset('storage/' . $url) : $image;
}

function genders()
{
  $genders = [];
  $authBaseModel = new AuthBaseModel();
  foreach ($authBaseModel->getGender() as $key => $value) {
    $genders[$key] = $value;
  }
  return $genders;
}
