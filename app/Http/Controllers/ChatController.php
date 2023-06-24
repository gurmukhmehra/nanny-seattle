<?php

namespace App\Http\Controllers;

use App\Models\Membership;
use Illuminate\Http\Response;
use File;
use Session;
use Auth;
use Illuminate\Support\Facades\Validator;
use App\Models\User;
use Request;
use Illuminate\Support\Facades\Hash;
use \Stripe\Stripe;
use Exception;
use Redirect;
use Intervention\Image\Facades\Image;
use Tymon\JWTAuth\Facades\JWTAuth;
use Tymon\JWTAuth\Facades\JWTFactory;
use Tymon\JWTAuth\Exceptions\JWTException;
use Tymon\JWTAuth\Contracts\JWTSubject;
use Tymon\JWTAuth\JWTManager as JWT;
use Tymon\JWTAuth\Exceptions\TokenExpiredException;
use Tymon\JWTAuth\Exceptions\TokenInvalidException;
use Illuminate\Support\Str;
use App\Models\subscribersPlans;
use App\Models\MemberFriends;
use App\Models\UserBio;
use App\Models\CareProviderBio;
use App\Models\Group;
use App\Models\UserGroup;
use DB;
use App\Models\Message;
use App\Events\MessageSentEvent;
use App\Models\GroupChat;
use App\Events\ChatEvent;

class ChatController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function UsersChats(Request $request)
    {
        $inputs = Request::all();
        $chatUser = User::where('username',$inputs['user_id'])->first();
        return response()->json([
            'chatUserDetail' => $chatUser
        ]);
    }

    public function GroupChats(Request $request)
    {
        $inputs = Request::all();
        $groupDetail = Group::where('groupSlug',$inputs['group_slug'])->first();
        return response()->json([
            'chatGroupDetail' => $groupDetail
        ]);
    }

    public function ChatMessages(Request $request)
    {
        $inputs = Request::all();        
        $validator = Validator::make($inputs, [
            'message' => 'required'                    
        ]);             

        if($validator->fails()) {
            return response()->json(['error' => $validator->errors()], 401);
        }
        $user = Auth::user();
        $chatMessage = new Message;        
        $chatMessage->sender_user_id = $inputs['sendMessageFrom'];
        $chatMessage->chat_user_id = $inputs['sendMessageTo'];
        $chatMessage->message = $inputs['message'];
        $chatMessage->save();              
        $GetUserChats = Message::where('sender_user_id',$inputs['sendMessageFrom'])
                                ->where('chat_user_id',$inputs['sendMessageTo'])                                
                                ->get();      
        event(new ChatEvent($chatMessage));                      
        return response()->json([
            'MessageStatus' => 'success',
            'SendMessageDetail' => $chatMessage,
            'FriendsChatMessages' => $GetUserChats
        ]);
        
    }

    public function getChatMessageWithFriend(Request $request)
    {
        //$inputs['loginUserID'];
        //$inputs['FriendUsername'];
        $inputs = Request::all();
        $friendDetails = User::where('username',$inputs['FriendUsername'])->first();

        $checkFriends = MemberFriends::where('senderUserID',$inputs['loginUserID'])
                                        ->where('requestSendTo',$friendDetails->id)
                                        ->where('requestStatus','confirm')
                                        ->count();
        if($checkFriends>0):
            $GetUserChats = Message::where('sender_user_id',$inputs['loginUserID'])
                                    ->where('chat_user_id',$friendDetails->id)
                                    ->orWhere('sender_user_id',$friendDetails->id)
                                    ->orWhere('chat_user_id',$inputs['loginUserID'])
                                    ->get();
        else:
            $GetUserChats = Message::where('sender_user_id',$friendDetails->id)
                                    ->where('chat_user_id',$inputs['loginUserID'])
                                    ->orWhere('sender_user_id',$inputs['loginUserID'])
                                    ->orWhere('chat_user_id',$friendDetails->id)
                                    ->get();
        endif; 
                                 
        return response()->json([
            'FriendsChatMessages' => $GetUserChats
        ]);
    }

    public function getGroupChatMessage(Request $request)
    {
        $inputs = Request::all();
        $groupDetail = Group::where('groupSlug',$inputs['group_slug'])->first();
        $GroupUsersList = UserGroup::where('groupID',$groupDetail->id)->get()->toArray();
        $groupUsersDetails = array_map(array($this, 'MemberGroupDetails'),  $GroupUsersList);
        $groupUsersInfos = User::whereIn('id',$groupUsersDetails)->get();        
        $GetGroupChats = GroupChat::where('group_id',$groupDetail->id)->get(); 
               
        return response()->json([
            'MessagesGroups' => $GetGroupChats,
            'groupUsers' => $groupUsersInfos
        ]);
    }
    private function MemberGroupDetails($groupsIDs){       
        return $groupsIDs['userID'];
    }

    public function GroupChatMessages(Request $request)
    {
        $inputs = Request::all();
        $validator = Validator::make($inputs, [
            'groupChatsMessage' => 'required'                    
        ]);             

        if($validator->fails()) {
            return response()->json(['error' => $validator->errors()], 401);
        }
        $GroupChatMessage = new GroupChat;
        $GroupChatMessage->group_id = $inputs['group_id'];       
        $GroupChatMessage->auth_user_id = $inputs['sendMessageFrom'];        
        $GroupChatMessage->groupMessage = $inputs['groupChatsMessage'];
        $GroupChatMessage->save();              
        event(new ChatEvent($GroupChatMessage));
        return response()->json([
            'MessageStatus' => 'success',
            'GroupsChatMessages' => $GroupChatMessage
        ]);
    }    

}
