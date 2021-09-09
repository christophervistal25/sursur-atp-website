 @if(Session::get('form_submission_review') == 'no_form')
 <div class="alert alert-danger text-white fade show mb-0" role="alert">
    <i class="fa fa-times mx-2"></i>
    <strong>Please <a class='text-white' style='text-decoration :underline;' href="/admin/forms/create">upload</a> a uniform form for this quarter. </strong>
    </div>
 @endif