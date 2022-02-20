<?php

namespace App\Services;

use App\Http\Requests\CreateCampaignRequest;
use App\Http\Requests\UpdateCampaignRequest;
use App\Repositories\CampaignRepository;
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
     * Get all campaigns
     *
     * @return Campaign[]
     */
    public function getAll()
    {
        return $this->campaignRepository->getCampaigns();
    }

    /**
     * Get a campaign
     *
     * @param  int $id
     * @return array
     */
    public function get($id)
    {
        return $this->campaignRepository->get($id)->toArray();
    }

    /**
     * Upload images & store campaign data
     *
     * @param CreateCampaignRequest $request
     * @return array
     */
    public function storeData(CreateCampaignRequest $request): array
    {
        $creative_upload = $this->uploadImage($request->file('creative_upload'));
        $data = [...$request->all(), 'creative_upload' => $creative_upload];
        return $this->campaignRepository->store($data);
    }

    /**
     * update campaign data
     *
     * @param  UpdateCampaignRequest $request
     * @param  integer               $id
     * @return array
     */
    public function updateData(UpdateCampaignRequest $request, int $id): array
    {
        $campaign = $this->campaignRepository->get($id);
        if ($files = $request->file('creative_upload')) {
            $creative_upload = $this->uploadImage($files);
        } else {
            $creative_upload = $campaign->creative_upload;
        }
        $data = [...$request->all(), 'creative_upload' => $creative_upload];
        $updated_campaign = $this->campaignRepository->update($data, $id);
        if (empty($updated_campaign)) {
            $old_creative_upload = $campaign->creative_upload;
            $this->deleteImage($old_creative_upload);
        }
        return $updated_campaign;
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
                'path' => Storage::url('campaigns/' . $name)
            ];
        }
        return $uploaded_creatives;
    }

    /**
     * Delete images from storage
     *
     * @param  array $campaign_creatives
     * @return void
     */
    private function deleteImage(array $campaign_creatives): void
    {
        foreach ($campaign_creatives as $value) {
            Storage::delete('campaigns/' . $value['file_name']);
        }
    }
}
