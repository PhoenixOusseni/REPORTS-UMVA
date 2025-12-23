<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class RapportFp extends Model
{
    protected $table = 'rapport_fps';

    protected $fillable = [
        'user_id', // FP qui crée le rapport
        'contenu',
        'date_rapport',
    ];

    protected $casts = [
        'date_rapport' => 'datetime',
    ];

    /**
     * Relation: Le rapport appartient à un user (FP)
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
