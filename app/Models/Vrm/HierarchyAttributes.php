<?php

namespace App\Models\vrm;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HierarchyAttributes extends Model
{
    use HasFactory;

    protected $fillable = ['hierarchy_id', 'name', 'value'];

    /**
     * Todo: Add hierarchies
     *
     * ? 1 This will related with table hierarchies
     */
    public function hierarchy()
    {
        return $this->belongsTo(Hierarchy::class);
    }
}
