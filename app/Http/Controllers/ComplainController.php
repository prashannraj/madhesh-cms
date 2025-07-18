<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Complain; // Assuming you have a Complaint model
use App\Models\Year;
use Illuminate\Support\Facades\DB;

class ComplainController extends Controller
{
    //
    // public function submit(Request $request)
    // {
    //     $validated = $request->validate([
    //         'name_type' => 'required|string',
    //         'name' => 'required|string',
    //         'gender' => 'required|string',
    //         'age_group' => 'required|string',
    //         'contact_number' => 'required|string',
    //         'email' => 'nullable|email',
    //         'complaint_type' => 'required|string',
    //         'subject_of_complaint' => 'required|string',
    //         'corruption_domain' => 'nullable|string',
    //         'against_person_or_institution' => 'required|string',
    //         'additional_info' => 'nullable|string',
    //         'uploaded_file' => 'nullable|file|max:5120',
    //         'terms_accepted' => 'required|accepted',
    //     ]);

    //     $complaint = new Complain();
    //     $complaint->submission_number = Complain::max('id') + 1;
    //     $complaint->name_type = $request->name_type;
    //     $complaint->name = $request->name;
    //     $complaint->gender = $request->gender;
    //     $complaint->age_group = $request->age_group;
    //     $complaint->contact_number = $request->contact_number;
    //     $complaint->email = $request->email;
    //     $complaint->complaint_type = $request->complaint_type;
    //     $complaint->subject_of_complaint = $request->subject_of_complaint;
    //     $complaint->corruption_domain = $request->corruption_domain;
    //     $complaint->against_person_or_institution = $request->against_person_or_institution;
    //     $complaint->additional_info = $request->additional_info;

    //     if ($request->hasFile('uploaded_file')) {
    //         $file = $request->file('uploaded_file');
    //         $filename = time() . '_' . $file->getClientOriginalName();
    //         $file->storeAs('complaints', $filename, 'public');
    //         $complaint->uploaded_file = $filename;
    //     }

    //     $complaint->status = 'Processing';
    //     $complaint->save();

    //     return back()->with('success', 'तपाईंको उजुरी सफलतापूर्वक दर्ता गरिएको छ।');
    // }

    public function submit(Request $request)
    {
        $validated = $request->validate([
            'name_type' => 'required|string',
            'name' => 'required|string|max:255',
            'gender' => 'required|string',
            'age_group' => 'required|string',
            'contact_number' => 'required|string|max:20',
            'email' => 'nullable|email',
            'complaint_type' => 'required|string',
            'subject_of_complaint' => 'required|string',
            'corruption_domain' => 'required_if:complaint_type,corruption',
            'against_person_or_institution' => 'required|string|max:255',
            'additional_info' => 'nullable|string',
            'uploaded_file' => 'nullable|file|max:5120',
            'terms_accepted' => 'required|accepted',
        ]);

        if ($request->hasFile('uploaded_file')) {
            $filePath = $request->file('uploaded_file')->store('complaints', 'public');
            $validated['uploaded_file'] = $filePath;
        }

        // 3. Use transaction to safely generate submission_number
            DB::transaction(function () use (&$validated) {
                // Lock the table for update to avoid race conditions
                $lastSubmission = Complain::lockForUpdate()->max('submission_number') ?? 0;
                $validated['submission_number'] = $lastSubmission + 1;

                // Save the complaint
                Complain::create($validated);
            });

        return redirect()->back()->with('success', 'उजुरी सफलतापूर्वक पेश गरियो।');
    }


    public function showForm()
    {
        // is_publish = true भएका वर्षहरू ल्याउने
        $years = Year::where('is_publish', true)->orderByDesc('year')->get();

        // view मा $years पास गर्दै
        return view('complain.complaint_form', compact('years'));
    }

}
