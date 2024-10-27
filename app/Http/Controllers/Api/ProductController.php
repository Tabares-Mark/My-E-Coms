<?php

namespace App\Http\Controllers\Api;

use App\Models\Product;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\ProductResource;
use Illuminate\Support\Facades\Validator;

class ProductController extends Controller{
    //for searching products
    public function search(Request $request)
{
    // Get the search term from the query parameter
    $searchTerm = $request->query('q');

    // Fetch products that match the search term (in name or description)
    $products = Product::where('name', 'LIKE', '%' . $searchTerm . '%')
                        ->orWhere('description', 'LIKE', '%' . $searchTerm . '%')
                        ->orWhere('category', 'LIKE', '%' . $searchTerm . '%')
                        ->get();

    // If products are found, return them, otherwise return a message
    if ($products->count() > 0) {
        return ProductResource::collection($products);
    } else {
        return response()->json(['message' => 'No products found'], 200);
    }
}
    
    //return all the Products based on its ID number
    public function index(){
        $products = Product::get();

        if($products->count() > 0) {
          return ProductResource::collection($products);  
        } 
        else {
            return response()->json(['message'=> 'no products yet'], 200);
        }

    }

    //return all the products in ascending order based on prince
    public function AscendingByPrice(){
        $products = Product::orderBy('price', 'asc')->get();
    
        if($products->count() > 0) {
            return ProductResource::collection($products);
        } 
        else {
            return response()->json(['message'=> 'No products found'], 200);
        }
    }
    //return all the products in descending order based on price
    public function DescendingByPrice(){
        $products = Product::orderBy('price', 'desc')->get();
    
        if($products->count() > 0) {
            return ProductResource::collection($products);
        } 
        else {
            return response()->json(['message'=> 'No products found'], 200);
        }
    }
    

   //return the list of categories
   public function getCategories() {
    // Fetch distinct categories
    $categories = Product::select('category')->distinct()->get();

    if ($categories->count() > 0) {
        return response()->json($categories);
    } else {
        return response()->json(['message' => 'No categories found'], 200);
    }
}
    //return products based on category
     public function ProductsByCategory($category){
        $products = Product::where('category', $category)->get();
    
        if($products->count() > 0) {
            return ProductResource::collection($products);
        } 
        else {
            return response()->json(['message'=> 'No products found for this category'], 200);
        }
    }


    //create a product
    public function store(Request $request){

   $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'price' => 'required|integer',
            'quantity' => 'required|integer',
            'category' => 'required|string|max:255',
            'description' => 'required',
            'barcode' => 'required|string|max:255',
            ]);


    if($validator->fails()){
    return response()->json(
        ['message'=> 'All fields are mandatory',
         'error' => $validator->messages()],
         422);
        }       

        $request->validate([
            'name' => 'required|string|max:255',
            'price' => 'required|integer',
            'quantity' => 'required|integer',
            'category' => 'required|string|max:255',
            'description' => 'required',
            'barcode' => 'required|string|max:255',
        ]);

       $product = Product::create([
            'name' => $request->name,
            'price' => $request->price,
            'quantity' => $request->quantity,
            'category' => $request->category,
            'description' => $request->description,
            'barcode' => $request->barcode
        ]);

        return response()->json([
            'message' => 'Product created successfully',
            'data' => new ProductResource($product) 
        ], 200);    
    }

    //show a spsific product based on ID
    public function show(Product $product){

        return new ProductResource($product);
        
    }
    //update details about the product
    public function update(Product $product, Request $request){

        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'price' => 'required|integer',
            'quantity' => 'required|integer',
            'category' => 'required|string|max:255',
            'description' => 'required',
            'barcode' => 'required|string|max:255',
            ]);


    if($validator->fails()){
    return response()->json(
        ['message'=> 'All fields are mandatory',
         'error' => $validator->messages()],
         422);
        }       

        $request->validate([
            'name' => 'required|string|max:255',
            'price' => 'required|integer',
            'quantity' => 'required|integer',
            'category' => 'required|string|max:255',
            'description' => 'required',
            'barcode' => 'required|string|max:255',
        ]);

       $product->update([
            'name' => $request->name,
            'price' => $request->price,
            'quantity' => $request->quantity,
            'category' => $request->category,
            'description' => $request->description,
            'barcode' => $request->barcode
        ]);

        return response()->json([
            'message' => 'Product Updated successfully',
            'data' => new ProductResource($product) 
        ], 200);    
    }

    //deletes a product
    public function destroy(Product $product){

        $product->delete();
        
        return response()->json([
            'message' => 'Product Deleted successfully',
        ], 200);    
    }
}
