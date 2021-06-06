<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PollOpen extends Model
{
    protected $table = 'polls_periods';

    protected $fillable = [
        'start', 'end', 'poll_id', 'status'
    ];

    protected $hidden = [
        'created_at', 'updated_at',
    ];

    public function Poll()
    {
        return $this->hasMany('App\Poll');
    }

}
