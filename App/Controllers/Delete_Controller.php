<?php

namespace App\Controllers;


use App\Models\Articles_Model;
use App\Models\Comments_Model;

class Delete_Controller extends Base_Controller
{

    protected function input($params = []){
        parent::input();

        switch($params['item']){
           case 'comment':
           Comments_Model::instance()->delete_comment($params['id']);
           break;
           case 'article':
           Articles_Model::instance()->delete_article($params['id']);
           break;
           case 'tag':
           Articles_Model::instance()->delete_tag($params['id']);
           break;
        }


    }


}