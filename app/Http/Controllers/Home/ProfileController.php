<?php

namespace App\Http\Controllers\Home;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Validator;

class ProfileController extends Controller
{
    public function update(Request $request )
    {
        $request->validate([
            'name'=>'required',
        ]);

        $user = Auth::user();
        $user->update([
            'name'=>$request->name,
        ]);

        alert()->success('با تشکر','مشخصات با موفقیت ویرایش شد');
        return redirect()->route('home.users_profile.index');
    }

}
