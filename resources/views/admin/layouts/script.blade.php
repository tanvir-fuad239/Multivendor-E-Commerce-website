  <!--end wrapper-->

    <!-- Bootstrap JS -->
    <script src="{{ asset('backend') }}/assets/js/bootstrap.bundle.min.js"></script>
   {{-- fontawesome cdn --}}
   <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/js/all.min.js" integrity="sha512-uKQ39gEGiyUJl4AI6L+ekBdGKpGw4xJ55+xyJG7YFlJokPNYegn9KwQ3P8A7aFQAUtUsAQHep+d/lrGqrbPIDQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <!--plugins-->
    <script src="{{ asset('backend') }}/assets/js/jquery.min.js"></script>
    <script src="{{ asset('backend') }}/assets/plugins/simplebar/js/simplebar.min.js"></script>
    <script src="{{ asset('backend') }}/assets/plugins/metismenu/js/metisMenu.min.js"></script>
    <script src="{{ asset('backend') }}/assets/plugins/perfect-scrollbar/js/perfect-scrollbar.js"></script>
    <script src="{{ asset('backend') }}/assets/plugins/chartjs/js/Chart.min.js"></script>
    <script src="{{ asset('backend') }}/assets/plugins/vectormap/jquery-jvectormap-2.0.2.min.js"></script>
    <script src="{{ asset('backend') }}/assets/plugins/vectormap/jquery-jvectormap-world-mill-en.js"></script>
    <script src="{{ asset('backend') }}/assets/plugins/jquery.easy-pie-chart/jquery.easypiechart.min.js"></script>
    <script src="{{ asset('backend') }}/assets/plugins/sparkline-charts/jquery.sparkline.min.js"></script>
    <script src="{{ asset('backend') }}/assets/plugins/jquery-knob/excanvas.js"></script>
    <script src="{{ asset('backend') }}/assets/plugins/jquery-knob/jquery.knob.js"></script>
    <script src="{{ asset('backend') }}/assets/plugins/datatable/js/jquery.dataTables.min.js"></script>
	<script src="{{ asset('backend') }}/assets/plugins/datatable/js/dataTables.bootstrap5.min.js"></script>
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    
    {{-- <script src="https://code.jquery.com/jquery-3.7.1.min.js" integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script> --}}
    
 
    <script src="{{ asset('backend') }}/assets/plugins/input-tags/js/tagsinput.js"></script>  
	<script>
		$(document).ready(function() {
			$('#example').DataTable();
		  } );
	</script>
	<script>
		$(document).ready(function() {
			var table = $('#example2').DataTable( {
				lengthChange: false,
				buttons: [ 'copy', 'excel', 'pdf', 'print']
			} );
		 
			table.buttons().container()
				.appendTo( '#example2_wrapper .col-md-6:eq(0)' );
		} );
	</script>

    <script>
        $(function () {
            $(".knob").knob();
        });
    </script>
    <script src="{{ asset('backend') }}/assets/js/index.js"></script>
    <!--app JS-->
    <script src="{{ asset('backend') }}/assets/js/app.js"></script>

    {{-- dynamic image setup  --}}
    <script>

        $(document).ready(function(){
            
            $("#photo").change(function(e){
                let reader = new FileReader();
                reader.onload = function(e){
                    $("#selected_photo").attr('src', e.target.result);
                }
                reader.readAsDataURL(e.target.files['0']);
            });

            $("#slider_image").change(function(e) {
                var file = e.target.files[0];  
                var fileType = file.type; 

            
                if (fileType.match('image.*')) {
                    let reader = new FileReader();
                    reader.onload = function(e) {
                        $("#selected_photo").attr('src', e.target.result);
                    }
                    reader.readAsDataURL(file);
                } else {
                    $("#selected_photo").removeAttr('src');  
                    $("#display_image").hide();
                }
            });

        });

    </script>

    {{-- for product thumbnail  --}}
    <script>

        function mainThumUrl(input){
            if(input.files && input.files[0]){
                var reader = new FileReader();
                reader.onload = function(e){
                    $("#mainThum").attr("src", e.target.result).width(80).height(80);
                }

                reader.readAsDataURL(input.files[0]);
            }
        }


    </script>

    {{-- product multi images  --}}
     
    <script>
        $(document).ready(function() {
            $('#multi_imgs').on('change', function() {
                // Clear previous previews
                $('#preview_img').empty();

                // Display selected images
                var files = $(this)[0].files;
                for (var i = 0; i < files.length; i++) {
                    // Use a closure to capture the correct value of i
                    (function(index) {
                        var reader = new FileReader();
                        reader.onload = function(e) {
                            $('#preview_img').append('<img src="' + e.target.result + '" class="img_thumbnail" alt="' + files[index].name + '">');
                        };
                        reader.readAsDataURL(files[index]);
                    })(i);
                }
            });
        });

    </script>



	 {{-- when we select category we can show only those subcategories which are under this category using jquery --}}

	 <script>

		$(document).ready(function() {

			$('#categoryDropdown').on('change', function() {
				var category_id = $(this).val();

				if (category_id) {
					$.ajax({
						url: '/admin/product/get/subcategory/' + category_id,
						type: 'GET',
						dataType: 'json',
						success: function(data) {
                            var subcategoryDropdown = $('#subcategoryDropdown');
                            subcategoryDropdown.empty();
                            if(!(data.length) == 0){ 
                                
                                // Clear and populate the subcategory dropdown

                                $.each(data, function(key, value) {
								subcategoryDropdown.append('<option value="' + value.id + '">' + value.subcategory_name + '</option>');
							    });
                            }
                            else{
                                subcategoryDropdown.append("<option>Not Found</option>");
                            }
						}
					});
				} else {
					// Handle the case when no category is selected
					$('#subcategoryDropdown').empty();
				}
			});
		});

        // for hero slider active inactive toggle
        document.addEventListener('DOMContentLoaded', function () {
            $('.toggle-status').on('click', function() {
                var sliderId = $(this).data('id');
                var status = $(this).data('status');

                $.ajax({
                    url: "{{ url('admin/slider/status') }}/" + sliderId,
                    type: 'GET',
                    dataType: 'json',
                    success: function(response) {
                        if(response.status) {
                            $('a[data-id="' + sliderId + '"]').html('<i class="fas fa-toggle-on fs-2"></i>').data('status', 1);

                            Swal.fire({
                                title: 'Success!',
                                text: 'Slider activated successfully!',
                                icon: 'success',
                                confirmButtonText: 'OK',
                                timer: 2000
                            });

                        } else {
                            $('a[data-id="' + sliderId + '"]').html('<i class="fas fa-toggle-off fs-2"></i>').data('status', 0);

                            Swal.fire({
                                title: 'Success!',
                                text: 'Slider deactivated successfully!',
                                icon: 'success',
                                confirmButtonText: 'OK',
                                timer: 2000
                            });

                        }
                        // Optionally, add a message to the user indicating the change was successful.
                    },
                    error: function() {

                        Swal.fire({
                            title: 'Error!',
                            text: 'There was an error updating the status.',
                            icon: 'error',
                            confirmButtonText: 'OK',
                            timer: 2000
                        });

                    }
                });
                
            });
        });

   

    </script>

    {{-- toastr js --}}
    <script>

        @if(Session::has('message'))
            toastr.options =
            {
                "closeButton" : true,
                "progressBar" : true,
            }
            toastr.success("{{ session('message') }}");


        @elseif(Session::has('error'))
            toastr.options =
            {
                "closeButton" : true,
                "progressBar" : true
            }
            toastr.error("{{ session('error') }}");

        @endif

    </script> 
 

    <script src='https://cdn.tiny.cloud/1/vdqx2klew412up5bcbpwivg1th6nrh3murc6maz8bukgos4v/tinymce/5/tinymce.min.js' referrerpolicy="origin">
    </script>
    <script>
    tinymce.init({
        selector: '#mytextarea'
    });
    </script>
</body>

</html>