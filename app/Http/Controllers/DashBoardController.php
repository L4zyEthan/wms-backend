<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DashBoardController extends Controller
{
    public function getAllStocks(){
        if(!request()->user()->can('index products')){
            return $this->Forbidden();
        }

        $totalStock = DB::table('products')->sum('stock');

        return $this->Success($totalStock, "Total stock: $totalStock");
    }

public function getAllLowStock(){
        if(!request()->user()->can('index products')){
            return $this->Forbidden();
        }

        $lowStock = DB::table('products')->where('stock', '<=', 20)->get();

        return $this->Success($lowStock, "Low stock products");
    }
public function getAllOutOfStock(){
        if(!request()->user()->can('index products')){
            return $this->Forbidden();
        }

        $outOfStock = DB::table('products')->where('stock', '=', 0)->get();

        return $this->Success($outOfStock, "Out of stock products");
    }


    public function getTopFour(){
        if(!request()->user()->can('index transactions')){
            return $this->Forbidden();
        }

        $topProducts = DB::table('transactions')
    ->join('product_transaction', 'transactions.id', '=', 'product_transaction.transaction_id')
    ->join('products', 'product_transaction.product_id', '=', 'products.id')
    ->where('transactions.transaction_type_id', 2)
    ->select([
        'products.name as product_name',
        DB::raw('SUM(product_transaction.quantity) as total_quantity')
    ])
    ->groupBy('products.name')
    ->orderByDesc('total_quantity')
    ->limit(4)
    ->get();

    return $this->Success($topProducts, "Top 4 products sold");

    }

    public function getMonthlyReport(Request $request)
    {
        if(!request()->user()->can('index transactions')){
            return $this->Forbidden();
        }

        $monthlyMovements = DB::table('transactions')
            ->select([
                DB::raw("YEAR(transactions.created_at) as year"),
                DB::raw("LPAD(MONTH(transactions.created_at), 2, '0') as month"),
                DB::raw("COUNT(*) as total_transactions"),
                DB::raw("SUM(CASE WHEN transaction_type_id = 1 THEN 1 ELSE 0 END) as inbound_transactions"),
                DB::raw("SUM(CASE WHEN transaction_type_id = 2 THEN 1 ELSE 0 END) as outbound_transactions")
            ])
            ->groupBy('year', 'month')
            ->orderBy('year')
            ->orderBy('month')
            ->get();

        $result = [];
        foreach ($monthlyMovements as $row) {
            $result[$row->year][$row->month] = [
                'total_transactions' => $row->total_transactions,
                'inbound_transactions' => $row->inbound_transactions,
                'outbound_transactions' => $row->outbound_transactions,
            ];
        }

        foreach (array_keys($result) as $year) {
            for ($m = 1; $m <= 12; $m++) {
                $month = str_pad($m, 2, '0', STR_PAD_LEFT);
                if (!isset($result[$year][$month])) {
                    $result[$year][$month] = [
                        'total_transactions' => 0,
                        'inbound_transactions' => 0,
                        'outbound_transactions' => 0,
                    ];
                }
            }
            ksort($result[$year]);
        }
        ksort($result);

        return $this->Success($result, "Monthly movements by year");
    }

    public function getNumCategories()
    {
        if(!request()->user()->can('index categories')){
            return $this->Forbidden();
        }

        $numCategories = DB::table('categories')->count();

        return $this->Success($numCategories, "Total number of categories: $numCategories");
    }
    
    public function getNumLowStockProducts()
    {
        if(!request()->user()->can('index products')){
            return $this->Forbidden();
        }

        $numLowStock = DB::table('products')->where('stock', '<=', 20)->count();

        return $this->Success($numLowStock, "Total number of low stock products: $numLowStock");
    }

    public function getNumOutOfStockProducts()
    {
        if(!request()->user()->can('index products')){
            return $this->Forbidden();
        }

        $numOutOfStock = DB::table('products')->where('stock', '=', 0)->count();

        return $this->Success($numOutOfStock, "Total number of out of stock products: $numOutOfStock");
    }
}
