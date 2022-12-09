<?php

namespace App\Http\Controllers;

use App\Models\Contract;
use App\Models\ContractHasTask;
use App\Models\Project;
use App\Models\Task;
use Illuminate\Http\Request;
use Vinkla\Hashids\Facades\Hashids;

class ProjectController extends Controller
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
        $projects = Project::get();

        return view('app.projects.index', compact('projects'));
    }

    public function gantt(Request $request)
    {
        $projects = Project::get()->toArray();

        foreach ($projects as $project) {
            (Int) $__budget_gov = (Int) $project['budget_gov_operating'] + (Int) $project['budget_gov_utility'] + (Int) $project['budget_gov_investment'];
            (Int) $__budget_it  = (Int) $project['budget_it_operating'] + (Int) $project['budget_it_investment'];
            (Int) $__budget     = $__budget_gov + $__budget_it;
            (Int) $__balance    = $__budget + (Int) $project['project_cost'];

            $gantt[] = [
                'id'                    => $project['project_id'],
                'text'                  => $project['project_name'],
                'start_date'            => date('Y-m-d', $project['project_start_date']),
                'end_date'              => date('Y-m-d', $project['project_end_date']),
                'budget_gov_operating'  => $project['budget_gov_operating'],
                'budget_gov_investment' => $project['budget_gov_investment'],
                'budget_gov_utility'    => $project['budget_gov_utility'],
                'budget_gov'            => $__budget_gov,
                'budget_it_operating'   => $project['budget_it_operating'],
                'budget_it_investment'  => $project['budget_it_investment'],
                'budget_it'             => $__budget_it,
                'budget'                => $__budget,
                'balance'               => $__balance,
                'cost'                  => $project['project_cost'],
                'owner'                 => $project['project_owner'],
                // 'type' => 'project',
                // 'duration' => 360,
            ];
        }

        // $tasks = Task::get()->toArray();
        // foreach($tasks as $task) {
        //     // (Int) $__budget_gov = (Int) $project['budget_gov_operating'] + (Int) $project['budget_gov_utility'] + (Int) $project['budget_gov_investment'];
        //     // (Int) $__budget_it = (Int) $project['budget_it_operating'] + (Int) $project['budget_it_investment'];
        //     // (Int) $__budget = $__budget_gov + $__budget_it;
        //     // (Int) $__balance = $__budget + (Int) $project['project_cost'];

        //     $gantt[] = [
        //         'id' => $task['task_id'].$task['project_id'],
        //         'text' => $task['task_name'],
        //         'start_date' => date('Y-m-d', $task['task_start_date']),
        //         'end_date' => date('Y-m-d', $task['task_end_date']),
        //         'parent' => $task['project_id'],
        //         'type' => 'task'
        //         // 'budget_gov_operating' => $project['budget_gov_operating'],
        //         // 'budget_gov_investment' => $project['budget_gov_investment'],
        //         // 'budget_gov_utility' => $project['budget_gov_utility'],
        //         // 'budget_gov' => $__budget_gov,
        //         // 'budget_it_operating' => $project['budget_it_operating'],
        //         // 'budget_it_investment' => $project['budget_it_investment'],
        //         // 'budget_it' => $__budget_it,
        //         // 'budget' => $__budget,
        //         // 'balance' => $__balance,
        //         // 'cost' => $project['project_cost'],
        //         // 'owner' => $project['project_owner'],
        //     ];
        // }

        $gantt = json_encode($gantt);

        return view('app.projects.gantt', compact('gantt'));
    }

    public function show(Request $request, $project)
    {
        $id = Hashids::decode($project)[0];

        $project = Project::find($id);

        (Int) $__budget_gov = (Int) $project['budget_gov_operating'] + (Int) $project['budget_gov_utility'] + (Int) $project['budget_gov_investment'];
        (Int) $__budget_it  = (Int) $project['budget_it_operating'] + (Int) $project['budget_it_investment'];
        (Int) $__budget     = $__budget_gov + $__budget_it;
        (Int) $__balance    = $__budget + (Int) $project['project_cost'];

        $gantt[] = [
            'id'                    => $project['project_id'],
            'text'                  => $project['project_name'],
            'start_date'            => date('Y-m-d', $project['project_start_date']),
            // 'end_date' => date('Y-m-d', $project['project_end_date']),
            'budget_gov_operating'  => $project['budget_gov_operating'],
            'budget_gov_investment' => $project['budget_gov_investment'],
            'budget_gov_utility'    => $project['budget_gov_utility'],
            'budget_gov'            => $__budget_gov,
            'budget_it_operating'   => $project['budget_it_operating'],
            'budget_it_investment'  => $project['budget_it_investment'],
            'budget_it'             => $__budget_it,
            'budget'                => $__budget,
            'balance'               => $__balance,
            'cost'                  => $project['project_cost'],
            'owner'                 => $project['project_owner'],
            'open'                  => true,
            'type'                  => 'project',
            'duration'              => 360,
        ];

        foreach ($project->task as $task) {
            (Int) $__budget_gov = (Int) $task['task_budget_gov_operating'] + (Int) $task['task_budget_gov_utility'] + (Int) $task['task_budget_gov_investment'];
            (Int) $__budget_it  = (Int) $task['task_budget_it_operating'] + (Int) $task['task_budget_it_investment'];
            (Int) $__budget     = $__budget_gov + $__budget_it;
            (Int) $__balance    = $__budget + (Int) $task['project_cost'];

            $gantt[] = [
                'id'                    => 'T' . $task['task_id'] . $task['project_id'],
                'text'                  => $task['task_name'],
                'start_date'            => date('Y-m-d', $task['task_start_date']),
                'end_date'              => date('Y-m-d', $task['task_end_date']),
                'parent'                => $task['task_parent'] ? 'T' . $task['task_parent'] . $task['project_id'] : $task['project_id'],
                'type'                  => 'task',
                'open'                  => true,
                'budget_gov_operating'  => $task['task_budget_gov_operating'],
                'budget_gov_investment' => $task['task_budget_gov_investment'],
                'budget_gov_utility'    => $task['task_budget_gov_utility'],
                'budget_gov'            => $__budget_gov,
                'budget_it_operating'   => $task['task_budget_it_operating'],
                'budget_it_investment'  => $task['task_budget_it_investment'],
                'budget_it'             => $__budget_it,
                'budget'                => $__budget,
                // 'balance' => $__balance,
                // 'cost' => $project['project_cost'],
                // 'owner' => $project['project_owner'],
            ];
        }
        $gantt = json_encode($gantt);

        return view('app.projects.show', compact('project', 'gantt'));
    }

    public function create(Request $request)
    {
        return view('app.projects.create');
    }

    public function store(Request $request)
    {
        $project = new Project;

        $request->validate([
            'project_name'                   => 'required',
            'date-picker-project_start_date' => 'required',
            'date-picker-project_end_date'   => 'required',
        ]);

        //convert date
        $start_date = date_format(date_create_from_format('d/m/Y', $request->input('date-picker-project_start_date')), 'Y-m-d');
        $end_date   = date_format(date_create_from_format('d/m/Y', $request->input('date-picker-project_end_date')), 'Y-m-d');

        $project->project_name        = $request->input('project_name');
        $project->project_description = $request->input('project_description');
        $project->project_type        = $request->input('project_type');
        $project->project_start_date  = $start_date ?? date('Y-m-d 00:00:00');
        $project->project_end_date    = $end_date ?? date('Y-m-d 00:00:00');

        // $project->budget_gov = $request->input('budget_gov');
        // $project->budget_it  = $request->input('budget_it');

        $project->budget_gov_operating  = $request->input('budget_gov_operating');
        $project->budget_gov_investment = $request->input('budget_gov_investment');
        $project->budget_gov_utility    = $request->input('budget_gov_utility');
        $project->budget_it_operating   = $request->input('budget_it_operating');
        $project->budget_it_investment  = $request->input('budget_it_investment');

        if ($project->save()) {
            return redirect()->route('project.index');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $project
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request, $project)
    {
        $id      = Hashids::decode($project)[0];
        $project = Project::find($id);

        return view('app.projects.edit', compact('project'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $project
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $project)
    {
        $id      = Hashids::decode($project)[0];
        $project = Project::find($id);

        $request->validate([
            'project_name'                   => 'required',
            'date-picker-project_start_date' => 'required',
            'date-picker-project_end_date'   => 'required',
        ]);

        //convert date
        $start_date = date_format(date_create_from_format('d/m/Y', $request->input('date-picker-project_start_date')), 'Y-m-d');
        $end_date   = date_format(date_create_from_format('d/m/Y', $request->input('date-picker-project_end_date')), 'Y-m-d');

        $project->project_name        = $request->input('project_name');
        $project->project_description = trim($request->input('project_description'));
        $project->project_type        = $request->input('project_type');
        $project->project_start_date  = $start_date ?? date('Y-m-d 00:00:00');
        $project->project_end_date    = $end_date ?? date('Y-m-d 00:00:00');

        // $project->budget_gov = $request->input('budget_gov');
        // $project->budget_it  = $request->input('budget_it');

        $project->budget_gov_operating  = $request->input('budget_gov_operating');
        $project->budget_gov_investment = $request->input('budget_gov_investment');
        $project->budget_gov_utility    = $request->input('budget_gov_utility');
        $project->budget_it_operating   = $request->input('budget_it_operating');
        $project->budget_it_investment  = $request->input('budget_it_investment');

        if ($project->save()) {
            return redirect()->route('project.index');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $project
     * @return \Illuminate\Http\Response
     */
    public function destroy($project)
    {
        $id      = Hashids::decode($project)[0];
        $project = Project::find($id);
        if ($project) {
            $project->delete();
        }
        return redirect()->route('project.index');
    }

    public function taskShow(Request $request, $project, $task)
    {
        return 'Under Construction';
    }

    public function taskCreate(Request $request, $project)
    {
        $id        = Hashids::decode($project)[0];
        $tasks     = Task::where('project_id', $id)->get();
        $contracts = Contract::get();

        return view('app.projects.tasks.create', compact('contracts', 'project', 'tasks'));
    }

    public function taskStore(Request $request, $project)
    {
        $id   = Hashids::decode($project)[0];
        $task = new Task;

        $request->validate([
            'task_name'                   => 'required',
            'date-picker-task_start_date' => 'required',
            'date-picker-task_end_date'   => 'required',
        ]);

        //convert date
        $start_date = date_format(date_create_from_format('d/m/Y', $request->input('date-picker-task_start_date')), 'Y-m-d');
        $end_date   = date_format(date_create_from_format('d/m/Y', $request->input('date-picker-task_end_date')), 'Y-m-d');

        $task->project_id       = $id;
        $task->task_name        = $request->input('task_name');
        $task->task_description = trim($request->input('task_description'));
        $task->task_start_date  = $start_date ?? date('Y-m-d 00:00:00');
        $task->task_end_date    = $end_date ?? date('Y-m-d 00:00:00');

        $task->task_parent = $request->input('task_parent') ?? null;

        $task->task_budget_gov_operating  = $request->input('task_budget_gov_operating');
        $task->task_budget_gov_investment = $request->input('task_budget_gov_investment');
        $task->task_budget_gov_utility    = $request->input('task_budget_gov_utility');
        $task->task_budget_it_operating   = $request->input('task_budget_it_operating');
        $task->task_budget_it_investment  = $request->input('task_budget_it_investment');

        if ($task->save()) {

            //insert contract
            $contract_has_task = new ContractHasTask;

            $contract_has_task->contract_id = $request->input('task_contract');
            $contract_has_task->task_id     = $task->task_id;
            $contract_has_task->save();

            return redirect()->route('project.show', $project);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $project
     * @return \Illuminate\Http\Response
     */
    public function taskEdit(Request $request, $project, $task)
    {
        $id_project = Hashids::decode($project)[0];
        $id_task    = Hashids::decode($task)[0];
        $project    = Project::find($id_project);
        $task       = task::find($id_task);

        return view('app.projects.tasks.edit', compact('project', 'task'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $project
     * @return \Illuminate\Http\Response
     */
    public function taskUpdate(Request $request, $project, $task)
    {
        $id_project = Hashids::decode($project)[0];
        $id_task    = Hashids::decode($task)[0];
        $project    = Project::find($id_project);
        $task       = task::find($id_task);

        $request->validate([
            'task_name'                   => 'required',
            'date-picker-task_start_date' => 'required',
            'date-picker-task_end_date'   => 'required',
        ]);

        //convert date
        $start_date = date_format(date_create_from_format('d/m/Y', $request->input('date-picker-task_start_date')), 'Y-m-d');
        $end_date   = date_format(date_create_from_format('d/m/Y', $request->input('date-picker-task_end_date')), 'Y-m-d');

        $task->project_id       = $id_project;
        $task->task_name        = $request->input('task_name');
        $task->task_description = trim($request->input('task_description'));
        $task->task_start_date  = $start_date ?? date('Y-m-d 00:00:00');
        $task->task_end_date    = $end_date ?? date('Y-m-d 00:00:00');

        $task->task_budget_gov_operating  = $request->input('task_budget_gov_operating');
        $task->task_budget_gov_investment = $request->input('task_budget_gov_investment');
        $task->task_budget_gov_utility    = $request->input('task_budget_gov_utility');
        $task->task_budget_it_operating   = $request->input('task_budget_it_operating');
        $task->task_budget_it_investment  = $request->input('task_budget_it_investment');

        if ($task->save()) {
            return redirect()->route('project.show', $project->hashid);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $project
     * @param  int  $task
     * @return \Illuminate\Http\Response
     */
    public function taskDestroy($project, $task)
    {
        $id   = Hashids::decode($task)[0];
        $task = Task::find($id);
        if ($task) {
            $task->delete();
        }
        return redirect()->route('project.show', $project);
    }

}
