<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ContactList extends Model
{
    protected $fillable = ['name', 'phone', 'latitude', 'longitude'];
    
    public function contacts()
    {
        return $this->belongsTo(User::class);
    }
}