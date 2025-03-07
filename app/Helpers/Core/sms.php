<?php
function kavenegar_send($phone,$message){
    try{
        $kavenegar = new \Kavenegar\KavenegarApi(config('kavenegar.apikey'));
        $sender = config('kavenegar.sender');		//This is the Sender number	//The body of SMS
        $receptor = array($phone);			//Receptors numbers

        $result = $kavenegar->Send($sender,$receptor,$message);
        if($result){
            return $result;
        }
    }
    catch(\Kavenegar\Exceptions\ApiException $e){
        // در صورتی که خروجی وب سرویس 200 نباشد این خطا رخ می دهد
        echo $e->errorMessage();
    }
    catch(\Kavenegar\Exceptions\HttpException $e){
        // در زمانی که مشکلی در برقرای ارتباط با وب سرویس وجود داشته باشد این خطا رخ می دهد
        return $e->errorMessage();
    }catch(\Exception $ex){
        // در صورت بروز خطایی دیگر
        return $ex->getMessage();
    }
}
function kavenegar_pattern($phone,$template,$token,$token2=null,$token3=null){

    try{
        //Send null for tokens not defined in the template
        //Pass token10 and token20 as parameter 6th and 7th
        $kavenegar = new \Kavenegar\KavenegarApi(config('kavenegar.apikey'));
        $result = $kavenegar->VerifyLookup($phone, $token, $token2, $token3, $template);
        if($result){
            return true;
        }
    }
    catch(\Kavenegar\Exceptions\ApiException $e){
        // در صورتی که خروجی وب سرویس 200 نباشد این خطا رخ می دهد
        return $e->errorMessage();
    }
    catch(\Kavenegar\Exceptions\HttpException $e){
        // در زمانی که مشکلی در برقرای ارتباط با وب سرویس وجود داشته باشد این خطا رخ می دهد
        return $e->errorMessage();
    }


}
