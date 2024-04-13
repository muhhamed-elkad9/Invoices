<?php

namespace App\Http\Controllers;

use App\Http\Traits\UploadImage;
use App\Models\add_image;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class AddImageController extends Controller
{
    use UploadImage;

    public function update(Request $request)
    {

        $user = User::find(Auth::user()->id);
        if (!$user)
            return redirect()->back();

        if ($request->photo == 'user.jpg') {

            $file_name = $this->saveImage($request->photo, 'avatars/' . Auth::user()->id);

            $user->update([
                'avatar' => $file_name,
            ]);
        }



        if ($request->photo == null) {
            Storage::disk('public_uploads_avatars')->delete(Auth::user()->id . '/' . Auth::user()->avatar);

            $user->update([
                'avatar' => null,
            ]);
        } else {

            Storage::disk('public_uploads_avatars')->delete(Auth::user()->id . '/' . Auth::user()->avatar);

            $file_name = $this->saveImage($request->photo, 'avatars/' . Auth::user()->id);

            $user->update([
                'avatar' => $file_name,
            ]);
        }


        return back()->with(['edit' => __('profile.edit_pro')]);
    }
}
