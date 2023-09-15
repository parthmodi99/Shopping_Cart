<?php

namespace App\Http\Controllers\Admin;

use App\Models\Product;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Validator;

class ProductController extends Controller
{
    public function __construct()
    {
        $this->middleware('admin');
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('admin.pages.product.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.pages.product.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|max:30',
            'price' => 'required',
            'photo' => 'required|max:10000|mimes:jpg,jpeg,png',
            'description' => 'required|max:50',
        ]);

        if ($validator->fails()) {
            return response()->json(['success' => false, 'code' => 202, 'message' => implode("<br>", $validator->errors()->all())], 202);
        }

        $product = $request->all();

        if($request->hasFile('photo') && $request->file('photo')->isValid()) {
            $fileName = random_int(1000000000, 9999999999)  . '.png';
            $request->photo->storeAs('/public/'.'product_image', $fileName);

            $product['photo'] = 'product_image/'. $fileName;
        }

        $success = Product::create($product);

        if ($success) {
            return response()->json(['success' => true, 'message' => 'Product Added sucessfully.'], 200);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $product_details = Product::find($id);

        return view('admin.pages.product.edit', compact('product_details'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|max:30',
            'price' => 'required',
            'photo' => 'max:10000|mimes:jpg,jpeg,png',
            'description' => 'required|max:50',
        ]);

        if ($validator->fails()) {
            return response()->json(['success' => false, 'code' => 202, 'message' => implode("<br>", $validator->errors()->all())], 202);
        }

        $find_product = Product::find($id);

        $update_product = $request->all();

        if($request->hasFile('photo') && $request->file('photo')->isValid()) {

            $path = storage_path() . '/app/public/' . $find_product->photo;
            if (File::exists($path)) {
                unlink($path);
            }

            $fileName = random_int(1000000000, 9999999999)  . '.png';
            $request->photo->storeAs('/public/'.'product_image', $fileName);

            $update_product['photo'] = 'product_image/'. $fileName;
        }

        $success = Product::find($id)->update($update_product);

        if ($success) {
            return response()->json(['success' => true, 'message' => 'Product Updated sucessfully.'], 200);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Product $product)
    {
        $path = storage_path() . '/app/public/' . $product->photo;

        if (File::exists($path)) {
            File::delete($path);
        }

         if ($product->forceDelete()) {
             return response()->json(['success' => true, 'message' => 'Product has been deleted.', 'data' => []], 200);
         } else {
             return response()->json(['success' => false, 'message' => 'Something went wrong.', 'data' => []], 200);
         }
    }

    public function product_list()
    {
        $data = Product::latest()->get();

        return DataTables::of($data)
            ->addIndexColumn()
            ->addColumn('photo', function (Product $data) {
                if ($data->photo != '') {
                    $url = asset('storage/'. $data->photo);
                }
                return '<img src="'. $url .'" class="wi-50" align="center"  style="width: auto;height: 100px;"/>';
            })
            ->addColumn('actions', function (Product $data) {
                $edit_link = '<a title="View Details" href="' . route('admin.product.edit', [$data->id]) . '" class="btn btn-primary btn-icon-text" style="padding: 0.375rem 0.75rem;font-size: 1rem;">' .
                'Edit' .
                '</a>';

                $delete_link = '<a title="Delete Doctor" href="' . route('admin.product.destroy', [$data->id]) . '" class="delete-link btn btn-danger btn-icon-text" style="padding: 0.375rem 0.75rem;font-size: 1rem;">' .
                'Delete' .
                '</a>';

                return $edit_link . ' ' . $delete_link;
            })
            ->rawColumns(['actions','photo'])
            ->make(true);
    }
}
