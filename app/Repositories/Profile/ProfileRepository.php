<?php
namespace App\Repositories\Profile;

use App\Http\Resources\Profile\UserProfileInvoiceResource;
use App\Http\Resources\Profile\UserProfileInvoiceSingleResource;
use App\Http\Resources\Profile\UserProfileResource;
use App\Interfaces\Profile\ProfileInterface;

class ProfileRepository implements ProfileInterface
{

    public function index()
    {
        $user = auth('users')->user();
        return helper_response_fetch(new UserProfileResource($user));
    }

    public function update($request)
    {
        auth('users')->user()->update(['name' => $request->name,'age' => $request->age,'is_barber' => $request->is_barber]);
        return helper_response_fetch(new UserProfileResource(auth('users')->user()));

    }

    public function invoices()
    {
        $data = auth('users')->user()->invoices();
        $data->orderByDesc('id');
        return helper_response_fetch(UserProfileInvoiceResource::collection($data->get()));

    }

    public function invoices_show($item)
    {
        if ($item->user_id != auth('users')->id()){
            return helper_response_error('access denied');
        }
        return helper_response_fetch(new UserProfileInvoiceSingleResource($item));

    }

}
