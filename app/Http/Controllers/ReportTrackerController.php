<?php

namespace App\Http\Controllers;

use App\Models\ReportTracker;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class ReportTrackerController extends Controller
{
    public function index()
    {
        if (request()->ajax()) {
            $reportTrackers = ReportTracker::query();

            return DataTables::of($reportTrackers)
                ->addIndexColumn()
                ->make();
        }

        return view('admin.report-tracker');
    }
}
