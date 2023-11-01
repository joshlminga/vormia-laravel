<?php

namespace App\Models\Vrm;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

//Models
use App\Models\Auto;

class Setting extends Model
{
    use HasFactory;

    // Donot show this column
    protected $hidden = [
        'id',
        'created_at',
        'updated_at',
    ];

    /**
     * Todo: Load all Global Active Settings
     *
     * * This method is used to load all data requred to be present for the system/website to operate well
     * ? E.g Site Title, Active Themes, Meta Data e.t.c
     * ? All values are return as one array (data)
     */
    public static function globalSetting($allow_autoload = true)
    {
        // Get all settings where flag is 1 use eloquent
        $global_setting = array_reduce(Setting::whereType('global')->whereFlag(1)->get(['title', 'value'])->toArray(), function ($result, $item) {
            $result[$item['title']] = $item['value'];
            return $result;
        }, array());

        // Update Themes Dir
        $global_setting['theme_dir'] = 'vrm-content/themes/' . $global_setting['theme_name'];
        $global_setting['theme_assets'] = 'vrm-content/themes/' . $global_setting['theme_name'];
        $global_setting['plugin_assets'] = 'vrm-content/plugins';

        // Other Global Settings
        $global_setting['userinfo'] = Setting::user_info();
        $global_setting['isLogged'] = Auth::isLogged();

        // Load Auto Model
        $global_auto = [];
        if ($allow_autoload) {
            $this_auto = new Auto;
            $global_auto = $this_auto->loadData();
        }

        // Merge
        $setting = array_merge($global_setting, $global_auto);

        // Return the setting
        return $setting;
    }

    /**
     * Todo: This method is used to pre load all required procedure when opening a page
     *
     * @param string or integer $term default is null
     * @param array $passed default is empty array
     */
    public static function preLoad($term = null, $passed = [])
    {
        $page_name = $term;
        // Check $term if is not null
        if (!is_null($term)) {
            $find_term = (is_numeric($term)) ? ['id' => $term] : ['slug' => $term];
            // Check If is Array
            (is_array($term)) ? $find_term = $term : $page_name = $term;

            // Load Url Model
            $db_url = Term::where($find_term)->select('slug', 'table', 'related_id as id')->first();
            if (!is_null($db_url)) {
                $db_url = $db_url->toArray();
                // Get Page Name from -> contents
                if ($db_url['table'] == 'contents') {
                    $page_name = ''; // Content::where($db_url['table'], $db_url['id'])->value('page_name');
                }
            }
        }

        // Load all global settings
        $global_setting = self::globalSetting();

        // Page
        $global_setting['page_name'] = $page_name ?? '';

        // Merge all settings into one array
        $settings = array_merge($global_setting, $passed);

        // Return all settings
        return $settings;
    }

    /**
     * Todo: This method is used to pre load all required procedure when opening a page
     *
     * @param string or integer $term default is null
     * @param array $passed default is empty array
     */
    public static function adminLoad($term = null, $passed = [])
    {
        $page_name = $term;
        // Check $term if is not null
        if (!is_null($term)) {
            $find_term = (is_numeric($term)) ? ['id' => $term] : ['slug' => $term];
            // Check If is Array
            (is_array($term)) ? $find_term = $term : $page_name = $term;

            // Load Url Model
            $db_url = Term::where($find_term)->select('slug', 'table', 'related_id as id')->first();
            if (!is_null($db_url)) {
                $db_url = $db_url->toArray();
                // Get Page Name from -> contents
                if ($db_url['table'] == 'contents') {
                    $page_name = ''; // Content::where($db_url['table'], $db_url['id'])->value('page_name');
                }
            }
        }

        // Load all global settings
        $global_setting = self::globalSetting(false); //Don't allow Auto Load

        // Page
        $global_setting['page_name'] = $page_name ?? '';
        $global_setting['theme_dir'] = 'vrm-admin';
        $global_setting['theme_assets'] = 'vrm-admin';

        // Merge all settings into one array
        $settings = array_merge($global_setting, $passed);

        // Return all settings
        return $settings;
    }

    /**
     *
     * This function is used to load user info
     * All values are return as one array (data)
     *
     * @param string $user_id
     */
    public static function user_info($user_id = null)
    {
        // check $user_id
        $user_id = (is_null($user_id)) ? session()->get('user') : $user_id;

        // Default
        $found = (object) ['name' => 'Admin Account', 'email' => '', 'phone' => '', 'profile' => 'vrm-admin/images/users/avatar-2.jpg'];

        if (!is_numeric($user_id)) {
            return $found;
        }

        $user_select = \App\Models\Vrm\User::whereId($user_id)->select('name', 'email', 'phone')->first();

        // Merge
        $found = (object) array_merge((array) $found, (array) $user_select);

        // Return
        return $found;
    }
}
