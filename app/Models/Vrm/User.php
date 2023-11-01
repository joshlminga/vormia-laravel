<?php

namespace App\Models\Vrm;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

// Models
use App\Models\Vrm\Term;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;


    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'level',
        'phone',
        'username',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    /**
     * Todo:: This will automatically call Terms and add slug
     * @return void
     */
    protected static function boot()
    {
        parent::boot();

        static::created(function ($user) {
            $terms = new Term();
            // Check if already exists
            $exist = Term::where([['table', '=', 'users'], ['related_id', '=', $user->id]])->first();
            if ($exist) return;
            // Create Terms
            $terms->create([
                "table" => "users",
                "type" => null,
                "related_id" => $user->id,
                "slug" => $terms->slug($user->username),
                "flag" => 1,
            ]);
        });
    }

    /**
     * Todo:: method to get usermetas
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function usermetas(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany(\App\Models\Vrm\Usermeta::class, 'user_id', 'id');
    }

    /**
     * Todo:: method to save user Metadata
     * @param integer $userId
     * @param array $data
     * @return bool
     */
    public static function save_usermeta(int $userId, array $data): bool
    {
        /**
         * Loop through the data
         * key should be the meta_key
         * value should be the meta_value
         */
        foreach ($data as $key => $value) {
            if (!is_null($key)) {
                // Save
                \App\Models\Vrm\Usermeta::create([
                    'user_id' => $userId,
                    'meta_key' => $key,
                    'meta_value' => $value,
                ]);
            }
        }

        return true;
    }

    /**
     * Todo:: method to update user Metadata
     * @param integer $userId
     * @param array $data
     * @return bool
     */
    public static function update_usermeta(int $userId, array $data): bool
    {
        /**
         * Loop through the data
         * key should be the meta_key
         * value should be the meta_value
         */
        foreach ($data as $key => $value) {

            \App\Models\Vrm\Usermeta::where('user_id', $userId)
                ->where('meta_key', $key)
                ->update([
                    'meta_value' => $value,
                ]);
        }

        return true;
    }

    /**
     * Todo:: method retrive usermeta
     * ? Pass the usermeta as a Collection
     * ? Loop and get the metakey, set is as parent array key
     * ? If specific key is being asked return that only
     *
     * @param any $usermeta
     * @param string|null $key
     *
     */
    public static function get_usermeta($usermeta, string $key = null)
    {
        // Check if is laravel Collection
        if (!is_a($usermeta, 'Illuminate\Database\Eloquent\Collection')) {
            return $usermeta;
        }

        // Loop
        $meta = [];
        foreach ($usermeta as $index => $this_meta) {
            $meta[$this_meta->meta_key] = $this_meta->meta_value;
        }

        // If key is not null
        if (!is_null($key) && !array_key_exists($key, $meta)) return null;

        // Return
        return is_null($key) ? (object) $meta : $meta[$key];
    }
}
