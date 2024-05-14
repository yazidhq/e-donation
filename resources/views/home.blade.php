home
<form action="{{ route('logout') }}" method="POST">
    @csrf
    <button>logout</button>
</form>
