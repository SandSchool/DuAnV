<!-- @extends("layout.default")
@section("content")
<style>
    .logout-wrapper {
        min-height: 100vh;
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        display: flex;
        align-items: center;
        padding: 40px 0;
    }

    .logout-card {
        background: rgba(255, 255, 255, 0.95);
        backdrop-filter: blur(10px);
        border-radius: 20px;
        box-shadow: 0 20px 60px rgba(0, 0, 0, 0.3);
        border: 1px solid rgba(255, 255, 255, 0.2);
        overflow: hidden;
        animation: slideUp 0.6s ease-out;
    }

    @keyframes slideUp {
        from {
            opacity: 0;
            transform: translateY(30px);
        }

        to {
            opacity: 1;
            transform: translateY(0);
        }
    }

    .logout-icon {
        text-align: center;
        padding: 40px 40px 20px;
    }

    .logout-icon svg {
        width: 80px;
        height: 80px;
        stroke: #667eea;
        animation: pulse 2s ease-in-out infinite;
    }

    @keyframes pulse {

        0%,
        100% {
            transform: scale(1);
            opacity: 1;
        }

        50% {
            transform: scale(1.1);
            opacity: 0.8;
        }
    }

    .logout-body {
        padding: 20px 40px 50px;
        text-align: center;
    }

    .logout-title {
        font-size: 28px;
        font-weight: 700;
        color: #333;
        margin-bottom: 15px;
    }

    .logout-message {
        font-size: 16px;
        color: #666;
        margin-bottom: 30px;
        line-height: 1.6;
    }

    .user-info {
        background: linear-gradient(135deg, rgba(102, 126, 234, 0.1) 0%, rgba(118, 75, 162, 0.1) 100%);
        border-radius: 10px;
        padding: 20px;
        margin-bottom: 30px;
        border: 2px solid rgba(102, 126, 234, 0.2);
    }

    .user-info p {
        margin: 0;
        color: #555;
        font-size: 15px;
    }

    .user-info strong {
        color: #667eea;
        font-weight: 600;
    }

    .button-group {
        display: flex;
        gap: 15px;
        margin-top: 25px;
    }

    .btn-logout {
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        color: white;
        border: none;
        padding: 14px 30px;
        border-radius: 10px;
        font-size: 16px;
        font-weight: 600;
        cursor: pointer;
        transition: all 0.3s ease;
        flex: 1;
    }

    .btn-logout:hover {
        transform: translateY(-2px);
        box-shadow: 0 10px 25px rgba(102, 126, 234, 0.4);
    }

    .btn-logout:active {
        transform: translateY(0);
    }

    .btn-cancel {
        background: white;
        color: #667eea;
        border: 2px solid #667eea;
        padding: 14px 30px;
        border-radius: 10px;
        font-size: 16px;
        font-weight: 600;
        cursor: pointer;
        transition: all 0.3s ease;
        flex: 1;
        text-decoration: none;
        display: inline-block;
    }

    .btn-cancel:hover {
        background: #667eea;
        color: white;
        transform: translateY(-2px);
        box-shadow: 0 10px 25px rgba(102, 126, 234, 0.2);
    }

    .btn-cancel:active {
        transform: translateY(0);
    }

    .security-note {
        margin-top: 25px;
        padding: 15px;
        background: #fff3cd;
        border-left: 4px solid #ffc107;
        border-radius: 5px;
        text-align: left;
        font-size: 14px;
        color: #856404;
    }

    .security-note i {
        margin-right: 8px;
    }
</style>

<div class="logout-wrapper">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-6 col-lg-5">
                <div class="logout-card">
                    <div class="logout-icon">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 9V5.25A2.25 2.25 0 0013.5 3h-6a2.25 2.25 0 00-2.25 2.25v13.5A2.25 2.25 0 007.5 21h6a2.25 2.25 0 002.25-2.25V15M12 9l-3 3m0 0l3 3m-3-3h12.75" />
                        </svg>
                    </div>

                    <div class="logout-body">
                        <h2 class="logout-title">{{ __('Logout Confirmation') }}</h2>
                        <p class="logout-message">
                            {{ __('Are you sure you want to logout from your account?') }}
                        </p>

                        @auth
                        <div class="user-info">
                            <p>{{ __('Logged in as:') }} <strong>{{ Auth::user()->name ?? Auth::user()->email }}</strong></p>
                        </div>
                        @endauth

                        <form method="POST" action="{{ route('customer.logout') }}">
                            @csrf
                            <div class="button-group">
                                <a href="{{ url()->previous() }}" class="btn-cancel">
                                    {{ __('Cancel') }}
                                </a>
                                <button type="submit" class="btn-logout">
                                    {{ __('Yes, Logout') }}
                                </button>
                            </div>
                        </form>

                        <div class="security-note">
                            <i>⚠️</i>
                            <strong>{{ __('Security Tip:') }}</strong>
                            {{ __('Always logout when using shared or public computers.') }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection -->