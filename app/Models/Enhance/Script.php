<?php

namespace App\Models\Enhance;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Script extends Model
{
    use HasFactory;

    protected $table = 'scripts';

    protected $guarded = [];

    /**
     * Get the parent scriptable model.
     *
     * @return Illuminate\Database\Eloquent\Relations\MorphTo;
     */
    public function scriptable(): MorphTo
    {
        return $this->morphTo();
    }
}
