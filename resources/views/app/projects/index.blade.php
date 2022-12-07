<x-app-layout>
  <x-slot:content>
    <div class="container-fluid">
      <div class="animated fadeIn">
        <div class="row">
          <div class="col-sm-12 col-md-12 col-lg-12 col-xl-12">
            <div class="card">
              <div class="card-header">
                <div class="col-6">
                  <h4>
                    <i class="cil-description me-2"></i>
                  </h4>
                </div>
                <div class="col-6"></div>
              </div>
              <div class="card-body">
                <table class="table">
                  <thead>
                    <tr>
                      <th></th>
                      <th></th>
                      <th></th>
                    </tr>
                  </thead>
                  <tbody>
                    @foreach($projects as $project)
                      <tr>
                        <td></td>
                        <td>
                          {{ $project['project_name'] }}<br>
                          <span class="badge bg-primary">{{ \Helper::date($project->project_start_date) }}</span>
                          <span class="badge bg-primary">{{ \Helper::date($project->project_end_date) }}</span>
                        </td>
                        <td>
                          <a href="{{route('project.show',$project->hashid)}}" class="btn">Show</a>
                          <a href="{{route('project.task.create',$project->hashid)}}" class="btn">Add Task</a>
                        </td>
                      </tr>
                    @endforeach
                  </tbody>
                </table>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </x-slot:content>
  <x-slot:css>
  </x-slot:css>
  <x-slot:javascript>

  </x-slot:javascript>
</x-app-layout>
