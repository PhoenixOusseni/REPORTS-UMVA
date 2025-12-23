<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class RapportMa extends Model
{
    protected $table = 'rapport_mas';

    protected $fillable = [
        'user_id', // MA qui crée le rapport
        'contenu',
        'date_rapport',
    ];

    protected $casts = [
        'date_rapport' => 'datetime',
    ];

    /**
     * Relation: Le rapport appartient à un user (MA)
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
