<?php

namespace App\Console\Commands;

use App\Models\BankCashIn;
use App\Models\Formatter;
use App\Models\Helper;
use App\Models\Order;
use App\Models\User;
use App\Models\UserCashIn;
use Carbon\Carbon;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Log;

class JobBankCashIn extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'schedule:bank_cash_in';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Auto change status order confirm when payment';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $bankCashIn = BankCashIn::where('is_default', 1)->first();


        if (!empty($bankCashIn)) {
            $curl = curl_init();
            curl_setopt_array($curl, array(
                CURLOPT_URL => "https://api.web2m.com/historyapiacbv3/" . $bankCashIn->account_password . "/" . $bankCashIn->account_number . "/" . $bankCashIn->account_token_web2m,
                CURLOPT_RETURNTRANSFER => true,
                CURLOPT_ENCODING => "",
                CURLOPT_MAXREDIRS => 30,
                CURLOPT_TIMEOUT => 30,
                CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                CURLOPT_CUSTOMREQUEST => "GET",
            ));

            $response = curl_exec($curl);
            $err = curl_error($curl);
            curl_close($curl);


//            $statusWeb2M = StatusWeb2M::first();

            if ($err) {
                Log::error($err);

//                $statusWeb2M->update([
//                    'is_success' => 0,
//                    'description' => $err . "",
//                    'updated_at' => now(),
//                ]);
            } else {
                $response = str_replace(["\r", "\n"], "", $response);
                $itemJson = json_decode($response, true);

                if (!empty($itemJson) && isset($itemJson['status']) && $itemJson['status'] == 'true') {


                    $datas = $itemJson['transactions'];

                    foreach ($datas as $itemData) {

                        $date = Carbon::parse("2023-12-25 14:11:44");
                        $date2 = Carbon::parse(Formatter::convertDateVNToEng($itemData['transactionDate']));

                        if ($date2->gt($date)) {

                            $creditAmount = $itemData['amount'];
                            $refNo = $itemData['transactionID'];
                            $content = strtoupper($itemData['description']);
                            $content = str_replace("  ", " ",$content);

                            $content = explode("NAPTIEN", $content);

                            if (count($content) > 1) {

                                $content = $content[1];
                                $content = trim($content);

                                $contents = explode(' ', $content);

                                if (count($contents) > 1) {
                                    $id = $contents[0];

                                    $contents[1] = explode('/', $contents[1])[0];

                                    $amount = Formatter::getOnlyNumber($contents[1]);

                                    if ($amount != $creditAmount){
                                        if (count($contents) > 2) {
                                            $amount .= ($contents[2]);
                                            $amount = Formatter::getOnlyNumber($amount);
                                        }
                                    }

                                    $user = User::find($id);

                                    if (!empty($user) && $amount == $creditAmount) {
                                        $userCashIn = UserCashIn::where('ref_no',$refNo)->first();


                                        if (!empty($userCashIn)) continue;

                                        UserCashIn::create([
                                            'user_id' => $id,
                                            'amount' => $amount,
                                            'ref_no' => $refNo,
                                        ]);

                                        $user->addAmount($amount, "Nạp tiền bằng chuyển khoản. Mã GD: " . $refNo);

                                        Helper::sendNotificationToTopic($id, "Nạp tiền", "Bạn đã nạp tiền thành công. Số tiền: ". Formatter::formatMoney($amount) . "đ", true, $id, null, "wallet");
                                    }
                                }
                            }
                        }
                    }

                }else{
//                    $statusWeb2M->update([
//                        'is_success' => 0,
//                        'description' => $response . "",
//                        'updated_at' => now(),
//                    ]);
                }
            }
        }
    }
}
