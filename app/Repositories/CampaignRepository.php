<?php

namespace App\Repositories;

use App\Models\Campaign;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class CampaignRepository
{
    /**
     * Assigned model for this repository.
     *
     * @var Campaign
     */
    protected Campaign $campaign;

    /**
     * CampaignRepository constructor
     *
     * @param  Campaign  $campaign
     * @return void
     */
    public function __construct(Campaign $campaign)
    {
        $this->campaign = $campaign;
    }

    /**
     * Get all campaings
     *
     * @return Campaign[]
     */
    public function getCampaigns()
    {
        return $this->campaign->all()->toArray();
    }

    /**
     * Get campaign by id
     *
     * @param  integer  $id
     * @return Campaign
     * @throws ModelNotFoundException
     */
    public function get(int $id): Campaign
    {
        return $this->campaign->query()->findOrFail($id);
    }

    /**
     * Create a new campaign
     *
     * @param  array    $data
     * @return array
     */
    public function store(array $data): array
    {
        return $this->campaign->query()->create(
            $this->prepareData($data)
        )->toArray();
    }

    /**
     * Update campaign
     *
     * @param  array  $data
     * @param  [type] $id
     * @return array
     */
    public function update(array $data, $id): array
    {
        $campaign_model = $this->get($id);
        $data = $this->prepareData($data);
        foreach ($data as $index => $value) {
            $campaign_model->{$index} = $value;
        }
        $campaign_model->save();
        return $campaign_model->toArray();
    }

    private function prepareData($data): array
    {
        return [
            'name' => $data['name'],
            'start_date' => $data['start_date'],
            'end_date' => $data['end_date'],
            'total_budget' => $data['total_budget'],
            'daily_budget' => $data['daily_budget'],
            'creative_upload' => $data['creative_upload']
        ];
    }
}
