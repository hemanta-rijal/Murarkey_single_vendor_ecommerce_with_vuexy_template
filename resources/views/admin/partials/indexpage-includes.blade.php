@section('css')

    <!-- Begin: Vendor CSS-->

    <link rel="stylesheet" type="text/css"
          href="{{ asset('backend/app-assets/vendors/css/tables/datatable/datatables.min.css')}}">
    <link rel="stylesheet" type="text/css"
          href="{{ asset('backend/app-assets/vendors/css/file-uploaders/dropzone.min.css')}}">
    <link rel="stylesheet" type="text/css"
          href="{{ asset('backend/app-assets/vendors/css/tables/datatable/extensions/dataTables.checkboxes.css')}}">
    <!-- END: Vendor CSS-->

    {{-- page css --}}
    <link rel="stylesheet" type="text/css"
          href="{{ asset('backend/app-assets/css/plugins/file-uploaders/dropzone.css')}}">
    <link rel="stylesheet" type="text/css" href="{{ asset('backend/app-assets/css/pages/data-list-view.css')}}">

    <style>
        .paging_simple_numbers {
            display: none;
        }

        .dataTables_length {
            display: none;
        }

        .actions {
            display: none;
            /* search : true; */
        }
    </style>

    <link rel="stylesheet" type="text/css" href="{{ asset('backend/app-assets/css/pages/app-email.css')}}">
    <link rel="stylesheet" href="{{ asset('backend/tagin-master/dist/css/tagin.css') }}">


@endsection

@section('js')

    <!-- BEGIN: Page Vendor JS-->
    <script src="{{ asset('backend/app-assets/vendors/js/extensions/dropzone.min.js')}}"></script>
    <script src="{{ asset('backend/app-assets/vendors/js/tables/datatable/datatables.min.js')}}"></script>
    <script src="{{ asset('backend/app-assets/vendors/js/tables/datatable/datatables.buttons.min.js')}}"></script>
    <script src="{{ asset('backend/app-assets/vendors/js/tables/datatable/datatables.bootstrap4.min.js')}}"></script>
    <script src="{{ asset('backend/app-assets/vendors/js/tables/datatable/buttons.bootstrap.min.js')}}"></script>
    <script src="{{ asset('backend/app-assets/vendors/js/tables/datatable/dataTables.select.min.js')}}"></script>
    <script src="{{ asset('backend/app-assets/vendors/js/tables/datatable/datatables.checkboxes.min.js')}}"></script>

    <!-- END: Page Vendor JS-->
    <script>
        function editproductstocks() {
            $(".sku").prop('disabled', false);
        }

        function filterTable() {
            var filterby = $('#filterby').val();
            // alert(filterby)
            $.post('{{ route('admin.product.manage-stock.filterby') }}', {
                _token: '{{ @csrf_token() }}',
                filter: filterby
            }, function (data) {
                $('#product-attribute-fields').html(data);
            });
        }
    </script>

    <!-- BEGIN: Page JS-->
    <script src="{{ asset('backend/app-assets/js/scripts/ui/data-list-view.js') }}"></script>
    <script src="{{ asset('backend/custom/customfuncitons.js')}}"></script>
    <script src="{{ asset('backend/tagin-master/dist/js/tagin.js')}}"></script>
    <script src="https://cdn.ckeditor.com/ckeditor5/29.0.0/classic/ckeditor.js"></script>
    <script>
        for (const el of document.querySelectorAll('.tagin')) {
            tagin(el)
        }

    </script>
    {{-- <script src="{{ asset('backend/app-assets/js/scripts/modal/components-modal.js') }}"></script>
    --}}
    {{-- <script src="{{asset('backend/app-assets/js/scripts/datatables/datatable.js')}}"></script>  --}}

    <!-- END: Page JS-->
@endsection