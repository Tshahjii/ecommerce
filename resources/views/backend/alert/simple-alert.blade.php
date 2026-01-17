 @if (session('success'))
     <div class="alert alert-success border-0 alert-dismissible fade show material-shadow" role="alert">
         <i class="ri-user-smile-line label-icon"></i>
         <strong>Success!</strong> {{ session('success') }} — check
         it out!
         <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
     </div>
 @endif

 @if (session('error'))
     <div class="alert alert-danger border-0 alert-dismissible fade show mb-xl-0 material-shadow" role="alert">
         <i class="ri-error-warning-line label-icon"></i>
         <strong> Oops! </strong> {{ session('error') }} — check
         it out!
         <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
     </div>
 @endif
