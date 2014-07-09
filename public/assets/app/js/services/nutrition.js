$(function () {
	var nutri = {};
	
	nutri.doSave = function (items, cb) {
		app.post(serviceUrl[31], items, function(err) {
			if (err) {
				cb(err);
			} else {
				cb(null);
			}
		});
	};
	
	$('#btnNutriSave').on('click', function (e) {
		e.preventDefault();
		
		var items = {};
		
		items.weight = $('#txtNutriWeight').val();
		items.height = $('#txtNutriHeight').val();
		items.head_circum = $('#txtNutriHeadCircum').val();
		items.child_develop = $('#slNutriChildDevelop').val();
		items.food = $('#slNutriFood').val();
		items.bottle = $('#slNutriBottle').val();
		items.provider_id = $('#slNutriProviders').val();
		items.age_weight_score = $('#slNutriAgeWeightScore').val();
		items.age_height_score = $('#slNutriAgeHeightScore').val();
		items.weight_height_score = $('#slNutriWeightHeightScore').val();
		
		items.service_id = $('#txtServiceId').val();
		
		if (!items.weight) {
			app.alert('กรุณาระบุน้ำหนัก');
		} else if (!items.height) {
			app.alert('กรุณาระบุส่วนสูง');
		} else {
			nutri.doSave(items, function (err) {
				if (err) {
					app.alert(err);
				} else {
					app.alert('บันทึกรายการเสร็จเรียบร้อยแล้ว');
				}
			});
		}
		
	});
	
	$('#txtNutriAgeYear').val($('#txtPersonAgeYear').val());
	$('#txtNutriAgeMonth').val($('#txtPersonAgeMonth').val());
	
});