<x-app-layout>
  <x-slot:content>
    <div class="container-fluid">
      <div class="animated fadeIn">
        <div class="row">
          <div class="col-sm-12 col-md-12 col-lg-12 col-xl-12">
            <x-card title="สัญญาทั้งหมด">
              <x-slot:toolbar>
                <a href="{{ route('contract.create') }}" class="btn btn-success text-white">เพิ่มสัญญา</a>
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
                  @foreach ($contracts as $contract)
                    <tr>
                      <td></td>
                      <td>
                        {{ $contract['contract_name'] }}<br>
                        <span class="badge bg-info">{{ \Helper::date($contract->contract_start_date) }}</span> -
                        <span class="badge bg-info">{{ \Helper::date($contract->contract_end_date) }}</span>
                        @if ($contract->task->count() > 0)
                          <span class="badge bg-warning">{{ $contract->task->count() }} กิจกรรม</span>
                        @endif
                      </td>
                      <td class="text-end">
                        <a href="{{ route('contract.show', $contract->hashid) }}" class="btn btn-primary text-white"><i class="cil-folder-open "></i></a>
                        <a href="{{ route('contract.edit', $contract->hashid) }}" class="btn btn-warning text-white"> <i class="cil-cog"></i> </a>
                        <form action="{{ route('contract.destroy', $contract->hashid) }}" method="POST" style="display:inline">
                          @method('DELETE')
                          @csrf
                          <button class="btn btn-danger btn-delete text-white"><i class="cil-trash"></i></button>
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
