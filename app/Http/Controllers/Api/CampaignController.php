<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\CreateCampaignRequest;
use App\Http\Requests\UpdateCampaignRequest;
use App\Services\CampaignService;
use App\Traits\HasApiResponse;
use Exception;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Log;

class CampaignController extends Controller
{
    use HasApiResponse;

    public function __construct(public CampaignService $campaignService)
    {
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  CreateCampaignRequest  $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(CreateCampaignRequest $request): JsonResponse
    {
        try {
            $data = $this->campaignService->storeData($request);
            return $this->successResponse($data, 'Campaign has been created successfully');
        } catch (Exception $e) {
            Log::error($e);
            return $this->errorResponse('Campaign creation has been failed', 500);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  UpdateCampaignRequest  $request
     * @param  int  $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(UpdateCampaignRequest $request, $campaign): JsonResponse
    {
        try {
            $data = $this->campaignService->updateData($request, $campaign);
            return $this->successResponse($data, 'Campaign has been updated successfully');
        } catch (ModelNotFoundException $e) {
            return $this->errorResponse('Campaign not found', 404);
        } catch (Exception $e) {
            Log::error($e);
            return $this->errorResponse('Campaign update has been failed', 500);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
