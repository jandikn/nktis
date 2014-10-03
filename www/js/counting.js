	

	// vypocet polozek u noveho projektu
	function countFunction(form) {
		var standard_pages = form.standard_pages.value;
		var price1_zak = 0;
		var price2_zak = 0;
		var price1_dod = 0;
		var price2_dod = 0;

		if(form.translator1.checked) {
			form.price1_dod.disabled = false;
			form.price1_dod.value = 150*standard_pages;

			form.price1_zak.disabled = false;
			price1_zak = Math.round(form.price1_dod.value/0.7);
			form.price1_zak.value = price1_zak;
		}

		if(form.translator2.checked) {
			form.price2_dod.disabled = false;
			form.price2_dod.value = 180*standard_pages;

			form.price2_zak.disabled = false;
			price2_zak = Math.round(form.price2_dod.value/0.7);
			form.price2_zak.value = price2_zak;
		}

		var total_price_dod = parseInt(form.price1_dod.value) + parseInt(form.price2_dod.value);
		
		var total_price = Math.round((price1_zak + price2_zak) * (form.priplatek.value/100 + 1) * (1-form.sleva.value/100));

		form.total_price.value = total_price;
		form.revenue.value = total_price - total_price_dod;
		form.margin.value = Math.round(form.revenue.value/total_price*100);

		return;
	}

