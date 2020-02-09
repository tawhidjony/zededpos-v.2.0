<?php

namespace App\Http\Controllers;

use App\Http\Traits\ResponseMessage;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;
use Spatie\Permission\Models\Role;

class AccountController extends Controller
{
    use ResponseMessage;

    public function show(){
        $user = Auth::user();

        return view('account.index', compact('user'));
    }

    public function update(Request $request, $id)
    {
        try {
            try {
                $request->validate([
                    'name' => ['required', 'string', 'max:255'],
                    'email' => ['required', 'string', 'email', 'max:255', 'unique:users,email,'.$id],
                    'password' => ['nullable','string', 'min:6','confirmed'],
                    'current_password' => ['nullable','string', 'min:6'],
                    'photo' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
                ]);

            } catch (\Illuminate\Validation\ValidationException $e ) {
                return redirect()->back()->withErrors($e->errors());
            }
            $data=array();
            $user = User::find($id);
            if ($user) {
                $user->name = $request->name;
                $user->email = $request->email;
                if ($request->password)
                {    if (Hash::check($request->current_password, $user->password)) {
                    $user->password = Hash::make($request->input('password'));
                } else {
                    return redirect()->back()->withErrors(['current_password' => ['Current Password is not Match']]);
                }
                }
                $image = $request->file('photo');
                if ($image) {
                    $path = Storage::putFile('images/users',$image);
                    if ($path) {
                        $data['photo'] = $path;
                        if (isset($user->photo)) {
                            Storage::delete($user->photo);
                        }
                    }
                }
                $user->update($data);
                return redirect('account')->with($this->update_success_message);

            } else {
                return back()->withInput()->with($this->not_found_message);
            }
        } catch (\Exception $ex) {
            Log::error($ex->getMessage());
            return redirect()->back()->withInput()->with($this->update_fail_message);;
        }
    }
}
