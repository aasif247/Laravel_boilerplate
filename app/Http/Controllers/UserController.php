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
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\ValidationException;
use Log;
use Yajra\DataTables\Facades\DataTables;

class UserController extends Controller
{
    // Profile Location
    private $profile_location = 'panel.user.';

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
        if ($request->ajax()) {
            $users = DB::table('users')
                ->orderByDesc('id');

            return DataTables::of($users)
                ->filter(function ($query) use ($request) {
                    if (!empty(request()->start_date) && !empty(request()->end_date)) {
                        $start = $request->start_date;
                        $end = $request->end_date;
                        $query->whereDate(DB::raw('DATE(created_at)'), '>=', $start)
                            ->whereDate(DB::raw('DATE(created_at)'), '<=', $end);
                    }
                })
                ->addColumn('action', function ($user) {
                    $html = '<a href="' . route('users.edit', ['user' => $user->id]) . '" class="btn btn-xs btn-info me-1 rounded" title="Edit"> <i class="fe-edit"></i></a>';
                    $html .= '<a href="' . route('users.show', ['user' => $user->id]) . '" class="btn btn-xs btn-info me-1 rounded" title="View"> <i class="fe-eye"></i></a>';
                    $html .= '<a data-tname="user_datatable" data-href="' . route('users.destroy', ['user' => $user->id]) . '" class="btn btn-xs btn-danger delete_button rounded" title="Delete"> <i class="fe-trash"></i></a>';
                    return $html;
                })
                ->rawColumns(['action'])
                ->addIndexColumn()
                ->make(true);
        }

        return view($this->profile_location . 'user');
    }


    public function edit($id)
    {
        $user = DB::table('users')->find($id);

        return view($this->profile_location . 'edit', compact('user'));
    }


    /**
     * User Profile
     *
     * @return Application|Factory|View
     */
    public function user()
    {
        $users = DB::table('users')->pluck('name', 'id');
        return view($this->profile_location . 'user',compact( 'users'));
    }

    /**
     * User Profile update
     *
     * @param Request $request
     * @return RedirectResponse
     * @throws ValidationException
     */
    public function update(Request $request,$id)
    {
        $this->validate($request, [
            'name' => 'required'
        ]);

        try {

            DB::table('users')->where('id', $id)->update([
                'name' => $request->name,
                'updated_at' => Carbon::now()
            ]);

            DB::commit();

            return redirect()->back()->with(['message' => "User Updated Successfully!", 'alert-type' => 'success']);
        } catch (Exception $exception) {
            Log::emergency("File:" . $exception->getFile() . "Line:" . $exception->getLine() . "Message:" . $exception->getMessage());

            return back()->with(['message' => "Something went wrong. Please try again!", 'alert-type' => 'error']);
        }
    }
}
