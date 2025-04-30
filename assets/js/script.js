$(document).ready(function () {

	

	
    $('#no_reff').on('change', function() {
		
      var id_kategori = $(this).val();
	  console.log(id_kategori);
      if(id_kategori) {
        $.ajax({
          url: BASE_URL + "kategori/getter",
          type: "POST",
          data: { id_kategori: id_kategori },
          dataType: "json",
          success: function(data) {
			console.log(data);
            $('#sub_kategori').empty().append('<option value="">-- Pilih Sub Kategori --</option>');
            $.each(data, function(key, value) {
              $('#sub_kategori').append('<option value="'+ value.id_sub +'">'+ value.nama_reff_sub +'</option>');
            });
          }
        });
      } else {
        $('#sub_kategori').empty().append('<option value="">-- Pilih Sub Kategori --</option>');
      }
    });

	$('#datepicker').datepicker({
		format: "yyyy-mm-dd",
		autoclose: true,
		todayHighlight: true,
	});

	$('#tabelKategori').DataTable({
        "language": {
            "search": "Cari:",
            "lengthMenu": "Tampilkan _MENU_ data",
            "info": "Menampilkan _START_ sampai _END_ dari _TOTAL_ data",
            "paginate": {
                "first": "Pertama",
                "last": "Terakhir",
                "next": "→",
                "previous": "←"
            },
            "zeroRecords": "Tidak ada data ditemukan",
        },
        "pageLength": 10,
        "lengthChange": false,
        "autoWidth": false,
        "ordering": true,
    });
	$('#tabelKas').DataTable({
        "language": {
            "search": "Cari:",
            "lengthMenu": "Tampilkan _MENU_ data",
            "info": "Menampilkan _START_ sampai _END_ dari _TOTAL_ data",
            "paginate": {
                "first": "Pertama",
                "last": "Terakhir",
                "next": "→",
                "previous": "←"
            },
            "zeroRecords": "Tidak ada data ditemukan",
        },
        "pageLength": 10,
        "lengthChange": false,
        "autoWidth": false,
        "ordering": true,
    });
	function validasiSaldo(e) {
		let saldo = $('.saldo').val();
		let namaAkun = $('#no_reff').val();

		if (saldo == '') {
			e.preventDefault();
			swal({
				type: 'error',
				title: 'Oops...',
				text: 'Saldo wajib di isi',
			});
		}

		if (namaAkun == '') {
			e.preventDefault();
			swal({
				type: 'error',
				title: 'Oops...',
				text: 'Nama Akun wajib di isi',
			});
		}
	}

	$('#button_jurnal').on('click', function (e) {
		validasiSaldo(e);
	});

	$('#button_akun').on('click', function (e) {
		let noReff = $('#no_reff').val();
		let nama = $('#nama').val();
		let keterangan = $('#keterangan').val();

		if (noReff == '') {
			e.preventDefault();
			swal({
				type: 'error',
				title: 'Oops...',
				text: 'No.Reff wajib di isi',
			});
		} else if (nama == '') {
			e.preventDefault();
			swal({
				type: 'error',
				title: 'Oops...',
				text: 'Nama Reff wajib di isi',
			});
		} else if (keterangan == '') {
			e.preventDefault();
			swal({
				type: 'error',
				title: 'Oops...',
				text: 'Keterangan wajib di isi',
			});
		}
	});

	$('.hapus').on('click', function (e) {
		e.preventDefault();
		let form = $(this).parent();
		console.log(form);
		swal({
			title: 'Apakah data akan di hapus',
			type: 'warning',
			showCancelButton: true,
			confirmButtonColor: '#3085d6',
			cancelButtonColor: '#d33',
			confirmButtonText: 'Hapus'
		}).then((result) => {
			if (result.value) {
				form.submit();
			} else {
				swal("Aman!", 'Data Tidak Di Hapus', "success");
			}
		})
	});

	$('.tab-nav').eq(0).addClass('active');
	$('.tab-pane').eq(0).addClass('show active');

	$('#no_reff').change(function () {
		let nilai = $(this).val();
		$('#reff').val(nilai);
	});

	$(window).on('load', function () {
		let nilai = $('#no_reff').val();
		$('#reff').val(nilai);
	});
});


document.addEventListener('DOMContentLoaded', function () {
	const ctxCombined = document.getElementById('chart-combined').getContext('2d');
	new Chart(ctxCombined, {
	  type: 'bar',
	  data: {
		labels: ['Jan', 'Feb', 'Mar', 'Apr', 'Mei', 'Jun', 'Jul', 'Agu', 'Sep', 'Okt', 'Nov', 'Des'],
		datasets: [
		  {
			label: 'Pendapatan (Rp Juta)',
			data: [120, 150, 180, 170, 200, 190, 210, 230, 220, 250, 240, 260],
			backgroundColor: 'rgba(75, 192, 192, 0.2)',
			borderColor: 'rgba(75, 192, 192, 1)',
			borderWidth: 1
		  },
		  {
			label: 'Pengeluaran (Rp Juta)',
			data: [80, 90, 100, 110, 120, 130, 140, 150, 160, 170, 180, 190],
			backgroundColor: 'rgba(255, 99, 132, 0.2)',
			borderColor: 'rgba(255, 99, 132, 1)',
			borderWidth: 1
		  }
		]
	  },
	  options: {
		scales: {
		  y: {
			beginAtZero: true,
			title: {
			  display: true,
			  text: 'Jumlah (Rp Juta)'
			}
		  },
		  x: {
			title: {
			  display: true,
			  text: 'Bulan'
			}
		  }
		},
		plugins: {
		  legend: {
			display: true
		  }
		}
	  }
	});
});