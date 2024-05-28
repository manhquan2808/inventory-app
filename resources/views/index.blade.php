<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="{{ asset('css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/all.css') }}">
    {{-- <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet"> --}}
    <title>Chat Application</title>
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

        /* Additional styles to align messages properly */
        .messages {
            display: flex;
            flex-direction: column;
        }
    </style>
</head>

<body>
    <div class="container-fluid chat-container">
        <div class="employees-list bg-light">
            <div class="p-3">
                <input type="text" class="form-control" placeholder="Search">
            </div>
            <ul class="list-group list-group-flush">
                @foreach ($employees as $employee)
                    <li class="list-group-item employee d-flex align-items-center"
                        data-id="{{ $employee->employee_id }}">
                        <img src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcS4k-EK9bwaXD1R_HGLkKam2lQJBpUZ6BB-5iWwW0nUXQ&s"
                            alt="Avatar" class="rounded-circle" width="50" height="50">
                        <div>
                            <h6 class="mb-0">{{ $employee->employee_id }}</h6>
                            <small>Online</small>
                        </div>
                    </li>
                @endforeach
            </ul>
        </div>
        <div class="chat bg-white">
            <div class="messages p-3">
                @foreach ($messages as $message)
                    @include('partials.message', ['message' => $message])
                @endforeach
            </div>
            <div class="bottom bg-light">
                <form id="messageForm" class="d-flex">
                    @csrf
                    <input type="text" id="message" name="message" class="form-control me-2"
                        placeholder="Nhập gì đó ..." autocomplete="off">
                    <button type="submit" class="btn btn-primary"><i class="fas fa-paper-plane"></i></button>
                </form>
            </div>
        </div>
    </div>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/pusher/8.3.0/pusher.min.js"></script>
    <script src="{{ asset('js/jquery-3.7.1.min.js') }}"></script>
    <script src="{{ asset('js/all.js') }}"></script>

    <script src="{{ asset('js/bootstrap.min.js') }}"></script>
    <script src="{{ asset('js/bootstrap.bundle.min.js') }}"></script>
    <script>
        const pusher = new Pusher('{{ config('broadcasting.connections.pusher.key') }}', {
            cluster: 'eu'
        });
        const channel = pusher.subscribe('public');
        let selectedEmployeeId = null;

        // Function to load messages for an employee
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
                $(document).scrollTop($(document).height());
            });
        }

        // Select employee to chat
        $(document).on('click', '.employee', function() {
            selectedEmployeeId = $(this).data('id');
            $('.employee').removeClass('active');
            $(this).addClass('active');
            loadMessages(selectedEmployeeId);
        });

        // Receive messages
        channel.bind('chat', function(data) {
            if (selectedEmployeeId == data.sender_id || selectedEmployeeId == data.receiver_id) {
                const messageClass = data.sender_id == '{{ Session::get('employee_id') }}' ? 'sent' : 'received';
                $('.messages').append(
                    `<div class="message ${messageClass}"><p>${data.sender.employee_id}: ${data.message}</p></div>`
                );
                $(document).scrollTop($(document).height());
            }
        });

        // Broadcast messages

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
                    `<div class="message sent"><p>Bạn: ${$("#message").val()}</p></div>`;
                    $('.messages').append(newMessage);
                    $("#message").val('');
                    $(document).scrollTop($(document).height());
                });
            } else {
                alert("Please select an employee to chat with.");
            }
        });
    </script>

</body>

</html>
