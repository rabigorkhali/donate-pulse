<?php

namespace App\Services;

use App\Models\Role;

class RoleService extends Service
{
    public function __construct(Role $model)
    {
        parent::__construct($model);
    }

    public function indexPageData($request)
    {
        return [
            'thisDatas' => $this->getAllData($request),
        ];
    }

    public function store($request)
    {
        $data = $request->except('_token');
        $data['permissions'] = $this->mapPermission($request->permissions);
        return $this->model->create($data);
    }

    public function update($request, $id)
    {
        $data = $request->except('_token');
        $update = $this->itemByIdentifier($id);
        $data['permissions'] = $this->mapPermission($request->permissions);
        $update->fill($data)->save();
        $update = $this->itemByIdentifier($id);
        return $update;
    }

    public function delete($request, $id)
    {
        $item = $this->itemByIdentifier($id);
        if ($item->name == 'public-user') {
            return ['error'=>'This role cannot be delete.'];
        }
        $imagePath = $item->image ?? null;
        $logoPath = $item->logo ?? null;
        $bannerPath = $update->banner ?? null;
        $thumbnailImage = $update->thumbnail_image ?? null;
        $coverImage = $update->cover_image ?? null;
        if ($coverImage && file_exists(public_path($coverImage))) {
            removeImage($coverImage);
        }
        if ($imagePath && file_exists(public_path($imagePath))) {
            removeImage($imagePath);
        }
        if ($logoPath && file_exists(public_path($logoPath))) {
            removeImage($logoPath);
        }
        if ($bannerPath && file_exists(public_path($bannerPath))) {
            removeImage($bannerPath);
        }
        if ($thumbnailImage && file_exists(public_path($thumbnailImage))) {
            removeImage($thumbnailImage);
        }
        return $item->delete();
    }


    public function mapPermission($permissions)
    {
        $mappedPermissions = [];
        foreach ($permissions as $permission) {
            $decoded = json_decode($permission);
            if (is_array($decoded)) {
                foreach ($decoded as $per) {
                    $mappedPermissions[] = $per;
                }
            } else {
                $mappedPermissions[] = $decoded;
            }
        }

        return $mappedPermissions;
    }
}
