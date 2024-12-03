<?php
namespace App\Services;

use App\Models\User;
use Illuminate\Support\Facades\Log;

class UserService
{
    protected $model;

    public function __construct(User $user)
    {
        $this->model = $user;
    }

    public function getAllWithSearchAndPagination($searchTerm = null, $perPage = 10)
    {
        return $this->model->withTrashed()
            ->when($searchTerm, function ($query, $searchTerm) {
                return $query->where('name', 'like', '%' . $searchTerm . '%')
                    ->orWhere('email', 'like', '%' . $searchTerm . '%');
            })
            ->paginate($perPage);
    }

    public function getById($id)
    {
        return $this->model->findOrFail($id);
    }

    public function restore($id)
    {
        $user = $this->model->withTrashed()->findOrFail($id);
        $user->restore();

        return true;
    }

    public function create($data)
    {
        return $this->model->create($data);
    }

    public function update(array $data, $id)
    {
        $user = $this->getById($id);
        if (!empty($data['password'])) {
            $data['password'] = bcrypt($data['password']);
        } else {
            unset($data['password']);
        }

        $user->update($data);

        return $user;
    }

    public function delete($id)
    {
        $user = $this->getById($id);
        $user->delete();

        return true;
    }

}
