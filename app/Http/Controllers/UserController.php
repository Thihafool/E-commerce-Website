<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Order;
use App\Models\Product;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller
{
    //direct user list page
    public function listPage()
    {

        $users = User::where('role', 'user')->paginate(5);
        return view('admin.user.list', compact('users'));
    }

    //direct user homePage
    public function home()
    {
        $cart = Cart::where('user_id', Auth::user()->id)->get();
        $history = Order::where('user_id', Auth::user()->id)->get();
        $product = Product::get();
        return view('user.homePage.home', compact('product', 'cart', 'history'));
    }
    //direct user profile
    public function info()
    {
        return view('user.profile.info');
    }
    //update user info
    public function updateInfo(Request $request)
    {
        $id = Auth::user()->id;

        $this->userDataValidation($request);
        $data = $this->getUserData($request);

        User::where('id', $id)->update($data);
        return redirect()->route('user#homePage')->with(['updateSuccess' => 'Profile updated successfully']);

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