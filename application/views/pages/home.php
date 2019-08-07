<section id="services" class="bg-light p-5">
    <div class="container">
        <div class="row">
            <div class="col-lg-8 mx-auto">
                <h2>Realtime chat</h2>
                <div class="chat_box" id="chatbox">
                    <div class="form-control messages_display">
						<?php
                        if ( ! $this->ion_auth->logged_in() ) :
                        $disabled = 'disabled';
                            ?>
                            <p class="message_item">Welcome, please login to chat with people</p>
						<?php
						else:
							$user = $this->ion_auth->user()->row();
							$disabled = '';
							?>
                            <p class="message_item">Welcome <?= $user->username; ?>!</p>
						<?php endif; ?>
                    </div>
                    <br/>
                    <div class="form-group">
                        <textarea class="input_message form-control" placeholder="Enter Message" rows="5" <?= $disabled; ?>></textarea>
                    </div>
                    <div class="form-group input_send_holder">
                        <input type="submit" value="Send" class="btn btn-primary btn-block input_send" <?= $disabled; ?>/>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<section id="about">
    <div class="container">
        <div class="row">
            <div class="col-lg-8 mx-auto">
                <h2>About this Realtime Web Application</h2>
                <p class="lead">
                    This web application is build with CodeIgniter 3 and Docker.com
                </p>
                <ul>
                    <li>CodeIgniter (<a href="https://github.com/bcit-ci/CodeIgniter" target="_blank">See on GitHub</a>).
                    </li>
                    <li>Pusher (<a href="https://github.com/pusher/pusher-http-php" target="_blank">See onGitHub</a>).
                    </li>
                </ul>
            </div>
        </div>
    </div>
</section>
