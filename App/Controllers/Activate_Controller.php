<?php

namespace App\Controllers;

use App\Models\User_Model;

class Activate_Controller extends Base_Controller
{

    protected $code;
    protected $activate_message;

    protected function input($params = [])
    {
        parent::input();

        $this->code = $params['code'];


        $this->title = 'Активация логина';
        $this->keywords = 'активация нового пользователя';
        $this->description = 'активация нового пользователя';

        if (!User_Model::instance()->activate_user($this->code)) {
            $this->activate_message = 'произошла какято ошибочка';
        } else {
            $this->activate_message = "Спасибо за регистрацию на сайте " . SITE_NAME . " теперь вы можете заходить на сайт под своим логином
                            и паролем";
        }

    }

    protected function output()
    {
        $this->content = $this->render(['message' => $this->activate_message], 'App/Views/blocks/activate_content');

        $this->page = parent::output();
    }



}