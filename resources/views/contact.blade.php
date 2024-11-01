@extends('layouts.app')
@section('title', getSettings()->app_name . ':: Contact Page')
@section('content')
    <br />
    <br />
    <br />
    <br />
    <br />
    <!-- GOOGLE FORM
            ///////////////////////////////////////////////////////////////-->

    <section id="registration" class="section container push">
        <h1 class="title-head has-text-centered">
            How Can We Help You?
        </h1>

        <br />

        <div class="columns container">
            <div class="column">
                <form id="ajax-contact" method="post" action="mailer.php">
                    <div class="field column is-three-fifths is-offset-one-fifth">
                        <!--  <label for="name">Name:</label> -->
                        <input class="input" type="text" id="name" placeholder="Full Name" name="name"
                            required />
                    </div>

                    <div class="field column is-three-fifths is-offset-one-fifth">
                        <!--  <label for="email">Email:</label> -->
                        <input class="input" type="email" id="email" placeholder="Email Address" name="email"
                            required />
                    </div>

                    <div class="field column is-three-fifths is-offset-one-fifth">
                        <!--  <label for="email">Email:</label> -->
                        <input class="input" type="phone" id="phone" placeholder="Contact Number" name="phone"
                            required />
                    </div>

                    <div class="field column is-three-fifths is-offset-one-fifth">
                        <!--  <label for="message">Message:</label> -->
                        <textarea class="textarea" id="message" placeholder="Message" name="message" required></textarea>
                    </div>

                    <div class="field column is-three-fifths is-offset-one-fifth">
                        <button class="is-successf" type="submit">Send</button>
                    </div>
                </form>

                <br />

                <div id="form-messages" class="field column is-three-fifths is-offset-one-fifth"></div>
            </div>
        </div>
    </section>
@endsection
