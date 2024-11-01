

// namespace App\Services;

// use Twilio\Rest\Client;

// class WhatsAppService
// {
//     protected $twilio;

//     public function __construct()
//     {
//         $sid = config('services.twilio.sid');
//         $token = config('services.twilio.auth_token');
//         $this->twilio = new Client($sid, $token);
//     }

//     public function sendWhatsAppNotification($message)
//     {
//         $this->twilio->messages->create(
//             config('services.twilio.whatsapp_to'), 
//             [
//                 'from' => config('services.twilio.whatsapp_from'),
//                 'body' => $message
//             ]
//         );
//     }
// }
