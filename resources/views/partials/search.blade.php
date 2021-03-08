<form action="{{ route('search') }}" method="GET" class="input-group">
    @csrf
    <input type="text" name="query" class="form-control" required placeholder="Search here"/>
    
    <div class="input-group-append">
      <button type="submit" class="btn btn-default"><i class="fas fa-search"></i></button>
    </div>
    
</form>