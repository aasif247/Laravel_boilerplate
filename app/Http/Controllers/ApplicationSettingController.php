<?php

namespace App\Http\Controllers;

use App\Models\ApplicationSetting;
use Exception;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Redirector;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\ValidationException;
use Intervention\Image\Facades\Image;
use Log;

class ApplicationSettingController extends Controller
{
    private $location = 'panel.';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Display a listing of the resource.
     *
     * @return Application|Factory|View|Response
     */
    public function index()
    {
        return view($this->location . "settings");
    }

    /**
     * Update Current settings
     *
     * @param Request $request
     * @return Application|RedirectResponse|Redirector
     * @throws ValidationException
     */
    public function update(Request $request)
    {
        $this->validate($request, [
            'app_name' => 'required',
            'notification_sound' => 'required',
            'display_record_per_page' => 'required'
        ]);

        try {

            $app_settings = $request->only('app_name', 'notification_sound', 'display_record_per_page');

            // App settings updated
            foreach ($app_settings as $key => $setting) {
                $settings = ApplicationSetting::where('key', $key)->first();
                $settings->value = $setting;
                $settings->save();
            }

            // Logo Move and Insert
            if ($request->hasFile('logo_light')) {
                $logo_light_save = ApplicationSetting::where('key', 'logo_light')->first();

                // remove existing photo
                if (file_exists('uploads/settings/logo_light.png')) {
                    unlink('uploads/settings/logo_light.png');
                }
                $logo_light = $request->file('logo_light');
                $logo_light_name = 'logo_light.png';
                Image::make($logo_light)->resize(404, 83)->save(public_path('uploads/settings/') . $logo_light_name);

                $logo_light_save->value = 'uploads/settings/' . $logo_light_name;
                $logo_light_save->update();
            }

            // Logo Dark Move and Insert
            if ($request->hasFile('logo_dark')) {
                $logo_dark_save = ApplicationSetting::where('key', 'logo_dark')->first();

                // remove existing photo
                if (file_exists('uploads/settings/logo_dark.png')) {
                    unlink('uploads/settings/logo_dark.png');
                }

                $logo_dark = $request->file('logo_dark');
                $logo_dark_name = 'logo_dark.png';
                Image::make($logo_dark)->resize(404, 83)->save(public_path('uploads/settings/') . $logo_dark_name);

                $logo_dark_save->value = 'uploads/settings/' . $logo_dark_name;
                $logo_dark_save->save();
            }

            // No Image Move and Insert
            if ($request->hasFile('no_image')) {
                $no_image_save = ApplicationSetting::where('key', 'no_image')->first();

                // remove existing photo
                if (file_exists('uploads/settings/no_image.png')) {
                    unlink('uploads/settings/no_image.png');
                }

                $no_image = $request->file('no_image');
                $no_image_name = 'no_image.png';
                Image::make($no_image)->resize(500, 200)->save(public_path('uploads/settings/') . $no_image_name);

                $no_image_save->value = 'uploads/settings/' . $no_image_name;
                $no_image_save->save();
            }

            // Logo Small Move and Insert
            if ($request->hasFile('logo_sm')) {
                $logo_sm_save = ApplicationSetting::where('key', 'logo_sm')->first();

                // remove existing photo
                if (file_exists('uploads/settings/logo_sm.png')) {
                    unlink('uploads/settings/logo_sm.png');
                }

                $logo_sm = $request->file('logo_sm');
                $logo_sm_name = 'logo_sm.png';
                Image::make($logo_sm)->resize(77, 76)->save(public_path('uploads/settings/') . $logo_sm_name);

                $logo_sm_save->value = 'uploads/settings/' . $logo_sm_name;
                $logo_sm_save->save();
            }

            // Favicon Move and Insert
            if ($request->hasFile('favicon')) {
                $favicon_save = ApplicationSetting::where('key', 'favicon')->first();

                // remove existing photo
                if (file_exists('uploads/settings/favicon.png')) {
                    unlink('uploads/settings/favicon.png');
                }

                $favicon = $request->file('favicon');
                $favicon_name = 'favicon.png';
                Image::make($favicon)->resize(128, 128)->save(public_path('uploads/settings/') . $favicon_name);

                $favicon_save->value = 'uploads/settings/' . $favicon_name;
                $favicon_save->save();
            }

            DB::commit();

            return redirect('application/settings')->with(['message' => "Settings Update Successfully!", 'alert-type' => 'success']);

        } catch (Exception $exception) {
            Log::emergency("File:" . $exception->getFile() . "Line:" . $exception->getLine() . "Message:" . $exception->getMessage());

            return back()->with(['message' => "Something went wrong!", 'alert-type' => 'error']);
        }
    }
}
