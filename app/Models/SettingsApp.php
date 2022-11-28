<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SettingsApp extends Model
{
    use HasFactory;

    protected $table = 'settings_app';

    protected $primaryKey = 'id';

    public $timestamps = true;

    protected $fillable = array('id');
}
