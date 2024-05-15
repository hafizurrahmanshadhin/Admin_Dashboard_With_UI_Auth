@extends('backend.app')

@section('title', 'Social Media settings')

@push('style')
    <style>
        .drop-custom {
            border-top-left-radius: 6px;
            border-bottom-left-radius: 6px;
            padding: 10px;
            border: 1px solid #788393;
            color: #788393;
        }
    </style>
@endpush

@section('content')
    {{--  ========== title-wrapper start ==========  --}}
    <div class="title-wrapper pt-30">
        <div class="row align-items-center">
            <div class="col-md-6">
                <div class="title">
                    <h2>Social Media Settings</h2>
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
                            <li class="active"><span><i class="lni lni-angle-double-right"></i></span>Social Media Setting
                            </li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>
    </div>
    {{--  ========== title-wrapper end ==========  --}}

    <div class="form-layout-wrapper">
        <div class="row">
            <div class="col-lg-12">
                <div class="card-style mb-4">
                    <form action="{{ route('social.update') }}" method="POST">
                        @csrf
                        <div style="display: flex;justify-content: end;margin-bottom: 10px;">
                            <button class="btn btn-outline-secondary" type="button" onclick="addSocialField()"
                                style="font-weight: 900">Add</button>
                        </div>
                        <div id="social_media_container">
                            @foreach ($social_link as $index => $link)
                                <div class="social_media input-group mb-3 dropdown">
                                    <input type="hidden" name="social_media_id[]" value="{{ $link->id }}">
                                    <select class="dropdown-toggle drop-custom" name="social_media[]"
                                        value="@isset($social_link){{ $link->social_media }}@endisset">
                                        <option class="dropdown-item">Select Social</option>
                                        <option class="dropdown-item" value="facebook"
                                            {{ $link->social_media == 'facebook' ? 'selected' : '' }}>Facebook
                                        </option>
                                        <option class="dropdown-item" value="instagram"
                                            {{ $link->social_media == 'instagram' ? 'selected' : '' }}>Instagram
                                        </option>
                                        <option class="dropdown-item" value="twitter"
                                            {{ $link->social_media == 'twitter' ? 'selected' : '' }}>Twitter
                                        </option>
                                        <option class="dropdown-item" value="tiktok"
                                            {{ $link->social_media == 'tiktok' ? 'selected' : '' }}>Tiktok
                                        </option>
                                        <option class="dropdown-item" value="youtube"
                                            {{ $link->social_media == 'youtube' ? 'selected' : '' }}>YouTube
                                        </option>
                                        <option class="dropdown-item" value="threads"
                                            {{ $link->social_media == 'threads' ? 'selected' : '' }}>Threads
                                        </option>
                                    </select>
                                    <input type="url" class="form-control" aria-label="Text input with dropdown button"
                                        name="profile_link[]"
                                        value="@isset($social_link){{ $link->profile_link }}@endisset">
                                    <button class="btn btn-outline-secondary removeSocialBtn" type="button"
                                        onclick="removeSocialField(this)" style="font-weight: 900"
                                        data-id="{{ $link->id }}">Remove</button>
                                </div>
                            @endforeach
                        </div>

                        <div class="col-12">
                            <button type="submit" class="btn btn-primary">Submit</button>
                            <a href="{{ route('dashboard') }}" class="btn btn-danger me-2">Cancel</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('script')
    <script>
        let socialFieldsCount = $('#social_media_container .social_media').length;

        function addSocialField() {
            const socialFieldsContainer = document.getElementById("social_media_container");

            if (socialFieldsCount < 6) {
                const newSocialField = document.createElement("div");
                newSocialField.className = "social_media input-group mb-3";
                newSocialField.innerHTML =
                    `
            <select class="dropdown-toggle drop-custom" name="social_media[]">
                <option class="dropdown-item">Select Social</option>
                <option class="dropdown-item" value="facebook">Facebook</option>
                <option class="dropdown-item" value="instagram">Instagram</option>
                <option class="dropdown-item" value="twitter">Twitter</option>
                <option class="dropdown-item" value="tiktok">Tiktok</option>
                <option class="dropdown-item" value="youtube">YouTube</option>
                <option class="dropdown-item" value="threads">Threads</option>
            </select>
            <input type="url" class="form-control" aria-label="Text input with dropdown button" name="profile_link[]">
            <button class="btn btn-outline-secondary" type="button" onclick="removeSocialField(this)" style="font-weight: 900">Remove</button>`;

                socialFieldsContainer.appendChild(newSocialField);
                socialFieldsCount++;
                document.querySelectorAll('select[name="social_media[]"]').forEach(selectElement => {
                    selectElement.removeEventListener('change',
                        checkForDuplicateSocialMedia);
                    selectElement.addEventListener('change', checkForDuplicateSocialMedia);
                });
            } else {
                Swal.fire({
                    icon: "error",
                    title: "Oops...",
                    text: "You can only add Six social links fields!",
                });
            }
        }


        function removeSocialField(button) {
            const socialField = button.parentElement;
            socialField.remove();
            socialFieldsCount--;
            checkForDuplicateSocialMedia();
        }

        function checkForDuplicateSocialMedia() {
            const allSelections = document.querySelectorAll('select[name="social_media[]"]');
            const allValues = Array.from(allSelections).map(select => select.value);
            const hasDuplicate = allValues.some((value, index) => allValues.indexOf(value) !== index && value !==
                "Select Social");

            if (hasDuplicate) {
                swal.fire("You cannot add the same social media platform more than once.");
                Swal.fire({
                    icon: "error",
                    title: "Oops...",
                    text: "You cannot add the same social media platform more than once.",
                });
                allSelections.forEach(selectElement => {
                    if (allValues.filter(value => value === selectElement.value).length > 1) {
                        selectElement.value = "Select Social";
                    }
                });
            }
        }

        window.removeSocialField = function(button) {
            const socialLinkId = $(button).data('id');

            $.ajax({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                type: 'DELETE',
                url: '{{ route('social.delete', '') }}/' + socialLinkId,
                data: {
                    _token: '{{ csrf_token() }}'
                },
                success: function(response) {
                    $(button).closest('.social_media').remove();
                    socialFieldsCount--;
                    if (response.success === true) {

                        toastr.success(response.message);
                    } else if (response.errors) {
                        toastr.error(response.errors[0]);
                    } else {
                        toastr.error(response.message);
                    }
                },
                error: function(xhr, status, error) {
                    console.error(xhr.responseText);
                }
            });
        };
    </script>
@endpush
