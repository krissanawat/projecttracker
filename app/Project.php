<?php

namespace App;
use Illuminate\Database\Eloquent\Model;

class Project extends Model  {

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'project';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['name', 'detail', 'start','status','stop','primary_adviser_id','secondary_adviser_id'];

    public function student(){
            return $this->hasMany('App\User','project_id')->where('role','student');
    }
    public function coadviser(){
            return $this->hasMany('App\User','id','secondary_adviser_id');
    }
}
