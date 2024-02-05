<?php

namespace App\Traits\SEOTool;

use App\Models\Enhance\SEOTool;
use Illuminate\Database\Eloquent\Relations\MorphOne;

trait SEOToolTrait
{
    public $hasSeoTools = true;


    /**
     * Get SEO tool of a specific resource.
     *
     * @return Illuminate\Database\Eloquent\Relations\MorphOne;
     */
    public function seotool(): MorphOne
    {
        return $this->morphOne(SEOTool::class, 'seoable');
    }
}
