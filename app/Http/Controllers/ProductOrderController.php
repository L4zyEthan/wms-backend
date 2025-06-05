<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Transaction;
use Illuminate\Http\Request;
use App\Models\ProductOrder;

class ProductOrderController extends Controller
{
    public function index()
    {
        if (!request()->user()->can('index transactions')) {
            return $this->Forbidden();
        }

        $productOrders = ProductOrder::with('store', 'transactionType', 'products')->paginate(10);

        if ($productOrders->isEmpty()) {
            return $this->NotFound("No orders found.");
        }

        return $this->Success($productOrders);
    }

    public function store(Request $request)
    {
        $validator = validator()->make($request->all(), [
            "store_id" => "required|exists:stores__outlets,id",
            "transaction_type_id" => "required|exists:transaction__types,id",
            "products" => "required|array",
            "products.*" => "array",
            "products.*.product_id" => "required|exists:products,id",
            "products.*.quantity" => "required|numeric|min:0.01|max:1000000",
            "note" => "nullable|string|max:255",
        ]);
        
        if($validator->fails()){
            return $this->BadRequest($validator);
        }
        
        // Save to product_orders table
        $orderData = [
            'store_id' => $request->store_id,
            'transaction_type_id' => $request->transaction_type_id,
            'note' => $request->note,
            'user_id' => $request->user()->id,
        ];
        $productOrder = ProductOrder::create($orderData);
        
        // Prepare products for pivot table and calculate total price
        $items = [];
        $total = 0;
        foreach ($request->products as $product) {
            $price = Product::find($product['product_id'])->price ?? 0;
            $items[$product['product_id']] = [
                'quantity' => $product['quantity'],
                'price' => $price
            ];
            $total += $price * $product['quantity'];
        }
        // Save to product_productorders pivot table
        $productOrder->products()->sync($items);
        $productOrder->total_transaction_price = $total;
        $productOrder->save();

        return $this->Created($productOrder->load('products'), 'Product order created successfully.');
    }

    public function show($id)
    {
        if (!request()->user()->can('view transaction')) {
            return $this->Forbidden();
        }

        $productOrder = ProductOrder::with('store', 'transactionType', 'products')->find($id);

        if (empty($productOrder)) {
            return $this->NotFound();
        }

        return $this->Success($productOrder);
    }

    public function update(Request $request, $id)
    {
        if (!request()->user()->can('update transaction')) {
            return $this->Forbidden();
        }

        $productOrder = ProductOrder::find($id);
        if (empty($productOrder)) {
            return $this->NotFound();
        }

        $validator = validator()->make($request->all(), [
            "store_id" => "sometimes|exists:stores__outlets,id",
            "transaction_type_id" => "sometimes|exists:transaction__types,id",
            "products" => "sometimes|array",
            "products.*" => "array",
            "products.*.product_id" => "sometimes|exists:products,id",
            "products.*.quantity" => "sometimes|numeric|min:0.01|max:1000000",
            "note" => "nullable|string|max:255",
        ]);

        if ($validator->fails()) {
            return $this->BadRequest($validator);
        }

        $productOrder->update($validator->validated());

        $total = $productOrder->total_transaction_price;
        if (isset($request['products'])) {
            $items = [];
            $total = 0;
            foreach ($request['products'] as $product) {
                $price = Product::find($product['product_id'])->price ?? 0;
                $items[$product['product_id']] = [
                    'quantity' => $product['quantity'],
                    'price' => $price
                ];
                $total += $price * $product['quantity'];
            }
            $productOrder->products()->sync($items);
        }
        $productOrder->total_transaction_price = $total;
        $productOrder->save();

        return $this->Success($productOrder->load('products'), 'Product order updated successfully.');
    }

    public function destroy($id)
    {
        if (!request()->user()->can('delete transaction')) {
            return $this->Forbidden();
        }

        $productOrder = ProductOrder::find($id);
        if (empty($productOrder)) {
            return $this->NotFound();
        }

        $productOrder->products()->detach();
        $productOrder->delete();

        return $this->Success($productOrder, 'Product order deleted successfully.');
    }

    public function checkOut(Request $request,$id)
    {
        $productOrder = ProductOrder::with('products')->find($id);
        if (empty($productOrder)) {
            return $this->NotFound();
        }

        // Create a new transaction
        $transaction = new Transaction();
        $transaction->user_id = $request->user()->id;
        $transaction->store_id = $productOrder->store_id;
        $transaction->transaction_type_id = $productOrder->transaction_type_id;
        $transaction->total_transaction_price = $productOrder->total_transaction_price;
        $transaction->status_id = 1; // or set as needed
        $transaction->save();

        // Attach products to the transaction
        $items = [];
        foreach ($productOrder->products as $product) {
            $items[$product->id] = [
                'quantity' => $product->pivot->quantity,
                'price' => $product->pivot->price
            ];
        }
        $transaction->products()->sync($items);

        $productOrder->delete();

        return $this->Success($transaction->load('products'), 'Product order transferred to transaction successfully.');
    }
}
