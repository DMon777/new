<?php

namespace App\Controllers;


class Edit_Profile_Controller extends Base_Controller
{


    protected function input($params = []){
        parent::input();

        $this->title = "Редактировать профиль";
    }

    protected function output(){

        $this->content = $this->render([],'App/Views/blocks/edit_profile_content');

        $this->page = parent::output();
    }

}