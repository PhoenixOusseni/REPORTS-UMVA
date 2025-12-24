<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'umva_id',
        'nom',
        'prenom',
        'password',
        'role_id',
        'supervisor_id',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var list<string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Relation: L'utilisateur appartient à un rôle
     */
    public function role()
    {
        return $this->belongsTo(Role::class, 'role_id');
    }

    /**
     * Relation: Un user KA peut avoir plusieurs groupes
     */
    public function groupes()
    {
        return $this->hasMany(Groupe::class);
    }

    /**
     * Relation: Un user peut créer plusieurs rapports (RapportGroupe, RapportKa, etc.)
     */
    public function rapportsGroupe()
    {
        return $this->hasMany(RapportGroupe::class);
    }

    public function rapportsKa()
    {
        return $this->hasMany(RapportKa::class);
    }

    public function rapportsMa()
    {
        return $this->hasMany(RapportMa::class);
    }

    public function rapportsFp()
    {
        return $this->hasMany(RapportFp::class);
    }

    /**
     * Relation hiérarchique: Un user MA supervise plusieurs users KA
     * Un user KA a un supervisor (MA)
     */
    public function supervisor()
    {
        return $this->belongsTo(User::class, 'supervisor_id');
    }

    public function subordinates()
    {
        return $this->hasMany(User::class, 'supervisor_id');
    }

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
        ];
    }
}
