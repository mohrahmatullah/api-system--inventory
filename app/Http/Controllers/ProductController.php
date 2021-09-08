<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;
use Carbon\Carbon;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $category = Category::orderBy('name','ASC')
            ->get()
            ->pluck('name','id');

        $producs = Product::all();
        return response()->json($producs);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // $category = Category::orderBy('name','ASC')
        //     ->get()
        //     ->pluck('name','id');

        $this->validate($request , [
            'nama'          => 'required|string',
            'harga'         => 'required',
            'qty'           => 'required',
            'image'         => 'required',
            'category_id'   => 'required',
        ]);
        
        $input = $request->all();

        if (!empty($request->hasFile('image'))){
            $input['image'] = '/upload/products/'.str_slug($input['nama'], '-').'.'.$request->image->getClientOriginalExtension();
            $request->image->move(public_path('/upload/products/'), $input['image']);
        }

        Product::create($input);

        return response()->json([
            'success' => true,
            'message' => 'Products Created'
        ]);

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $category = Category::orderBy('name','ASC')
            ->get()
            ->pluck('name','id');
        $product = Product::find($id);
        return $product;
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $category = Category::orderBy('name','ASC')
            ->get()
            ->pluck('name','id');

        $this->validate($request , [
            'nama'          => 'required|string',
            'harga'         => 'required',
            'qty'           => 'required',
//            'image'         => 'required',
            'category_id'   => 'required',
        ]);

        $input = $request->all();
        $produk = Product::findOrFail($id);

        $input['image'] = $produk->image;

        if (!empty($request->hasFile('image'))){
            if (!$produk->image == NULL){
                unlink(public_path($produk->image));
            }
            $input['image'] = '/upload/products/'.str_slug($input['nama'], '-').'.'.$request->image->getClientOriginalExtension();
            $request->image->move(public_path('/upload/products/'), $input['image']);
        }

        $produk->update($input);

        return response()->json([
            'success' => true,
            'message' => 'Products Update'
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $product = Product::findOrFail($id);

        if (!$product->image == NULL){
            unlink(public_path($product->image));
        }

        Product::destroy($id);

        return response()->json([
            'success' => true,
            'message' => 'Products Deleted'
        ]);
    }

    public function reportStock(Request $req)
    {
        //one day (today)
        // $date1 = Carbon::now()->format('Y-m-d');
        $input = $req->all();        
        $day_c = Carbon::parse($input['day'])->format('Y-m-d');
        $day = (isset($day_c) ? $day_c : '');
        $product = Product::where('status', 1)
                    ->when($day, function($query, $day) {
                        return $query->where('created_at', '=', $day);
                        })
                    ->get();
        return response()->json($product);

        // $price_min = (isset($input['price_min']) ? $input['price_min'] : '');
        // $price_max = (isset($input['price_max']) ? $input['price_max'] : '');

        // $acidity_min = (isset($input['acidity_min']) ? $input['acidity_min'] : '');
        // $acidity_max = (isset($input['acidity_max']) ? $input['acidity_max'] : '');

        // $sweetness_min = (isset($input['sweetness_min']) ? $input['sweetness_min'] : '');
        // $sweetness_max = (isset($input['sweetness_max']) ? $input['sweetness_max'] : '');

        // $body_min = (isset($input['body_min']) ? $input['body_min'] : '');
        // $body_max = (isset($input['body_max']) ? $input['body_max'] : '');

        // // $category = (isset($input['category']) ? $input['category'] : '');
        // // $sub_category = (isset($input['sub_category']) ? $input['sub_category'] : '');

        // $all = (isset($input['sort']) && $input['sort'] == 'all' && !$input);
        // $terbaru = (isset($input['sort']) && $input['sort'] == 'terbaru');
        // $termahal = (isset($input['sort']) && $input['sort'] == 'termahal');
        // $termurah = (isset($input['sort']) && $input['sort'] == 'termurah');

        // $product = Product_Masuk::where('status',1)
        //         ->when($day, function($query, $day) {
        //                 return $query->where('created_at', '=', $day);
        //                 })
        //         get();

        // $get_post_data = DB::table('products')               
        //                 ->where('products.delete_status','0')
        //                 ->where('products.status','1')                        
        //                 ->select('products.*','terms.slug as slugcategory')
        //                 ->when($price_min, function($query, $price_min) {
        //                 return $query->where('products.price', '>=', $price_min);
        //                 })
        //                 ->when($price_max, function($query, $price_max) {
        //                 return $query->where('products.price', '<=', $price_max);
        //                 })
        //                 ->when($acidity_min, function($query, $acidity_min) {
        //                 return $query->where('products.acidity', '>=', $acidity_min);
        //                 })
        //                 ->when($acidity_max, function($query, $acidity_max) {
        //                 return $query->where('products.acidity', '<=', $acidity_max);
        //                 })
        //                 ->when($sweetness_min, function($query, $sweetness_min) {
        //                 return $query->where('products.sweetness', '>=', $sweetness_min);
        //                 })
        //                 ->when($sweetness_max, function($query, $sweetness_max) {
        //                 return $query->where('products.sweetness', '<=', $sweetness_max);
        //                 })
        //                 ->when($body_min, function($query, $body_min) {
        //                 return $query->where('products.body', '>=', $body_min);
        //                 })
        //                 ->when($body_max, function($query, $body_max) {
        //                 return $query->where('products.body', '<=', $body_max);
        //                 })
        //                 ->when($all, function($query, $all) {
        //                 return $query->orderBy('products.stock_qty', 'DESC');
        //                 })
        //                 ->when($terbaru, function($query, $terbaru) {
        //                 return $query->orderBy('products.created_at', 'DESC');
        //                 })
        //                 ->when($termahal, function($query, $termahal) {
        //                 return $query->orderBy('products.price', 'DESC');
        //                 })
        //                 ->when($termurah, function($query, $termurah) {
        //                 return $query->orderBy('products.price', 'ASC');
        //                 })
        //                 ->leftjoin('object_relationships', 'object_relationships.object_id', 'products.id')
        //                 ->leftjoin('terms','terms.term_id','object_relationships.term_id')
        //                 // ->when($category, function($query, $category) {
        //                 // return $query->where(['terms.slug' => $category, 'terms.type' => 'product_cat']);
        //                 // })
        //                 ->where(function($query) use ($input) {
        //                   if(isset($input['category'])){
        //                     if(isset($input['sub_category'])) {
        //                       $query->where(['terms.term_id' => $input['sub_category'], 'terms.type' => 'product_cat']);
        //                     }else{
        //                       $query->where(['terms.slug' => $input['category'], 'terms.type' => 'product_cat']);
        //                     }
        //                   }
        //                 })
        //                 ->paginate(12);

        // return $get_post_data;
    }
}
