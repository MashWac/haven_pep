<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\AchievementsModel;
use App\Models\InstructorModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class myProfileController extends Controller
{
    public function index()
    {
        $data['instructor'] = InstructorModel::first();
        $data['achievements'] = AchievementsModel::where('instructor_id', $data['instructor']->id)->get();
        return view('admin.my_profile.index', compact('data'));
    }
    public function update(Request $request, $id)
    {
        // Validate the request
        $validator = Validator::make($request->all(), [
            'full_name' => 'required|string|max:255',
            'job_title' => 'nullable|string|max:255',
            'email_address' => 'required|email|max:255|unique:App\Models\InstructorModel,email_address,' . $id.',id',
            'phone_number' => 'nullable|string|max:20',
            'bio' => 'nullable|string',
            'profile_photo' => 'nullable|image|mimes:jpeg,jpg,png|max:2048',
            'instagram_url' => 'nullable|url|max:255',
            'facebook_url' => 'nullable|url|max:255',
            'achievements' => 'nullable|array|max:4',
            'achievements.*.achievement' => 'required_with:achievements|string|max:255',
            'achievements.*.icon' => 'required_with:achievements|string|max:50',
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        // Find the instructor
        $instructor = InstructorModel::findOrFail($id);

        // Handle profile photo upload
        if ($request->hasFile('profile_photo')) {
            $file = $request->file('profile_photo');
            $ext = $file->getClientOriginalExtension();
            $filename = time() . '.' . $ext;
            $filepath = '/assets/instructors/photos' . $filename;
            $path = Storage::disk('public')->put($filepath, file_get_contents($file));
            $path = Storage::url($filepath);
            $instructor->image = $path;
        }

        // Update instructor details
        $instructor->full_name = $request->full_name;
        $instructor->job_title = $request->job_title;
        $instructor->email_address = $request->email_address;
        $instructor->phone_number = $request->phone_number;
        $instructor->about_me = $request->bio;
        $instructor->instagram_url = $request->instagram_url;
        $instructor->facebook_url = $request->facebook_url;

        // Handle achievements
        if ($request->has('achievements')) {
            AchievementsModel::where('instructor_id', $id)->delete();
            AchievementsModel::insert(
                collect($request->achievements)
                    ->filter(fn($a) => !empty($a['achievement']) && !empty($a['icon']))
                    ->map(fn($a) => [
                        'instructor_id' => $id,
                        'achievement' => $a['achievement'],
                        'icon' => $a['icon'],
                    ])
                    ->values()
                    ->toArray()
            );
        }

        $instructor->save();

        return redirect()->back()
            ->with('success', 'Instructor profile updated successfully!');
    }
}
