<script src="{{ asset('backend/js/popper.min.js') }}"></script>
<script src="{{ asset('backend/js/bootstrap.min.js') }}"></script>
<script src="{{ asset('backend/js/jquery.nicescroll.min.js') }}"></script>
<script src="{{ asset('backend/js/moment.min.js') }}"></script>
<script src="{{ asset('backend/js/stisla.js') }}"></script>
<script src="{{ asset('backend/js/scripts.js') }}"></script>
<script src="{{ asset('backend/js/select2.min.js') }}"></script>
<script src="{{ asset('backend/js/tagify.js') }}"></script>
<script src="{{ asset('global/toastr/toastr.min.js') }}"></script>
<script src="{{ asset('backend/js/bootstrap4-toggle.min.js') }}"></script>
<script src="{{ asset('backend/js/fontawesome-iconpicker.min.js') }}"></script>
<script src="{{ asset('backend/js/bootstrap-datepicker.min.js') }}"></script>
<script src="{{ asset('backend/clockpicker/dist/bootstrap-clockpicker.js') }}"></script>
<script src="{{ asset('backend/datetimepicker/jquery.datetimepicker.js') }}"></script>
<script src="{{ asset('backend/js/iziToast.min.js') }}"></script>
<script src="{{ asset('backend/js/modules-toastr.js') }}"></script>
<script src="{{ asset('backend/tinymce/js/tinymce/tinymce.min.js') }}"></script>
<script src="{{ asset('backend/js/custom.js') }}"></script>

<script>
    @session('messege')
    var type = "{{ Session::get('alert-type', 'info') }}"
    switch (type) {
        case 'info':
            toastr.info("{{ $value }}");
            break;
        case 'success':
            toastr.success("{{ $value }}");
            break;
        case 'warning':
            toastr.warning("{{ $value }}");
            break;
        case 'error':
            toastr.error("{{ $value }}");
            break;
    }
    @endsession
</script>

@if ($errors->any())
    @foreach ($errors->all() as $error)
        <script>
            toastr.error('{{ $error }}');
        </script>
    @endforeach
@endif

<script>
    function makeSlug(selector, target) {
        var name = $(selector).val();
        var slug = name.toLowerCase().replace(/^-+|-+$/g, '').replace(/\s/g, '-').replace(/\-\-+/g, '-');
        $(target).val(slug);
    }
    function convertToSlug(Text) {
        return Text
            .toLowerCase()
            .replace(/[^\w ]+/g, '')
            .replace(/ +/g, '-');
    }
    // remove currency symbol
    function removeCurrency(value) {
        return value.replace(/[^0-9.]/g, '');
    }
</script>




{{-- sidebar scroll to previous position --}}
<script>
    document.addEventListener("DOMContentLoaded", function(event) {
        var sidebarScrollPos = localStorage.getItem('sidebarScrollPos');
        if (sidebarScrollPos) {
            document.querySelector('.main-sidebar').style.overflow = 'auto';
            document.querySelector('.main-sidebar').scrollTop = sidebarScrollPos;
        }
    });

    window.onbeforeunload = function(e) {
        var sidebar = document.querySelector('.main-sidebar');
        localStorage.setItem('sidebarScrollPos', sidebar.scrollTop);
    };
</script>