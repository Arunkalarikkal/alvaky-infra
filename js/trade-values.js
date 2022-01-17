$(document).ready(function () {
	$(window).on("load", function () {
		var intervalId = window.setInterval(function () {
			$.ajax({
				url: "http://localhost/get-tradevalue.php",
				dataType: 'jsonp',
				success: function (json) {
					console.log("Success", json);
					if (json != undefined) {
						if (json.gold != undefined) {
							gold_value = json.gold
							$('#gold-value').html(gold_value.value + "&nbsp");
							$('#gold-diff').html(gold_value.percent + "%" + "(" + gold_value.diff + ")");

							if (gold_value.status == 1) {
								$("#gold-diff").css("color", "#3EA055");
							} else {
								$("#gold-diff").css("color", "#C36241");
							}
						}

						if (json.silver != undefined) {
							silver_value = json.silver
							$('#silver-value').html(silver_value.value + "&nbsp");
							$('#silver-diff').html(silver_value.percent + "%" + "(" + silver_value.diff + ")");

							if (silver_value.status == 1) {
								$("#silver-diff").css("color", "#3EA055");
							} else {
								$("#silver-diff").css("color", "#C36241");
							}
						}
					}
				},
				error: function () {
					alert("Error");
				}
			});
		}, 1000);
	});
});