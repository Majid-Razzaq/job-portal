@extends('front.layouts.app')

@section('content')

<section class="section-5">
    <div class="container my-5">
        <div class="py-lg-2">&nbsp;</div>

        @if(Session::has('success'))
            <div class="alert alert-success">
                <p class="mb-0 pb-0">{{ Session::get('success') }}</p>
            </div>
        @endif

        @if(Session::has('error'))
            <div class="alert alert-danger">
                <p class="mb-0 pb-0">{{ Session::get('error') }}</p>
            </div>
        @endif

        <div class="row d-flex justify-content-center">
            <div class="col-md-5">
                <div class="card shadow border-0 p-5">
                    <h1 class="h3">Forgot Password</h1>
                    <form action="{{ route('account.processForgotPassword') }}" method="post" name="loginForm" id="loginForm">
                        @csrf
                        <div class="mb-3">
                            <label for="" class="mb-2">Email*</label>
                            <input type="text" value="{{ old('email') }}" name="email" id="email" class="form-control @error('email') is-invalid @enderror" placeholder="example@example.com">
                            @error('email')
                                <p class="invalid-feedback">{{ $message }}</p>
                            @enderror
                        </div>
                        <div class="justify-content-between d-flex">
                        <button class="btn btn-primary mt-2" type="submit">Submit</button>
                        </div>
                    </form>
                </div>
                <div class="mt-4 float-end">
                    <p><a  href="{{ route('account.login') }}">Back to login</a></p>
                </div>
            </div>
        </div>
        <div class="py-lg-5">&nbsp;</div>
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
    <script>

    </script>
@endsection
