<div class="panel panel-primary" id="panelRefer">
    <div class="panel-heading">
        <h4 class="panel-title">
            <i class="fa fa-ambulance"></i> บันทึกข้อมูลการส่งต่อ (Refer Out)
        </h4>
    </div>
    <div class="panel-body">
        <div class="row">
            <div class="col-md-3 col-lg-3">
                <label for="txtReferCode">เลขที่ใบส่งต่อ</label>
                <input class="form-control" type="text" value="{{ $refer->id or '' }}" id="txtReferId" readonly/>
            </div>
            <div class="col-md-3 col-lg-3">
                <label for="">วันที่ส่งต่อ</label>
                <div data-type="date-picker" class="input-group date col-sm-9">
                    <input type="text" placeholder="วว/ดด/ปปปป" class="form-control" id="txtReferDate"
                           value="{{ !empty($refer->refer_date) ? Helpers::toJSDate($refer->refer_date) : Helpers::getCurrentDate() }}">
                    <span class="input-group-addon"><i class="fa fa-calendar"></i></span>
                </div>
            </div>
            <div class="col-md-6 col-lg-6">
                <label for="txtReferHosp">ส่งต่อไปที่</label>
                <input class="form-control" type="hidden" id="txtReferHosp"
                       data-id="{{ $refer->to_hospital or '' }}"
                       data-text="{{ $refer->hospital_name or '' }}" />
            </div>
        </div>
        <div class="row">
            <div class="col-md-6 col-lg-6">
                <label for="">แพทย์/เจ้าหน้าที่</label>
                <select class="form-control" id="slReferProvider">
                    @foreach ($providers as $p)
                    @if (!empty($refer->provider_id))
                    @if ($refer->provider_id == $p->id)
                    <option value="{{ $p->id }}" selected="selected">{{$p->fname}} {{$p->lname}}</option>
                    @else
                    <option value="{{ $p->id }}">{{$p->fname}} {{$p->lname}}</option>
                    @endif
                    @else
                    <option value="{{ $p->id }}">{{$p->fname}} {{$p->lname}}</option>
                    @endif
                    @endforeach
                </select>
            </div>
            <div class="col-md-6 col-lg-6">
                <label for="">เหตุผลการส่งต่อ</label>
                <select class="form-control" id="slReferCause">
                    @foreach ($cause as $c)
                    @if (!empty($refer->cause_id))
                    @if ($refer->cause_id == $c->id)
                    <option value="{{ $c->id }}" selected="selected">{{$c->name}}</option>
                    @else
                    <option value="{{ $c->id }}">{{$c->name}}</option>
                    @endif
                    @else
                    <option value="{{ $c->id }}">{{$c->name}}</option>
                    @endif
                    @endforeach
                </select>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12 col-lg-12">
                <label for="">รหัสการวินิจฉัย</label>
                <input class="form-control" id="txtReferDiag" type="hidden"
                       data-id="{{ $refer->diagnosis_code or '' }}" data-text="{{ $refer->diag_name or '' }}"/>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12 col-lg-12">
                <label for="">อื่นๆ</label>
                <textarea class="form-control" id="txtReferDescription" rows="3">
                    {{ $refer->description or '' }}
                </textarea>
            </div>
        </div>
        <div class="row">
            <div class="col-md-3 col-lg-3">
                <label for="">วันหมดอายุ</label>
                <div data-type="date-picker" class="input-group date col-sm-9">
                    <input type="text" placeholder="วว/ดด/ปปปป" class="form-control"
                           value="{{ !empty($refer->expire_date) ? Helpers::toJSDate($refer->expire_date) : '' }}"
                           id="txtReferExpireDate">
                    <span class="input-group-addon"><i class="fa fa-calendar"></i></span>
                </div>
            </div>
        </div>
    </div>
    <div class="panel-footer">
        <a class="btn btn-primary" id="btnReferSave" href="javascript:void(0);">
            <i class="fa fa-save"></i> บันทึกข้อมูล
        </a>
        <a class="btn btn-danger" id="btnReferRemove" href="javascript:void(0);">
            <i class="fa fa-trash-o"></i> ลบรายการ
        </a>
    </div>
</div>
