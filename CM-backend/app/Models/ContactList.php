<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ContactList extends Model
{
    public function contacts()
    {
        return $this->hasMany(Contact::class);
    }
}