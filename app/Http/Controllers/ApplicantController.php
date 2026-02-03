<?php

namespace App\Http\Controllers;

use App\Models\Job;
use App\Mail\JobApplied;
use App\Models\Applicant;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Illuminate\Http\RedirectResponse;

class ApplicantController extends Controller
{
    public function store(Request $request, Job $job): RedirectResponse
    {

        $existingApplication = Applicant::where('job_id', $job->id)->where('user_id', Auth::user()->id)->first();

        if ($existingApplication) {
            return redirect()->back()->with('error', 'You have already applied to this job');
        }

        $validatedData = $request->validate([
            "full_name" => "required|string",
            "contact_phone" => "string",
            "contact_email" => "required|string|email",
            "message" => "string",
            "location" => "string",
            "resume" => "required|file|mimes:pdf|max:2048"
        ]);

        if ($request->hasFile('resume')) {
            $path = $request->file('resume')->store('resumes', 'public');
            $validatedData['resume_path'] = $path;
        }

        $application = new Applicant($validatedData);

        $application->job_id = $job->id;
        $application->user_id = Auth::user()->id;
        $application->save();

        // Send email to owner
        Mail::to($job->user->email)->send(new JobApplied());

        return redirect()->back()->with('success','Your application has been submitted');

    }

    public function destroy( $id): RedirectResponse
    {
        $application = Applicant::findOrFail($id);
        $application->delete();
        return redirect()->route('dashboard')->with('success','Applicant deleted successfully');
    }
}