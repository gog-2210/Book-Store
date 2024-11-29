<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Http\Requests\Frontend\UpdateProfilePasswordRequest;
use App\Http\Requests\Frontend\UpdateProfileRequest;
use App\Services\ProfileService;
use Auth;
use Illuminate\Http\Request;

class ProfileController extends Controller
{
    protected $profileService;

    public function __construct(ProfileService $profileService)
    {
        $this->profileService = $profileService;
    }


    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('frontend.profile');
    }

    public function changePassword(UpdateProfilePasswordRequest $request)
    {
        $validated = $request->validated();
        $result = $this->profileService->updatePassword($validated);
        if (!$result) {
            return redirect()->route('profile')->with('error', 'Mật khẩu cũ không chính xác.');
        }
        return redirect()->route('profile')->with('success', 'Mật khẩu đã được thay đổi thành công.');
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateProfileRequest $request)
    {
        $validated = $request->validated();
        $result = $this->profileService->updateProfile( $validated);
        if (!$result) {
            return redirect()->route('profile')->with('error', 'Có lỗi xảy ra, vui lòng thử lại sau.');
        }
        return redirect()->route('profile')->with('success', 'Thông tin cá nhân đã được cập nhật!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy()
    {
        if (Auth::user()->role == 1) {
            return redirect()->route('profile')->with('error', 'Quản trị viên không thể xóa tài khoản.');
        }
        return $this->profileService->deleteProfile();
    }
}
