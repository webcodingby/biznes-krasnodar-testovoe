<?php


namespace App\Controllers;


class ValidateInput
{

    public static function validateEmail($data): string
    {
        $email = $data['email'];
        $data['status'] = 'ok';
        if (empty($email)){
            $data['status'] = "Email is required";
        } else {
            // check if e-mail address is well-formed
            if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                $data['status'] = "Invalid email format";
            }
        }
        return $data['status'];
    }
}