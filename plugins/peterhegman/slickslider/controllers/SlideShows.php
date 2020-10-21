<?php namespace PeterHegman\SlickSlider\Controllers;

use Backend\Classes\Controller;
use BackendMenu;
use BackendAuth;
use Db;
use Model;

class SlideShows extends Controller
{
    public $implement = ['Backend\Behaviors\ListController','Backend\Behaviors\FormController'];
    
    public $listConfig = 'config_list.yaml';
    public $formConfig = 'config_form.yaml';

    public $requiredPermissions = [
        'peterhegman.slickslider.*'
    ];

    public function formExtendFields($form)
    {
        $backendUser = BackendAuth::getUser();
        $isSuperUser = $backendUser->is_superuser;
        $fieldsToRemove = $this->formGetWidget()
        ->getTab('primary')
        ->fields['peterhegman.slickslider::lang.slickslider.settings'];
        //dd($fieldsToRemove);
        if (!$this->user->hasPermission([
            'peterhegman.slickslider.manage_slide_shows'
        ]) && !$isSuperUser) {
            foreach ($fieldsToRemove as $fieldToRemove) {
                $form->removeField($fieldToRemove->fieldName);
            }
        }
    }

    public function __construct()
    {
        parent::__construct();
        BackendMenu::setContext('PeterHegman.SlickSlider', 'slide_shows');
    }



    public function onDuplicate() {
           $checked_items_ids = input('checked');

           foreach ($checked_items_ids as $id) {
              //$original = SlideShows::where("id", $id)->first();
              //$original = Db::table('peterhegman_slickslider_slide_shows')->where('id', $id)->first();
              $original = \PeterHegman\Slickslider\Models\SlideShows::where("id", $id)->first();

              $clone = $original->replicate();
              $clone->slide_show_title = "COPY_".$clone->slide_show_title;
              //$clone->slug = now()->timestamp."_".$clone->slug;
              //$clone->published = 0;
              //$clone->highlight = 0;
              //$fake = new \System\Models\File;
              //$imgs = $original->gallery;
              //$fake->fromUrl($imgs[0]->getPath(), now()->timestamp.'.jpg');      
              //$clone->id = Event::withTrashed()->max('id') + 1;
              //$clone->gallery()->add($fake);

              $clone->save();
           }

           \Flash::success('Event cloned');
           return $this->listRefresh();
    }  


}
