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

}
