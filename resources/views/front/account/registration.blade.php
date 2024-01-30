@extends('front.layouts.app')


@section('content')

<section class="section-5">
    <div class="container my-5">
        <div class="py-lg-2">&nbsp;</div>
        <div class="row d-flex justify-content-center">
            <div class="col-md-5">
                <div class="card shadow border-0 p-5">
                    <h1 class="h3">Register</h1>
                    <form action="" name="registrationForm" id="registrationForm">
                        @csrf
                        @method('POST')
                        <div class="mb-3">
                            <label for="" class="mb-2">Name*</label>
                            <input type="text" name="name" id="name" class="form-control" placeholder="Enter Name">
                            <p></p>
                        </div>
                        <div class="mb-3">
                            <label for="" class="mb-2">Email*</label>
                            <input type="text" name="email" id="email" class="form-control" placeholder="Enter Email">
                            <p></p>
                        </div>
                        <div class="mb-3">
                            <label for="" class="mb-2">Password*</label>
                            <input type="password" name="password" id="password" class="form-control" placeholder="Enter Password">
                            <p></p>
                        </div>
                        <div class="mb-3">
                            <label for="" class="mb-2">Confirm Password*</label>
                            <input type="password" name="confirm_password" id="confirm_password" class="form-control" placeholder="Please confirm Password">
                            <p></p>
                        </div>
                        <button class="btn btn-primary mt-2" type="submit">Register</button>
                    </form>
                </div>
                <div class="mt-4 text-center">
                    <p>Have an account? <a  href="{{ route('account.login') }}">Login</a></p>
                </div>
            </div>
        </div>
    </div>
</section>
<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title pb-0" id="exampleModalLabel">Change Profile Picture</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <form>
            <div class="mb-3">
                <label for="exampleInputEmail1" class="form-label">Profile Image</label>
                <input type="file" class="form-control" id="image"  name="image">
            </div>
            <div class="d-flex justify-content-end">
                <button type="submit" class="btn btn-primary mx-3">Update</button>
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            </div>

        </form>
      </div>
    </div>
  </div>
</div>

@endsection

{{-- Custom Js start --}}
@section('customJs')
    <script type="text/javascript">
    $("#registrationForm").submit(function (e) {
        e.preventDefault();

        $.ajax({
            type: "POST",
            url: '{{ route("account.processRegistration") }}',
            data: $("#registrationForm").serializeArray(),
            dataType: "json",
            success: function (response) {
                if(response.status == false){
                    var errors = response.errors;

                    // For name
                    if(errors.name){
                        $("#name").addClass('is-invalid').siblings('p').addClass('invalid-feedback').html(errors.name);
                    }else{
                        $("#name").removeClass('is-invalid').siblings('p').removeClass('invalid-feedback').html("");
                    }

                    // For email
                    if(errors.email){
                        $("#email").addClass('is-invalid').siblings('p').addClass('invalid-feedback').html(errors.email);
                    }else{
                        $("#email").removeClass('is-invalid').siblings('p').removeClass('invalid-feedback').html("");
                    }

                    // For password
                    if(errors.password){
                        $("#password").addClass('is-invalid').siblings('p').addClass('invalid-feedback').html(errors.password);
                    }else{
                        $("#password").removeClass('is-invalid').siblings('p').removeClass('invalid-feedback').html("");
                    }

                    // For confirm_password
                    if(errors.confirm_password){
                        $("#confirm_password").addClass('is-invalid').siblings('p').addClass('invalid-feedback').html(errors.confirm_password);
                    }else{
                        $("#confirm_password").removeClass('is-invalid').siblings('p').removeClass('invalid-feedback').html("");
                    }
                }else{

                    $("#name").removeClass('is-invalid').siblings('p').removeClass('invalid-feedback').html("");
                    $("#email").removeClass('is-invalid').siblings('p').removeClass('invalid-feedback').html("");
                    $("#password").removeClass('is-invalid').siblings('p').removeClass('invalid-feedback').html("");
                    $("#confirm_password").removeClass('is-invalid').siblings('p').removeClass('invalid-feedback').html("");

                    window.location.href="{{ route('account.login') }}";
                }
            }
        });

    });
    </script>
@endsection
