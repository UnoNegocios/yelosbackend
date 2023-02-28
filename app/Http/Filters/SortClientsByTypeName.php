<?php

namespace App\Http\Filters;

use App\Models\Type;
use App\Models\Company;
use Spatie\QueryBuilder\Sorts\Sort;
use Illuminate\Database\Eloquent\Builder;

class SortClientsByTypeName implements Sort
{
    public function __invoke(Builder $query, bool $descending, string $property)
    {
        $direction = $descending ? 'DESC' : 'ASC';

        $query->orderBy(
            Category::select('name')
                ->whereColumn('types.id', 'companies.id')
                ->where('types.name', 'App\Models\Company'),
            $direction
        );
    }
}