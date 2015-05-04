<?php

namespace App;
use Carbon\Carbon;
class Project extends Elegant  {

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
    protected $fillable = ['name', 'detail', 'start','status','finish','primary_adviser_id','secondary_adviser_id'];
   public function setStartAttribute($value)
    {
       
        $this->attributes['start'] = \DateTime::createFromFormat('Y-m-d',$value);
//        ddd($this->attributes['start']);
    } 
    public function setFinishAttribute($value)
    {
        $this->attributes['finish'] = \DateTime::createFromFormat('Y-m-d',$value);
    }
    
//    public function getStartAttribute($value)
//    {
//       return $this->datethai($value);
//    }
//    
//    public function getFinishAttribute($value)
//    {
//       return $this->datethai($value);
//    }
    public function student(){
            return $this->hasMany('App\User','project_id')->where('role','student');
    }
    public function coadviser(){
            return $this->hasMany('App\User','id','secondary_adviser_id');
    }
    public function activity(){
        return $this->hasMany('App\Activity','project_id');
    }
}
