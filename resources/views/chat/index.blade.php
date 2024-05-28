{{-- @extends('layouts.app') <!-- Assuming you have a common layout -->

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

    <div class="container-fluid chat-container bg-dark">
        <div class="employees-list bg-dark">
            <div class="p-3">
                <input type="text" class="form-control" placeholder="Search">
            </div>
            <ul class="list-group list-group-flush">
                @foreach ($employees as $employee)
                    <li class="list-group-item employee d-flex align-items-center" data-id="{{ $employee->employee_id }}">
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
@endsection

@push('scripts')
    <script>
        const pusher = new Pusher('{{ config('broadcasting.connections.pusher.key') }}', {
            cluster: '{{ config('broadcasting.connections.pusher.options.cluster') }}'
        });
        const channel = pusher.subscribe('public');
        let selectedEmployeeId = null;

        function loadMessages(employee_id) {
            $.get(`/messages/${employee_id}`, function(data) {
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

        $(document).on('click', '.employee', function() {
            selectedEmployeeId = $(this).data('id');
            $('.employee').removeClass('active');
            $(this).addClass('active');
            loadMessages(selectedEmployeeId);
        });

        channel.bind('chat', function(data) {
            const message = data.message;
            if (selectedEmployeeId == message.sender_id || selectedEmployeeId == message.receiver_id) {
                const messageClass = message.sender_id == '{{ Session::get('employee_id') }}' ? 'sent' : 'received';
                $('.messages').append(
                    `<div class="message ${messageClass}"><p>${message.sender.employee_id}: ${message.message}</p></div>`
                );
                $(document).scrollTop($(document).height());
            }
        });

        $("#messageForm").submit(function(event) {
            event.preventDefault();

            if (selectedEmployeeId) {
                $.ajax({
                    url: "/broadcast",
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
                }).fail(function(jqXHR, textStatus, errorThrown) {
                    console.log('AJAX request failed:', textStatus, errorThrown);
                });
            } else {
                alert("Please select an employee to chat with.");
            }
        });
    </script>
@endpush --}}
