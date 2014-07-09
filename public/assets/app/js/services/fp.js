$(function() {
	
	var fp = {};
	
	// Save fp service
	fp.doSave = function (items, cb) {
		app.post(serviceUrl[29], items, function(err, data) {
			if (err) {
				cb(err);
			} else {
				cb(null, data.id);
			}
		});
	};
	
	fp.doRemove = function (id, cb) {
		app.delete(serviceUrl[30], { id: id }, function(err) {
			if (err) {
				cb(err);
			} else {
				cb(null);
			}
		});
	};
	
	$('#btnSaveFp').on('click', function(e) {
		e.preventDefault();
		
		var 
		age = $('#txtPersonAgeYear').val(),
		sex = $('#txtPersonSex').val(),
		
		export_code = $('#slFpType')
						.find('option:selected')
						.data('export');
		
		var 
		items = {};
		items.fp_type_id = $("#slFpType").val();
		items.provider_id = $('#slProviders').val();
		items.service_id = $('#txtServiceId').val();
		items.id = $('#txtFpId').val();
		
		var isValidAge = false, isValidSex = false;
		
		// Validation for sex
		isValidSex = sex == '2' ? 
							_.indexOf([1, 2, 3, 4, 5, 7], parseInt(export_code)) :
							_.indexOf([5, 6], parseInt(export_code));
							
		// -1 = not valid , 0-5 = valid
		isValidSex = isValidSex != -1 ? true : false;
		// Validation for age
		isValidAge = parseInt(age) >= 9 && parseInt(age) <= 60;
		
		if (isValidSex && isValidAge) {
			fp.doSave(items, function(err, id) {
				if (!err) {
					var 
					$table = $('#tblFpList').find('tbody'),
					fp_name = $('#slFpType').find('option:selected').text(),
					provider_name = $('#slProviders').find('option:selected').text(),
					html = [
						'<tr>' ,
						'<td>' + fp_name + '</td>',
						'<td>' + provider_name + '</td>',
						'<td class="text-center"><a href="#" class="btn btn-sm btn-danger" data-name="btnFpRemove" data-id="' + id + '">',
						'<i class="fa fa-times"></i>',
						'</a></td>',
						'</tr>'
					].join('');
					
					$table.append(html);
					
					$('#tblAddFp').toggleClass('hidden');
					
				} else {
					app.alert(err);
				}
			});
		} else {
			alert('ไม่สามารถเพิ่มรายการนี้ได้เนื่องจากผิดเงื่อนไขการคุมกำเนิด กรุณาตรวจสอบ เพศ และอายุ');
		}
	});
	
	// hide/show new row
	$('#btnAddFp').on('click', function(e) {
		e.preventDefault();
		
		$('#tblAddFp').toggleClass('hidden');
	});
	
	$(document).off('click', 'a[data-name="btnFpRemove"]');
	$(document).on('click', 'a[data-name="btnFpRemove"]', function(e) {
		e.preventDefault();
		var id = $(this).data('id');
		var $tr = $(this).parent().parent();
		
		if (confirm('คุณต้องการลบรายการนี้ใช่หรือไม่?')) {
			fp.doRemove(id, function(err) {
				if (err) {
					app.alert(err);
				} else {
					$tr.fadeOut();
				}
			});
		}
	});
});