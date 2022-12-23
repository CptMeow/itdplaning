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
            <x-card title="{{ __('เพิ่มสัญญา') }}">
              <form method="POST" action="{{ route('contract.store') }}" class="row g-3">
                @csrf
                {{-- <div class="col-md-12">
                  <label for="contract_type" class="form-label">{{ __('ประเภทงาน/โครงการ') }}</label> <span class="text-danger">*</span>
                  <div class="form-check form-check-inline ms-5">
                    <input class="form-check-input" type="radio" name="contract_type" id="contract_type1" value="J" checked>
                    <label class="form-check-label" for="contract_type1">
                      งานประจำ
                    </label>
                  </div>
                  <div class="form-check form-check-inline">
                    <input class="form-check-input" type="radio" name="contract_type" id="contract_type2" value="P">
                    <label class="form-check-label" for="contract_type2">
                      โครงการ
                    </label>
                  </div>
                  <div class="invalid-feedback">
                    {{ __('ประเภทงาน/โครงการ') }}
                  </div>
                </div> --}}
                <div class="col-md-12">
                  <label for="contract_name" class="form-label">{{ __('ชื่อสัญญา') }}</label> <span class="text-danger">*</span>
                  <input type="text" class="form-control" id="contract_name" name="contract_name" required autofocus>
                  <div class="invalid-feedback">
                    {{ __('ชื่อสัญญา ซ้ำ') }}
                  </div>
                </div>
                <div class="col-md-12">
                  <label for="contract_number" class="form-label">{{ __('เลขที่สัญญา') }}</label> <span class="text-danger">*</span>
                  <input type="text" class="form-control" id="contract_number" name="contract_number" required>
                  <div class="invalid-feedback">
                    {{ __('เลขที่สัญญา ซ้ำ') }}
                  </div>
                </div>
                <div class="col-md-12">
                  <label for="contract_description" class="form-label">{{ __('รายละเอียดสัญญา') }}</label>
                  <textarea class="form-control" name="contract_description" id="contract_description" rows="10"></textarea>
                  <div class="invalid-feedback">
                    {{ __('รายละเอียดงาน/โครงการ') }}
                  </div>
                </div>
                <div class="col-md-12">
                  <label for="contract_fiscal_year" class="form-label">{{ __('ปีงบประมาณ') }}</label> <span class="text-danger">*</span>
                  <input type="text" class="form-control" id="contract_fiscal_year" name="contract_fiscal_year" required>
                  <div class="invalid-feedback">
                    {{ __('ชื่องาน/โครงการ ซ้ำ') }}
                  </div>
                </div>
                <div class="col-md-6">
                  <label for="contract_start_date" class="form-label">{{ __('วันที่เริ่มต้น') }}</label> <span class="text-danger">*</span>
                  {{-- <input type="text" class="form-control" id="register_date" name="register_date" required> --}}
                  <div data-coreui-toggle="date-picker" id="contract_start_date" data-coreui-format="dd/MM/yyyy"></div>
                </div>
                <div class="col-md-6">
                  <label for="contract_end_date" class="form-label">{{ __('วันที่สิ้นสุด') }}</label> <span class="text-danger">*</span>
                  {{-- <input type="text" class="form-control" id="register_date" name="register_date" required> --}}
                  <div data-coreui-toggle="date-picker" id="contract_end_date" data-coreui-format="dd/MM/yyyy"></div>
                </div>

                <x-button class="btn-success" type="submit">{{ __('coreuiforms.save') }}</x-button>
                <x-button link="{{ route('contract.index') }}" class="btn-light text-black">{{ __('coreuiforms.return') }}</x-button>
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
