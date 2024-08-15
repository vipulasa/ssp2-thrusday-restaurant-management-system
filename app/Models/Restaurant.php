<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;

class Restaurant extends Model implements HasMedia
{

    use InteractsWithMedia;

    protected $fillable = [
        'name',
        'slug',
        'description',
        'email',
        'phone',
        'address',
        'city',
        'province',
        'postal_code',
        'country',
        'cuisine',
        'opening_hours',
        'status',
    ];

    protected $casts = [
        'cuisine' => 'array',
        'opening_hours' => 'array',
    ];

    public function registerMediaCollections(): void
    {
        $this->addMediaCollection('logo')
            ->singleFile();

        $this->addMediaCollection('gallery');
    }

}
