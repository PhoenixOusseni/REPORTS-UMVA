<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class RapportGroupe extends Model
{
    protected $table = 'rapport_groupes';

    protected $fillable = [
        'groupe_id',
        'user_id', // KA qui crée le rapport
        'file',
        'date_rapport',
    ];

    protected $casts = [
        'date_rapport' => 'datetime',
    ];

    /**
     * Relation: Le rapport appartient à un groupe
     */
    public function groupe()
    {
        return $this->belongsTo(Groupe::class, 'groupe_id');
    }

    /**
     * Relation: Le rapport appartient à un user (KA)
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
