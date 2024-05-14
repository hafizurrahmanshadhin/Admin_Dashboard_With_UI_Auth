@extends('backend.app')

@section('title', 'Profile Settings')

@section('content')
    {{--  ========== title-wrapper start ==========  --}}
    <div class="title-wrapper pt-30">
        <div class="row align-items-center">
            <div class="col-md-6">
                <div class="title">
                    <h2>Profile Settings</h2>
                </div>
            </div>

            <div class="col-md-6">
                <div class="breadcrumb-wrapper">
                    <nav>
                        <ol class="base-breadcrumb breadcrumb-three">
                            <li>
                                <a href="{{ route('dashboard') }}">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" fill="currentColor"
                                        viewBox="0 0 16 16">
                                        <path
                                            d="M8 0a8 8 0 1 0 4.596 14.104A5.934 5.934 0 0 1 8 13a5.934 5.934 0 0 1-4.596-2.104A7.98 7.98 0 0 0 8 0zm-2 3a2 2 0 1 1 4 0 2 2 0 0 1-4 0zm-1.465 5.682A3.976 3.976 0 0 0 4 9c0 1.044.324 2.01.882 2.818a6 6 0 1 1 6.236 0A3.975 3.975 0 0 0 12 9a3.976 3.976 0 0 0-.536-1.318l-1.898.633-.018-.056 2.194-.732a4 4 0 1 0-7.6 0l2.194.733-.018.056-1.898-.634z" />
                                    </svg>
                                    Dashboard
                                </a>
                            </li>
                            <li><span><i class="lni lni-angle-double-right"></i></span>Settings</li>
                            <li class="active"><span><i class="lni lni-angle-double-right"></i></span>Profile Setting</li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>
    </div>
    {{--  ========== title-wrapper end ==========  --}}

    <div class="row">
        <div class="col-lg-12">
            <div class="card-style settings-card-1 mb-30">
                <div class="title mb-30 d-flex justify-content-between align-items-center">
                    <h4>My Profile</h4>
                </div>
                <div class="profile-info">
                    <div class="d-flex align-items-center mb-30">

                        <div class="profile-image">
                            @isset($userDetails)
                                @if ($userDetails->profile_picture)
                                    <img id="profile-picture" src="{{ asset($userDetails->profile_picture) }}"
                                        alt="Profile Picture">
                                @else
                                    <img id="profile-picture" src="{{ asset('backend/images/profile/profile-1.png') }}"
                                        alt="Default Profile Picture">
                                @endif
                            @else
                                <img id="profile-picture" src="{{ asset('backend/images/profile/profile-1.png') }}"
                                    alt="Default Profile Picture">
                            @endisset

                            <div class="update-image">
                                <input type="file" name="profile_picture" id="profile_picture_input"
                                    style="display: none;">
                                <label for="profile_picture_input"><i class="lni lni-cloud-upload"></i></label>
                            </div>
                        </div>

                        <div class="profile-meta">
                            <h5 class="text-bold text-dark mb-10">{{ Auth::user()->name }}</h5>
                            <p class="text-sm text-gray">Admin</p>
                        </div>
                    </div>

                    <form method="POST" action="{{ route('update.profile') }}">
                        @csrf
                        <div class="row">
                            <div class="col-12">
                                <div class="input-style-1">
                                    <label for="name">User Name</label>
                                    <input type="text" @error('name') is-invalid @enderror" name="name" id="name"
                                        value="{{ Auth::user()->name }}" placeholder="Full Name" />
                                    @error('name')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-12">
                                <div class="input-style-1">
                                    <label for="email">Email</label>
                                    <input type="email" @error('email') is-invalid @enderror" placeholder="Email"
                                        name="email" id="email" value="{{ Auth::user()->email }}" />
                                    @error('email')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-12">
                                <button type="submit" class="btn btn-primary">Submit</button>
                            </div>
                        </div>
                    </form>


                    <hr class="mb-30">
                    <div class="mt-30 mb-10">
                        <h3>Update Your Password</h3>
                    </div>

                    <form method="POST" action="{{ route('update.Password') }}">
                        @csrf
                        <div class="row">
                            <div class="col-12">
                                <div class="input-style-1">
                                    <label for="old_password">Current Password</label>
                                    <input type="password" @error('old_password') is-invalid @enderror"
                                        placeholder="Current Password" name="old_password" id="old_password" />
                                    @error('old_password')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-12">
                                <div class="input-style-1">
                                    <label for="password">New Password</label>
                                    <input type="password" @error('password') is-invalid @enderror"
                                        placeholder="New Password" name="password" id="password" />
                                    @error('password')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-12">
                                <div class="input-style-1">
                                    <label for="password_confirmation">Confirm Password</label>
                                    <input type="password" @error('password_confirmation') is-invalid @enderror"
                                        placeholder="Confirm Password" name="password_confirmation"
                                        id="password_confirmation" />
                                    @error('password_confirmation')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-12">
                                <button type="submit" class="btn btn-primary">Submit</button>
                                <a href="{{ route('dashboard') }}" class="btn btn-danger me-2">Cancel</a>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection


@push('script')
    <script>
        $(document).ready(function() {
            $('#profile_picture_input').change(function() {
                var formData = new FormData();
                formData.append('profile_picture', $(this)[0].files[0]);
                formData.append('_token', '{{ csrf_token() }}');

                $.ajax({
                    url: '{{ route('update.profile.picture') }}',
                    type: 'POST',
                    data: formData,
                    processData: false,
                    contentType: false,
                    success: function(data) {
                        if (data.success) {
                            $('#profile-picture').attr('src', data.image_url);
                            toastr.success('Profile picture updated successfully.');
                        } else {
                            toastr.error(data.message);
                        }
                    },
                    error: function() {
                        toastr.error(data.message);
                    }
                });
            });
        });
    </script>
@endpush
