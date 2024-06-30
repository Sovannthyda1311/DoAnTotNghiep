<?php

namespace App\Http\Controllers\Frontend;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function index()
    {
        return view('frontend.user.profile');
    }

    public function updateUserDetails(Request $request)
    {
        $request->validate([
            'username' => ['required','string'],
            'phone' => ['required','digits:10'],
            'city' => ['required','string'],
            'district' => ['required','string'],
            'ward' => ['required','string'],
            'address' => ['required','string','max:499'],
        ]);

        $user = User::findOrFail(Auth::user()->id);
        $user->update([
            'name' => $request->username
        ]);

        $user->userDetail()->updateOrCreate(
            [
                'user_id' => $user->id,
            ],
            [
                'phone'  => $request->phone,
                'city'  => $request->city,
                'district'  => $request-> district,
                'ward'  => $request->ward,
                'address'  => $request->address,
            ]
        );

        return redirect()->back()->with('message','Your Profile Updated Successfully!');
    }

    public function passwordCreate()
    {
        return view('frontend.user.change-password');
    }

    public function changePassword(Request $request)
    {
        $request->validate([
            'current_password' => ['required','string','min:8'],
            'password' => ['required', 'string', 'min:8', 'confirmed']
        ]);

        $currentPasswordStatus = Hash::check($request->current_password, auth()->user()->password);
        if($currentPasswordStatus){

            User::findOrFail(Auth::user()->id)->update([
                'password' => Hash::make($request->password),
            ]);

            return redirect()->back()->with('message','Password Updated Successfully');

        }else{

            return redirect()->back()->with('message-error','Current Password does not match with Old Password');
        }
    }
}
