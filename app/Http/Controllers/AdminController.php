<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class AdminController extends Controller
{
    //direct change password page
    public function changePasswordPage()
    {
        return view('admin.account.change');
    }
    //change password
    public function changePassword(Request $request)
    {
        $this->passwordValidationCheck($request);

        $id = Auth::user()->id;
        $dbPassword = User::where('id', $id)->first();

        $oldPassword = $dbPassword->password;

        if (Hash::check($request->oldPassword, $oldPassword)) {

            $newPassword = Hash::make($request->newPassword);
            $data = [
                'password' => $newPassword,
            ];

            User::where('id', $id)->update($data);
            return back()->with(['changePassword' => 'password change successfully']);
        }
        return back()->with(['notMatch' => 'Password is not match']);

    }

    //direct details page
    public function details()
    {
        return view('admin.account.details');
    }

    //edit page
    public function editPage()
    {
        return view('admin.account.edit');
    }
    //edit admin info
    public function update(Request $request)
    {
        $id = Auth::user()->id;

        $this->userDataValidation($request);
        $data = $this->getUserData($request);

        $dbimage = User::where('id', $id)->first();
        $dbimage = $dbimage->image;

        if ($request->hasFile('image')) {

            if ($dbimage != null) {
                Storage::delete('public/' . $dbimage);
            }

            $fileName = uniqid() . $request->file('image')->getClientOriginalName();
            $request->file('image')->storeAs('public', $fileName);
            $data['image'] = $fileName;
        }
        User::where('id', $id)->update($data);
        return redirect()->route('admin#details');

    }
    //direct admin list page
    public function listPage()
    {
        $users = User::where('role', 'admin')->get();
        return view('admin.account.list', compact('users'));
    }

    //request user data
    private function getUserData($request)
    {
        return [
            'name' => $request->name,
            'email' => $request->email,
            'phone' => $request->phone,
            'gender' => $request->gender,
            'address' => $request->address,
        ];
    }
    //validation check
    private function userDataValidation($request)
    {
        Validator::make($request->all(), [
            'name' => 'required',
            'email' => 'required',
            'phone' => 'required',
            'address' => 'required',
            'image' => 'mimes:png,jpg,jpeg,webp',
            'gender' => 'required',
        ])->validate();
    }

    //get change password data
    private function passwordValidationCheck(Request $request)
    {
        Validator::make($request->all(), [
            'oldPassword' => 'required|min:6',
            'newPassword' => 'required|min:6',
            'confirmPassword' => 'required|min:6|same:newPassword',
        ])->validate();
    }
}