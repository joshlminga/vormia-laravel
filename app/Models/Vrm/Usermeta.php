<?php

namespace App\Models\Vrm;

use App\Models\Vrm\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Usermeta extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'user_id',
        'meta_key',
        'meta_value',
    ];

    /**
     * Todo: Users
     * ? One or more meta values can be related to a single user
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
