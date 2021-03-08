<?php

namespace App\Http\Controllers;

use HoangPhi\VietnamMap\Models\District;
use HoangPhi\VietnamMap\Models\Province;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Intervention\Image\Facades\Image;


class AuthController extends Controller
{
    public function register()
    {
        $provinces = Province::all();
        $data = [
            'provinces' => $provinces
        ];
        return view('auth', $data);
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users',
            'password' => 'bail|required|min:6',
            'password_confirmation' => 'bail|required|same:password',
        ]);
        $avatar = $this->uploadAvatar($request);

        $data = [
            'name' => $request->input('name'),
            'email' => $request->input('password'),
            'password' => Hash::make($request->input('password')),
            'province' => $request->input('province'),
            'district' => $request->input('district'),
            'ward'     => $request->input('ward'),
        ];
        dd($avatar, $data);




    }

    public function getDistrictFromProvinces(Province $province): JsonResponse
    {
        $districts = $province->districts()->get();

        return response()->json([
            'code' => 200,
            'data' => $districts
        ], 200);
    }

    public function getWardFromDistrict(District $district): JsonResponse
    {
        $wards = $district->wards()->get();

        return response()->json([
            'code' => 200,
            'data' => $wards
        ], 200);
    }

    public function uploadAvatar($request): array
    {
        if (!$request->hasFile('avatar')) {
            return [];
        }
//        $file = $request->file('avatar');
//
//        $resizedImg = Image::make($file);
//
//        $fileNameOrigin = $file->getClientOriginalName();
//
//        $fileNameHash = Str::random(20) . '.' . $file->extension();
//
//        $resizedImg->fit(200, 200);
//
//        $path = $file->storeAs('public/' . 'avatar', $fileNameHash);
//
//        return [
//            'file_name' => $fileNameOrigin,
//            'file_path' => $url = Storage::url($path),
//        ];

         $image = $request->file('avatar');

         $resized_img = Image::make($image);

         $fileNameOrigin = $image->getClientOriginalName();

         $fileNameHash = Str::random(20) . '.' . $image->extension();

         $resized_img->fit( 200);

         $path = $image->storeAs('public/' . 'avatar', $fileNameHash);

        return [
            'file_name' => $fileNameOrigin,
            'file_path' => $url = Storage::url($path),
        ];

    }

}
