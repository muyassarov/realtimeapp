@extends('layouts.app')

@push('styles')
    <style>
    </style>
@endpush

@section('content')
    <div class="container-fluid">
        <div class="row justify-content-center">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">{{ __('Chat') }}</div>

                    <div class="card-body">
                        <div class="row p-2">
                            <div class="col-10">
                                <div class="row">
                                    <div class="col-12 border rounded-4 p-3">
                                        <ul class="list-unstyled overflow-auto" id="messages" style="height: 45vh"></ul>
                                    </div>
                                </div>
                                <form action="">
                                    <div class="row py-3">
                                        <div class="col-10">
                                            <label for="message" class="d-none">Message</label>
                                            <input id="message" type="text" class="form-control" placeholder="Your message"/>
                                        </div>
                                        <div class="col-2">
                                            <button type="submit" id="send-btn" class="btn btn-primary w-100">Send</button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                            <div class="col-2">
                                <p><strong>Online Now</strong></p>
                                <ul id="users" class="list-unstyled overflow-auto text-info" style="height: 45vh;">
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <script>
        const usersElement = document.getElementById('users');
        const messagesElement = document.getElementById('messages');

        function addUserToList(user) {
            let el = document.createElement('li');
            el.setAttribute('id', user.id);
            el.innerText = user.name;
            usersElement.appendChild(el);
        }

        function addMessage(message) {
            let el = document.createElement('li');
            el.innerText = message;
            messagesElement.appendChild(el);
        }

        Echo.join('chat')
            .here((users) => {
                users.forEach((user) => {
                    addUserToList(user);
                });
            })
            .joining((user) => {
                addUserToList(user);
            })
            .leaving((user) => {
                const el = document.getElementById(user.id.toString());
                el.parentNode.removeChild(el);
            })
            .listen('MessageSent', function (e) {
                addMessage(e.user.name + ': ' + e.message);
            });
    </script>
    <script>
        const messageElement = document.getElementById('message');
        const sendButton = document.getElementById('send-btn');

        sendButton.addEventListener('click', function (e) {
            e.preventDefault();

            window.axios.post('/chat/message', {
                message: messageElement.value,
            }).then(function (response) {
                console.log(response);
            });
            messageElement.value = '';
        });
    </script>
@endpush
