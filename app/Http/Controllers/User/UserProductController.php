<?php

namespace App\Http\Controllers\User;

use App\Models\Product;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;
use App\Http\Controllers\Controller;

class UserProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('user.pages.product_list.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
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
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
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
                $edit_link = '<a title="View Details" href="' . route('user_product.edit', [$data->id]) . '" class="btn btn-primary btn-icon-text" style="padding: 0.375rem 0.75rem;font-size: 1rem;">' .
                'Add to Cart' .
                '</a>';

                return $edit_link ;
            })
            ->rawColumns(['actions','photo'])
            ->make(true);
    }
}
