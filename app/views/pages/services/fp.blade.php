<input type="hidden" id="txtFpId" value="">

<div class="panel-group" id="fpAccordion">
	<div class="panel panel-primary">
	    <div class="panel-heading">
	        <h4 class="panel-title">
	            <a href="#collapseMain" data-toggle="collapse" data-parent="fpAccordion">
	                <i class="fa fa-edit"></i>
	                การให้บริการในครั้งนี้
	                <i class="fa fa-chevron-circle-down pull-right"></i>
	            </a>
	        </h4>
	    </div>
	    <div class="panel-collapse collapse in" id="collapseMain">
			<div class="panel-body">
				บันทึกข้อมูลการให้บริการคุมกำเนิด (เฉพาะให้บริการที่นี่เท่านั้น)
			</div>
        	<table class="table table-bordered" id="tblFpList">
        		<thead>
        			<tr>
						<th>วิธีการคุมกำเนิด</th>
						<th>ผู้ให้บริการ</th>
						<th>#</th>
        			</tr>
        		</thead>
				<tbody>
				@foreach ($fp as $r)
					<tr>
						<td>[{{ $r->export_code }}] {{ $r->fp_type_name }}</td>
						<td>{{ $r->fname }} {{ $r->lname }}</td>
						<td class="text-center">
							<a href="#" class="btn btn-sm btn-danger" data-name="btnFpRemove" data-id="{{ $r->id }}">
								<i class="fa fa-times"></i>
							</a>
						</td>
					</tr>
				@endforeach
				</tbody>
        	</table>
			
			<table class="table table-striped hidden" id="tblAddFp">
				<thead>
					<tr>
						<th>วิธีการคุมกำเนิด</th>
						<th>ผู้ให้บริการ</th>
						<th></th>
					</tr>
				</thead>
				<tbody>
					<tr>
						<td width="60%">
							<select class="form-control" id="slFpType">
							@foreach ($fptypes as $f) 
								<option value="{{ $f->id }}" data-export="{{ $f->export_code}}">
								[{{ $f->export_code }}] {{ $f->name }}
								</option>
							@endforeach
							</select>
						</td>
						<td width="30%">
							{{ Form::select('slProviders', $providers, null, ['id' => 'slProviders', 'class' => 'form-control']) }}
						</td>
						<td width="10%">
							<button class="btn btn-success" id="btnSaveFp">
								<i class="fa fa-save"></i>
							</button>
						</td>
					</tr>
				</tbody>
			</table>
	    </div>
	    <div class="panel-footer">
			<button class="btn btn-primary" id="btnAddFp">
				<i class="fa fa-plus-circle"></i> เพิ่มรายการ
			</button>
	        <small class="text-muted">คลิกที่ title bar เพื่อย่อ-ขยาย</small>
	    </div>
	</div>
	
	<div class="panel panel-primary">
	    <div class="panel-heading">
	        <h4 class="panel-title">
	            <a href="#collapseHistory" data-toggle="collapse" data-parent="fpAccordion">
	                <i class="fa fa-edit"></i>
	                ประวัติการรับบริการ
	                <i class="fa fa-chevron-circle-down pull-right"></i>
	            </a>
	        </h4>
	    </div>
	    <div class=" panel-body panel-collapse collapse" id="collapseHistory">
        	<p class="text-muted">Comming soon.</p>
	    </div>
	    <div class="panel-footer">
	        <small class="text-muted">คลิกที่ title bar เพื่อย่อ-ขยาย</small>
	    </div>
	</div>
</div>
