<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Job extends Model {
    use HasFactory;

    protected $table = 'job_listings';
   // protected $fillable = ['title', 'salary', 'employer_id']; // Only these are allowed to mass assign
    // all attributes allowed to mass assigned. If someone try to change user id, it will be ignored
// to avoid fillable variable to add fields whenever a new field is created, we insteAD make a list of guarded fields
    protected $guarded = []; // mno fields to be guarded
    public function employer() {
        return $this->belongsTo(Employer::class);
    }
    public function tags() {
        return $this->belongsToMany(Tag::class, foreignPivotKey: "job_listing_id");
        // a tag belongs to jobid 10 but it can belong to many jobs as well..there we use belongstomany relationship
    }
    
}