<?php

namespace App\Http\Controllers\Selling;

use App\Exports\LeadExport;
use App\Http\Controllers\Controller;
use App\Models\Leads;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use Maatwebsite\Excel\Facades\Excel;
class LeadsController extends Controller
{
    public function index()
    {
        $results = Leads::orderby('id', 'desc')->paginate(10);
        return view('selling.leads.index', [
            'bread_main' => 'Leads',
            'bread_desc' => 'Leads',
            'results' => $results,
        ]);
    }

    public function export()
    {
        $data = [
            // Your data goes here
            ['name' => 'John Doe', 'email' => 'john@example.com'],
            ['name' => 'Jane Doe', 'email' => 'jane@example.com'],
            // ...
        ];
        $results = Leads::orderby('id', 'desc')
        ->selectRaw('id, name, email, CAST(phone AS CHAR),
         DATE_FORMAT(created_at, "%Y-%m-%d")as date,  DATE_FORMAT(created_at,"%H:%i:%s") as time')
        ->get()->toArray();
        $results =  Arr::prepend($results, [
            '#', "name", "email", "phone", "date", "time"
        ]);
        $export = new LeadExport($results);

        return Excel::download($export, 'exported_data.xlsx');
    }
}
