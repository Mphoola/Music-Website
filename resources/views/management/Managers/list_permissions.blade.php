@extends('layouts.management')

@section('title')
96Legacy | Admin | {{ $admin->name }} | Permissions
@endsection

@section('page-name')
Edit Permissions For | {{ $admin->name }}
@endsection
    
@section('main-content')
<div class="row">
    <div class="col-md-12">
      <div class="card">
        <div class="card-header card-success">
          <h2 class="text-center mb-0" style="text-transformation:capitalise; font-weight:bold">
            {{ $admin->name }}
            <a href="{{ route('logs.show.user', ['id' => $admin->id, 'g' => 'Admin']) }}" 
              class="btn btn-info btn-sm btn-round float-right">See Logs</a>
          </h2>
        </div>
        <div class="card-body">
         <h4>{{ $current_permissions->count() }} Current Permissions</h4>
          <ul class="list-group">
            @foreach ($current_permissions->pluck('name') as $permission)
                <li class="list-group-item">
                  {{ $permission }}
                </li>
            @endforeach
          </ul>
          
          @if ($errors->any())
              <ul class="list-group">
                @foreach ($errors->all() as $error)
                  <li class="list-group-item">
                    <div class="text-danger">
                      {{ $error }}
                    </div>
                  </li>
                @endforeach
              </ul>
          @endif
          <form action="{{ route('update_permissions', $admin->id) }}" method="post">
            @csrf
            @method('PUT')
            <div class="form-group">
              <label for="name">Name</label>
              <input type="text" name="name" id="name" class="form-control" value="{{ $admin->name }}" required>
            </div>
            <div class="form-group">
              <label for="role">Role</label>
              <select name="role" id="role" class="form-control">
                @foreach ($roles as $role)
                  <option value="{{ $role->name }}" 
                    @foreach ($admin_current_role as $r)
                      @if ($role->name == $r)
                        selected
                      @endif
                    @endforeach>{{ $role->name }}</option>
                @endforeach
            </select>
            </div>

            @if (Auth::guard('admin')->user()->can('see permissions'))
                
            <div class="form-group">
              
              <table style="width:40vw" class="table table-hover">
                <tr>
                  <th>Permissions</th>
                  <th style="text-align:center">Tick to choose</th>
                </tr>
                @foreach ($permissions as $permission)
                <tr>
                  <td>
                    {{ $permission->name }}
                  </td>
                  <td style="text-align:right">
                    <input type="checkbox" name="permissions[]" value="{{ $permission->name }}"
                    class="form-control" 
                    @foreach ($current_permissions->pluck('name') as $perm)
                        @if ($perm == $permission->name)
                            checked
                        @endif
                    @endforeach>
                  </td>
                </tr>
                @endforeach
              </table>
              
            </div>
            @endif
            <div class="form-group">
              @if (Auth::guard('admin')->user()->can('revolke permissions'))
              <button type="submit" class="btn btn-success btn-round">Update</button>
              @endif
              <a href="/management/admins" class="btn btn-danger btn-round">Cancel</a>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
@endsection