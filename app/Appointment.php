<?php

namespace App;
use Illuminate\Database\Eloquent\Model;

class Appointment extends Model  {

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'appointment';
    protected $fillable = ['title','detail','approve','due_date','adviser_id','status','project_id','location'];
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    public function project(){
            return $this->belongsTo('App\Project','project_id');
    }
    public function coadviser(){
            return $this->hasMany('App\User','project_id')->where('role','adviser')->whereNotIn('id',[\Auth::user()->id]);
    }
}
