<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <script src="https://unpkg.com/htmx.org"></script>
    @vite(['resources/js/app.js'])
</head>

<body>
    {{-- <div id="message-list" hx-get="/messages/{{ $chatId }}" hx-swap="outerHTML" hx-trigger="load"></div> --}}
    <div id="message-list" hx-get="/messages" hx-trigger="load"></div>
    {{-- <div id="message-list"></div> --}}

    <form hx-post="/messages" hx-trigger="submit" hx-target="#message-list" hx-swap="afterend"
        hx-on:submit="this.reset()">
        @csrf
        <input name="message" placeholder="Nhập tin nhắn" required />
        <button type="submit">Gửi</button>
    </form>
    <button hx-get="/clear-message" hx-swap="none" style="margin-top: 12px;">Clear all messages</button>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            window.Echo.channel(`my-channel`)
                .listen('.my-event', (e) => {
                    fetch('/messages')
                        .then(response => response.text())
                        .then(newMessage => {
                            document.getElementById('message-list').innerHTML = newMessage;
                        })
                        .catch(error => console.error('Error fetching messages:', error));
                });
        });
    </script>
</body>

</html>
