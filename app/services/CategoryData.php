<?php
namespace App\Services;

use App\Models\category;


class CategoryData
{
    public static function categoryForSelect()
    {
        return category::all()->pluck('name','name');
        //pluck method first will be on the display and second will be the value.
    }

  
}

?>