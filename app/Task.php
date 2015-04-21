<?php

namespace App;
use Illuminate\Database\Eloquent\Model;

class Task extends Model  {

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'task';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['name', 'start_time', 'end_time', 'status','approve','activity_id','completed_at'];

    public function activity(){
            return $this->belongsTo('App\Activity','activity_id');
    }
       public function responsible(){
            return $this->belongsTo('App\User','responsible');
    }
   
}
