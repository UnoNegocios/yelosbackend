<?php

namespace App\Http\Controllers\api\v2\shopping;
use App\Actions\Shoppings\MarkShoppingAsReceivedAction;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class MarkShoppingAsReceived extends Controller
{
    public function __invoke(Request $request, MarkShoppingAsReceivedAction $markShoppingAsReceivedAction)
    {
        return $markShoppingAsReceivedAction->excecute($request);
    }

}