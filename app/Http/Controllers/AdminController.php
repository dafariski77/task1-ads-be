<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Report;
use App\Models\ReportTracker;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class AdminController extends Controller
{
    public function index()
    {
        if (request()->ajax()) {
            $reports = Report::all();

            return DataTables::of($reports)
                ->addIndexColumn()
                ->addColumn('action', function ($reports) {
                    return '<button class="btn btn-primary edit-button" data-id="' . $reports->id . '">Edit</button>';
                })
                ->addColumn('media', function ($report) {
                    $mediaLinks = '';

                    foreach ($report->getMedia('documents') as $media) {
                        $mediaLinks .= '<a href="' . $media->getUrl() . '" target="_blank">' . $media->name . '</a><br>';
                    }

                    return $mediaLinks;
                })
                ->rawColumns(['action', 'media'])
                ->make();
        }

        $categories = Category::all();

        return view('admin.dashboard', ["categories" => $categories, "route" => route('report.update'), "method" => "PATCH"]);
    }

    public function updateStatus(Request $request)
    {
        $id = $request->reportId;

        $report = Report::find($id);

        $report->update([
            "status" => $request->status,
            "category_id" => $request->category_id
        ]);

        ReportTracker::create([
            "user_id" => auth()->user()->id,
            "report_id" => $report->id,
            "status" => $report->status,
            "note" => $request->note
        ]);

        return redirect()->route('admin.dashboard');
    }
}
