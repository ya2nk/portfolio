<?php

namespace App\Http\Controllers\Admin;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use RealRashid\SweetAlert\Facades\Alert;
use App\Http\Requests\UpdatePasswordRequest;

class UserController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        return view('admin.user.index', compact('user'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'username' => ['required', Rule::unique('users', 'username')->ignore(Auth::user()->id)],
            'avatar' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'name' => 'required',
            'email' => 'required|email',
        ]);

        $user = Auth::user($id);


        if ($request->hasFile('avatar')) {
            $img = $request->file('avatar');
            $user['avatar'] = time().'-'. $img->getClientOriginalName();

            $filePath = public_path('/upload/user');
            $img->move($filePath, $user['avatar']);
        } else {
            $img = $user->avatar;
        }

        $user = User::find(Auth::user()->id)->update([
            'username' => $request->username,
            'name' => $request->name,
            'email' => $request->email,
            'avatar' => $user['avatar']
        ]);

        Alert::toast('Update Profile Success', 'success')->position('top');
        return redirect()->route('user.index');

    }

    public function changepassword()
    {
        return view('admin.user.changepassword');
    }

    public function updatepassword(UpdatePasswordRequest $request)
    {

        $request->user()->update([
            'password' => Hash::make($request->get('password'))
        ]);

        Alert::toast('Update Password Success', 'success')->position('top');
        return redirect()->route('user.index');

    }
}
