<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

use App\Models\Product;
use App\Models\category;

use Illuminate\Support\Carbon;

use Inertia\Inertia;

class AdminController extends Controller
{

    public function Dashboard(){
        return Inertia::render('Dashboard',[
            'products' => Product::select('products.*', 'categories.name as category')
                                ->join('categories', 'products.id', '=', 'categories.product_id')
                                ->orderBy('products.id', 'DESC')
                                ->get()
        ]);
    }

    public function PostLogin (Request $request) {

        $request->validate([
            'username' => ['required'],
            'password' => ['required']
        ]);

        if (Auth::guard('admin')->attempt(['username' => $request->username, 'password' => $request->password], $request->remember) ) {
            $request->session()->regenerate();
            return redirect()->intended('dashboard');
        } else {
            return back()->with('message','Invalid credentials');
        }

    }

    public function RegisterUser (Request $request){

        $request->validate([
            'username' => [ 'required', 'unique:admins', 'min:6' ],
            'password' => [ 'required', 'confirmed', 'min:6' ]
        ]);

        DB::table('admins')
        ->insert([
            'username' => $request->username,
            'password' => hash::make($request->password),
        ]);

        return redirect('/login')->with('snackbar', true);
    }

    public function Products (Request $request) {

        $products = Product::query()
                    ->when($request->filter, function($query, $filter){
                        $query->where('categories.name', '=', $filter);
                    });
                        
        return Inertia::render('Products', [
            'products' => $products->select('products.*', 'categories.name as category')
                                    ->join('categories', 'products.id', '=', 'categories.product_id')
                                    ->orderBy('products.id', 'DESC')
                                    ->paginate(5)
                                    ->withQueryString(),
            'category' => Category::select('name')->groupBy('name')->get()
        ]);
    }

    public function PostProduct (Request $request) {

        if($request->productDetails == 1){
            $request->validate(
                [
                    'name' => 'required',
                    'category' => 'required',
                    'description' => 'required'
                ]
            );
        } else if ($request->productDetails == 2){
            $request->validate(
                [
                    'image' => [ 'required', 'array' ],            
                    'image.*' => [ 'image' ],
                ]
            );
        } else if ($request->productDetails == 3){
            $request->validate(
                [
                    'date' => 'required'
                ]
            );
            $products = new Product();

            $products->name = $request->name;
            $products->description = $request->description;
            $products->date = Carbon::parse($request->date)->addDay()->format('Y-m-d');
            $products->save();

            $categories = new category();

            $categories->product_id = $products->id;
            $categories->name = $request->category;
            $categories->save();

            return redirect('/products')->with('snackbar', true);
        }
        
    }

    public function UpdateProduct (Request $request) {

        $request->validate([
            'name' => 'required',
            'category' => 'required',
            'description' => 'required',
            'date' => 'required'
        ]);

        $products = Product::find($request->id);

        $products->name = $request->name;
        $products->description = $request->description;
        $products->date = $request->date;
        $products->save();

        category::where('product_id', $products->id)
        ->update(['name' => $request->category]);

    }

    public function DeleteProduct ($id) {
        DB::table('categories')->where('product_id', $id)->delete();
        DB::table('products')->where('id', $id)->delete();
    }

    public function VideoPlayer($title){
        $video_url = "";
        if($title == 'sunflower'){
            $video_url = "/video_files/Sunflower.mp4";
        }else if($title == 'everLastingShine'){
            $video_url = "/video_files/Everlasting Shine.mp4";
        }else if($title == 'kaiKaiKitai'){
            $video_url = "/video_files/Kaikai Kitai Eve.mp4";
        }
        return Inertia::render('Videos', ['video_url' => $video_url]);
    }


    public function logout (Request $request) {
        Auth::guard('admin')->logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/login'); 
    }
}
