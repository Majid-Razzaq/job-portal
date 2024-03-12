    <div class="card account-nav border-0 shadow mb-4 mb-lg-0">
        <div class="card-body p-0">
            <ul class="list-group list-group-flush ">
                <li class="list-group-item d-flex justify-content-between p-3">
                    <a class="{{ Request::is('admin/users') ? 'light-green' : '' }}" href="{{ route('admin.users') }}">Users</a>
                </li>
                <li class="list-group-item d-flex justify-content-between align-items-center p-3">
                    <a class="{{ Request::is('admin/jobs') ? 'light-green' : '' }}" href="{{ route('admin.jobs') }}">Jobs</a>
                </li>
                <li class="list-group-item d-flex justify-content-between align-items-center p-3">
                    <a class="{{ Request::is('admin/job-applications') ? 'light-green' : '' }}" href="{{ route('admin.jobApplications') }}">Job Applications</a>
                </li>
                <li class="list-group-item d-flex justify-content-between align-items-center p-3">
                    <a class="{{ Request::is('admin/categories') ? 'light-green' : '' }}" href="{{ route('admin.categories') }}">Categories</a>
                </li>
                <li class="list-group-item d-flex justify-content-between align-items-center p-3">
                    <a class="{{ Request::is('admin/job-types') ? 'light-green' : '' }}" href="{{ route('admin.job_types') }}">Job Types</a>
                </li>
                <li class="list-group-item d-flex justify-content-between align-items-center p-3">
                    <a href="{{ route('account.logout') }}">Logout</a>
                </li>
            </ul>
        </div>
    </div>


