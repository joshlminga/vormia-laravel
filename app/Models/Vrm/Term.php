<?php

namespace App\Models\Vrm;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use Illuminate\Support\Str;

class Term extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'table',
        'type',
        'related_id',
        'slug',
    ];

    /**
     * Todo: When selecting a term, also select the related model
     */
    public function hierarchy()
    {
        return $this->belongsTo(Hierarchy::class, 'related_id');
    }

    /**
     * Todo: Check Slug
     * ? Check if slug exists
     * ? Return false or term id if exits
     * @param string $slug
     *
     */
    public static function checkSlug(string $slug)
    {
        $term = Term::where('slug', $slug)->first();
        if ($term) {
            return $term->id;
        }
        return false;
    }

    /**
     * Todo: Generate Slug
     * ? Pass string to slugify limit to 200 characters
     * ? If turn is true then append number to slug
     * ? Check if slug exists
     * ? If exists, append number to slug
     * ? Return slug
     *
     * @param string $string
     * @param int $id default null - article ID
     * @param bool $turn
     *
     * @return string
     */
    public static function slug(string $string, int $id = null, $turn = false): string
    {
        $string = Str::limit($string, 200); // Length

        // Turn
        if ($turn) {
            // Generate random string from character - abcdefghijklmnpqrstuvwxyz123456789
            $string = (!is_null($id) || $id != 0) ? $string . '-' . $id : $string . '-' . Str::random(5);
        }

        // Generate Slug
        $slug = Str::slug($string);
        $slug_status = self::checkSlug($slug);
        if ($slug_status) {
            self::checkSlug($slug, $id, true);
        }

        // Return
        return $slug;
    }

    /**
     * Todo: Get Slug
     * ? 1: Pass array of search terms
     * 
     * @param array $search
     */
    public static function getSlug(array $search)
    {
        $query = Term::query();

        foreach ($search as $column => $value) {
            if ($value) {
                $query->where($column, $value);
            }
        }

        // Return column slug
        return $query->first()->slug;
    }
}
