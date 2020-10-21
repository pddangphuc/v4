<?php namespace Expedia\ExpediaUpdate\Controllers;

use Backend\Classes\Controller;
use BackendMenu;
use Backend;


class Log extends Controller
{

    /*public $implement = [        
    	'Backend\Behaviors\ListController',        
    	'Backend\Behaviors\FormController',
    	'Backend\Behaviors\RelationController',        
    	'Backend\Behaviors\ReorderController'    
    ];*/
    

    //public $formConfig = 'config_form.yaml';
    //public $listConfig = 'config_list.yaml';
    //public $relationConfig = 'config_relation.yaml';


    public function __construct()
    {
        parent::__construct();
        BackendMenu::setContext('Expedia.ExpediaUpdate', 'main-menu-expedia-update');

    }


    public function index() { 

        //return "hello";

        $config = $this->makeConfig('$/expedia/expediaupdate/models/log/columns.yaml');
        //$config->model = new \Expedia\ExpediaImport\Models\Images;

        // to edit with value in the fields
        $config->model = new \Expedia\ExpediaUpdate\Models\Log;

        $config->recordUrl = 'expedia/expediaupdate/log/update/:id';

        $widget = $this->makeWidget('Backend\Widgets\Lists', $config);

        $widget->bindToController();

        $this->vars['widget'] = $widget;

    }
    /*public function index() {
    	$config = $this->makeConfig('$/expedia/expediaimport/models/images/columns.yaml');
        //$config->model = new \Expedia\ExpediaImport\Models\Images;

        // to edit with value in the fields
        $config->model = new \Expedia\ExpediaImport\Models\Images;

         $config->recordUrl = 'expedia/expediaimport/images/update/:id';

        $widget = $this->makeWidget('Backend\Widgets\Lists', $config);

        $widget->bindToController();

        $this->vars['widget'] = $widget;

    }


    public function update($id=null) {
        $this->vars['myId'] = $id;

        $config = $this->makeConfig('$/expedia/expediaimport/models/images/fields.yaml');
        //$config->model = new \Expedia\ExpediaImport\Models\Images;

        // to edit with value in the fields
        $config->model = \Expedia\ExpediaImport\Models\Images::find($id);

        $widget = $this->makeWidget('Backend\Widgets\Form', $config);
        $this->vars['widget'] = $widget;

    }


    public function onUpdate($id = null)
    {
        $data = post();

        // Check storage/logs/system.log
        trace_log($data);

        \Flash::success('Jobs done!');
    }
    */
}


?>