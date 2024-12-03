<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Http\Requests\User\CreateUserRequest;
use App\Http\Resources\UserResource;
use App\Models\User;
use App\Services\UserService;
use Illuminate\Http\Request;

class UserController extends Controller
{
    protected $userService;

    public function __construct(UserService $userService)
    {
        $this->userService = $userService;
    }
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $search = $request->input('search');
        $users = $this->userService->getAllUsersWithTrashed($search);

        return view('admin.users.index', compact('users', 'search'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(CreateUserRequest $createUserRequest)
    {
        $data = $createUserRequest->validated();
        $result = $this->userService->create($data);
        if ($result) {
            return new UserResource($result);
        }
        return response()->json([
            'message' => 'User created failed',
        ], 500);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $user = User::findOrFail($id);

        if ($user->deleted_at) {
            return redirect()->back()->with('error', 'Người dùng đã bị khoá trước đó.');
        }
    
        $user->delete(); // Soft delete (khoá tài khoản)
    
        return redirect()->route('admin.users.index')->with('success', 'Người dùng đã bị khoá.');
    }

    // Mở khóa user (khôi phục)
    public function unlock($id)
    {
        $user = User::withTrashed()->findOrFail($id);

        if (!$user->deleted_at) {
            return redirect()->back()->with('error', 'Người dùng đang hoạt động.');
        }

        $user->restore();

        return redirect()->route('admin.users.index')->with('success', 'Người dùng đã được mở khóa.');
    }
}
