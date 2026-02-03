<form method="POST" action="{{ route('logout') }}">
    @csrf
    <button type="submit" class="w-full bg-red-500 hover:bg-red-600 text-white px-4 py-2 rounded focus:outline-none">
        <i class="fa fa-sign-out"></i> Logout
    </button>
</form>