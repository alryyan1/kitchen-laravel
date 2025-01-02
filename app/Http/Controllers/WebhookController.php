<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Settings;
use App\Models\Whatsapp;
use Illuminate\Http\Request;

class WebHookController extends Controller
{
    public function webhook(Request $request)
    {

        $data = file_get_contents("php://input");
        $event = json_decode($data, true);
        //        Whatsapp::sendMsgWb('96878622990','from web api');
        if (isset($event)) {
            //Here, you now have event and can process them how you like e.g Add to the database or generate a response
            $file = 'log.txt';

            $data = json_encode($event) . "\n";
            $from = $event["data"]["from"];
            $msg = $event["data"]["body"];
            $from_sms =  str_replace("c.us", "", $from);
            $from_sms =  str_replace("@", "", $from_sms);
            $settings = Settings::first();
            $phone_numbers =   explode(',', $settings->authorized_phones);
                            $array = collect($phone_numbers);

            if ($msg == '1') {
                if ($array->contains($from_sms)) {
                    # code...

                    $msg = <<<TXT
جاري اعداد التقرير ...
سيتم ارساله في لحظات
TXT;
                    Whatsapp::sendMsgWb($from_sms, $msg, true);

                    # send dialy report
                    $pdfController = new PDFController();
                    $pdfController->orders($request, $from_sms);
                }
            }
            if ($msg == '2') {
                if ($array->contains($from_sms)) {
                    # send monthly report
                    $msg = <<<TXT
                جاري اعداد التقرير ...
                سيتم ارساله في لحظات
                TXT;
                    Whatsapp::sendMsgWb($from_sms, $msg, true);

                    $pdfController = new PDFController();
                    $pdfController->month($request, $from_sms);
                }
            }
            // $pdfController = new PDFController();

            if ($msg === 'report') {
                $msg = <<<TXT
                للتقرير اليومي ارسل رقم 1
للتقرير الشهري ارسل رقم 2

TXT;
                Whatsapp::sendMsgWb($from_sms, $msg, true);
            }
            // Whatsapp::sendMsgWb($from_sms, $msg, true);

            file_put_contents(storage_path() .  $file, $data, FILE_APPEND | LOCK_EX);
        }
    }
}
