<div class="panel-group" id="NutriAccordion">
	<div class="panel panel-primary">
	    <div class="panel-heading">
	        <h4 class="panel-title">
	            <a href="#collapseMain" data-toggle="collapse" data-parent="NutriAccordion">
	                <i class="fa fa-edit"></i>
	                การให้บริการในครั้งนี้
	                <i class="fa fa-chevron-circle-down pull-right"></i>
	            </a>
	        </h4>
	    </div>
	    <div class="panel-collapse collapse in" id="collapseMain">
			<div class="panel-body">
				บันทึกข้อมูลการให้บริการตรวจภาวะโภชนาการ
				
				<form role="form" action="#">
					<div class="row">
						<div class="col-md-2 col-lg-2">
							<div class="form-group">
								<label for="">อายุ (ปี)</label>
								<input type="text" id="txtNutriAgeYear" class="form-control" readonly>
							</div>
						</div>
						<div class="col-md-2 col-lg-2">
							<div class="form-group">
								<label for="">(เดือน)</label>
								<input type="text" id="txtNutriAgeMonth" class="form-control" readonly>
							</div>
						</div>

						<div class="col-md-2 col-lg-2">
							<div class="form-group">
								<label for="">ส่วนสูง (cm.)</label>
								<input type="text" id="txtNutriHeight" class="form-control" value="{{ $screen->height }}" readonly>
							</div>
						</div>

						<div class="col-md-2 col-lg-2">
							<div class="form-group">
								<label for="">น้ำหนัก (Kg.)</label>
								<input type="text" id="txtNutriWeight" class="form-control" value="{{ $screen->weight }}" readonly>
							</div>
						</div>

						<div class="col-md-2 col-lg-2">
							<div class="form-group">
								<label for="">เส้นรอบศีรษะ (cm.)</label>
								<input type="text" data-type="number" id="txtNutriHeadCircum" 
								value="{{ isset($nutri->head_circum) ? $nutri->head_circum : null }}"
								class="form-control">
							</div>
						</div>
					</div> <!-- /row -->
					<div class="row">
						<div class="col-md-3 col-lg-3">
							<div class="form-group">
								<label>เกณฑ์อายุ/น้ำหนัก</label>
								<select id="slNutriAgeWeightScore" class="form-control">
									<option value="">-*-</option>
								@foreach ($aws as $a)
								@if (isset($nutri->age_weight_score))
								 	@if ($nutri->age_weight_score == $a->id)
   								 		<option value="{{ $a->id }}" selected="selected">{{ $a->name }}</option>
									@else
									 	<option value="{{ $a->id }}">{{ $a->name }}</option>
									@endif
								 @else
								  <option value="{{ $a->id }}">{{ $a->name }}</option>
								 @endif
								@endforeach
								</select>
							</div>
						</div>
						<div class="col-md-3 col-lg-3">
							<div class="form-group">
								<label>เกณฑ์อายุ/ส่วนสูง</label>
								<select class="form-control" id="slNutriAgeHeightScore">
									<option value="">-*-</option>
									@foreach ($ahs as $a)
									@if (isset($nutri->age_height_score))
									 	@if ($nutri->age_height_score == $a->id)
	   								 		<option value="{{ $a->id }}" selected="selected">{{ $a->name }}</option>
										@else
										 	<option value="{{ $a->id }}">{{ $a->name }}</option>
										@endif
									 @else
									  <option value="{{ $a->id }}">{{ $a->name }}</option>
									 @endif
									@endforeach
								</select>
							</div>
						</div>
						<div class="col-md-3 col-lg-3">
							<div class="form-group">
								<label>เกณฑ์น้ำหนัก/ส่วนสูง</label>
								<select class="form-control" id="slNutriWeightHeightScore">
									<option value="">-*-</option>
									@foreach ($whs as $a)
									@if (isset($nutri->weight_height_score))
									 	@if ($nutri->weight_height_score == $a->id)
	   								 		<option value="{{ $a->id }}" selected="selected">{{ $a->name }}</option>
										@else
										 	<option value="{{ $a->id }}">{{ $a->name }}</option>
										@endif
									 @else
									  <option value="{{ $a->id }}">{{ $a->name }}</option>
									 @endif
									@endforeach
								</select>
							</div>
						</div>
					</div> <!-- /row -->
					<div class="row">
						<div class="col-md-3 col-lg-3">
							<div class="form-group">
								<label>ระดับพัฒนาการเด็ก</label>
								<select class="form-control" id="slNutriChildDevelop">
									<option value="">-*-</option>
									@foreach ($child as $a)
									@if (isset($nutri->child_develop))
									 	@if ($nutri->child_develop == $a->id)
	   								 		<option value="{{ $a->id }}" selected="selected">{{ $a->name }}</option>
										@else
										 	<option value="{{ $a->id }}">{{ $a->name }}</option>
										@endif
									 @else
									  <option value="{{ $a->id }}">{{ $a->name }}</option>
									 @endif
									@endforeach
								</select>
							</div>
						</div>
						<div class="col-md-3 col-lg-3">
							<div class="form-group">
								<label>อาหารที่รับประทาน</label>
								<select class="form-control" id="slNutriFood">
									<option value="">-*-</option>
									@foreach ($food as $a)
									@if (isset($nutri->food))
									 	@if ($nutri->food == $a->id)
	   								 		<option value="{{ $a->id }}" selected="selected">{{ $a->name }}</option>
										@else
										 	<option value="{{ $a->id }}">{{ $a->name }}</option>
										@endif
									 @else
									  <option value="{{ $a->id }}">{{ $a->name }}</option>
									 @endif
									@endforeach
								</select>
							</div>
						</div>
						<div class="col-md-3 col-lg-3">
							<div class="form-group">
								<label>การใช้ขวดนม</label>
								<select class="form-control" id="slNutriBottle">
									<option value="">-*-</option>
									@foreach ($bottle as $a)
									@if (isset($nutri->bottle))
									 	@if ($nutri->bottle == $a->id)
	   								 		<option value="{{ $a->id }}" selected="selected">{{ $a->name }}</option>
										@else
										 	<option value="{{ $a->id }}">{{ $a->name }}</option>
										@endif
									 @else
									  <option value="{{ $a->id }}">{{ $a->name }}</option>
									 @endif
									@endforeach
								</select>
							</div>
						</div>
					</div> <!-- /row -->
					<div class="row">
						<div class="col-md-6 col-lg-6">
							<label>ผู้ให้บริการ</label>
							{{ Form::select('slNutriProviders', $providers, isset($nutri->provider_id) ? $nutri->provider_id : null, ['id' => 'slNutriProviders', 'class' => 'form-control']) }}
						</div>
					</div>
				</form>	
			</div>
	    </div>
	    <div class="panel-footer">
			<button class="btn btn-success" id="btnNutriSave">
				<i class="fa fa-save"></i> บันทึกข้อมูล
			</button>
			<button class="btn btn-danger" id="btnNutriDelete">
				<i class="fa fa-trash-o"></i> ลบรายการ
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
