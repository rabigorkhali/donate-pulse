<?php

namespace App\Services;

use App\Models\Campaign;
use App\Models\PaymentGateway;
use App\Models\User;
use App\Models\CampaignView;
use App\Models\Withdrawal;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;

class WithdrawalService extends Service
{
    public function __construct(Withdrawal $model)
    {
        parent::__construct($model);
    }

    public function indexPageData($request)
    {
        return [
            'users' => User::orderby('name')->get(),
            'thisDatas' => $this->getAllData($request),
        ];
    }

    public function createPageData($request)
    {
        return [
            'users' => User::orderby('name')->get(),
            'paymentGateways' => PaymentGateway::orderby('payment_gateway')->get(),
            'campaigns' => Campaign::orderby('title')->get()
        ];
    }

    public function store($request)
    {
        try {
            $data = $request->only('campaign_id', 'payment_gateway_id');
            $campaignId = $request->get('campaign_id');
            $alreadyInwithdrawal = Withdrawal::where('campaign_id', $campaignId)->first();
            if ($alreadyInwithdrawal) {
                $message['error'] = 'Withdrawal already exists for this campaign.';
                return $message;
            }

            $campaignData = CampaignView::where('campaign_status', 'completed')->where('user_id', authUser()->id)->first();
            if (!$campaignData) {
                $message['error'] = 'This campaign is not eligible for withdrawing';
                return $message;
            }
            $paymentGateways = PaymentGateway::where('user_id', authUser()->id)->where('id', $data['payment_gateway_id'])->first();
            if (!$paymentGateways) {
                $message['error'] = 'Invalid payment gateway.';
                return $message;
            }

            $data['withdrawal_mobile_number'] = $paymentGateways->mobile_number;
            $data['created_at'] = date('Y-m-d H:i:s');
            $data['withdrawal_status'] = 'pending';
            $data['user_id'] = authUser()->id;

            $data['withdrawal_amount'] = $campaignData->net_amount_collection;
            $data['withdrawal_service_charge'] = $campaignData->summary_service_charge_amount;
            DB::beginTransaction();
            $this->model->create($data);
            DB::commit();
            return true;
        } catch (\Throwable $throwable) {
            $message['error'] = 'Server error.';
            return $message;
        }
    }

    public function delete($request, $id)
    {
        $item = $this->itemByIdentifier($id);
        if ($item->withdrawal_status !== 'pending') {
            $message['error'] = 'Only pending status can be deleted.';
            return $message;
        }
        return $item->delete();
    }
}
