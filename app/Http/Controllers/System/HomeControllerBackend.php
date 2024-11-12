<?php

namespace App\Http\Controllers\System;

use App\Http\Controllers\Controller;
use App\Models\Campaign;
use App\Models\CampaignView;
use App\Models\CampaignVisit;
use App\Models\Donation;
use Illuminate\Http\Request;
use DB;

class HomeControllerBackend extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index(Request $request)
    {
        $data = array();
        $campaignQuery = new Campaign();
        if (authUser()->role->name == 'public-user') {
            $campaignQuery = $campaignQuery->where('user_id', authUser()->id);
        }
        $data['total_campaign'] = $campaignQuery->count();

        $totalCollectionQuery = new CampaignView();
        if (authUser()->role->name == 'public-user') {
            $totalCollectionQuery = $totalCollectionQuery->where('user_id', authUser()->id);
        }
        $data['total_collection'] = $totalCollectionQuery->sum('summary_total_collection');

        $netCollectionQuery = new CampaignView();
        if (authUser()->role->name == 'public-user') {
            $netCollectionQuery = $netCollectionQuery->where('user_id', authUser()->id);
        }
        $data['net_collection'] = $netCollectionQuery->sum('net_amount_collection');

        $totalDonationQuery = new Donation();
        if (authUser()->role->name == 'public-user') {
            $totalDonationQuery = $totalDonationQuery->where('giver_user_id', authUser()->id);
        }
        $data['total_donation_made'] = $totalDonationQuery->whereIn('payment_status', ['completed'])->sum('amount');

        $campaignIdQuery = new Campaign();
        if (authUser()->role->name == 'public-user') {
            $campaignIdQuery = $campaignIdQuery->where('user_id', authUser()->id);
        }
        $dataRelatedIds = $campaignIdQuery->pluck('id')->toArray();
        $uniqueCoordinates = CampaignVisit::whereIn('campaign_id', $dataRelatedIds)
            ->groupBy('latitude', 'longitude')
            ->select('latitude', 'longitude')
            ->get();
        $locationArray = [];
        foreach ($uniqueCoordinates as $key => $uniqueCoordinatesDatum) {
            $locationArrayDatum = [];
            if ($uniqueCoordinatesDatum->latitude) {
                $locationArrayDatum['latitude'] = $uniqueCoordinatesDatum->latitude;
                $locationArrayDatum['longitude'] = $uniqueCoordinatesDatum->longitude;
                array_push($locationArray, $locationArrayDatum);
            }
        }
        $data['locationArray'] = json_encode($locationArray);
        return view('backend.system.dashboard', $data);
    }
}
