<?php

namespace App\Http\Controllers;

use App\Team;
use Illuminate\Http\Request;

use App\Http\Controllers\UserController as UserCtrl;
use App\Http\Controllers\AdminController as AdminCtrl;

class TeamController extends Controller
{
    public static function get($filter = NULL) {
        if ($filter == NULL) {
            return new Team;
        }
        return Team::where($filter);
    }
    public function searchUser(Request $req) {
        $myID = $req->myID;
        $teamID = $req->team_id;
        
        $team = Team::find($teamID);
        $assignedMember = [$team->user_chief];
        if ($team->user_1 != null) {
            array_push($assignedMember, $team->user_1);
        }
        if ($team->user_2 != null) {
            array_push($assignedMember, $team->user_2);
        }
        
        $users = UserCtrl::get([
            ['name', 'LIKE', '%'.$req->q.'%'],
            ['is_active', '=', '1'],
            ['id', '!=', $myID]
        ])->get();
        
        $datas = [];
        foreach ($users as $user) {
            if (!in_array($user->id, $assignedMember)) {
                $datas[] = $user;
            }
        }
        
        return response()->json($datas);
    }
    public static function isHaveTeam($userID) {
        return Team::where('user_chief', $userID)
        ->orWhere('user_1', $userID)
        ->orWhere('user_2', $userID)
        ->with(['chief','firstMember','secondMember'])
        ->first();
    }
    public function store(Request $req) {
        $myData = UserCtrl::me();

        $saveData = Team::create([
            'name' => $req->name,
            'user_chief' => $myData->id,
        ]);

        return redirect()->route('user.myTeam');
    }
    public function assignUser(Request $req) {
        $column = $req->id;
        $userID = $req->userID;

        $assign = Team::where('id', $req->team_id)->update([$column => $userID]);

        return response()->json(['status' => 200]);
    }
    public static function assignUserViaRegister($data) {
        return Team::where('id', $data['team_id'])->update([$data['column'] => $data['user']->id]);
    }
    public function removeUser(Request $req) {
        $remove = Team::where('id', $req->team_id)->update([$req->column => null]);
        return response()->json(['status' => 200]);
    }
    public function detail($teamID) {
        $myData = AdminCtrl::me();
        $menus = AdminCtrl::getMenus($myData->role);

        $team = Team::where('id', $teamID)
        ->with(['chief','firstMember','secondMember'])
        ->first();
        
        $team = json_decode(json_encode($team), FALSE);

        return view('admin.team.detail', [
            'team' => $team,
            'menus' => $menus,
            'myData' => $myData,
        ]);
    }
}
