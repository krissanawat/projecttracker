<?php

namespace App;
use Illuminate\Database\Eloquent\Model;

class Responsible extends Model  {

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'task_dependent';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['dependent_on', 'task_id', 'status'];

    public function dependent_on(){
            return $this->belongsTo('App\Task','task_id');
    }
      
   
}
