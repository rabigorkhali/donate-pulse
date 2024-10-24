<?php

namespace App\Services;

use App\Models\Page;
use App\Models\PaymentGateway;
use App\Models\Role;
use App\Models\User;
use Illuminate\Support\Facades\Schema;

class PaymentGatewayService extends Service
{
    public function __construct(PaymentGateway $model)
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
        $keyword = $data->get('keyword');
        $show = $data->get('show');
        $userId = $data->get('user_id');
        $query = $this->query();
        if (count($selectedColumns) > 0) {
            $query->select($selectedColumns);
        }
        $table = $this->model->getTable();
        if ($keyword) {
            if (Schema::hasColumn($table, 'mobile_number')) {
                $query->whereRaw('LOWER(mobile_number) LIKE ?', ['%' . strtolower($keyword) . '%']);
            }
        }
        if ($userId) {
            $query->where('user_id', $userId);
        }
        if(authUser()->role->name=='public-user') $query->where('user_id',authUser()->id);
        if ($pagination) {
            return $query->orderBy('created_at', 'DESC')->paginate($show ?? 10);
        } else {
            return $query->orderBy('created_at', 'DESC')->get();
        }
    }

    public function createPageData($request)
    {
        return [
            'users' => User::orderby('name')->get(),
        ];
    }

    public function store($request)
    {
        $data = $request->except('_token');
        $userId = $data['user_id'] ?? authUser()->id;
        if(authUser()->role->name=='public-user') $userId=authUser()->id;
        $data['user_id']=$userId;
        $countPaymentGateway = PaymentGateway::where('user_id', $userId)->count();
        if ($countPaymentGateway > 2) {
            $message['error'] = 'You cannot add more than 3 active payment gateways. Please delete anyone before adding new one.';
            return $message;
        }
        return $this->model->create($data);
    }

    public function editPageData($request, $id)
    {
        return [
            'users' => User::orderby('name')->get(),
            'thisData' => $this->itemByIdentifier($id),
        ];
    }
}
