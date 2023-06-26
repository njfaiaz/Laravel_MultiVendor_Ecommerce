

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css" integrity="sha512-vKMx8UnXk60zUwyUnUPM3HbQo8QfmNx7+ltw8Pm5zLusl1XIfwcxo8DbWCqMGKaWeNxWA8yrx5v3SaVpMvR3CA==" crossorigin="anonymous" referrerpolicy="no-referrer" />



<script src="https://code.jquery.com/jquery-3.7.0.min.js" integrity="sha256-2Pmvv0kuTBOenSvLm6bvfBSSHrUJ+3A7x6P5Ebd07/g=" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js" integrity="sha512-VEd+nq25CkR676O+pLBnDW09R7VQX9Mdiij052gVCp5yVH3jGtH70Ho/UUv4mJDsEdTvqRCFZg0NKGiojGnUCw==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>



@if (Session::has('message'))
    <script>
        var type ="{{ Session::get('alert', 'info') }}"
            switch(type){
            case 'info':
            toastr.ingfo("{{ Session::get('message') }}", 'Success!', {timeOut:2000});
            break;

            case 'success':
            toastr.success("{{ Session::get('message') }}", 'Success!', {timeOut:2000});
            break;

            case 'warning':
            toastr.warning("{{ Session::get('message') }}", 'Success!', {timeOut:2000});
            break;

            case 'error':
            toastr.error(" {{ Session::get('message') }} ");
            break;
        }
    </script>

@endif



<script src="{{ asset('admin/assets/sweetalert.min.js') }}"></script>

<script>
$(document).on("click", "#delete", function(e){
    e.preventDefault();
    var link = $(this).attr("href");

    swal({
        title: "Are you sure To Delete?",
        text: "Once deleted, you will not be able to recover this imaginary file!",
        icon: "warning",
        buttons: true,
        dangerMode: true,
        })
        .then((willDelete) => {
        if (willDelete) {
            window.location.href = link;

        } else {
            swal("Your imaginary file is safe!");
        }

    });
});




</script>
