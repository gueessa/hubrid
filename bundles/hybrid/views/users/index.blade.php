@layout('hybrid::layouts.base')

@section('styles')
    @parent
@endsection

@section('scripts')
    @parent
    <?php 
        $asset = Asset::container('hybrid.backend.users')
            //->add('entry', 'bundles/hybrid/js/hybrid/users/entry.js', 'jquery')
            //->add('list',  'bundles/hybrid/js/hybrid/users/entry.list.js', 'jquery')
            //->add('view',  'bundles/hybrid/js/hybrid/users/entry.view.js', 'jquery')
            ->add('user',  'bundles/hybrid/js/hybrid/users/user.js', 'jquery') 
    ?>
    {{ $asset->scripts() }}
@endsection


@section('content')

    <h2>{{ $title }}</h2>

    <table class="table">
        <tr>
            <th></th>
            <th></th>
            <th></th>
            <th></th>
        </tr>
        <tbody id="user-list">
        </tbody>
        @forelse ($users->results as $row)
            <tr>
                <td>{{ $row->username }}</td>
                <td>{{ $row->email }}</td>
                <td>{{ $row->fullname }}</td>
                <td></td>
            </tr>
        @empty
            <tr>
                <td colspan="4">There are not posts in the array!</td>
            </tr>
        @endforelse    
    </table>

    <script type="text/template" id="row-template">
        <td><%= username %></td>
        <td><%= email %></td>
        <td><%= fullname %></td>
        <td>
            <a data-role="delete">delete</a>
            <a data-role="change-status">change status</a> Curent status : <%= status_id %>
        </td>
    </script>
    
    <script type="text/javascript">
         var json_data = {{ $json_data }};
    </script>
    
@endsection