<?php

//check auth sms time
function helper_auth_otp_check_time($phone): bool
{
    $auth_code = \App\Models\Auth_Code::where('phone',$phone)->first();
    if (!empty($auth_code)){
        $now_time = \Carbon\Carbon::now();
        return !($now_time->diffInMinutes($auth_code->updated_at) >= 2);
    }
    return false;
}

//check auth code
function helper_auth_otp_check_code($phone,$code){
    return \App\Models\Auth_Code::where('phone',$phone)->where('code',$code)->exists();
}

function helper_auth_otp_remove_code($phone): void
{
    App\Models\Auth_Code::where('phone',$phone)->delete();
}


function helper_auth_otp_make_code($phone)
{
    if (env('APP_ENV') === 'local'){
        $code = 123456;
    }else{
        $code = random_int(100000,999999);
        $message = 'کد ورود شما به پرگولا : '.$code;
        kavenegar_pattern($phone,'jalaliauth',$code);
    }
    //Send SMS
    \App\Models\Auth_Code::updateorcreate([
        'phone' => $phone],[
        'code' => $code,
        'updated_at' => \Carbon\Carbon::now(),
    ]);
    if (env('APP_ENV') !== 'local'){
        //send sms

    }

}

