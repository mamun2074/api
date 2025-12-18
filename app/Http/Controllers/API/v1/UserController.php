<?php

namespace App\Http\Controllers\API\v1;

use Carbon\Carbon;
use App\Models\User;
use App\Facades\AppResponse;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller
{

    /**
     * Store a newly created resource in storage.
     */
    public function index(Request $request)
    {

        $sorItems = ['id', 'name', 'email'];
        $sortDirs = ['asc', 'desc'];

        $query = User::query();
        if ($request->search) {
            $query->where('name', 'like', "%$request->search%")
                ->orWhere('email', 'like', "%$request->search%")
                ->orWhere('id', 'like', "%$request->search%");
        }
        // default order
        if (in_array($request->sort_by, $sorItems) &&  in_array($request->sort_order, $sortDirs)) {
            $query->orderBy($request->sort_by, $request->sort_order);
        } else {
            $query->orderBy('id', 'DESC');
        }
        $pageLength = ($request->per_page) ? $request->per_page  : 60;

        return $query->paginate($pageLength);
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $user = User::find($id);
        $payload = [
            'data' => $user,
        ];
        return AppResponse::sendSuccess($payload);
    }
}
