<?php

namespace App\Models\Vrm;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

// Helpers
use Illuminate\Support\Str;

class Auth extends Model
{
    use HasFactory;

    /**
     * This is Authentication Level Process
     * N:B we do not use this to authenticate user password or username if they are valid. For that is done by Authentication Model
     *
     * -> This function accept module(array) : You can pass module allowed
     * -> Second it accept level
     *    N:B if the user has logged in you do not need to send the level (pass the level variable) in the function
     *        if user has not logged in you have to pass the level else the authentication will fail.
     *    The second value has to be a string e.g admin, client, report etc
     *
     *  How It Works
     *   -> Module : they are more like access level allowed to access the particluar modules
     *   -> level : the currect level of the user as in users(Table) - user_level(column)
     *              by default the level is accessed by the system via user logged session data $this->CoreLoad->session('level') so it's not must you pass the user level
     *
     *   -> If user hasn't logged in it will return FALSE
     *   -> If user access level doesn't allow him/her to access the Module it will break the process and oped Access Not Allowed Page
     *
     *   -> If all permission are true/valid it will return TRUE
     *
     */
    public static function auth($module, $level = null)
    {
        //Check If Loged In
        if (session()->get('logged')) {
            $level = (is_null($level)) ? session()->get('level') : $level; //Access Level

            // $module = Str::plural($module); //Module Name
            $modules_list = \App\Models\Vrm\Level::whereName($level)->select('module')->first();
            $modules = explode(",", strtolower($modules_list->module)); //Allowed Modules

            if (in_array(strtolower($module), $modules)) {
                return true; //Auth Allowed
            } elseif (strtolower($level) == 'superadmin') {
                return true; //Auth Allowed
            } else {
                return false; //Auth Not Allowed
            }
        } else {
            return false; //User Not Logged In
        }
    }

    /**
     * Todo: Check if user is logged
     */
    public static function isLogged()
    {
        if (session()->get('logged')) {
            return true;
        } else {
            return false;
        }
    }
}
