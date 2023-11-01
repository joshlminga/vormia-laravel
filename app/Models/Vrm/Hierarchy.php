<?php

namespace App\Models\vrm;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

// Model
use App\Models\Vrm\Term;
use App\Models\Vrm\HierarchyAttributes;

class Hierarchy extends Model
{
    use HasFactory;


    protected $with = ['term'];

    protected $fillable = ['type', 'name', 'parent', 'flag'];

    /**
     * Todo: Parennt
     *
     */
    public function parentInfo()
    {
        return $this->hasOne(Self::class, 'id', 'parent');
    }
    /**
     * Todo: Relate this model to the Term Model
     *
     * ? 1 Participant can have only 1 slug from Terms
     * ? To match the two look for terms.table = 'participants' and terms.related_id = participants.id
     * ? Return the terms.slug
     */
    public function term()
    {
        return $this->hasOne(Term::class, 'related_id')->where('table', 'hierarchies');
    }

    /**
     * Todo: Add hierarchy_attributes
     *
     * ? 1 This will related table hierarchies with table hierarchy_attributes where the hierarchy_attributes.hierarchy_id is the same
     */
    public function attributes()
    {
        return $this->hasMany(HierarchyAttributes::class);
    }

    /**
     * Todo: Get Icon
     */
    public function getIcon()
    {
        return $this->hierarchyAttributes->where('name', 'icon')->first()->value ?? null;
    }
}
