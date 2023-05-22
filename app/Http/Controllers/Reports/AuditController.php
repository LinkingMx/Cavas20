<?php

namespace App\Http\Controllers\Reports;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class AuditController extends Controller
{
    //
    public function index()
    {
        $data = [
            'message' => 'Hello, World!'
        ];

        return view('reports.audit', $data);
    }
}
