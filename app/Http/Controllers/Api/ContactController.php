<?php

namespace App\Http\Controllers\Api;

use App\Events\NewMessage;
use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Message;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class ContactController extends Controller
{
    public function getContactList($id)
    {
        $id=0;
        $contacts=User::all();
//         $contacts = User::whereHas('messagesFrom', fn($q) => $q->where('from', $id))->get();
//        $contacts = User::where('id', '!=', $id)->whereHas('messagesFrom', fn($q) => $q->where('to', $id))->orWhereHas('messagesTo', fn($q) => $q->where('from', $id))->get();
        // dd($contacts);
        $unreadIds = Message::select(DB::raw(' `from` as sender_id, count(`from`) as messages_count'))
            ->where('to', $id)
            ->where('read', false)
            ->groupBy('from')
            ->get();
        $contacts = $contacts->map(function ($contact) use ($unreadIds) {
            $contactUnread = $unreadIds->where('sender_id', $contact->id)->first();
            $contact->unread = $contactUnread ? $contactUnread->messages_count : 0;
            return $contact;
        });

        return response()->json($contacts);
    }
    public function getMessages($id, $auth_id)
    {
        Message::where('from', $id)->where('to', $auth_id)->update(['read' => true]);

        $messages = Message::where('from', $id)->orwhere('to', $id)->get();
//    dd($messages);
        return response()->json($messages);
    }
    public function sendNewMessage(Request $request)
    {
        // dd($request);
        $message = Message::create([
            'from' => $request->sender_id,
            'to' => $request->receiver_id,
            'text' => $request->text
        ]);

//         broadcast(new NewMessage($message));
        return response()->json($message);
    }
}
