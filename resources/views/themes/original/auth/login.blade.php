@extends($theme.'layouts.app')
@section('title',__('Login'))
@push('style')
    <style>
        .google-sign-in-button {
            cursor: pointer;
            transition: background-color .3s, box-shadow .3s;
            padding: 12px 16px 12px 42px;
            margin-top: 20px;
            border: none;
            border-radius: 3px;
            box-shadow: 0 -1px 0 rgba(0, 0, 0, .04), 0 1px 1px rgba(0, 0, 0, .25);
            color: #757575;
            font-size: 14px;
            font-weight: 500;
            font-family: -apple-system,BlinkMacSystemFont,"Segoe UI",Roboto,Oxygen,Ubuntu,Cantarell,"Fira Sans","Droid Sans","Helvetica Neue",sans-serif;
            background-image: url(data:image/svg+xml;base64,PHN2ZyB3aWR0aD0iMTgiIGhlaWdodD0iMTgiIHhtbG5zPSJodHRwOi8vd3d3LnczLm9yZy8yMDAwL3N2ZyI+PGcgZmlsbD0ibm9uZSIgZmlsbC1ydWxlPSJldmVub2RkIj48cGF0aCBkPSJNMTcuNiA5LjJsLS4xLTEuOEg5djMuNGg0LjhDMTMuNiAxMiAxMyAxMyAxMiAxMy42djIuMmgzYTguOCA4LjggMCAwIDAgMi42LTYuNnoiIGZpbGw9IiM0Mjg1RjQiIGZpbGwtcnVsZT0ibm9uemVybyIvPjxwYXRoIGQ9Ik05IDE4YzIuNCAwIDQuNS0uOCA2LTIuMmwtMy0yLjJhNS40IDUuNCAwIDAgMS04LTIuOUgxVjEzYTkgOSAwIDAgMCA4IDV6IiBmaWxsPSIjMzRBODUzIiBmaWxsLXJ1bGU9Im5vbnplcm8iLz48cGF0aCBkPSJNNCAxMC43YTUuNCA1LjQgMCAwIDEgMC0zLjRWNUgxYTkgOSAwIDAgMCAwIDhsMy0yLjN6IiBmaWxsPSIjRkJCQzA1IiBmaWxsLXJ1bGU9Im5vbnplcm8iLz48cGF0aCBkPSJNOSAzLjZjMS4zIDAgMi41LjQgMy40IDEuM0wxNSAyLjNBOSA5IDAgMCAwIDEgNWwzIDIuNGE1LjQgNS40IDAgMCAxIDUtMy43eiIgZmlsbD0iI0VBNDMzNSIgZmlsbC1ydWxlPSJub256ZXJvIi8+PHBhdGggZD0iTTAgMGgxOHYxOEgweiIvPjwvZz48L3N2Zz4=);
            background-color: white;
            background-repeat: no-repeat;
            background-position: 12px 11px;
        }

        .google-sign-in-button:hover {
            box-shadow: 0 -1px 0 rgba(0, 0, 0, .04), 0 2px 4px rgba(0, 0, 0, .25);
        }

        .google-sign-in-button:active {
            background-color: #eeeeee;
        }

        .google-sign-in-button:active {
            outline: none;
            box-shadow:
                0 -1px 0 rgba(0, 0, 0, .04),
                0 2px 4px rgba(0, 0, 0, .25),
                0 0 0 3px #c8dafc;
        }

        .google-sign-in-button:disabled {
            filter: grayscale(100%);
            background-color: #ebebeb;
            box-shadow: 0 -1px 0 rgba(0, 0, 0, .04), 0 1px 1px rgba(0, 0, 0, .25);
            cursor: not-allowed;
        }
    </style>
@endpush
@section('content')
    <!-- login section -->
    <section class="login-section">
        <div class="container h-100">
            <div class="row h-100 justify-content-center">
                <div class="col-lg-7">
                    <div class="img-box">
                        <img src="{{ asset($themeTrue.'img/login.png') }}" alt="@lang('login-image')" class="img-fluid" />
                    </div>
                </div>
                <div class="col-lg-5">
                    <div class="form-wrapper d-flex align-items-center h-100">
                        <div class="form-box">
                            <form action="{{ route('login') }}" method="post">
                                @csrf
                                <div class="row g-4">
                                    <div class="col-12">
                                        <h4>@lang('Login To Your Account')</h4>
                                    </div>
                                    <div class="input-box col-12">
                                        <input type="text"
                                               name="username"
                                               class="form-control"
                                               placeholder="@lang('Email Or Username')"/>
                                        @error('username')<span class="text-danger float-left">@lang($message)</span>@enderror
                                        @error('email')<span class="text-danger float-left">@lang($message)</span>@enderror
                                    </div>

                                    <div class="input-box col-12">
                                        <input type="hidden"
                                               name="timezone"
                                               class="form-control timezone"
                                               placeholder="@lang('timezone')"/>
                                    </div>

                                    <div class="input-box col-12">
                                        <input type="password"
                                               name="password"
                                               class="form-control"
                                               placeholder="@lang('Password')"/>
                                        @error('password')
                                        <span class="text-danger mt-1">@lang($message)</span>
                                        @enderror
                                    </div>

                                    @if(basicControl()->reCaptcha_status_login)
                                        <div class="box mb-4 form-group">
                                            {!! NoCaptcha::renderJs(session()->get('trans')) !!}
                                            {!! NoCaptcha::display($basic->theme == 'original' ? ['data-theme' => 'dark'] : []) !!}
                                            @error('g-recaptcha-response')
                                            <span class="text-danger mt-1">@lang($message)</span>
                                            @enderror
                                        </div>
                                    @endif


                                    <div class="col-12">
                                        <div class="links">
                                            <div class="form-check">
                                                <input class="form-check-input"
                                                       type="checkbox"
                                                       name="remember"
                                                       {{ old('remember') ? 'checked' : '' }}
                                                       id="flexCheckDefault"/>
                                                <label class="form-check-label" for="flexCheckDefault"> @lang('Remember me') </label>
                                            </div>
                                            <a href="{{ route('password.request') }}">@lang('Forget password?')</a>
                                        </div>
                                    </div>
                                </div>
                                <button class="btn-custom" type="submit">@lang('Sign in')</button>
                                <div class="bottom">
                                    @lang("Don't have an account?")

                                    <a href="{{ route('register') }}">@lang('Create account')</a>

                                </div>
                                <div class="bottom">
                                <a href="{{ route('google.redirect') }}" class="google-sign-in-button"> Login with Google </a>
                                </div>
                            </form>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection

@push('script')
    <script>
        'use strict'
        $(document).ready(function (){
            $('.timezone').val(Intl.DateTimeFormat().resolvedOptions().timeZone);
        });
    </script>
@endpush
