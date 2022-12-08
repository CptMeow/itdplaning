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
            <x-card title="{{ __('แก้ไขกิจกรรม') }} {{ $task->task_name }}">
              <form method="POST" action="{{ route('project.task.update', ['project' => $project->hashid, 'task' => $task->hashid]) }}" class="row g-3">
                @csrf
                {{ method_field('PUT') }}
                <div class="col-md-12">
                  <label for="task_name" class="form-label">{{ __('ชื่อกิจกรรม') }}</label> <span class="text-danger">*</span>
                  <input type="text" class="form-control" id="task_name" name="task_name" value="{{ $task->task_name }}" required autofocus>
                  <div class="invalid-feedback">
                    {{ __('ชื่อกิจกรรมซ้ำ') }}
                  </div>
                </div>
                <div class="col-md-12">
                  <label for="task_description" class="form-label">{{ __('รายละเอียดกิจกรรม') }}</label>
                  <textarea class="form-control" name="task_description" id="task_description" rows="10">
                    {{ $task->task_description }}
                  </textarea>
                  <div class="invalid-feedback">
                    {{ __('รายละเอียดกิจกรรม') }}
                  </div>
                </div>
                <div class="col-md-6">
                  <label for="task_start_date" class="form-label">{{ __('วันที่เริ่มต้น') }}</label> <span class="text-danger">*</span>
                  {{-- <input type="text" class="form-control" id="register_date" name="register_date" required> --}}
                  <div data-coreui-toggle="date-picker" id="task_start_date" data-coreui-format="dd/MM/yyyy" data-coreui-date="{{ date('m/d/Y', $task->task_start_date) }}"></div>
                </div>
                <div class="col-md-6">
                  <label for="task_end_date" class="form-label">{{ __('วันที่สิ้นสุด') }}</label> <span class="text-danger">*</span>
                  {{-- <input type="text" class="form-control" id="register_date" name="register_date" required> --}}
                  <div data-coreui-toggle="date-picker" id="task_end_date" data-coreui-format="dd/MM/yyyy" data-coreui-date="{{ date('m/d/Y', $task->task_end_date) }}"></div>
                </div>


                <h4>งบประมาณ</h4>

                <div class="row">
                  <div class="col-6">
                    <strong>เงินงบประมาณ (งบประมาณขอรัฐบาล)</strong>
                    <div class="col-md-12">
                      <label for="task_budget_gov_operating" class="form-label">{{ __('งบดำเนินงาน (ค่าใช้สอยต่างๆ)') }}</label>
                      <input type="number" class="form-control" id="task_budget_gov_operating" name="task_budget_gov_operating" min="0" value="{{ $task->task_budget_gov_operating }}">
                      <div class="invalid-feedback">
                        {{ __('ระบุงบดำเนินงาน (ค่าใช้สอยต่างๆ)') }}
                      </div>
                    </div>
                    <div class="col-md-12">
                      <label for="task_budget_gov_investment" class="form-label">{{ __('งบลงทุน IT (ครุภัณฑ์ต่างๆ)') }}</label>
                      <input type="number" class="form-control" id="task_budget_gov_investment" name="task_budget_gov_investment" min="0" value="{{ $task->task_budget_gov_investment }}">
                      <div class="invalid-feedback">
                        {{ __('ระบุงบลงทุน IT (ครุภัณฑ์ต่างๆ)') }}
                      </div>
                    </div>
                    <div class="col-md-12">
                      <label for="task_budget_gov_utility" class="form-label">{{ __('ค่าสาธารณูปโภค') }}</label>
                      <input type="number" class="form-control" id="task_budget_gov_utility" name="task_budget_gov_utility" min="0" value="{{ $task->task_budget_gov_utility }}">
                      <div class="invalid-feedback">
                        {{ __('ระบุค่าสาธารณูปโภค') }}
                      </div>
                    </div>
                  </div>

                  <div class="col-6">
                    <strong>เงินงบกลาง IT</strong>
                    <div class="col-md-12">
                      <label for="task_budget_it_operating" class="form-label">{{ __('งบดำเนินงาน (ค่าใช้สอยต่างๆ)') }}</label>
                      <input type="number" class="form-control" id="task_budget_it_operating" name="task_budget_it_operating" min="0" value="{{ $task->task_budget_it_operating }}">
                      <div class="invalid-feedback">
                        {{ __('ระบุงบดำเนินงาน (ค่าใช้สอยต่างๆ)') }}
                      </div>
                    </div>
                    <div class="col-md-12">
                      <label for="task_budget_it_investment" class="form-label">{{ __('งบลงทุน IT (ครุภัณฑ์ต่างๆ)') }}</label>
                      <input type="number" class="form-control" id="task_budget_it_investment" name="task_budget_it_investment" min="0" value="{{ $task->task_budget_it_investment }}">
                      <div class="invalid-feedback">
                        {{ __('ระบุงบลงทุน IT (ครุภัณฑ์ต่างๆ)') }}
                      </div>
                    </div>

                  </div>
                </div>

                <x-button class="btn-success" type="submit">{{ __('coreuiforms.save') }}</x-button>
                <x-button link="{{ route('project.show', $project->hashid) }}" class="btn-light text-black">{{ __('coreuiforms.return') }}</x-button>
              </form>
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