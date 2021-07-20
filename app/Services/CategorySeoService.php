<?php

namespace App\Services;

use App\Models\Category;

class  CategorySeoService
{
    /**
     * Writing category seo file after each category model modification
     */
    public static function categorySeoWrite()
    {
        $categories = Category::get(['name', 'slug']);
        $category_file = fopen(base_path('resources/lang/en/category-seo.php'), 'w');

        $array = [];
        $txt = "<?php return ";
        foreach ($categories as $category) {

            $array["seo-title:" . $category->name] = $category->seo_title;
            $array["seo-description:" . $category->name] = $category->seo_description;
        }
        fwrite($category_file, $txt . var_export($array, true) . ";");
        fclose($category_file);
    }
}
