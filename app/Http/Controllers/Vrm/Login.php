<?php

namespace App\Http\Controllers\Vrm;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

// Helpers
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

// Add session
use Illuminate\Support\Facades\Session;
// Add Carbon
use Carbon\Carbon;

// Models - Vrm
use App\Models\Vrm\Notify;
use App\Models\Vrm\Setting;
use App\Models\Vrm\User;

class Login extends Controller
{

    // PRIVATE VARIABLES
    private $Table = ''; // Table name will be pluralized

    private $ThemePath = ""; //Main Theme Path starting from resources/views/
    private $MainFolder = "log"; //Main Folder Name (in prural) inside the resources/views/$ThemePath/pages
    private $SubFolder = ""; //Sub Folder Name inside the resources/views/$ThemePath/pages/$MainFolder/
    private $Upload = "media"; //Upload Folder Name inside the public/admin/media

    private $Access = ""; // Access level for this controller
    private $ParentRoute = "vrm-login"; // Parent Route Name Eg. vrm-settings
    private $AllowedFile = null; //Set Default allowed file extension, remember you can pass this upon upload to override default allowed file type. jpg|jpeg|png|doc|docx|

    private $New = ''; // New
    private $Save = 'vrm-login/access'; // Add New
    private $Edit = ''; // Edit
    private $Update = ''; // Update
    private $Delete = ''; // Delete
    private $Action = ''; // Multiple Entry Action

    private $HeaderName = ""; // (Optional) Name

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        //

    }

    /**
     * Global Settings {loadSettings}
     * Method is private and not accessible via the web
     * Todo: This method Load all settings from database via the PreLoad Model:: getSettings()
     *
     * @param optional $view_name (string) Page Name (make sure to add $ThemePath/$MainFolder/$SubFolder/$page_name)
     *
     * @return \Illuminate\Http\Response
     */
    private function loadSettings($view_name = '')
    {
        // Load in Controller Settings from passedSettings method
        $passed = $this->passedSettings();

        //openLoad settings
        $settings = Setting::adminLoad($view_name, $passed);

        // Return all settings
        return $settings;
    }

    /**
     * Custom Settings {passedSettings}
     * Method is private and not accessible via the web
     * Todo: This method Load all settings for this Controller only
     *
     * @param optional $addtionalData (array) any additional data to be passed on demand
     *
     * @return \Illuminate\Http\Response
     */
    private function passedSettings($addtional_data = [])
    {
        date_default_timezone_set('Africa/Nairobi'); //Time Zone
        $setting['dateTime'] = strtotime(date('Y-m-d, H:i:s')); //Current DateTime

        // Links
        $setting['links'] = (object)[
            'new' => $this->New,
            'save' => $this->Save,
            'edit' => $this->Edit,
            'update' => $this->Update,
            'delete' => $this->Delete,
            'manage' => $this->Action,
            'route' => $this->ParentRoute,
        ];

        // Other
        $setting['other'] = (object)[
            'headerName' => (!array_key_exists('headerName', $addtional_data)) ? $this->HeaderName : $addtional_data['headerName'],
        ];
        $setting['breadcrumb'] = [];

        // Merge all settings into one array
        $setting = array_merge($setting, $addtional_data);

        // Return all settings
        return $setting;
    }

    /**
     * Page View {show}
     * Method is private and not accessible via the web
     * Todo: This method is the only method that is accessible render the view/page visible via browser.
     *
     * @param  requred $data - (has all the values needed to render the page)
     * @param  optional $layout - (By default the layout is main)
     *
     * @return \Illuminate\Http\Response
     */
    private static function show($data, $layout = 'log')
    {
        // Add Layout
        $data['layoutName'] = $layout;

        //Load Page View
        return view("vrm-admin/pages/" . $data['page_name'], $data);
    }

    /**
     * Main {Index}
     * Method is public and accessible via the web
     * Todo: This method is the main settings page.
     *
     * @param  optional  $message - notification message (By default, no message is displayed)
     *
     * @return \Illuminate\Http\Response
     */
    public function index($message = '')
    {
        // Load View Page Path
        $view = 'login';
        $page = Str::plural($this->MainFolder) . $this->SubFolder .  "/$view";

        // Load Settings
        $data = $this->loadSettings($page);
        $data['other']->view = $view;

        //Notification
        $notify = Notify::notify();
        $data['notify'] = Notify::$notify($message);

        //Open Page
        return $this->show($data);
    }

    /**
     * Page {open}
     * Method is public and accessible via the web
     * @Todo:
     * This method is used to open a specific view/page (you can pass the view name/full_path and open will call show() method to render the view/page)
     *
     * @param required $view - (the view name/full_path to be rendered)
     * @param  optional $message - notification message (By default, no message is displayed)
     * @param  optional $layout - (By default the layout is main)
     *
     * @return \Illuminate\Http\Response
     */
    public function open($view, $message = '', $layout = 'log')
    {
        // Load View Page Path
        $page = Str::plural($this->MainFolder) . "/" . $this->SubFolder . $view;

        // Load Settings
        $data = $this->loadSettings($page);
        $data['other']->view = $view;

        //Notification
        $notify = Notify::notify();
        $data['notify'] = Notify::$notify($message);

        //Open Page
        return $this->show($data, $layout);
    }

    /**
     * Validation {valid}
     * Method is public and accessible via the web
     * Todo: This method is used to validate the form data.
     *
     * @param  \Illuminate\Http\Request  $request - (the request object)
     * @param  required $action - (what option to validate)
     *
     * @return \Illuminate\Http\Response
     */
    public function valid(Request $request, $action = '')
    {
        $allowed_files = (is_null($this->AllowedFile)) ? 'jpg|jpeg|png|doc|docx|pdf|xls|txt' : $this->AllowedFile; //Set Allowed Files
        $upoadDirectory = $this->Upload . "/"; //Upload Location

        //Check Validation
        if ($action == 'access') {

            // Validate Form Data
            $validator = Validator::make($request->all(), [
                'logname' => "required|max:200",
                'password' => "required|min:2|max:50",
                // Add remember should be string with max 5 characters
                'remember' => "max:5",
            ]);

            // On Validation Fail
            if ($validator->fails()) {
                session()->flash('notification', 'valid');
                $error = Notify::error('Please check the form for errors.');

                // Return Error Message
                return redirect()->back()->withErrors($validator)->withInput($request->input());
            }

            // Validate Form Data
            $validated = $validator->validated();
            // Message
            $message = 'Something went wrong.';

            // Log User
            $logged = $this->logUser($validated);

            if ($logged == 'success') {

                // Redirect to Dashboard
                return redirect()->route('vrm-dashboard');
            } else {
                // Show error message depending with wrong password, wrong email or account not activated
                if ($logged == 'account') {
                    $message = 'Your account is not activated/suspended, please check your email for activation link.';
                } elseif ($logged == 'password') {
                    $message = 'Wrong password, please try again.';
                }
            }

            // Notification
            session()->flash('notification', 'error');

            // Open Page
            return $this->open('login', $message);
        } else {

            // Notification
            session()->flash('notification', 'info');

            // Open Page
            return $this->index('<strong>Info:</strong> Vormia failed to respond, unknown request.');
        }
    }

    /**
     * Todo: Logout User
     */
    public function logout()
    {
        // Clear the user's session and forget the 'session_id' cookie
        $sessionid = session()->get('id');

        // Logout
        session()->forget('user');
        session()->forget('level');
        session()->forget('logged');
        session()->forget('last_activity');
        $cookie = cookie()->forget($sessionid);

        // Redirect the user to the login page
        return redirect()->route('vrm-login');
    }

    /**
     * Save {store}
     * Method is private and not accessible via the web
     * Todo: This method is used to save the form data. It utilizes the valid() method to validate the form data and Vormia\Setting Model
     *
     * @param  array $formData
     *
     * @return \Illuminate\Http\Response
     * - Success (True) or Failed (False)
     */
    private function logUser($formData)
    {
        // Check if remember key exist
        (array_key_exists('remember', $formData)) ? $remember = true : $remember = false;

        // Check if logname is an email
        (filter_var($formData['logname'], FILTER_VALIDATE_EMAIL)) ?  $log['email'] = $formData['logname'] : $log['username'] = $formData['logname'];
        // Active
        $log['flag'] = 1;

        // Check if Account exist
        if (User::where($log)->exists()) {
            // You can do something here, like retrieve the user object
            $user = User::where($log)->first();
            // $user->makeVisible(['password']);

            // Check if password is correct
            if (Hash::check($formData['password'], $user->password)) {
                // The email and password are correct, create a session and set a cookie
                $sessionId = Str::random(40);

                // Create Session
                session()->put('id', $sessionId);
                session()->put('user', $user->id);
                session()->put('level', $user->level);
                session()->put('logged', true);
                session()->put('last_activity', Carbon::now());

                // Remember
                ($remember) ? cookie('logged', $sessionId, 60 * 24 * 7) : '';
                // Return Success
                return 'success';
            }
            // Return Wrong Password
            return 'password';
        }

        // return
        return 'account';
    }
}
