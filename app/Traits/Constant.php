<?php

namespace App\Traits;

trait Constant
{
    public $successCode = 200;
    public $failCode = 400;

    /*
     * Images Paths
     * */
//    public $imageParentDirectory = '/api';
    public $imageParentDirectory = '';

    public $default_user_image = 'def_user.png';
    public $user_image_directory = '/images/users/';


}
