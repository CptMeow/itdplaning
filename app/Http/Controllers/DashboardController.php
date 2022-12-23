<?php

namespace App\Http\Controllers;

use App\Models\Contract;
use App\Models\Project;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(Request $request)
    {

        $contracts = Contract::count();
        $projects  = Project::count();

        $contract_groupby_fiscal_years = Contract::selectRaw('contract_fiscal_year as fiscal_year, count(*) as total')
            ->GroupBy('contract_fiscal_year')
            ->orderBy('contract_fiscal_year', 'desc')
            ->get()
            ->toJson();

        $project_groupby_fiscal_years = Project::selectRaw('project_fiscal_year as fiscal_year, count(*) as total')
            ->GroupBy('project_fiscal_year')
            ->orderBy('project_fiscal_year', 'desc')
            ->get()
            ->toJson();

        return view('app.dashboard.index', compact('contracts', 'contract_groupby_fiscal_years', 'projects', 'project_groupby_fiscal_years'));
    }
}
