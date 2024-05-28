@extends('layouts.app')

@section('content')
    <style>
        .chat-container {
            display: flex;
            height: 100vh;
        }

        .employees-list {
            width: 25%;
            border-right: 1px solid #ddd;
            overflow-y: auto;
        }

        .chat {
            width: 75%;
            display: flex;
            flex-direction: column;
        }

        .messages {
            flex-grow: 1;
            padding: 10px;
            overflow-y: auto;
        }

        .bottom {
            padding: 10px;
            border-top: 1px solid #ddd;
        }

        .employee {
            cursor: pointer;
            padding: 10px;
            display: flex;
            align-items: center;
            border-bottom: 1px solid #ddd;
        }

        .employee img {
            margin-right: 10px;
        }

        .message {
            padding: 10px;
            margin: 5px 0;
            border-radius: 10px;
            max-width: 60%;
        }

        .sent {
            background-color: #dcf8c6;
            align-self: flex-end;
            text-align: right;
        }

        .received {
            background-color: #fff;
            align-self: flex-start;
            text-align: left;
        }

        .messages {
            display: flex;
            flex-direction: column;
        }
    </style>
    </head>

    <body>
        <div class="container-fluid chat-container">
            <div class="employees-list">

                <div class="search-container">
                    <style>
                        .search-container {
                            display: flex;
                            align-items: center;
                            /* Canh giữa theo chiều dọc */
                        }

                        .search-container input[type="text"] {
                            margin-left: 10px;
                            /* Khoảng cách giữa button và input */
                        }

                        .custom-form-control {
                            width: -webkit-fill-available;
                        }
                    </style>

                    <a class="btn btn-secondary btn-sm" href="{{ route('employee') }}" role="button">Trở về</a>
                    <input type="text" class="form-control custom-form-control" placeholder="Tìm kiếm">
                </div>


                <ul class="list-group list-group-flush">
                    @foreach ($employees as $employee)
                        <li class="list-group-item employee d-flex align-items-center"
                            data-id="{{ $employee->employee_id }}">
                            <img src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcS4k-EK9bwaXD1R_HGLkKam2lQJBpUZ6BB-5iWwW0nUXQ&s"
                                alt="Avatar" class="rounded-circle" width="50" height="50">
                            <div class="flex-grow-1">
                                <div class="d-flex justify-content-between align-items-center">
                                    <h6 class="mb-0">{{ $employee->employee_id }}</h6>
                                    {{-- <span class="badge badge-pill">3</span> --}}
                                </div>
                                <small class="employee-status">Online</small>
                            </div>
                        </li>
                    @endforeach
                </ul>
            </div>
            <div class="chat">
                <div class="messages p-3"></div>
                <div class="bottom p-3">
                    <form id="messageForm">
                        <div class="input-group">
                            <input type="text" id="message" class="form-control" placeholder="Nhập gì đó"
                                autocomplete="off">
                            <button type="submit" class="btn btn-primary"><i class="fas fa-paper-plane"></i></button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        @push('scripts-employee')
            <script>
                const pusher = new Pusher('bfa423eed506ea0410c1', {
                    cluster: 'ap1'
                });
                pusher.connection.bind('connected', function() {
                    console.log('Successfully connected to Pusher!');
                });

                pusher.connection.bind('error', function(err) {
                    console.error('Error connecting to Pusher:', err);
                });

                const channel = pusher.subscribe('public');

                channel.bind('pusher:subscription_succeeded', function() {
                    console.log('Subscription to channel succeeded');
                });

                channel.bind('chat', function(data) {
                    console.log('Received chat event:', data);
                    const message = data.message;
                    if (selectedEmployeeId == message.sender_id || selectedEmployeeId == message.receiver_id) {
                        const messageClass = message.sender_id == '{{ Session::get('employee_id') }}' ? 'sent' : 'received';
                        $('.messages').append(
                            `<div class="message ${messageClass}"><p>${message.sender.employee_id}: ${message.message}</p></div>`
                        );
                        $('.messages').scrollTop($('.messages')[0].scrollHeight);
                    }
                });

                function loadMessages(employee_id) {
                    $.get(`/employee/messages/${employee_id}`, function(data) {
                        $('.messages').html('');
                        data.forEach(message => {
                            const messageClass = message.sender_id == '{{ Session::get('employee_id') }}' ? 'sent' :
                                'received';
                            $('.messages').append(
                                `<div class="message ${messageClass}"><p>${message.sender.employee_id}: ${message.message}</p></div>`
                            );
                        });
                        $('.messages').scrollTop($('.messages')[0].scrollHeight);
                    });
                }

                $(document).on('click', '.employee', function() {
                    selectedEmployeeId = $(this).data('id');
                    $('.employee').removeClass('active');
                    $(this).addClass('active');
                    loadMessages(selectedEmployeeId);
                });



                $("#messageForm").submit(function(event) {
                    event.preventDefault();

                    if (selectedEmployeeId) {
                        $.ajax({
                            url: "/employee/broadcast",
                            method: 'POST',
                            headers: {
                                'X-Socket-Id': pusher.connection.socket_id
                            },
                            data: {
                                _token: '{{ csrf_token() }}',
                                message: $("#message").val(),
                                receiver_id: selectedEmployeeId
                            }
                        }).done(function(res) {
                            const newMessage =
                                `<div class="message sent"><p>You: ${$("#message").val()}</p></div>`;
                            $('.messages').append(newMessage);
                            $("#message").val('');
                            $('.messages').scrollTop($('.messages')[0].scrollHeight);
                        });
                    } else {
                        alert("Please select an employee to chat with.");
                    }
                });
            </script>
        @endpush
    @endsection
