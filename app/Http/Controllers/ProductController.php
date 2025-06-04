<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;
use App\Models\Product;
use Illuminate\Support\Facades\DB;


class ProductController extends Controller
{
     /**
     * Display a listing of the resource by category.
     **/
    public function index()
    {
        if(!request()->user()->can('index products')){
            return $this->Forbidden();
        }

        $products = Product::with('category')->paginate(30);
         // ✅ Convert product images to full URLs
          foreach ($products as $product) {
            if ($product->image) {
            $product->image = asset($product->image);  
            }
          }
            return $this->Success($products);
        if ($products->isEmpty()) {
            return $this->NotFound();
        }
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        if(!request()->user()->can('create product')){
            return $this->Forbidden();
        }

        $inputs = $request->all();
    
        $inputs["name"] = $this->Sanitizer($inputs["name"]);

        $validator = validator()->make($request->all(), [
            "name" => "required|max:255|unique:products|string",
            "description" => "required|max:255|string",
            "price" => "required|numeric|max:999999999|min:0",
            "image" => "nullable|mimes:jpg,jpeg,png,jfif,webp|image|max:8192",
            "stock" => "nullable|integer|min:0",
            "barcode" => "required|string|max:255|unique:products",
            "category_id" => "required|exists:categories,id",
            "sku" => "required|string|max:255|unique:products,sku",
        ]);

        if($validator->fails()){
            return $this->BadRequest($validator);
        }

        $imageName = time().'.'.$request->image->extension();

        $request->image->move(public_path('/images/products/'),$imageName);

        $products = new Product();

        $products->name = $inputs["name"];
        $products->description = $inputs["description"];
        $products->price = $inputs["price"];
        $products->image = 'images/products/'.$imageName;
        $products->barcode = $inputs["barcode"];
        $products->stock = $inputs["stock"] ?? 0;
        $products->category_id = $inputs["category_id"];
        $products->sku = $inputs["sku"];
        $products->save();

        return $this->Created($products);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        if(!request()->user()->can('view product')){
            return $this->Forbidden();
        }
        $products = Product::find($id);
        if(empty($products)){
            return $this->NotFound();
        }

        $products->category;

        return $this->Success($products);
    }
    
    /**
     * Display the specified resource by category.
     */
    public function showByCategory(string $category_id)
    {
    $products = Product::with('category')->where('category_id', $category_id)->get();
    if ($products->isEmpty()) {
        return $this->NotFound();
    }

    return $this->Success($products);
    }

    /**
     * Update the specified resource in storage.
     */
public function update(Request $request, string $id)
{
    if(!request()->user()->can('update product')){
        return $this->Forbidden();
    }

    $products = Product::find($id);
    if(!$products){
        return $this->NotFound();
    }

    $inputs = $request->all();

    // Sanitize the name input.  Do this *before* checking if it is empty.
    if (isset($inputs["name"])) {
        $inputs["name"] = $this->Sanitizer($inputs["name"]);
    }


    $rules = [
        "name" => "sometimes|string|max:255|unique:products,name,$id",
        "description" => "sometimes|string|max:255",
        "price" => "sometimes|numeric|max:999999999|min:0",
        "barcode" => "sometimes|string|max:255|unique:products,barcode,$id",
        "category_id" => "sometimes|exists:categories,id",
        "sku" => "sometimes|string|max:255|unique:products,sku,$id",
    ];

    // Add image validation rules if a new image is being uploaded
    if ($request->hasFile('image')) {
        $rules['image'] = "required|mimes:jpg,jpeg,png,jfif,webp|image|max:8192";
    } else if ($request->input('image') === '') {
        // If the image field is explicitly set to empty (meaning remove image)
        $inputs['image'] = null; // Or however you want to represent a removed image in your DB
    }

    $validator = validator()->make($inputs, $rules);

    if($validator->fails()){
        return $this->BadRequest($validator);
    }

    $validatedData = $validator->validated();


    // Handle new image upload during update
    if ($request->hasFile('image')) {
        // Delete the old image if it exists (optional)
        if ($products->image && file_exists(public_path($products->image))) {
            unlink(public_path($products->image));
        }

        $imageName = time().'.'.$request->image->extension();
        $request->image->move(public_path('/images/products/'),$imageName);
        $validatedData['image'] = 'images/products/'.$imageName;
    }

    // Ensure we don't unset name if it's an empty string after sanitization
    if (isset($inputs['name']) && $inputs['name'] === '') {
        $validatedData['name'] = '';
    }

    $products->update($validatedData);
    return $this->Success($products);
}

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        if(!request()->user()->can('delete product')){
            return $this->Forbidden();
        }

        $products = Product::find($id);
        if(!$products){
            return $this->NotFound();
        }

        $products->delete();
        return $this->Success($products, "Deleted");
    }
}



