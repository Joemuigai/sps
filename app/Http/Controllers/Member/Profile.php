<?php

namespace App\Http\Controllers\Member;

use App\Models\User;
use Illuminate\Http\Request;
use App\Models\StudentMember;
use App\Http\Controllers\Controller;
use App\Models\StudentMemberFile;
use App\Models\StudentMemberPhoto;

class Profile extends Controller
{
    public function index()
    {
        $page_title = 'Member Profile';

        return view('members.profile', [
            'page_title' => $page_title,
        ]);
    }

    public function editProfile()
    {
        $userId = session('user_id');

        $student = StudentMember::where('user_id', $userId)->first();

        // Return a 404 response if the member was not found
        if (!$student) {
            abort(404);
        }

        $page_title = $student->first_name . ' ' . $student->last_name . ' :: Update Profile';

        return view('members.edit_profile', [
            'page_title' => $page_title,
            'student' => $student,
        ]);
    }

    public function updateProfile(Request $request, $id)
    {
        // Validate the user's inputs
        $request->validate([
            'student_id' => 'required|string|max:20',
            'expiry_date' => 'required|date',
            'national_id' => 'nullable|string|max:20',
            'passport_number' => 'nullable|string|max:20',
            'first_name' => 'required|string',
            'middle_name' => 'nullable|string',
            'last_name' => 'required|string',
            'email' => 'required|email',
            'disabled' => 'required|in:Yes,No',
            'mobile' => 'required|string|max:15',
            'address' => 'required|string',
            'course_faculty' => 'required|string|max:50',
            'mode_of_study' => 'required|in:Day,Evening',
            'passport_photo' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:4096',
            'student_id_copy' => 'nullable|mimes:pdf|max:4096',
            'national_id_copy' => 'nullable|mimes:pdf|max:4096',
        ]);


        $student_member = StudentMember::find($id);
        $student_member->student_id = $request->input('student_id');
        $student_member->expiry_date = $request->input('expiry_date');
        $student_member->national_id = $request->input('national_id');
        $student_member->passport_no = $request->input('passport_number');
        $student_member->first_name = $request->input('first_name');
        $student_member->middle_name = $request->input('middle_name');
        $student_member->last_name = $request->input('last_name');
        $student_member->email = $request->input('email');
        $student_member->disabled = $request->input('disabled');
        $student_member->mobile = $request->input('mobile');
        $student_member->address = $request->input('address');
        $student_member->course_faculty = $request->input('course_faculty');
        $student_member->mode_of_study = $request->input('mode_of_study');

        if ($student_member->save()) {

            // Update User Information based on user id
            $user = User::find($student_member->user_id);
            $user->first_name = $student_member->first_name;
            $user->last_name = $student_member->last_name;
            $user->username = $student_member->student_id;
            $user->email = $student_member->email;

            $user->save();

            // Store the passport photo if uploaded
            if ($request->hasFile('passport_photo')) {

                if ($request->hasFile('passport_photo') || $student_member->student_photo) {
                    $rules['passport_photo'] = 'required|image|mimes:jpeg,png,jpg,gif|max:4096';
                }

                $request->validate($rules);

                $photo = $request->file('passport_photo');
                $filename = $student_member->student_id . '.' . $photo->extension();
                $path = $photo->storeAs('passport_photos', $filename, 'public');

                // Check if the player already has a photo
                $studentPassportPhoto = StudentMemberPhoto::where('student_id', $student_member->id)->first();

                // If the member has an existing photo, update the path
                if ($studentPassportPhoto) {
                    $studentPassportPhoto->file_path = $path;
                    $studentPassportPhoto->file_name = $filename;
                    $studentPassportPhoto->save();
                } else {
                    // If the member does not have a photo, create a new entry
                    StudentMemberPhoto::create([
                        'student_id' => $student_member->id,
                        'file_path' => $path,
                        'disk' => 'public',
                        'file_type' => 'passport_photo',
                        'file_name' => $filename,
                    ]);
                }
            }


            // Store the id copy if uploaded
            if ($request->hasFile('student_id_copy')) {

                // if ($request->hasFile('student_id_copy') || $student_member->student_photo) {
                //     $rules['student_id_copy'] = 'required|mimes:pdf|max:4096';
                // }

                // $request->validate($rules);

                $file = $request->file('student_id_copy');
                $filename = $student_member->student_id . '_Student_ID_Copy.' . $file->extension();
                $path = $file->storeAs('student_id_copies', $filename, 'public');

                // Check if the player already has a student id copy uploaded
                $studentIdCopy = StudentMemberFile::where('student_id', $student_member->id)->where('file_type', 'student_id_copy')->first();

                // If the member has an existing photo, update the path
                if ($studentIdCopy) {
                    $studentIdCopy->file_path = $path;
                    $studentIdCopy->file_name = $filename;
                    $studentIdCopy->save();
                } else {
                    // If the member does not have a copy of student id, create a new entry
                    StudentMemberFile::create([
                        'student_id' => $student_member->id,
                        'file_path' => $path,
                        'disk' => 'public',
                        'file_type' => 'student_id_copy',
                        'file_name' => $filename,
                    ]);
                }
            }


            // Store the id copy if uploaded
            if ($request->hasFile('national_id_copy')) {

                // if ($request->hasFile('student_id_copy') || $student_member->student_photo) {
                //     $rules['student_id_copy'] = 'required|mimes:pdf|max:4096';
                // }

                // $request->validate($rules);

                $file = $request->file('national_id_copy');
                $filename = $student_member->student_id . '_National_ID_Copy.' . $file->extension();
                $path = $file->storeAs('national_id_copies', $filename, 'public');

                // Check if the player already has a national ID copy uploaded
                $nationalIdCopy = StudentMemberFile::where('student_id', $student_member->id)->where('file_type', 'national_id_copy')->first();

                // If the member has an existing photo, update the path
                if ($nationalIdCopy) {
                    $nationalIdCopy->file_path = $path;
                    $nationalIdCopy->file_name = $filename;
                    $nationalIdCopy->save();
                } else {
                    // If the member does not have a copy of student id, create a new entry
                    StudentMemberFile::create([
                        'student_id' => $student_member->id,
                        'file_path' => $path,
                        'disk' => 'public',
                        'file_type' => 'national_id_copy',
                        'file_name' => $filename,
                    ]);
                }
            }

        }


        // Return a success message
        $success_msg = $student_member->first_name . ' ' . $student_member->last_name . ' info has been updated successfully.';

        return redirect()->route('member.profile')->with('success', $success_msg);
    }
}
