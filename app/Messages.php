<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\User;

class Messages extends Model
{
    protected $fillable = ['from', 'to', 'message'];

    public function fromContact()
    {
        return $this->hasOne(User::class, 'id', 'from');
    }
}
