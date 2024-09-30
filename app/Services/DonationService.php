<?php

namespace App\Services;

use App\Models\Donation;
use App\Models\Page;
use App\Models\Role;
use App\Models\User;
use Illuminate\Support\Facades\Schema;

class DonationService extends Service
{
    public function __construct(Donation $model)
    {
        parent::__construct($model);
    }

    public function indexPageData($request)
    {
        return [
            'users' => User::get(),
            'thisDatas' => $this->getAllData($request),
        ];
    }

    public function getAllData($data, $selectedColumns = [], $pagination = true)
    {
        dump($data->all());
        $keyword = $data->get('keyword');
        $donorUserId = $data->get('donor_user_id');
        $receiverUserId = $data->get('receiver_user_id');
        $paymentGateway = $data->get('payment_gateway');
        $fromDate = $data->get('from_date');
        $toDate = $data->get('to_date');
        $show = $data->get('show');
        $query = $this->query();
        if (count($selectedColumns) > 0) {
            $query->select($selectedColumns);
        }
        $table = $this->model->getTable();
        if ($donorUserId) $query->where('giver_user_id', $donorUserId);
        if ($receiverUserId) $query->where('receiver_user_id', $receiverUserId);
        if ($paymentGateway) $query->where('payment_gateway', $paymentGateway);
        if ($fromDate) $query->where('created_at','>', $fromDate);
        if ($toDate) $query->where('created_at','<', $toDate);

        if ($keyword) {
            $query->where('mobile_number', $keyword);
        }
        if ($pagination) {
            return $query->orderBy('created_at', 'DESC')->paginate($show ?? 10);
        } else {
            return $query->orderBy('created_at', 'DESC')->get();
        }
    }

}
