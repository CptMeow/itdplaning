<x-app-layout>
  <x-slot:content>
    <div class="container-fluid">
      <div class="animated fadeIn">
        <div class="row">
          <div class="col-sm-12 col-md-12 col-lg-12 col-xl-12">
            <x-card title="โครงการทั้งหมด">
              <x-slot:toolbar>
                <a href="{{ route('project.create') }}" class="btn btn-success text-white">Add Project</a>
              </x-slot:toolbar>
              <table class="table">
                <thead>
                  <tr>
                    <th></th>
                    <th></th>
                    <th></th>
                  </tr>
                </thead>
                <tbody>
                  @foreach ($projects as $project)
                    <tr>
                      <td></td>
                      <td>
                        {{ $project['project_name'] }}<br>
                        <span class="badge bg-primary">{{ \Helper::date($project->project_start_date) }}</span>
                        <span class="badge bg-primary">{{ \Helper::date($project->project_end_date) }}</span>
                      </td>
                      <td class="text-end">
                        <a href="{{ route('project.show', $project->hashid) }}" class="btn btn-primary text-white"><i class="cil-folder-open "></i></a>
                        <form action="{{ route('project.destroy', $project->hashid) }}" method="POST" style="display:inline">
                          @method('DELETE')
                          @csrf
                          <button class="btn btn-danger text-white"><i class="cil-trash"></i></button>
                        </form>
                      </td>
                    </tr>
                  @endforeach
                </tbody>
              </table>
            </x-card>
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
