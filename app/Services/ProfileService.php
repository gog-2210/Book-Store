<?php
namespace App\Services;

use App\Models\User;
use Auth;
use Exception;
use Hash;

class ProfileService
{
    protected $model;

    public function __construct(User $user)
    {
        $this->model = $user;
    }

    public function updateProfile($data)
    {
        try {
            $userId = Auth::id();
            $user = $this->model->findOrFail($userId);
            $user->update($data);
            return true;
        } catch (Exception $e) {
            return false;
        }
    }

    public function updatePassword($request)
    {
        try {
            if (!Hash::check($request['current_password'], Auth::user()->password)) {
                return false;
            }
            if($request['current_password'] == $request['new_password']){
                return redirect()->route('profile')->with('error', 'Mật khẩu mới không được trùng với mật khẩu cũ.');
            }
            $this->model->where('id', Auth::id())->update(['password' => Hash::make($request['new_password'])]);
            return true;
        } catch (Exception $e) {
            return false;
        }
    }

    public function deleteProfile()
    {
        try {
            $userId = Auth::id();
            $this->model->findOrFail($userId)->delete();
            return redirect()->route('frontend.index')->with('success', 'Tài khoản đã bị xóa vĩnh viễn.');
        } catch (Exception $e) {
            return false;
        }
    }
}
