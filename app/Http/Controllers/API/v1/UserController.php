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
        $query = User::query();
        if ($request->search) {
            $query->where('name', 'like', "%$request->search%")->orWhere('email', 'like', "%$request->search%");
        }
        // default order
        $query->orderBy('id', 'DESC');
        if ($request->sortBy) {
            $query->orderBy($request->sortBy, $request->sort);
        }
        $pageLength = ($request->pageLength) ? $request->pageLength  : 60;
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
