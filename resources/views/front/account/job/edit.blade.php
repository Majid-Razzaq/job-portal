@extends('front.layouts.app')

@section('content')
<section class="section-5 bg-2">
    <div class="container py-5">
        <div class="row">
            <div class="col">
                <nav aria-label="breadcrumb" class=" rounded-3 p-3 mb-4">
                    <ol class="breadcrumb mb-0">
                        <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
                        <li class="breadcrumb-item active">Edit Job</li>
                    </ol>
                </nav>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-3">
                @include('front.account.sidebar')
            </div>
            <div class="col-lg-9">
                @include('front.message')
                <form action="" method="post" name="updateJobForm" id="updateJobForm">
                    @csrf
                    <div class="card border-0 shadow mb-4">
                        <div class="card-body card-form p-4">
                            <h3 class="fs-4 mb-1">Edit Job Details</h3>
                            <div class="row">
                                <div class="col-md-6 mb-4">
                                    <label for="" class="mb-2">Title<span class="req">*</span></label>
                                    <input type="text" value="{{ $job->title }}" placeholder="Job Title" id="title" name="title" class="form-control">
                                    <p></p>
                                </div>
                                <div class="col-md-6  mb-4">
                                    <label for="" class="mb-2">Category<span class="req">*</span></label>
                                    <select name="category" id="category" class="form-control">
                                        <option value="">Select a Category</option>
                                        @if ($categories->isNotEmpty())
                                        @foreach ($categories as $category)
                                            <option {{ ($job->category_id == $category->id) ? 'selected' : '' }} value="{{ $category->id }}">{{ $category->name }}</option>
                                        @endforeach
                                        @endif
                                    </select>
                                    <p></p>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-6 mb-4">
                                    <label for="" class="mb-2">Job Type<span class="req">*</span></label>
                                    <select name="jobType" id="jobType" class="form-select">
                                        <option value="">Select Job Type</option>
                                        @if($job_types->isNotEmpty())
                                        @foreach ($job_types as $job_type)
                                            <option {{ ($job->job_type_id == $job_type->id) ? 'selected' : '' }} value="{{ $job_type->id }}">{{ $job_type->name }}</option>
                                        @endforeach
                                        @endif
                                    </select>
                                    <p></p>
                                </div>
                                <div class="col-md-6  mb-4">
                                    <label for="" class="mb-2">Vacancy<span class="req">*</span></label>
                                    <input value="{{ $job->vacancy }}" type="number" min="1" placeholder="Vacancy" id="vacancy" name="vacancy" class="form-control">
                                    <p></p>
                                </div>
                            </div>

                            <div class="row">
                                <div class="mb-4 col-md-6">
                                    <label for="" class="mb-2">Salary</label>
                                    <input value="{{ $job->salary }}" type="text" placeholder="Salary" id="salary" name="salary" class="form-control">
                                </div>

                                <div class="mb-4 col-md-6">
                                    <label for="" class="mb-2">Location<span class="req">*</span></label>
                                    <input value="{{ $job->location }}" type="text" placeholder="Location" id="location" name="location" class="form-control">
                                    <p></p>
                                </div>
                            </div>

                            <div class="mb-4">
                                <label for="" class="mb-2">Description<span class="req">*</span></label>
                                <textarea class="textarea" name="description" id="description" cols="5" rows="5" placeholder="Description">{{ $job->description }}</textarea>
                                <p></p>
                            </div>
                            <div class="mb-4">
                                <label for="" class="mb-2">Benefits</label>
                                <textarea class="textarea" name="benefits" id="benefits" cols="5" rows="5" placeholder="Benefits">{{ $job->benefits }}</textarea>
                            </div>
                            <div class="mb-4">
                                <label for="" class="mb-2">Responsibility</label>
                                <textarea class="textarea" name="responsibility" id="responsibility" cols="5" rows="5" placeholder="Responsibility">{{ $job->responsibility }}</textarea>
                            </div>
                            <div class="mb-4">
                                <label for="" class="mb-2">Qualifications</label>
                                <textarea class="textarea" name="qualifications" id="qualifications" cols="5" rows="5" placeholder="Qualifications">{{ $job->qualifications }}</textarea>
                            </div>

                            <div class="mb-4">
                                <label for="" class="mb-2">Experience<span class="req">*</span></label>
                                <select name="experience" id="experience" class="form-control">
                                    <option value="">Select Experience</option>
                                    <option value="1" {{ ($job->experience == 1) ? 'selected' : '' }}>1 Years</option>
                                    <option value="2" {{ ($job->experience == 2) ? 'selected' : '' }}>2 Years</option>
                                    <option value="3" {{ ($job->experience == 3) ? 'selected' : '' }}>3 Years</option>
                                    <option value="4" {{ ($job->experience == 4) ? 'selected' : '' }}>4 Years</option>
                                    <option value="5" {{ ($job->experience == 5) ? 'selected' : '' }}>5 Years</option>
                                    <option value="6" {{ ($job->experience == 6) ? 'selected' : '' }}>6 Years</option>
                                    <option value="7" {{ ($job->experience == 7) ? 'selected' : '' }}>7 Years</option>
                                    <option value="8" {{ ($job->experience == 8) ? 'selected' : '' }}>8 Years</option>
                                    <option value="9" {{ ($job->experience == 9) ? 'selected' : '' }}>9 Years</option>
                                    <option value="10" {{ ($job->experience == 10) ? 'selected' : '' }}>10 Years</option>
                                    <option value="10_plus" {{ ($job->experience == '10_plus') ? 'selected' : '' }}>10+ Years</option>
                                </select>
                                <p></p>
                            </div>

                            <div class="mb-4">
                                <label for="" class="mb-2">Keywords</label>
                                <input value="{{ $job->keywords }}" type="text" placeholder="keywords" id="keywords" name="keywords" class="form-control">
                            </div>

                            <h3 class="fs-4 mb-1 mt-5 border-top pt-5">Company Details</h3>

                            <div class="row">
                                <div class="mb-4 col-md-6">
                                    <label for="" class="mb-2">Name<span class="req">*</span></label>
                                    <input value="{{ $job->company_name }}" type="text" placeholder="Company Name" id="company_name" name="company_name" class="form-control">
                                    <p></p>
                                </div>

                                <div class="mb-4 col-md-6">
                                    <label for="" class="mb-2">Location</label>
                                    <input value="{{ $job->company_location }}" type="text" placeholder="Location" id="company_location" name="company_location" class="form-control">
                                </div>
                            </div>

                            <div class="mb-4">
                                <label for="" class="mb-2">Website</label>
                                <input value="{{ $job->company_website }}" type="text" placeholder="Website" id="company_website" name="company_website" class="form-control">
                            </div>
                        </div>
                        <div class="card-footer  p-4">
                            <button type="submit" class="btn btn-primary">Update Job</button>
                        </div>
                    </div>
                </form>

            </div>
        </div>
    </div>
</section>

@endsection

@section('customJs')
<script type="text/javascript">
    $("#updateJobForm").submit(function (e) {
        e.preventDefault();

        $("button[type='submit']").prop('disabled',true);

        $.ajax({
            type: "POST",
            url: '{{ route("account.updateJob",$job->id) }}',
            data: $("#updateJobForm").serializeArray(),
            dataType: "json",
            success: function (response) {

                $("button[type='submit']").prop('disabled',false);

                if(response.status == true){

                    $("#title").removeClass('is-invalid').siblings('p').removeClass('invalid-feedback').html("");
                    $("#category").removeClass('is-invalid').siblings('p').removeClass('invalid-feedback').html("");
                    $("#jobType").removeClass('is-invalid').siblings('p').removeClass('invalid-feedback').html("");
                    $("#vacancy").removeClass('is-invalid').siblings('p').removeClass('invalid-feedback').html("");
                    $("#location").removeClass('is-invalid').siblings('p').removeClass('invalid-feedback').html("");
                    $("#description").removeClass('is-invalid').siblings('p').removeClass('invalid-feedback').html("");
                    $("#experience").removeClass('is-invalid').siblings('p').removeClass('invalid-feedback').html("");
                    $("#company_name").removeClass('is-invalid').siblings('p').removeClass('invalid-feedback').html("");
                    window.location.href="{{ route('account.myJobs') }}";

                }else{

                    var errors = response.errors;
                    // For name
                    if(errors.title){
                        $("#title").addClass('is-invalid').siblings('p').addClass('invalid-feedback').html(errors.title);
                    }else{
                        $("#title").removeClass('is-invalid').siblings('p').removeClass('invalid-feedback').html("");
                    }

                    // For category
                    if(errors.category){
                        $("#category").addClass('is-invalid').siblings('p').addClass('invalid-feedback').html(errors.category);
                    }else{
                        $("#category").removeClass('is-invalid').siblings('p').removeClass('invalid-feedback').html("");
                    }

                    // For jobType
                    if(errors.jobType){
                        $("#jobType").addClass('is-invalid').siblings('p').addClass('invalid-feedback').html(errors.jobType);
                    }else{
                        $("#jobType").removeClass('is-invalid').siblings('p').removeClass('invalid-feedback').html("");
                    }


                    // For vacancy
                    if(errors.vacancy){
                        $("#vacancy").addClass('is-invalid').siblings('p').addClass('invalid-feedback').html(errors.vacancy);
                    }else{
                        $("#vacancy").removeClass('is-invalid').siblings('p').removeClass('invalid-feedback').html("");
                    }

                    // For location
                    if(errors.location){
                        $("#location").addClass('is-invalid').siblings('p').addClass('invalid-feedback').html(errors.location);
                    }else{
                        $("#location").removeClass('is-invalid').siblings('p').removeClass('invalid-feedback').html("");
                    }

                    // For description
                    if(errors.description){
                        $("#description").addClass('is-invalid').siblings('p').addClass('invalid-feedback').html(errors.description);
                    }else{
                        $("#description").removeClass('is-invalid').siblings('p').removeClass('invalid-feedback').html("");
                    }

                    // For Experience
                    if(errors.experience){
                        $("#experience").addClass('is-invalid').siblings('p').addClass('invalid-feedback').html(errors.experience);
                    }else{
                        $("#experience").removeClass('is-invalid').siblings('p').removeClass('invalid-feedback').html("");
                    }


                    // For company name
                    if(errors.company_name){
                        $("#company_name").addClass('is-invalid').siblings('p').addClass('invalid-feedback').html(errors.company_name);
                    }else{
                        $("#company_name").removeClass('is-invalid').siblings('p').removeClass('invalid-feedback').html("");
                    }
                }
            }
        });

    });
</script>
@endsection
