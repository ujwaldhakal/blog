<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Sofa\Eloquence\Eloquence;

class Ai extends Model
{
    use Eloquence;

    protected $table = 'action_gist';
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'question', 'action_to_do'
    ];


    public function scopeWhatToDo($q, $botResponse)
    {
        return $q->where('question', 'LIKE', '%' . $botResponse . '%');
    }

    public function getAction()
    {
        return $this->action_to_do;
    }

    public function getQuestion()
    {
        return $this->question;
    }
}
