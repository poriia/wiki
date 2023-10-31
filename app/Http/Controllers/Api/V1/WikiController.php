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

    public function findById(Wiki $id)
    {
        $wiki = Wiki::find($id)->first();
        if (! $wiki) {
            return ApiResponse::failureResponse()->setMessage('Wiki not found')->render();
        }

        $relatedWikis = $this->findRelatedWikis($wiki->content);
        $wiki = [
            'id' => $wiki->id,
            'title' => $wiki->title,
            'content' => $wiki->content,
            'related' => $relatedWikis,
        ];

        return ApiResponse::successResponse()->setMessage('Wiki was found')->setResponseValue($wiki)->render();
    }

    private function findRelatedWikis($content)
    {
        $keywords = explode(' ', $content);
        $relatedWikis = [];

        foreach ($keywords as $key => $keyword) {
            $wikis = Wiki::where('content', 'like', '%'.$keyword.'%')->get();
            foreach ($wikis as $wiki) {
                if (! isset($relatedWikis[$key])) {
                    $relatedWikis[$key] = $wiki->id;
                }
            }
        }
        
        return $relatedWikis;
    }
}
