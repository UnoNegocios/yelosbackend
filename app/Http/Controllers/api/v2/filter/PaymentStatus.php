<?php

namespace App\Http\Controllers\api\v2\filter;

use Illuminate\Http\Request;
use Spatie\QueryBuilder\Filters\Filter;
use Illuminate\Database\Eloquent\Builder;
use App\Models\Quotation;

class PaymentStatus implements Filter
{
    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function __invoke(Builder $query, $value, string $property) : Builder
    {
        
        return $query->where('type', $value);
    }
}
