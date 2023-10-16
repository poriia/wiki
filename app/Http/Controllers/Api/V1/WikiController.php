<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Requests\WikiSearchRequest;
use App\Http\Requests\WikiStoreRequest;
use App\Models\Wiki;
use Mojtabarks\ApiResponse\ApiResponse;

class WikiController extends BaseApiController
{
    public function store(WikiStoreRequest $request)
    {
        $wiki = Wiki::create($request->validated());

        if (! $wiki) {
            return ApiResponse::failureResponse()->setMessage('Wiki not created')->render();
        }

        return ApiResponse::successResponse()->setMessage('Wiki was created')->render();
    }

    public function search(WikiSearchRequest $request)
    {
        $search = $request->search;
        $wiki = Wiki::where('title', 'like', "%{$search}%")
            ->orWhere('content', 'like', "%{$search}%")
            ->get();

        if (! $wiki) {
            return ApiResponse::failureResponse()->setMessage('Wiki not found')->render();
        }

        return ApiResponse::successResponse()->setMessage('Wiki was found')->setResponseValue($wiki)->render();
    }
}
