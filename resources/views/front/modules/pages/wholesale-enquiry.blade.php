@extends('front.layouts.app')

@section('content')
<section class="py-5">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card shadow-lg border-0 rounded-3">
                    <div class="card-body p-5">
                        <h2 class="text-center mb-4">Wholesale Enquiry Form</h2>
                        
                        <form id="wholesaleenquiry">
                            @csrf
                            
                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <label for="name" class="form-label">Your Name *</label>
                                    <input type="text" name="name" id="name" class="form-control" required>
                                </div>

                                <div class="col-md-6 mb-3">
                                    <label for="email" class="form-label">Your Email *</label>
                                    <input type="email" name="email" id="email" class="form-control">
                                </div>

                                <div class="col-md-6 mb-3">
                                    <label for="phone" class="form-label">Your Phone *</label>
                                    <input type="tel" name="phone" id="phone" class="form-control">
                                </div>
                                 <div class="col-md-6 mb-3">
                                    <label for="city" class="form-label">City *</label>
                                    <input type="text" name="city" id="city" class="form-control">
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label for="name" class="form-label">Company Name *</label>
                                    <input type="text" name="company_name" id="company_name" class="form-control" required>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label for="name" class="form-label">GST Number *</label>
                                    <input type="text" name="gst_number" id="gst_number" class="form-control" required>
                                </div>

                               
                            </div>

                            <div class="mb-3">
                                <label for="message" class="form-label">Message *</label>
                                <textarea name="message" id="message" rows="4" class="form-control" required></textarea>
                            </div>

                            <div class="text-center">
                                <button type="submit" class="btn btn-primary px-5">Submit</button>
                            </div>
                        </form>
                        
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection
@push("scripts")
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
$(document).ready(function () {
    $('#wholesaleenquiry').on('submit', function (e) {
        e.preventDefault();

        let formData = $(this).serialize();

        $.ajax({
            url: "{{ route('wholesale-enquiry') }}",
            type: "POST",
            data: formData,
            success: function (response) {
                Swal.fire({
                    icon: 'success',
                    title: 'Subscribed!',
                    text: response.message,
                    showConfirmButton: false,
                    timer: 2000
                }).then(() => {
        window.location.href = response.redirect_url; // back ho jayega
    });

                $('#subscribeForm')[0].reset();
            },
            error: function (xhr) {
                if (xhr.status === 422) {
                    let errors = xhr.responseJSON.errors;
                    let firstError = Object.values(errors)[0][0];

                    Swal.fire({
                        icon: 'error',
                        title: 'Oops...',
                        text: firstError,
                    });
                } else {
                    Swal.fire({
                        icon: 'error',
                        title: 'Server Error',
                        text: 'Something went wrong. Please try again later.',
                    });
                }
            }
        });
    });
});
</script>
@endpush
