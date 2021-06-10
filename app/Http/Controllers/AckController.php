<?php

namespace App\Http\Controllers;

use App\Http\Resources\LatestAckResource;
use App\Models\Ack;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class AckController extends Controller
{
    /**
     * @param Request $request
     * @return mixed
     */
    public function requestAck(Request $request)
    {
        return Ack::create(['ip' => $request->ip()]);
    }

    /**
     * @param Request $request
     * @return JsonResponse
     */
    public function resetAck(Request $request): JsonResponse
    {
        Ack::truncate();
        Ack::create(['ip' => $request->ip()]);
        return response()->json(['success' => true]);
    }

    /**
     * @return LatestAckResource
     */
    public function getLatestAck(): LatestAckResource
    {
        return new LatestAckResource(Ack::orderBy('created_at', 'desc')->get()->first());
    }
}
