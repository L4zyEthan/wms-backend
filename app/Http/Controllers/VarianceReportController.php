<?php

namespace App\Http\Controllers;

use App\Models\VarianceReport;
use Illuminate\Http\Request;

class VarianceReportController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        if (!request()->user()->can('index variance reports')) {
            return $this->Forbidden();
        }

        $varianceReports = VarianceReport::with('store')->paginate(30);

        if ($varianceReports->isEmpty()) {
            return $this->NotFound();
        }

        return $this->Success($varianceReports);
    }
}
