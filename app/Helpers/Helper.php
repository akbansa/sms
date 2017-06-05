<?php

function generateRandomString($length = 10) {
  return substr(str_shuffle(str_repeat($x='0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ', ceil($length/strlen($x)) )),1,$length);
}

function getGenderText($genderCode)
{
  if($genderCode == config('sms.static_variables.male'))
    return "Male";
  else
    return "Female";
}