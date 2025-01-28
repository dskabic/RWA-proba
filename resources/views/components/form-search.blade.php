
<form action="{{ url()->current() }}" method="GET">
    <input type="text" id="search" class="long-input" name="search" placeholder="Search ads..."  value="{{ $_GET['search'] ?? '' }}"/>
    <button type="submit" class="search-button bg-blue-500">Search</button>
</form>
