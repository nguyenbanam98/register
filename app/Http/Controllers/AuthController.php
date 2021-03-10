<?php

namespace App\Http\Controllers;

use App\Models\User;
use HoangPhi\VietnamMap\Models\District;
use HoangPhi\VietnamMap\Models\Province;
use Illuminate\Contracts\View\View;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;


class AuthController extends Controller
{
    /**
     * @return View
     */
    public function register(): View
    {
        $provinces = Province::all();
        $data = [
            'provinces' => $provinces
        ];

        return view('auth', $data);
    }

    /**
     * @param Request $request
     * @return User
     */
    public function store(Request $request): User
    {
        $avatar = $this->uploadAvatar($request);

        $data = [
            'name'     => $request->input('name'),
            'email'    => $request->input('password'),
            'password' => Hash::make($request->input('password')),
            'avatar'   => $avatar['file_path'],
            'province' => $request->input('province'),
            'district' => $request->input('district'),
            'ward'     => $request->input('ward'),
        ];

        return User::create($data);
    }

    /**
     * @param Province $province
     * @return JsonResponse
     */
    public function getDistrictFromProvinces(Province $province): JsonResponse
    {
        $districts = $province->districts()->get();

        return response()->json([
            'code' => 200,
            'data' => $districts
        ], 200);
    }

    /**
     * @param District $district
     * @return JsonResponse
     */
    public function getWardFromDistrict(District $district): JsonResponse
    {
        $wards = $district->wards()->get();

        return response()->json([
            'code' => 200,
            'data' => $wards
        ], 200);
    }

    /**
     * Upload avatar
     *
     * @param $request
     * @return array
     */
    public function uploadAvatar($request): array
    {
        if (!$request->hasFile('avatar')) {
            return [];
        }

         $image = $request->file('avatar');
         $fileNameOrigin = $image->getClientOriginalName();
         $fileNameHash =  time() . $fileNameOrigin;
         $path = Storage::disk('local')->putFileAs('public/avatar', $image, $fileNameHash);

        return [
            'file_name' => $fileNameOrigin,
            'file_path' => $url = Storage::url($path),
        ];
    }

}
