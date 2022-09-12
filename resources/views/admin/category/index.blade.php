@extends('layouts.dashboard')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-lg-12 mb-5">
                <form action="{{ route('category.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="card">
                        <div class="card-header">
                            <h4>Add Categories</h4>
                        </div>
                        <div class="card-body">
                            @csrf
                            <div class="mb-3">
                                <label for="" class="form-label">Category Name</label>
                                <input type="text" class="form-control" name="category_name">
                            </div>
                            <div class="mb-3">
                                <label for="" class="form-label">Category Image</label>
                                <input type="file" class="form-control" name="category_img">

                            </div>
                            <div class="mb-2">
                                <label for="" class="form-label">Category Icon (Add Icon Class)</label>
                                <div class="d-flex">
                                    <Select style= "width: 8%; margin-right:10px; color:black;" class="form-control" id="icon_type" name="icon_type">
                                        <option value="fab">fab</option>
                                        <option value="fas">fas</option>
                                        <option value="fa">fa</option>
                                        <option value="far">far</option>
                                        <option value="fal">fal</option>
                                        <option value="icon">icon</option>
                                    </Select>
                                    <input style= "width: 90%" type="text" class="form-control" name="icon_name" placeholder="Add Icon Class" id="icon_name">
                                </div>

                            </div>
                            <div class="mt-2 mb-2 text-center">
                                <i id="show_icon" style="font-size: 42px;"></i>
                            </div>
                            <p class="text-info">( Icon Class Must Be Font Awesome 5 Icon Class )</p>
                            @error('category_img')
                                <strong class="text-danger">{{ $message }}</strong>
                            @enderror
                        </div>
                        <div class="card-footer">
                            <button id="dsa" type="submit" class="btn btn-primary">
                                Add Category
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection

@section('js_links')
    <!-- Required vendors -->
    <script src="{{ asset('backend/vendor/global/global.min.js') }}"></script>
    <script src="{{ asset('backend/vendor/bootstrap-select/dist/js/bootstrap-select.min.js') }}"></script>
    <script src="{{ asset('backend/js/custom.min.js') }}"></script>
    <script src="{{ asset('backend/js/deznav-init.js') }}"></script>
@endsection

@section('script')
<script>
    $('#icon_name').on('keyup', function(){
        showIcon();
    });

    $('#icon_type').change(function(){
        showIcon();
    });

    function showIcon(){
        var icon_type = $('#icon_type').val();
        var icon_name = $('#icon_name').val();
        $('#show_icon').attr('class', icon_type+" "+icon_name);
    }


</script>
@endsection

@section('script')

    @if (session('success'))
        <script>
            const Toast = Swal.mixin({
                toast: true,
                position: 'bottom-end',
                showConfirmButton: false,
                timer: 3000,
                timerProgressBar: true,
                didOpen: (toast) => {
                    toast.addEventListener('mouseenter', Swal.stopTimer)
                    toast.addEventListener('mouseleave', Swal.resumeTimer)
            }
            })

            Toast.fire({
                icon: 'success',
                title: '{{ session('success') }}'
            })
        </script>
    @endif
    @if (session('delete'))
        <script>
            const Toast = Swal.mixin({
                toast: true,
                position: 'bottom-end',
                showConfirmButton: false,
                timer: 3000,
                timerProgressBar: true,
                didOpen: (toast) => {
                    toast.addEventListener('mouseenter', Swal.stopTimer)
                    toast.addEventListener('mouseleave', Swal.resumeTimer)
            }
            })

            Toast.fire({
                icon: 'error',
                title: '{{ session('delete') }}'
            })
        </script>
    @endif
    <script>
        $("#click_all").click(function(){
            $('input:checkbox').not(this).prop('checked', this.checked);
        });
    </script>
    <script>
		$(function () {
			$('[data-toggle="popover"]').popover()
		})
	</script>
@endsection


