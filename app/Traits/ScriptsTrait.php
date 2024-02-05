<?php

namespace App\Traits;

use App\Models\Enhance\Script;
use Illuminate\Database\Eloquent\Relations\MorphOne;

trait ScriptsTrait
{
    public $hasScripts = true;


    /**
     * Get a specific resource script.
     *
     * @return Illuminate\Database\Eloquent\Relations\MorphOne;
     */
    public function script(): MorphOne
    {
        return $this->morphOne(Script::class, 'scriptable');
    }
}
