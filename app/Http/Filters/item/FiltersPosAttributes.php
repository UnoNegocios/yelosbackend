<?php

namespace App\Http\Filters\item;

use Spatie\QueryBuilder\Filters\Filter;
use Illuminate\Database\Eloquent\Builder;

Class FiltersPosAttributes implements Filter
{
    public function __invoke(Builder $query, $value, string $property): Builder
    {
       return $query->select('items.*')
          ->where('name', 'LIKE', '%' . $value . '%')
          ->orWhere('code_one', 'LIKE', '%' . $value . '%')
          ->orWhere('code_two', 'LIKE', '%' . $value . '%')
          ->orWhere('code_three', 'LIKE', '%' . $value . '%')
          ->orWhere('sat_key_code', 'LIKE', '%' . $value . '%');
    }
}