<?php

namespace App\Http\Controllers;

use App\Http\Requests\BranchShowRequest;
use App\Http\Resources\BranchShowResource;
use App\Models\Branch;
use Illuminate\Http\Request;

class BranchController extends Controller
{
    public function show() {
        $branches = Branch::all();

        return ['data' => ['items' => BranchShowResource::collection($branches)]];
    }
}
