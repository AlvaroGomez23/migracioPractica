<div>
    <header>
        <div class="logo">Articles</div>
        <form action="{{ route('scanner.qr') }}">
            <input class="botons" type="submit" value="Scanner QR">
        </form>
        <div class="contenidorBotons">
            <form action="{{ route('signin') }}">
                <input class="botons" type="submit" value="Sign In">
            </form>
            <form action="{{ route('login') }}">
                <input class="botons" type="submit" value="Log In">
            </form>
        </div>
    </header>
</div>