<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class RapportKa extends Model
{
    protected $table = 'rapport_kas';

    protected $fillable = [
        'user_id', // KA qui crée le rapport
        'contenu',
        'date_rapport',
    ];

    protected $casts = [
        'date_rapport' => 'datetime',
    ];

    /**
     * Relation: Le rapport appartient à un user (KA)
     */
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
