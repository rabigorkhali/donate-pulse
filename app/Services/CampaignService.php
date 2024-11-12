<?php

namespace App\Services;

use App\Models\Campaign;
use App\Models\CampaignCategory;
use App\Models\CampaignView;
use App\Models\PostCategory;
use App\Models\Role;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Schema;

class CampaignService extends Service
{
    public function __construct(Campaign $model)
    {
        parent::__construct($model);
    }

    public function getAllData($data, $selectedColumns = [], $pagination = true)
    {
        $keyword = $data->get('keyword');
        $show = $data->get('show');
        $query = $this->query();
        if (count($selectedColumns) > 0) {
            $query->select($selectedColumns);
        }
        $table = $this->model->getTable();
        if ($keyword) {
            if (Schema::hasColumn($table, 'name')) {
                $query->orWhereRaw('LOWER(name) LIKE ?', ['%' . strtolower($keyword) . '%']);
            }
            if (Schema::hasColumn($table, 'title')) {
                $query->orWhereRaw('LOWER(title) LIKE ?', ['%' . strtolower($keyword) . '%']);
            }
        }
        if (authUser()->role->name == 'public-user') $query->where('user_id', authUser()->id);

        if ($pagination) {
            return $query->orderBy('created_at', 'DESC')->paginate($show ?? 10);
        } else {
            return $query->orderBy('created_at', 'DESC')->get();
        }
    }

    public function createPageData($request)
    {
        return [
            'users' => User::orderby('name', 'asc')->get(),
            'campaignCategories' => CampaignCategory::orderby('title', 'asc')->get(),
        ];
    }

    public function store($request)
    {
        $data = $request->except('_token');

        if ($request->file('cover_image')) {
            $data['cover_image'] = $this->fullImageUploadPath . uploadImage($this->fullImageUploadPath, 'cover_image', true, 300, null);
        }
        if (authUser()->role->name == 'public-user') $data['user_id'] = authUser()->id;
        if (authUser()->role->name == 'public-user') $data['campaign_status'] = 'pending';
        return $this->model->create($data);
    }

    public function update($request, $id)
    {
        $data = $request->except('_token');
        $update = $this->itemByIdentifier($id);
        if ($update->campaign_status !== 'pending' && authUser()->role->name == 'public-user') {
            $message['error'] = 'Only campaign with pending status can be updated';
            return $message;
        }
        $coverImage = $update->cover_image ?? null;
        if ($request->hasFile('cover_image')) {
            if ($coverImage && file_exists(public_path($coverImage))) {
                removeImage($coverImage);
            }
            $data['cover_image'] = $this->fullImageUploadPath . uploadImage($this->fullImageUploadPath, 'cover_image', true, 300, null);
        }
        if (authUser()->role->name == 'public-user') $data['user_id'] = authUser()->id;
        if (authUser()->role->name == 'public-user') $data['campaign_status'] = 'pending';
        $update->fill($data)->save();
        $update = $this->itemByIdentifier($id);

        return $update;
    }

    public function editPageData($request, $id)
    {
        return [
            'users' => User::orderby('name', 'asc')->get(),
            'campaignCategories' => CampaignCategory::orderby('title', 'asc')->get(),
            'thisData' => $this->itemByIdentifier($id),
        ];
    }

    public function campaignSummary(Request $request, $id)
    {
        try {
            $data = [];
            if (authUser()->role->name !== 'public-user') {
                $campaignData = CampaignView::select('start_date', 'end_date', 'cover_image', 'goal_amount', 'summary_total_collection', 'net_amount_collection', 'summary_service_charge_amount', 'total_number_donation', 'campaign_status')
                    ->where('id', $id)->first();
            } else {
                $campaignData = CampaignView::select('start_date', 'end_date', 'cover_image', 'goal_amount', 'summary_total_collection', 'net_amount_collection', 'summary_service_charge_amount', 'total_number_donation', 'campaign_status')
                    ->where('user_id', authUser()->id)->where('id', $id)->first();
            }
            if (!$campaignData) {
                return false;
            }
            $campaignData->summary_total_collection = priceToNprFormat($campaignData->summary_total_collection);
            $campaignData->net_amount_collection = priceToNprFormat($campaignData->net_amount_collection);
            $campaignData->summary_service_charge_amount = priceToNprFormat($campaignData->summary_service_charge_amount);
            $campaignData->goal_amount = priceToNprFormat($campaignData->goal_amount);
            $campaignData->start_date = $campaignData->start_date;
            $campaignData->start_date_format = $campaignData->start_date;
            $campaignData->end_date = $campaignData->end_date;
            $campaignData->end_date_format = $campaignData->end_date;
            $data['campaign'] = $campaignData;
            return $data;
        } catch (\Throwable $th) {
            return false;
        }
    }

}
