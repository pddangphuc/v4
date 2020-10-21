<?php namespace Expedia\ExpediaImport\Controllers;

use Backend\Classes\Controller;
use BackendMenu;

class Collection extends Controller
{
    public $implement = [        'Backend\Behaviors\ListController',        'Backend\Behaviors\FormController'    ];
    
    public $listConfig = 'config_list.yaml';
    public $formConfig = 'config_form.yaml';

    public function __construct()
    {
        parent::__construct();
        BackendMenu::setContext('Expedia.ExpediaImport', 'main-menu-expedia-import', 'side-menu-collection');
    }
}
