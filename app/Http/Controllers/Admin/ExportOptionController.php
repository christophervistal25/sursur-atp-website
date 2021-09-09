<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Exports\PersonnelExport;
use App\Exports\PersonnelTotalByCityExport;

class ExportOptionController extends Controller
{
    public function index()
    {
        return view('admin.export.option.index');
    }

    public function personnelList()
    {
        return \Excel::download(new PersonnelExport, 'Report_Personnel.xlsx');
    }

    public function personnelTotal()
    {
        return \Excel::download(new PersonnelTotalByCityExport, 'Report_Personnel_total.xlsx');
    }
}
