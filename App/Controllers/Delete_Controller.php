<?php

namespace App\Controllers;


use App\Models\Comments_Model;

class Delete_Controller extends Base_Controller
{

    protected function input($params = []){
        parent::input();

        switch($params['item']){
           case 'comment':
           Comments_Model::instance()->delete_comment($params['id']);
           break;

        }


    }


}