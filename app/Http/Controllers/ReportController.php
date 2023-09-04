<?php

namespace App\Http\Controllers;

use App\Http\Requests\ReportRequest;
use App\Models\ActivityLog;
use App\Models\Category;
use App\Models\Report;
use App\Models\Reporter;
use Spatie\Activitylog\Models\Activity;
use Yajra\DataTables\Facades\DataTables;

class ReportController extends Controller
{
    public function show(string $id)
    {
        $reports = Report::find($id);

        return response()->json([
            $reports
        ], 200);
    }

    public function create()
    {
        $categories = Category::all();
        return view('reports.form', ['route' => route('reports.store'), 'categories' => $categories]);
    }

    function generateTicketId()
    {
        $year = now()->year;
        $month = now()->format('m');
        $day = now()->format('d');

        $lastTicket = Report::latest('id')->first();

        $ticketNumber = $lastTicket ? (int)substr($lastTicket->ticket_id, -5) + 1 : 1;

        $ticketId = sprintf('%d%02d%02d%05d', $year, $month, $day, $ticketNumber);

        return $ticketId;
    }

    public function store(ReportRequest $request)
    {
        $validated = $request->validated();

        $ticketId = self::generateTicketId();

        $reporter = Reporter::create([
            "name" => $validated['name'],
            "email" => $validated['email'],
            "phone_number" => $validated['phone_number'],
            "identity_type" => $validated['identity_type'],
            "identity_number" => $validated['identity_number'],
            "pob" => $validated['pob'],
            "dob" => $validated['dob'],
            "address" => $validated['address'],
        ]);

        $report = Report::create([
            "reporter_id" => $reporter['id'],
            'title' => $validated['title'],
            'description' => $validated['description'],
            'ticket_id' => $ticketId
        ]);

        if ($request->hasFile('document') && $documents = $request->file('document')) {
            foreach ($documents as $doc) {
                $report->addMedia($doc)->toMediaCollection('documents');
            }
        }

        return redirect()->route('home');
    }

    public function reportLog()
    {
        if (request()->ajax()) {
            $logs = Activity::query();

            return DataTables::of($logs)->addIndexColumn()->make();
        }

        return view('admin.logs');
    }
}
