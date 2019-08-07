<!-- Footer -->
<footer class="py-5 bg-dark">
    <div class="container">
        <p class="m-0 text-center text-white">&copy; <?= date( 'Y' ) ?> - Aaron van den Berg</p>
    </div>
    <!-- /.container -->
</footer>

<script src="//ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js" type="text/javascript"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"
        integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1"
        crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"
        integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM"
        crossorigin="anonymous"></script>

<!-- Bootstrap scrolling nav script -->
<script src="<?= asset_url() ?>js/scrolling-nav.js"></script>
<script src="<?= asset_url() ?>js/jquery.easing.min.js"></script>

<!-- Login form script -->
<script src="<?= asset_url() ?>js/my-login.js"></script>

<!--Bootbox-->
<script src="//cdnjs.cloudflare.com/ajax/libs/bootbox.js/4.3.0/bootbox.min.js" type="text/javascript"></script>

<!--Pusher script-->
<script src="//js.pusher.com/4.1/pusher.min.js"></script>


<!--TODO: DIT MOET NOG NETJES GEMAAKT WORDEN!-->
<?php $user = $this->ion_auth->user()->row(); ?>

<!--Pusher chat script-->
<script type="text/javascript">
    // Add API Key & cluster here to make the connection
    var pusher = new Pusher('8110a839b449bef0d6be', {
        cluster: 'eu',
        encrypted: true
    });

    // Enter a unique channel you wish your users to be subscribed in.
    var channel = pusher.subscribe('test_channel');

    // bind the server event to get the response data and append it to the message div
    channel.bind('my_event',
        function (data) {
            //console.log(data);
            $('.messages_display').append('<p class = "message_item">' + data + '</p>');
            $('.input_send_holder').html('<input type = "submit" value = "Send" class = "btn btn-primary btn-block input_send" />');
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
                //console.log(response);
            },
            error: function (msg) {
                alert(msg);
            }
        });
    }

    // Trigger for the Enter key when clicked.
    $.fn.enterKey = function (fnc) {
        return this.each(function () {
            $(this).keypress(function (ev) {
                var keycode = (ev.keyCode ? ev.keyCode : ev.which);
                if (keycode == '13') {
                    fnc.call(this, ev);
                }
            });
        });
    };

    // Send the Message enter by User
    $('body').on('click', '.chat_box .input_send', function (e) {
        e.preventDefault();
        var message = $('.chat_box .input_message').val();
        var name = '<?= $user->username; ?>';

        if (message !== '') {
            // Define ajax data
            var chat_message = {
                message: '<strong>' + name + '</strong>: ' + message,
            };

            // Send the message to the server passing File Url and chat person name & message
            ajaxCall('http://ci-chat.test/home/message', chat_message);

            // Clear the message input field
            $('.chat_box .input_message').val('');

            // Disable button when loading.
            $('.input_send_holder').html('<input type = "submit" value = "Send" class = "btn btn-primary btn-block" disabled />');
        }
    });

    // Send the message when enter key is clicked
    $('.chat_box .input_message').enterKey(function (e) {
        e.preventDefault();
        $('.chat_box .input_send').click();
    });
</script>
</body>
</html>
