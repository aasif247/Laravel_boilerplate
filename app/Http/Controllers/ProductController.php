<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use Exception;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Redirector;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\ValidationException;
use Intervention\Image\Facades\Image;
use Yajra\DataTables\Facades\DataTables;

class ProductController extends Controller
{
    // View Location
    private $location = 'panel.products.';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Display a listing of the resource.
     *
     * @param Request $request
     * @return Application|Factory|View|Response
     * @throws Exception
     */
    public function index(Request $request)
    {
        $users = DB::table('users')->pluck('name', 'id');
        $categories = DB::table('categories')->where('status', 1)->pluck('category_name', 'id');

        if ($request->ajax()) {
            $products = DB::table('products')
                ->leftJoin('categories', 'categories.id', '=', 'products.category_id')
                ->leftJoin('users', 'users.id', '=', 'products.created_by')
                ->select('products.*', 'users.name', 'categories.category_name')
                ->orderByDesc('products.id');

            return DataTables::of($products)
                ->filter(function ($query) use ($request) {
                    if ($request->has('status') && $request->status != 'all') {
                        $query->where('products.status', $request->status);
                    }
                    if ($request->has('category_id') && $request->category_id != 'all') {
                        $query->where('products.category_id', $request->category_id);
                    }
                    if ($request->has('created_by') && $request->created_by != 'all') {
                        $query->where('products.created_by', $request->created_by);
                    }
                    if (!empty(request()->start_date) && !empty(request()->end_date)) {
                        $start = $request->start_date;
                        $end = $request->end_date;
                        $query->whereDate(DB::raw('DATE(products.created_at)'), '>=', $start)
                            ->whereDate(DB::raw('DATE(products.created_at)'), '<=', $end);
                    }
                })
                ->addColumn('action', function ($product) {
                    if ($product->status == 1) {
                        $html = '<a data-tname="product_datatable" data-href="' . route('product.status', ['product_id' => $product->id, 'status' => 0]) . '" class="btn btn-xs btn-warning me-1 rounded status_change_button" title="Make Inactive"> <i class="fe-arrow-down"></i></a>';
                    } else {
                        $html = '<a data-tname="product_datatable" data-href="' . route('product.status', ['product_id' => $product->id, 'status' => 1]) . '" class="btn btn-xs btn-primary me-1 rounded status_change_button" title="Make Active"> <i class="fe-arrow-up"></i></a>';
                    }
                    $html .= '<a href="' . route('products.edit', ['product' => $product->id]) . '" class="btn btn-xs btn-info me-1 rounded" title="Edit"> <i class="fe-edit"></i></a>';
                    $html .= '<a href="' . route('products.show', ['product' => $product->id]) . '" class="btn btn-xs btn-info me-1 rounded" title="View"> <i class="fe-eye"></i></a>';
                    $html .= '<a data-tname="product_datatable" data-href="' . route('products.destroy', ['product' => $product->id]) . '" class="btn btn-xs btn-danger delete_button rounded" title="Delete"> <i class="fe-trash"></i></a>';
                    return $html;
                })
                ->editColumn('product_photo_path', function ($photo) {
                    if ($photo->product_photo_path != null) {
                        $html = '<img src="' . asset($photo->product_photo_path) . '" height="40px" width="40px" class="rounded-circle">';
                    } else {
                        $html = '<img src="' . asset(sd_application_setting('no_image')) . '" height="40px" width="40px" class="rounded-circle">';
                    }
                    return $html;
                })
                ->editColumn('status', function ($status) {
                    if ($status->status == 1) {
                        return "<span class='badge bg-success'>Active</span>";
                    } else {
                        return "<span class='badge bg-warning'>Inactive</span>";
                    }
                })
                ->rawColumns(['action', 'product_photo_path', 'status'])
                ->addIndexColumn()
                ->make(true);
        }

        return view($this->location . 'index', compact('categories', 'users'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Application|Factory|View|Response
     */
    public function create()
    {
        $categories = DB::table('categories')->where('status', 1)->pluck('category_name', 'id');

        return view($this->location . 'create', compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param Request $request
     * @return Application|RedirectResponse|Response|Redirector
     * @throws ValidationException
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'product_name' => 'required|max:191|string',
            'category_id' => 'required',
            'product_price' => 'required',
            'product_photo_path' => 'required',
        ]);

        try {
            $product = $request->except('_token', 'product_photo_path');
            $product['status'] = 1;

            // Product Photo Move and Insert
            if ($request->hasFile('product_photo_path')) {
                $product_photo_path = $request->file('product_photo_path');
                $product_photo_name = uniqid('P-') . '.' . $product_photo_path->getClientOriginalExtension();
                Image::make($product_photo_path)->resize(400, 400)->save(public_path('uploads/products/') . $product_photo_name);

                $product['product_photo_path'] = 'uploads/products/' . $product_photo_name;
            }

            $product['sku'] = uniqid('SD');
            $product['created_by'] = auth()->user()->id;
            $product['created_at'] = Carbon::now();
            $product['updated_at'] = Carbon::now();

            DB::table('products')->insert($product);
            DB::commit();

            return redirect('products')->with(['message' => "Product Successfully Saved!", 'alert-type' => 'success']);

        } catch (Exception $exception) {
            Log::emergency("File:" . $exception->getFile() . "Line:" . $exception->getLine() . "Message:" . $exception->getMessage('error-101'));

            return back()->with(['message' => "Something went wrong. Try again please!", 'alert-type' => 'error']);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param $id
     * @return Application|Factory|View|Response
     */
    public function edit($id)
    {
        $product = DB::table('products')->find($id);
        $categories = DB::table('categories')->where('status', 1)->pluck('category_name', 'id');

        return view($this->location . 'edit', compact('product', 'categories'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param int $id
     * @return Application|RedirectResponse|Response|Redirector
     * @throws ValidationException
     */
    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'product_name' => 'required|max:191|string',
            'category_id' => 'required',
            'product_price' => 'required'
        ]);

        try {
            $product = $request->except('_token', '_method', 'product_photo_path');
            // Product Photo Move and Insert
            if ($request->hasFile('product_photo_path')) {
                $get_product_image = DB::table('products')->find($id);
                // TODO:: you can stop unlinking file by commenting/Removing belows if condition
                $path = $get_product_image->product_photo_path;
                if ($path != 'uploads/products/default_product_image.png') {
                    // file unlink
                    if (file_exists($path)) {
                        unlink($path);
                    }
                }
                $product_photo_path = $request->file('product_photo_path');
                $product_photo_name = uniqid('P-') . '.' . $product_photo_path->getClientOriginalExtension();
                Image::make($product_photo_path)->resize(400, 400)->save(public_path('uploads/products/') . $product_photo_name);

                $product['product_photo_path'] = 'uploads/products/' . $product_photo_name;
            }

            $product['updated_at'] = Carbon::now();

            DB::table('products')->where('id', $id)->update($product);
            DB::commit();

            return redirect('products')->with(['message' => "Product Successfully updated!", 'alert-type' => 'success']);

        } catch (Exception $exception) {
            Log::emergency("File:" . $exception->getFile() . "Line:" . $exception->getLine() . "Message:" . $exception->getMessage());

            return back()->with(['message' => "Something went wrong. Try again please!", 'alert-type' => 'error']);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param $id
     * @return array
     */
    public function destroy($id): array
    {
        try {
            $get_product = DB::table('products')->find($id);
            // TODO:: you can stop unlinking file by commenting/Removing belows if condition
            $path = $get_product->product_photo_path;
            if ($path != 'uploads/products/default_product_image.png') {
                // file unlink
                if (file_exists($path)) {
                    unlink($path);
                }
            }
            DB::table('products')->delete($id);
            DB::commit();
            $output = ['success' => true, 'msg' => 'Product Deleted!'];
        } catch (Exception $exception) {
            Log::emergency("File:" . $exception->getFile() . "Line:" . $exception->getLine() . "Message:" . $exception->getMessage());

            $output = ['success' => false, 'msg' => 'Something went wrong. Try again please!'];
        }

        return $output;
    }

    /**
     * Product status change
     *
     * @param Request $request
     * @return array
     * @throws ValidationException
     */
    public function status(Request $request): array
    {
        $this->validate($request, [
            'product_id' => 'required',
            'status' => 'required',
        ]);

        try {
            DB::table('products')->where('id', $request->product_id)->update(['status' => $request->status]);
            DB::commit();

            $output = ['success' => true, 'msg' => 'Product status changed!'];
        } catch (Exception $exception) {
            Log::emergency("File:" . $exception->getFile() . "Line:" . $exception->getLine() . "Message:" . $exception->getMessage());

            $output = ['success' => false, 'msg' => 'Something went wrong. Try again please!'];
        }

        return $output;
    }
}
