<?php namespace ViewRetreats\Favourites;

use System\Classes\PluginBase;

class Plugin extends PluginBase
{
    public function registerComponents()
    {
      return [
        'ViewRetreats\Favourites\Components\BookmarkFavorite' => 'bookmarkfavorite'
      ];
    }

    public function registerSettings()
    {
    }
}
