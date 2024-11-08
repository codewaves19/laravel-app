<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Job extends Model {
    protected $table = 'job_listings';
    protected $fillable = ['title', 'salary']; // Only these are allowed to mass assign
    // all attributes allowed to mass assigned. If someone try to change user id, it will be ignored
    
}