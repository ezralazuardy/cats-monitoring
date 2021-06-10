@push('css')
    <link rel="stylesheet"
          href="{{ App::environment() == 'local' ? asset('css/plugins/datatables.css') : asset('css/plugins/datatables.min.css') }}"/>
@endpush
@push('early_js')
    <script type="text/javascript"
            src="{{ App::environment() == 'local' ? asset('js/plugins/datatables.js') : asset('js/plugins/datatables.min.js') }}"></script>
    <script type="text/javascript">
        function setDatatableTheme() {
            const lengthLabel = $('.dataTables_length label');
            if (lengthLabel.removeClass('dark:text-white')) lengthLabel.addClass('dark:text-white');

            const lengthLabelSelector = $('.dataTables_length label select');
            if (lengthLabelSelector.removeClass('dark:text-white')) lengthLabelSelector.addClass('dark:text-white');

            const filterLabel = $('.dataTables_filter label').addClass('dark:text-white');
            if (filterLabel.removeClass('dark:text-white')) filterLabel.addClass('dark:text-white');

            $('.dataTables_info').each(function () {
                $(this).html($('<span class="dark:text-white"></span>').html($(this).html()));
            });

            $('.paginate_button').each(function () {
                if (!$(this).hasClass('disabled')) $(this).html($('<span class="dark:text-white"></span>').html($(this).html()));
            });

            $('.dataTables_empty').each(function () {
                $(this).addClass('dark:bg-gray-600');
            });
        }
    </script>
@endpush
