<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Complain;

class ComplaintController extends Controller
{
    public function submit(Request $request)
    {
        // ✅ Validation: remove submission_number and status
        $data = $request->validate([
            'name_type' => 'required|in:individual,group',
            'name' => 'required|string',
            'gender' => 'required|in:male,female,third_gender,others',
            'age_group' => 'required|in:below_16,16_39,40_59,60_above',
            'contact_number' => 'required|string',
            'email' => 'nullable|email',
            'complaint_type' => 'required|in:corruption,illegal_property',
            'subject_of_complaint' => 'required|array',
            'corruption_domain' => 'required|in:province,local',
            'against_person_or_institution' => 'required|string',
            'additional_info' => 'nullable|string',
            'uploaded_file' => 'nullable|file|max:5120|mimes:jpeg,jpg,png,pdf,doc,avi,mp3,mp4,wav',
            'terms_accepted' => 'required|accepted',
        ]);

        // ✅ Handle file upload
        if ($request->hasFile('uploaded_file')) {
            $data['uploaded_file'] = $request->file('uploaded_file')->store('complaints');
        }

        // ✅ Encode subject_of_complaint array
        $data['subject_of_complaint'] = json_encode($request->subject_of_complaint);

        // ✅ Generate submission number
        $lastSubmission = Complain::max('submission_number') ?? 0;
        $data['submission_number'] = $lastSubmission + 1;

        // ✅ Set default status
        $data['status'] = 'Processing';

        // ✅ Save to database
        Complain::create($data);

        return redirect()->back()->with('success', 'Your complaint has been submitted. Your Submission Number is: ' . $complaint->submission_number);
    }

    public function index()
    {
        $complaints = Complain::all();
        return view('complaints.index', compact('complaints'));
    }
}
