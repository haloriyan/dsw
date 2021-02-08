<?php

namespace App\Http\Controllers;

use Route;
use App\AdminRole;
use Illuminate\Http\Request;

use App\Http\Controllers\AdminController as AdminCtrl;

class RoleController extends Controller
{
    public static function get($filter = NULL) {
        if ($filter == NULL) {
            return new AdminRole;
        }
        return AdminRole::where($filter);
    }
    public function create() {
        $myData = AdminCtrl::me();
        $menus = AdminCtrl::getMenus($myData->role);
        $modules = self::getRoutePrefixes();
        
        return view('admin.role.create', [
            'modules' => $modules,
            'menus' => $menus,
            'myData' => $myData
        ]);
    }
    public function store(Request $req) {
        $saveData = AdminRole::create([
            'role' => $req->role,
            'module' => $req->module,
            'actions' => $req->actions,
        ]);

        return redirect()->route('admin.role');
    }
    public function edit($id) {
        $myData = AdminCtrl::me();
        $menus = AdminCtrl::getMenus($myData->role);
        $role = AdminRole::find($id);
        $modules = self::getRoutePrefixes();

        return view('admin.role.edit', [
            'data' => $role,
            'menus' => $menus,
            'myData' => $myData,
            'modules' => $modules
        ]);
    }
    public function update($id, Request $req) {
        $updateData = AdminRole::where('id', $id)->update([
            'role' => $req->role,
            'module' => $req->module,
            'actions' => $req->actions,
        ]);

        return redirect()->route('admin.role');
    }
    public static function authenticate($module, $currentAction) {
        $myData = AdminCtrl::me();
        $role = $myData->role;
        if ($role == "superadmin" || $module == "dashboard" || $module == "profile") {
            return true;
        }

        $rules = AdminRole::where([
            ['role', '=', $role],
            ['module', '=', $module]
        ])->first();
        if ($rules == "") {
            return false;
        }
        
        $actions = explode(",", $rules->actions);
        $firstAuthentication = in_array($currentAction, $actions);
        return $firstAuthentication;
        if ($firstAuthentication) {
            // second auth
            $currentRouteName = Route::currentRouteName();
            // return $currentRouteName;
            return false;
        }
        return false;
    }
    public static function getModule() {
        $currentRoute = Route::current();
        $currentPrefix = explode("/", $currentRoute->getPrefix())[1];
        $currentAction = explode(".", $currentRoute->getName())[1];
        if ($currentPrefix == "admin") {
            $currentPrefix = explode("/", $currentRoute->uri)[1];
            $currentAction = "view";
        }
        return $currentPrefix;
    }
    public static function getRoutePrefixes() {
        $prefixes = [];
        $routes = Route::getRoutes();
        $i = 0;
        foreach ($routes as $route) {
            $prefix = $route->getPrefix();
            if (substr($prefix, 0, 1) == "/") {
                $iPP = $i++;
                $prefix = explode("/", $prefix)[1];
                if (!in_array($prefix, $prefixes)) {
                    array_push($prefixes, $prefix);
                }
            }
        }
        return $prefixes;
    }
    public function delete($id) {
        $deleteData = AdminRole::where('id', $id)->delete();
        
        return redirect()->route('admin.role');
    }
}
