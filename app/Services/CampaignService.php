<?php

namespace App\Services;

use App\Repositories\CampaignRepository;
use Illuminate\Http\Request;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;

class CampaignService
{
    /**
     * CampaignService constructor
     *
     * @param  CampaignRepository $campaignRepository
     */
    public function __construct(protected CampaignRepository $campaignRepository)
    {
    }

    /**
     * Upload images & store campaign data
     *
     * @param  Request $request
     * @return array
     */
    public function storeData(Request $request): array
    {
        $creative_upload = $this->uploadImage($request->file('creative_upload'));
        $data = [...$request->all(), 'creative_upload' => $creative_upload];
        return $this->campaignRepository->store($data);
    }

    /**
     * Upload images in storage
     *
     * @param  UploadedFile[] $campaign_creatives
     * @return array
     */
    private function uploadImage(array $campaign_creatives): array
    {
        $uploaded_creatives = [];
        foreach ($campaign_creatives as $key => $value) {
            $name = uniqid() . '_' . $value->getClientOriginalName();
            Storage::put('campaigns/' . $name, $value->getContent());
            $uploaded_creatives[$key] = [
                'file_name' => $name,
                'path' => Storage::url($name)
            ];
        }
        return $uploaded_creatives;
    }
}
