<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Requests\WikiStoreRequest;
use App\Models\Wiki;
use Illuminate\Http\Response;
use Mojtabarks\ApiResponse\ApiResponse;

class WikiController extends BaseApiController
{
    public function store(WikiStoreRequest $request)
    {
        $wiki = Wiki::create($request->validated());

        if (!$wiki) {
            return ApiResponse::failureResponse()->setMessage('Wiki not created')->render();
        }
        return ApiResponse::successResponse()->setMessage('Wiki was created')->render();
    }
}
