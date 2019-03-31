$(document).ready(function() {
	console.log("ababa");
	$(document.body).delegate(".hapus", "click", function() {
		console.log(this.id);
		$.ajax({
			url: "<?php echo site_url('proses/nonaktifkan_anggota/')?>" + this.id,
			success: function(result) {
				$("#table-body").html(result);
			}
		});
	});
});
