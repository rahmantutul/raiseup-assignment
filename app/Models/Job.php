<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Job extends Model
{
    use HasFactory;
    protected $fillable=['title','description','thumbnail','user_id'];
    
    public function user(){
       return $this->belongsTo('app\Models\Admin','user_id');
    }
}
