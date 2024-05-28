<!-- resources/views/partials/message.blade.php -->

<div class="message {{ $message->sender_id == Session::get('employee_id') ? 'sent' : 'received' }}">
    <p>{{ $message->sender->employee_id }}: {{ $message->message }}</p>
</div>
