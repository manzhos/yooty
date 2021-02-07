<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SetNotificationController extends Controller
{
    public function notification(Request $request)
    {
        $user = Auth::user();

        if($user->setnotification){

            if($request->has('message') || $request->has('virement') || $request->has('remboursement') || $request->has('cours_particulier') || $request->has('rappel')){

                if($request->message === 'on'){ $new_message = 1; } else { $new_message = 0; }
                if($request->virement === 'on'){ $virement = 1; } else { $virement = 0; }
                if($request->remboursement === 'on'){ $remboursement = 1; } else { $remboursement = 0; }
                if($request->cours_particulier === 'on'){ $cours_particulier = 1; } else { $cours_particulier = 0; }
                if($request->rappel === 'on'){ $rappel = 1; } else { $rappel = 0; }

                $user->setnotification()->update([
                    'new_message' => $new_message,
                    'money' => $virement,
                    'return_money' => $remboursement,
                    'be_prof' => $cours_particulier,
                    'start_end_conversation' => $rappel,
                ]);

            }
            else{
                //$notifications_tags = $user->setnotification;
            }
        }
        else {
            $notifications_tags = $user->setnotification()->create();
        }

        $user = $user->fresh();
        $notifications_tags = $user->setnotification;

        return view('profiles.notification',compact('notifications_tags', 'user'));
    }

}
