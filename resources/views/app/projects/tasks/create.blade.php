<x-app-layout>
  <x-slot:content>
    <div class="container-fluid">
      <div class="animated fadeIn">
        @if ($errors->any())
          <div class="alert alert-danger">
              <ul>
              @foreach ($errors->all() as $error)
                  <li>{{ $error }}</li>
              @endforeach
              </ul>
          </div>
        @endif
        <div class="row">
          <div class="col-sm-12 col-md-12 col-lg-12 col-xl-12">
            <div class="card">
              <div class="card-header">
                <div class="col-6">
                  <h4>
                    <i class="cil-description me-2"></i> {{ __('เพิ่มกิจกรรม') }}
                  </h4>
                </div>
                <div class="col-6"></div>
              </div>
              <div class="card-body">
                <form method="POST" action="{{ route("project.task.store", $project) }}" class="row g-3">
                  @csrf

                  <div class="col-md-12">
                    <label for="task_name" class="form-label">{{ __('ชื่อกิจกรรม') }}</label> <span class="text-danger">*</span>
                    <input type="text" class="form-control" id="task_name" name="task_name" required autofocus>
                    <div class="invalid-feedback">
                      {{__("ชื่อกิจกรรมซ้ำ")}}
                    </div>
                  </div>
                  <div class="col-md-6">
                    <label for="task_start_date" class="form-label">{{ __('วันที่เริ่มต้น') }}</label> <span class="text-danger">*</span>
                    {{-- <input type="text" class="form-control" id="register_date" name="register_date" required> --}}
                    <div data-coreui-toggle="date-picker" id="task_start_date"></div>
                  </div>
                  <div class="col-md-6">
                    <label for="task_end_date" class="form-label">{{ __('วันที่สิ้นสุด') }}</label> <span class="text-danger">*</span>
                    {{-- <input type="text" class="form-control" id="register_date" name="register_date" required> --}}
                    <div data-coreui-toggle="date-picker" id="task_end_date"></div>
                  </div>
                  
                  <x-button class="btn-success" type="submit">{{ __('coreuiforms.save') }}</x-button>
                  <x-button link="{{ route('project.show', $project) }}" class="btn-light text-black">{{ __('coreuiforms.return') }}</x-button>
                </form>
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
