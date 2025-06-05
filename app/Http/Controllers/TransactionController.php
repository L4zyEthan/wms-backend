<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use App\Models\Transaction;

class TransactionController extends Controller
{
     /**
     * Display a listing of the resource.
     **/
    public function index()
    {
        if(!request()->user()->can('index transactions')){
            return $this->Forbidden();
        }

        $transactions = Transaction::with('transaction_type')->with('user')->with('store')->with('products')->get();
        // ✅ Convert product images to full URLs
    foreach ($transactions as $transaction) {
        foreach ($transaction->products as $product) {
            if (!empty($product->image)) {
                $product->image = asset($product->image);
            }
        }
    }

    return $this->Success($transactions);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        if(!request()->user()->can('create transaction')){
            return $this->Forbidden();
        }

        $validator = validator()->make($request->all(), [
            "store_id" => "required|exists:stores__outlets,id",
            "transaction_type_id" => "required|exists:transaction__types,id",
            "products" => "required|array",
            "products.*" => "array",
            "products.*.product_id" => "required|exists:products,id",
            "products.*.quantity" => "required|numeric|min:0.01|max:1000000",
            "products.*.flawed_quantity" => "nullable|numeric|min:0|max:1000000",
            "total_transaction_price" => "nullable|numeric|min:0|max:1000000",
            "note" => "nullable|string|max:255",
        ]);

        if($validator->fails()){
            return $this->BadRequest($validator);
        }

        $transactions = $request->user()->transactions()->create($validator->validated());
        $items = [];
        $total = 0;
        $products = Product::all();

        foreach ($request->products as $product) {
            $p = $products->where("id", $product["product_id"])->first(); 
            $items[$product["product_id"]] = [
                "price" => $p->price, 
                "quantity" => $product["quantity"],
                "flawed_quantity" => $product["flawed_quantity"]
            ];

            if ($p->stock < $product["quantity"]) {
                return $this->BadRequest("Not enough stock for product: " . $p->name);
            }

            if ($request->transaction_type_id == 1) {
                $p->stock = $p->stock + $product["quantity"];
                $p->flawed = ($p->flawed ?? 0) + $product["flawed_quantity"];
            } else {
                $p->stock = $p->stock - $product["quantity"];
                $p->flawed = ($p->flawed ?? 0) - $product["flawed_quantity"];
                
            }
            $total += $p->price * $product["quantity"];

            $p->save();
        }

        $transactions->total_transaction_price = $total;
        $transactions->save();

        $transactions->products()->sync($items);

        $transactions->products();

        return $this->Created($transactions->products, "Created", $transactions);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        if(!request()->user()->can('view transaction')){
            return $this->Forbidden();
        }

        $transactions = Transaction::find($id)->load('transaction_type', 'user', 'store', 'products');
        if(empty($transactions)){
            return $this->NotFound();
        }
         foreach ($transactions->products as $product) {
        if (!empty($product->image)) {
            $product->image = asset($product->image); // ✅ Fix image URL
        }
    }

        $transactions->products;

        return $this->Success($transactions);
    }

    public function update(Request $request, $id)
    {
        if(!request()->user()->can('create transaction')){
            return $this->Forbidden();
        }

        $transaction = Transaction::find($id);
        if (!$transaction) {
            return $this->NotFound();
        }
        $transaction->status_id = 2;
        $transaction->save();
        return $this->Success($transaction, 'Transaction status updated. This action cannot be undone.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
    if (!request()->user()->can('delete transaction')) {
        return $this->Forbidden();
    }

    $transactions = Transaction::with('products')->find($id);
    if (!$transactions) {
        return $this->NotFound();
    }

    $products = Product::all();

    foreach ($transactions->products as $product) {
        $p = $products->where("id", $product->id)->first();

        if ($transactions->transaction_type_id == 1) {
            $p->stock = $p->stock - $product->pivot->quantity;
        } else {
            $p->stock = $p->stock + $product->pivot->quantity;
        }

        $p->save();
    }

    $transactions->products()->detach();
    $transactions->delete();

    return $this->Success($transactions, "Transaction and related updates reversed successfully.");
    }
}