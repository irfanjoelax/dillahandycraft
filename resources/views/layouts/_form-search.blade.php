<form class="input-group" method="GET" action="{{ url('/produk') }}">
    <input type="search" name="keyword" size="40" class="form-control" placeholder="Search Product..."
        value="{{ $request['keyword'] ?? '' }}">
    <button class="btn btn-outline-primary" type="submit">
        <i class="fa-solid fa-magnifying-glass"></i>
    </button>
</form>
