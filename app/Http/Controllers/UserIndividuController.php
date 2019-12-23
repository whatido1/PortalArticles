<?php

namespace App\Http\Controllers;

use App\Http\Requests\RequestUserIndividu;
use Illuminate\Http\Request;
use App\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use Image;
use League\Flysystem\File as FlysystemFile;

class UserIndividuController extends Controller
{
    public function show($id) {
        $User = User::find($id);
        return view('dashboard.profile', [
            "title" => "Profil",
            "User" => $User
        ]);
    }
    
    public function edit($id)
    {
        $User = User::find($id);
        return view('dashboard.profile', [
            "title" => "Edit Profil",
            "User" => $User,
            "edit" => true
        ]);

    }

    public function update(Request $request, $id)
    {
        $user = Auth::user();
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'email' => [
                'required',
                'email',
                Rule::unique('\App\User', 'email')->ignore($request->input('email'), 'email')
            ],
            'photo' => 'image|mimes:png,jpeg,jpg',
            'oldpassword' => 'sometimes|required_with:newpassword,renewpassword',
            'newpassword' => 'required_with:oldpassword,renewpassword',
            'renewpassword' => 'required_with:oldpassword,newpassword|same:newpassword'
        ]);

        $validator->after(function($validator) use($request, $user) {
            if( is_null($user->password) === false &&  !empty($request->oldpassword)) {
                if(Hash::check($request->oldpassword, $user->password)) {
                    $user->password = Hash::make($request->newpassword);
                } else {
                    $validator->errors()->add('oldpassword', 'Old password invalid');
                }
            } else {
                $user->password = Hash::make($request->newpassword);
            }

        });

        if($validator->fails()) {
            return back()->withErrors($validator);
        }

        $user->name = $request->name;
        $user->email = $request->email;
        if($request->has('photo')) {
            $photoImage = $this->uploadImage($request->photo, '/uploads/photo');
            $user->photo = '/uploads/photo/' . $photoImage->getClientOriginalName();
        }
        $user->save();
        return redirect()->back()->with(['success' => "Berhasil mengupdate profile"]);
    }

    /**
     * Upload the image
     */
    private function uploadImage($file, $path = '/uploads/photo') {
        $originalBanner = $file;
        $image = Image::make($originalBanner->getRealPath())->resize('200', null, function( $constraint ) {
            $constraint->aspectRatio();
        });

        // create folder if not exists
        if(! Storage::disk('public')->exists($path)) {
            Storage::disk('public')->makeDirectory($path);
        }
        $image->save(public_path($path) . '/' . $originalBanner->getClientOriginalName());

        return $originalBanner;
    }
}
