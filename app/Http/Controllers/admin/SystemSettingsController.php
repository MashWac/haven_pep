<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\systemSettingsModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class SystemSettingsController extends Controller
{
    public function index()
    {
        $system_settings = systemSettingsModel::all();
        return view('admin.system_settings.index', compact('system_settings'));
    }
    public function update(Request $request)
    {
        $settings = $request->input('settings', []);

        foreach ($settings as $id => $value) {

            $setting = SystemSettingsModel::find($id);

            if (!$setting || !$setting->editable) {
                continue;
            }

            // IMAGE SETTINGS
            if ($setting->setting_type === 'image') {

                if ($request->hasFile("settings.$id")) {

                    // delete old image
                    $file = $request->file("settings.$id");
                    $ext = $file->getClientOriginalExtension();
                    $filename = time() . '.' . $ext;
                    $filepath = '/assets/logo/' . $filename;
                    $path = Storage::disk('public')->put($filepath, file_get_contents($file));
                    $path = Storage::url($filepath);
                    $setting->image = $path;
                }
            }
            // TEXT / STRING / NUMBER
            else {
                $setting->setting_value = $value;
            }

            $setting->save();
        }

        return back()->with('success', 'System settings updated successfully.');
    }
}
