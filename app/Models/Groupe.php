<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Groupe extends Model
{
    protected $fillable = [
        'nom',
        'description',
        'user_id', // KA responsable du groupe
    ];

    /**
     * Relation: Le groupe appartient à un user (KA)
     */
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    /**
     * Relation: Un groupe a plusieurs rapports
     */
    public function rapports()
    {
        return $this->hasMany(RapportGroupe::class);
    }
}
