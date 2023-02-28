<?php

namespace App\Http\Filters;
use Spatie\QueryBuilder\QueryBuilder;
use Spatie\QueryBuilder\Sorts\Sort;
use App\Models\Company;
use Illuminate\Database\Eloquent\Builder;

class CompanyName implements \Spatie\QueryBuilder\Sorts\Sort
{
    public function __invoke(Builder $query, bool $descending, string $property)
    {
        $direction = $descending ? 'DESC' : 'ASC';
        $perro = Company::findOrFail($property)->name;
        $query->orderByRaw("{$perro} {$direction}");
    }
}