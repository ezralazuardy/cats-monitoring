<?php

namespace App\Http\Controllers;

use App\Http\Requests\AddDetectionRequest;
use App\Http\Resources\DetectionsResource;
use App\Models\Ack;
use App\Models\Detection;
use Exception;
use Illuminate\Http\JsonResponse;
use Yajra\DataTables\DataTables;

class DetectionController extends Controller
{
    /**
     * @var DataTables
     */
    private DataTables $datatables;

    /**
     * DetectionController constructor.
     * @param DataTables $datatables
     */
    public function __construct(DataTables $datatables)
    {
        $this->datatables = $datatables;
    }

    /**
     * @param AddDetectionRequest $request
     * @return mixed
     */
    public function addDetection(AddDetectionRequest $request)
    {
        Ack::create(['ip' => $request->ip()]);
        return Detection::create(['ip' => $request->ip(), 'temperature' => $request->temperature]);
    }

    /**
     * @return JsonResponse
     */
    public function resetDetection(): JsonResponse
    {
        Detection::truncate();
        return response()->json(['success' => true]);
    }

    /**
     * @return mixed
     * @throws Exception
     */
    public function getDetectionsDataTableFormatted()
    {
        return $this->datatables->of(DetectionsResource::collection(Detection::all()))->toJson();
    }
}
