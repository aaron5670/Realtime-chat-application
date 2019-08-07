<?php
//Require pusher config
$config  = require __DIR__ . '/config.php';
?>

<!doctype html>
<html lang="nl">
<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <title>DEV || Chat by Aaron</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css"
          integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">

    <style type="text/css">
        .messages_display {
            height: 300px;
            overflow: auto;
        }

        .messages_display .message_item {
            padding: 0;
            margin: 0;
        }

        .bg-danger {
            padding: 10px;
        }
    </style>
</head>
<body>
<div class="container">
    <div class="col-12 col-md-6 offset-md-3 mt-5 chat_box" id="chatbox">
        <div class="form-control messages_display"></div>
        <br/>
        <div class="form-group">
            <input aria-label="Naam" type="text" class="input_name form-control" placeholder="Uw naam"/>
        </div>
        <div class="form-group">
            <textarea aria-label="Bericht" class="input_message form-control" placeholder="Bericht" rows="5"></textarea>
        </div>
        <div class="form-group input_send_holder">
            <input type="submit" value="Verstuur" class="btn btn-primary btn-block input_send"/>
        </div>
    </div>
</div>

<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.4.1/jquery.min.js"
        integrity="sha256-CSXorXvZcTkaix6Yvo6HppcZGetbYMGWSFlBw8HfCJo=" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"
        integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1"
        crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"
        integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM"
        crossorigin="anonymous"></script>
<script src="//js.pusher.com/4.1/pusher.min.js"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/bootbox.js/4.3.0/bootbox.min.js" type="text/javascript"></script>

<!--suppress EqualityComparisonWithCoercionJS -->
<script type="text/javascript">
    // Add API Key & cluster here to make the connection
    const pusher = new Pusher('<?= $config['auth_key'] ?>', {
        cluster: 'eu',
        encrypted: true
    });

    // Enter a unique channel you wish your users to be subscribed in.
    const channel = pusher.subscribe('test_channel');
    // bind the server event to get the response data and append it to the message div
    channel.bind('my_event',
        function (data) {
            //console.log(data);
            $('.messages_display').append('<p class="message_item">' + data + '</p>');
            $('.input_send_holder').html('<input type="submit" value="Verstuur" class="btn btn-primary btn-block input_send" />');
            $(".messages_display").scrollTop($(".messages_display")[0].scrollHeight);
        });

    // check if the user is subscribed to the above channel
    channel.bind('pusher:subscription_succeeded', function (members) {
        console.log('successfully subscribed!');
    });

    // Send AJAX request to the PHP file on server
    function ajaxCall(ajax_url, ajax_data) {
        $.ajax({
            type: "POST",
            url: ajax_url,
            //dataType: "json",
            data: ajax_data,
            success: function (response) {
                console.log(response);
            },
            error: function (msg) {
            }
        });
    }

    // Trigger for the Enter key when clicked.
    $.fn.enterKey = function (fnc) {
        return this.each(function () {
            $(this).keypress(function (ev) {
                const keycode = (ev.keyCode ? ev.keyCode : ev.which);
                if (keycode == '13') {
                    fnc.call(this, ev);
                }
            });
        });
    };

    // Send the Message enter by User
    $('body').on('click', '.chat_box .input_send', function (e) {
        e.preventDefault();
        const message = $('.chat_box .input_message').val();
        const name = $('.chat_box .input_name').val();
        // Validate Name field
        if (name === '') {
            bootbox.alert('<br /><p class="bg-danger">Please enter a Name.</p>');
        } else if (message !== '') {
            // Define ajax data
            const chat_message = {
                name: $('.chat_box .input_name').val(),
                message: '<strong>' + $('.chat_box .input_name').val() + '</strong>: ' + message
            };
            //console.log(chat_message);
            // Send the message to the server passing File Url and chat person name & message
            ajaxCall('<?= $config['site_url'] ?>' + 'message.php', chat_message);
            // Clear the message input field
            $('.chat_box .input_message').val('');
            // Show a loading image while sending
            $('.input_send_holder').html('<input type="submit" value="Verstuur" class="btn btn-primary btn-block" disabled /> &nbsp;<img src="loading.gif" alt="loading gif" width="75" />');
        }
    });

    // Send the message when enter key is clicked
    $('.chat_box .input_message').enterKey(function (e) {
        e.preventDefault();
        $('.chat_box .input_send').click();
    });
</script>
</body>
