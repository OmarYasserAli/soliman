<?php

namespace App\Models\Enhance;

use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;
use Illuminate\Database\Eloquent\Relations\MorphTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class SEOTool extends Model
{
    use HasFactory, HasTranslations;

    protected $table = 'seotools';

    protected $guarded = [];

    public $translatable = ['meta_title', 'meta_description', 'og_type', 'og_title', 'og_url', 'og_description', 'twitter_card', 'twitter_title', 'twitter_site', 'twitter_description', 'twitter_image_alt'];

    public $filesFields = ['og_image', 'twitter_image'];

    /**
     * Name of directory to store all of uploaded seo tools files
     */
    public $filesPath = 'seotools';


    /**
     * Get specific SEOTool attribute value depending on the sent language
     *
     * @param string $attributeName
     * @param string $lang
     */
    public function getSeoToolAttributeValue(string $attributeName, string $lang)
    {
        return $this->getTranslation($attributeName, $lang);
    }

    /**
     * Get the parent seoable model.
     *
     * @return Illuminate\Database\Eloquent\Relations\MorphTo;
     */
    public function seoable(): MorphTo
    {
        return $this->morphTo();
    }
}
