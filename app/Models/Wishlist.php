<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Wishlist extends Model
{
    use HasFactory;

    protected $table = 'wishlists';

    protected $primaryKey = 'id';

    public $timestamps = true;

    protected $fillable = array('id', 'property_id', 'user_id');

    public function user()
    {
       return $this->belongsTo(User::class);
    }

    public function property()
    {
       return $this->belongsTo(Property::class);
    }
    
}
