<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class CampaignController extends Controller
{
    /**
     * Campaign list view.
     *
     * @return Application|Factory|View
     */
    public function index()
    {
        return view('campaigns.list');
    }

    /**
     * Create Campaign view.
     *
     * @return Application|Factory|View
     */
    public function create()
    {
        return view('campaigns.create');
    }

    /**
     * Update Campaign view.
     *
     * @param int $campaign_id Campaign ID
     * @return Application|Factory|View
     */
    public function edit(int $campaign_id)
    {
        return view('campaigns.edit', compact('campaign_id'));
    }
}
