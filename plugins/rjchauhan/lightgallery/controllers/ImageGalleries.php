<?php namespace Rjchauhan\LightGallery\Controllers;

use Flash;
use BackendMenu;
use Backend\Classes\Controller;
use Rjchauhan\LightGallery\Models\ImageGallery;

/**
 * Image Galleries Back-end Controller
 */
class ImageGalleries extends Controller
{
    public $implement = [
        'Backend.Behaviors.FormController',
        'Backend.Behaviors.ListController'
    ];

    public $formConfig = 'config_form.yaml';
    public $listConfig = 'config_list.yaml';

    public function __construct()
    {
        parent::__construct();

        BackendMenu::setContext('Rjchauhan.LightGallery', 'lightgallery', 'imagegalleries');
    }

    public function index_onDelete()
    {
        if (($checkedIds = post('checked')) && is_array($checkedIds) && count($checkedIds)) {

            foreach ($checkedIds as $itemId) {
                if (!$gallery = ImageGallery::find($itemId))
                    continue;

                $gallery->delete();
            }

            Flash::success('Successfully deleted those selected.');
        }

        return $this->listRefresh();
    }
}