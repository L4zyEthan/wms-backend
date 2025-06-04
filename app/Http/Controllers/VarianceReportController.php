<?php

namespace App\Http\Controllers;

use App\Models\Transaction;
use App\Models\VarianceReport;
use Illuminate\Http\Request;
use App\Models\Product;

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
            return $this->NotFound("No variance reports found.");
        }

        return $this->Success($varianceReports, "Variance reports retrieved successfully.");
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        if (!request()->user()->can('create variance report')) {
            return $this->Forbidden();
        }
        $validator = validator()->make($request->all(), [
            "store_id" => "required|exists:stores__outlets,id",
            "start_date" => "required|date",
            "end_date" => "required|date|after_or_equal:start_date",
            "physical_stock" => "required|numeric|min:0|max:1000000",
            "physical_sales" => "required|numeric|min:0|max:1000000",
        ]);
        if ($validator->fails()) {
            return $this->BadRequest($validator);
        }

        $inputs = $validator->validated();
        $inputs["user_id"] = $request->user()->id;
        $inputs["store_id"] = $request->store_id;
        $inputs["start_date"] = $this->Sanitizer($inputs["start_date"]);
        $inputs["end_date"] = $this->Sanitizer($inputs["end_date"]);

        $inputs["physical_stock"] = $this->Sanitizer($inputs["physical_stock"]);
        $inputs["system_stock"] = Product::sum('stock');
        $inputs["stock_difference"] = $inputs["physical_stock"] - $inputs["system_stock"];

        $inputs["physical_sales"] = $this->Sanitizer($inputs["physical_sales"]);
        $inputs["system_sales"] = Transaction::whereBetween('created_at',[$inputs["start_date"],$inputs["end_date"]])->sum('total_transaction_price');
        $inputs["sales_difference"] = $inputs["physical_sales"] - $inputs["system_sales"];
        
        $variancereport = $request->user()->varianceReports()->create($inputs);
        return $this->Success($variancereport, "Variance report created successfully.");
    }

    /**
     * Display the specified resource.
     */ 
    public function show($id){
        if (!request()->user()->can('show variance report')) {
            return $this->Forbidden();
        }
        $varianceReport = VarianceReport::with('store')->find($id);
        if (!$varianceReport) {
            return $this->NotFound();
        }
        return $this->Success($varianceReport, "Variance report retrieved successfully.");
    }
}
