<?php

/**
 * Created by Claudio Campos.
 * User: callcocam@gmail.com, contato@sigasmart.com.br
 * https://www.sigasmart.com.br
 */

namespace App\Models;

use Callcocam\Tenant\BelongsToTenants;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Storage;
use Tall\Sluggable\HasSlug;
use Tall\Sluggable\SlugOptions;

class AbstractModel extends Model
{
    use HasFactory, BelongsToTenants, SoftDeletes, \Callcocam\Acl\Traits\HasUlids, HasSlug;


    protected $guarded = ['id'];

    /**
     * @return SlugOptions
     */
    public function getSlugOptions()
    {
        if (is_string($this->slugTo())) {
            return SlugOptions::create()
                ->generateSlugsFrom($this->slugFrom())
                ->saveSlugsTo($this->slugTo());
        }
    }

    public function scopeStatus($query, $status = 'published')
    {
        return $query->where('status', $status);
    }

    public function getImageUrlAttribute()
    {
        if ($this->image) {
            return Storage::url($this->image);
        }
        return  '';
    }
}
