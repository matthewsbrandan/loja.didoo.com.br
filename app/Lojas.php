<?php

namespace App;

use App\MyModel;
use willvincent\Rateable\Rateable;

class Lojas extends MyModel
{
    use Rateable;
    protected $table = 'restorants';
    protected $imagePath = '/uploads/settings/';

    protected $fillable = ['name', 'alias', 'image', 'header_title', 'header_subtitle'];
    protected $appends = ['logo'];

    public function getLogoAttribute()
    {
        return $this->getImge($this->image, config('global.restorant_details_image'));
    }

    public static function boot()
    {
        parent::boot();
        self::deleting(function (self $loja) {
            if (config('settings.is_demo') | config('settings.is_demo')) {
                return false; //In demo disable deleting
            } else {
                return true;
            }
        });
    }
}
