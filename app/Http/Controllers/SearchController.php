<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Guide;

class SearchController extends Controller
{
    public function index(Request $request)
    {
        $query = $request->input('query');
        $guides = [];
    
        if ($query) {
            $guides = Guide::with('user') // <-- eager load the related user
                ->where('location', 'LIKE', '%' . $query . '%')
                ->get();
        }
    
        return view('pages.search', compact('guides', 'query'));
    }
    
}

