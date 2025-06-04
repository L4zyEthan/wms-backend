<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use App\Models\ProductOrder;

class ProductOrderController extends Controller
{
    public function index()
    {
        if (!request()->user()->can('index product orders')) {
            return $this->Forbidden();
        }

        $productOrders = ProductOrder::with('store', 'transactionType')->paginate(10);

        if ($productOrders->isEmpty()) {
            return $this->NotFound();
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
        if (!request()->user()->can('view product order')) {
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
        if (!request()->user()->can('update product order')) {
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
            "note" => "sometimes|string|max:255",
        ]);

        if ($validator->fails()) {
            return $this->BadRequest($validator);
        }

        $productOrder->update($validator->validated());

        $total = $productOrder->total_transaction_price;
        if ($request->has('products')) {
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
            $productOrder->products()->sync($items);
        }
        $productOrder->total_transaction_price = $total;
        $productOrder->save();

        return $this->Success($productOrder->load('products'), 'Product order updated successfully.');
    }

    public function destroy($id)
    {
        if (!request()->user()->can('delete product order')) {
            return $this->Forbidden();
        }

        $productOrder = ProductOrder::find($id);
        if (empty($productOrder)) {
            return $this->NotFound();
        }

        $productOrder->products()->detach();
        $productOrder->delete();

        return $this->Success(null, 'Product order deleted successfully.');
    }
}
