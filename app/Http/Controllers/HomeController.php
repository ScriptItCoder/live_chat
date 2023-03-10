<?php

namespace App\Http\Controllers;

use App\Events\WebsocketEvent;
use Illuminate\Http\Request;
use Pusher\Pusher;
use Illuminate\Support\Facades\DB;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    private function getConversations($userId){
        $groupedConversations['closed'] = [];
        $groupedConversations['active'] = [];

        $conversations = DB::table('conversations as c')
            ->leftJoin('teams as t', 'c.app_id', '=', 't.app_id')
            ->leftJoin(DB::raw('(SELECT message, conversation_id FROM messages ORDER BY created_at DESC LIMIT 1) as m'), function($join) {
                $join->on('c.id', '=', 'm.conversation_id');
            })
            ->where(function($query) use ($userId) {
                $query->where('t.id', DB::raw('(SELECT team_id FROM team_members WHERE user_id = ' . $userId . ')'))
                    ->where(function($query) use ($userId) {
                        $query->where('c.agent_id', $userId)
                            ->orWhereNull('c.agent_id');
                    });
            })
            ->get();

        foreach ($conversations as $conversation){
            if($conversation->status == "closed") $groupedConversations['closed'][] = $conversation;
            else $groupedConversations['active'][] = $conversation;
        }

        return $groupedConversations;
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $user = auth()->user();
        $appId = DB::table('teams')->where('team_creator', '=', $user->id)->value('app_id');
        $conversations = $this->getConversations($user->id);
        return view('dashboard', ['app_id' => $appId, 'conversations' => $conversations]);
    }
}
