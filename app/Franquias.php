<?php

namespace App;

use App\MyModel;
use willvincent\Rateable\Rateable;
use App\Restorant;
class Franquias extends MyModel
{ 
    use Rateable;
    protected $table = 'users';
    protected $imagePath = '/uploads/franquias/'; 
 
    
    public function getLogoAttribute()
    {
        return $this->getImge($this->image, config('global.restorant_details_image'));
    }
    
    public static function boot()
    {
        parent::boot();
        self::deleting(function (self $franquias) {
            if (config('settings.is_demo') | config('settings.is_demo')) {
                return false; //In demo disable deleting
            } else {
                return true;
            }
        });
    }
}
