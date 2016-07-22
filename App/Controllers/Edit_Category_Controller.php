<?php
/**
 * Created by PhpStorm.
 * User: Дима
 * Date: 20.07.2016
 * Time: 14:16
 */

namespace App\Controllers;


use App\Models\Category_Model;
use App\Models\Menu_Model;

class Edit_Category_Controller extends Base_Admin_Controller
{

    protected $categories;

    public function input($params = [])
    {
        parent::input();

        if ($_POST['sort']) {
            Menu_Model::instance()->category_sorting($_POST['sorting'], Menu_Model::instance()->get_categories());
        }

        if($_POST['add_category']){
            Category_Model::instance()->add_new_category($_POST['new_category'],$_POST['href']);
        }

        $this->categories = Menu_Model::instance()->get_categories();

    }

    public function output(){

        $this->content = $this->render(
            [
                'categories' => $this->categories
            ],
            'App/Views/blocks/admin_blocks/edit_category_content'
        );
        $this->page = parent::output();
    }



}