<?php

/**
 * Created by Claudio Campos.
 * User: callcocam@gmail.com, contato@sigasmart.com.br
 * https://www.sigasmart.com.br
 */

namespace Callcocam\Profile\Traits;

use Callcocam\Profile\Models\Address;
use Callcocam\Profile\Models\Contact;
use Callcocam\Profile\Models\Document;
use Callcocam\Profile\Models\Image;
use Callcocam\Profile\Models\Social;

trait HasProfileModel
{
    public function address()
    {
        return $this->morphOne(Address::class, 'addressable');
    }

    public function addresses()
    {
        return $this->morphMany(Address::class, 'addressable');
    }

    public function contacts()
    {
        return $this->morphMany(Contact::class, 'contactable');
    }

    public function socials()
    {
        return $this->morphMany(Social::class, 'socialable');
    }

    public function documents()
    {
        return $this->morphMany(Document::class, 'documentable');
    }

    public function images()
    {
        return $this->morphMany(Image::class, 'imageable');
    }
}
