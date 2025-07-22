<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Complain;
use App\Models\Year;
use Illuminate\Support\Facades\DB;
use Barryvdh\DomPDF\Facade\Pdf;

use Mpdf\Mpdf;



class ComplainController extends Controller
{
    public function showForm()
    {
        $years = Year::where('is_published', true)->orderByDesc('title')->get();
        return view('complain.complaint_form', compact('years'));
    }



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
            'year_id' => 'required|exists:years,id',
        ]);

        if ($request->hasFile('uploaded_file')) {
            $filePath = $request->file('uploaded_file')->store('complaints', 'public');
            $validated['uploaded_file'] = $filePath;
        }

        DB::transaction(function () use (&$validated) {
            $lastSubmission = Complain::lockForUpdate()->max('submission_number') ?? 0;
            $validated['submission_number'] = $lastSubmission + 1;

            Complain::create($validated);
        });

        return redirect()->back()->with('success', 'उजुरी सफलतापूर्वक पेश गरियो।');
    }

    public function print($id)
    {
        $complaint = Complain::findOrFail($id);
        return view('complain.print', compact('complaint'));
    }


    // public function downloadPDF($id)
    // {
    //     $complaint = Complain::with('year')->findOrFail($id);

    //     $pdf = Pdf::loadView('complain.print', compact('complaint'))
    //         ->setPaper('A4', 'portrait')
    //         ->setOptions(['defaultFont' => 'DejaVu Sans']); // For Unicode (Nepali)

    //     return $pdf->download('complaint-'.$complaint->submission_number.'.pdf');
    // }


}
