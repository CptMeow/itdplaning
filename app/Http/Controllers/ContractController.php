<?php

namespace App\Http\Controllers;

use App\Models\Contract;
use Illuminate\Http\Request;
use Vinkla\Hashids\Facades\Hashids;
use Yajra\DataTables\Facades\DataTables;

class ContractController extends Controller
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
        if ($request->ajax()) {
            $records = contract::orderBy('contract_end_date', 'desc');

            return Datatables::eloquent($records)
                ->addIndexColumn()
                ->addColumn('contract_name_output', function ($row) {
                    $html = $row->contract_name;
                    $html .= '<br><span class="badge bg-info">' . \Helper::date($row->contract_start_date) . '</span> -';
                    $html .= ' <span class="badge bg-info">' . \Helper::date($row->contract_end_date) . '</span>';

                    if ($row->task->count() > 0) {
                        $html .= ' <span class="badge bg-warning">' . $row->task->count() . ' กิจกรรม</span>';
                    }

                    return $html;
                })
                ->addColumn('contract_fiscal_year', function ($row) {
                    return $row->contract_fiscal_year;
                })
                ->addColumn('action', function ($row) {
                    $html = '<div class="btn-group" role="group" aria-label="Basic mixed styles example">';
                    $html .= '<a href="' . route('contract.show', $row->hashid) . '" class="btn btn-success text-white"><i class="cil-folder-open "></i></a>';
                    //if (Auth::user()->hasRole('admin')) {
                    $html .= '<a href="' . route('contract.edit', $row->hashid) . '" class="btn btn-warning btn-edit text-white"><i class="cil-pencil "></i></a>';
                    $html .= '<button data-rowid="' . $row->hashid . '" class="btn btn-danger btn-delete text-white"><i class="cil-trash "></i></button>';
                    //}
                    $html .= '</div>';

                    return $html;
                })
                ->rawColumns(['contract_name_output', 'action'])
                ->toJson();
        }

        return view('app.contracts.index');
    }

    public function show(Request $request, $contract)
    {
        $id = Hashids::decode($contract)[0];

        $contract = Contract::find($id);
        $gantt    = '';

        return view('app.contracts.show', compact('contract', 'gantt'));
    }

    public function create(Request $request)
    {
        return view('app.contracts.create');
    }

    public function store(Request $request)
    {
        $contract = new Contract;

        $request->validate([
            'contract_name'                   => 'required',
            'contract_number'                 => 'required',
            'date-picker-contract_start_date' => 'required',
            'date-picker-contract_end_date'   => 'required',
        ]);

        //convert date
        $start_date = date_format(date_create_from_format('d/m/Y', $request->input('date-picker-contract_start_date')), 'Y-m-d');
        $end_date   = date_format(date_create_from_format('d/m/Y', $request->input('date-picker-contract_end_date')), 'Y-m-d');

        $contract->contract_name        = $request->input('contract_name');
        $contract->contract_number      = $request->input('contract_number');
        $contract->contract_description = trim($request->input('contract_description'));
        $contract->contract_type        = $request->input('contract_type');
        $contract->contract_fiscal_year = $request->input('contract_fiscal_year');
        $contract->contract_start_date  = $start_date ?? date('Y-m-d 00:00:00');
        $contract->contract_end_date    = $end_date ?? date('Y-m-d 00:00:00');

        // $contract->budget_gov = $request->input('budget_gov');
        // $contract->budget_it  = $request->input('budget_it');

        // $contract->budget_gov_operating  = $request->input('budget_gov_operating');
        // $contract->budget_gov_investment = $request->input('budget_gov_investment');
        // $contract->budget_gov_utility    = $request->input('budget_gov_utility');
        // $contract->budget_it_operating   = $request->input('budget_it_operating');
        // $contract->budget_it_investment  = $request->input('budget_it_investment');

        if ($contract->save()) {
            return redirect()->route('contract.index');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $contract
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request, $contract)
    {
        $id       = Hashids::decode($contract)[0];
        $contract = Contract::find($id);

        return view('app.contracts.edit', compact('contract'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $contract
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $contract)
    {
        $id       = Hashids::decode($contract)[0];
        $contract = Contract::find($id);

        $request->validate([
            'contract_name'                   => 'required',
            'date-picker-contract_start_date' => 'required',
            'date-picker-contract_end_date'   => 'required',
        ]);

        //convert date
        $start_date = date_format(date_create_from_format('d/m/Y', $request->input('date-picker-contract_start_date')), 'Y-m-d');
        $end_date   = date_format(date_create_from_format('d/m/Y', $request->input('date-picker-contract_end_date')), 'Y-m-d');

        $contract->contract_name        = $request->input('contract_name');
        $contract->contract_number      = $request->input('contract_number');
        $contract->contract_description = trim($request->input('contract_description'));
        $contract->contract_type        = $request->input('contract_type');
        $contract->contract_fiscal_year = $request->input('contract_fiscal_year');
        $contract->contract_start_date  = $start_date ?? date('Y-m-d 00:00:00');
        $contract->contract_end_date    = $end_date ?? date('Y-m-d 00:00:00');

        // $contract->budget_gov = $request->input('budget_gov');
        // $contract->budget_it  = $request->input('budget_it');

        // $contract->budget_gov_operating  = $request->input('budget_gov_operating');
        // $contract->budget_gov_investment = $request->input('budget_gov_investment');
        // $contract->budget_gov_utility    = $request->input('budget_gov_utility');
        // $contract->budget_it_operating   = $request->input('budget_it_operating');
        // $contract->budget_it_investment  = $request->input('budget_it_investment');

        if ($contract->save()) {
            return redirect()->route('contract.index');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $contract
     * @return \Illuminate\Http\Response
     */
    public function destroy($contract)
    {
        $id       = Hashids::decode($contract)[0];
        $contract = Contract::find($id);
        if ($contract) {
            $contract->delete();
        }
        return redirect()->route('contract.index');
    }

}
