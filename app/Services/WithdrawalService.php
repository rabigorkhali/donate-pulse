<?php

namespace App\Services;

use App\Models\Campaign;
use App\Models\PaymentGateway;
use App\Models\User;
use App\Models\CampaignView;
use App\Models\Withdrawal;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\Session;

class WithdrawalService extends Service
{
    public function __construct(Withdrawal $model)
    {
        parent::__construct($model);
    }

    public function getAllData($data, $selectedColumns = [], $pagination = true)
    {
        $keyword = $data->get('mobile_number');
        $withdrawalStatus = $data->get('withdrawal_status');
        $show = $data->get('show');
        $fromDate = $data->get('from_date');
        $toDate = $data->get('to_date');
        $query = $this->query();
        if (count($selectedColumns) > 0) {
            $query->select($selectedColumns);
        }
        $table = $this->model->getTable();
        if ($keyword) {
            if (Schema::hasColumn($table, 'withdrawal_mobile_number')) {
                $query->WhereRaw('LOWER(withdrawal_mobile_number) LIKE ?', ['%' . strtolower($keyword) . '%']);
            }
        }
        if (authUser() == 'public-user') $query->where('user_id', authUser()->id);
        if ($withdrawalStatus) $query->where('withdrawal_status', $withdrawalStatus);
        if ($fromDate) $query->where('created_at', '>', $fromDate);
        if ($toDate) $query->where('created_at', '<', $toDate);
        if ($pagination) {
            return $query->orderBy('created_at', 'DESC')->paginate($show ?? 10);
        } else {
            return $query->orderBy('created_at', 'DESC')->get();
        }
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
            'paymentGateways' => PaymentGateway::where('user_id', authUser()->id)->orderby('payment_gateway')->get(),
            'campaigns' => Campaign::where('campaign_status', 'completed')->where('user_id', authUser()->id)->orderby('title')->get()
        ];
    }

    public function store($request)
    {
        try {
            $data = $request->only('campaign_id', 'payment_gateway_id');
            $campaignId = $request->get('campaign_id');
            $alreadyInwithdrawal = Withdrawal::where('campaign_id', $campaignId)->wherein('campaign_id', permittedCampaigns())->first();
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
            return $this->model->create($data);
        } catch (\Throwable $throwable) {
            $message['error'] = 'Server error.';
            return $message;
        }
    }

    public function editPageData($request, $id)
    {
        try {
            return [
                'thisData' => $this->itemByIdentifier($id),
                'users' => User::orderby('name')->get(),
                'paymentGateways' => PaymentGateway::where('user_id', authUser()->id)->orderby('payment_gateway')->get(),
            ];
        } catch (\Throwable $throwable) {
            $message['error'] = 'Server error.';
            return $message;
        }
    }

    public function update($request, $id)
    {
        $data = $request->except('_token', 'campaign_id', 'withdrawal_status');
        if (authUser()->role->name !== 'public-user') {
            $data = $request->except('_token', 'campaign_id', 'payment_gateway_id', '');
        }

        $update = $this->itemByIdentifier($id);
        if ($update->withdrawal_status !== 'pending') {
            $message['error'] = 'Only pending withdrawal can be updated';
            return $message;
        }
        $imagePath = $update->receipt ?? null;

        if ($request->hasFile('receipt')) {
            if ($imagePath && file_exists(public_path($imagePath))) {
                removeImage($imagePath);
            }
            $data['receipt'] = $this->fullImageUploadPath . uploadImage($this->fullImageUploadPath, 'receipt', true, 300, null);
        }
        $update->fill($data)->save();
        $update = $this->itemByIdentifier($id);
        return $update;
    }

    public function delete($request, $id)
    {
        $item = $this->model->where('user_id', authUser()->id)->findOrFail($id);
        if ($item->withdrawal_status !== 'pending') {
            $message['error'] = 'Only pending status can be deleted.';
            return $message;
        }
        return $item->delete();
    }
}
