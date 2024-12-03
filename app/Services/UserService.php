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

    public function getAll()
    {
        return $this->model->all();
    }

    public function create($data)
    {
        try {
            return $this->model->create($data);
        } catch (\Exception $e) {
            Log::error($e->getMessage());
            return false;
        }
    }

    public function search(array $filters, int $perPage = 10)
    {
        $query = $this->model->query();

        if (!empty($filters['name'])) {
            $query->where('name', 'like', '%' . $filters['name'] . '%');
        }

        if (!empty($filters['email'])) {
            $query->where('email', 'like', '%' . $filters['email'] . '%');
        }

        if (!empty($filters['phone'])) {
            $query->where('phone', 'like', '%' . $filters['phone'] . '%');
        }

        return $query->paginate($perPage);
    }

    public function getAllUsersWithTrashed($search = null, $pagination = 10)
    {
        $query = $this->model->withTrashed(); // Bao gồm cả user đã xoá

        $query->where('id', '!=', 1);

        // Tìm kiếm theo tên, email, số điện thoại
        if ($search) {
            $query->where(function ($q) use ($search) {
                $q->where('name', 'LIKE', "%$search%")
                  ->orWhere('email', 'LIKE', "%$search%")
                  ->orWhere('phone', 'LIKE', "%$search%");
            });
        }

        return $query->paginate($pagination);
    }
}
