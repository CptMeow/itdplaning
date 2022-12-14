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
            <x-card title="{{ __('แก้ไขสัญญา') }}">
              <form method="POST" action="{{ route('contract.update', $contract->hashid) }}" class="row g-3">
                @csrf
                {{ method_field('PUT') }}
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
                  <input type="text" class="form-control" id="contract_name" name="contract_name" value="{{ $contract->contract_name }}" required autofocus>
                  <div class="invalid-feedback">
                    {{ __('ชื่อสัญญา ซ้ำ') }}
                  </div>
                </div>
                <div class="col-md-12">
                  <label for="contract_status" class="form-label">{{ __('สถานะสัญญา') }}</label> <span class="text-danger">*</span>
                  <div class="form-check form-check-inline ms-5">
                    <input class="form-check-input" type="radio" name="contract_status" id="contract_status1" value="1" checked>
                    <label class="form-check-label" for="contract_status1">
                      อยู่ในระหว่างดำเนินการ
                    </label>
                  </div>
                  <div class="form-check form-check-inline">
                    <input class="form-check-input" type="radio" name="contract_status" id="contract_status2" value="2">
                    <label class="form-check-label" for="contract_status2">
                      ดำเนินการแล้วเสร็จ
                    </label>
                  </div>
                  <div class="invalid-feedback">
                    {{ __('สถานะสัญญา') }}
                  </div>
                </div>
                <div class="col-md-12">
                  <label for="contract_number" class="form-label">{{ __('เลขที่สัญญา') }}</label> <span class="text-danger">*</span>
                  <input type="text" class="form-control" id="contract_number" name="contract_number" value="{{ $contract->contract_number }}" required>
                  <div class="invalid-feedback">
                    {{ __('เลขที่สัญญา ซ้ำ') }}
                  </div>
                </div>
                <div class="col-md-12">
                  <label for="contract_juristic_id" class="form-label">{{ __('เลขทะเบียนคู่ค้า') }}</label> <span class="text-danger">*</span>
                  <input type="text" class="form-control" id="contract_juristic_id" name="contract_juristic_id" value="{{ $contract->contract_juristic_id }}" maxlength="13" required>
                  <div class="invalid-feedback">
                    {{ __('คู่ค้าซ้ำ') }}
                  </div>
                </div>
                <div class="col-md-12">
                  <label for="contract_order_no" class="form-label">{{ __('เลขที่ใบสั่งซื้อ') }}</label> <span class="text-danger">*</span>
                  <input type="text" class="form-control" id="contract_order_no" name="contract_order_no" value="{{ $contract->contract_order_no }}" maxlength="50" required>
                  <div class="invalid-feedback">
                    {{ __('เลขที่ใบสั่งซื้อ') }}
                  </div>
                </div>
                <div class="col-md-12">
                  <label for="contract_description" class="form-label">{{ __('รายละเอียดสัญญา') }}</label>
                  <textarea class="form-control" name="contract_description" id="contract_description" rows="10">{{ $contract->contract_description }}</textarea>
                  <div class="invalid-feedback">
                    {{ __('รายละเอียดงาน/โครงการ') }}
                  </div>
                </div>
                <div class="col-md-12">
                  <label for="contract_fiscal_year" class="form-label">{{ __('ปีงบประมาณ') }}</label> <span class="text-danger">*</span>
                  <input type="text" class="form-control" id="contract_fiscal_year" name="contract_fiscal_year" value="{{ $contract->contract_fiscal_year }}" required>
                  <div class="invalid-feedback">
                    {{ __('ชื่องาน/โครงการ ซ้ำ') }}
                  </div>
                </div>
                <div class="col-md-6">
                  <label for="contract_start_date" class="form-label">{{ __('วันที่เริ่มต้น') }}</label> <span class="text-danger">*</span>
                  {{-- <input type="text" class="form-control" id="register_date" name="register_date" required> --}}
                  <div data-coreui-toggle="date-picker" id="contract_start_date" data-coreui-format="dd/MM/yyyy" data-coreui-date="{{ date('m/d/Y', $contract->contract_start_date) }}"></div>
                </div>
                <div class="col-md-6">
                  <label for="contract_end_date" class="form-label">{{ __('วันที่สิ้นสุด') }}</label> <span class="text-danger">*</span>
                  {{-- <input type="text" class="form-control" id="register_date" name="register_date" required> --}}
                  <div data-coreui-toggle="date-picker" id="contract_end_date" data-coreui-format="dd/MM/yyyy" data-coreui-date="{{ date('m/d/Y', $contract->contract_end_date) }}"></div>
                </div>
                <div class="col-md-6">
                  <label for="contract_sign_date" class="form-label">{{ __('วันที่ลงนามสัญญา') }}</label>
                  {{-- <input type="text" class="form-control" id="register_date" name="register_date" required> --}}
                  <div data-coreui-toggle="date-picker" id="contract_sign_date" data-coreui-format="dd/MM/yyyy" data-coreui-date="{{ $contract->contract_sign_date ? date('m/d/Y', $contract->contract_sign_date) : '' }}"></div>
                </div>

                <div class="col-md-12">
                  <label for="contract_type" class="form-label">{{ __('ประเภทสัญญา') }}</label> <span class="text-danger">*</span>
                  {{ Form::select('contract_type', \Helper::contractType(), $contract->contract_type, ['class' => 'form-control', 'placeholder' => 'เลือกประเภท...']) }}
                  <div class="invalid-feedback">
                    {{ __('สัญญา') }}
                  </div>
                </div>
                <div class="col-md-12">
                  <label for="contract_acquisition" class="form-label">{{ __('ประเภทการได้มาของสัญญา') }}</label> <span class="text-danger">*</span>
                  {{ Form::select('contract_acquisition', \Helper::contractAcquisition(), $contract->contract_acquisition, ['class' => 'form-control', 'placeholder' => 'เลือกประเภทการได้มาของสัญญา...']) }}
                  <div class="invalid-feedback">
                    {{ __('สัญญา') }}
                  </div>
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
