<?php

namespace App\Http\Controllers;

use App\Http\Requests\UserRequest;
use App\Http\Services\CommandSQL;
use App\Models\User;
use Illuminate\Contracts\View\View;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;

class UserController extends Controller
{
    public function __construct(protected CommandSQL $command_sql)
    {
        $this->command_sql = $command_sql;
    }

    public function index(): View
    {
        $users = User::query()->get();

        return view('user.table',compact('users'));
    }

    public function form(User $user): View
    {
        $roles = Role::all();

        return view('user.form', compact('user', 'roles'));
    }

    public function save(UserRequest $request, User $user)
    {
        $request_data = [
            'name' => trim($request->name),
            'email' => trim($request->email),
            'role' =>trim($request->role)
        ];

        if (!isset($user->id)) {
            $request_data = array_merge($request_data, [
                'password' => Hash::make(trim($request->password)),
            ]);
        } else {
            $request_data = array_merge($request_data, [
                'password' => $user->password,
            ]);
        }

        $response = $this->command_sql->updateOrCreate($request_data, $user, 'User');

        return redirect()->route('user.')->with([
            'status' => $response['status'],
            'message' => $response['message']
        ]);
    }

    public function destroy(User $user)
    {
        $response = $this->command_sql->destroy('User', $user);

        return redirect()->route('user.')->with([
            'status' => $response['status'],
            'message' => $response['message']
        ]);
    }
}
