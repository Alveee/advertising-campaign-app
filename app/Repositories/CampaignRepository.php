<?php

namespace App\Repositories;

use App\Models\Campaign;

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

    public function getCampaigns()
    {
        return $this->campaign->all();
    }

    /**
     * Create a new campaign
     *
     * @param  array    $data
     * @return array
     */
    public function store(array $data): array
    {
        return $this->campaign->query()->create([
            'name' => $data['name'],
            'start_date' => $data['start_date'],
            'end_date' => $data['end_date'],
            'total_budget' => $data['total_budget'],
            'daily_budget' => $data['daily_budget'],
            'creative_upload' => $data['creative_upload']
        ])->toArray();
    }
}
