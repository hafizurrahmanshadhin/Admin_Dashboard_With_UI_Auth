@extends('backend.app')

@section('title', 'FAQ Create')

@push('style')
    <style>
        /* Styling for the FAQ fields */
        .faq-field {
            border: 1px solid #ccc;
            border-radius: 8px;
            padding: 20px;
            margin-bottom: 20px;
        }

        /* Styling for the remove button */
        .remove-faq-button {
            margin-top: 10px;
        }

        /* Styling for the button group */
        .button-group {
            display: flex;
            justify-content: flex-end;
            margin-top: 20px;
        }

        /* Styling for the form inputs */
        .form-control {
            border-radius: 8px;
        }

        /* Styling for error messages */
        .error-message {
            color: #dc3545;
            font-size: 0.875rem;
            margin-top: 0.25rem;
        }
    </style>
@endpush

@section('content')
    {{--  ========== title-wrapper start ==========  --}}
    <div class="title-wrapper pt-30">
        <div class="row align-items-center">
            <div class="col-md-6">
                <div class="title">
                    <h2>Frequently Asked Questions</h2>
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
                            <li><span><i class="lni lni-angle-double-right"></i></span>FAQ</li>
                            <li class="active"><span><i class="lni lni-angle-double-right"></i></span>Create</li>
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
                    <div class="card-body">
                        <div style="display: flex; justify-content:end;">
                            <button type="button" class="btn btn-primary" onclick="addFaqField()">Add FAQ</button>
                        </div>
                        <form class="mt-4" id="faq_form" method="POST" action="{{ route('faq.store') }}">
                            @csrf
                            <div id="faq_fields_container">
                                @foreach (old('questions', ['']) as $index => $oldQuestion)
                                    <div class="faq-field">
                                        <div class="input-style-1">
                                            <label>Question:</label>
                                            <input type="text"
                                                class="form-control question @error('questions.' . $index) is-invalid @enderror"
                                                placeholder="Enter your question" name="questions[]"
                                                value="{{ $oldQuestion }}" required>
                                            @error('questions.' . $index)
                                                <div class="error-message">{{ $message }}</div>
                                            @enderror
                                        </div>

                                        <div class="input-style-1">
                                            <label>Answer:</label>
                                            <input type="text"
                                                class="form-control answer @error('answers.' . $index) is-invalid @enderror"
                                                placeholder="Enter your answer" name="answers[]"
                                                value="{{ old('answers.' . $index) }}" required>
                                            @error('answers.' . $index)
                                                <div class="error-message">{{ $message }}</div>
                                            @enderror
                                        </div>
                                        @if ($index > 0)
                                            <button type="button" class="btn btn-danger remove-faq-button"
                                                onclick="removeFaqField(this)">Remove</button>
                                        @endif
                                    </div>
                                @endforeach
                            </div>
                            <button type="submit" class="btn btn-primary me-2">Submit</button>
                            <a href="{{ route('faq.index') }}" class="btn btn-danger ">Cancel</a>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('script')
    <script>
        let nextFaqFieldId = {{ count(old('questions', [''])) }};

        function addFaqField() {
            let faqFieldsContainer = document.getElementById("faq_fields_container");
            let newFaqField = document.createElement("div");
            newFaqField.className = "faq-field";
            newFaqField.innerHTML = `
                <div class="input-style-1">
                    <label>Question:</label>
                    <input type="text" class="form-control question" placeholder="Enter your question" name="questions[]" required>
                </div>
                <div class="input-style-1">
                    <label>Answer:</label>
                    <input type="text" class="form-control answer" placeholder="Enter your answer" name="answers[]" required>
                </div>
                <button type="button" class="btn btn-danger remove-faq-button" onclick="removeFaqField(this)">Remove</button>
            `;
            faqFieldsContainer.appendChild(newFaqField);
            nextFaqFieldId++;
        }

        function removeFaqField(button) {
            button.parentElement.remove();
            nextFaqFieldId--;
        }
    </script>
@endpush
