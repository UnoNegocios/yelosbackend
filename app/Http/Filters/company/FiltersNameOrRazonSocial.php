<?php

namespace App\Http\Filters\company;

use Spatie\QueryBuilder\Filters\Filter;
use Illuminate\Database\Eloquent\Builder;

Class FiltersNameOrRazonSocial implements Filter
{
    public function __invoke(Builder $query, $value, string $property): Builder
    {
       return $query->select('companies.*')
          ->where('name', 'LIKE', '%' . $value . '%')
          ->orWhere('razon_social', 'LIKE', '%' . $value . '%');
    }
}