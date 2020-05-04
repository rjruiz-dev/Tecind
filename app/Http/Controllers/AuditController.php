<?php

namespace App\Http\Controllers;

use App\Post;
use OwenIt\Auditing\Models\Audit;
use Illuminate\Http\Request;

class AuditController extends Controller
{
    public function index()
    {
        $this->authorize('view', new Audit);

        $audits = \OwenIt\Auditing\Models\Audit::with('user')
                ->orderBy('created_at', 'desc')                
                ->get();
             
        return view('admin.audits.index', ['audits' => $audits]);       
    }
     
}

