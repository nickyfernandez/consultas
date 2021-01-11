<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Usuario extends Model
{
  public $table = 'usuarios';
  public $primaryKey = 'id';
  public $timestamp = false;
  public $guarded = [];

    public function scopeSearch($query, $id){
      return $query->where('id', '=', $id);
    }

    public function tickets(){
      return $this->hasMany(Ticket::class,'id_ticket');
    }

}
