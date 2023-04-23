@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">{{ __('Users') }}</div>

                    <div class="card-body">
                        <h1>Show list of users in realtime</h1>
                        <ul id="users-list"></ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <script>
        window.axios.get('/api/users')
            .then((response) => {
                let users = response.data;

                users.forEach((user) => {
                    addUserToList(user);
                });
            });

        function addUserToList(user) {
            const usersElement = document.getElementById('users-list');
            let el = document.createElement('li');
            el.setAttribute('id', user.id);
            el.innerText = user.name;
            usersElement.appendChild(el);
        }
    </script>
    <script>
        Echo.channel('users')
            .listen('UserCreated', function (e) {
                addUserToList(e.user);
            })
            .listen('UserUpdated', function (e) {
                const el = document.getElementById(e.user.id.toString());
                el.innerText = e.user.name;
            })
            .listen('UserDeleted', function (e) {
                const el = document.getElementById(e.user.id.toString());
                el.parentNode.removeChild(el);
            });
    </script>
@endpush
