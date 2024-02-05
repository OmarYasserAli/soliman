<?php

namespace App\Models\Enhance;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class ImageDetails extends Model
{
    use HasFactory;

    public $table = 'image_details';

    protected $guarded = [];

    protected $casts = [
        'image_details' => 'json',
    ];

    // /**
    //  * Decode the json to an associative array and get all image details for the specified resource.
    //  *
    //  * @return array
    //  */
    // public function getImagesDetails() : array
    // {
    //     return json_decode($this->image_details, true);
    // }

    /**
     * Get the parent model.
     *
     * @return Illuminate\Database\Eloquent\Relations\MorphTo;
     */
    public function imageable(): MorphTo
    {
        return $this->morphTo();
    }
}
