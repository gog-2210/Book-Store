<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Http\Requests\User\CreateUserRequest;
use App\Http\Requests\User\UpdateUserRequest;
use App\Services\UserService;
use Illuminate\Http\Request;

class UserController extends Controller
{
    protected $userService;

    public function __construct(UserService $userService)
    {
        $this->userService = $userService;
    }

    public function index(Request $request)
    {
        $searchTerm = $request->input('search');
        $users = $this->userService->getAllWithSearchAndPagination($searchTerm);

        return view('admin.users.index', compact('users'));
    }

    public function show($id)
    {
        $user = $this->userService->getById($id);

        return view('admin.users.show', compact('user'));
    }

    public function create()
    {
        return view('admin.users.create');
    }

    public function store(CreateUserRequest $request)
    {
        $validatedData = $request->validated();
        $this->userService->create($validatedData);

        return redirect()->route('admin.users.index')->with('success', 'User created successfully.');
    }

    public function edit($id)
    {
        $user = $this->userService->getById($id);
        return view('admin.users.edit', compact('user'));
    }

    public function update(UpdateUserRequest $request, $id)
    {
        $validatedData = $request->validated();
        $result = $this->userService->update($validatedData, $id);
        if (!$result) {
            return redirect()->back()->with('error', 'User not found.');
        }
        return redirect()->route('admin.users.index')->with('success', 'User updated successfully.');
    }

    public function destroy($id)
    {
        $this->userService->delete($id);

        return redirect()->route('admin.users.index')->with('success', 'User deleted successfully.');
    }

    public function restore($id)
    {
        $result = $this->userService->restore($id);
        if (!$result) {
            return redirect()->back()->with('error', 'Người dùng không tồn tại.');
        }
        return redirect()->route('admin.users.index')->with('success', 'Người dùng đã được khôi phục thành công.');
    }
}
