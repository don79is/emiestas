<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class VilniusList extends Model
{

    use SoftDeletes;

    protected $table = 'vilnius_lists';

    /**
     * Fillable column names
     * @var array
     */

    protected $fillable = ['gimimo_metai', 'gimimo_valstybe', 'lytis', 'seimos_padetis', 'kiek_turi_vaiku', 'seniunija', 'gatve', 'seniunnr', 'ter_rej_kodas', 'gatv_k', 'gat_id'];

    public function scopeSearch($query, $search)
    {
        return $query->where('gimimo_metai', 'like', "%$search%")
            ->orWhere('lytis', 'like', "%$search%")
            ->orWhere('gatve', 'like', "%$search%");
    }
}
