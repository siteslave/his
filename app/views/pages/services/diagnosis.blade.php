
<div class="panel panel-primary">
    <div class="panel-heading">
        <h4 class="panel-title"><i class="fa fa-ambulance"></i> การใหัรหัสวินิจฉัยโรค (Diagnosis)</h4>
    </div>
    <div class="panel-body">
        ระบุรหัสการวินิจฉัยโรค สามารถใช้ได้ทั้ง ICD10, ICD10-TM
    </div>
    <table class="table table-bordered" id="tblDiagList">
        <thead>
        <tr>
            <th>รหัส</th>
            <th>คำอธิบาย</th>
            <th>ประเภทการวินิจฉัย</th>
            <th>#</th>
        </tr>
        </thead>
        <tbody>
        <tr id="trAddDiag" class="hidden">
            <td colspan="2">
                <input type="hidden" id="txtDiagQuery" class="form-control"/>
            </td>
            <td>
                <select name="" id="slDiagType" class="form-control">
                    @foreach ($diagtype as $t)
                    <option value="{{ $t->code }}">[{{ $t->code }}] {{ $t->name }}</option>
                    @endforeach
                </select>
            </td>
            <td><a href="javascript:void(0);" class="btn btn-success" id="btnDiagSave"><i class="fa fa-save"></i></a></td>
        </tr>
        @foreach ($diag as $d)
        <tr>
            <td class="text-center">{{ $d->diagnosis_code }}</td>
            <td>[{{ $d->diagnosis_code }}] {{ $d->diagnosis_name }}</td>
            <td>[{{ $d->diagnosis_type_code }}] {{ $d->diagnosis_type_name }}</td>
            <td class="text-center">
                <a href="javascript:void(0);" data-name="btnRemoveDiag"
                   class="btn btn-sm btn-danger" data-id="{{ $d->id }}">
                    <i class="fa fa-times"></i>
                </a>
            </td>
        </tr>
        @endforeach
        </tbody>
    </table>
    <div class="panel-footer">
        <button class="btn btn-primary" id="btnDiagNew">
            <i class="fa fa-plus"></i> เพิ่ม/ซ่อน
        </button>
    </div>
</div>